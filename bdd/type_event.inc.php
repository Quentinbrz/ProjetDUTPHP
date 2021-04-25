<?php

class Type_Event {

    private $id_type_event;
    private $lib_type_event;
    private $id_role;  
    
	public function __construct($ite=-1, $lte="",$ire=-1) {
		$this->id_type_event      = $ite;
        $this->lib_type_event     = $lte;
        $this->id_role            = $ire;
        
    }

    public function getIdTypeEvent()    {return htmlspecialchars($this->id_type_event); }
    public function getLibTypeEvent()   {return htmlspecialchars($this->lib_type_event);}
    public function getIdRoleEvent()    {return htmlspecialchars($this->id_role);       }
}
?>
