<?php

App::uses('AppModel', 'Model');

class Team extends AppModel
{
	public function saveTeam($teamsList)
	{
		for($i = 0; $i < count($teamsList)/2; $i++)
		{
			$this->create();
			$newTeam = array('name'=>$teamsList['teamName'.strval($i)],'subject'=>'subject'.strval($i));
			$this->save($newTeam);
		}
		
	}
	
	
}