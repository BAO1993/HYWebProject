<?php

App::uses('AppModel', 'Model');

class Admin extends AppModel 
{
	public function checkLoginInfo($login, $password, $ip_address)
	{
		//We send a query in order to find an admin having the login information received
        $results = $this->find('first', array('conditions' => array('id_admin' => $login, 
													        		'password' => $hash, 
													        		'ip' => $ip_address)));
		
        $hash = Security::hash($password);
		
		$loginStatus = 	$results['Admin']['id_admin'] ==  $login;
		$pwStatus = 	$results['Admin']['password'] ==  $hash;
		$ipStatus = 	$results['Admin']['ip'] ==  $ip_address;
		
		//If the login, the password and/or the ip is not correct, false is returned.
		return $loginStatus && $pwStatus && $ipStatus;
    }
	
	
	
	
}