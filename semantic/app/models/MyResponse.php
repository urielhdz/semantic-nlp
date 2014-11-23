<?php

class MyResponse{

	protected $response = "";
	protected $status = false;
	

	function __construct($response, $status) {
		$this->response = $response;
		$this->status = $status;
	}

	public function response(){
		return $this->response;
	}
	public function status(){
		return $this->status;
	}

}
