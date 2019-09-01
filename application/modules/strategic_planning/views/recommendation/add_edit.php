<?php
/* @var $recommendation Orm_Sp_Recommendation */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($recommendation->get_id())) {
                echo lang('Create').' '.lang('Recommendation');
            } else {
                echo lang('Edit').' '.lang('Recommendation');
            }
            ?>
        </div>
        <?php echo form_open("",'id="recommendation-form" class="form-horizontal"') ?>
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo lang('College'); ?></label>
                    <div class="col-sm-10">
                        <select name="college_id" class="form-control" onchange="get_programs_by_college(this, 0, 1,'_modal'); $('#program_block_modal').html('<option value><?php echo lang('All Programs') ?></option>');">
                            <option value=""><?php echo lang('All Colleges'); ?></option>
                            <?php foreach (Orm_College::get_all() as $college) { ?>
                                <?php $selected = $college->get_id() == $recommendation->get_program_obj()->get_department_obj()->get_college_id() ? 'selected="selected"' : ''; ?>
                                <option value="<?php echo $college->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                            <?php } ?>
                        </select>
                        <?php echo Validator::get_html_error_message('program_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?php echo lang('Program'); ?></label>
                    <div class="col-sm-10">
                        <select name="program_id" class="form-control" id="program_block_modal">
                            <option value=""><?php echo lang('All Programs'); ?></option>
                            <?php if ($recommendation->get_program_id()) { ?>
                                <?php foreach (Orm_Program::get_all(array('college_id' => $recommendation->get_program_obj()->get_department_obj()->get_college_id())) as $program) { ?>
                                    <?php $selected = $program->get_id() == $recommendation->get_program_id() ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo $program->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <?php echo Validator::get_html_error_message('program_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="recommendation-type" class="col-sm-2 control-label"><?php echo lang('Type'); ?></label>

                    <div class="col-sm-10">
                        <select name="recommendation_type_id" class="form-control" id="recommendation-type">
                            <option value=""><?php echo lang('Select One'); ?></option>
                            <?php foreach (Orm_Sp_Recommendation_Type::get_all() as $key => $obj) : ?>
                                <?php $selected = ($obj->get_id() == $recommendation->get_recommendation_type_id() ? 'selected="selected"' : '') ?>
                                <option
                                    value="<?php echo (int)$obj->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($obj->get_title()); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php echo Validator::get_html_error_message('recommendation_type_id'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="recommendation_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('English'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_en" class="form-control"
                               value="<?php echo htmlfilter($recommendation->get_title_en()); ?>"
                               id="recommendation_title"/>
                        <?php echo Validator::get_html_error_message('title_en'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="recommendation_title" class="col-sm-2 control-label"><?php echo lang('Title'); ?>
                        (<?php echo lang('Arabic'); ?>): *</label>

                    <div class="col-sm-10">
                        <input type="text" name="title_ar" class="form-control"
                               value="<?php echo htmlfilter($recommendation->get_title_ar()); ?>"
                               id="recommendation_title"/>
                        <?php echo Validator::get_html_error_message('title_ar'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="academic_year"
                           class="col-sm-2 control-label"><?php echo lang('Academic Year'); ?></label>

                    <div class="col-sm-10">
                        <input type="text" name="academic_year" class="form-control"
                               value="<?php echo $recommendation->get_academic_year() > 0 ? htmlfilter($recommendation->get_academic_year()) : ''; ?>"
                               id="academic_year"/>
                        <?php echo Validator::get_html_error_message('academic_year'); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo urlencode($recommendation->get_id()); ?>">
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();
    $(document).ready(function () {
        $('form#recommendation-form').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: '/strategic_planning/recommendation/save',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'JSON'
            }).done(function (msg) {
                if (msg.error == false) {
                    window.location.reload();
                } else {
                    $('#ajaxModalDialog').html(msg.html);
                }
            });
        });
    });
</script>