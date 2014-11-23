<?php

class Sentence extends Eloquent{

	protected $fillable = array('subject','action','object','subject_url','object_url',
								'action_url','location','location_url','full_text');
	protected $table = 'sentences';

	public static function boot()
    {
        parent::boot();

        // Setup event bindings...
        Sentence::creating(function($sentence)
		{
		    echo ":3";
		    if($sentence->subject_url){
		    	if($sentence->object_url){
		    		SparqlData::postData("<".$sentence->subject_url."> <".$sentence->action."> <".$sentence->object_url.">","http://example.com/graph");
		    	}
		    	else if($sentence->location_url){
		    		SparqlData::postData("<".$sentence->subject_url."> <".$sentence->action."> <".$sentence->location_url.">","http://example.com/graph");
		    	}
		    	else if($sentence->object){
		    		SparqlData::postData("<".$sentence->subject_url."> <".$sentence->action."> \"".$sentence->object."\"","http://example.com/graph");
		    	}
		    	else if($sentence->location){
		    		SparqlData::postData("<".$sentence->subject_url."> <".$sentence->action."> \"".$sentence->location."\"","http://example.com/graph");
		    	}
		    }
			

		});
    }	

	public function setActionAttribute($data){
		$arr = str_word_count($data,1);
		for ($i=0; $i < sizeof($arr); $i++) { 
			if($i > 0){
				$arr[$i] = ucfirst($arr[$i]);
			}
		}

		$this->attributes['action'] = implode("", $arr);
	}

	public function setObjectUrlAttribute($obj){
		$bandera = false;
		if(property_exists($obj, "entities")){
			foreach ($obj->entities as $entity) {
				if(property_exists($entity, "disambiguated")){
					if(property_exists($entity->disambiguated, "dbpedia")){
						$bandera = true;
						$this->attributes['object_url'] = $entity->disambiguated->dbpedia;
					}
				}
			}			
		}
		if(!$bandera){
			$dbpedia_url = ArchemyConcept::getConcept($obj->text);
			
			if($dbpedia_url){
				$this->attributes['object_url'] = $dbpedia_url;
			}
		}
	}

	public function setSubjectUrlAttribute($obj){
		$bandera = false;
		if(property_exists($obj, "entities")){
			foreach ($obj->entities as $entity) {
				if(property_exists($entity, "disambiguated")){
					if(property_exists($entity->disambiguated, "dbpedia")){
						$bandera = true;
						$this->attributes['subject_url'] = $entity->disambiguated->dbpedia;
					}
				}				
			}
			
		}
		if(!$bandera){
			$dbpedia_url = ArchemyConcept::getConcept($obj->text);
			if($dbpedia_url){
				$this->attributes['subject_url'] = $dbpedia_url;
			}
		}
	}

	public function setLocationUrlAttribute($obj){
		$bandera = false;
		if(property_exists($obj, "entities")){
			foreach ($obj->entities as $entity) {
				if(property_exists($entity, "disambiguated")){
					
					if(property_exists($entity->disambiguated, "dbpedia")){
						$bandera = true;
						$this->attributes['location_url'] = $entity->disambiguated->dbpedia;
					}
				}				
			}
			
		}
		if(!$bandera){
			$dbpedia_url = ArchemyConcept::getConcept($obj->text);
			if($dbpedia_url){
				$this->attributes['location_url'] = $dbpedia_url;
			}
		}
	}

	public function json_data(){
		//$endpoint = str_replace("page","data", $this->subject_url);
		$endpoint = str_replace("resource","data", $this->subject_url);
		$ch = curl_init();
		curl_setopt_array($ch, array(
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_URL => $endpoint.".json"
		));
		$server_output = curl_exec ($ch);
		if ($errno = curl_errno($ch)) {
			curl_close ($ch);
			return null;
		}
		curl_close ($ch);
		return $server_output;
	}

}
