<?php
session_start();
require('connect.php');
$id = null;
if(isset($_GET['id'])){
	$id = $_GET['id'];
	if(mysqli_query($con, "DELETE FROM `corretores` WHERE `corretores`.`id` = $id;")){
		$_SESSION['msg'] = "Registro do corretor deletado!";
	}
}
header('location: ./')
?>