<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 19:07
 */

    $blockId = -1;
    $projectId = -1;
    if ((isset($_GET['blockId']) && !empty($_GET['blockId']) && $_GET['blockId'] > 0) && (isset($_GET['projectId']) && !empty($_GET['projectId']) && $_GET['projectId'] > 0)) {
        $blockId = $_GET['blockId'];
        $projectId = $_GET['projectId'];

        $block = $entityManager->find('elkroketto\taimi\WorkBlock', $blockId);

        $entityManager->remove($block);
        $entityManager->flush();
    }

?>

<div class="alert alert-info alert-dismissible fade show autoDismiss" role="alert">
    Work block was deleted from your project.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
