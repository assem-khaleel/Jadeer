<?php
/** @var Orm_Fp_Forms_Type $form_types*/
/* @var $departments Orm_Department */

?>
<div class="col-md-12 col-lg-12 m-t-4">
    <div class="table-primary">
        <div class="table-header">
            <div class="row form-group">
                <span class="table-caption"><?php echo lang('Department Report'); ?></span>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php echo lang('College');?></th>
                <th><?php echo lang('Department');?></th>
                <?php foreach ($form_types as $type){ /* @var Orm_Fp_Forms_Type $type */?>
                    <th><?php echo htmlfilter($type->get_name());?> (<?php echo htmlfilter($type->get_rate(Orm_Fp_Forms_Deadline::get_current_deadline())); ?>)</th>
                <?php }?>
                <th class="col-md-2 col-lg-2 text-center"><?php echo lang('Actions')?></th>
            </tr>
            </thead>
            <tbody>
            <?php

            if ($departments): ?>
                <?php foreach ($departments as $deprtment) : /* @var $deprtment Orm_Department */?>
                    <tr>
                        <td>
                            <?php echo htmlfilter($deprtment->get_college_obj()->get_name()) ?>
                        </td>
                        <td>
                            <?php echo htmlfilter($deprtment->get_name());?>
                            <?php foreach ($form_types as $type) {?>
                        <td><?php echo htmlfilter(Orm_Fp_Forms_Evaluations::get_avg('department_id',$deprtment->get_id(),$type->get_id())); ?></td>
                        <?php } ?>
                        </td>
                        <td>

                            <a href="/faculty_performance/faculty_report/edit_recommendation/<?php echo (int)$deprtment->get_id(); ?>/1"  data-toggle="ajaxModal" class="btn btn-sm btn-block" title="<?php echo lang('Edit') ?>">
                                <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                                <?php echo lang('Edit') ?>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?php echo  count($form_types)+3 ?>">
                        <div class="well well-sm m-a-0">
                            <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Departments'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php if (!empty($pager)) { ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php } ?>
    </div>
</div>
