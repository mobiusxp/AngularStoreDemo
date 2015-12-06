<?php

require_once 'data.php';
class handle{

  public function parse($arr)
  {	
  		global $data;
  		$result=$data->getDetails($arr['id']);
  		return json_encode($result);
  }
}
$handler=new handle();

