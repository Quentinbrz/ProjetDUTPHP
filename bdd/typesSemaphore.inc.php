<?php

class TypesSemaphore {

    private $id_type_semaphore;
    private $lib_type_semaphore;
    private $color_semaphore;
    private $text_color_semaphore;

	public function __construct($id=-1,$lib="",$color="",$text_color="") {
		$this->id_type_semaphore = $id;
		$this->lib_type_semaphore = $lib;
		$this->color_semaphore = $color;
		$this->text_color_semaphore = $text_color;
	}

	public function getId()			{ return htmlspecialchars($this->id_type_semaphore);	}
	public function getLib()		{ return htmlspecialchars($this->lib_type_semaphore);	}
	public function getColor()		{ return htmlspecialchars($this->color_semaphore);		}
	public function getTextColor()	{ return htmlspecialchars($this->text_color_semaphore);	}

}
?>
