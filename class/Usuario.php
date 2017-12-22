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
			$this->setData($results[0]);
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

	public static function getList(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
	}

	public static function search($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH' => "%" . $login . "%"));
	}

	public function login($login, $password){

		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(":LOGIN" => $login, ":PASSWORD" => $password));

		if (count($results)){
			
			$this->setData($results[0]);
			
		}else{
			throw new Exception("Login e/ou Senha incorretos");
			
		}

	}

	public function setData($data){

		$this->setIdUsuario($data['idusuario']);
		$this->setDesLogin($data['deslogin']);
		$this->setDesSenha($data['dessenha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro']));

	}

	public function insert(){

		$sql = new Sql();

		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			":LOGIN" => $this->getDesLogin(),
			":PASSWORD" => $this->getDesSenha()
		));

		if (count($results)){
			$this->setData($results[0]);
		}

	}

	public function update($login, $password){

		$this->setDesLogin($login);
		$this->setDesSenha($password);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			":LOGIN" => $this->getDesLogin(),
			":PASSWORD" => $this->getDesSenha(),
			":ID" => $this->getIdUsuario()
		));

	}

	public function delete(){

		$sql = new Sql();
		$sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID" => $this->getIdUsuario()
		));

		$this->setIdUsuario(0);
		$this->setDesLogin("");
		$this->setDesSenha("");
		$this->setDtCadastro(new DateTime());

	}

	public function __construct($login = "", $password = ""){
		$this->setDesLogin($login);
		$this->setDesSenha($password);
	}
}

?>