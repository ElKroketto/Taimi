<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 11:20
 */

$projectsRepo = $entityManager->getRepository('elkroketto\taimi\Project');

$projects = $projectsRepo->findAll();
?>

<h1>Projects</h1>

<div class="row justify-content-center">
    <div class="col col-xs-12 col-md-6">

        <div class="list-group">

            <a href="?view=editProject&projectId=-1" class="list-group-item list-group-item-action">
                <i class="fa fa-plus"></i> Add Project
            </a>

            <?php
            foreach ($projects as $project) {
                $cntTasksOpen = 0; $cntTasksInProgress = 0; $cntTasksPaused = 0; $cntTasksDone = 0; $cntTasksAll = 0;

                foreach ($project->getTasks() as $task) {
                    $cntTasksAll++;
                    switch ($task->getTaskState()) {
                        case elkroketto\taimi\Task::TASK_STATE_OPEN:
                            $cntTasksOpen++;
                            break;
                        case elkroketto\taimi\Task::TASK_STATE_IN_PROGRESS:
                            $cntTasksInProgress++;
                            break;
                        case elkroketto\taimi\Task::TASK_STATE_PAUSED:
                            $cntTasksPaused++;
                            break;
                        case elkroketto\taimi\Task::TASK_STATE_DONE:
                            $cntTasksDone++;
                            break;
                    }
                }
                ?>

                <li class="list-group-item flex-column align-items-start">

                    <div class="d-flex w-100 justify-content-between">

                        <h5 class="mb-1">
                            <?= $project->getProjectName() ?>
                        </h5>

                        <?php
                        if ($project->getClient() !== null) {
                            ?>
                            <small><?= $project->getClient()->getClientName() ?></small>
                            <?php
                        }
                        ?>

                    </div>
                    <p class="mb-1"><?= $project->getProjectDescription() ?></p>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?= $cntTasksOpen / $cntTasksAll * 100.0 ?>%" title="<?= $cntTasksOpen ?> tasks OPEN"><?= (($cntTasksOpen > 0) ? $cntTasksOpen : '') ?></div>
                        <div class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: <?= $cntTasksInProgress / $cntTasksAll * 100.0 ?>%" title="<?= $cntTasksInProgress ?> tasks IN PROGRESS"><?= (($cntTasksInProgress > 0) ? $cntTasksInProgress : '') ?></div>
                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: <?= $cntTasksPaused / $cntTasksAll * 100.0 ?>%" title="<?= $cntTasksPaused ?> tasks PAUSED"><?= (($cntTasksPaused > 0) ? $cntTasksPaused : '') ?></div>
                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?= $cntTasksDone / $cntTasksAll * 100.0 ?>%" title="<?= $cntTasksDone ?> tasks DONE"><?= (($cntTasksDone > 0) ? $cntTasksDone : '') ?></div>
                    </div>

                    <?php $workingTimes = $project->calcMeanWorkingTimes() ?>
                    <div class="row rowWorkBlockOverview">

                        <div class="col-sm" title="Sum today">
                            <img src="static/img/calendar_Today.png">
                            <?= $workingTimes['today']?>
                        </div>

                        <div class="col-sm" title="Sum yesterday">
                            <img src="static/img/calendar_Yesterday.png">
                            <?= $workingTimes['yesterday']?>
                        </div>

                        <div class="col-sm" title="Sum current week">
                            <img src="static/img/calendar_ThisWeek.png">
                            <?= $workingTimes['thisWeek']?>
                        </div>

                        <div class="col-sm" title="Sum last week">
                            <img src="static/img/calendar_LastWeek.png">
                            <?= $workingTimes['lastWeek']?>
                        </div>

                        <div class="col-sm" title="Sum current month">
                            <img src="static/img/calendar_ThisMonth.png">
                            <?= $workingTimes['thisMonth']?>
                        </div>

                        <div class="col-sm" title="Sum last month">
                            <img src="static/img/calendar_LastMonth.png">
                            <?= $workingTimes['lastMonth']?>
                        </div>

                    </div>

                    <div class="d-flex w-100 justify-content-end" style="margin-top: 0.5em;">
                        <small>
                            <a href="?view=projectDetails&projectId=<?= $project->getId() ?>" class="btn btn-primary btn-sm" role="button">
                                <i class="fa fa-tasks"></i> Tasks &amp; Work
                            </a>

                            <div class="btn-group">
                                <a href="?view=editProject&projectId=<?= $project->getId() ?>" class="btn btn-secondary btn-sm" role="button" title="Edit project details">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <a href="?view=projects&action=deleteProject&projectId=<?= $project->getId() ?>" class="btn btn-secondary btn-sm delProject" role="button" title="Delete project and all tasks">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </div>
                        </small>
                    </div>

                </li>

                <?php
            }
            ?>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.delProject').click(function(e) {
            var confirmed = confirm("Are you sure to delete this project including all tasks and work blocks?\n\nPress OK to confirm or otherwise Cancel.");

            if (confirmed == true) {

            } else {
                e.preventDefault();
            }
        });
    });
</script>



