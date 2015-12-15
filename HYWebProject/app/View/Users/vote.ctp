 
<div id="logo">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/user_universityLogo.jpg" alt="hanyang_logo" />
</div>
      
<div id="logo_mini">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/audition.png" alt="sid_logo" />
</div>
 
 
 <div id="content">
    
    <h2><span class="label label-default">Vote</span></h2>
<?php

if($teams)
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
<?php echo $this->Form->end("submit"); ?>


<?php
}
else{
echo "The vote is not started yet! Please try later.";
}

?>
</div>

<?php
if (isset($message)){
    echo $message;
}
if (isset($res)){
   var_dump($res);
}

?>