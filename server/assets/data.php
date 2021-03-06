<?php 
require_once '../../dbconn.php';

class getData{

	public function getDetails($value){
		global $mysqli;	
		$response=array();

		if($this->sanitizeID($value)){
			if($value=='0'){
				$res=$this->getAllDetails();
				return $res;
			}
			$input=filter_var($value,FILTER_SANITIZE_NUMBER_INT);
			$sql=$mysqli->prepare("SELECT name,description,price,quantity,imgName,review from product WHERE id=?");	
			$sql->bind_param('i',$input);
			$sql->execute();
			$sql->bind_result($pname,$desc,$price,$quantity,$img,$review);
        	while ($sql->fetch()){
        		$response['name']=$pname;
        		$response['description']=$desc;
        		$response['price']=$price;
        		$response['quantity']=$quantity;
        		$response['image_src']="http://kelvin.ist.rit.edu/~ip9636/Angular/assets/img/".$img;
        		$response['review']=$review;
        	}
        	return $response;

		}
		else{
			return "error: ID is not valid";
		}
	}
	public function getAllDetails(){
		global $mysqli;
		$arr=array();

		$sql=$mysqli->prepare("SELECT id,name,description,price,quantity,imgName,review from product");
		$sql->execute();
		$sql->bind_result($id,$pname,$desc,$price,$quantity,$img,$review);
		while ($sql->fetch()){
				$temp=array();
        		$temp['id']=$id;	
        		$temp['name']=$pname;
        		$temp['description']=$desc;
        		$temp['price']=$price;
        		$temp['quantity']=$quantity;
        		$temp['image_src']="http://kelvin.ist.rit.edu/~ip9636/Angular/assets/img/".$img;
        		$temp['review']=$review;
        		array_push($arr,$temp); 
        }
       	return $arr;	
	}	

	public function sanitizeID($id){
		$pattern='/^[0-9]*$/';
		return preg_match($pattern, $id);
	}


}$data=new getData();