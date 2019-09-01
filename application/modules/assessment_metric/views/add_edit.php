<?php
/** @var $assessment_metric Orm_Am_Assessment_Metric */

$college_id = intval($this->input->post('college_id'));
$department_id = intval($this->input->post('department_id'));
$program_id = intval($this->input->post('program_id'));

$college_id    = $assessment_metric->get_college_id() ?: $college_id;
$department_id =$assessment_metric->get_department_id() ?: $department_id;
$program_id    = $assessment_metric->get_program_id() ?: $program_id;
$user_login=Orm_User::get_logged_user();


?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/assessment_metric/save", array('id' => 'assessment-metric-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Assessment Metric'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <?php if($user_login->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){ ?>
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
                    <label class=" col-sm-3 control-label" for="name"> <?php echo lang('Assessment Metric Name'); ?> (<?php echo lang('English'); ?>)</label>
                    <div class="col-sm-9">
                        <input name="name_en" type="text" id="name_en" class="form-control"
                               value="<?php echo htmlfilter($assessment_metric->get_name_en()); ?>" placeholder="<?php echo lang('Assessment Metric Name'); ?> (<?php echo lang('English'); ?>))"/>
                        <?php echo Validator::get_html_error_message('name_en'); ?>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class=" col-sm-3 control-label" for="name"> <?php echo lang('Assessment Metric Name'); ?> (<?php echo lang('Arabic'); ?>)</label>
                        <div class="col-sm-9">
                            <input name="name_ar" type="text" id="name_en" class="form-control"
                                   value="<?php echo htmlfilter($assessment_metric->get_name_ar()); ?>" placeholder="<?php echo lang('Assessment Metric Name'); ?> (<?php echo lang('Arabic'); ?>)"/>
                            <?php echo Validator::get_html_error_message('name_ar'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class=" col-sm-3 control-label" for="name"> <?php echo lang('Target'); ?></label>
                        <div class="col-sm-9">
                            <input name="target" type="text" id="target" class="form-control"
                                   value="<?php echo htmlfilter($assessment_metric->get_target()); ?>"/>
                            <?php echo Validator::get_html_error_message('target'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group  <?php echo ($assessment_metric->get_id() ? 'hidden': '') ?>">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Assessment Metric Level') ?></label>
                        <div class="col-sm-9">
                            <select name="level" id="level" class="form-control">
                                <option value=""><?php echo lang('Select One') ?></option>

                                        <?php if(!empty($assessment_metric->get_level())==2){ ?>
                                    <option <?php echo ($assessment_metric->get_level() == 2 ? 'selected="selected"' : '') ?> value="<?php echo 2 ?>"><?php echo lang('Simple') ?> </option>
                                            <option value="1"><?php echo lang('Advance') ?></option>
                        <?php }elseif(!empty($assessment_metric->get_level())==1){?>
                                            <option <?php echo ($assessment_metric->get_level() == 1 ? 'selected="selected"' : '') ?> value="<?php echo 1 ?>"><?php echo lang('Advance')  ?> </option>
                                            <option value="2"><?php echo lang('Simple') ?></option>
                                      <?php  }else{?>
                                <option value="1"><?php echo lang('Advance') ?></option>
                                <option value="2"><?php echo lang('Simple') ?></option>
                                <?php  }?>
                            </select>
                            <?php echo Validator::get_html_error_message('level'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group  <?php echo ($assessment_metric->get_id() ? 'hidden': '') ?>">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Assessment Metric Type') ?></label>
                        <div class="col-sm-9">
                            <select name="item_class" id="item_class" class="form-control">
                                <option value=""><?php echo lang('Select One') ?></option>
                                <?php foreach(Orm_Am_Assessment_Metric::get_item_class_types() as $type) { ?>
                                    <option <?php echo ($assessment_metric->get_item_class() == $type ? 'selected="selected"' : '') ?> value="<?php echo htmlfilter($type) ?>"><?php echo lang($type) ?></option>
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
                                <?php echo $assessment_metric->draw_properties(); ?>
                            </div>
                        </div>
                    </div>
                    <?php echo Validator::get_html_error_message('item_id'); ?>
                </div>
                <input type="hidden" name="old_level" id="old_level" value="<?php echo intval($assessment_metric->get_level())?>" />
                <input type="hidden" name="id" id="id" value="<?php echo intval($assessment_metric->get_id())?>" />
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#item_class').change(function () {
        $.ajax({
            type: "POST",
            url: '/assessment_metric/draw_properties',
            data: $('#assessment-metric-form').serialize()
        }).done(function (html) {
            $('#item').html(html);
            init_data_toggle();
        });
    });

    function change_item_type(elm) {

        $('#program_wrapper').show();
    }

    change_item_type($('#item_type'));

    $('#assessment-metric-form').on('submit', function (e) {
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
</script>