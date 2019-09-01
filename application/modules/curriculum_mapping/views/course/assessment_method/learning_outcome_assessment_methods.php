<?php
/** @var $clo_id int */
/** @var $course_id int */
/** @var $methods Orm_Cm_Course_Assessment_Method[] */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/course/clo_assessment_method/{$course_id}/{$clo_id}", array('id' => 'course-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Course Learning Outcome'); ?>
                - <?php echo lang('Assessment Methods'); ?></span>
        </div>
        <div class="modal-body">
            <?php if ($methods){ ?>
                <div class="form-group">
                    <div class="more_items panel-group">
                        <?php foreach ($methods as $method_key => $method) { ?>
                            <div class="item panel panel-primary">
                                <div class="panel-heading">
                                    <a href="#collapse-<?php echo intval($method_key) ?>" data-toggle="collapse"
                                       class="accordion-toggle collapsed">
                                        <?php echo htmlfilter($method->get_text()) ?>
                                    </a>
                                </div>
                                <div class="panel-collapse collapse" id="collapse-<?php echo intval($method_key) ?>"
                                     style="height: 0">
                                    <table class="table table-bordered">
                                        <?php if (!empty($method->get_program_assessment_method_obj()->get_assessment_components())) { ?>
                                            <?php foreach ($method->get_program_assessment_method_obj()->get_assessment_components() as $key => $component) { ?>
                                                <?php $item = Orm_Cm_Course_Mapping_Matrix::get_one(array('course_id' => $course_id, 'course_learning_outcome_id' => $clo_id, 'course_assessment_method_id' => $method->get_id(), 'course_assessment_component_id' => $component->get_id())); ?>
                                                <tr class="item">
                                                    <td class="col-md-10"><?php echo htmlfilter($component->get_text()); ?></td>
                                                    <td class="col-md-2 valign-middle text-center">
                                                        <div class="checkbox">
                                                            <label class="px-single">
                                                                <input type="checkbox" class="px"
                                                                       name="mapping[<?php echo $method->get_id() ?>][<?php echo $component->get_id() ?>]" <?php echo(!$item->get_id() ? '' : 'checked="checked"') ?>
                                                                       value="1">
                                                                <span class="lbl"></span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <tr class="no_item">
                                                <td colspan="2" class="well">
                                                    <h3 class="m-a-0"><?php echo lang('There are no') . ' ' . lang('Assessment Method'); ?></h3>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php }else{ ?>
            <div class="alert alert-dafualt">
                <div class="m-b-1">
                    <?php echo lang('There are no') . ' ' . lang('Course Learning Outcome'); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="modal-footer">
        <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i
                    class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
        <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span
                class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
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