<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 23:19
 */

namespace elkroketto\taimi;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class User
 * @Entity @Table(name="User")
 * @package elkroketto\taimi
 */
class User
{

    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var
     */
    protected $id;

    /**
     * @Column (type="string")
     * @var string
     */
    protected $username;

    /**
     * @Column (type="string")
     * @var
     */
    protected $passwordHash;

    /**
     * @OneToMany(targetEntity="UserSession", mappedBy="user")
     * @var ArrayCollection
     */
    protected $sessions;


    public function __construct() {
        $this->sessions = new ArrayCollection();
    }


    /* GETTERS & SETTERS */

    /**
     * @return ArrayCollection
     */
    public function getSessions()
    {
        return $this->sessions;
    }

    /**
     * @param ArrayCollection $sessions
     */
    public function setSessions($sessions)
    {
        $this->sessions = $sessions;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    /**
     * @param mixed $passwordHash
     */
    public function setPasswordHash($passwordHash)
    {
        $this->passwordHash = $passwordHash;
    }



}