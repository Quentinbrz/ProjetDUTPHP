<?php

function arrayToString($param) {
	$StringExtensions = "Les extensions autorisées sont : ";
	foreach ($param as $extension)
		$StringExtensions = $StringExtensions.$extension." ";
	return $StringExtensions;
}

function reArrayFiles($files) {

    $file_array = array();
    $file_count = count($files['name']);
    $file_key = array_keys($files);
   
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_array[$i][$val] = $files[$val][$i];
        }
    }
    return $file_array;
}

function uploadFileSeance($files,$year,$month,$idSeance,$idEvent){
	$extensions= array("png","gif","pdf");
	mkdir("documents/".$year."/".$month."/".$idSeance."/".$idEvent,0777,true);
	foreach($files as $file){
		$errors= array();
		$file_name = $file['name'];
		$file_size = $file['size'];
		$file_tmp = $file['tmp_name'];
		$file_type= $file['type'];
		$file_ext=strtolower(end(explode('.',$file['name'])));
		
		if(in_array($file_ext,$extensions)=== false)
			$errors[]="Not Allowed";

		if($file_size > 10097152)
			$errors[]='File size must be less than 10 MB';

		if(empty($errors)){
			move_uploaded_file($file_tmp,"documents/".$year."/".$month."/".$idSeance."/".$idEvent."/".$file_name);
		}
	}
}


?>
