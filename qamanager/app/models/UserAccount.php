<?php
use Phalcon\Mvc\Model\Validator\Uniqueness as Uniqueness;
class UserAccount extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $username;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $user_type_id;

    /**
     *
     * @var string
     */
    public $secret_question;

    /**
     *
     * @var string
     */
    public $secret_answer;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var string
     */
    public $date_created;
    /**
     *
     * @var string
     */
    public $last_login;

    public function validation()
    {
        $this->validate(new Uniqueness(array(
          "field" => 'username',
          "message"=> 'Username has already been used please try again another'
        )));
        if ($this->validationHasFailed() == true) {
          return false;
        }
    }
    public function beforeValidationOnCreate()
    {   
        $this->date_created = CURR_DATE;
        $this->status = 0;
        $this->password = md5($this->username);
    }

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'username' => 'username', 
            'password' => 'password', 
            'user_type_id' => 'user_type_id', 
            'secret_question' => 'secret_question', 
            'secret_answer' => 'secret_answer', 
            'status' => 'status', 
            'date_created' => 'date_created',
            'last_login' => 'last_login'
        );
    }
    public function listUserAccounts()
    {
        $phql = "SELECT ua.id,ua.username,ua.user_type_id,ua.status,ua.last_login,
                        us.name as status_name,
                        ut.name as user_type_name
                 FROM UserAccount ua
                 INNER JOIN UserType ut ON ut.id = ua.user_type_id
                 INNER JOIN UserStatus us ON ua.status = us.status_id
                 ";
        $data = $this->modelsManager->executeQuery($phql);
        return $data;
    }

}
