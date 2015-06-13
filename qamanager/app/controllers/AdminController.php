<?php

class AdminController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function homeAction()
    {
		$this->view->setMainView('admin');
		$this->view->setVar('page_controller', 'admin');
		$this->view->setVar('page_name', 'Home');
		$this->view->setVar('page_active', 'home');
		$this->view->setVar('page_content', 'admin/home');

		$user_types = UserType::find();
		$this->view->setVar('user_types',$user_types);

		$user_accounts = UserAccount::listUserAccounts();
		$this->view->setVar('user_accounts',$user_accounts);
    }
}

