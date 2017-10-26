<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 23:23
 */

namespace elkroketto\taimi;

/**
 * Class UserSession
 * @Entity @Table(name="UserSession")
 * @package elkroketto\taimi
 */
class UserSession
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $sessionId;

    /**
     * @Column(type="datetime", nullable=true)
     * @var datetime
     */
    protected $sessionClosed;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $sessionClientIP;

    /**
     * @Column(type="datetime")
     * @var datetime
     */
    protected $sessionStartedAt;

    /**
     * @Column(type="datetime")
     * @var datetime
     */
    protected $sessionValidUntil;

    /**
     * @ManyToOne(targetEntity="User", inversedBy="user")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     * @var
     */
    protected $user;

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
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @param mixed $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * @return mixed
     */
    public function getSessionClosed()
    {
        return $this->sessionClosed;
    }

    /**
     * @param mixed $sessionClosed
     */
    public function setSessionClosed($sessionClosed)
    {
        $this->sessionClosed = $sessionClosed;
    }

    /**
     * @return mixed
     */
    public function getSessionClientIP()
    {
        return $this->sessionClientIP;
    }

    /**
     * @param mixed $sessionClientIP
     */
    public function setSessionClientIP($sessionClientIP)
    {
        $this->sessionClientIP = $sessionClientIP;
    }

    /**
     * @return mixed
     */
    public function getSessionStartedAt()
    {
        return $this->sessionStartedAt;
    }

    /**
     * @param mixed $sessionStartedAt
     */
    public function setSessionStartedAt($sessionStartedAt)
    {
        $this->sessionStartedAt = $sessionStartedAt;
    }

    /**
     * @return mixed
     */
    public function getSessionValidUntil()
    {
        return $this->sessionValidUntil;
    }

    /**
     * @param mixed $sessionValidUntil
     */
    public function setSessionValidUntil($sessionValidUntil)
    {
        $this->sessionValidUntil = $sessionValidUntil;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}