<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 6/14/17
 * Time: 12:29 PM
 */
/** @var Orm_Program $program */
?>
<div class="col-md-9 col-lg-10">
    <?php if ($program->get_id()) { ?>

        <div class="row">
            <div class="col-md-6">
                <?php echo $program->draw_mission(); ?>
            </div>
            <div class="col-md-6">
                <?php echo $program->draw_vision(); ?>
            </div>
        </div>
    <?php } ?>
</div>
