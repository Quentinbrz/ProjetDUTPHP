<?php

class Seances {

    private $id_seance;
	private $id_module_seance;
	private $date_creation_seance;
	private $type_seance;
	private $group_seance;
	private $key_user_seance;



	public function __construct ($id_seance=-1, $lib_module = "", $date = 0, $type_seance = "", $group = 0, $key_user_seance = 0)
	{
		$this->id_seance             = $id_seance;
		$this->id_module_seance      = $lib_module;
		$this->date_creation_seance  = $date;
		$this->type_seance           = $type_seance;
		$this->group_seance          = $group;
		$this->key_user_seance       = $key_user_seance;
	}

	public function getId_seance()		{ return htmlspecialchars($this->id_seance);			}
	public function getId_moduleName()	{ return htmlspecialchars($this->id_module_seance);		}
	public function getType_seance()	{ return htmlspecialchars($this->type_seance);			}
	public function getNom_group()		{ return htmlspecialchars($this->group_seance);			}
	public function getKey_User()		{ return htmlspecialchars($this->key_user_seance);		}
	public function getDateTime()		{ return htmlspecialchars($this->date_creation_seance);	}
	public function getDateMois()		{ return htmlspecialchars(substr($this->date_creat_seance, 5, 2));}
	public function getNumberWeeks()	{ return htmlspecialchars(date('W' ,strtotime($this->date_creation_seance)));}

	public function getDate()
	{
		$formatdate = "";
		$formatdate = substr($this->date_creation_seance, 8, 2) . "/" . substr($this->date_creation_seance, 5, 2) . "/" . substr($this->date_creation_seance, 0,4 );
		return htmlspecialchars($formatdate);
	}
	public function getAnnee()
	{
		return htmlspecialchars(substr($this->date_creation_seance, 0,4 ));
		
	}


}
?>
