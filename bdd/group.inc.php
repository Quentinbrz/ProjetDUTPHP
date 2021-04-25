<?php

class Group {

    private $id_group;
	private $nom_group;
	private $id_group_pere;
	

    
    
	public function __construct($id=-1, $ng="", $idp=-1) {
		$this->id_group      = $id;
		$this->nom_group     = $ng;
		$this->id_group_pere = $idp;
	
	}

	public function getId()     { return htmlspecialchars($this->id_group);			}
	public function getNom()    { return htmlspecialchars($this->nom_group);		}
	public function getIdPere() { return htmlspecialchars($this->id_group_pere);	}

	
}
?>
