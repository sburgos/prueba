<?php
session_start();
ob_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);


require 'controlador/lib/Lenguaje.php';
require 'modelo/conn/Template.php';
require 'controlador/Head.php'; 


if(!isset($_GET['nom']) or empty($_GET['nom']))
{
	require_once 'controlador/Portada.php';
	$a = new Portada();
	$ar= $a->retornar();
}
else
{
	$nom = explode('-',$_GET['nom']);
	$n = '';
	foreach($nom as $k => $v)
	{
		$n.= ucfirst($v);
	}
	
	if(file_exists('controlador/'.$n.'.php'))
	{
		require_once 'controlador/'.$n.'.php';
		$a = new $n();
		$ar= $a->retornar();
	}
	else
	{
		header("Location: index.php");
	}
}

require_once 'controlador/Footer.php';
$footer=new Footer();
$footer->volcar();
 
die();
?>