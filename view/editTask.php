<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 16:17
 */

if (!isset($_GET['taskId']) || empty($_GET['taskId']) || $_GET['taskId'] < 0) {
    $task = false;
    $taskId = -1;
} else {
    $taskId = $_GET['taskId'];
    $task = $entityManager->find('elkroketto\taimi\Task', $taskId);

    if ($task === null) {
        $taskId = -1;
        $task = false;
    }
}

$projectId = $_GET['projectId'];

$taskRepo = $entityManager->getRepository('elkroketto\taimi\Client');
?>

<div class="row justify-content-center">
    <div class="col col-xs-12 col-md-6">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">
                    <?= (($task === false) ? "Add Task" : "Edit Task") ?>
                </h1>

                <form action="?view=projectDetails&action=saveTask&projectId=<?= $projectId ?>" method="POST">
                    <input type="hidden" name="Id" value="<?= (($task !== false) ? $task->getId() : '-1') ?>">
                    <input type="hidden" name="ProjectId" value="<?= $projectId ?>">

                    <div class="form-group">
                        <label for="inpTaskName">Name</label>
                        <input type="text" class="form-control" id="inpTaskName" name="TaskName" maxlength="255" value="<?= (($task !== false) ? $task->getTaskName() : '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="inpTaskDescription">Description</label>
                        <textarea id="inpTaskDescription" name="TaskDescription" class="form-control" maxlength="1024" rows="5"><?= (($task !== false) ? $task->getTaskDescription() : '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="inpTaskState">Current state</label>

                        <select name="TaskState" id="inpTaskState" class="form-control">
                            <option value="0" <?= (($task !== false && $task->getTaskState() == 0) ? 'selected' : '') ?>>Open</option>
                            <option value="1" <?= (($task !== false && $task->getTaskState() == 1) ? 'selected' : '') ?>>In Progress</option>
                            <option value="2" <?= (($task !== false && $task->getTaskState() == 2) ? 'selected' : '') ?>>Paused</option>
                            <option value="3" <?= (($task !== false && $task->getTaskState() == 3) ? 'selected' : '') ?>>Done</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label for="inpTaskPriority">Priority</label>
                        <select name="TaskPriority" id="inpTaskPriority" class="form-control">
                            <option value="0"   <?= (($task !== false && $task->getTaskPriority() == 0  ) ? 'selected' : '') ?>>Lowest</option>
                            <option value="10"  <?= (($task !== false && $task->getTaskPriority() == 10 ) ? 'selected' : '') ?>>Low</option>
                            <option value="50"  <?= (($task !== false && $task->getTaskPriority() == 50 ) ? 'selected' : '') ?>>Medium</option>
                            <option value="90"  <?= (($task !== false && $task->getTaskPriority() == 90 ) ? 'selected' : '') ?>>High</option>
                            <option value="100" <?= (($task !== false && $task->getTaskPriority() == 100) ? 'selected' : '') ?>>Highest</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col text-right">
                            <a href="?view=projectDetails&projectId=<?= $projectId ?>" class="btn btn-default">
                                <i class="fa fa-chevron-left"></i> Cancel
                            </a>

                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-floppy-o"></i> Save
                            </button>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
