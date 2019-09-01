<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/10/16
 * Time: 12:06 PM
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/academic/academic_qualification_manage" , array('id' => 'academic_qualification-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Academic Qualification'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_academic_qualification">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Country')?></label>
                            <div class="col-md-9">
                                <input type="text" name="country" value="<?php echo htmlfilter($academic_qualification->get_country()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('country'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('City')?></label>
                            <div class="col-md-9">
                                <input type="text" name="city" value="<?php echo htmlfilter($academic_qualification->get_city()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('city'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('University')?></label>
                            <div class="col-md-9">
                                <input type="text" name="university" value="<?php echo htmlfilter($academic_qualification->get_university()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('university'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('College')?></label>
                            <div class="col-md-9">
                                <input type="text" name="college" value="<?php echo htmlfilter($academic_qualification->get_college()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('college'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Date From')?></label>
                            <div class="col-md-9">
                                <input type="text" name="date_from" value="<?php echo $academic_qualification->get_date_from() != '0000-00-00' ? htmlfilter($academic_qualification->get_date_from()) : ''; ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('date_from'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Date To')?></label>
                            <div class="col-md-9">
                                <input type="text" name="date_to" value="<?php echo $academic_qualification->get_date_to() != '0000-00-00' ? htmlfilter($academic_qualification->get_date_to()) : ''; ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('date_to'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Degree')?></label>
                            <div class="col-md-9">
                                <input type="text" name="degree" value="<?php echo htmlfilter($academic_qualification->get_degree()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('degree'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Grade')?></label>
                            <div class="col-md-9">
                                <input type="text" name="grade" value="<?php echo htmlfilter($academic_qualification->get_grade()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('grade'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Speciality')?></label>
                            <div class="col-md-9">
                                <input type="text" name="speciality" value="<?php echo htmlfilter($academic_qualification->get_speciality()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('speciality'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Supervisor Name')?></label>
                            <div class="col-md-9">
                                <input type="text" name="supervisor_name" value="<?php echo htmlfilter($academic_qualification->get_supervisor_name()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('supervisor_name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Thises Title')?></label>
                            <div class="col-md-9">
                                <input type="text" name="thises_title" value="<?php echo htmlfilter($academic_qualification->get_thises_title()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('thises_title'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Description')?></label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" ><?php echo htmlfilter($academic_qualification->get_description()); ?></textarea>
                                <?php echo Validator::get_html_error_message('description'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($academic_qualification->get_id()); ?>" >
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
    $(".datepicker_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('#academic_qualification-form').on('submit', function (e) {
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