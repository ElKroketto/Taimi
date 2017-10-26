<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 14:53
 */

    $projectId = -1;
    if (isset($_POST['Id']) && !empty($_POST['Id']) && $_POST['Id'] > 0) {
        $projectId = $_POST['Id'];

        $project = $entityManager->find('elkroketto\taimi\Project', $projectId);
    } else {
        $project = new elkroketto\taimi\Project();

        $createdAt = new DateTime($_POST['CreatedAt']);
        $project->setProjectCreatedAt($createdAt);
    }

    $project->setProjectName($_POST['ProjectName']);
    $project->setProjectDescription($_POST['ProjectDescription']);

    // Save Client-reference
    if ($_POST['ClientId'] > 0) {
        $client = $entityManager->find('elkroketto\taimi\Client', $_POST['ClientId']);
    } else {
        $client = null;
    }
    $project->setClient($client);

    $entityManager->persist($project);
    $entityManager->flush();
?>

<div class="alert alert-info alert-dismissible fade show" role="alert">
    Project was succesfully saved.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>