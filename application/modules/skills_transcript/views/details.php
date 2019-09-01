<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 8/14/17
 * Time: 4:36 PM
 * /** @var $result Orm_Rb_Result
 */

/** @var $pager String */
/** @var $student Orm_User_Student */
/** @var $rbSkills Orm_Is_Industrial_Relation */

?>

<div class="table-primary">
    <div class="table-header">
        <span class="table-caption">
            <h4 class="m-t-2 text-left"> <?php echo lang('Student Name') ?>
                : <?php echo Orm_User_Student::get_instance($user_id)->get_full_name() ?></h4>
        </span>
    </div>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="col-md-2"><?php echo lang('Skill Name'); ?></th>
                <th class="col-md-2"><?php echo lang('Score Note'); ?></th>
                <th class="col-md-2"><?php echo lang('Score Name'); ?></th>
                <th class="col-md-1"><?php echo lang('Score'); ?></th>

            </tr>
            </thead>
            <tbody>
            <?php

            $total = 0;
            $totalSkills = 0;
            if (!empty($rbSkills)) {

                foreach ($rbSkills as $item) {
                    /** @var Orm_Rb_Result $item */
                    $scale = Orm_Rb_Scale::get_instance($item->get_scale_id());
                    $table = Orm_Rb_Table::get_one(['scale_id' => $item->get_scale_id(), 'skill_id' => $item->get_skill_id()]);
                    $total += $scale->get_weight();
                    $totalSkills++; ?>

                    <tr>
                        <td>
                            <h5 class="m-t-0"><?php echo htmlfilter($item->get_skill_object()->get_name()); ?></h5>
                            <?php if (Orm_User::get_logged_user()->get_class_type() != Orm_User_Student::class): ?>
                                <ul>
                                    <li>
                                        <i><?php echo lang('Rubric Name'); ?></i>
                                        : <?php echo htmlfilter(Orm_Rb_Rubrics::get_instance($item->get_rubric_id())->get_name()); ?>
                                    </li>

                                </ul>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $table->get_description(); ?></td>
                        <td><?php echo $scale->get_name(); ?></td>
                        <td><?php echo round(($item->get_scale_obj()->get_weight() / 100) * $item->get_skill_object()->get_value(), 2); ?></td>
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
    <?php if (isset($pager)) { ?>
        <?php if ($pager) { ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php } ?>
    <?php } ?>
</div>

