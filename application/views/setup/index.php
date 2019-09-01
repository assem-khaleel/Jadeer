<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/5/17
 * Time: 10:59 AM
 *
 * @var $setup Orm_Setup
 *
 */
?>
<?php if($id_check){?>
    <div class="row">
        <div class="col-md-6">
            <?php echo $setup->get_object()->draw_mission() ?>
        </div>
        <div class="col-md-6">
            <?php echo $setup->get_object()->draw_vision() ?>
        </div>
    </div>

    <?php echo $setup->get_object()->draw_goals() ?>

    <?php echo $setup->get_object()->draw_objectives() ?>
<?php }else{?>
    <div class="alert alert-primary">
<!--        <button type="button" class="close" data-dismiss="alert">×</button>-->
        <h4 class="m-a-0 text-center">
            <?php echo lang("General Information (Mission,Vission,Objectives and Goals) Can't set Until set the Information of").' '.lang($type_of_data); ?>
        </h4>
    </div>
<?php }?>

