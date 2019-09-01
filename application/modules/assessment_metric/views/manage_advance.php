<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 1/4/17
 * Time: 10:56 AM
 *
 * @var $assessment_metric Orm_Am_Assessment_Metric
 * @var $all_component Orm_Am_Metric_Item[]
 */
$final_result = 0;
?>
<div class="col-md-12 col-lg-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="well well-sm">
                <?php echo $assessment_metric->draw() ?>
            </div>
        </div>
    </div>
    <div class="table-primary">
        <div class="table-header">
            <div class="table-caption m-b-1">
                <?php echo htmlfilter(Orm_Program::get_instance($assessment_metric->get_program_id())->get_name()); ?>
                <div class="panel-heading-controls col-sm-7">
                    <a class="btn btn-sm pull-right m-a-1" data-toggle="ajaxModal"
                       href="/assessment_metric/add_component/<?php echo urlencode($assessment_metric->get_id()); ?>">
                        <span class="btn-label-icon left"><i
                                    class="fa fa-plus"></i></span> <?php echo lang('Add').' '.lang('Custom') ?>
                    </a>
                    <a class="btn btn-sm pull-right m-a-1" data-toggle="ajaxModal"
                       href="/assessment_metric/add_component_gradebook/<?php echo urlencode($assessment_metric->get_id()); ?>">
                        <span class="btn-label-icon left"><i
                                    class="fa fa-plus"></i></span> <?php echo lang('Add').' '.lang('From GradeBook') ?>
                    </a>
                    <a class="btn btn-sm pull-right m-a-1" data-toggle="ajaxModal"
                       href="/assessment_metric/add_component_survey/<?php echo urlencode($assessment_metric->get_id()); ?>">
                        <span class="btn-label-icon left"><i
                                    class="fa fa-plus"></i></span> <?php echo lang('Add').' '.lang('Survey') ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_open("/assessment_metric/save_average", array('id' => 'assessment-metric')); ?>

    <table class="table">
        <tbody>
        <tr>
            <?php if (!empty($all_component)) { ?>
                <td></td>
                <?php foreach ($all_component as $one_component) { ?>
                    <td>
                        <a class="" style="color: red;font-size: 15px;" data-toggle="deleteAction"
                           message="<?php echo lang('Are you sure ?') ?>"
                           href="/assessment_metric/delete_component/<?php echo $one_component->get_id() ?>">
                            <i class="fa   fa-remove fa- "></i>
                        </a>
                        <a class="" style="font-size: 15px;" data-toggle="ajaxModal"
                           href="/assessment_metric/edit_component/<?php echo urlencode($assessment_metric->get_id()); ?>/<?php echo $one_component->get_id() ?>/<?php echo $one_component->get_component_type() ?>">
                            <i class="fa  fa-edit"></i>
                        </a>
                    </td>
                <?php }
            } ?>
        </tr>
        <tr>
            <td class="col-md-1"><?php echo lang('Component'); ?> (<?php echo lang('Name') ?>)</td>
            <?php foreach ($all_component as $one_component) { ?>
                <td class="col-md-1">
                    <?php if ($lang = UI_LANG) {
                        echo $lang == 'arabic' ? $one_component->get_component_ar() : $one_component->get_component_en();
                    }
                    ?>

                </td>
            <?php } ?>
        </tr>


        <tr>
            <td class="col-md-1"><?php echo lang('Course'); ?></td>
            <?php foreach ($all_component as $one_component) {
                $courses = Orm_Course::get_all(['id' => $one_component->get_course_id()]);
                if ($courses) {
                    foreach ($courses as $course) {

                        echo '<td class="col-md-1">' . $course->get_name() . '</td>';
                    }
                } else {
                    echo '<td class="col-md-1">' . lang('None') . '</td>';
                }
            } ?>
        </tr>
        <tr>
            <td class="col-md-1"><?php echo lang('Component Value'); ?></td>
            <?php foreach ($all_component as $one_component) { ?>
                <td class="col-md-1"><?php echo $one_component->get_high_score() ?></td>
            <?php } ?>

        </tr>
        <tr>
            <td class="col-md-1"><?php echo lang('Assessment Weight'); ?></td>
            <?php foreach ($all_component as $one_component) { ?>
                <td class="col-md-1"><?php echo $one_component->get_weight() ?></td>
            <?php } ?>

        </tr>
        <tr>
            <td class="col-md-1"><?php echo lang('Average'); ?></td>
            <?php foreach ($all_component as $one_component) {
                if ($one_component->get_component_type() == null) {
                    ?>
                    <td class="form-group">
                        <input name="average[<?php echo $one_component->get_id() ?>]" type="text" id="average"
                               class="form-control"
                               value="<?php echo htmlfilter($one_component->get_average()); ?>"/>
                        <?php echo Validator::get_html_error_message("average_{$one_component->get_id()}"); ?>
                        <div id="<?php echo 'average_' . $one_component->get_id(); ?>"></div>
                    </td>
                <?php } else { ?>
                    <td class="col-md-1"><?php echo $one_component->get_average() ?></td>
                <?php }
            } ?>
        </tr>

        <tr>
            <td class="col-md-1"><?php echo lang('Result'); ?></td>
            <?php
            $sum_weight = 0;
            foreach ($all_component as $one_component) {
                $weight = $one_component->get_weight();
                $sum_weight += $weight;
            }
            foreach ($all_component as $one_component) {
                $final_result += $one_component->get_result();

                if ($sum_weight == 100) {
                    ?>
                    <td class="col-md-1"><?php echo round($one_component->get_result()) ?></td>
                <?php } else {
                    $final_result = lang('N/A');
                    ?>
                    <td class="col-md-1"><?php echo lang('N/A') ?></td>
                <?php }
            }
            ?>
        </tr>
        <div class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong><?php echo lang('Warning') ?>
                !</strong> <?php echo lang('Sum of Assessment Weight Should be 100 to View The Result and Final Result') ?>
        </div>
        </tbody>
    </table>

    <div class="well">
        <label>
            <?php echo lang('Final Result') . ' = ' ?>
            <?php echo round($final_result, 2) . ' % ' ?>
        </label>
    </div>

    <button id="submitBTN" type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
        <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
    </button>
    <input type="hidden" name="sum_weight" id="sum_weight" value="<?php echo isset($sum_weight) ? $sum_weight : 0; ?>"/>
    <input type="hidden" name="assessment_id" id="assessment_id"
           value="<?php echo intval($assessment_metric->get_id()) ?>"/>
    <?php echo form_close(); ?>
</div>
<script>

    $('form#assessment-metric').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: '/assessment_metric/save_average',
            data: $(this).serializeArray(),
            dataType: 'JSON'
        }).done(function (d) {
            if (d.success) {
                window.location.reload();
            } else {

                for (var i in d.errors) {
                    if (!d.errors.hasOwnProperty(i)) {
                        continue;
                    }

                    $('#' + i).text(d.errors[i]).addClass('form-message').parents(".form-group").addClass("form-message-light has-error");
                }

                if (d.hasOwnProperty('msg')) {
                    $.growl.danger({message: d.msg});
                }
            }

            $('#submitBTN').button('reset');
        });
    });
</script>