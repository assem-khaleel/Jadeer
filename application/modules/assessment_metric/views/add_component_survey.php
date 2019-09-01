<?php
/** @var $component Orm_Am_Metric_Item */
/** @var $assessment_metric Orm_Am_Assessment_Metric */

    Modules::run('survey');
    $survey_type = $this->input->post('type') ?: Orm_Survey::get_instance($component->get_component_id())->get_type();
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/assessment_metric/save_component_survey", array('id' => 'assessment-metric-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Add').' '.lang('Component'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group" id="survey_type">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Survey type') ?></label>
                        <div class="col-sm-9">
                            <select id="type_block" name="type" class="form-control" onchange="getSurveys()">
                                <option value=""><?php echo lang('All Types') ?></option>
                                <option value="<?php echo Orm_Survey::TYPE_STUDENTS ?>" <?php if (Orm_Survey::TYPE_STUDENTS == $survey_type) echo 'selected' ?>><?php echo lang('Student') ?></option>
                                <option value="<?php echo Orm_Survey::TYPE_FACULTY ?>" <?php if (Orm_Survey::TYPE_FACULTY == $survey_type) echo 'selected' ?>><?php echo lang('Faculty') ?></option>
                                <option value="<?php echo Orm_Survey::TYPE_STAFF ?>" <?php if (Orm_Survey::TYPE_STAFF == $survey_type) echo 'selected' ?>><?php echo lang('Staff') ?></option>
                                <option value="<?php echo Orm_Survey::TYPE_ALUMNI ?>" <?php if (Orm_Survey::TYPE_ALUMNI == $survey_type) echo 'selected' ?>><?php echo lang('Alumni') ?></option>
                                <option value="<?php echo Orm_Survey::TYPE_COURSES ?>" <?php if (Orm_Survey::TYPE_COURSES == $survey_type) echo 'selected' ?>><?php echo lang('Course') ?></option>
                            </select>
                            <?php echo Validator::get_html_error_message('type'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="surveys">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Surveys') ?></label>
                        <div class="col-sm-9">
                            <select id="surveys_block" name="surveys" class="form-control">
                                <option value=""><?php echo lang('All surveys') ?></option>
                            </select>
                            <?php echo Validator::get_html_error_message('surveys'); ?>
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
        <input type="hidden" name="component_type" id="component_type" value="<?php echo Orm_Survey::class ?>" />

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

    function getSurveys()
    {
        var survey_type = $("#type_block").val();
        $.ajax({
            url: "/assessment_metric/getSurveys/" + survey_type,
            method:'GET'
        })
        .done(function( data ) {
            $("#surveys_block").html(data);
            $("#surveys_block option[value='<?php echo $component->get_component_id() ?>']").attr('selected','selected');
        })
        .error(function( XHR ,  textStatus,  errorThrown ){
                console.log("xhr " + XHR + " states " + textStatus + " error "+ errorThrown);
       });
    }
    <?php if($survey_type) echo 'getSurveys()'; ?>


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