<?php

class UserStatus extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $status_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     * Independent Column Mapping.
     */
    public function columnMap()
    {
        return array(
            'status_id' => 'status_id', 
            'name' => 'name'
        );
    }

}
