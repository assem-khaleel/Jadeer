<?php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 10/22/18
 * Time: 2:45 PM
 */
/** @var Orm_Rb_Result $results */
/** @var Orm_Rb_Rubrics $rubric */
?>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption">
            <?php echo lang('Rubric Name'). ' : ' . $rubric->get_name() ?>
        </span>
    </div>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="col-md-2"><?php echo lang('KPI Name'); ?></th>
                <th class="col-md-2"><?php echo lang('KPI Note'); ?></th>
                <th class="col-md-2"><?php echo lang('Scale Name'); ?></th>
                <th class="col-md-1"><?php echo lang('KPI Score'); ?></th>

            </tr>
            </thead>
            <tbody>
            <?php

            if (!empty($results)) {

                foreach ($results as $result) {
                    /** @var Orm_Rb_Result $result */
                    $scale = Orm_Rb_Scale::get_instance($result->get_scale_id());
                    $table = Orm_Rb_Table::get_one(['scale_id' => $result->get_scale_id(), 'skill_id' => $result->get_skill_id()]);
                    ?>

                    <tr>
                        <td><?php echo $result->get_skill_object()->get_name(); ?></td>
                        <td><?php echo $table->get_description(); ?></td>
                        <td><?php echo $scale->get_name(); ?></td>
                        <td><?php echo round(($result->get_scale_obj()->get_weight() / 100) * $result->get_skill_object()->get_value(), 2); ?></td>
                    </tr>

                <?php }
            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang("There are no") . ' ' . lang('Evaluation') ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if ($pager) { ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>

