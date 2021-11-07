<?php
session_start();
include 'php/mysql.php';

$pageContent = "";
$page = 'main';
if(isset($_GET['page'])) $page = $_GET['page'];


include 'pages/header.php';
if($page=='main') include 'pages/page_main.php';
else if($page=='instrukcja') include 'pages/page_instrukcja.php';
else if($page=='rejestracja') include 'pages/page_rejestracja.php';
else if($page=='zaloguj_sie') include 'pages/page_logowanie.php';
else if($page=='wyloguj_sie') include 'pages/page_logout.php';
else if($page=='lista') include 'pages/page_lista.php';
include 'pages/footer.php';





