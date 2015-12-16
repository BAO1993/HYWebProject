<?php

App::uses('AppModel', 'Model');

class TeamResult extends AppModel
{
	public function saveTeamResult($list, $round)
	{
		for($i = 0; $i < count($list); $i++)
		{
			$this->create();
			$newTeamResult = array(	'id_result' => $list[$i]['result_id'],
									'id_round' => $round, 
									'id_team' => $list[$i]['id']);
			
			$this->save($newTeamResult);
			$this->clear();
		}
	}
	
	
}