<div id="logo">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/hanyang_logo.png" alt="Sid logo" />
</div>

<div>
    
    <h2><span class="label label-default">Invitation code</span></h2>
<?php


echo $this->Form->create('Code');
echo $this->Form->input('invitation_code');
echo $this->Form->end('Connexion');

?>
</div>

<?php
if (isset($message)){
    echo $message;
}
if (isset($info)){
    echo $info;
}
?>