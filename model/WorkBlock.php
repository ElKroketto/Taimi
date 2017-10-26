<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 10:32
 */

namespace elkroketto\taimi;


/**
 * Class WorkBlock
 * @Entity @Table(name="WorkBlock")
 * @package elkroketto\taimi
 */
class WorkBlock
{

    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var
     */
    protected $id;

    /**
     * @Column(type="datetime")
     * @var
     */
    protected $blockStartTime;

    /**
     * @Column(type="datetime", nullable=true)
     * @var
     */
    protected $blockEndTime;

    /**
     * @Column(type="string", nullable=true, length=255)
     * @var
     */
    protected $blockDescription;

    /**
     * @Column(type="string", nullable=true, length=1024)
     * @var
     */
    protected $blockComment;

    /**
     * @ManyToOne(targetEntity="Project", inversedBy="workBlocks")
     * @JoinColumn(name="project_id", referencedColumnName="id")
     * @var
     */
    protected $blockProject;

    /**
     * @ManyToMany(targetEntity="Task")
     * @JoinTable(name="workblocks_tasks",
     *     joinColumns={@JoinColumn(name="workblock_id", referencedColumnName="id")},
     *     inverseJoinColumns={@JoinColumn(name="task_id", referencedColumnName="id")}
     * )
     * @var
     */
    protected $blockTasks;

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
    public function getBlockStartTime()
    {
        return $this->blockStartTime;
    }

    /**
     * @param mixed $blockStartTime
     */
    public function setBlockStartTime($blockStartTime)
    {
        $this->blockStartTime = $blockStartTime;
    }

    /**
     * @return mixed
     */
    public function getBlockEndTime()
    {
        return $this->blockEndTime;
    }

    /**
     * @param mixed $blockEndTime
     */
    public function setBlockEndTime($blockEndTime)
    {
        $this->blockEndTime = $blockEndTime;
    }

    /**
     * @return mixed
     */
    public function getBlockDescription()
    {
        return $this->blockDescription;
    }

    /**
     * @param mixed $blockDescription
     */
    public function setBlockDescription($blockDescription)
    {
        $this->blockDescription = $blockDescription;
    }

    /**
     * @return mixed
     */
    public function getBlockComment()
    {
        return $this->blockComment;
    }

    /**
     * @param mixed $blockComment
     */
    public function setBlockComment($blockComment)
    {
        $this->blockComment = $blockComment;
    }

    /**
     * @return mixed
     */
    public function getBlockProject()
    {
        return $this->blockProject;
    }

    /**
     * @param mixed $blockProject
     */
    public function setBlockProject($blockProject)
    {
        $this->blockProject = $blockProject;
    }

    /**
     * @return mixed
     */
    public function getBlockTask()
    {
        return $this->blockTask;
    }

    /**
     * @param mixed $blockTask
     */
    public function setBlockTask($blockTask)
    {
        $this->blockTask = $blockTask;
    }

    /**
     * Returns the duration of this work block in SECONDS
     */
    public function getWorkBlockDuration() {
        $endTime = (($this->getBlockEndTime() !== null) ? $this->getBlockEndTime() : new \DateTime("now"));
        $timeDiff = $endTime->diff($this->getBlockStartTime());
        return ($timeDiff->d * 86400 + $timeDiff->h * 3600 + $timeDiff->i * 60 + $timeDiff->s);
    }

}