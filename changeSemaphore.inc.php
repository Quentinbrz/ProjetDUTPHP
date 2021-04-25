<?php

require 'checkConnection.inc.php';

if(isset($_POST['idSeance'])){
    if(!empty($_POST['idSeance'])){
        $db->setNextSemaphore($_SESSION['Client']->getKeyUser(),$_POST['idSeance']);
        $newSema = $db->getSemaphore($_SESSION['Client']->getKeyUser(),$_POST['idSeance']);
        echo json_encode(array('lib' => $newSema->getLib(), 'color' => $newSema->getColor(), 'textcolor' =>$newSema->getTextColor()));
    }
}

?>