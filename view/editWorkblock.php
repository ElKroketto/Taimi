<?php
/**
 * Created by PhpStorm.
 * User: elias
 * Date: 20.10.2017
 * Time: 18:40
 */

if (!isset($_GET['blockId']) || empty($_GET['blockId']) || $_GET['blockId'] < 0) {
    $block = false;
    $blockId = -1;
} else {
    $blockId = $_GET['blockId'];
    $block = $entityManager->find('elkroketto\taimi\WorkBlock', $blockId);

    if ($block === null) {
        $blockId = -1;
        $block = false;
    }
}

$projectId = $_GET['projectId'];

$projectRepo = $entityManager->getRepository('elkroketto\taimi\Project');

$startDateTime = roundToNextFiveMinutes(new DateTime("now"));
if ($block !== false) {
    $startDateTime = $block->getBlockStartTime();
}

function roundToNextFiveMinutes(DateTime $datetime) {
    // Source: https://stackoverflow.com/questions/19814427/php-datetime-round-up-to-nearest-10-minutes
    $second = $datetime->format("s");
    if($second > 0)
        $datetime->add(new DateInterval("PT".(60-$second)."S"));
    $minute = $datetime->format("i");
    $minute = $minute % 5;

    if($minute != 0) {
        $diff = 5 - $minute;
        $datetime->add(new DateInterval("PT".$diff."M"));
    }

    return $datetime;
}
?>

<div class="row justify-content-center">
    <div class="col col-xs-12 col-md-6">

        <div class="card">
            <div class="card-body">
                <h1 class="card-title">
                    <?= (($block === false) ? "Add Work Block" : "Edit Work Block") ?>
                </h1>

                <form action="?view=projectDetails&projectId=<?= $projectId ?>&action=saveWorkblock" method="POST">
                    <input type="hidden" name="Id" value="<?= (($block !== false) ? $block->getId() : '-1') ?>">
                    <input type="hidden" name="ProjectId" value="<?= $projectId ?>">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="inpBlockStartTime">Start Time <?= (($block == false) ? '<span class="badge badge-info">ROUNDED</span>' : '') ?></label>
                                <input type="datetime-local" class="form-control" id="inpBlockStartTime" name="BlockStartTime" value="<?= $startDateTime->format("Y-m-d\TH:i:s") ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="inpBlockEndTime">
                                    End Time
                                    <?= (($block !== false && $block->getBlockEndTime() === null) ? '<span class="badge badge-danger" id="bdgStopTime" style="cursor:pointer;" title="Auto fill current date and time">Running</span>' : '') ?>
                                </label>
                                <input type="datetime-local" class="form-control" id="inpBlockEndTime" name="BlockEndTime" value="<?= (($block !== false && $block->getBlockEndTime() !== null) ? $block->getBlockEndTime()->format("Y-m-d\TH:i:s") : '') ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inpBlockDescription">Description</label>
                        <input type="text" class="form-control" id="inpBlockDescription" maxlength="255" name="BlockDescription" value="<?= (($block !== false) ? $block->getBlockDescription() : '') ?>">
                    </div>

                    <div class="form-group">
                        <label for="inpBlockComment">Comments &amp; Thoughts</label>
                        <textarea id="inpBlockComment" name="BlockComment" class="form-control" maxlength="1024" rows="10"><?= (($block !== false) ? $block->getBlockComment() : '') ?></textarea>
                    </div>


                    <div class="row">
                        <div class="col text-right">
                            <a href="?view=projectDetails&projectId=<?= $projectId ?>" class="btn btn-default">
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

<script>
    $(document).ready(function() {
        $('#inpBlockStartTime').change(function() {
            $(this).parent().find('label .badge').hide();
        });

        $('#bdgStopTime').click(function() {
            var dateNow = new Date();

            // Round to next 5 minutes
            // Source: https://stackoverflow.com/questions/19814427/php-datetime-round-up-to-nearest-10-minutes
            var i = dateNow.getMinutes();
            i = i % 5;

            if(i != 0) {
                var diff = 5 - i;
                console.log(diff);
                dateNow.setMinutes(dateNow.getMinutes() + diff);
            }

            var y = dateNow.getFullYear();
            var m = ("0" + (dateNow.getMonth() + 1)).slice(-2);
            var d = ("0" + dateNow.getDate()).slice(-2);
            var h = ("0" + dateNow.getHours()).slice(-2);
            i = ("0" + dateNow.getMinutes()).slice(-2);

            $('#inpBlockEndTime').val(y + "-" + m + "-" + d + "T" + h + ":" + i);

        });
    });
</script>