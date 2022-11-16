<?php 

namespace App\Traits;

trait ApiResponse 
{
    public function respondSuccess($message, $data = [], $code = 200)
    {
    	return $this->sendResponse(true, $message, $data, $code);
    }
	
	public function respondError($message, $data = [], $code = 400)
	{	
    	return $this->sendResponse(false, $message, $data, $code);
	}	

	private function sendResponse($success, $message, $data = [], $code)
	{
		$response = [
    		'success' => $success,
    		'message' => $message
    	];

    	if ($data) {
    		$response['data'] = $data;
    	}

    	return $this->apiResponse($response, $code);	
	}
	
	private function apiResponse($data, $code)
	{
		return response()->json($data,$code);
	}

}