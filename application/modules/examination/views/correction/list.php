<?php
/**
 * Created by PhpStorm.
 * User: laith
 * Date: 5/1/17
 * Time: 4:18 PM
 */
?>
<div class="col-md-12 col-lg-12 m-t-4 ">
    <div class="table-primary">
        <div class="table-header">
            <div class="table-caption">
                <span><?php echo lang('Exams')?></span>
            </div>
        </div>
        <table class="table table-striped table-bordered">
            <thead>
            <tr class="bg-primary">
                <td class="col-md-4"><b><?php echo lang('Exam Name') ?></b></td>
                <td class="col-md-4"><b><?php echo lang('Students number') ?></b></td>
                <td class="col-md-2"><b><?php echo lang('questions number') ?></b></td>
                <td class="col-md-2 text-center"><b><?php echo lang('Action') ?></b></td>
            </tr>
            </thead>
            <tbody>
            <?php if ($exams): ?>
            <?php foreach ($exams as $exam): /* @var $exam Orm_Tst_Exam*/?>
            <tr>
                <td><?php echo $exam->get_name(); ?></td>
                <td><?php echo $exam->get_students_count(); ?></td>
                <td><?php echo count($exam->get_questions()); ?></td>
                <td class="text-center">
                    <a href="<?php echo base_url('/examination/correction/students/'.$exam->get_id()) ?>" class="btn  btn-block"><i class="btn-label-icon left fa fa-tasks"></i><?php echo lang('View') ?></a>
                </td>
            </tr>
                <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="4">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Questions'); ?></h3>
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