<?php

class Event {

    private $id_event;
    private $id_seance_event;
	private $type_event;
    private $lib_event;
    private $duree_event;
    private $date_fin_event;
	private $key_user;

	public function __construct($id_event=-1,$id_seance_event=-1,$type_event="",$lib_event="",$duree_event=-1,$date_fin_event="",$key_user=-1) {
		$this->id_event  = $id_event;
        $this->id_seance_event = $id_seance_event;
        $this->type_event = $type_event;
        $this->lib_event = $lib_event;
        $this->duree_event = $duree_event;
        $this->date_fin_event = $date_fin_event;
        $this->key_user = $key_user;
	}

	public function getIdEvent()        { return htmlspecialchars($this->id_event);         }
	public function getTypeEvent()      { return htmlspecialchars($this->type_event);       }
    public function getIdSeance()       { return htmlspecialchars($this->id_seance_event);  } 
    public function getLibEvent()       { return htmlspecialchars($this->lib_event);        }
    public function getDureeEvent()     { return htmlspecialchars($this->duree_event);      }
    public function getDateFinEventRFC(){ return htmlspecialchars($this->date_fin_event);   }
	public function getKeyOwner()       { return htmlspecialchars($this->key_user);         }

    public function getDateFinEvent()
    { 
        $formatdate = "";
        $formatdate = substr($this->date_fin_event, 8, 2) . "/" . substr($this->date_fin_event, 5, 2) . "/" . substr($this->date_fin_event, 0,4 );
		return htmlspecialchars($formatdate);
    }	

}
?>
