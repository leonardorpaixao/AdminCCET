<?php

class ssh {
	private $ip;
	private $senha;
	private $user;
	private $connection;

	public function ssh($ip_rec, $user_rec, $senha_rec){
		$this->ip = $ip_rec;
		$this->senha = $senha_rec;
		$this->user = $user_rec;
	}

	public function create_connection(){
		$this->connection = ssh2_connect($this->ip, 22);
		if (! $this->connection)
            echo"<script>alert('Falha ao estabelecer conexao com o servidor')</script>";
	}

	public function autentication(){
		$bin = ssh2_auth_password($this->connection, $this->user, $this->senha);
		return $bin;
	}	

	public function exec_command($command){	
		$stream = ssh2_exec($this->connection, $command);	
		stream_set_blocking($stream, true);
		echo "" . stream_get_contents($stream);
		fclose($stream);
	}
}
?>
