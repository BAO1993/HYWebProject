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
        //We check if the user pressed the submit button
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
    			
    		case 'View':$this->finalResults();
			    		$hl['6'] = 'id="Highlight"';
			    		$this->set('hl',$hl);
    			break;
    	}
    }
    
    private function setup()
    {
    	
    	//If the admin clic on the submit button
    	if(isset($this->request->data['SetupForm']))
    	{
    		$form = $this->request->data['SetupForm'];
    	
    		if($form['Invitation code'])
    		{
    			$this->Session->write('currentStep',$this->Session->read('nextStep'));
    			
    			$this->set('formStatus', "The following invitation code has been saved: ".$form['Invitation code']);
    			
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
    				$this->Session->write('currentRound',1);
    			break;
    		
    		//if there is a round in progress
    		case 1:	$this->set('roundStatus', $rs['text']);
    				$this->Session->write('nextStep','Audience');
    				$this->Session->write('currentRound',$rs['currentRound']);
    				$this->redirect('mainView');
    			break;
    			
    		//there are existing rounds but all are "not started"
    		case 2:	$this->set('roundStatus', $rs['text']);
    				$this->Session->write('nextStep','Entry List');
    				$this->set('formStatus', 'Please write an invitation code in the field below.');
    				$this->Session->write('currentRound',1);
    			break;
    			
    		//there are existing rounds and some of them are "terminated"
    		case 3: $this->set('roundStatus', $rs['text']);
    				$this->Session->write('nextStep','Audience');
    				$this->Session->write('currentRound',$rs['currentRound']);
    	}
    	
    }
    
    private function entryList()
    {
    	if(isset($this->request->data['NumberEntryForm'])
    	{
    		
    	}
    	
    	
    	//If admin clic on the Set button, we check if he wrote a positive integer number inferior or equal to 15
    	if(isset($this->request->data['NumberEntryForm']) 
    			&& preg_match('/\d{1,2}/',$this->request->data['NumberEntryForm']['Number of teams'])
    			&& $this->request->data['NumberEntryForm']['Number of teams'] <= 15)
    	{
    		$this->Session->write('numberOfTeams',$this->request->data['NumberEntryForm']['Number of teams']);
    		
    	}
    }
    
    private function audience()
    {
    	 
    }
    
    private function audition()
    {
    
    }
    
    private function election()
    {
    
    }
    
    private function finalResults()
    {
    
    }
	
	
	
	
}