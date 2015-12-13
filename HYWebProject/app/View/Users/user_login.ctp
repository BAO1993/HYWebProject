<div id="logo">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/hanyang_logo.png" alt="Sid logo" />
</div>

<div>
    
    <h2><span class="label label-default">Connection</span></h2>
<?php


echo $this->Form->create('Login');
echo $this->Form->input('department');
echo $this->Form->input('name');
echo $this->Form->end('Connexion');

?>
</div>

<?php
if (isset($message)){
    echo $message;
}

?>