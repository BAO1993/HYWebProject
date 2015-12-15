<header>
            <div id="headerwrap">
                <div <?= $hl['1'] ?>>1. Setup</div>
                <div <?= $hl['2'] ?>>2. Entry List</div>
                <div <?= $hl['3'] ?>>3. Audience</div>
                <div <?= $hl['4'] ?>>4. Audition</div>
                <div <?= $hl['5'] ?>>5. Election</div>
                <div <?= $hl['6'] ?>>6. View</div>
				
				<div id="welcome">
						Welcome, <?= $adminLogin ?>
				</div>
				<div id="logout">
					<a href="Adminlogin.html">
							Log out
					</a>
				</div>
            </div>
			
			 <div id="home">
			 	<a href="Adminlogin.html">
			 		<img src="/HYWebProject/HYWebProject/app/webroot/img/home2.png" alt="Sid logo" />
			 	</a>
    		</div>
    </header>

	
<?php
	if (isset($formStatus))
	{?>
    	<p id="form_status"><?= $formStatus;?></p>
<?php
	}



//////////////////////////////////////////	Setup Form	/////////////////////////////////////////////
if($currentStep == 'Setup')
{
	echo $this->Form->create('SetupForm');
	
?>

	<p id="round_status"><?= $roundStatus ?></p>
	
<?php

echo $this->Form->input('round', array('options' => array(	'1'=>'Qualifying Round #1',
															'2'=>'Qualifying Round #2',
															'3'=>'Qualifying Round #3',
															'4'=>'Qualifying Round #4',
															'5'=>'Qualifying Round #5',
															'6'=>'Qualifying Round #6',
															'7'=>'Qualifying Round #7',
															'8'=>'Qualifying Round #8',
															'9'=>'Qualifying Round #9',
															'10'=>'Qualifying Round #10',
															'11'=>'Qualifying Round #11',
															'12'=>'Final round #12')));

/*echo $this->Form->input('round Number', array('options' => array(	'1'=>'1',
																		'2'=>'2',
																		'3'=>'3',
																		'4'=>'4',
																		'5'=>'5',
																		'6'=>'6',
																		'7'=>'7',
																		'8'=>'8',
																		'9'=>'9',
																		'10'=>'10',
																		'11'=>'11')));*/
	


	echo $this->Form->input('Invitation code');

	echo $this->Form->end('Next');
}

//////////////////////////////////////////	Entry List	/////////////////////////////////////////////
elseif($currentStep == 'Entry List')
{
	echo $this->Form->create('NumberEntryForm');

	echo $this->Form->input('Number of teams');

	echo $this->Form->end('Set');

	if(isset($numberOfTeams))
	{
		echo $this->Form->create('TeamsForm');

		for($i = 0; $i < $numberOfTeams; $i++)
		{?>
		<div class="team_input">
			<?php
			echo $this->Form->input('teamName'.strval($i),array('label'=>'Team Name'));
			echo $this->Form->input('subject'.strval($i),array('label'=>'Subject'));
			?>
		</div>
		
			<?php
		}
		echo $this->Form->end('Save');
	}
}


//////////////////////////////////////////	Audience	/////////////////////////////////////////////


elseif($currentStep == 'Audience')
{

	echo $this->Form->create('AudienceNumberForm');

	echo $this->Form->input('number',array('label'=>'Audience (How many people can vote ?)'));

	echo $this->Form->end('Set');


	if(isset($numberOfVotingPeople))
	{
		echo $this->Form->create('AudienceForm');

		for($i = 0; $i < $numberOfVotingPeople; $i++)
		{?>
		<div class="team_input">
			<?php
			echo $this->Form->input('name'.strval($i),array('label'=>'Name'));
			echo $this->Form->input('department'.strval($i),array('label'=>'Department'));
			echo $this->Form->checkbox('check'.strval($i));
			echo "Attendance"; 
			?>
		</div>
		
			<?php
		}
		echo $this->Form->end('Save');
	}
}

//////////////////////////////////////////	Audition	/////////////////////////////////////////////

elseif($currentStep == 'Audition')
{
	echo $this->Form->create('AudienceForm');

	for($i = 0; $i < $numberOfTeams; $i++)
	{?>
		<div class="team_input">
		
			<p>Team Name: <?= $teamList[$i]['Team']['name'] ?></p>
			<p>Subject: <?= $teamList[$i]['Team']['subject'] ?></p>
			
			<?php
			
			echo $this->Form->input('radio'.strval($i), array(	'label' => false,
																'legend' => false,
																'type' => 'radio',
																'value' => 0,
    															'options' => array('Pass', 'Fail')));

			?>
		</div>
		
			<?php
	}
	echo $this->Form->end('Save');

}


//////////////////////////////////////////	Election	/////////////////////////////////////////////

elseif($currentStep == 'Audition')
{
	//echo $this->Form->create('AudienceForm');

	for($i = 0; $i < $numberOfTeams; $i++)
	{?>
		<div class="team_input">
		
			<p>Team Name: <?= $teamList[$i]['Team']['name'] ?></p>
			<p>Subject: <?= $teamList[$i]['Team']['subject'] ?></p>
			<p>Prize: <?= $teamList[$i]['Team']['prize'] ?></p>
			
			<?php
			
			

			?>
		</div>
		
			<?php
	}
	//echo $this->Form->end('Save');

}




//////////////////////////////////////////	  View	   /////////////////////////////////////////////




?>























