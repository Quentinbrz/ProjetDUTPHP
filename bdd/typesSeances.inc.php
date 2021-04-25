<?php

class TypesSeances {

    private $id_type_seance;
    private $lib_type_seance;
    private $id_role;

	public function __construct($id=-1,$lib="",$id_role=-1) {
		$this->id_type_seance = $id;
		$this->lib_type_seance = $lib;
		$this->id_role = $id_role;
	}

	public function getId()			{ return htmlspecialchars($this->id_type_seance);	}
	public function getLib()		{ return htmlspecialchars($this->lib_type_seance);	}
	public function getIdRoleTS()	{ return htmlspecialchars($this->id_role);			}

}
?>
