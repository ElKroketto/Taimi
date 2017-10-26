<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 17:41
 */

    $taskId = -1;
    $projectId = -1;
    if ((isset($_GET['taskId']) && !empty($_GET['taskId']) && $_GET['taskId'] > 0) && (isset($_GET['projectId']) && !empty($_GET['projectId']) && $_GET['projectId'] > 0)) {
        $taskId = $_GET['taskId'];
        $projectId = $_GET['projectId'];

        $task = $entityManager->find('elkroketto\taimi\Task', $taskId);

        $entityManager->remove($task);
        $entityManager->flush();
    }

?>

<div class="alert alert-info alert-dismissible fade show autoDismiss" role="alert">
    Task was deleted from your project.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
