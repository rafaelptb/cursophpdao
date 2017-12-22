<?php

	require_once("config.php");

	// Carrega um usuário

	//$root = new Usuario();

	//$root->loadById(7);

	//echo $root;


	// Carrega todos os usuários
	//$lista = Usuario::getList();

	//echo json_encode($lista);


	//Carrega usuário de acordo com o login
	//$search = Usuario::search("oo");
	//echo json_encode($search);


	// Carrega usuário usando login e a senha
	$usuario = new Usuario();
	$usuario->login("root", "123456");

	echo $usuario;
?>