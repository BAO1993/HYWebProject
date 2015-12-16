<?php

App::uses('AppModel', 'Model');

class Team extends AppModel
{
	public function saveTeams($teamsList)
	{
		//First we delete all previous teams
		//In order to do that, we need to drop the foreign key constraints we have on the team_results table
		//$this->query('ALTER TABLE team_results DROP FOREIGN KEY fk_team;');
		
		$this->query('TRUNCATE TABLE teams;');
		//And then, we recreate the foreign key constraint
		//$this->query('ALTER TABLE team_results ADD CONSTRAINT fk_team FOREIGN KEY (id_team) REFERENCES teams(id);');
		
		//Then, we stored each new team inside the teams table.
		for($i = 0; $i < count($teamsList)/2; $i++)
		{
			$this->create();
			$newTeam = array('name'=>$teamsList['teamName'.strval($i)],'subject'=>$teamsList['subject'.strval($i)]);
			$this->save($newTeam);
			$this->clear();
		}
		
	}
	
	public function checkIfNowOutOfGame($teamsListResults)
	{
		$dbTeamList = $this->find('all');
		
		for($i = 0; $i < count($teamsListResults); $i++)
		{
			//If the team failed...
			if($teamsListResults[$i]['radio'.strval($i)] == '1')
			{
				$this->read(null, $dbTeamList['Team']['id']);
				$this->set('out_game', true);
				$this->save();
				$this->clear();
			}
		}
	}
	
	public function getTeamAndPrize()
	{
		$list = array();
		
		$tl = $this->find('all');
		
		if(!empty($tl))
		{
			for($i = 0; $i < count($tl); $i++)
			{
				$id = $tl[$i]['Team']['id'];
				$prize = $this->query('SELECT prize FROM team_results tr,teams t,results r WHERE 
											t.id = '.$id.' AND 
											t.id = tr.id_team AND 
											tr.id_result = r.id');
				
				if($prize == array())
				{
					$prize = 0;
				}
				
				if($tl[$i]['Team']['out_game'] == true)
				{
					$status = 'Failed';
				}
				elseif($tl[$i]['Team']['in_final'] == true)
				{
					$status = 'Final';
				}
				else 
				{
					$status = 'Passed';
				}
				
				array_push($list,array(	'id'		=> $tl[$i]['Team']['id'],
										'name' 		=> $tl[$i]['Team']['name'],
										'subject' 	=> $tl[$i]['Team']['subject'],
										'prize' 	=> $prize,
										'status' 	=> $status));
			
			}
			
			return $list;
		}
		else
		{
			return null;
		}
		
	}
	
	public function sendToFinal($teamList,$form)
	{
		for($i = 0; $i < count($teamList); $i++)
		{
			if(isset($form[$teamList[$i]['name']]))
			{
				if($form[$teamList[$i]['name']] == '1')
				{
					$this->read(null, $teamList[$i]['id']);
					$this->set('in_final', true);
					$this->save();
					$this->clear();
				}
			}
		}
		
	}
	
}