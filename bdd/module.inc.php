<?php

class Module {

    private $id_module;
    private $code_module;
    private $lib_module;
	private $coul_module;
	private $id_role;
	private $date_creat_module;
	private $date_modif_module;

	public function __construct($id=-1,$cm=-1,$lib="",$coulm="",$dc="",$dm="",$irm=-1) {
		$this->id_module         = $id;
		$this->code_module       = $cm;
        $this->lib_module        = $lib;
        $this->coul_module       = $coulm;
		$this->date_creat_module = $dc;
		$this->date_modif_module = $dm;
		$this->id_role   = $irm;
	}

	public function getId_Module()        { return htmlspecialchars($this->id_module);			}
	public function getCodeModule()       { return htmlspecialchars($this->code_module);		}
    public function getLibModule()        { return htmlspecialchars($this->lib_module);			}
    public function getCoulModule()       { return htmlspecialchars($this->coul_module);		}
	public function getDateCreation()     { return htmlspecialchars($this->date_creat_module);	}
	public function getDateModification() { return htmlspecialchars($this->date_modif_module);	}
	public function getIdRoleModule()     { return htmlspecialchars($this->id_role);			}
}
?>
