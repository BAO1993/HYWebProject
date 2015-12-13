<?php

App::uses('AppModel', 'Model');

class Team extends AppModel
{
	public function saveTeam($teamsList)
	{
		//First we delete all previous teams
		//In order to do that, we need to drop the foreign key constraints we have on the team_results table
		$this->query('ALTER TABLE team_results DROP FOREIGN KEY fk_team;');
		
		$this->query('TRUNCATE TABLE teams;');
		//And then, we recreate the foreign key constraint
		$this->query('ALTER TABLE team_results ADD CONSTRAINT fk_team FOREIGN KEY (id_team) REFERENCES teams(id);');
		
		//Then, we stored each new team inside the teams table.
		for($i = 0; $i < count($teamsList)/2; $i++)
		{
			$this->create();
			$newTeam = array('name'=>$teamsList['teamName'.strval($i)],'subject'=>$teamsList['subject'.strval($i)]);
			$this->save($newTeam);
			$this->clear();
		}
		
	}
	
	
}