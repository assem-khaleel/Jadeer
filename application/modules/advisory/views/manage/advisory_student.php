<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 11/8/17
 * Time: 9:29 AM
 */
/** @var $student_faculty Orm_Ad_Student_Faculty */
/** @var $student_program Orm_User_Student */
?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Advisory') ?>
        </div>
        <?php echo filter_block('/advisory/filter_faculty', '/advisory/advisory_student/'.$faculty_id.'/'.$program_id, ['keyword'], 'ajax_block'); ?>
    </div>
    <?php echo form_open("/advisory/save_advisory_student"); ?>

        <?php if (empty($student_program)) { ?>
            <div class="alert alert-default">
                <div class="m-b-1">
                    <?php echo lang('There are no') . ' ' . lang('Student Members'); ?>
                </div>

            </div>
        <?php } else { ?>
            <div class="table-responsive m-a-0" style="height: 400px;overflow: auto">
                <table class="table table-bordered">
                    <thead>
                    <tr>

                        <th class="col-md-4">
                            <?php echo lang('Student Name') ?>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($student_program as $student) {
                        ?>
                        <tr>
                            <?php /* @var $student Orm_User_Student */ ?>
                            <td>
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" <?php echo in_array($student->get_user_id(),$student_selected)?"checked=checked":""?> name="student_ids[]" value="<?php echo $student->get_id(); ?>">
                                    <span class="custom-control-indicator"></span>
                                    <?php echo $student->get_full_name(); ?>
                                </label>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <br>
                <button class="btn btn-outline" type="submit" >
                    <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
                    <?php echo lang('Save Changes'); ?>
                </button>
            </div>

        <?php } ?>

	<input type="hidden" name="faculty_id" value="<?php echo $faculty_id?>" />
	<input type="hidden" name="program" value="<?php echo $program_id?>" />

    <?php echo form_close(); ?>
</div>









