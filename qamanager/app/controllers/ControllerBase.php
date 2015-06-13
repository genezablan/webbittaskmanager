<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

	public function logoutAction()
	{
		$this->session->destroy();
		return $this->response->redirect('index');
	}
	public  function _registerSession(UserAccount $user){
		$this->session->set('user_type_id',$user->user_type_id);
		$this->session->set('username',$user->username);
		$this->session->set('user_id',$user->id);
	}
	public function _echoJson($status,$message,$data = []){
		
		$result = array(
			"status"=>$status,
			"message"=>$message,
			"data"=>$data
		);
		echo json_encode($result);
		$this->view->disable();
	}

	public function _convertToDate($date,$format){
		$date = new DateTime($date,new DateTimeZone("Asia/Hong_Kong"));
		return $date->format($format);
	}

	public function _getAgo($date){
		date_default_timezone_set('Asia/Manila'); 
		$datenow = new DateTime('NOW');
		$datecreated = new DateTime($date);
		$difference = $datenow->diff($datecreated);
		$differneceword = '';
		if ($difference->format('%i') < 1)
		{
			//less than a minute
			if ($difference->format('%s') == 1) $differenceword = $difference->format('%s') . " second ago";
			else $differenceword = $difference->format('%s') . " seconds ago";
		}
		else if ($difference->format('%h') < 1)
		{
			if ($difference->format('%i') == 1) $differenceword = $difference->format('%i') . " minute ago";
			else $differenceword = $difference->format('%i') . " minutes ago";
		}
		else if ($difference->format('%a') < 1)
		{
			if ($difference->format('%h') == 1) $differenceword = $difference->format('%h') . " hour ago";
			else $differenceword = $difference->format('%h') . " hours ago";
		}
		else if ($difference->format('%m') < 1)
		{
			if ($difference->format('%a') == 1) $differenceword = $difference->format('%a') . " day ago";
			else $differenceword = $difference->format('%a') . " days ago";
		}
		else
		{
			if ($difference->format('%m') == 1) $differenceword = $difference->format('%m') . " month ago";
			else $differenceword = $difference->format('%m') . " months ago";
		}
		return $differenceword;
	}
}

