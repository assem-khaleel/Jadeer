<?php
/** @var int $section_id */
/** @var Orm_Cm_Course_Assessment_Method[] $assessment_methods */
/** @var Orm_Course $course */
/** @var $method_id */
/** @var $domains Orm_Cm_Course_Learning_Outcome[][] */
/** @var $questions array */
$items = array();
?>
<?php if ($method_id) { ?>
    <div class="col-md-9">
        <div class="well">
            <h3 class="m-a-0">
                <?php echo $method_id ? Orm_Cm_Course_Assessment_Method::get_instance($method_id)->get_text() : ''; ?>
                <button onclick="add_more_questions()" class="btn pull-right"><?php echo lang('Add').' '.lang('New Question'); ?></button>
            </h3>
        </div>
        <?php echo form_open("/curriculum_mapping/course_section/question_mapping/{$section_id}/{$method_id}", array('id' => 'course-section-form')); ?>
        <div class="table-primary">
            <div class="table-header">
                <div class="table-caption">
                    <?php echo lang('Skills, Questions or Dimensions'); ?>
                </div>
            </div>
            <table class="table table-bordered more_items" id="more_course_question">
                <thead>
                <tr>
                    <th class="col-md-5"><?php echo lang('Skill, Question or Dimension') ?></th>
                    <th class="col-md-1"><?php echo lang('Scale'); ?></th>
                    <th class="col-md-4"><?php echo lang('Learning Outcomes'); ?></th>
                    <th class="col-md-2"><?php echo lang('Delete'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($questions as $key => $question) { ?>
                    <tr class="item">
                        <td>
                            <div class="form-group m-a-0-vr">
                                <textarea name="questions[<?php echo $key; ?>][text]" class="form-control" ><?php echo htmlfilter($question['text']) ?></textarea>
                                <?php echo Validator::get_html_error_message('required_question_text_'.$key); ?>
                            </div>
                        </td>
                        <td>
                            <div class="form-group m-a-0-vr">
                                <input type="text" name="questions[<?php echo $key; ?>][scale]" value="<?php echo htmlfilter($question['scale']); ?>" class="form-control" >
                                <?php echo Validator::get_html_error_message('required_question_scale_'.$key); ?>
                            </div>

                        </td>
                        <td>
                            <div class="form-group m-a-0-vr">
                                <ul class="list-group m-a-0-vr">
                                    <?php foreach ($domains as $domain_id => $outcomes) { ?>
                                        <li class="list-group-item active"><?php echo htmlfilter(Orm_Cm_Learning_Domain::get_instance($domain_id)->get_title()); ?></li>
                                        <li class="list-group-item">
                                            <?php foreach ($outcomes as $outcome) { ?>
                                                <label class="checkbox-inline"><input type="checkbox" name="questions[<?php echo $key; ?>][outcomes][<?php echo intval($outcome->get_id()) ?>]" class="px" value="<?php echo intval($outcome->get_id()); ?>" <?php echo in_array($outcome->get_id(),isset($question['outcomes']) ? $question['outcomes'] : array()) ? 'checked="checked"' : ''; ?>><span class="lbl"><?php echo htmlfilter($outcome->get_code()); ?></span></label>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                                <span class="checkbox hidden"></span>
                                <?php echo Validator::get_html_error_message('required_question_outcomes_'.$key); ?>
                            </div>
                        </td>
                        <td class="valign-middle text-center">
                            <input type="hidden" name="questions[<?php echo $key; ?>][id]" value="<?php $question['id']; ?>">
                            <button type="button" class="btn" aria-label="Left Align" onclick="eaa_remove_option(this);" >
                                <span class="fa fa-trash-o btn-label-icon left" aria-hidden="true"></span><?php echo lang('Delete'); ?>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <div class="table-footer">
                <input type="hidden" name="course_id" value="<?php echo intval($course->get_id()); ?>">
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
                <div class="clearfix"></div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
<?php } else { ?>
    <div class="col-md-9">
        <div class="alert">
            <strong><?php echo lang('Warning') ?>!</strong> <?php echo lang('Please select an Assessment Method from left list'); ?>.
        </div>
    </div>
<?php } ?>
<script>
    $('#course-section-form').on('submit', function (e) {
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
                $('#questions').html(msg.html);
            }
        });
    });

    function add_more_questions() {
        var key = new Date().getTime();
        var selector = '#more_course_question';

        var template = '<tr class="item">' +
            '<td>' +
            '<textarea name="questions[' + key + '][text]" class="form-control" ></textarea>' +
            '</td>' +
            '<td>' +
            '<input type="text" name="questions[' + key + '][scale]" class="form-control" >' +
            '</td>' +
            '<td>' +
            '<ul class="list-group">' +
            <?php foreach ($domains as $domain_id => $outcomes) { ?>
            '<li class="list-group-item active"><?php echo htmlfilter(Orm_Cm_Learning_Domain::get_instance($domain_id)->get_title()); ?></li>' +
            '<li class="list-group-item">'+
            <?php foreach ($outcomes as $outcome) { ?>
            '<label class="checkbox-inline"><input type="checkbox" name="questions['+ key +'][outcomes][]" class="px" value="<?php echo $outcome->get_id() ?>" ><span class="lbl"><?php echo htmlfilter($outcome->get_code()); ?></span></label>'+
            <?php } ?>
            '</li>' +
            <?php } ?>
            '<ul>' +
            '</td>' +
            '<td class="valign-middle text-center">' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="eaa_remove_option(this);" >' +
            '<span class="fa fa-trash-o btn-label-icon left" aria-hidden="true"></span><?php echo lang('Delete'); ?>' +
            '</button>' +
            '<input type="hidden" name="questions[' + key + '][id]" class="form-control" >' +
            '</td>' +
            '</tr>';

        eaa_add_more(selector, template);
    }
</script>
