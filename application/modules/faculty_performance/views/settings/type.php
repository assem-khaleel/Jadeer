<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 13/04/17
 * Time: 09:52 ص
 */
/* @var $types Orm_Fp_Forms_Type*/
/* @var Orm_Fp_Forms_Evaluations $evaluation */
?>
<?php if( Orm_Fp_Forms_Deadline::get_current_deadline()!=0){?>
    <div class="alert alert-default">
        <?php echo lang('The maximum rate value is').' '.(100-$sum_rate). ' '.lang('and the total of all rates must not exceed 100'); ?>
    </div>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Types') ?>
            <span class="pull-right">
                <a class="btn btn-sm slecture"  data-toggle="ajaxModal" id="add_type"  href="/faculty_performance/faculty_settings/add_type">
                    <span class="btn-label-icon left">
                        <i class="fa fa-plus"></i>
                    </span>
                    <?php echo lang('Create').' '.lang('Type')?>
                </a>
        </div>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr class="bg-primary">
            <td class="col-md-4">
                <b><?php echo lang('Name') ?></b>
            </td>
            <td class="col-md-3">
                <b><?php echo lang('Created At') ?></b>
            </td>
            <td class="col-md-3">
                <b><?php echo lang('Rate Percentage') ?></b>
            </td>
            <td class="col-md-2 text-center">
                <b><?php echo lang('Action') ?></b>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($types) {
            foreach ($types as $type) {
                /* @var $type Orm_Fp_Forms_Type*/
                ?>
                <tr>
                    <td>
                        <h5 class="m-t-0"><?php echo htmlfilter($type->get_name()); ?></h5>
                    </td>
                    <td>
                        <h5 class="m-t-0"><?php echo htmlfilter(date('Y-m-d',strtotime($type->get_created_at()))); ?></h5>
                    </td>
                    <td>
                        <h5 class="m-t-0"><?php echo htmlfilter($type->get_rate($deadline_id)).' '.'%'; ?></h5>
                    </td>
                    <td class="text-center">
                       <?php
                        $count_evaluation = Orm_Fp_Forms_Evaluations::get_one(['deadline_id'=>$deadline_id]);
                       if(intval($count_evaluation->get_id())==0){
                           ?>
                           <a href="/faculty_performance/faculty_settings/set_rate/<?php echo (int)$type->get_id();?>"  data-toggle="ajaxModal" class="btn btn-sm btn-block" title="<?php echo lang('Set Rate') ?>">
                               <span class="btn-label-icon left fa fa-percent" aria-hidden="true"></span>
                               <?php echo lang('Set Rate') ?>
                           </a>
                     <?php  }else{?>
                           <div class="alert alert-default">
                               <?php echo lang('you can not change the rate because deadline is started') ?>
                           </div>
                       <?php  }?>

                        <?php if($type->get_is_removable() == true){?>
                            <a href="/faculty_performance/faculty_settings/edit_type/<?php echo (int)$type->get_id(); ?>"  data-toggle="ajaxModal" class="btn btn-sm btn-block" title="<?php echo lang('Edit') ?>">
                                <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                                <?php echo lang('Edit') ?>
                            </a>
                            <a href="/faculty_performance/faculty_settings/remove_type/<?php echo (int)$type->get_id(); ?>" class="btn btn-sm btn-block" title="<?php echo lang('Delete') ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                                <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                <?php echo lang('Delete'); ?>
                            </a>
                        <?php }?>
                    </td>
                </tr>
            <?php }
        } else { ?>
            <tr>
                <td colspan="4">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Form Types'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if ($pager) { ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>
<?php }else{ ?>
    <div class="well">
        <div class="alert alert-default">
            <h3 class="m-a-0 text-center"><?php echo lang('There is no') . ' ' . lang('Current Deadline'); ?></h3>
        </div>
    </div>
<?php } ?>

