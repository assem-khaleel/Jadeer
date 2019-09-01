<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 6/14/17
 * Time: 12:29 PM
 */
/** @var $unit Orm_Unit */
?>
<div class="col-md-9 col-lg-10">
    <?php if ($unit->get_id()) { ?>

        <div class="row">
            <div class="col-md-6">
                <?php echo $unit->draw_mission(); ?>
            </div>
            <div class="col-md-6">
                <?php echo $unit->draw_vision(); ?>
            </div>
        </div>

    <?php } ?>
</div>
