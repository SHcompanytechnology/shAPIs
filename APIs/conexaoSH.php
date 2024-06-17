<?php 
require_once('config.php');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With'); 
header('Content-Type: application/json; charset=utf-8');  


//dados do banco no servidor local
$banco = 'ProjectSH';
$host = '34.138.14.62:3306';
$usuario = 'geoplus';
$senha = '6nC.6uF)';



try {

	$pdo = new PDO("mysql:dbname=$banco;host=$host", "$usuario", "$senha");
	
} catch (Exception $e) {
	echo 'Erro ao conectar com o banco!! '. $e;
}

 ?>