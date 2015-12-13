<header>
            <div id="headerwrap">
                <div id="Highlight">1. Setup</div>
                <div>2. Entry List</div>
                <div>3. Audience</div>
                <div>4. Audition</div>
                <div>5. Election</div>
                <div>6. View</div>
				
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
	
	
	if (isset($status2))
	{
    	echo $status2;
	}

	
	echo $this->Form->create('SetupForm');
	
	?>
	<p><?= $roundStatus ?></p>
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

	echo $this->Form->end('Setup');
	?>
