<?php
/** @var $methods Orm_Cm_Course_Assessment_Method[] */
/** @var $method Orm_Cm_Course_Assessment_Method */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/course/assessment_plan_method_add_edit/{$course_id}/{$method->get_id()}" , array('id' => 'course-form', 'method'=>'post')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Assessment Method'); ?> - <?php echo Orm_Course::get_instance($course_id)->get_name() ?></span>
        </div>
        <div class="modal-body">


            <table class="table table-bordered more_items" id="more_course_method">
                <thead>
                <tr>
                    <th class="col-md-6"><?php echo lang('Course') . ' ' . lang('Assessment Method') . '' ?></th>
                    <th class="col-md-1"><?php echo lang('Select') ?></th>
                </tr>
                </thead>
                <?php if (!empty($methods)) { ?>

                    <?php foreach ($methods as $key => $item) { ?>
                        <tr class="item">
                            <td>
                                <?php echo htmlfilter($item['course_method_text']); ?>
                            </td>
                            <td>
                                <div class="checkbox" style="margin: 0 auto; width: 40%;">
                                    <label class="px-single">
                                        <input type="checkbox" name="assessment_method[]" value="<?php echo $item['course_method_id']?>" class="px" <?php echo $item['selected']!=0?"checked":''?>
                                                <?php echo(empty($program_component_id) ? '' : 'checked="checked"') ?> >
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                                <input type="hidden" name="methods[<?php echo intval($key) ?>][course_method_id]" value="<?php echo intval($item['course_method_id']); ?>">
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Assessment Method'); ?>
                    </div>
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
</script>