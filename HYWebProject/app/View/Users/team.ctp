
<div id="logo">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/user_universityLogo.jpg" alt="hanyang_logo" />
</div>
      
<div id="logo_mini">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/audition.png" alt="sid_logo" />
</div>
  
<div class="list">
    <h2><span class="label label-default">Team list</span></h2>
    
    
<?php

if($teams)
{ ?>
<ul>
<?php for($i=0;$i<count($teams);$i++) { //var_dump($value); ?>
          
     <li> <?php echo "  ".$teams[$i]['Team']['name']." : ".$teams[$i]['Team']['subject'];  ?> </li>
 
<?php } ?>
</ul>
<?php
}
else{ ?>

<p><?php echo "The team list is empty!"; ?></p>


<?php
} ?>


<?php

echo $this->Html->link($this->Form->button('Next'), array('controller'=> 'Users', 'action'=>'vote'), array('escape'=>false,'title' => "vote"));

?>

</div>
