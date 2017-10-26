<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 16:34
 */

    $taskId = -1;
    if (isset($_POST['Id']) && !empty($_POST['Id']) && $_POST['Id'] > 0) {
        $taskId = $_POST['Id'];

        $task = $entityManager->find('elkroketto\taimi\Task', $taskId);
        $oldState = $task->getTaskState();
    } else {
        $task = new elkroketto\taimi\Task();

        $createdAt = new DateTime("now");
        $task->setTaskCreated($createdAt);

        $oldState = -1;
    }

    $task->setTaskName($_POST['TaskName']);
    $task->setTaskDescription($_POST['TaskDescription']);
    $task->setTaskPriority($_POST['TaskPriority']);
    $task->setTaskState($_POST['TaskState']);

    if ($oldState != \elkroketto\taimi\Task::TASK_STATE_IN_PROGRESS && $task->getTaskState() == \elkroketto\taimi\Task::TASK_STATE_IN_PROGRESS) {
        $curDate = new DateTime("now");
        $task->setTaskStarted($curDate);
    }

    if ($oldState != \elkroketto\taimi\Task::TASK_STATE_DONE && $task->getTaskState() == \elkroketto\taimi\Task::TASK_STATE_DONE) {
        $curDate = new DateTime("now");
        $task->setTaskDone($curDate);
    }

    // Save Project-reference
    if ($_POST['ProjectId'] > 0) {
        $project = $entityManager->find('elkroketto\taimi\Project', $_POST['ProjectId']);
    } else {
        $project = null;
    }

    $task->setProject($project);
    $project->getTasks()->add($task);

    $entityManager->persist($task);
    $entityManager->persist($project);

    $entityManager->flush();
?>

<div class="alert alert-info alert-dismissible fade show" role="alert">
    Your task was successfully saved.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

