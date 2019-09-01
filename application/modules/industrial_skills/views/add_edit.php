<?php
/** @var Orm_Is_Industrial_Skills $industrial */
$program_id=$industrial->get_program_id();
$college_id=$industrial->get_college_id();
$user_login=Orm_User::get_logged_user();


?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/industrial_skills/save/{$industrial->get_id()}", 'id="industrial-form"') ?>

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($industrial->get_id())) {
                echo lang('Create') . ' ' . lang('Industrial Skills');
            } else {
                echo lang('Edit') . ' ' . lang('Industrial Skills');
            }
            ?>
        </div>

        <div class="modal-body">
            <?php if($user_login->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){ ?>

                <div class="form-group" id="college_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
                        <div class="col-sm-9">
                            <select id="college_block" name="college_id" class="form-control"
                                    onchange="get_programs_by_college(this, 0, 1);">
                                <option value=""><?php echo lang('All College') ?></option>
                                <?php
                                foreach (Orm_College::get_all() as $college) {
                                    $selected = ($college->get_id() == $college_id ? 'selected="selected"' : '');
                                    ?>
                                    <option
                                            value="<?php echo (int)$college->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($college->get_name()) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('college_id'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="program_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Program') ?></label>
                        <div class="col-sm-9">
                            <select id="program_block" name="program_id" class="form-control">
                                <option value=""><?php echo lang('All Program') ?></option>
                                <?php
                                if (!empty($college_id)) {
                                    foreach (Orm_Program::get_all(array('college_id' => $college_id)) as $program) {
                                        $selected = ($program->get_id() == $program_id ? 'selected="selected"' : '');
                                        ?>
                                        <option
                                                value="<?php echo (int)$program->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($program->get_name()) ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('program_id'); ?>
                        </div>
                    </div>
                </div>
            <?php } elseif($user_login->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){ ?>

                <div class="form-group" id="college_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
                        <div class="col-sm-9">
                            <select id="college_block" name="college_id" class="form-control"
                                    onchange="get_programs_by_college(this, 0, 1);">
                                <option value="<?php echo (int)$user_login->get_college_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                            </select>
                            <?php echo Validator::get_html_error_message('college_id'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="program_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Program') ?></label>
                        <div class="col-sm-9">
                            <select id="program_block" name="program_id" class="form-control">
                                <option value=""><?php echo lang('All Program') ?></option>
                                <?php
                                if (!empty($user_login->get_college_id())) {
                                    foreach (Orm_Program::get_all(array('college_id' => $user_login->get_college_id())) as $program) {
                                        $selected = ($program->get_id() == $program_id ? 'selected="selected"' : '');
                                        ?>
                                        <option
                                                value="<?php echo (int)$program->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($program->get_name()) ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('program_id'); ?>
                        </div>
                    </div>
                </div>

            <?php }else{ ?>
                <div class="form-group" id="college_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
                        <div class="col-sm-9">
                            <select id="college_block" name="college_id" class="form-control">
                                <option value="<?php echo (int)$user_login->get_college_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                            </select>
                            <?php echo Validator::get_html_error_message('college_id'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="program_wrapper">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Program') ?></label>
                        <div class="col-sm-9">
                            <select id="program_block" name="program_id" class="form-control">
                                <?php
                                if (!empty($user_login->get_college_id())) {
                                    ?>
                                    <option value="<?php echo (int)$user_login->get_program_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_program_obj()->get_name()) ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php echo Validator::get_html_error_message('program_id'); ?>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <div class="form-group">
                <label class="control-label"><?php echo lang('Industrial Skills Name'); ?></label>
                <div class="row">
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="name_en"
                               placeholder="<?php echo lang('Industrial Skills Name'); ?> ( <?php echo lang('English'); ?> )"
                               value="<?php echo $industrial->get_name_en(); ?>"/>
                        <?php echo Validator::get_html_error_message('name_en'); ?>
                    </div>
                    <div class="col-md-6">
                        <input class="form-control" type="text" name="name_ar"
                               placeholder="<?php echo lang('Industrial Skills Name'); ?> ( <?php echo lang('Arabic'); ?> )"
                               value="<?php echo $industrial->get_name_ar(); ?>"/>
                        <?php echo Validator::get_html_error_message('name_ar'); ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <button type="button" id="rubricBtn" class="btn  btn-block">
                                <span class="btn-label-icon left"><i
                                        class="fa fa-plus"></i></span><?php echo lang('Choose Rubrics'); ?>
                    </button>
                </div>
                <?php echo Validator::get_html_error_message('select_rubric'); ?>
            </div>
            <div id="search-rubric">
                <?php
                foreach (Orm_Is_Industrial_Relation::get_skill_ids($industrial->get_id()) as $skills):
                ?>
                    <input type="hidden" name="current_skills[]"  id="current_skills" value="<?php echo $skills ?>"/>
                <?php endforeach; ?>
            </div>

        </div>
        <input type="hidden" value="<?php echo (int) $industrial->get_id(); ?>" name="id">

        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left" data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
            <button class="btn btn-sm" type="submit" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
                <?php echo lang('Save Changes'); ?>
            </button>
        </div>

        <?php echo form_close() ?>
    </div>
</div>
<script>
    $('form#industrial-form').submit(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });


    $('#rubricBtn').on('click', function (e) {
        e.preventDefault();
        $.get({
            url: '/industrial_skills/load_rubric/<?php echo $industrial->get_id()?>'
        }).done(function (msg) {
            $('#search-rubric').html(msg);
        });
    });

    function change_item_type(elm) {

        var item_type = $(elm).val();

        switch (item_type) {
            case '<?php echo Orm_Is_Industrial_Skills::INDUSTRIAL_INSTITUTION_LEVEL ?>' :
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                break;

            case '<?php echo Orm_Is_Industrial_Skills::INDUSTRIAL_COLLEGE_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                break;

            case '<?php echo Orm_Is_Industrial_Skills::INDUSTRIAL_PROGRAM_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').show();
                $('#program_wrapper').show();
                break;


        }
    }

    change_item_type($('#item_type'));
</script>