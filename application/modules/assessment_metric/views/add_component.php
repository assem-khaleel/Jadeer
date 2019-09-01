<?php
/** @var $component Orm_Am_Metric_Item */
/** @var $assessment_metric Orm_Am_Assessment_Metric */

$course_id =$this->input->post('course_id');
$course_id    = $component->get_course_id() ?: $course_id;
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/assessment_metric/save_component", array('id' => 'assessment-metric-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Add').' '.lang('Component'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group" id="course_wrapper">

                    <div class="row">

                        <label class="col-sm-3 control-label"><?php echo lang('Course') ?></label>

                        <div class="col-sm-9">

                            <select id="course_block" name="course_id" class="form-control">

                                <option value=""><?php echo lang('All Courses') ?></option>

                                <?php
                                  if (!empty($program_id)) {
                                   foreach (Orm_Program_Plan::get_all(array('program_id' => $program_id)) as $course) {

                                    $selected = ($course->get_course_id() == $course_id ? 'selected="selected"' : '');
                                      ?>
                                    <option value="<?php echo (int) $course->get_course_id() ?>"<?php echo $selected ?>>
                                        <?php echo Orm_Course::get_instance($course->get_course_id())->get_name() ?>
                                    </option>
                                    <?php  }
                                  } ?>
                            </select>

                            <?php echo Validator::get_html_error_message('course_id'); ?>

                        </div>

                    </div>

                </div>

                <div class="form-group">
                    <div class="row">
                        <label class=" col-sm-3 control-label" for="name"> <?php echo lang('Component'); ?> (<?php echo lang('English'); ?>)</label>
                        <div class="col-sm-9">
                            <input name="name_en" type="text" id="name_en" class="form-control"
                                   value="<?php echo htmlfilter($component->get_component_en()); ?>" placeholder="<?php echo lang('Component'); ?> (<?php echo lang('English'); ?>)"/>
                            <?php echo Validator::get_html_error_message('name_en'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class=" col-sm-3 control-label" for="name"> <?php echo lang('Component'); ?> (<?php echo lang('Arabic'); ?>)</label>
                        <div class="col-sm-9">
                            <input name="name_ar" type="text" id="name_en" class="form-control"
                                   value="<?php echo htmlfilter($component->get_component_ar()); ?>" placeholder="<?php echo lang('Component'); ?> (<?php echo lang('Arabic'); ?>)"/>
                            <?php echo Validator::get_html_error_message('name_ar'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class=" col-sm-3 control-label" for="name"> <?php echo lang('Component Value'); ?></label>
                        <div class="col-sm-9">
                            <input name="score" type="text" id="score" class="form-control"
                                   value="<?php echo htmlfilter($component->get_high_score()); ?>"/>
                            <?php echo Validator::get_html_error_message('score'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class=" col-sm-3 control-label" for="name"> <?php echo lang('Assessment Weight'); ?></label>
                        <div class="col-sm-9">
                            <input name="weight" type="text" id="weight" class="form-control"
                                   value="<?php echo htmlfilter($component->get_weight()); ?>"/>
                            <?php echo Validator::get_html_error_message('weight'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="sum_weight" id="sum_weight" value="<?php echo isset($sum_weight)?$sum_weight:0;?>" />
        <input type="hidden" name="id" id="id" value="<?php echo intval($component->get_id())?>" />
        <input type="hidden" name="assessment_id" id="assessment_id" value="<?php echo intval($assessment_metric->get_id())?>" />

        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#assessment-metric-form').on('submit', function (e) {
        e.preventDefault();

        var files = $(":file:enabled", this);

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        if(files.length) {
            $ajaxProp['files']  = files;
            $ajaxProp['iframe'] =  true;
        }

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>