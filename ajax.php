<?php
require_once('includes/inc.php');

if (!$_SESSION['login_string']) {
    http_response_code(401); // 401 = Unauthorized
    exit();
}

global $CACHED;
if (isset($_GET['cached']) && $_GET['cached'] == 0) {
    $CACHED = false;
} else {
    $CACHED = true;
}

$type = ucwords(strtolower($_GET['type']));

$action = str_replace('-', '', preg_replace_callback('/(\w+)/', function($match){ return ucfirst($match[1]); }, strtolower($_GET['action'])));


if (empty($type) || empty($action)) {
    exit();
}

require_once('includes/autoloader.inc.php');

$className = 'Class_' . $type;
$obj = new $className();
$obj->$action();
?>
