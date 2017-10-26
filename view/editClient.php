<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 14:09
 */

    // Check if a new project is created (if so: ProjectID is not set or it's value is < 0
    if (!isset($_GET['clientId']) || empty($_GET['clientId']) || $_GET['clientId'] < 0) {
        $client = false;
        $clientId = -1;
    } else {
        $clientId = $_GET['clientId'];
        $client = $entityManager->find('elkroketto\taimi\Client', $clientId);

        if ($client === null) {
            $clientId = -1;
            $client = false;
        }
    }
?>

<div class="row justify-content-center">
    <div class="col col-xs-12 col-md-6">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">
                    <?= (($client === false) ? "Add Client" : "Edit Client" ) ?>
                </h1>

                <form action="?view=clients&action=saveClient" method="POST">
                    <input type="hidden" name="Id" value="<?= (($client !== false) ? $client->getId() : '-1') ?>">

                    <div class="form-group">
                        <label for="inpClientName">Name</label>
                        <input type="text" class="form-control" id="inpClientName" name="ClientName" value="<?= (($client !== false) ? $client->getClientName() : '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="inpClientDescription">Description</label>
                        <textarea id="inpClientDescription" name="ClientDescription" class="form-control" rows="5"><?= (($client !== false) ? $client->getClientDescription() : '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="inpClientComment">Comments</label>
                        <textarea id="inpClientComment" name="ClientComment" class="form-control" rows="10"><?= (($client !== false) ? $client->getClientComment() : '') ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col text-right">
                            <a href="?view=clients" class="btn btn-default">
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




