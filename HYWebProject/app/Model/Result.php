<?php

App::uses('AppModel', 'Model');

class Result extends AppModel
{
	public function saveResult($teamList)
	{
		//We check how many results are already stored
		$res = $this->find('all',array('fields' => array('id')));
		
		if(empty($res))
		{
			$number = 0;
		}
		else 
		{
			$number = count($res);
		}
		
		$updatedList = array();
		
		for($i = 0; $i < count($teamList); $i++)
		{
			$this->create();
			$newResult = array('id' => $i+$number+1,'prize' => $teamList[$i]['prize'], 'result' => $teamList[$i]['status']);
			$this->save($newResult);
			$this->clear();
			
			array_push($updatedList,array(	'id'		=> $teamList[$i]['id'],
											'name' 		=> $teamList[$i]['name'],
											'subject' 	=> $teamList[$i]['subject'],
											'prize' 	=> $teamList[$i]['prize'],
											'status' 	=> $teamList[$i]['status'],
											'result_id'	=> $i+$number+1));
		}
		
		return $updatedList;
	}
	
	
}