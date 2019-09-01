<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 1/17/17
 * Time: 11:46 AM
 */

/**
 * @var $teaching_loads Orm_Course_Section[]
 */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Teaching work load') ?></span>
    </div>
    <?php if(count($teaching_loads)): ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-lg-3"><?php echo lang('Course Title') ?></th>
            <th class="col-lg-2"><?php echo lang('Course Section') ?></th>
            <th class="col-lg-1"><?php echo lang('Students Count') ?></th>
            <th class="col-lg-4"><?php echo lang('Credit Hours') ?></th>
            <th class="col-lg-2"><?php echo lang('Semester') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($teaching_loads as $advising) : ?>
        <tr>
            <td>
                <span><?php echo htmlfilter($advising->get_course_obj()->get_code()) . ' - ' . htmlfilter($advising->get_course_obj()->get_name()) ?></span>
            </td>
            <td>
                <span><?php echo htmlfilter($advising->get_section_no()) ?></span>
            </td>
            <td>
                <span><?php echo intval(Orm_Course_Section_Student::get_count(array('section_id' => $advising->get_id()))) ?></span>
            </td>
            <td>
                <?php if(count($credit_hours = Orm_Program_Plan::get_all(['course_id' => $advising->get_course_id()]))==0):?>
                    <label class="alert m-b-0"><?php echo lang('No related program plan') ?></label>
                <?php endif; ?>

                <?php foreach ($credit_hours as $plan) { ?>
                    <div><?php echo htmlfilter($plan->get_program_obj()->get_name()) . ' :' . $plan->get_credit_hours(); ?></div>
                <?php } ?>
            </td>
            <td>
                <span><?php echo htmlfilter($advising->get_semester_obj()->get_name()) ?></span>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php echo $pager ?>
    <?php else: ?>
    <div class="alert alert-dafualt">
        <div class="m-b-12">
            <?php echo lang('There are no') . ' ' . lang('Teaching work load'); ?>
        </div>
    </div>
    <?php endif; ?>
</div>