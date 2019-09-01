<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/10/16
 * Time: 12:06 PM
 */

/**
 * @var $advising Orm_Fp_Advising
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/work/advising_manage" , array('id' => 'advising-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Advising'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_advising">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Semester')?></label>
                            <div class="col-md-9">
                                <select name="semester_id" class="form-control" >
                                    <option value=""><?php echo lang('Semester')?>...</option>
                                    <?php foreach(Orm_Semester::get_all() as $semester) { ?>
                                        <?php $selected = ($semester->get_id() == $advising->get_semester_id() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $semester->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($semester->get_name()); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('semester_id'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Level')?></label>
                            <div class="col-md-9">
                                <select name="level" class="form-control" >
                                    <option value=""><?php echo lang('Level')?>...</option>
                                    <?php foreach(Orm_Fp_Advising::$levels as $level_key => $level_value) { ?>
                                        <?php $selected = ($level_key == $advising->get_level() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $level_key; ?>" <?php echo $selected; ?>><?php echo lang($level_value); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('level'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Number Of Students')?></label>
                            <div class="col-md-9">
                                <input type="text" name="number_of_students" value="<?php echo htmlfilter($advising->get_number_of_students()? : ''); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('number_of_students'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Number Of Sections')?></label>
                            <div class="col-md-9">
                                <input type="text" name="number_of_sections" value="<?php echo htmlfilter($advising->get_number_of_sections()? : ''); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('number_of_sections'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Subject Taught')?></label>
                            <div class="col-md-9">
                                <input type="text" name="subject_taught" value="<?php echo htmlfilter($advising->get_subject_taught()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('subject_taught'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($advising->get_id()); ?>" >
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#advising-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>