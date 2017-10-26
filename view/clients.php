<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 15:20
 */

$clientsRepo = $entityManager->getRepository('elkroketto\taimi\Client');

$clients = $clientsRepo->findAll();
?>

<h1>Clients</h1>

<div class="row justify-content-center">
    <div class="col col-xs-12 col-md-6">

        <div class="list-group">

            <a href="?view=editClient&clientId=-1" class="list-group-item list-group-item-action">
                <i class="fa fa-plus"></i> Add Client
            </a>

            <?php
            foreach ($clients as $client) {
                ?>

                <li class="list-group-item flex-column align-items-start">

                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">
                            <?= $client->getClientName() ?>
                        </h5>
                    </div>
                    <p class="mb-1"><?= nl2br($client->getClientDescription()) ?></p>
                    <p class="mb-1"><em><?= nl2br($client->getClientComment()) ?></em></p>

                    <div class="d-flex w-100 justify-content-end">
                        <small>
                            <a href="?view=editClient&clientId=<?= $client->getId() ?>" class="btn btn-default btn-sm">
                                <i class="fa fa-edit"></i> Edit Details
                            </a>
                        </small>
                    </div>

                </li>

                <?php
            }
            ?>



        </div>

    </div>
</div>
