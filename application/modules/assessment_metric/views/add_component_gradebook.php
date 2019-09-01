<?php
/** @var $component Orm_Am_Metric_Item */
/** @var $assessment_metric Orm_Am_Assessment_Metric */


    $test = Orm_Tst_Exam::get_instance($component->get_component_id());
    $course_id = $this->input->post('course_id') ?: 0;
    $type = $this->input->post('type');
    if(is_null($type)) $type = false;

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/assessment_metric/save_component_gradebook", array('id' => 'assessment-metric-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Add').' '.lang('Component'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group" id="course_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Course') ?></label>
                        <div class="col-sm-9">
                            <select id="course_block" name="course_id" class="form-control" onchange="getTypes()">
                                <option value=""><?php echo lang('All Course') ?></option>
                                <?php
                                if (!empty($program_id)) {
                                    foreach (Orm_Program_Plan::get_all(array('program_id' => $program_id)) as $course) {
                                        ?>
                                        <option value="<?php echo (int) $course->get_course_id() ?>"
                                            <?php if ($course->get_course_id() == $test->get_course_id() || $course_id == $course->get_course_id()) echo 'selected' ?>>
                                            <?php echo Orm_Course::get_instance($course->get_course_id())->get_name() ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('course_id'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="exam_type">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Gradebook type') ?></label>
                        <div class="col-sm-9">
                            <select id="type_block" name="type" class="form-control" onchange="getTests()">
                                <option value=""><?php echo lang('All Types') ?></option>
                            </select>
                            <?php echo Validator::get_html_error_message('type'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="tests">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Test') ?></label>
                        <div class="col-sm-9">
                            <select id="test_block" name="test" class="form-control">
                                <option value=""><?php echo lang('All tests') ?></option>
                            </select>
                            <?php echo Validator::get_html_error_message('test'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class=" col-sm-3 control-label" for="name"> <?php echo lang('Component'); ?> (<?php echo lang('English'); ?>)</label>
                        <div class="col-sm-9">
                            <input name="name_en" type="text" id="name_en" class="form-control"
                                   value="<?php echo htmlfilter($component->get_component_en()); ?>"/>
                            <?php echo Validator::get_html_error_message('name_en'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class=" col-sm-3 control-label" for="name"> <?php echo lang('Component'); ?> (<?php echo lang('Arabic'); ?>)</label>
                        <div class="col-sm-9">
                            <input name="name_ar" type="text" id="name_en" class="form-control"
                                   value="<?php echo htmlfilter($component->get_component_ar()); ?>"/>
                            <?php echo Validator::get_html_error_message('name_ar'); ?>
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
        <input type="hidden" name="component_type" id="component_type" value="<?php echo Orm_Tst_Exam::class ?>" />

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

    function getTests(current = 0)
    {
        var course_id = $("#course_block").val();
        var type = $("#type_block").val();
        $.ajax({
            url: "/assessment_metric/getTests/" + course_id + "/" + type + "/" + current,
            method:'GET'
        })
        .done(function( data ) {
            console.log(data);
            $("#test_block").html(data);
        })
        .error(function( XHR ,  textStatus,  errorThrown ){
                console.log("xhr " + XHR + " states " + textStatus + " error "+ errorThrown);
       });
    }

    function getTypes()
    {
        var html = '<option value=""><?php echo lang('All Types') ?></option>' +
            '<option value="<?php echo Orm_Tst_Exam::TYPE_EXAM ?>" <?php if(($test->get_id() || $type !== false) && ($test->get_type() == Orm_Tst_Exam::TYPE_EXAM || Orm_Tst_Exam::TYPE_EXAM == $type)) echo 'selected'; ?>><?php echo lang('Exam') ?></option> ' +
        '<option value="<?php echo Orm_Tst_Exam::TYPE_ASSIGNMENT ?>" <?php if($test->get_type() == Orm_Tst_Exam::TYPE_ASSIGNMENT || Orm_Tst_Exam::TYPE_ASSIGNMENT == $type) echo 'selected'; ?>><?php echo lang('Assignment') ?></option>' +
        '<option value="<?php echo Orm_Tst_Exam::TYPE_QUIZ ?>" <?php if($test->get_type() == Orm_Tst_Exam::TYPE_QUIZ || Orm_Tst_Exam::TYPE_QUIZ == $type) echo 'selected'; ?>><?php echo lang('Quiz') ?></option>';
        $("#type_block").html(html);
    }

    <?php if($test->get_id() || $course_id) echo 'getTypes()'; ?>

    <?php if($test->get_id() || $course_id) echo 'getTests("'.$test->get_id().'")'; ?>

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