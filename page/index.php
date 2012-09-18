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
		
		$fb = $this->add('facebookwall/FacebookWall');
		
		$this->add('H1')->set('ELEXU - Facebook Wall Message Sender');
		$this->add('HR');
		
		if (!$fb->isLoggedIn()) {
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
	 
			$this->add('H2')->set('Step 2:');
			$form=$this->add('Form');
			
			$form->addField('dropdown','Friend')->setValueList($friendsList);
			$form->addField('Line','URL')->set("http://www.facebook.com/pages/elexu/213643148651735");
			$form->addField('Text','Message')->set("Please join Elexu, its a social network with entertaining interactive competitions. Young aspiring minds have the opportunity to link with sponsors, funds & info for success!");
			
			$form->addSubmit()->Set("Send");
			
			if($form->isSubmitted()){
				$friend 	= $form->get('Friend');
				$url 		= $form->get('URL');
				$message 	= $form->get('Message');
				$form
					->js()
					->univ()
					->alert($fb->postMessageOnWall($friend, $message, $url))
					->execute();
			}
		}
	}
	
	
}

?>