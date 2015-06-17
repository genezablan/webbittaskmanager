<?php

class Projects extends \Phalcon\Mvc\Model
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
    public $master_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $description;

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
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('Projects');
    }
    

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'id' => 'id', 
            'master_id' => 'master_id', 
            'name' => 'name', 
            'description' => 'description', 
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
    public function listProjects($master_id)
    {
        $phql = "SELECT p.id as project_id,p.name,p.description,p.status,ps.name as status_name
                 FROM Projects p
                 INNER JOIN ProjectStatus ps ON ps.id = p.status
                 WHERE p.master_id = ?1";
        $data = $this->modelsManager->executeQuery($phql,array(1=>$master_id));
        return $data;
    }
}
