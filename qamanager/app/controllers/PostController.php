<?php

class PostController extends ControllerBase
{

	public function beforeExecuteRoute($dispatcher)
	{
		if(!$this->request->isPost())
		{
			//die('You are not allowed baby');
			$this->dispatcher->forward(array('controller'=>'index','action'=>'index'));
		}
	}
    public function indexAction()
    {
    	
    }

    public function loginAction()
    {
    	$posts = $this->request->getPost();
    	$username = $posts['username'];
    	$password = $posts['password'];
    	
    	$info = UserAccount::findFirst(array(
    			"conditions"=>"username = ?1 AND password = ?2",
    			"bind"=>array(1=>$username,2=>md5($password))
    		));

    	if(!$info){
	        $this->flashSession->error("Invalid Username/Password");
	        return $this->response->redirect("index/index");
    	}

        //SAVE LAST LOGIN
        $info->last_login = CURR_DATE;
        $info->status = 1;
        if(!$info->save()){
            $this->flashSession->error("Something went wrong please try again");
            return $this->response->redirect("index/index");   
        }
    	//REGISTER SESSION
    	$this->_registerSession($info);
    	//CHECK USER TYPE
    	switch($info->user_type_id){
    		case 1:
    			return $this->response->redirect(BASE_URI."admin/home");
    		break;
            case 2:
                return $this->response->redirect(BASE_URI."master/home");
            break;
    	}

    }
    
}

