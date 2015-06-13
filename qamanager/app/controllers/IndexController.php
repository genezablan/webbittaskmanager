<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
    	$this->view->setVar('page_content','home/index');
    }

}

