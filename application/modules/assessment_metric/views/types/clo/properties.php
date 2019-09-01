<?php
/**
 * Created by PhpStorm.
 * User: abdelqader osama
 * Date: 11/4/17
 * Time: 1:24 PM
 *
 * @var $assessment_metric Orm_Am_Assessment_Metric
 *
 */
?>
<div class="row form-group">
    <label for="type" class="col-sm-3 control-label"><?php echo lang('Learning Domain Types'); ?></label>
    <div class="col-sm-9">
        <select name="type_id" id="type_id" class="form-control" onchange="get_domains(this);">
            <option value="0"> <?php echo lang('Select One')?></option>
            <?php foreach (Orm_Learning_Domain_Type::get_all() as $type) { ?>
                <?php $selected = ($type->get_id() == $assessment_metric->get_type() ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $type->get_id(); ?>" <?php echo $selected; ?> ><?php echo $type->get_name(); ?></option>
            <?php } ?>
        </select>
        <?php echo Validator::get_html_error_message('type_id'); ?>
    </div>
</div>
<div class="row form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Learning Domain'); ?></label>
    <div class="col-sm-9">
        <select id ="domain_block_wizard" name="extra_data[learning_domain]" class="form-control" onchange="select_leaning_domain();">
            <option value="-1"><?php echo lang('Select One'); ?></option>
            <?php
            foreach(Orm_Cm_Learning_Domain::get_all() as $domain) {
                $selected = (!is_null($assessment_metric->get_item_from_extra_data('learning_domain')) && $domain->get_id() == $assessment_metric->get_item_from_extra_data('learning_domain')) ? 'selected="selected"' : '';
                ?>
                <option value="<?php echo $domain->get_id() ?>" <?php echo $selected ?> ><?php echo $domain->get_title() ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="row form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Program Learning Domain'); ?></label>
    <div class="col-sm-9">
        <select name="extra_data[program_learning_outcome]" id="plo_selector" class="form-control" onchange="select_plos();">
            <option value="-1"><?php echo lang('Select One'); ?></option>
            <?php
            foreach(Orm_Cm_Program_Learning_Outcome::get_all(['learning_domain_id'=>$assessment_metric->get_item_from_extra_data('learning_domain')]) as $plo) {
                $selected = (!is_null($assessment_metric->get_item_from_extra_data('program_learning_outcome')) && $plo->get_id() == $assessment_metric->get_item_from_extra_data('program_learning_outcome')) ? 'selected="selected"' : '';
                ?>
                <option value="<?php echo $plo->get_id() ?>" <?php echo $selected ?> ><?php echo $plo->get_code().' - '.$plo->get_text() ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="row form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Course'); ?></label>
    <div class="col-sm-9">
        <select name="extra_data[course]" id="course_selector" class="form-control" onchange="select_course();">
            <option value="-1"><?php echo lang('Select One'); ?></option>
            <?php

            $courses = Orm_Cm_Course_Learning_Outcome::get_model()
                ->get_all([
                    'learning_domain_id'=>$assessment_metric->get_item_from_extra_data('learning_domain')?:-1,
                    'program_learning_outcome_id'=>$assessment_metric->get_item_from_extra_data('program_learning_outcome')?:-1
                ], 0, 10, [], Orm::FETCH_ARRAY);

            $courses = array_column($courses, 'course_id');
            $courses = array_unique($courses);

            if(count($courses)) {


                foreach (Orm_Course::get_all(['in_id' => $courses]) as $course) {
                    $selected = (!is_null($assessment_metric->get_item_from_extra_data('course')) && $course->get_id() == $assessment_metric->get_item_from_extra_data('course')) ? 'selected="selected"' : '';
                    ?>
                    <option
                        value="<?php echo $course->get_id() ?>" <?php echo $selected ?> ><?php echo $course->get_name() ?></option>
                <?php }
            }

            ?>

        </select>
    </div>
</div>

<div class="table-primary m-a-0">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('CLO Result') ?></span>
    </div>
    <table class="table table-striped m-a-0" id="clos_result">
        <?php echo $assessment_metric->ajax() ; ?>
    </table>
</div>

<script>
    function select_leaning_domain() {
        var data = $('#assessment-metric-form').serializeArray();

        data.push({name: 'filter_type', value:'plo'});

        $.ajax({
            type: "post",
            url: '/assessment_metric/draw_properties',
            data: data,
        }).done(function (html) {
            $('#plo_selector').html(html);
            $('#course_selector').val(-1).find('[value!=-1]').remove();
//            select_course();
            $('#clos_result').html('');
        });
    }

    function select_plos() {
        var data = $('#assessment-metric-form').serializeArray();

        data.push({name: 'filter_type', value:'course'});

        $.ajax({
            type: "post",
            url: '/assessment_metric/draw_properties',
            data: data,
        }).done(function (html) {
            $('#course_selector').html(html).val(-1);
//            select_course();
            $('#clos_result').html('');
        });
    }

    function select_course() {
        $.ajax({
            type: "POST",
            url: '/assessment_metric/ajax',
            data: $('#assessment-metric-form').serialize(),
        }).done(function (html) {
            $('#clos_result').html(html);
        });
    }
    function get_domains(element, option_only) {

        var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';
        if (option_only) {
            loading = '<option value="">Loading ...</option>';
        }

        $('#domain_block_wizard').html(loading);

        $.ajax({
            type: "POST",
            url: "/assessment_metric/get_domain",
            data: {
                type_id: $(element).val(),
                option_only: option_only,
            }
        }).done(function (msg) {
            $('#domain_block_wizard').html(msg);
        }).fail(function () {
            window.location.reload();
        });
    }
</script>