<?php
# *****************************************************
# Author 	: Qambar Raza
# Add-on 	: Facebook Wall V1.0
# Desc 		: This class demonstrates the use of the 
#			  agiletoolkit add-on "facebookwall" 
#			  which sends a message to user's wall.
# *******************************************************

class page_index extends Page {
    function init(){
        parent::init();
		
		$this 
			->js()->_load('mychain');
		
		$fb = $this->add('facebookwall/FacebookWall');
		
		$this->add('H1')->set('ELEXU - Facebook Wall Message Sender');
		$this->add('HR');
		
			
		if (!$fb->isLoggedIn() && 0) {
			$this->add('H2')->set('Step 1:');
			$this->add('Text')
				->set('If you haven\'t logged in to facebook yet then ');
			$this->add('View')
				->setElement('a')
				->setAttr('href',$fb->getLoginUrl())
				->set('click here.');
		} else {
			
			
			$this->add('Text')
				->set('When you are finished with it then ');
			$this->add('View')
				->setElement('a')
				->setAttr('href',$fb->getLogoutUrl())
				->set('click here.');
	 
		//	$this->add('H2')->set('Step 2:');
			$form=$this->add('Form');
			
			if (!$this->recall('friendsList')) {
				$this->memorize('friendsList', $fb->getFriends());
				$friendsList = $this->recall('friendsList');
			} else {
				$friendsList = $this->recall('friendsList');
			}
		
			
			$friendDropDown = $form->addField('dropdown','Friend')->setValueList($friendsList);
		//	$form->addField('Line','URL')->set("http://www.facebook.com/pages/elexu/213643148651735");
			$form->addField('Text','Message')->set("Please join Elexu, its a social network with entertaining interactive competitions. Young aspiring minds have the opportunity to link with sponsors, funds & info for success!");
			
			

			
			//Hidden Field to check submission method
			$sendToSpecific = $form
								->addField('hidden','Send_to_Specific')
								->set(1);
								//->setValue("1");
			
			//Hidden Field to keep count
			$friendSentCount = $form
								->addField('hidden','Friend_Sent_Count')
								->set(0);
			
			//My custom form submit 
			$sendButton = $form
						->add("Button")
						->setLabel("Sent to Selected");
			//$sendButton->js('click', $sendToSpecific->js(true)->val("1"));
			

			$sendButton->js('click', $form
										->js()
										->univ()
										->changeValueAndSubmit($sendToSpecific, 1, $sendButton
										));
										
										
			/******/
			
			//My Send To All Button
			$sendToAll = $form
						->add("Button")
						->setLabel("Send to All");
			
			$sendToAll->js('click', $form
										->js()
										->univ()
										->changeValueAndSubmit($sendToSpecific, 0, $sendButton
										));
			/*
			$sendToAll->js('click', $sendToSpecific->js(true)->val("0"));
			$sendToAll->js('click', $form->js(true)->submit());
			*/
			/********/
			/*
			$form
					->js()
					->univ()
					->changeValueAndSubmit($sendToSpecific, 0, $sendButton)	;
			
			*/
			
			if($form->isSubmitted()){
				//	$url 		= $form->get('URL'); //getURL
				//hardcoded URL
				$url 		= 'http://www.facebook.com/pages/elexu/213643148651735'; 
				
				$friend 				= $form->get('Friend');
				$message 				= $form->get('Message');
				$sendToSpecificValue	= $form->get('Send_to_Specific');
				
				
				
			/*	
				$form
										->js()
										->univ()
										->alert($sendToSpecificValue)
										->execute();
		*/
				
				if ($sendToSpecificValue  ==  0){
						//$friendsList = $this->recall('friendsList');
				
						$fb->postMessageOnWall($friend, $message, $url);
						$friendCount = $form->get('Friend_Sent_Count'); 
						
						
						$form
							->js()
							->univ()
							->selectNewFriendAndSubmit($friendDropDown, $friendCount, $friendSentCount, $form)
							->execute();
							
							
				} else if ($sendToSpecificValue  ==  1) {
				
					$fb->postMessageOnWall($friend, $message, $url);
					$form
					->js()
					->univ()
					->alert("Message Sent to selected friend !")
					->execute();
				}
				
				
				//
				
				$form
					->js(true)->alert("test");
				
				
				/*
				$form
					->js()
					->univ()
					->alert($fb->postMessageOnWall($friend, $message, $url))
					->execute();
					*/
					
			} 
		}
	}
	function defaultTemplate(){
		return array('index');   // uses templates/default/greeting.html
	}
	
	
}

?>