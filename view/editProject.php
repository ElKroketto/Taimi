<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 14:09
 */

    // Check if a new project is created (if so: ProjectID is not set or it's value is < 0
    if (!isset($_GET['projectId']) || empty($_GET['projectId']) || $_GET['projectId'] < 0) {
        $project = false;
        $projectId = -1;
    } else {
        $projectId = $_GET['projectId'];
        $project = $entityManager->find('elkroketto\taimi\Project', $projectId);

        if ($project === null) {
            $projectId = -1;
            $project = false;
        }
    }

    $clientsRepo = $entityManager->getRepository('elkroketto\taimi\Client');

?>


<div class="row justify-content-center">
    <div class="col col-xs-12 col-md-6">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">
                    <?= (($project === false) ? "Add Project" : "Edit Project") ?>
                </h1>

                <form action="?view=projects&action=saveProject" method="POST">
                    <input type="hidden" name="Id" value="<?= (($project !== false) ? $project->getId() : '-1') ?>">

                    <div class="form-group">
                        <label for="inpClient">Client</label>
                        <select class="form-control" id="inpClient" name="ClientId">
                            <option value="-1"></option>
                            <?php
                            foreach($clientsRepo->findAll() as $client) {
                                ?>
                                <option value="<?= $client->getId() ?>" <?= (($project != null && $project->getClient()->getId() == $client->getId()) ? 'selected' : '') ?>>
                                    <?= $client->getClientName() ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inpProjectName">Name</label>
                        <input type="text" class="form-control" id="inpProjectName" name="ProjectName" maxlength="255" value="<?= (($project !== false) ? $project->getProjectName() : '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="inpProjectDescription">Description</label>
                        <textarea id="inpProjectDescription" name="ProjectDescription" class="form-control" rows="5" maxlength="1024"><?= (($project !== false) ? $project->getProjectDescription() : '') ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="inpCreatedAt">Date of Creation</label>
                                <input type="date" class="form-control" id="inpCreatedAt" name="CreatedAt" value="<?= (($project !== false) ? $project->getProjectCreatedAt()->format('Y-m-d') : ((new DateTime('now'))->format('Y-m-d'))) ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col text-right">
                            <a href="?view=projects" class="btn btn-default">
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




