<?php
// prevent the server from timing out
set_time_limit(0);

// include the web sockets server script (the server is started at the far bottom of this file)
require('./inc/class.PHPWebSocket.php');
require ('./inc/connect.php');
require_once('./inc/library/HTMLPurifier.auto.php');

// when a client sends data to the server
function wsOnMessage($clientID, $message, $messageLength, $binary) {
	global $Server,$db;
	$ip = long2ip( $Server->wsClients[$clientID][6] );

	$config = HTMLPurifier_Config::createDefault();
	$def = $config->getHTMLDefinition(true);
//	$config->set('HTML.TidyLevel', 'heavy');
//	$def->addAttribute('a', 'target', new HTMLPurifier_AttrDef_Enum(
//			array('_blank','_self','_target','_top')
//	));
	$purifier = new HTMLPurifier($config);

	$msg = json_decode($message);
	$message = $purifier->purify(nl2br($msg->message));
	$user = $purifier->purify($msg->username);

	// check if message length is 0
	if ($messageLength == 0) {
		$Server->wsClose($clientID);
		return;
	}

	$timestamp = date('Y-m-d G:i:s');

	//The speaker is the only person in the room. Don't let them feel lonely.
	if ( sizeof($Server->wsClients) == 1 ) {
		$Server->wsSend($clientID,json_encode(array('user' => "SERVER", 'message' => "There isn't anyone else in the ,room, but I'll still listen to you. --Your Trusty Server", 'timestamp' => $timestamp)) );
	}
	else {
		//Send the message to everyone
		foreach ($Server->wsClients as $id => $client) {
			$Server->wsSend($id, json_encode(array('user' => $user, 'message' => $message, 'timestamp' => $timestamp)));
		}
		$Server->log("$ip ($clientID) $user: $message");
		$data = $db->prepare('INSERT INTO messages(message,timestamp,user_id) VALUES ((:msg),(:timestamp),(SELECT user_id FROM users WHERE username=(:sender)))');//
		$data->bindParam(':sender', $user, PDO::PARAM_STR);
		$data->bindParam(':msg', $message, PDO::PARAM_STR);
		$data->bindParam(':timestamp', $timestamp, PDO::PARAM_STR);
		$data->execute();
	}
}

// when a client connects
function wsOnOpen($clientID)
{
	global $Server;
	$ip = long2ip( $Server->wsClients[$clientID][6] );

	$Server->log( "$ip ($clientID) has connected." );

	$timestamp = date('Y-m-d G:i:s');

	//Send a join notice to everyone but the person who joined
//	foreach ( $Server->wsClients as $id => $client )
//		if ( $id != $clientID )
//			$Server->wsSend($id,json_encode(array('user' => "SERVER", 'message' => "Visitor $clientID ($ip) has joined the room.", 'timestamp' => $timestamp)));
}

// when a client closes or lost connection
function wsOnClose($clientID, $status) {
	global $Server;
	$ip = long2ip( $Server->wsClients[$clientID][6] );

	$Server->log( "$ip ($clientID) has disconnected." );

	$timestamp = date('Y-m-d G:i:s');

	//Send a user left notice to everyone in the room
//	foreach ( $Server->wsClients as $id => $client )
//		$Server->wsSend($id, json_encode(array('user' => "SERVER", 'message' => "Visitor $clientID ($ip) has left the room.", 'timestamp' => $timestamp)));
}

// start the server
$Server = new PHPWebSocket();
$Server->bind('message', 'wsOnMessage');
$Server->bind('open', 'wsOnOpen');
$Server->bind('close', 'wsOnClose');
// for other computers to connect, you will probably need to change this to your LAN IP or external IP,
// alternatively use: gethostbyaddr(gethostbyname($_SERVER['SERVER_NAME']))
$Server->wsStartServer('127.0.0.1', 9300);
$Server->log("Server Started");
?>