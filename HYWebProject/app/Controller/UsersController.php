<?php

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

class UsersController extends AppController
{
	public $uses = array('User');
	
/*	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
	$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
	$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	
	if($iphone || $android || $palmpre || $ipod || $berry || $ipad == true)
	{
		header('Location: mobile');
	}*/
	
	public function user_login(){
		
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
		
		
	}
	
	public function invitation(){
		
		if( isset($this->request->data['Code'])){
			$user_id = $this->Session->read('Info');
			$user=$this->User->find('first', array('conditions' => array('id_user' => $user_id)));
		    $this->set("info",$this->User->checkCode($user['User']['dept'],$user['User']['name'],$this->request->data['Code']['invitation_code']));
		    
			if($this->User->checkCode($user['User']['dept'],$user['User']['name'],$this->request->data['Code']['invitation_code']) == 1)
			{
				$this->Session->write('Connected',$datas['User']['id_user']);
			
				$this->redirect('vote');
			}
			else
			{
				$this->set('message', "Wrong code, please try again");
			}
		
		}
		
	}
	
	public function vote(){
	
	/*	if( isset($this->request->data['Code'])){
			$user_id = $this->Session->read('Info');
			$user=$this->User->find('first', array('conditions' => array('user_id' => $user_id)));
	
			if(($this->User->checkCode($datas['User']['dept'],$datas['User']['name'],$this->request->data['Code']['invitation_code'])) == true)
			{
				$this->Session->write('Connected',$datas['User']['id_user']);
					
				$this->redirect('vote');
			}
			else
			{
				$this->set('message', "Wrong code, pease try again");
			}
	
		}*/
	
	}
	
	public function vote_confirm(){
	
		if( isset($this->request->data['Logout'])){

		$this->redirect('logout');

		}
	
	}
	
	public function logout(){
		
	$this->Session->delete('Connected');
	$this->Session->delete('Info');
	}
	
	public function beforeFilter()
	{
		$id_connec = $this->Session->read('Connected');
		$id_info = $this->Session->read('Info');
	
	/*	if($id_info == NULL && $this->request->params['action'] != 'user_login')
		{
			$this->redirect(array('controller' => 'Users', 'action' => 'user_login'));
		}
		else if($id_connec == NULL && $this->request->params['action'] != 'invitation')
		{
			$this->redirect('invitation');
		}
		else if($id_connec != NULL && $this->request->params['action'] == 'vote' )
		{
			$this->redirect('vote');
		}
		else if($id_connec != NULL && $this->request->params['action'] == 'logout' )
		{
			$this->redirect('logout');
		}
		else {
			$this->redirect('died');
		}*/
	}
	
}