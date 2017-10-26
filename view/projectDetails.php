<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 15:59
 */


    $projectId = $_GET['projectId'];
    $project = $entityManager->find('elkroketto\taimi\Project', $projectId);

    $stateIcons = array(
        'fa-stop-circle-o text-danger',        // 0 = open
        'fa-play-circle-o text-primary',        // 1 = started / in progress
        'fa-pause-circle-o text-warning',       // 2 = paused
        'fa-check-circle-o text-success'        // 3 = done
    );

    $stateText = array(
        'Open',                 // 0 = open
        'In Progress',          // 1 = started / in progress
        'Paused',               // 2 = paused
        'Done'                  // 3 = done
    );

?>

<h1>
    <?= $project->getProjectName() ?>
</h1>

<div class="row" style="margin-top:1em;">
    <div class="col">

        <table class="table table-hover">
            <thead class="thead-dark">
            <tr>
                <th colspan="6" scope="col" class="text-center" style="font-size:1.2em;">
                    Tasks

                    <a href="?view=editTask&taskId=-1&projectId=<?= $project->getId() ?>" class="btn btn-light btn-sm pull-right"><i class="fa fa-plus"></i> Task</a>
                </th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">State</th>
                <th scope="col">Prio</th>
                <th scope="col">Name</th>
                <th scope="col">Created</th>
                <th scope="col">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($project->getTasks() as $task) {
                $i++;
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td>
                        <i class="fa <?= $stateIcons[$task->getTaskState()] ?>"></i> <span class="text-muted"><?= $stateText[$task->getTaskState()] ?></span>
                    </td>
                    <td><?= $task->getTaskPriority() ?></td>
                    <td><?= $task->getTaskName() ?></td>
                    <td><?= $task->getTaskCreated()->format('Y-m-d') ?></td>
                    <td class="text-right">

                        <div class="btn-group">
                            <a href=?view=editTask&taskId=<?= $task->getId() ?>&projectId=<?= $project->getId() ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="?view=projectDetails&action=deleteTask&taskId=<?= $task->getId() ?>&projectId=<?= $project->getId() ?>" class="delWorkblock btn btn-secondary btn-sm">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php
            }

            ?>
            <tr>
                <td colspan="6">&nbsp;</td>
            </tr>
            </tbody>

            <thead class="thead-dark">
            <tr>
                <th colspan="6" scope="col" class="text-center" style="font-size:1.2em;">
                    Work Blocks
                    <a href="?view=editWorkblock&blockId=-1&projectId=<?= $project->getId() ?>" class="btn btn-light btn-sm pull-right"><i class="fa fa-plus"></i> Work Block</a>
                </th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Start / End</th>
                <th scope="col" colspan="2">Content</th>
                <th scope="col">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            foreach ($project->getWorkBlocks() as $block) {
                $i++;

                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td>
                        <?= $block->getBlockStartTime()->format('Y-m-d') ?>
                    </td>
                    <td>
                        <?= $block->getBlockStartTime()->format('H:i') ?>
                        -
                        <?= (($block->getBlockEndTime() !== null) ? $block->getBlockEndTime()->format('H:i') : '<span class="badge badge-danger">Running</span>' ) ?>
                        (<?php
                        $endTime = (($block->getBlockEndTime() !== null) ? $block->getBlockEndTime() : new DateTime("now"));
                        $timeDiff = $endTime->diff($block->getBlockStartTime());
                        echo str_pad($timeDiff->h, 1, "0") . ":" . str_pad($timeDiff->i, 2, "0") . " hrs"
                        ?>)
                    </td>
                    <td colspan="2">
                        <?= $block->getBlockDescription() ?>
                    </td>
                    <td class="text-right">
                        <div class="btn-group">
                            <a href="?view=editWorkblock&blockId=<?= $block->getId() ?>&projectId=<?= $project->getId() ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="?view=projectDetails&action=deleteWorkblock&blockId=<?= $block->getId() ?>&projectId=<?= $project->getId() ?>" class="delWorkblock btn btn-secondary btn-sm">
                                <i class="fa fa-trash-o"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php
            }

            ?>
            </tbody>
        </table>


    </div>
</div>





<script>
    $(document).ready(function() {
        $('.delTask').click(function(e) {
            var confirmed = confirm("Are you sure to delete this task?\n\nPress OK to confirm or otherwise Cancel.");

            if (confirmed == true) {

            } else {
                e.preventDefault();
            }
        });

        $('.delWorkblock').click(function(e) {
            var confirmed = confirm("Are you sure to delete this work block?\n\nPress OK to confirm or otherwise Cancel.");

            if (confirmed == true) {

            } else {
                e.preventDefault();
            }
        });
    });
</script>