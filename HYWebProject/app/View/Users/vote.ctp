 
<div id="logo">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/user_universityLogo.jpg" alt="hanyang_logo" />
</div>
      
<div id="logo_mini">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/audition.png" alt="sid_logo" />
</div>
 
 
 <div class="list">
    
    <h2><span class="label label-default">Vote</span></h2>
<?php

if(isset($teams))
{ ?>


<?php

$options = array();
       foreach ($teams as $value) {
          
          $options [$value['Team']['id']]= $value['Team']['name']." : ".$value['Team']['subject'];
       }

$attributes = array('legend' => false,'default'=>'1');
?>

<?php echo $this->Form->create('Team');?>
<div id="vote"><?php echo $this->Form->radio('id', $options, $attributes); ?></div>
<div id="vote"><?php echo $this->Form->input('prize'); ?></div>
<?php if (isset($message)){ ?>
<p class="warning"><?php echo $message; ?></p>
<?php } ?>
<?php echo $this->Form->end("submit"); ?>


<?php
}
else{
echo "The vote is not started yet! Please try later.";
echo $this->Html->link($this->Form->button('Log out'), array('controller'=> 'Users', 'action'=>'logout'), array('escape'=>false,'title' => "Click to view somethin"));

}

?>




</div>