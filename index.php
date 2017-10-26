<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 19.10.2017
 * Time: 22:22
 */

    date_default_timezone_set("Europe/Berlin");

    $updateScheme = false;           // Anweisung an Doctrine die Tabellen-Struktur zu erzeugen
    include_once "setupDoctrine.php";

    // USER AUTHENTICATION
    include_once "authentication.php";
    $auth = new \elkroketto\taimi\Authentication();

    $isUserAuthenticated = $auth->checkUserAuthenticated();
    if ($isUserAuthenticated !== true) {
        if (isset($_POST['Username']) && !empty($_POST['Username']) && isset($_POST['Password']) && !empty($_POST['Password'])) {
            $isUserAuthenticated = $auth->signIn($_POST['Username'], $_POST['Password']);
        }
    }

    if (isset($_GET['view']) && $_GET['view'] == 'logout') {
        $isUserAuthenticated = false;
        $auth->signOut();
    }

    // VIEW STUFF
    if ($isUserAuthenticated == true) {
        if (isset($_GET['view']) && !empty($_GET['view'])) {
            $layoutViewName = $_GET['view'];
        }

        include "view/mainLayout.php";
    } else {
        $layoutViewName = false;

        include "view/login.php";
    }
?>

