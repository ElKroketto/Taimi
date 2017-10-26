<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 23:56
 */

    $step2 = false;
    $error = false;

    if (isset($_POST['Username']) && !empty($_POST['Username']) && isset($_POST['Password']) && !empty($_POST['Password'])) {
        $step2 = true;

        // Check minimum password strength
        if (strlen($_POST['Password']) < 6) {
            $step2 = false;
            $error = "Please choose a password with at least six characters!";
        }
    }

    if ($step2 === true) {
        include_once "../authentication.php";
        $pwdHash = \elkroketto\taimi\Authentication::createUserHash($_POST['Username'], $_POST['Password']);
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>TAIMI - Credentials helper</title>

        <style>
            body {
                max-width: 968px;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </head>
    <body>

        <p>
            <strong>So, you need some credentials to start using TAIMI? We've got you covered!</strong>
        </p>

        <p>
            TAIMI is a single user application, meaning that every user can access all managed projects that are stored
            in a database. So in case you need more than one person to use TAIMI you should set up a database for each
            or risk others to get messy with your stuff.
        </p>

        <?php
        if ($step2 !== true) {
            ?>
            <p>
                Anyways: To add a user (or in case you forgot your password) please enter the desired credentials and press
                <em>GENERATE</em>. A string will appear which needs to be inserted into the database manually along with
                the entered user name. Afterwards you will be able to use the login form on the TAIMI start page.
            </p>


            <div>
                <strong><em><?= (($error === false) ? '' : $error) ?></em></strong>
                <form action="?" method="POST">
                    <div>
                        <label for="inpUsername">New username</label><br>
                        <input type="text" id="inpUsername" name="Username">
                    </div>
                    <div style="margin-top: 0.5em;">
                        <label for="inpPassword">New password</label><br>
                        <input type="password" id="inpPassword" name="Password">
                    </div>
                    <div style="margin-top: 1em;">
                        <input type="submit" value="GENERATE">
                    </div>
                </form>
            </div>
            <?php
        } else {
            ?>
            <div>
                <hr>
                <p><strong>Nice! You're almost done:</strong></p>
                <p>Sign into the TAIMI database and insert a new row into the table <em>User</em> using the following fields. That's it!</p>

                <p>
                    <strong>Column userName: </strong> <pre><?= $_POST['Username'] ?></pre><br>
                    <strong>Column passwordHash: </strong> <pre><?= $pwdHash ?></pre>
                </p>
                <hr>
                <p>
                    You're missing the User-table? Are there any other TAIMI-tables, e.g. Project or Client? If not:
                    Open <em>index.php</em> and change the variable $updateScheme to value <em>true</em> and refresh the
                    index-page in your browser. This triggers the creation of all table schemes. Afterwards reset
                    $updateScheme to false. Check again on the User-table.
                </p>
            </div>
            <?php
        }
        ?>
    </body>
</html>
