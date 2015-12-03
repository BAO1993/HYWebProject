

<div id="logo">
	<img src="logo.png" alt="Sid logo" />
</div>


<?php
if (isset($status))
{
    echo $status;
}
?>


<?php 
//Form creation with the CakePHP class "Form":

echo $this->Form->create('AdminLoginForm');
echo $this->Form->input('id');
echo $this->Form->input('password');
echo $this->Form->end('Submit');

?>

<!-- 
This code is almost the same than the following but here it is better to use CakePHP
functions.
-->


<!-- 
<form action="myController.php" method="post" id="form">

	<p>
	ID:<input type="text" name="id"/>
	</p>
	<p>
	Password:<input type="text" name="password"/>
	</p>
	
	<input type="submit" name="login" value="Login"/>
</form>
-->