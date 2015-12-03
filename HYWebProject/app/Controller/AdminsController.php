<?php 

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');
//App::uses('CakeEmail', 'Network/Email'); We will need it if we use email to enable someone to register for example

class AdminsController extends AppController
{
	public $uses = array('Admin');
	
	public function admin_login()
    {
        //We check if the user pressed the submit button
        if ( isset($this->request->data['adminLoginForm']))
		{
			//We collect the user login and password
			$login = $this->request->data['adminLoginForm']['id'];
			$pw = $this->request->data['adminLoginForm']['password'];
			
			//We check if the login and the password matches with a row of the database
            if(/*$this->Player->checkLogin($login, $pw)*/true)
            {
                $user_name = "Bob";
				
				//$datas = $this->Player->find('first', array('conditions' => array('email' => $this->request->data['Login']['login'])));
                //$this->Session->write('Connected',$datas['Player']['id']);
                $this->set('status', "Connected. Welcome " + $user_name);
                //$this->redirect('choose');
            }
            else
            {
				$this->set('status', "Wrong login information. Try again or consult an administrator");
                //$this->set('Confirmation', "Identifiants incorrects !");
            }
        }
        
        
    }
	
	
	
	
}