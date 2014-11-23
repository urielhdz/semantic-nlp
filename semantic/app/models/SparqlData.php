<?php

class SparqlData{

	public static function postData ($data,$graph) {
		
		$url = "http://localhost:8000/data/";
		$fields_string = "";
		$fields = array(
				'data' => urlencode($data),
				'graph' => urlencode($graph),
				'mime-type' => "application/x-turtle"
		);
		$ch = curl_init();		

		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		$fields_string = rtrim($fields_string, '&');

		curl_setopt_array($ch, array(
		    CURLOPT_URL => $url,
		    CURLOPT_POST => true,
		    CURLOPT_POSTFIELDS => $fields_string
		));

		$server_output = curl_exec ($ch);
		if ($errno = curl_errno($ch)) {
			var_dump($errno);
			return null;
		}
		else{
			curl_close ($ch);
			return $server_output;
		}
		return null;
		
	}
	public static function query($query){
		$dbpconfig = array(
			"remote_store_endpoint" => "http://localhost:8000/sparql/",
		);
		 
		$store = ARC2::getRemoteStore($dbpconfig); 
		 
		$query = $query;
		 
		$rows = $store->query($query, 'rows'); /* execute the query */
		return $rows;
		  
	}

}
