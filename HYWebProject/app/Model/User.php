<?php

App::uses('AppModel', 'Model');


class User extends AppModel 
{
	public function checkLogin($dept, $name)
	{
	
        $results = $this->find('count', array('conditions' => array('dept' => $dept,'name' => $name)));
   
		if($results!=0 )
		{
			return true;
		}
		else{
			return false;
		}
    }
    
    public function checkVote($dept, $name)
    {
    	$results = $this->find('first', array('conditions' => array('dept' => $dept,'name' => $name)));
    	 
    	if($results['User']['voted']=="0" )
    	{
    		return true;
    	}
    	else{
    		return false;
    	}
    }
	
    
    public function checkCode($dept, $name, $code)
    {
    	$results = $this->find('count', array('conditions' => array('dept' => $dept,'name' => $name,'inv_code' => $code)));
    	
    /*	if($results!=0)
    	{
    		return true;
    	}
    	else{
    		return false;
    	}*/
    	
    	return $results;
    }
    
    public function checkPresence($id)
    {
    	$results = $this->findById($id);
    	 
    	if($results["User"]["confirm"]=="1")
    	{
    	return true;
    	}
    	else{
    	return false;
    	}
    	
    }
    
    
    public function saveUsers($usersList, $code)
    {
    	//First we delete all previous users    
    	$this->query('TRUNCATE TABLE users;');
    
    	//Then, we stored each new user inside the users table.
    	for($i = 0; $i < count($usersList)/3; $i++)
    	{
    		$attendance = false;
    		
    		if($usersList['check'.strval($i)] == "1")
    		{
    			$attendance = true;
    		}
    		
    		$this->create();
    		$newUser = array(	'name'=>$usersList['name'.strval($i)],
    							'dept'=>$usersList['department'.strval($i)],
    							'inv_code'=>$code,
    							'confirm'=>$attendance);
    		$this->save($newUser);
    		$this->clear();
    	}
    
    }
    
    
	
	
	
}

