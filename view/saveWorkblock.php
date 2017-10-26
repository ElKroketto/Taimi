<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 18:49
 */

    $blockId = -1;
    if (isset($_POST['Id']) && !empty($_POST['Id']) && $_POST['Id'] > 0) {
        $blockId = $_POST['Id'];

        $block = $entityManager->find('elkroketto\taimi\Workblock', $blockId);
    } else {
        $block = new elkroketto\taimi\WorkBlock();
    }

    $block->setBlockDescription($_POST['BlockDescription']);
    $block->setBlockComment($_POST['BlockComment']);

    $startTime = new DateTime($_POST['BlockStartTime']);
    $block->setBlockStartTime($startTime);

    if (isset($_POST['BlockEndTime']) && !empty($_POST['BlockEndTime'])) {
        $endTime = new DateTime($_POST['BlockEndTime']);
    } else {
        $endTime = null;
    }
    $block->setBlockEndTime($endTime);

    // Save Project-reference
    if ($_POST['ProjectId'] > 0) {
        $project = $entityManager->find('elkroketto\taimi\Project', $_POST['ProjectId']);
    } else {
        $project = null;
    }
    $block->setBlockProject($project);

    $entityManager->persist($block);
    $entityManager->flush();
?>

<div class="alert alert-info alert-dismissible fade show" role="alert">
    Your work block was successfully saved.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

