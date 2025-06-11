<?php
//header('Content-Type: text/html; charset=UTF-8');
session_start();
//error_reporting(0);
//mb_internal_encoding("UTF-8");
include "config/core.php";
include "config/function.php";
include "config/component.php";
include "config/config.php";
include "config/connect.php";
$lang_default = "lang_" . $config['lang'] . ".php";

if (file_exists("$lang_default")) include "$lang_default";

$modul_without_login = array('reset-password', 'api_reset_password', 'app_reset_password');

if ($_SESSION['s_login'] != "" or in_array($modul, $modul_without_login)) {
    $config_user = $config['userdir'] . "/backend/config.php";
    if (file_exists("$config_user")) {
        include "$config_user";
    }
    ob_start();
    $lang_modul = $config['userdir'] . "/backend/modul/$modul/lang_" . $config['lang'] . ".php";
    if (file_exists("$lang_modul")) include "$lang_modul";
    if (file_exists($config['userdir'] . "/backend/modul/$modul/controller.php")) include $config['userdir'] . "/backend/modul/$modul/controller.php";
    $maincontent = ob_get_clean();
    if ($_GET['print'] == 1) {
        include $config['userdir'] . "/backend/print.php";
    } else {
        include $config['userdir'] . "/backend/html.php";
    }
} else {
    ob_start();
    $lang_modul = $config['userdir'] . "/backend/modul/login/lang_" . $config['lang'] . ".php";
    if (file_exists("$lang_modul")) include "$lang_modul";
    if (file_exists($config['userdir'] . "/backend/modul/login/controller.php")) include $config['userdir'] . "/backend/modul/login/controller.php";
    $maincontent = ob_get_clean();
    //include $config['userdir']."/backend/login.php";
    include "login.php";
}
unset($_SESSION['msg_warning']);

session_write_close();
$mysql->close();
