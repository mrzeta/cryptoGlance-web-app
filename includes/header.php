<!DOCTYPE html>
<html lang="en">
<?php require_once("includes/head.php"); ?>
   <body>
      <?php require_once("templates/modals/coming_soon.php"); ?>
      <?php require_once("templates/modals/add_panel.php"); ?>
      
      <!-- TODO: Move these require_once modals to a better spot, only when a rig is actually added -->
      <?php require_once("templates/modals/manage_rig.php"); ?>
      <?php require_once("templates/modals/qrcode-donate-btc.php"); ?>
      <?php require_once("templates/modals/qrcode-donate-ltc.php"); ?>
      <?php require_once("templates/modals/qrcode-donate-vtc.php"); ?>
      <?php require_once("templates/modals/qrcode-donate-doge.php"); ?>
      <?php require_once("templates/modals/manage_rig.php"); ?>
      <!-- -->
      
      <div class="page-container">
      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top" role="navigation">
         <div class="container">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
               <span class="sr-only">Toggle navigation</span>
               <i class="icon icon-dropmenu"></i>
               </button>
               <a class="navbar-brand" href="index.php"><img src="images/cryptoglance-logo-landscape.png" alt="cryptoGlance" /></a>
            </div>
            <div class="navbar-collapse collapse">
               <ul class="nav nav-pills navbar-nav
                <?php echo ($currentPage != 'index') ? 'no-dash' : '' ?>
               ">
                  <?php if ($currentPage == 'index') { ?>  
                  <li><a class="total-hashrate">0 <small>MH/s</small></a></li>
                  <?php } ?>
                  <li class="active topnav topnav-icon"><a id="dash-link" href="index.php"><i class="icon icon-speed"></i> Dashboard</a>
                    <?php if ($currentPage == 'index') { ?><a id="dash-add-panel" class="grad-green" title="Add Panel" data-toggle="modal" data-target="#addPanel"><i class="icon icon-newtab"></i></a><?php } ?>
                  </li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-settingsthree-gears mobile-icon"></i> Tools <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li class="dropdown-header site-layout">Site Layout</li>
                        <li class="site-layout-btns">
                          <div class="btn-group">
                            <button type="button" id="layout-list" class="btn btn-primary"><i class="icon icon-menu"></i></button>
                            <button type="button" id="layout-grid" class="btn btn-primary"><i class="icon icon-th"></i></button>
                          </div>
                        </li>
                        <li class="dropdown-header site-width-slider">Panel Width</li>
                        <li class="site-width-slider">
                           <span class="width-reading">90%</span> <!-- width-reading -->
                           <div id="slider"></div> <!-- the Slider -->
                        </li>
                        <li><a href="settings.php"><i class="icon icon-settingsandroid"></i> cryptoGlance Settings</a></li>
                        <!-- <div class="divider"></div> -->
                        <?php //require_once("includes/menu-active_panels.php"); ?>
                     </ul>
                  </li>
                  <li class="dropdown topnav">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon icon-question-sign mobile-icon"></i> Help <b class="caret"></b></a>
                     <ul class="dropdown-menu">
                        <li class="dropdown-header">Learn more</li>
                        <li><a href="help.php"><i class="icon icon-preview"></i> View the README</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Official Links</li>
                        <li><a href="https://play.google.com/store/apps/details?id=com.scar45.cryptoGlance" rel="external"><i class="icon icon-playstore"></i> Android Companion App</a></li>
                        <li><a href="https://github.com/scar45/cryptoglance" rel="external"><i class="icon icon-github"></i> Source on Github</a></li>
                        <li><a href="https://cryptoglance.info" rel="external"><i class="icon icon-glasses"></i> cryptoGlance Homepage</a></li>
                     </ul>
                  </li>
                  <li id="nav-login-button" class="topnav topnav-icon"><a href="logout.php"><i class="icon icon-exitalt"></i> Logout</a></li>
                  <!-- <li id="nav-logout-button" class="topnav topnav-icon"><a href="logout.php"><i class="icon icon-exitalt"></i> Logout</a></li> -->
               </ul>
            </div>
            <div id="alert-update" class="top-alert">
               <span><b>Update available!</b> You are running <b class="current"></b>, but the latest release is <b class="latest"></b>.</span> <a href="https://github.com/scar45/cryptoglance/archive/master.zip" rel="external"><button type="button" class="btn btn-warning btn-xs" data-type="all"><i class="icon icon-download-alt"></i> Download Now</button></a> <a class="alert-dismiss" href="#"><i class="icon icon-buttonx"></i></a>
            </div>
            <!--/.nav-collapse -->
         </div>
      </div>
      
      <?php if ($currentPage == 'index') { ?>
        <div id="mobile-hashrate"><a class="total-hashrate">0 <small>MH/s</small></a></div>
      <?php } ?>
