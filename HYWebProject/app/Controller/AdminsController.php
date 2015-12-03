<?php 

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');
//App::uses('CakeEmail', 'Network/Email'); We will need it if we use email to enable someone to register for example

class AdminsController extends AppController
{
	public $uses = array('Admin');
	
	public function adminLogin()
    {
        //We check if the user pressed the submit button
        if(isset($this->request->data['adminLoginForm']))
		{
			//We collect the user login and password
			$login = $this->request->data['adminLoginForm']['id'];
			$pw = $this->request->data['adminLoginForm']['password'];
			//TO DO: find a way to get the ip of the admin
			$ip = "166.104.XXX.XXX";
			
			//We check if the login and the password matches with a row of the database
            if($this->Admin->checkLoginInfo($login, $pw, $ip))
            {
                $user_name = "Bob";
				
                //The information are correct, so we send to the View
                //a String called "status" with the value "Connected. Welcome !"
                $this->set('status', "Connected. Welcome !");
                
                //We write the login of the admin into a session variable named "Connected"
                //By doing that, the server can remember the admin is connected.
                $this->Session->write('Connected',$login);
                
                //We redirect the admin to next page (the Setup page)
                //Here, 'setup' is the name of the function of the AdminController
                //that manages the Setup page.
                $this->redirect('setup');
            }
            else
            {
            	//If the information are wrong, we send to the View 
				//a String called "status" with the value "Wrong login information."
				$this->set('status', "Wrong login information.");
            }
        }
        
    }
    
    public function setup()
    {
    	
    	$round = $this->request->data['setupForm']['round'];
    	$round_number = $this->request->data['setupForm']['number'];
    }
	
	
	
	
}