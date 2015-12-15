
<div id="logo">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/user_universityLogo.jpg" alt="hanyang_logo" />
</div>
      
<div id="logo_mini">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/audition.png" alt="sid_logo" />
</div>

<div class="list">
<?php

echo "Thank you for your participation.";

//echo $this->Html->link('Log out', array('controller'=> 'Users', 'action'=>'logout'), array( 'class' => 'button')); 

echo $this->Html->link($this->Form->button('Log out'), array('controller'=> 'Users', 'action'=>'logout'), array('escape'=>false,'title' => "Click to view somethin"));

?>
</div>