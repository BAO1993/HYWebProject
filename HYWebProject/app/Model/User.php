<?php

App::uses('AppModel', 'Model');


class User extends AppModel 
{
	public function checkLogin($dept, $name)
	{
	
        $results = $this->find('count', array('conditions' => array('dept' => $dept,'name' => $name)));

		if($results!=0)
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
	
	
	
}
>>>>>>> branch 'master' of https://github.com/BAO1993/HYWebProject
