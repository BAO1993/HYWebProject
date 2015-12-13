<?php

App::uses('AppModel', 'Model');

class Round extends AppModel
{
	public function checkRoundsStatus()
	{
		//We search all existing rounds
		$results = $this->find('all');
	
		//If there are no rounds existing
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
			
			return false;
			
		}
		//If there are existing rounds, we return a message that explains where we are in the election process.
		else 
		{
			$roundNumber = -1;
			
			for($i = 0; $i < count($results['Round']); $i++)
			{
				if($results['Round'][strval($i)] == "in progress")
				{
					return "Round #".$i." is currently in progress. Redirecting to next step...";
				}
				elseif($results['Round'][strval($i)] == "not started")
				{
					if($roundNumber == -1)
					{
						return "No round has been initiated yet. Next round is the #1";
					}
					else 
					{
						return "Round #".$roundNumber."is the last completed round. Next step is round #".$i;
					}
				}
				else
				{
					$roundNumber = $i;
				}
			}
			return $roundNumber;
		}
	}
	
	
}