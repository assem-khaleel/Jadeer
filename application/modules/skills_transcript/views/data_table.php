<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 8/14/17
 * Time: 2:29 PM
 */
/** @var $results [] Orm_Rb_Result */
/** @var $pager String */
?>
<div class="table-primary">
    <div class="table-header">
        <span class="table-caption">
            <h4 class="m-t-2 text-left"><?php echo lang('Student List') ?></h4>
        </span>
    </div>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="col-md-4"><?php echo lang('Student Name'); ?></th>
                <th class="col-md-4"><?php echo lang('Number of Evaluated Skills'); ?></th>
                <th class="col-md-4"><?php echo lang('Result'); ?></th>
                <th class="col-md-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($students)) {

                foreach ($students as $student) {
                    if (Orm_User::get_instance($student['user_id'])->get_class_type() == 'Orm_User_Student') {
                        $results = Orm_Rb_Result::get_all(['user_id' => $student['user_id']]);
                        $user = Orm_User_Student::get_one(['user_id' => $student['user_id']]);
                        ?>
                        <tr>
                        <td><?php echo $user->get_full_name(); ?></td>
                        <?php

                        if (!empty($results)) {
                            $total = 0;
                            foreach ($results as $items) {

                                $total += ($items->get_scale_obj()->get_weight() / 100) * $items->get_skill_object()->get_value();

                            }

                            ?>
                            <td><?php echo $student['count']; ?></td>
                            <td><?php echo $student['count'] ? round($total, 2) ? round($total / $student['count'], 2) : '0' : lang('No Result') ?></td>
                            <td class="text-center">

                                <a class="btn btn-sm btn-block"
                                   href="/skills_transcript/details/<?php echo $items->get_user_id(); ?>">
                                <span class="btn-label-icon left "><i
                                            class="fa fa-eye"></i></span> <?php echo lang('Details'); ?>
                                </a>
                            </td>
                            </tr>
                            <?php

                        } else {
                            ?>
                            <tr>
                                <td colspan="6">
                                    <div class="well well-sm m-a-0">
                                        <h3 class="m-a-0 text-center"><?php echo lang("There are no") . ' ' . lang('Result') ?></h3>
                                    </div>
                                </td>
                            </tr>
                        <?php }
                    }
                }

            } else {
                ?>
                <tr>
                    <td colspan="6">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang("There are no") . ' ' . lang('Result') ?></h3>
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
