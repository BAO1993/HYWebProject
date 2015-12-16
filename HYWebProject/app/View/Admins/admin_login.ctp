<?php echo $this->Html->css('admin'); ?>

<div id="logo">
	<img src="/HYWebProject/HYWebProject/app/webroot/img/audition.png" alt="Sid logo" />
</div>




<!-- Form creation with the CakePHP class "Form": -->

<?php echo $this->Form->create('AdminLoginForm');?>

<?php
if (isset($status))
{?>
    <p id="error_login"> <?=$status;?></p>
 <?php
}
?>

<p>
	<?php echo $this->Form->input('id');?>
</p>
<p>
	<?php echo $this->Form->input('password');?>
</p>

<?php echo $this->Form->end('Submit');?>

