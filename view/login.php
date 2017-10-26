<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 23:45
 */
?>

<?php
include "includes/htmlHead.php";
?>

<div class="container-fluid" id="mainContentWrapper">

    <div class="row justify-content-center">
        <div class="col col-md-4 col-xs-12">
            <div class="card">
                <div class="card-body">

                    <h1 class="card-title text-center">
                        <i class="fa fa-clock-o"></i> TAIMI
                    </h1>

                    <form action="?" method="POST">
                        <div class="form-group">
                            <label for="inpUsername">User</label>
                            <input type="text" id="inpUsername" name="Username" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="inpPassword">Password</label>
                            <input type="password" id="inpPassword" name="Password" value="" class="form-control">
                        </div>

                        <a href="view/createCredentials.php" target="_blank" class="btn btn-md btn-default">
                            Create Credentials
                        </a>

                        <button class="btn btn-md btn-primary pull-right">
                            <i class="fa fa-sign-in"></i> Sign in
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#inpUsername').focus();
    });
</script>

<?php
include "includes/htmlFoot.php";
?>
