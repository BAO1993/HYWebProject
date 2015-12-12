<?php 

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');
//We will need it if we use email to enable someone to register for example
//App::uses('CakeEmail', 'Network/Email'); 

class AdminsController extends AppController
{
	public $uses = array('Admin');
	
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
    	
    	if(isset($this->request->data['SetupForm']))
    	{
    		$this->setup($this->request->data['SetupForm']);
    	}
    	elseif(isset($this->request->data['EntryListForm']))
    	{
    		$this->entryList($this->request->data['EntryListForm']);
    	}
    	elseif(isset($this->request->data['AudienceForm']))
    	{
    	
    	}
    	elseif(isset($this->request->data['AuditionForm']))
    	{
    	
    	}
    	elseif(isset($this->request->data['ElectionForm']))
    	{
    		 
    	}
    	elseif(isset($this->request->data['ViewForm']))
    	{
    		 
    	}
    	
    	
    	
    }
    
    private function setup($form)
    {
    	$round = $form['round'];
    	$round_number = $form['round Number'];
    	
    	if($form['Invitation code'])
    	{
    		$this->set('status2', "The following invitation code has been saved: ".$form['Invitation code']);
    		
    		//We redirect the admin to next page (the Setup page)
    		//Here, 'setup' is the name of the function of the AdminController
    		//that manages the Setup page.
    		$this->redirect('mainView');
    	}
    	else 
    	{
    		$this->set('status2', "Please, file the form completely.");
    	}
    }
    
    private function entryList($form)
    {
    	
    }
	
	
	
	
}