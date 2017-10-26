<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 10:50
 */

    // VIEW
    $incFile = 'projects';

    if (isset($layoutViewName) && !empty($layoutViewName)) {
        switch ($layoutViewName) {
            case 'projects':
                $incFile = 'projects';
                break;
            case 'editProject':
                $incFile = 'editProject';
                break;
            case 'clients':
                $incFile = 'clients';
                break;
            case 'editClient':
                $incFile = 'editClient';
                break;
            case 'projectDetails':
                $incFile = 'projectDetails';
                break;
            case 'editTask':
                $incFile = 'editTask';
                break;
            case 'editWorkblock':
                $incFile = 'editWorkblock';
                break;
            case 'about':
                $incFile = 'about';
                break;

            default:
                $incFile = 'projects';
        }
    } else {
        $incFile = 'projects';
        $layoutViewName = 'projects';
    }

    $incFile .= '.php';

    // ACTION
    $actionFile = false;
    if (isset($_GET['action']) && !empty($_GET['action'])) {
        switch($_GET['action']) {
            case 'saveProject':
                $actionFile = 'saveProject';
                break;
            case 'deleteProject':
                $actionFile = 'deleteProject';
                break;
            case 'saveClient':
                $actionFile = 'saveClient';
                break;
            case 'saveTask':
                $actionFile = 'saveTask';
                break;
            case 'deleteTask':
                $actionFile = 'deleteTask';
                break;
            case 'saveWorkblock':
                $actionFile = 'saveWorkblock';
                break;
            case 'deleteWorkblock':
                $actionFile = 'deleteWorkblock';
                break;
        }

        $actionFile .= '.php';
    }

?>

<?php
    include "includes/htmlHead.php";
?>

<?php
    include "shared/pageHeader.php";
?>

<div class="container-fluid" id="mainContentWrapper">
    <?php
        if ($actionFile !== false) {
            include $actionFile;
        }

        include $incFile;
    ?>
</div>



<?php
    include "shared/pageFooter.php";
?>

<?php
    include "includes/htmlFoot.php";
?>