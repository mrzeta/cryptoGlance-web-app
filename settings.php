<?php
include('includes/inc.php');

if (!$_SESSION['login_string']) {
    header('Location: login.php');
    exit();
}

require_once('includes/cryptoglance.php');
$cryptoGlance = new CryptoGlance();
$errors = array();
$generalSaveResult = null;
$emailSaveResult = null;

if (isset($_POST['general'])) {
    $data = array();
    $data = array(
        'tempWarning' => intval($_POST['tempWarning']),
        'tempDanger' => intval($_POST['tempDanger']),
        'rigUpdateTime' => intval($_POST['rigUpdateTime']),
        'poolUpdateTime' => intval($_POST['poolUpdateTime']),
        'walletUpdateTime' => intval($_POST['walletUpdateTime']),
    );
    
    if ($data['tempWarning'] <= 0) {
        $errors['tempWarning'] = true;
    }
    if ($data['tempDanger'] <= 0 && $data['tempDanger'] <= $data['tempWarning']) {
        $errors['tempDanger'] = true;
    }
    if ($data['rigUpdateTime'] < 2) {
        $errors['rigUpdateTime'] = true;
    }
    if ($data['poolUpdateTime'] < 120) {
        $errors['poolUpdateTime'] = true;
    }
    if ($data['walletUpdateTime'] < 600) {
        $errors['walletUpdateTime'] = true;
    }
    
    $generalSaveResult = $cryptoGlance->saveSettings(array('general' => $data));
} else if (isset($_POST['email'])) {
    $data = array();
    
    // do stuff

    $emailSaveResult = $cryptoGlance->saveSettings(array('email' => $data));
}

$settings = $cryptoGlance->getSettings();

if (empty($settings['general']['temps']['warning'])) {
    $settings['general']['temps']['warning'] = 75;
}
if (empty($settings['general']['temps']['danger'])) {
    $settings['general']['temps']['danger'] = 85;
}

$jsArray = array('settings');

require_once("includes/header.php");
?>
       
<!-- ### Below is the Settings page which contains common/site-wide preferences
      
-->
         
      <div id="settings-wrap" class="container sub-nav full-content">
        <div id="readme" class="panel panel-default panel-no-grid no-icon">
          <h1>Settings</h1>
          <div class="panel-heading">
              <h2 class="panel-title"><i class="icon icon-settingsandroid"></i> General</h2>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST">
              <fieldset>
                <h3>Temperature Thresholds:</h3>                
                <div class="form-group temp-thresholds">
                  <div class="temp-set-warning orange">
                    <input type="text" class="form-control" id="inputTempWarning" name="tempWarning" value="<?php echo $settings['general']['temps']['warning'] ?>" placeholder="<?php echo $settings['general']['temps']['warning'] ?>" maxlength="3">
                    <span>&deg;C</span>
                    <label for="inputTempWarning" class="control-label">Warning</label>
                  </div>
                  <div class="temp-set-danger red">
                    <input type="text" class="form-control" id="inputTempDanger" name="tempDanger" value="<?php echo $settings['general']['temps']['danger'] ?>" placeholder="<?php echo $settings['general']['temps']['danger'] ?>" maxlength="3">
                    <span>&deg;C</span>
                    <label for="inputTempDanger" class="control-label">Danger</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-4">
                    <span class="help-block"><i class="icon icon-info-sign"></i> Set the points where <span class="orange">warning</span> and <span class="red">danger</span> labels will appear (<span class="red">danger</span> must be greater than <span class="orange">warning</span>).</span>
                  </div>
                </div>
                <h3>Stat Refresh Intervals:</h3>                
                <div class="form-group">
                  <label class="col-sm-5 control-label">Rigs:</label>
                  <div class="col-sm-3 refresh-interval">
                    <select class="form-control" name="rigUpdateTime">
                      <option <?php echo ($settings['general']['updateTimes']['rig'] == 2000) ? 'selected="selected"' : '' ?> value="2">2 seconds</option>
                      <option <?php echo ($settings['general']['updateTimes']['rig'] == 3000) ? 'selected="selected"' : '' ?> value="3">3 seconds</option>
                      <option <?php echo ($settings['general']['updateTimes']['rig'] == 5000) ? 'selected="selected"' : '' ?> value="5">5 seconds</option>
                      <option <?php echo ($settings['general']['updateTimes']['rig'] == 10000) ? 'selected="selected"' : '' ?> value="10">10 seconds</option>
                      <option <?php echo ($settings['general']['updateTimes']['rig'] == 30000) ? 'selected="selected"' : '' ?> value="30">30 seconds</option>
                      <option <?php echo ($settings['general']['updateTimes']['rig'] == 60000) ? 'selected="selected"' : '' ?> value="60">1 minute</option>
                      <option <?php echo ($settings['general']['updateTimes']['rig'] == 120000) ? 'selected="selected"' : '' ?> value="120">2 minutes</option>
                      <option <?php echo ($settings['general']['updateTimes']['rig'] == 300000) ? 'selected="selected"' : '' ?> value="300">5 minutes</option>
                      <option <?php echo ($settings['general']['updateTimes']['rig'] == 600000) ? 'selected="selected"' : '' ?> value="600">10 minutes</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-5 control-label">Pools:</label>
                  <div class="col-sm-3 refresh-interval">
                    <select class="form-control" name="poolUpdateTime">
                      <option <?php echo ($settings['general']['updateTimes']['pool'] == 120000) ? 'selected="selected"' : '' ?> value="120">2 minutes</option>
                      <option <?php echo ($settings['general']['updateTimes']['pool'] == 300000) ? 'selected="selected"' : '' ?> value="300">5 minutes</option>
                      <option <?php echo ($settings['general']['updateTimes']['pool'] == 600000) ? 'selected="selected"' : '' ?> value="600">10 minutes</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-5 control-label">Wallets:</label>
                  <div class="col-sm-3 refresh-interval">
                    <select class="form-control" name="walletUpdateTime">
                      <option <?php echo ($settings['general']['updateTimes']['wallet'] == 600000) ? 'selected="selected"' : '' ?> value="600">10 minutes</option>
                      <option <?php echo ($settings['general']['updateTimes']['wallet'] == 1800000) ? 'selected="selected"' : '' ?> value="1800">30 minutes</option>
                      <option <?php echo ($settings['general']['updateTimes']['wallet'] == 2700000) ? 'selected="selected"' : '' ?> value="2700">45 minutes</option>
                      <option <?php echo ($settings['general']['updateTimes']['wallet'] == 3600000) ? 'selected="selected"' : '' ?> value="3600">1 hour</option>
                      <option <?php echo ($settings['general']['updateTimes']['wallet'] == 7200000) ? 'selected="selected"' : '' ?> value="7200">2 hours</option>
                    </select>
                  </div>
                </div>
                <?php if ($generalSaveResult) { ?>
                <div id="alert-saved-address" class="alert alert-success alert-dismissable">
                    <button type="button" class="close fade in" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Success!</strong> You've updated your settings.
                </div>
                <?php } elseif (!$generalSaveResult && !is_null($generalSaveResult)) { ?>
                <div id="alert-save-fail-address" class="alert alert-danger alert-dismissable">
                    <button type="button" class="close fade in" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Failed!</strong> Please make sure <em>/<?php echo DATA_FOLDER; ?>/configs/</em> is writable.
                </div>
                <?php } ?>
                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-2">
                    <button type="submit" name="general" class="btn btn-lg btn-success"><i class="icon icon-save-floppy"></i> Save General Settings</button>
                  </div>
                </div>
              </fieldset>
            </form>
            <br>
          </div>
          <div class="panel-heading">
              <h2 class="panel-title"><i class="icon icon-settingsandroid"></i> Cookies</h2>
          </div>
          <div class="panel-body">
            <form class="form-horizontal" role="form">
              <fieldset>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-6">
                    <span class="help-block"><i class="icon icon-info-sign"></i> cryptoGlance cookies save preferences like panel width/positioning, and are safe to clear. Your important settings are always within the /user_data folder.<br><b>* YOU WILL BE LOGGED OUT AFTER CLEARING COOKIES!</b></span>
                  </div>
                  <label class="col-sm-2 control-label"><button name="clearCookies" class="btn btn-lg btn-success"><i class="icon icon-programclose"></i> Clear Cookies</button></label>
                </div>
              </fieldset>
            </form>
            <br>
          </div>
        </div>
      </div>
      <!-- /container -->

      <?php require_once("includes/footer.php"); ?>
      </div>
      <!-- /page-container -->
      
      <?php require_once("includes/scripts.php"); ?>
   </body>
</html>