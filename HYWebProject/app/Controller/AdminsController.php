<?php 

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');
//We will need it if we use email to enable someone to register for example
//App::uses('CakeEmail', 'Network/Email'); 

class AdminsController extends AppController
{
	public $uses = array('Admin','Round','User','Result','Team');
	
	public function adminLogin()
    {    	
        //We check if the user clicks the submit button
        if(isset($this->request->data['AdminLoginForm']))
		{
			//We collect the user login and password
			$login = $this->request->data['AdminLoginForm']['id'];
			$pw = $this->request->data['AdminLoginForm']['password'];
			
			//TO DO: find a way to get the ip of the admin "166.104.XXX.XXX"
			$ip = "42.42.42.42";
			
			//We check if the login and the password matches with a row of the database
            if($this->Admin->checkLoginInfo($login, $pw, $ip))
            {
                //The information are correct, so we send to the View
                //a String called "status" with the value "Connected. Welcome !"
                $this->set('status', "Connected. Welcome !");
                
                //We write the login of the admin into a session variable named "Connected"
                //By doing that, the server can remember the admin is connected.
                $this->Session->destroy();
                $this->Session->write('connectedAdmin',$login);
                
                $this->Session->write('currentStep','Setup');
                
                //We redirect the admin to next page (the Setup page)
                //Here, 'setup' is the name of the function of the AdminController
                //that manages the Setup page.
                $this->redirect('mainView');
            }
            else
            {
            	//If the information are wrong, we send to the View 
				//a String called "status" with the value "Wrong login information."
				$this->set('status', "Wrong login information.");
            }
        }
        
    }

    
    public function mainView()
    {
    	$this->set('adminLogin', $this->Session->read('connectedAdmin'));
    	$this->set('currentStep', $this->Session->read('currentStep'));
    	
    	$hl = array();
    	for($i=1;$i<=6;$i++)
    	{
    		$hl[strval($i)] = '';
    	}
		$this->set('hl',$hl);
		
    	switch($this->Session->read('currentStep'))
    	{
    		case 'Setup':	$this->setup();
    						$hl['1'] = 'id="Highlight"';
    						$this->set('hl',$hl);
    			break;
    			
    		case 'Entry List':	$this->entryList();
    							$hl['2'] = 'id="Highlight"';
    							$this->set('hl',$hl);
    			break;
    				
    		case 'Audience':$this->audience();
				    		$hl['3'] = 'id="Highlight"';
				    		$this->set('hl',$hl);
    			break;
    			
    		case 'Audition':$this->audition();
				    		$hl['4'] = 'id="Highlight"';
				    		$this->set('hl',$hl);
    			break;
    			
    		case 'Election':$this->election();
				    		$hl['5'] = 'id="Highlight"';
				    		$this->set('hl',$hl);
    			break;
    			
    		case 'Result':$this->result();
			    		$hl['6'] = 'id="Highlight"';
			    		$this->set('hl',$hl);
    			break;
    	}
    }
    
    private function setup()
    {
    	//If the admin clicks on the submit button
    	if(isset($this->request->data['SetupForm']))
    	{
    		$form = $this->request->data['SetupForm'];
    	
    		if($form['Invitation code'])
    		{
    			$this->Session->write('currentStep',$this->Session->read('nextStep'));
    			$this->Round->saveCode($form['Invitation code'],$this->Session->read('currentRound'));
    			$this->Session->write('currentInvitationCode',$form['Invitation code']);
    			//$this->set('formStatus', "The following invitation code has been saved: ".$form['Invitation code']);
    			
    			$this->redirect('mainView');
    		}
    		else
    		{
    			$this->set('formStatus', "Please, file the Invitation code.");
    		}
    	}
    	
    	//We check if there are existing rounds, if no we create it.
    	$rs = $this->Round->checkRoundsStatus();
    	 
    	switch($rs['case'])
    	{
    		//if there are no existing rounds
    		case 0: $this->set('roundStatus', $rs['text']);
    				$this->set('formStatus', 'Please write an invitation code for round #1 in the field below.');
    				$this->Session->write('nextStep','Entry List');
    				$this->Session->write('currentRound',1);
    			break;
    		
    		//if there is a round in progress, it means that teams are already created and users already registered,
    		//we go to the Election step
    		case 1:	$this->set('roundStatus', $rs['text']);
    				$this->Session->write('currentStep','Election');
    				$this->Session->write('currentRound',$rs['currentRound']);
    				$this->redirect('mainView');
    			break;
    			
    		//there are existing rounds but all are "not started", it means we need to create teams
    		case 2:	$this->set('roundStatus', $rs['text']);
    				$this->Session->write('nextStep','Entry List');
    				$this->set('formStatus', 'Please write an invitation code in the field below. The audience will need to enter this code to login.');
    				$this->Session->write('currentRound',1);
    			break;
    			
    		//there are existing rounds and some of them are "terminated", it means teams are already created,
    		//we now need to register every users of the audience.
    		case 3: $this->set('roundStatus', $rs['text']);
    				$this->Session->write('nextStep','Audience');
    				$this->Session->write('currentRound',$rs['currentRound']);
    				$this->set('formStatus', 'Please write an invitation code in the field below. The audience will need to enter this code to login.');
    	}
    	
    }
    
    private function entryList()
    {
    	//If the number of team has already been set
    	if($this->Session->read('numberOfTeams') !== null)
    	{
    		$this->set('numberOfTeams',$this->Session->read('numberOfTeams'));
    	}
    	
    	
    	//If admin clicks on the Set button, we check if he wrote a positive integer number inferior or equal to 15
    	if(isset($this->request->data['NumberEntryForm']) 
    			&& preg_match('/\d{1,2}/',$this->request->data['NumberEntryForm']['Number of teams'])
    			&& $this->request->data['NumberEntryForm']['Number of teams'] <= 15)
    	{
    		$this->Session->write('numberOfTeams',$this->request->data['NumberEntryForm']['Number of teams']);
    		$this->redirect('mainView');
    	}
    	else
    	{
    		$this->set('formStatus','Please, enter a valid number of teams inferior or equal to 15.');
    	}
    	
    	//If admin clicks on the Save button, we check if he wrote something inside each field
    	if(isset($this->request->data['TeamsForm']))
    	{
    		$tform = $this->request->data['TeamsForm'];
    		$is_well_completed = true;
    		
    		for($i = 0; $i < count($tform)/2; $i++)
    		{
    			if($tform['teamName'.strval($i)] === "" || $tform['subject'.strval($i)] === "")
    			{
    				$is_well_completed = false;
    				$i = count($tform);
    			}
    		}
    		
    		if($is_well_completed)
    		{
    			$this->Team->saveTeams($tform);
    			
    			$this->Session->write('currentStep','Audience');
    			 
    			$this->redirect('mainView');
    		}
    		else
    		{
    			$this->set('formStatus','Please, file each Team Name and Subject fields correctly.');
    		}
    	}
    	
    }
    
    private function audience()
    {
    	//If the number of voting people has already been set
    	if($this->Session->read('numberOfVotingPeople') !== null)
    	{
    		$this->set('numberOfVotingPeople',$this->Session->read('numberOfVotingPeople'));
    	}
    	
    	//If admin clicks on the Set button, we check if he wrote a positive integer number inferior or equal to 15
    	if(isset($this->request->data['AudienceNumberForm'])
    			&& preg_match('/\d{1,2}/',$this->request->data['AudienceNumberForm']['number'])
    			&& $this->request->data['AudienceNumberForm']['number'] <= 20)
    	{
    		$this->Session->write('numberOfVotingPeople',$this->request->data['AudienceNumberForm']['number']);
    		$this->redirect('mainView');
    	}
    	else
    	{
    		$this->set('formStatus','Please, enter a valid number of voting people inferior or equal to 20.');
    	}
    	
    	//If admin clicks on the Save button, we check if he wrote something inside each field
    	if(isset($this->request->data['AudienceForm']))
    	{
    		$aform = $this->request->data['AudienceForm'];
    		$is_well_completed = true;
    	
    		for($i = 0; $i < count($aform)/3; $i++)
    		{
    			if($aform['name'.strval($i)] === "" || $aform['department'.strval($i)] === "")
    			{
    				$is_well_completed = false;
    				$i = count($aform);
    			}
    		}
    	
    		if($is_well_completed)
    		{
    			$this->User->saveUsers($aform,$this->Session->read('currentInvitationCode'));
    			 
    			$this->Session->write('currentStep','Audition');
    	
    			$this->redirect('mainView');
    		}
    		else
    		{
    			$this->set('formStatus','Please, file each Name and Departement Name fields correctly.');
    		}
    	}
    	
    	
    }
    
    private function audition()
    {
    	$teamList = $this->Team->find('all');
    	$this->set('numberOfTeams',count($teamList));
    	$this->set('teamList',$teamList);
    	
    	//If the admin clicks on the "save" button, we register the results of the audition 
    	if(isset($this->request->data['AuditionForm']))
    	{
    		$this->Team->checkIfNowOutOfGame($this->request->data['AuditionForm']);
    		$this->Round->enableElection($this->Session->read('currentRound'));
    		
    		$this->Session->write('currentStep','Election');
    		 
    		$this->redirect('mainView');
    	}
    	
    	
    
    }
    
    private function election()
    {    	 
    	$teamList = $this->Team->getTeamAndPrize();
    	
    	$this->set('teamList',$teamList);
    	$this->set('isFinal',$this->Round->isCurrentRoundFinal($this->Session->read('currentRound')));
    	
    	
    	//If the admin clicks on the "save" button, 
    	//we close the round and we send to final round teams which have their box checked.
    	if(isset($this->request->data['ElectionForm']))
    	{
    		$this->Round->closeThisRound($this->Session->read('currentRound'));
    	
    		$this->Team->sendToFinal($teamList, $this->request->data['ElectionForm']);
    		
    		$this->Session->write('currentStep','View');
    		 
    		$this->redirect('mainView');
    	}
    
    }
    
    private function result()
    {
    	$teamList = $this->Team->getTeamAndPrize();
    	 
    	$this->set('teamList',$teamList);
    }
	
	
	
	
}