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
	//$usuario = new Usuario();
	//$usuario->login("root", "123456");

	//echo $usuario;

	// FAZER INSERT DE UM NOVO USUÁRIO
	//$aluno = new Usuario("aluno", "987654");

	//$aluno->insert();

	//echo $aluno;

	//FAZER UPDATE DE UM USUÁRIO

	//$usuario = new Usuario();

	//$usuario->loadById(13);

	//$usuario->update("aluno13", "654987");

	//echo $usuario;


	//DELETER UM USUÁRIO
	$usuario = new Usuario();

	$usuario->loadById(13);

	$usuario->delete();

	echo $usuario;


?>