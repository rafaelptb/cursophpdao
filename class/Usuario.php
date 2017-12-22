<?php

class Usuario{

	private $idUsuario;
	private $desLogin;
	private $desSenha;
	private $dtCadastro;

	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

	public function getDesLogin(){
		return $this->desLogin;
	}

	public function setDesLogin($desLogin){
		$this->desLogin = $desLogin;
	}

	public function getDesSenha(){
		return $this->desSenha;
	}

	public function setDesSenha($desSenha){
		$this->desSenha = $desSenha;
	}

	public function getDtCadastro(){
		return $this->dtCadastro;
	}

	public function setDtCadastro($dtCadastro){
		$this->dtCadastro = $dtCadastro;
	}

	public function loadById($id){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID" => $id));

		if (count($results)){
			$row = $results[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setDesLogin($row['deslogin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}
	}

	public function __toString(){
		return json_encode(array(
			"idusuario" => $this->getIdUsuario(),
			"deslogin" => $this->getDesLogin(),
			"dessenha" => $this->getDesSenha(),
			"dtcadastro" => $this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}
}

?>