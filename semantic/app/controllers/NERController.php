<?php

class NERController extends BaseController {

	protected $layout = "layouts.application";

	public function show()
	{
		$this->layout->content = View::make('ner.show');
	}
	public function search()
	{
		$data_to_search = Input::get("data");
		$spotlight = new MySpotlight();
		$spotlight_response = $spotlight->search($data_to_search);
		if($spotlight_response->status()){
			$this->layout->content = View::make('ner.show',array("response" => $spotlight_response->response()));
		}
		else{
			return var_dump($spotlight_response->response());
		}
	}
	public function sparql(){
		$this->layout->content = View::make('ner.sparql');
	}
	public function query(){
		$query = Input::get("query");
		$query_html = str_replace("<","&lt;",$query);
		$query_html = str_replace(">","&gt;",$query_html);
		$result = SparqlData::query($query);
		$this->layout->content = View::make('ner.sparql_show',array("response" => $result,"query"=>$query_html));
		
	}
	public function crawl(){
		if (!Input::has('url')){

			return $this->layout->content = View::make('crawlurl');
		}
		$startURL = Input::get("url");
		$depth = Input::get("depth");;
		$crawler = new crawler($startURL, $depth);
		
		//$crawler->setHttpAuth($username, $password);
		$crawler->run();
		$i = 0;
		echo sizeof($crawler->getSeen());
			
		foreach ($crawler->getSeen() as $url => $seen) {
			
			$archemy = new Archemy($url,1);
		
			if($archemy->status()){
				$archemy->parseRelations();
				//array_merge($relations,);
			}
			 echo $archemy->response();
			
			//echo $url."<br>";
			
		} 
		$relations = Sentence::where("full_text",$startURL);
		$this->layout->content = View::make('archemy.show',array("response" => "","relations" => $relations,"data"=>$startURL));
		
	}
	public function nuevo()
	{
		$this->layout->content = View::make('ner.new');
	}

}
