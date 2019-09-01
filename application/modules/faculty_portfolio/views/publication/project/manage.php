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
        <?php echo form_open("/faculty_portfolio/publication/project_manage" , array('id' => 'project-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Project'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_project">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Name')?></label>
                            <div class="col-md-9">
                                <input type="text" name="name" value="<?php echo htmlfilter($project->get_name()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('name'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Date From')?></label>
                            <div class="col-md-9">
                                <input type="text" name="date_from" value="<?php echo htmlfilter(($project->get_date_from()=='0000-00-00'? '': $project->get_date_from())); ?>" class="form-control datepicker_date" readonly="readonly">
                                <?php echo Validator::get_html_error_message('date_from'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Date To')?></label>
                            <div class="col-md-9">
                                <input type="text" name="date_to" value="<?php echo htmlfilter(($project->get_date_to()=='0000-00-00'? '': $project->get_date_to())); ?>" class="form-control datepicker_date" readonly="readonly">
                                <?php echo Validator::get_html_error_message('date_to'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Location')?></label>
                            <div class="col-md-9">
                                <input type="text" name="location" value="<?php echo htmlfilter($project->get_location()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('location'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Membership')?></label>
                            <div class="col-md-9">
                                <input type="text" name="membership" value="<?php echo htmlfilter($project->get_membership()); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('membership'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Description')?></label>
                            <div class="col-md-9">
                                <textarea name="description" class="form-control" ><?php echo htmlfilter($project->get_description()); ?></textarea>
                                <?php echo Validator::get_html_error_message('description'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($project->get_id()); ?>" >
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
    $('#project-form').on('submit', function (e) {
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