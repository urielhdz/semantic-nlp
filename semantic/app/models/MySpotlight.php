<?php

class MySpotlight{

	public function search($data)
	{
		
		$ch = curl_init();
		curl_setopt_array($ch, array(
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_URL => "http://spotlight.dbpedia.org/rest/annotate?text=".urlencode($data)."&confidence=0.15"
		));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		    "Accept:application/json"
	    ));
		$server_output = curl_exec ($ch);

		if ($errno = curl_errno($ch)) {
		    return new MyResponse($errno,false);
		}


		curl_close ($ch);
		return new MyResponse($server_output,true);
	}

}
