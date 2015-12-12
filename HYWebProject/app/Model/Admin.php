<?php

App::uses('AppModel', 'Model');

class Admin extends AppModel 
{
	public function checkLoginInfo($login, $password, $ip_address)
	{
		$hash = Security::hash($password);
		
		//We send a query in order to find an admin having the login information received
        $results = $this->find('first', array('conditions' => array('login' => $login, 
													        		'password' => $hash, 
													        		'ip' => $ip_address)));
		
		//If the login, the password and/or the ip is not correct, the $results should be empty and false returned.
		return !empty($results);
    }
	
    
    public function changePassword($login, $oldPassword, $newPassword)
    {
    	//We search the line refering to the $login received
    	$results = $this->find('first', array('conditions' => array('login' => $login)));
    	
    	//We hash the old password to compare it with the hash stored in the database
    	$oldHash = Security::hash($oldPassword);
    	
    	//We compare the hash of the $oldPassword received with the one stored in the database
    	if(empty($results) || $results['Admin']['password'] != $oldHash)
    	{
    		return false;
    	}
    	else
    	{
    		//new password is hashed
    		$newHash = Security::hash($newPassword);
    		
    		//The password is updated in the database
    		$this->read(null, $results['Admin']['id']);
    		$this->set('password', Security::hash($newPassword));
    		$this->save();
    			
    		return true;
    	}
    }
	
	
	
}