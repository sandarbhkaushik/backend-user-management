<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use \App\JSONResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function sendResponse ($data, $statusCode=200, $message='Success', $errors=[]){
	// 	$updatedData = !is_array($data) ? $data->toArray() : $data;
	// 	$updatedData = $this->updateNullValueWithEmptyValue($updatedData);
	// 	$jsonResponse = new JSONResponse();
	// 	$jsonResponse->setStatusCode($statusCode);
	// 	$jsonResponse->setMessage($message);
	// 	$jsonResponse->setData($updatedData);
	// 	$jsonResponse->setErrors($errors);
	// 	return $jsonResponse->output();
    // }
    
    // public function updateNullValueWithEmptyValue($array) {
	// 	array_walk_recursive($array, "self::replaceNullValueWithEmptyString");
	// 	return $array;
	// }
}
