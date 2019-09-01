<?php
/** @var $risk_management Orm_Rim_Risk_Management */

$college_id = intval($this->input->post('college_id'));
$department_id = intval($this->input->post('department_id'));
$program_id = intval($this->input->post('program_id'));
$unit_id = intval($this->input->post('unit_id'));
$user_login=Orm_User::get_logged_user();

switch ($risk_management->get_level_type()) {

    case Orm_Rim_Risk_Management::RISK_COLLEGE_LEVEL:
        $college_id    = $risk_management->get_level_id() ?: $college_id;
        $department_id = 0;
        $program_id    = 0;
        $unit_id       = 0;
        break;

    case Orm_Rim_Risk_Management::RISK_PROGRAM_LEVEL:
        $college_id    = Orm_Program::get_instance($risk_management->get_level_id())->get_department_obj()->get_college_id() ?: $college_id;
        $department_id = Orm_Program::get_instance($risk_management->get_level_id())->get_department_id() ?: $department_id;
        $program_id    = $risk_management->get_level_id() ?: $program_id;
        $unit_id       = 0;
        break;

    case Orm_Rim_Risk_Management::RISK_UNIT_LEVEL :
        $college_id    = 0;
        $department_id = 0;
        $program_id    = 0;
        $unit_id       = $risk_management->get_level_id() ?: $unit_id;
        break;

    default :
        $college_id    = 0;
        $department_id = 0;
        $program_id    = 0;
        $unit_id       = 0;
        break;
}

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/risk_management/save", array('id' => 'risk-management-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Risk Management'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <?php if($user_login->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){ ?>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                            <div class="col-sm-9">
                                <select id="level_type" name="level_type" class="form-control" onchange="change_level_type(this);">
                                    <?php
                                    foreach (Orm_Rim_Risk_Management::get_level_types() as $level_type => $level_type_name) {
                                        $selected = ($level_type == $risk_management->get_level_type() ? 'selected="selected"' : '');
                                        ?>
                                        <option value="<?php echo (int) $level_type ?>" <?php echo $selected ?>><?php echo htmlfilter($level_type_name) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php echo Validator::get_html_error_message('level_type'); ?>
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
                                <select id="level_type" name="level_type" class="form-control" onchange="change_level_type(this);">
                                    <?php
                                    foreach (Orm_Rim_Risk_Management::get_level_types() as $level_type => $level_type_name) {
                                        $selected = ($level_type == $risk_management->get_level_type() ? 'selected="selected"' : '');
                                        ?>
                                        <option value="<?php echo (int) $level_type ?>" <?php echo $selected ?>><?php echo htmlfilter($level_type_name) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <?php echo Validator::get_html_error_message('level_type'); ?>
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

                <div class="form-group <?php echo ($risk_management->get_id() ? 'hidden': '') ?>">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Risk Management Type') ?></label>
                        <div class="col-sm-9">
                            <select name="type_class" id="type_class" class="form-control">
                                <option value="0"><?php echo lang('Select One') ?></option>
                                <?php foreach(Orm_Rim_Risk_Management::get_type_types() as $type) { ?>
                                    <option <?php echo ($risk_management->get_type() == $type ? 'selected="selected"' : '') ?> value="<?php echo htmlfilter($type) ?>"><?php echo lang($type) ?></option>
                                <?php } ?>
                            </select>
                            <?php echo Validator::get_html_error_message('type'); ?>
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
                                <?php echo $risk_management->draw_properties(); ?>
                            </div>
                        </div>
                    </div>
                    <?php echo Validator::get_html_error_message('type_id'); ?>
                </div>

                <div class="form-group">
                    <label for="likely" class="col-sm-3 control-label"><?php echo lang('Likely'); ?> *</label>
                    <div>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="likely" value="1" <?php echo $risk_management->get_likely() == 1 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>1
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="likely" value="2" <?php echo $risk_management->get_likely() == 2 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>2
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="likely" value="3" <?php echo $risk_management->get_likely() == 3 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>3
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="likely" value="4" <?php echo $risk_management->get_likely() == 4 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>4
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="likely" value="5" <?php echo $risk_management->get_likely() == 5 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>5
                        </label>

                        <?php echo Validator::get_html_error_message('likely'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="severity" class="col-sm-3 control-label"><?php echo lang('Severity'); ?> *</label>
                    <div>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="severity" value="1" <?php echo $risk_management->get_severity() == 1 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>1
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="severity" value="2" <?php echo $risk_management->get_severity() == 2 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>2
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="severity" value="3" <?php echo $risk_management->get_severity() == 3 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>3
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="severity" value="4" <?php echo $risk_management->get_severity() == 4 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>4
                        </label>
                        <label class="custom-control custom-radio radio-inline">
                            <input type="radio" class="custom-control-input" name="severity" value="5" <?php echo $risk_management->get_severity() == 5 ? 'checked' : ''?>>
                            <span class="custom-control-indicator"></span>5
                        </label>

                        <?php echo Validator::get_html_error_message('severity'); ?>
                    </div>
                </div>

                <input type="hidden" name="id" id="id" value="<?php echo intval($risk_management->get_id())?>" />
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

    $('#type_class').on('change', function () {
        $.ajax({
            type: "POST",
            url: '/risk_management/draw_properties',
            data: $('#risk-management-form').serialize()
        }).done(function (html) {
            $('#item').html(html);
            init_data_toggle();
        });
    });

    function change_level_type(elm) {

        var level_type = $(elm).val();

        switch (level_type) {
            case '<?php echo Orm_Rim_Risk_Management::RISK_INSTITUTION_LEVEL ?>' :
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                $('#unit_wrapper').hide();
                break;

            case '<?php echo Orm_Rim_Risk_Management::RISK_COLLEGE_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                $('#unit_wrapper').hide();
                break;

            case '<?php echo Orm_Rim_Risk_Management::RISK_PROGRAM_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').show();
                $('#program_wrapper').show();
                $('#unit_wrapper').hide();
                break;

            case '<?php echo Orm_Rim_Risk_Management::RISK_UNIT_LEVEL ?>' :
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                $('#unit_wrapper').show();
                break;
        }
    }

    change_level_type($('#level_type'));

    $('#risk-management-form').on('submit', function (e) {
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

    $("#deadline").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: '<?php echo date('Y-m-d'); ?>'
    });

</script>