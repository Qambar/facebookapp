<?php
class Frontend extends ApiFrontend {
    function init(){
        parent::init();

		$this->add('BasicAuth');
		
       // $this->dbConnect();
        $this->requires('atk','4.2.0');

        $this->addLocation('atk4-addons',array(
            'php'=>array(
                'mvc',
                'misc/lib',
                'facebookwall/lib',
            )
        ))
        ->setParent($this->pathfinder->base_location);

        $this->add('jUI');

        $this->js()
            ->_load('atk4_univ')
            ->_load('ui.atk4_notify')
        ;

        $menu=$this->add('Menu',null,'Menu');

        $menu->addMenuItem('','Home');
        $menu->addMenuItem('logout');

    }

}