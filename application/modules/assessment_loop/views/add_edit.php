<?php
/** @var $assessment_loop Orm_Al_Assessment_Loop */

$college_id = intval($this->input->post('college_id'));
$department_id = intval($this->input->post('department_id'));
$program_id = intval($this->input->post('program_id'));
$unit_id = intval($this->input->post('unit_id'));
$user_login=Orm_User::get_logged_user();

switch ($assessment_loop->get_item_type()) {

    case Orm_Al_Assessment_Loop::ASSESSMENT_COLLEGE_LEVEL:
        $college_id = $assessment_loop->get_item_type_id() ?: $college_id;
        $department_id = 0;
        $program_id = 0;
        $unit_id = 0;
        break;

    case Orm_Al_Assessment_Loop::ASSESSMENT_PROGRAM_LEVEL:
        $college_id = Orm_Program::get_instance($assessment_loop->get_item_type_id())->get_department_obj()->get_college_id() ?: $college_id;
        $department_id = Orm_Program::get_instance($assessment_loop->get_item_type_id())->get_department_id() ?: $department_id;
        $program_id = $assessment_loop->get_item_type_id() ?: $program_id;
        $unit_id = 0;
        break;

    case Orm_Al_Assessment_Loop::ASSESSMENT_UNIT_LEVEL :
        $college_id = 0;
        $department_id = 0;
        $program_id = 0;
        $unit_id = $assessment_loop->get_item_type_id() ?: $unit_id;
        break;

    default :
        $college_id = 0;
        $department_id = 0;
        $program_id = 0;
        $unit_id = 0;
        break;
}

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/assessment_loop/save", array('id' => 'assessment-loop-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Assessment Loop'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">


                <?php if($user_login->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){ ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                            <div class="col-sm-9">
                                <select id="item_type" name="item_type" class="form-control"
                                        onchange="change_item_type(this);">
                                    <?php
                                    foreach (Orm_Al_Assessment_Loop::get_item_types() as $item_type => $item_type_name) {
                                        $selected = ($item_type == $assessment_loop->get_item_type() ? 'selected="selected"' : '');
                                        ?>
                                        <option value="<?php echo (int)$item_type ?>" <?php echo $selected ?>><?php echo htmlfilter($item_type_name) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php echo Validator::get_html_error_message('item_type'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="college_wrapper">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
                            <div class="col-sm-9">
                                <select id="college_block" name="college_id" class="form-control"
                                        onchange="get_departments_by_college(this, 0, 1);">
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

                    <div class="form-group" id="department_wrapper">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('Department') ?></label>
                            <div class="col-sm-9">
                                <select id="department_block" name="department_id" class="form-control"
                                        onchange="get_programs_by_department(this,0, 1);">
                                    <option value=""><?php echo lang('All Department') ?></option>
                                    <?php
                                    if (!empty($college_id)) {
                                        foreach (Orm_Department::get_all(array('college_id' => $college_id)) as $department) {
                                            $selected = ($department->get_id() == $department_id ? 'selected="selected"' : '');
                                            ?>
                                            <option
                                                    value="<?php echo (int)$department->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($department->get_name()) ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo Validator::get_html_error_message('department_id'); ?>
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
                                    if (!empty($department_id)) {
                                        foreach (Orm_Program::get_all(array('department_id' => $department_id)) as $program) {
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
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                            <div class="col-sm-9">
                                <select id="item_type" name="item_type" class="form-control"
                                        onchange="change_item_type(this);">
                                    <?php
                                    foreach (Orm_Al_Assessment_Loop::get_item_types() as $item_type => $item_type_name) {
                                        $selected = ($item_type == $assessment_loop->get_item_type() ? 'selected="selected"' : '');
                                        ?>
                                        <option value="<?php echo (int)$item_type ?>" <?php echo $selected ?>><?php echo htmlfilter($item_type_name) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php echo Validator::get_html_error_message('item_type'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="college_wrapper">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('College') ?></label>
                            <div class="col-sm-9">
                                <select id="college_block" name="college_id" class="form-control"
                                        onchange="get_departments_by_college(this, 0, 1);">
                                    <option value="<?php echo (int)$user_login->get_college_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                                </select>
                                <?php echo Validator::get_html_error_message('college_id'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="department_wrapper">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('Department') ?></label>
                            <div class="col-sm-9">
                                <select id="department_block" name="department_id" class="form-control"
                                        onchange="get_programs_by_department(this,0, 1);">
                                    <option value=""><?php echo lang('All Department') ?></option>
                                    <?php
                                    if (!empty($user_login->get_college_id())) {
                                        foreach (Orm_Department::get_all(array('college_id' => $user_login->get_college_id())) as $department) {
                                            $selected = ($department->get_id() == $department_id ? 'selected="selected"' : '');
                                            ?>
                                            <option
                                                    value="<?php echo (int)$department->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($department->get_name()) ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <?php echo Validator::get_html_error_message('department_id'); ?>
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
                                    if (!empty($department_id)) {
                                        foreach (Orm_Program::get_all(array('department_id' => $department_id)) as $program) {
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
                    <div class="form-group" id="department_wrapper">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('Department') ?></label>
                            <div class="col-sm-9">
                                <select id="department_block" name="department_id" class="form-control">
                                    <?php
                                    if (!empty($user_login->get_college_id())) {
                                        ?>
                                        <option value="<?php echo (int)$user_login->get_department_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_department_obj()->get_name()) ?></option>

                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php echo Validator::get_html_error_message('department_id'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="program_wrapper">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('Program') ?></label>
                            <div class="col-sm-9">
                                <select id="program_block" name="program_id" class="form-control">
                                    <?php
                                    if (!empty($user_login->get_department_id())) {
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
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Deadline') ?></label>
                        <div class="col-sm-9">
                            <input type="text" id="deadline" name="deadline" class="form-control" readonly
                                   value="<?php echo $assessment_loop->get_deadline() == '0000-00-00' ? '' : $assessment_loop->get_deadline(); ?>">
                            <?php echo Validator::get_html_error_message('deadline'); ?>
                        </div>
                    </div>
                </div>


                <div class="form-group <?php echo($assessment_loop->get_id() ? 'hidden' : '') ?>">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Assessment Loop Type') ?></label>
                        <div class="col-sm-9">
                            <select name="item_class" id="item_class" class="form-control">
                                <option value="0"><?php echo lang('Select One') ?></option>
                                <?php foreach (Orm_Al_Assessment_Loop::get_item_class_types() as $type) { ?>
                                    <option <?php echo($assessment_loop->get_item_class() == $type ? 'selected="selected"' : '') ?>
                                            value="<?php echo htmlfilter($type) ?>"><?php echo lang($type) ?></option>
                                <?php } ?>
                            </select>
                            <?php echo Validator::get_html_error_message('item_class'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="panel panel-primary m-a-0">
                            <div class="panel-heading">
                                <?php echo lang('Details'); ?>
                            </div>
                            <div class="panel-body" id="item">
                                <?php echo $assessment_loop->draw_properties(); ?>
                            </div>
                        </div>
                    </div>
                    <?php echo Validator::get_html_error_message('item_id'); ?>
                </div>

                <input type="hidden" name="id" id="id" value="<?php echo intval($assessment_loop->get_id()) ?>"/>
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

    $('#item_class').change(function () {
        $.ajax({
            type: "POST",
            url: '/assessment_loop/draw_properties',
            data: $('#assessment-loop-form').serialize()
        }).done(function (html) {
            $('#item').html(html);
            init_data_toggle();
        });
    });

    function change_item_type(elm) {

        var item_type = $(elm).val();

        switch (item_type) {
            case '<?php echo Orm_Al_Assessment_Loop::ASSESSMENT_INSTITUTION_LEVEL ?>' :
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                $('#unit_wrapper').hide();
                break;

            case '<?php echo Orm_Al_Assessment_Loop::ASSESSMENT_COLLEGE_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                $('#unit_wrapper').hide();
                break;

            case '<?php echo Orm_Al_Assessment_Loop::ASSESSMENT_PROGRAM_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').show();
                $('#program_wrapper').show();
                $('#unit_wrapper').hide();
                break;

            case '<?php echo Orm_Al_Assessment_Loop::ASSESSMENT_UNIT_LEVEL ?>' :
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                $('#unit_wrapper').show();
                break;
        }
    }

    change_item_type($('#item_type'));

    $('#assessment-loop-form').on('submit', function (e) {
        e.preventDefault();

        var files = $(":file:enabled", this);

        var $ajaxProp = {
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serializeArray(),
            dataType: 'JSON'
        };

        if (files.length) {
            $ajaxProp['files'] = files;
            $ajaxProp['iframe'] = true;
        }

        $.ajax($ajaxProp).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    $("#deadline").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: '<?php echo date('Y-m-d'); ?>'
    });

</script>