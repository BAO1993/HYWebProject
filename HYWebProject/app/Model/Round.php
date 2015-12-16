<?php

App::uses('AppModel', 'Model');

class Round extends AppModel
{
	public function checkRoundsStatus()
	{
		//We search all existing rounds
		$results = $this->find('all');
	
		//If there is no existing round
		if(empty($results))
		{
			//We create it
			for($i = 1; $i <= 11; $i++)
			{
				$this->create();
				
				$round = array('id'=>$i,'is_final'=>false);
				
				$this->save($round);
				$this->clear();
			}
			
			$this->create();
			$round = array('id'=>12,'is_final'=>true);
			$this->save($round);
			$this->clear();
			
			return array(	'case'=>0,
							'text'=>'It seems there is no election in progress. New election initialized.',
							'currentRound'=>1);
			
		}
		//If there are existing rounds, we return a message that explains where we are in the election process.
		else 
		{
			$roundNumber = -1;
			
			for($i = 1; $i <= count($results); $i++)
			{
				if($results[$i-1]['Round']['status'] == "in progress")
				{
					return array(	'case'=>1,
									'text'=>"Round #".$i." is currently in progress. Redirecting to next step...",
									'currentRound'=>$i);
				}
				elseif($results[$i-1]['Round']['status'] == "not started")
				{
					if($roundNumber == -1)
					{
						return array(	'case'=>2,
										'text'=>"No round has been initiated yet. Next round is the #1",
										'currentRound'=>1);
					}
					else 
					{
						return array(	'case'=>3,
										'text'=>"Round #".$roundNumber."is the last completed round. Next step is round #".$i,
										'currentRound'=>$i);
					}
				}
				else
				{
					$roundNumber = $i;
				}
			}
			return $roundNumber;//If there is an error...
		}
	}
	
	//Save the invitation code of the current round
	public function saveCode($code,$currentRound)
	{
		$this->read(null, $currentRound);
		$this->set('inv_code', $code);
		$this->save();
		$this->clear();
	}
	
	public function enableElection($currentRound)
	{
		$this->read(null, $currentRound);
		$this->set('status', 'in progress');
		$this->save();
		$this->clear();
	}
	
	public function closeThisRound($currentRound)
	{
		$this->read(null, $currentRound);
		$this->set('status', 'terminated');
		$this->save();
		$this->clear();
	}
	
	public function isCurrentRoundFinal($currentRound)
	{
		$tmp = $this->find('first',array('conditions' => array('id' => $currentRound),'fields' => array('is_final')));
		
		return $tmp['Round']['is_final'];
	}
	
	
	
}









