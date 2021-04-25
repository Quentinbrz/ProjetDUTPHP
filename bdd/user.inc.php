<?php

class User {

	private $key_user;
	private $id_user;
	private $nom_user;
	private $prenom_user;
	private $password_user;
	private $date_creat_user;
	private $date_modif_user;

	public function __construct($k=-1,$i=-1,$n="",$p="",$pass="",$dc="",$dm="",$np=-1) {
		$this->key_user = $k;
		$this->id_user = $i;
		$this->nom_user = $n;
		$this->prenom_user = $p;
		$this->password_user = $pass;
		$this->date_creat_user = $dc;
		$this->date_modif_user = $dm;
	}

	public function getKeyUser()		{ return htmlspecialchars($this->key_user);			}
	public function getIdUser()			{ return htmlspecialchars($this->id_user);			}
	public function getNomUser()		{ return htmlspecialchars($this->nom_user);			}
	public function getPrenomUser()		{ return htmlspecialchars($this->prenom_user);		}
	public function getPasswordHash()	{ return $this->password_user;						}
	public function getDateCreation()	{ return htmlspecialchars($this->date_creat_user);	}
	public function getDateModification(){ return htmlspecialchars($this->date_modif_user);	}

}
?>
