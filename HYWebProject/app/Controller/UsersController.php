<?php

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

class UsersController extends AppController
{
	public $uses = array('User','Team','Round','Result');
	
	public function access_denied(){
		
	}

	public function user_login(){
		
	/*	$mobile = FALSE;
		$user_agent = array('iPhone', 'Android', 'iPod', 'iPad');
		
		foreach ($user_agent as $usr)
		{
			if (strpos($_SERVER['HTTP_USER_AGENT'], $usr) !== FALSE)
			{
				$mobile = TRUE;
				break;
			}
		}*/
		
		//à enlever
		//$mobile = FALSE;
	//	$mobile=true;
		
//		if($mobile)
//		{
//		$this->Session->write('Access',"true");
	//	error_log("function user_login: not denied");
		
			if( isset($this->request->data['Login'])){
			
				if(($this->User->checkLogin($this->request->data['Login']['department'],$this->request->data['Login']['name'])) == true)
				{
					$datas = $this->User->find('first', array('conditions' => array('name' => $this->request->data['Login']['name'])));
					$this->Session->write('Info',$datas['User']['id_user']);
					$this->redirect('invitation');
				}
				else
				{
					$this->set('message', "Incorrect information, please try again");
				}
	
			}
		
	/*	}
		else
		{
			$this->Session->write('Access',"false");
			error_log("function user_login:denied");
			$this->redirect('access_denied');
		}*/
		
		
	}
	
	public function invitation(){
		
		if( isset($this->request->data['Code'])){
			$user_id = $this->Session->read('Info');
			$user=$this->User->find('first', array('conditions' => array('id_user' => $user_id)));
		    $this->set("info",$this->User->checkCode($user['User']['dept'],$user['User']['name'],$this->request->data['Code']['invitation_code']));
		    
			if($this->User->checkCode($user['User']['dept'],$user['User']['name'],$this->request->data['Code']['invitation_code']) == 1)
			{
				
				$this->Session->write('Connected',$user['User']['id_user']);
				$this->redirect('team');
				
			}
			else
			{
				$this->set('message', "Wrong code, please try again");
			}
		
		}
		
	}
	
	
	public function team(){
		
		//checker if there is round
		
	    $datas=$this->Team->find("all",array('conditions' => array( 'out_game' => "0")));
	    
		$this->set("teams",$datas);
		
	}
	
	public function vote(){
		
		//checker if the round is open
		if($this->Session->read('Voted')=="true")
		{
			$this->redirect('vote_confirm');
		}
		else{
		
		$round=$this->Round->find('first', array('conditions' => array( 'status' => "in_progress")));
		if($round)
		{
		
		$datas=$this->Team->find("all",array('conditions' => array( 'out_game' => "0"))); 
		$this->set("teams",$datas);
		

		if(isset($this->request->data['Team'])){
			
			$round=$this->Round->find('first', array('conditions' => array( 'status' => "in_progress")));
			$team_id= $this->request->data['Team']['id'];
			$round_id= $round["Round"]["id"];
			$team_result=$this->Round->query("SELECT * FROM team_results where id_round=$round_id and id_team=$team_id;");
			$result=$this->Result->findById($team_result[0]["team_results"]["id_result"]);
			$prize=$result['Result']['prize']+$this->request->data['Team']['prize'];
			$data = array('id' => $team_result[0]["team_results"]["id_result"], 'prize' => $prize);
			$this->Result->save($data);
			
			$user_id=$this->Session->read('Connected');
			$us = array('id_user' => $user_id, 'voted' => '1');
			$this->User->save($us);
			
			$this->Session->write('Voted',"true");
			$this->redirect('vote_confirm'); 
		//	$this->set('res',$round);
			
			}
		  }
		}
	}
	
	public function vote_confirm(){
	
		if( isset($this->request->data['Logout'])){

		$this->redirect('logout');

		}
	
	}
	
	public function logout(){
		
	$this->Session->delete('Connected');
	$this->Session->delete('Info');
	$this->Session->delete('Voted');
	}
	
	public function beforeFilter()
	{
		$id_connec = $this->Session->read('Connected');
		$id_info = $this->Session->read('Info');
		$vote = $this->Session->read('Voted');
/*		$access=$this->Session->read('Access');
		error_log("beforefilter:".$access);

		if($access == "false" && $this->request->params['action'] != 'access_denied')
		{
			$this->redirect(array('controller' => 'Users', 'action' => 'access_denied'));
		}
		
		
	
			if($access=="true" && $id_info == NULL && $this->request->params['action'] != 'user_login')
			{
				$this->redirect(array('controller' => 'Users', 'action' => 'user_login'));
			}
	
				
			if($access=="true" && $id_info != NULL && $id_connec == NULL && $this->request->params['action'] != 'invitation' )	
			{
				//error_log("beforeFilter:".$id_connec);
				$this->redirect(array('controller' => 'Users', 'action' => 'invitation'));
			}*/
		
		
		if($id_info == NULL && $this->request->params['action'] != 'user_login')
		{
			$this->redirect(array('controller' => 'Users', 'action' => 'user_login'));
		}
			
		if($id_info != NULL && $id_connec == NULL && $this->request->params['action'] != 'invitation' )
		{
			//error_log("beforeFilter:".$id_connec);
			$this->redirect(array('controller' => 'Users', 'action' => 'invitation'));
		}
		
		

	}
	
}

?>
