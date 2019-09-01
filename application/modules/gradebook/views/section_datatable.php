<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 15/05/17
 * Time: 02:56 م
 */
/* @var $sections Orm_Course_Section */
?>
<div class="table-responsive m-a-0">
    <table class="table table-bordered">
        <thead>
        <tr>
            <td class="col-md-5"><?php echo lang('Section No'); ?></td>
            <td class="col-md-5"><?php echo lang('Students'); ?></td>
            <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
        </tr>
        </thead>
        <tbody>
        <?php if ($sections): ?>
            <?php foreach ($sections as $section): /* @var $section Orm_Course_Section */?>
                <tr>
                    <td> <?php echo htmlfilter($section->get_section_no())?></td>
                    <td> <?php echo htmlfilter(Orm_Course_Section_Student::get_count(['section_id'=>$section->get_id()]))?></td>
                    <td class="text-center">
                        <a href="/gradebook/view_students/curriculum/<?php echo (int)$section->get_id(); ?>" class="btn btn-block" title="<?php echo lang('View').' '.lang('Students') ?>">
                            <span class="btn-label-icon left fa fa-eye" aria-hidden="true"></span>
                            <?php echo lang('View').' '.lang('Students') ?>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center"><?php echo lang('There are no').' '.lang('Sections'); ?></h3>
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
