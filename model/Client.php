<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 19.10.2017
 * Time: 20:47
 */

namespace elkroketto\taimi;

/**
 * Class Client
 * A customer or client is described by Client
 * @Entity @Table(name="Client")
 * @package elkroketto\taimi
 */
class Client
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int - Identifier
     */
    private $id = -1;

    /**
     * @Column(type="string")
     * @var string - Name of the client / customer
     */
    protected $client_name = '';

    /**
     * @Column(type="string", nullable=true)
     * @var string - Detailed description of the client / customer
     */
    protected $client_description = '';

    /**
     * @Column(type="string", nullable=true)
     * @var string - Comments and notes to the client
     */
    protected $client_comment = '';

    /**
     * @OneToMany(targetEntity="Project", mappedBy="client")
     * @var array of Project - List of the projects associated to the client
     */
    protected $projects;


    public function getId()                     { return $this->id; }
    public function getClientName()             { return $this->client_name; }
    public function setClientName($val)         { $this->client_name = $val; }
    public function getClientDescription()      { return $this->client_description; }
    public function setClientDescription($val)  { $this->client_description = $val; }
    public function getClientComment()          { return $this->client_comment; }
    public function setClientComment($val)      { $this->client_comment = $val; }
    public function getProjects()               { return $this->projects; }
    public function setProjects($val)           { $this->projects = $val; }


}