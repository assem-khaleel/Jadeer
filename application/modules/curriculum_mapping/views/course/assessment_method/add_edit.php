<?php
/** @var $methods array */
/** @var $method Orm_Cm_Course_Assessment_Method */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/course/assessment_method_add_edit/{$course_id}/{$method->get_id()}" , array('id' => 'course-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Assessment Method'); ?> - <?php echo Orm_Course::get_instance($course_id)->get_name() ?></span>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <button class="btn btn-block" onclick="add_more_course_method();" type="button">
                    <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                    <?php echo lang('Add').' '.lang('Assessment Method Instance'); ?>
                </button>
            </div>
            <table class="table table-bordered more_items" id="more_course_method">
                <thead>
                <tr>
                    <th class="col-md-5"><?php echo lang('Instance') . ' (' . lang('English') . ')' ?></th>
                    <th class="col-md-5"><?php echo lang('Instance') . ' (' . lang('Arabic') . ')' ?></th>
                    <th class="col-md-2"><?php echo lang('Select') ?></th>
                </tr>
                </thead>
                <?php if (!empty($methods)) { ?>
                    <?php foreach ($methods as $key => $course_method) { ?>
                        <tr class="item">
                            <td class="col-md-5">
                                <div class="form-group m-a-0-vr">
                                    <input type="text" name="methods[<?php echo intval($key) ?>][course_method_text_en]" value="<?php echo htmlfilter($course_method['course_method_text_en']); ?>" class="form-control" >
                                    <?php echo Validator::get_html_error_message('required_learning_outcome_en_'.$key); ?>
                                </div>
                            </td>
                            <td class="col-md-5">
                                <div class="form-group m-a-0-vr">
                                    <input type="text" name="methods[<?php echo intval($key) ?>][course_method_text_ar]" value="<?php echo htmlfilter($course_method['course_method_text_ar']); ?>" class="form-control" >
                                    <?php echo Validator::get_html_error_message('required_learning_outcome_en_'.$key); ?>
                                </div>
                            </td>
                            <td class="col-md-2 valign-middle text-center">
                                <button type="button" class="btn" aria-label="Left Align" onclick="eaa_remove_option(this);" >
                                    <span class="fa fa-trash-o btn-label-icon left" aria-hidden="true"></span><?php echo lang('Delete'); ?>
                                </button>
                                <input type="hidden" name="methods[<?php echo intval($key) ?>][course_method_id]" value="<?php echo intval($course_method['course_method_id']); ?>">
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr class="no_item">
                        <td colspan="3" class="well">
                            <h3 class="m-a-0"><?php echo lang('There are no') . ' ' . lang('Assessment Method'); ?></h3>
                        </td>
                    </tr>
                <?php } ?>
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

    $('#course-form').on('submit', function (e) {
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

    function add_more_course_method(method_id) {
        var key = new Date().getTime();
        var selector = '#more_course_method';

        var template = '<tr class="item">' +
            '<td class="col-md-5">' +
            '<input type="text" name="methods[' + key + '][course_method_text_en]" class="form-control" >' +
            '</td>' +
            '<td class="col-md-5">' +
            '<input type="text" name="methods[' + key + '][course_method_text_ar]" class="form-control" >' +
            '</td>' +
            '<td class="col-md-2 valign-middle text-center">' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="eaa_remove_option(this);" >' +
            '<span class="fa fa-trash-o btn-label-icon left" aria-hidden="true"></span><?php echo lang('Delete'); ?>' +
            '</button>' +
            '<input type="hidden" name="methods[' + key + '][course_method_id]" class="form-control" >' +
            '</td>' +
            '</tr>';

        eaa_add_more(selector, template);
    }
</script>