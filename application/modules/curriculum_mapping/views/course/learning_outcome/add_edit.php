<?php
/** @var $program_id int */
/** @var $domain Orm_Cm_Learning_Domain */

$program_outcomes = Orm_Cm_Program_Learning_Outcome::get_program_learning_outcomes($program_id, $domain->get_id());
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/course/learning_outcome_add_edit/{$course_id}/{$domain->get_id()}" , array('id' => 'course-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Learning Outcome'); ?> - <?php echo Orm_course::get_instance($course_id)->get_name() ?></span>
        </div>
        <div class="modal-body">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span class="panel-title"><?php echo htmlfilter($domain->get_title()); ?></span>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <button class="btn btn-block" onclick="add_more_learning_outcome();" type="button">
                            <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                            <?php echo lang('Add').' '.lang('Learning Outcome'); ?>
                        </button>
                    </div>
                    <div class="table-primary">
                        <table class="table table-bordered more_items" id="more_learning_outcome">
                            <thead>
                            <tr>
                                <th class="col-md-1"><?php echo lang('Code'); ?></th>
                                <th class="col-md-4"><?php echo lang('Program Outcome'); ?></th>
                                <th class="col-md-3"><?php echo lang('Outcome') . ' ' . lang('English'); ?></th>
                                <th class="col-md-3"><?php echo lang('Outcome') . ' ' . lang('Arabic'); ?></th>
                                <th class="col-md-1"><?php echo lang('Select'); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($outcomes)) { ?>
                                <?php foreach ($outcomes as $outcome_key => $outcome) { ?>
                                    <?php
                                    $course_outcome_id = !empty($outcome['course_outcome_id']) ? $outcome['course_outcome_id'] : 0;
                                    $program_outcome_id = !empty($outcome['program_outcome_id']) ? $outcome['program_outcome_id'] : 0;
                                    $course_outcome_code = !empty($outcome['course_outcome_code']) ? $outcome['course_outcome_code'] : 0;
                                    $course_outcome_text_en = !empty($outcome['course_outcome_text_en']) ? $outcome['course_outcome_text_en'] : '';
                                    $course_outcome_text_ar = !empty($outcome['course_outcome_text_ar']) ? $outcome['course_outcome_text_ar'] : '';
                                    ?>
                                    <tr class="item">
                                        <td class="valign-middle text-center">
                                            <div class="form-group m-a-0-vr">
                                                <input type="text" name="outcomes[<?php echo intval($outcome_key) ?>][course_outcome_code]" value="<?php echo htmlfilter($course_outcome_code); ?>" class="form-control course_outcome_<?php echo "{$outcome_key}" ?>" >
                                                <?php echo Validator::get_html_error_message('required_learning_outcome_code_'.$outcome_key); ?>
                                            </div>
                                        </td>
                                        <td class="valign-middle text-center">
                                            <div class="form-group m-a-0-vr">
                                                <select class="form-control course_outcome_<?php echo "{$outcome_key}" ?>" name="outcomes[<?php echo intval($outcome_key) ?>][program_outcome_id]">
                                                    <?php foreach ($program_outcomes as $program_outcome) { ?>
                                                        <?php $selected = $program_outcome->get_id() == $program_outcome_id ? 'selected="selected"' : ''; ?>
                                                        <option value="<?php echo $program_outcome->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($program_outcome->get_text()); ?></option>
                                                    <?php } ?>
                                                </select>
                                                <?php echo Validator::get_html_error_message('required_learning_outcome_program_'.$outcome_key); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group m-a-0-vr">
                                                <textarea name="outcomes[<?php echo intval($outcome_key) ?>][course_outcome_text_en]" class="form-control course_outcome_<?php echo "{$outcome_key}" ?>" ><?php echo htmlfilter($course_outcome_text_en); ?></textarea>
                                                <?php echo Validator::get_html_error_message('required_learning_outcome_en_'.$outcome_key); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group m-a-0-vr">
                                                <textarea name="outcomes[<?php echo intval($outcome_key) ?>][course_outcome_text_ar]" class="form-control course_outcome_<?php echo "{$outcome_key}" ?>" ><?php echo htmlfilter($course_outcome_text_ar); ?></textarea>
                                                <?php echo Validator::get_html_error_message('required_learning_outcome_ar_'.$outcome_key); ?>
                                            </div>
                                        </td>
                                        <td class="valign-middle text-center">
                                            <input type="hidden" name="outcomes[<?php echo intval($outcome_key) ?>][course_outcome_id]" value="<?php echo intval($course_outcome_id); ?>" class="form-control course_outcome_<?php echo "{$outcome_key}" ?>">
                                            <button type="button" class="btn" aria-label="Left Align" onclick="eaa_remove_option(this);" >
                                                <span class="fa fa-trash-o  left" aria-hidden="true"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

    function add_more_learning_outcome() {
        var outcome = new Date().getTime();

        var selector = '#more_learning_outcome';
        var template = '<tr class="item">' +
            '<td>' +
            '<input type="text" name="outcomes[' + outcome + '][course_outcome_code]" class="form-control" >' +
            '</td>' +
            '<td>'+
            '<select class="form-control" name="outcomes['+ outcome +'][program_outcome_id]">' +
            <?php if (empty($program_outcomes)) { ?> '<option value=""></option>' + <?php } ?>
            <?php foreach ($program_outcomes as $program_outcome) { ?>
            '<option value="<?php echo $program_outcome->get_id(); ?>"><?php echo htmlfilter($program_outcome->get_text()); ?></option>' +
            <?php } ?>
            '</select>' +
            '</td>' +
            '<td>' +
            '<textarea name="outcomes[' + outcome + '][course_outcome_text_en]" class="form-control" ></textarea>' +
            '</td>' +
            '<td>' +
            '<textarea name="outcomes[' + outcome + '][course_outcome_text_ar]" class="form-control" ></textarea>' +
            '</td>' +
            '<td class="valign-middle text-center">' +
            '<input type="hidden" name="outcomes[' + outcome + '][course_outcome_id]" class="form-control" >' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="eaa_remove_option(this);" >' +
            '<span class="fa fa-trash-o left" aria-hidden="true"></span>' +
            '</button>' +
            '</td>' +
            '</tr>';

        eaa_add_more(selector, template);
    }

</script>