<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 19.10.2017
 * Time: 20:45
 */

namespace elkroketto\taimi;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class Project
 * @Entity @Table(name="Project")
 * @package elkroketto\taimi
 */
class Project
{
    /**
     * @Id @GeneratedValue @Column(type="integer")
     * @var int - Identifier
     */
    protected $id = -1;

    /**
     * @Column(type="datetime")
     * @var DateTime - DateTime of when the project was created
     */
    protected $project_createdAt;

    /**
     * @Column(type="datetime", nullable=true)
     * @var DateTime - DateTime of when the project was deleted
     */
    protected $project_deletedAt;

    /**
     * @Column(type="string")
     * @var string - Short name of the project
     */
    protected $project_name = '';

    /**
     * @Column(type="text", nullable=true, length=1024)
     * @var string - Description for the project comparable to name but more detailed
     */
    protected $project_description = '';

    /**
     * @ManyToOne(targetEntity="Client", inversedBy="projects")
     * @JoinColumn(name="client_id", referencedColumnName="id")
     * @var Client - Instance of client to which the project belongs to
     */
    protected $client;

    /**
     * @OneToMany(targetEntity="Task", mappedBy="project", cascade={"remove"})
     * @OrderBy({"task_state" = "ASC", "task_priority" = "DESC"})
     * @var array of Task - Which tasks belong to the project
     */
    protected $tasks;

    /**
     * @OneToMany(targetEntity="WorkBlock", mappedBy="blockProject", cascade={"remove"})
     * @OrderBy({"blockStartTime" = "DESC"})
     * @var
     */
    protected $workBlocks;

    public function getId() { return $this->id; }
    public function getProjectCreatedAt() { return $this->project_createdAt; }
    public function setProjectCreatedAt($val) { $this->project_createdAt = $val; }
    public function getProjectDeletedAt() { return $this->project_deletedAt; }
    public function setProjectDeletedAt($val) { $this->project_deletedAt = $val; }
    public function getProjectName() { return $this->project_name; }
    public function setProjectName($val) { $this->project_name = $val; }
    public function getProjectDescription() { return $this->project_description ; }
    public function setProjectDescription($val) { $this->project_description  = $val; }
    public function getClient() { return $this->client; }
    public function setClient($val) { $this->client = $val; }
    public function getTasks() { return $this->tasks; }
    public function setTasks($val) { $this->tasks = $val; }
    public function getWorkBlocks() { return $this->workBlocks; }
    public function setWorkBlocks($val) { $this->workBlocks = $val; }

    public function __construct() {
        $this->tasks = new ArrayCollection();
        $this->workBlocks = new ArrayCollection();
    }

    public function calcMeanWorkingTimes() {
        $durAll = 0;
        $durToday = 0;
        $durYesterday = 0;
        $durThisWeek = 0;
        $durLastWeek = 0;
        $durLastSevenDays = 0;
        $durThisMonth = 0;
        $durLastMonth = 0;

        // Calc date range for today, yesterday, this week, last week, last 7 days, this month, last month, last 30 days...
        $dateTodayFrom = new \DateTime("now");
        $dateTodayFrom->setTime(0, 0, 0);

        $dateTodayTo = new \DateTime("now");
        $dateTodayTo->setTime(23, 59, 59);

        $dateYesterdayFrom = new \DateTime("now");
        $dateYesterdayFrom->sub(new  \DateInterval('P1D'));
        $dateYesterdayFrom->setTime(0, 0, 0);

        $dateYesterdayTo = new \DateTime("now");
        $dateYesterdayTo->sub(new \DateInterval('P1D'));
        $dateYesterdayTo->setTime(23, 59, 59);

        $dateThisWeekFrom = new \DateTime("now");
        $dateThisWeekFrom->sub(new  \DateInterval('P' . ($dateThisWeekFrom->format('N') - 1) . 'D'));
        $dateThisWeekFrom->setTime(0, 0, 0);

        $dateLastWeekFrom = new \DateTime("now");
        $dateLastWeekFrom->sub(new  \DateInterval('P' . (7 + ($dateLastWeekFrom->format('N') - 1)) . 'D'));
        $dateLastWeekFrom->setTime(0, 0, 0);

        $dateLastWeekTo = clone $dateLastWeekFrom;
        $dateLastWeekTo->add(new  \DateInterval('P6D'));
        $dateLastWeekTo->setTime(23, 59, 59);

        $dateLastSevenDaysFrom = new \DateTime("now");
        $dateLastSevenDaysFrom->sub(new  \DateInterval('P7D'));
        $dateLastSevenDaysFrom->setTime(0, 0, 0);

        $dateThisMonthFrom = new \DateTime("now");
        $dateThisMonthFrom->setDate($dateThisMonthFrom->format('Y'), $dateThisMonthFrom->format('m'), 1);

        $dateLastMonthFrom = new \DateTime("now");
        $dateLastMonthFrom->sub(new \DateInterval('P1M'));
        $dateLastMonthFrom->setDate($dateLastMonthFrom->format('Y'), $dateLastMonthFrom->format('m'), 1);

        $dateLastMonthTo = clone $dateLastMonthFrom;
        $dateLastMonthTo->add(new \DateInterval('P' . ($dateLastMonthTo->format('t') - 1) . 'D'));

        foreach ($this->getWorkBlocks() as $block) {
            // Overall duration
            $durAll += $block->getWorkBlockDuration();

            // Today's duration
            if ($block->getBlockStartTime() >= $dateTodayFrom && $block->getBlockStartTime() <= $dateTodayTo) {
                $durToday += $block->getWorkBlockDuration();
            }

            // Yesterday's duration
            if ($block->getBlockStartTime() >= $dateYesterdayFrom && $block->getBlockStartTime() <= $dateYesterdayTo) {
                $durYesterday += $block->getWorkBlockDuration();
            }

            // This week's duration (from monday to today midnight)
            if ($block->getBlockStartTime() >= $dateThisWeekFrom && $block->getBlockStartTime() <= $dateTodayTo) {
                $durThisWeek += $block->getWorkBlockDuration();
            }

            // Last week's duration
            if ($block->getBlockStartTime() >= $dateLastWeekFrom && $block->getBlockStartTime() <= $dateLastWeekTo) {
                $durLastWeek += $block->getWorkBlockDuration();
            }

            // Last 7 duration
            if ($block->getBlockStartTime() >= $dateLastSevenDaysFrom && $block->getBlockStartTime() <= $dateTodayTo) {
                $durLastSevenDays += $block->getWorkBlockDuration();
            }

            // This month's duration
            if ($block->getBlockStartTime() >= $dateThisMonthFrom && $block->getBlockStartTime() <= $dateTodayTo) {
                $durThisMonth += $block->getWorkBlockDuration();
            }

            // Last month's duration
            if ($block->getBlockStartTime() >= $dateLastMonthFrom && $block->getBlockStartTime() <= $dateLastMonthTo) {
                $durLastMonth += $block->getWorkBlockDuration();
            }
        }

        return array(
            'overall' => $this->formatTime($durAll),
            'today' => $this->formatTime($durToday),
            'yesterday' => $this->formatTime($durYesterday),
            'thisWeek' => $this->formatTime($durThisWeek),
            'lastWeek' => $this->formatTime($durLastWeek),
            'lastSevenDays' => $this->formatTime($durLastSevenDays),
            'thisMonth' => $this->formatTime($durThisMonth),
            'lastMonth' => $this->formatTime($durLastMonth),
        );
    }

    /**
     * Method to add a task to the project
     * @param Task $task - The new task
     */
    public function addTask(Task $task) {
        $this->tasks->add($task);
    }

    private function formatTime($timeSek) {
        $timeMin = $timeSek / 60;
        $hrs = floor($timeMin / 60);
        $mins = $timeMin % 60;
        return ($hrs . ':' . str_pad($mins, 2, "0"));
    }
}
