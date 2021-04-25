<?php

require 'bdd/DB.inc.php';
session_start();
$db = DB::getInstance();

function redirectUnauthorized(){
	header('Location: /PromInfo/signin.php?error=Unauthorized');
	exit(-1);
}

if(!isset($_SESSION['Client'])){ header('Location: /PromInfo/signin.php?redirect='.$_SERVER['REQUEST_URI']); exit(-1); }
if($db->checkNeedPassChange($_SESSION['Client']->getKeyUser())){ header('Location: /PromInfo/passChange.php'); exit(-1);}

$pageName = basename($_SERVER['PHP_SELF']);
$rolesUser = $db->getRoles($_SESSION['Client']->getKeyUser());
if($pageName == 'editTypeSeance.php' && (!in_array(1,$rolesUser))) redirectUnauthorized();
if($pageName == 'editUser.php' && (!in_array(1,$rolesUser))) redirectUnauthorized();
if($pageName == 'editModule.php' && (!in_array(1,$rolesUser))) redirectUnauthorized();
if($pageName == 'editGroup.php' && (!in_array(1,$rolesUser))) redirectUnauthorized();
if($pageName == 'editLimits.php' && (!in_array(1,$rolesUser))) redirectUnauthorized();
if($pageName == 'editModuleUser.php' && (!in_array(1,$rolesUser))) redirectUnauthorized();
if($pageName == 'editSeance.php' && (!in_array(1,$rolesUser))) redirectUnauthorized();
if($pageName == 'editSemaphore.php' && (!in_array(1,$rolesUser))) redirectUnauthorized();
if($pageName == 'editTypeEvenements.php' && (!in_array(1,$rolesUser))) redirectUnauthorized();
?>