<?php
include("inc/jpgraph_antispam.php");
session_start();
$spam = new AntiSpam();
$chars = $spam->Rand(4);
$_SESSION['tmptxt'] = $chars;
$spam->Stroke();
?>