 
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
          
          $options [$value['Team']['id_team']]= $value['Team']['name']." : ".$value['Team']['subject'];
       }

$attributes = array('legend' => false);
?>
<div id="vote"><?php echo $this->Form->radio('Team', $options, $attributes); ?></div>
<?php echo $this->Form->end("submit"); ?>


<?php
}
else{
echo "The vote is not disponible for the moment! Please try later.";
}
?>
</div>

<?php
if (isset($message)){
    echo $message;
}


?>