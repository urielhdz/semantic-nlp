<?php

class Archemy{

	private $API_KEY = "e568557d9f9a8cbb7046679d3a45ec82e926e029";
	private $response;
	private $endpoint = "http://access.alchemyapi.com/calls/text/TextGetRelations";
	private $relations = array();
	private $full_text;
	function __construct($data,$option = 0) {
		$this->full_text = $data;
		$ch = curl_init();
		if($option == 0){
			curl_setopt_array($ch, array(
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_URL => $this->endpoint."?text=".urlencode($data)."&apikey=".$this->API_KEY."&outputMode=json&entities=1&maxRetrieve=100"
			));
		}else if($option == 1){
			
			curl_setopt_array($ch, array(
			    CURLOPT_RETURNTRANSFER => true,
			    CURLOPT_URL => "http://access.alchemyapi.com/calls/url/URLGetRelations?url=".urlencode($data)."&apikey=".$this->API_KEY."&outputMode=json&entities=1&maxRetrieve=100"
			));
		}
		
		$server_output = curl_exec ($ch);

		if ($errno = curl_errno($ch)) {
			
			$this->response = new MyResponse(curl_error($ch),false);
		}

		curl_close ($ch);
		$this->response = new MyResponse($server_output,true);		
	}
	public function response(){
		return $this->response->response();
	}
	public function status(){
		return $this->response->status();
	}
	public function parseRelations(){
		if($this->response->status()){
			$json_data = json_decode($this->response->response());
			if($json_data && $json_data->status == "OK"){ 
				foreach ($json_data->relations as $relation) {
					$object_data = "";
					if(property_exists($relation, "object")){
						$object_data = $relation->object->text;
					}

					$action_data = "";
					if(property_exists($relation, "action")){
						$action_data = $relation->action->text;
					}

					$location_data = "";
					if(property_exists($relation, "location")){
						$location_data = $relation->location->text;
					}

					$sentence = new Sentence();
					$sentence->full_text = $this->full_text;
					$sentence->subject = $relation->subject->text;
					$sentence->action = $action_data;
					$sentence->object = $object_data;
					$sentence->location = $location_data;
										
					$sentence->subject_url = $relation->subject;
					if($object_data != ""){
						$sentence->object_url = $relation->object;
					}
					if($location_data != ""){
						$sentence->location_url = $relation->location;
					}
					
					$sentence->save();
					array_push($this->relations, $sentence);
				}
			}
		}
		return $this->relations;
	}

}
