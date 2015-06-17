<?php

class ProjectTeam extends \Phalcon\Mvc\Model
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
    public $project_id;

    /**
     *
     * @var integer
     */
    public $team_id;

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
    public $date_modified;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'project_id' => 'project_id', 
            'team_id' => 'team_id', 
            'status' => 'status', 
            'date_created' => 'date_created', 
            'date_modified' => 'date_modified'
        );
    }
    public function beforeValidationOnCreate()
    {
        $this->date_created = CURR_DATE;
        $this->status = 1;
    }
    public function beforeValidationOnUpdate()
    {
        $this->date_modified = CURR_DATE;
    }

    public function listTeams($project_id)
    {
        $phql = "SELECT t.name FROM ProjectTeam pt
                 LEFT JOIN Team t ON t.id = pt.team_id
                 WHERE pt.project_id = ?1";
        $data = $this->modelsManager->executeQuery($phql,array(1=>$project_id));
        return $data;
    }
}
