 
 
 
 <div>
    
    <h2><span class="label label-default">Vote</span></h2>
<?php

if($teams)
{

$options = array();
       foreach ($teams as $value) {
          
          $options [$value['Team']['id_team']]= $value['Team']['name']." : ".$value['Team']['subject'];
       }

$attributes = array('legend' => false);
echo $this->Form->radio('Team', $options, $attributes);
echo $this->Form->end("submit");
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