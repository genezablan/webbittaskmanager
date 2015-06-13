<?php

class TeamController extends ControllerBase
{
    public function viewAction($name,$team_id)
    {
    	
    	$this->view->setVar('page_content','team/view');
    }
}

