<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'imovel_guide';

if(!$con=mysqli_connect($servername, $username, $password)){
	echo"<p>Erro ao se conectar com o banco de dados!</p>";
}

if(!$db=mysqli_select_db($con, $database)){
	echo "<p>Erro ao se conectar com a base de dados!</p>";
}

mysqli_query($con,"SET NAMES utf8");

?>