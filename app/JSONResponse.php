<?php 
namespace App\Model;


class JSONResponse {
 private $statusCode;
 private $message;
 private $data;
 private $errors;

  function __construct () {
  $this->data = [];
  $this->errors = [];
 }

 	public function getStatusCode(){
  		return $this->statusCode;
 	}

 	public function setStatusCode($statusCode){
 	 	$this->statusCode = $statusCode;
 	}

 	public function getMessage(){
  		return $this->message;
 	}

 	public function setMessage($message){
  		$this->message = $message;
 	}

 	public function getData(){  
 		 return $this->data;
 	}

 	public function setData($data){
  		$this->data = $data;
 	}

 	public function getErrors(){  
  		return $this->errors;
 	}

 	public function setErrors($errors){
  		$this->errors = $errors;
 	}
 

	 
 	public function output() {
  		$data = $this->formatResponse();
  		$updatedData = $this->transformKeys($data);
  		return response()->json($updatedData, 200);
 	}
 


 	private function formatResponse() {
		$data =  $this->getData();
		$errors = $this->getErrors();

		return array(
			 'status_code' => $this->getStatusCode(),
			 'total_records' => count($data),
			 'message' => $this->getMessage(),
			 'errors' => $errors,
			 'data' => $data,   
		);
	 }

 	private function camelCase($array) {
  		return collect($array)->keyBy(function ($value, $key) {
   		return camel_case($key);
  		});
 	}

 	private function transformKeys(&$array) {
 		foreach (array_keys($array) as $key) {
   			$value = &$array[$key];
   			unset($array[$key]);
   
		   	$transformedKey = strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', ltrim($key, '!')));
		  
	   		if (is_array($value)) $this->transformKeys($value);
	   		$array[$transformedKey] = $value;      
	   		unset($value);
		}
		return $array;
	}
}
