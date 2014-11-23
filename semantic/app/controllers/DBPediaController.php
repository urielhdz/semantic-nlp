<?php

class DBPediaController extends BaseController {

	protected $layout = "layouts.application";

	public function show($id)
	{
		$sentence = Sentence::find($id);
		if($sentence->subject_url && $sentence->subject_url != ""){
			$dbpedia_data = $sentence->json_data();
			
			$this->layout->content = View::make('dbpedia.show',array("dbpedia_data" => $dbpedia_data,"sentence"=>$sentence));
		}
		
	}
	

}
