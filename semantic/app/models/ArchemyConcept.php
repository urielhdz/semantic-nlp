<?php

class ArchemyConcept{

	public static function getConcept ($data) {
		$API_KEY = "e568557d9f9a8cbb7046679d3a45ec82e926e029";
		$endpoint = "http://access.alchemyapi.com/calls/text/TextGetRankedConcepts";
		$ch = curl_init();
		Log::info("\n\n\n ======== ".$data." ======== \n\n\n");
		curl_setopt_array($ch, array(
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_URL => $endpoint."?text=".urlencode($data)."&apikey=".$API_KEY."&outputMode=json&entities=1&maxRetrieve=100"
		));
		$server_output = curl_exec ($ch);
		Log::info("\n\n\n ======== SERVER OUTPUT: ".$server_output." ======== \n\n\n");
		if ($errno = curl_errno($ch)) {
			return null;
		}
		else{
			curl_close ($ch);
			$json_data = json_decode($server_output);
			if($json_data && $json_data->status == "OK" && sizeof($json_data->concepts) > 0 ){
				if($json_data->concepts[0]->relevance > 0.92)
				return $json_data->concepts[0]->dbpedia;
			}
		}
		return null;
		
	}
	

}
