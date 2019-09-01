<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/curriculum_mapping/program/assessment_method_add_edit_component/{$program_assessment_method_id}", array('id' => 'assessment-component-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo Orm_Cm_Program_Assessment_Method::get_instance($program_assessment_method_id)->get_assessment_method_obj()->get_title() ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <button class="btn btn-block" onclick="add_more_assessment_component();" type="button">
                    <span class="btn-label-icon left"><i class="fa fa-plus"></i></span><?php echo lang('Add').' '.lang('Assessment Component'); ?>
                </button>
            </div>
            <div class="table-primary">
                <table class="table table-striped more_items" id="more_assessment_component">
                    <thead>
                    <tr>
                        <th><?php echo lang('Component'); ?> (<?php echo lang('English'); ?>)</th>
                        <th><?php echo lang('Component'); ?> (<?php echo lang('Arabic'); ?>)</th>
                        <th class="text-center"><?php echo lang('Select'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($components)) { ?>
                        <?php foreach ($components as $component_key => $component) { ?>
                            <?php if (!empty($component['component_id'])) { ?>
                                <?php
                                $program_component_id = !empty($component['program_component_id']) ? $component['program_component_id'] : 0;
                                $program_component_text_en = !empty($component['program_component_text_en']) ? $component['program_component_text_en'] : '';
                                $program_component_text_ar = !empty($component['program_component_text_ar']) ? $component['program_component_text_ar'] : '';
                                $component_text_en = !empty($program_component_text_en) ? $program_component_text_en : $component['component_title_en'];
                                $component_text_ar = !empty($program_component_text_ar) ? $program_component_text_ar : $component['component_title_ar'];
                                ?>
                                <tr class="item">
                                    <td class="col-md-5">
                                        <div class="form-group m-a-0-vr">
                                            <input type="text"
                                                   name="components[<?php echo intval($component_key) ?>][program_component_text_en]" <?php echo(empty($program_component_text_en) ? 'disabled="disabled"' : '') ?>
                                                   class="form-control program_component_<?php echo "{$component_key}" ?>"
                                                   value="<?php echo htmlfilter($component_text_en); ?>"/>
                                            <?php echo Validator::get_html_error_message('required_assessment_component_en_' . $component['component_id']); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-5">
                                        <div class="form-group m-a-0-vr">
                                            <input type="text"
                                                   name="components[<?php echo intval($component_key) ?>][program_component_text_ar]" <?php echo(empty($program_component_text_ar) ? 'disabled="disabled"' : '') ?>
                                                   class="form-control program_component_<?php echo "{$component_key}" ?>"
                                                   value="<?php echo htmlfilter($component_text_ar); ?>"/>
                                            <?php echo Validator::get_html_error_message('required_assessment_component_ar_' . $component['component_id']); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-2 valign-middle text-center">
                                        <input type="hidden"
                                               name="components[<?php echo intval($component_key) ?>][program_component_id]"
                                               value="<?php echo intval($program_component_id); ?>"
                                               class="form-control program_component_<?php echo "{$component_key}" ?>" <?php echo(empty($program_component_text_ar) ? 'disabled="disabled"' : '') ?>>
                                        <input type="hidden"
                                               name="components[<?php echo intval($component_key) ?>][component_id]"
                                               value="<?php echo intval($component['component_id']); ?>" >
                                        <input type="hidden"
                                               name="components[<?php echo intval($component_key) ?>][component_title_en]"
                                               value="<?php echo htmlfilter($component['component_title_en']); ?>" >
                                        <input type="hidden"
                                               name="components[<?php echo intval($component_key) ?>][component_title_ar]"
                                               value="<?php echo htmlfilter($component['component_title_ar']); ?>" >
                                        <div class="checkbox" style="margin: 0 auto; width: 40%;">
                                            <label class="px-single">
                                                <input type="checkbox" class="px"
                                                       onchange="select_program_component(this, '<?php echo "{$component_key}" ?>');" <?php echo(empty($program_component_id) ? '' : 'checked="checked"') ?> >
                                                <span class="lbl"></span>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            <?php } else { ?>
                                <tr class="item">
                                    <td class="col-md-5">
                                        <div class="form-group m-a-0-vr">
                                            <input type="text"
                                                   name="components[<?php echo intval($component_key) ?>][program_component_text_en]"
                                                   class="form-control"
                                                   value="<?php echo htmlfilter($component['program_component_text_en']); ?>"/>
                                            <?php echo Validator::get_html_error_message('required_assessment_component_en_' . $component_key); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-5">
                                        <div class="form-group m-a-0-vr">
                                            <input type="text"
                                                   name="components[<?php echo intval($component_key) ?>][program_component_text_ar]"
                                                   class="form-control"
                                                   value="<?php echo htmlfilter($component['program_component_text_ar']); ?>"/>
                                            <?php echo Validator::get_html_error_message('required_assessment_component_ar_' . $component_key); ?>
                                        </div>
                                    </td>
                                    <td class="col-md-2 valign-middle text-center">
                                        <input type="hidden"
                                               name="components[<?php echo intval($component_key) ?>][program_component_id]"
                                               value="<?php echo intval($component['program_component_id']); ?>"
                                               class="form-control">
                                        <button type="button" class="btn" aria-label="Left Align"
                                                onclick="eaa_remove_option(this);">
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

    $('#assessment-component-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {

            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    function select_program_component(elm, id) {
        if ($(elm).is(':checked')) {
            $('.program_component_' + id).removeAttr('disabled');
        } else {
            $('.program_component_' + id).attr('disabled', 'disabled');
        }
    }

    function add_more_assessment_component() {
        var key = new Date().getTime();

        var selector = '#more_assessment_component';

        var template = '<tr class="item">' +
            '<td class="col-md-5">' +
            '<input type="text" name="components[' + key + '][program_component_text_en]" class="form-control" />' +
            '</td>' +
            '<td class="col-md-5">' +
            '<input type="text" name="components[' + key + '][program_component_text_ar]" class="form-control" />' +
            '</td>' +
            '<td class="col-md-2 valign-middle text-center">' +
            '<input type="hidden" name="components[' + key + '][program_component_id]" class="form-control" >' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="eaa_remove_option(this);" >' +
            '<span class="fa fa-trash-o left" aria-hidden="true"></span>' +
            '</button>' +
            '</td>' +
            '</tr>';

        eaa_add_more(selector, template);
    }

</script>