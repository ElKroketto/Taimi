<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 15:38
 */

$clientId = -1;
if (isset($_POST['Id']) && !empty($_POST['Id']) && $_POST['Id'] > 0) {
    $clientId = $_POST['Id'];

    $client = $entityManager->find('elkroketto\taimi\Client', $clientId);
} else {
    $client = new elkroketto\taimi\Client();
}

$client->setClientName($_POST['ClientName']);
$client->setClientDescription($_POST['ClientDescription']);
$client->setClientComment($_POST['ClientComment']);

$entityManager->persist($client);
$entityManager->flush();


?>

<div class="alert alert-info alert-dismissible fade show" role="alert">
    Client data was succesfully saved.

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>