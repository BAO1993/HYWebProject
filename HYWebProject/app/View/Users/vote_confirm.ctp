<?php

echo "Thank you for your participation.";

//echo $this->Html->link('Log out', array('controller'=> 'Users', 'action'=>'logout'), array( 'class' => 'button')); 

echo $this->Html->link($this->Form->button('Log out'), array('controller'=> 'Users', 'action'=>'logout'), array('escape'=>false,'title' => "Click to view somethin"));

?>
