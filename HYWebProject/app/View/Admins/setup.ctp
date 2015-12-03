<header>
            <div id="headerwrap">
                <div id="Highlight">1. Setup</div>
                <div>2. Entry List</div>
                <div>3. Audience</div>
                <div>4. Audition</div>
                <div>5. Election</div>
                <div>6. View</div>
				
				<div id="welcome">
						Welcome, Admin ...
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
	
	echo $this->Form->create('formSetup');
	
	echo $this->Form->input('round', array('options' => array(	'Qualifying'=>'Qualifying Round',
																		'Final'=>'Final round')));

	echo $this->Form->input('round Number', array('options' => array(	'1'=>'1',
																		'2'=>'2',
																		'3'=>'3')));

	echo $this->Form->input('Invitation code');

	echo $this->Form->end('Setup');
	?>
