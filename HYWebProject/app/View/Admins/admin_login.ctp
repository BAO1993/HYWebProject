

<div id="logo">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/hanyang_logo.png" alt="Sid logo" />
</div>


<?php
if (isset($status))
{
    echo $status;
}
?>

<!-- Form creation with the CakePHP class "Form": -->

<?php echo $this->Form->create('AdminLoginForm');?>

<p>
	<?php echo $this->Form->input('id');?>
</p>
<p>
	<?php echo $this->Form->input('password');?>
</p>

<?php echo $this->Form->end('Submit');?>



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