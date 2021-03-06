<!-- This is the navbar page that is loaded in to the messenger and files page -->
<div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
  <button class="menu-icon" type="button" data-toggle>Menu</button>
</div>
<div class="top-bar" id="main-menu">
  <div class="top-bar-left">
    <ul class="dropdown menu" data-dropdown-menu>
      <li class="name"><a href="../"><b>MFSR</b></a></li>
      <li><a href="/files">Files</a></li>
    </ul>
  </div>
  <div class="top-bar-right">
    <ul class="menu" data-responsive-menu="drilldown medium-dropdown">
      <li class="has-submenu">
        <a href="/user"><?php echo $_SESSION['username'] ?></a>
        <ul class="submenu menu vertical" data-submenu>
          <?php
            if($_SESSION['admin'] == 1){
              echo '<li><a href="/admin">Administration</a></li>';
            }
          ?>
          <li><a href="/settings">Settings</a></li>
          <li><a href="../logout.php">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>