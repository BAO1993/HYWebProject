
<div id="logo">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/user_universityLogo.jpg" alt="hanyang_logo" />
</div>
      
<div id="logo_mini">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/audition.png" alt="sid_logo" />
</div>




<?php echo $this->Form->create('Login');?>
<p><?php echo $this->Form->input('department');?></p>
<p><?php echo $this->Form->input('name');?></p>
<?php echo $this->Form->end('Connexion');?>




<?php
if (isset($message)){
    echo $message;
}

?>