<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/05/17
 * Time: 01:41 م
 */
/* @var $courses Orm_Course */
?>
<div class="table-responsive m-a-0">
    <table class="table table-bordered">

        <thead>
        <tr>
            <td class="col-md-4"><?php echo lang('Course Name'); ?></td>
            <td class="col-md-3"><?php echo lang('Sections'); ?></td>
            <td class="col-md-3"><?php echo lang('Students'); ?></td>
            <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($courses): ?>
            <?php foreach ($courses as $course): /* @var $course Orm_Course */?>
                <tr>
                    <td> <?php echo htmlfilter($course->get_name())?></td>
                    <td> <?php echo htmlfilter(Orm_Course_Section::get_count(['course_id'=>$course->get_id(),'semester_id'=>Orm_Semester::get_active_semester()->get_id()]))?></td>
                    <td><?php echo htmlfilter(Orm_Course_Section_Student::get_total_students($course->get_id()))?></td>
                    <td class="text-center">
                        <a href="/gradebook/view_sections/<?php echo (int)$course->get_id(); ?>" class="btn btn-block" title="<?php echo lang('View').' '.lang('Sections') ?>">
                            <span class="btn-label-icon left fa fa-eye" aria-hidden="true"></span>
                            <?php echo lang('View').' '.lang('Sections') ?>
                        </a>
                        <?php /*
                        <a href="/gradebook/report/<?php echo (int)$course->get_id(); ?>" class="btn btn-block" title="<?php echo lang('Summary') ?>">
                            <span class="btn-label-icon left fa fa-pie-chart" aria-hidden="true"></span>
                            <?php echo lang('Summary') ?>
                        </a>
                        */ ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Course'); ?></h3>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<?php if (!empty($pager)): ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php endif; ?>
