<?php

class TeamMembers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $team_id;

    /**
     *
     * @var integer
     */
    public $member_id;

    /**
     *
     * @var integer
     */
    public $status;

    /**
     *
     * @var integer
     */
    public $role_id;

    /**
     *
     * @var string
     */
    public $date_created;

    /**
     *
     * @var string
     */
    public $date_modified;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'team_id' => 'team_id', 
            'member_id' => 'member_id', 
            'status' => 'status', 
            'role_id' => 'role_id', 
            'date_created' => 'date_created', 
            'date_modified' => 'date_modified'
        );
    }
    public function beforeValidationOnCreate()
    {
        $this->date_created = CURR_DATE;
        $this->status =  1;
        $this->role_id = 0;
    }
    public function beforeValidationOnUpdate()
    {
        $this->date_modified = CURR_DATE;
        
    }
    public function listMembers($team_id)
    {
        $phql = "SELECT ua.username FROM TeamMembers tm
                 LEFT JOIN UserAccount ua ON ua.id = tm.member_id
                 WHERE tm.team_id = ?1";
        $data = $this->modelsManager->executeQuery($phql,array(1=>$team_id));
        return $data;
    }
    
}
