<?php

class ArchemyController extends BaseController {

	protected $layout = "layouts.application";

	public function search()
	{
		$data_to_search = Input::get("data");
		$archemy = new Archemy($data_to_search);
		//$archemy_response = $archemy->search($data_to_search);
		if($archemy->status()){
			$this->layout->content = View::make('archemy.show',array("response" => $archemy->response(),"relations" => $archemy->parseRelations(),"data"=>$data_to_search));
		}
		else{
			return var_dump($archemy->response());
		}

	}
	public function nuevo()
	{
		$this->layout->content = View::make('ner.new');
	}

}
