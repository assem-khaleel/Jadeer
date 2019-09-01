<?php
/** @var $program_id int */
/** @var $domain Orm_Cm_Learning_Domain */

//echo "<pre>";print_r($domain);die();
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/program/learning_outcome_add_edit/{$program_id}/{$domain->get_id()}" , array('id' => 'program-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo $domain->get_title(); ?></span>
        </div>
        <div class="modal-body">
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
                        <th><?php echo lang('Code'); ?></th>
                        <th><?php echo lang('Outcome') . ' ' . lang('English'); ?></th>
                        <th><?php echo lang('Outcome') . ' ' . lang('Arabic'); ?></th>
                        <th><?php echo lang('Select'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($outcomes)) { ?>
                        <?php foreach ($outcomes as $outcome_key => $outcome) { ?>
                            <?php if(!empty($outcome['outcome_id'])) { ?>
                                <?php
                                $program_outcome_id = !empty($outcome['program_outcome_id']) ? $outcome['program_outcome_id'] : 0;
                                $program_outcome_code = !empty($outcome['program_outcome_code']) ? $outcome['program_outcome_code'] : '';
                                $program_outcome_text_en = !empty($outcome['program_outcome_text_en']) ? $outcome['program_outcome_text_en'] : '';
                                $program_outcome_text_ar = !empty($outcome['program_outcome_text_ar']) ? $outcome['program_outcome_text_ar'] : '';
                                $outcome_text_en = !empty($program_outcome_text_en) ? $program_outcome_text_en : $outcome['outcome_title_en'];
                                $outcome_text_ar = !empty($program_outcome_text_ar) ? $program_outcome_text_ar : $outcome['outcome_title_ar'];
                                ?>
                                <tr class="item">
                                    <td class="col-md-1 valign-middle text-center">
                                        <div class="form-group m-a-0-vr">
                                            <input type="text" name="outcomes[<?php echo intval($outcome_key) ?>][program_outcome_code]" value="<?php echo htmlfilter($program_outcome_code); ?>" <?php echo(empty($program_outcome_text_en) ? 'disabled="disabled"' : '') ?> class="form-control program_outcome_<?php echo "{$outcome_key}" ?>" >
                                            <?php echo Validator::get_html_error_message('required_learning_outcome_code_'.$outcome_key); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-5">
                                        <div class="form-group m-a-0-vr">
                                            <textarea name="outcomes[<?php echo intval($outcome_key) ?>][program_outcome_text_en]" <?php echo(empty($program_outcome_text_en) ? 'disabled="disabled"' : '') ?> class="form-control program_outcome_<?php echo "{$outcome_key}" ?>" ><?php echo htmlfilter($outcome_text_en); ?></textarea>
                                            <?php echo Validator::get_html_error_message('required_learning_outcome_en_'.$outcome_key); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-5">
                                        <div class="form-group m-a-0-vr">
                                            <textarea name="outcomes[<?php echo intval($outcome_key) ?>][program_outcome_text_ar]" <?php echo(empty($program_outcome_text_ar) ? 'disabled="disabled"' : '') ?> class="form-control program_outcome_<?php echo "{$outcome_key}" ?>" ><?php echo htmlfilter($outcome_text_ar); ?></textarea>
                                            <?php echo Validator::get_html_error_message('required_learning_outcome_ar_'.$outcome_key); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-1 valign-middle text-center">
                                        <input type="hidden" name="outcomes[<?php echo intval($outcome_key) ?>][program_outcome_id]" value="<?php echo intval($program_outcome_id); ?>" class="form-control program_outcome_<?php echo "{$outcome_key}" ?>" <?php echo(empty($program_outcome_text_ar) ? 'disabled="disabled"' : '') ?>>
                                        <input type="hidden" name="outcomes[<?php echo intval($outcome_key) ?>][outcome_id]" value="<?php echo intval($outcome['outcome_id']); ?>" >
                                        <input type="hidden" name="outcomes[<?php echo intval($outcome_key) ?>][outcome_title_en]" value="<?php echo htmlfilter($outcome['outcome_title_en']); ?>" >
                                        <input type="hidden" name="outcomes[<?php echo intval($outcome_key) ?>][outcome_title_ar]" value="<?php echo htmlfilter($outcome['outcome_title_ar']); ?>" >
                                        <div class="checkbox">
                                            <label class="px-single">
                                                <input type="checkbox" class="px"
                                                       onchange="select_program_outcome(this, '<?php echo "{$outcome_key}" ?>');" <?php echo(empty($program_outcome_text_en) ? '' : 'checked="checked"') ?> >
                                                <span class="lbl"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <tr class="item">
                                    <td class="col-md-1 valign-middle text-center">
                                        <div class="form-group m-a-0-vr">
                                            <input type="text" name="outcomes[<?php echo intval($outcome_key) ?>][program_outcome_code]" value="<?php echo htmlfilter($outcome['program_outcome_code']); ?>" class="form-control program_outcome_<?php echo "{$outcome_key}" ?>" >
                                            <?php echo Validator::get_html_error_message('required_learning_outcome_code_'.$outcome_key); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-5">
                                        <div class="form-group m-a-0-vr">
                                            <textarea name="outcomes[<?php echo intval($outcome_key) ?>][program_outcome_text_en]" class="form-control" ><?php echo htmlfilter($outcome['program_outcome_text_en']); ?></textarea>
                                            <?php echo Validator::get_html_error_message('required_learning_outcome_en_'.$outcome_key); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-5">
                                        <div class="form-group m-a-0-vr">
                                            <textarea name="outcomes[<?php echo intval($outcome_key) ?>][program_outcome_text_ar]" class="form-control" ><?php echo htmlfilter($outcome['program_outcome_text_ar']); ?></textarea>
                                            <?php echo Validator::get_html_error_message('required_learning_outcome_ar_'.$outcome_key); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-1 valign-middle text-center">
                                        <input type="hidden" name="outcomes[<?php echo intval($outcome_key) ?>][program_outcome_id]" value="<?php echo intval($outcome['program_outcome_id']); ?>" class="form-control" >
                                        <button type="button" class="btn" aria-label="Left Align" onclick="eaa_remove_option(this);" >
                                            <span class="fa fa-trash-o left" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="domain_id" value="<?php echo $domain->get_id(); ?>">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $('#program-form').on('submit', function (e) {
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

    function select_program_outcome(elm, id){
        if($(elm).is(':checked')) {
            $('.program_outcome_' + id).removeAttr('disabled');
        } else {
            $('.program_outcome_' + id).attr('disabled', 'disabled');
        }
    }

    function add_more_learning_outcome() {

        var outcome = new Date().getTime();

        var selector = '#more_learning_outcome';

        var template = '<tr class="item">' +
            '<td class="col-md-1">' +
            '<input type="text" name="outcomes[' + outcome + '][program_outcome_code]" class="form-control" >' +
            '</td>' +
            '<td class="col-md-5">' +
            '<textarea name="outcomes[' + outcome + '][program_outcome_text_en]" class="form-control" ></textarea>' +
            '</td>' +
            '<td class="col-md-5">' +
            '<textarea name="outcomes[' + outcome + '][program_outcome_text_ar]" class="form-control" ></textarea>' +
            '</td>' +
            '<td class="col-md-1 valign-middle text-center">' +
            '<input type="hidden" name="outcomes[' + outcome + '][program_outcome_id]" class="form-control" >' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="eaa_remove_option(this);" >' +
            '<span class="fa fa-trash-o  left" aria-hidden="true"></span>' +
            '</button>' +
            '</td>' +
            '</tr>';

        eaa_add_more(selector, template);

    }
</script>