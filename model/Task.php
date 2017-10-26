<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 19.10.2017
 * Time: 20:59
 */

namespace elkroketto\taimi;

/**
 * Class Task
 * A task is part of a project and describes a mid-sized job that has to be done, e.g. "Write a clean doc"
 * @Entity @Table(name="Task")
 * @package elkroketto\taimi
 */
class Task
{
    const TASK_STATE_OPEN        = 0;
    const TASK_STATE_IN_PROGRESS = 1;
    const TASK_STATE_PAUSED      = 2;
    const TASK_STATE_DONE        = 3;

    const TASK_PRIO_LOW  = 0;
    const TASK_PRIO_MED  = 50;
    const TASK_PRIO_HIGH = 100;

    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int - Identifier
     */
    private $id = -1;

    /**
     * @Column(type="integer")
     * @var int - Current state of the task. Default: Task::TASK_STATE_OPEN
     */
    protected $task_state = self::TASK_STATE_OPEN;

    /**
     * @Column(type="integer")
     * @var int - Task's priority. Use Task::TASK_STATE_<..> OR unsigned int-number
     */
    protected $task_priority = self::TASK_PRIO_LOW;

    /**
     * @Column(type="string", length=255)
     * @var string - Task's name
     */
    protected $task_name = '';

    /**
     * @Column(type="string", nullable=true, length=1024)
     * @var string - More detailed description of the task's job
     */
    protected $task_description = '';

    /**
     * @Column(type="datetime")
     * @var \DateTime - DateTime of when the task was created
     */
    protected $task_created;

    /**
     * @Column(type="datetime", nullable=true)
     * @var \DateTime - DateTime of when the task was first time started
     */
    protected $task_started;

    /**
     * @Column(type="datetime", nullable=true)
     * @var DateTime - DateTime of when the task was deleted
     */
    protected $task_deletedAt;


    /**
     * @Column(type="datetime", nullable=true)
     * @var \DateTime - DateTime of when the task was finished the last time
     */
    protected $task_done;

    /**
     * @ManyToOne(targetEntity="Project", inversedBy="tasks")
     * @JoinColumn(name="project_id", referencedColumnName="id")
     * @var - referencing project
     */
    protected $project;


    public function getId() { return $this->id; }
    public function getTaskState() { return $this->task_state; }
    public function setTaskState($val) { $this->task_state = $val; }
    public function getTaskPriority() { return $this->task_priority; }
    public function setTaskPriority($val) { $this->task_priority = $val; }
    public function getTaskName() { return $this->task_name; }
    public function setTaskName($val) { $this->task_name = $val; }
    public function getTaskDescription() { return $this->task_description; }
    public function setTaskDescription($val) { $this->task_description = $val; }
    public function getTaskCreated() { return $this->task_created; }
    public function setTaskCreated($val) { $this->task_created = $val; }
    public function getTaskStarted() { return $this->task_started; }
    public function setTaskStarted($val) { $this->task_started = $val; }
    public function getTaskDeletedAt() { return $this->task_deletedAt; }
    public function setTaskDeletedAt($val) { $this->task_deletedAt = $val; }
    public function getTaskDone() { return $this->task_done; }
    public function setTaskDone($val) { $this->task_done = $val; }
    public function getProject() { return $this->project; }
    public function setProject($val) { $this->project = $val; }

}