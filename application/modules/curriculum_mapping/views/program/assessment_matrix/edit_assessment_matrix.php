<?php
/** @var $program_method Orm_Cm_Program_Assessment_Method */

$merhods = Orm_Cm_Program_Assessment_Method::get_assessment_methods($program_id);
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/program/save_assessment_matrix", array('id' => 'assessment_matrix')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Assessment Metric'); ?></span>
        </div>
        <?php
        ?>
        <div class="modal-body">
            <?php if ($merhods) {
                ?>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="col-md-3"><?php echo lang('Assessment Method'); ?></th>
                        <th class="col-md-2"><?php echo lang('Choose'); ?></th>
                        <th class="col-md-2"><?php echo lang('Value'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($merhods as $key => $method) {
                        $method_matrix = Orm_Cm_Program_X_Matrix_Method::get_one(['program_id'=>$program_id,'course_id'=>$course_id,'program_learning_outcome_id'=>$plo_id,'assessment_method_id'=>$method->get_assessment_method_obj()->get_id()]);

                        if ($method_matrix->get_id()) {
                            $checked = 'checked';
                            $disabled='';
                        } else {
                            $checked = '';
                            $disabled='disabled';

                        } ?>
                        <tr>
                            <td>
                                <span class="label label-primary"><?php echo($key + 1); ?></span>
                                <?php echo htmlfilter($method->get_assessment_method_obj()->get_title()); ?>
                            </td>
                            <td>
                                <div class="checkbox">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               name="assessment_method_id[]"
                                               id="assessment_method_id"
                                               value="<?php echo htmlfilter($method->get_assessment_method_obj()->get_id()); ?>"
                                               class="custom-control-input" <?php echo $checked ?>
                                               onchange="select_assessment_method(this, '<?php echo $method->get_assessment_method_obj()->get_id() ?>');" >
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="form-group m-a-0-vr">
                                    <input type="text"
                                           name="value[<?php echo $method->get_assessment_method_obj()->get_id() ?>]"
                                           value="<?php echo htmlfilter($method_matrix->get_value()); ?>"
                                           class="form-control assessment_method_<?php echo $method->get_assessment_method_obj()->get_id() ?>"
                                    <?php echo $disabled; ?>
                                    <?php echo Validator::get_html_error_message('required_learning_outcome_code_'.$method->get_assessment_method_obj()->get_id()); ?>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <input type="hidden" name="program_id" id="program_id" value="<?php echo $program_id; ?>"/>
                <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id; ?>"/>
                <input type="hidden" name="plo_id" id="plo_id" value="<?php echo $plo_id; ?>"/>

            <?php } else { ?>
                <div class="alert alert-dafualt">
                    <div class="m-b-12">
                        <?php echo lang('There are no') . ' ' . lang('Program Assessment Method'); ?>
                    </div>
                </div>
            <?php } ?>
        </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
            <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
        </button>
        <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
        </button>
    </div>
    <?php echo form_close(); ?>
</div>
</div>

<script type="text/javascript">

    $('#assessment_matrix').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });
    });


    function select_assessment_method(elm, id){
        if($(elm).is(':checked')) {
            $('.assessment_method_' + id).removeAttr('disabled');
        } else {
            $('.assessment_method_' + id).attr('disabled', 'disabled');
        }
    }
</script>