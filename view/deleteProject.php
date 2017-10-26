<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 20:11
 */

    $projectId = -1;
    if (isset($_GET['projectId']) && !empty($_GET['projectId']) && $_GET['projectId'] > 0) {
        $projectId = $_GET['projectId'];

        $project = $entityManager->find('elkroketto\taimi\Project', $projectId);

        $entityManager->remove($project);
        $entityManager->flush();
    }

?>

<div class="alert alert-info alert-dismissible fade show autoDismiss" role="alert">
    This project was deleted from your account.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
