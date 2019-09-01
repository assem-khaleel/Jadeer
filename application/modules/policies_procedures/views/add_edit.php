<?php
/** @var $policy Orm_Policies_Procedures */

$college_id = intval($this->input->post('college_id'));
$department_id = intval($this->input->post('department_id'));
$program_id = intval($this->input->post('program_id'));
$user_login=Orm_User::get_logged_user();

switch ($policy->get_unit_type()) {

    case Orm_Policies_Procedures::UNIT_COLLEGE_LEVEL:
        $college_id = $policy->get_unit_id() ?: $college_id;
        $department_id = 0;
        $program_id = 0;
        break;

    case Orm_Policies_Procedures::UNIT_PROGRAM_LEVEL:
        $college_id = Orm_Program::get_instance($policy->get_unit_id())->get_department_obj()->get_college_id() ?: $college_id;
        $department_id = Orm_Program::get_instance($policy->get_unit_id())->get_department_id() ?: $department_id;
        $program_id = $policy->get_unit_id() ?: $program_id;
        break;

    default :
        $college_id = 0;
        $department_id = 0;
        $program_id = 0;
        break;
}

?>

<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="well">
            <?php echo form_open("/policies_procedures/save"); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                <select id="unit_type" name="unit_type" class="form-control" onchange="change_unit_type(this);">
                    <?php
                    foreach (Orm_Policies_Procedures::get_unit_types() as $unit_type => $unit_type_name) {
                        $selected = ($unit_type == $policy->get_unit_type() ? 'selected="selected"' : '');
                        ?>
                        <option
                            value="<?php echo (int)$unit_type ?>" <?php echo $selected ?>><?php echo htmlfilter($unit_type_name) ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo Validator::get_html_error_message('unit_type'); ?>
            </div>

            <?php if($user_login->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){ ?>
                <div class="form-group" id="college_wrapper">
                    <label class="control-label"><?php echo lang('College') ?></label>
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

                <div class="form-group" id="department_wrapper">
                    <label class="control-label"><?php echo lang('Department') ?></label>
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
                <div class="form-group" id="program_wrapper">
                    <label class="control-label"><?php echo lang('Program') ?></label>
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

            <?php } elseif($user_login->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){ ?>
                <div class="form-group" id="college_wrapper">
                    <label class="control-label"><?php echo lang('College') ?></label>
                    <select id="college_block" name="college_id" class="form-control"
                            onchange="get_departments_by_college(this, 0, 1);">
                        <option value="<?php echo (int)$user_login->get_college_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                    </select>
                    <?php echo Validator::get_html_error_message('college_id'); ?>
                </div>

                <div class="form-group" id="department_wrapper">
                    <label class="control-label"><?php echo lang('Department') ?></label>
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

                <div class="form-group" id="program_wrapper">
                    <label class="control-label"><?php echo lang('Program') ?></label>
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

            <?php }else{ ?>
                <div class="form-group" id="college_wrapper">
                    <label class="control-label"><?php echo lang('College') ?></label>
                    <select id="college_block" name="college_id" class="form-control">
                        <option value="<?php echo (int)$user_login->get_college_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                    </select>
                    <?php echo Validator::get_html_error_message('college_id'); ?>
                </div>
                <div class="form-group" id="department_wrapper">
                    <label class="control-label"><?php echo lang('Department') ?></label>
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

                <div class="form-group" id="program_wrapper">
                    <label class="control-label"><?php echo lang('Program') ?></label>
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

            <?php } ?>




            <div class="form-group">
                <label class="control-label"><?php echo lang('Policies & Procedures Managers') ?></label>

                <div id="more_users" class="more_items well">
                    <?php
                    if (!empty($user_ids)) {
                        foreach ($user_ids as $key => $user_id) {
                            ?>
                            <div class="item m-y-1">
                                <div class="form-group m-a-0">
                                    <input id="user_label_<?php echo $key ?>" type="text"
                                           onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>','',['Orm_User_Faculty','Orm_User_Staff'],'<?php echo lang('Find Managers'); ?>')"
                                           readonly class="form-control"
                                           value="<?php echo($user_id ? htmlfilter(Orm_User::get_instance($user_id)->get_full_name()) : ''); ?>"/>
                                    <input id="user_id_<?php echo $key ?>" name="user_ids[<?php echo $key ?>]"
                                           type="hidden"
                                           value="<?php echo $user_id; ?>"/>
                                    <?php echo Validator::get_html_error_message('user_id', $key); ?>
                                </div>
                                <?php if ($key) { ?>
                                    <button type="button" class="btn" aria-label="Left Align"
                                            onclick="remove_user(this);" style="margin-top: 5px;">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>
                                    </button>
                                <?php } ?>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="item m-y-1">
                            <div class="form-group m-a-0">
                                <input id="user_label_0" type="text"
                                       onclick="find_users(this,'user_id_0','user_label_0','',['Orm_User_Faculty','Orm_User_Staff'],'<?php echo lang('Find Managers'); ?>')"
                                       readonly
                                       class="form-control"/>
                                <input id="user_id_0" name="user_ids[0]" type="hidden"/>
                            </div>
                        </div>
                    <?php } ?>

                    <?php echo Validator::get_html_error_message_no_arrow('user_ids'); ?>
                </div>

                <div class="more_link">
                    <button type="button" class="btn" aria-label="Left Align" onclick="add_user();">
                        <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add').' '.lang('More'); ?>
                    </button>
                </div>

            </div>

            <div class="form-group">
                <label
                    class=" control-label"><?php echo lang('Policy & Procedure Name') . ' (' . lang('English') . ')' ?></label>
                <input type="text" id="title_en" name="title_en" class="form-control"
                       value="<?php echo htmlfilter($policy->get_title_en()) ?>">
                <?php echo Validator::get_html_error_message('title_en'); ?>
            </div>

            <div class="form-group">
                <label
                    class="control-label"><?php echo lang('Policy & Procedure Name') . ' (' . lang('Arabic') . ')' ?></label>
                <input type="text" id="title_ar" name="title_ar" class="form-control"
                       value="<?php echo htmlfilter($policy->get_title_ar()) ?>">
                <?php echo Validator::get_html_error_message('title_ar'); ?>
            </div>

            <div class="form-group">
                <label class=" control-label"
                       for="desc_en"><?php echo lang('Description') . ' (' . lang('English') . ')' ?></label>
                            <textarea class="form-control tiny" name="desc_en"
                                      id="desc_en"><?php echo xssfilter($policy->get_desc_en()) ?></textarea>
            </div>

            <div class="form-group">
                <label class=" control-label"
                       for="desc_ar"><?php echo lang('Description') . ' (' . lang('Arabic') . ')' ?></label>
                            <textarea class="form-control tiny" name="desc_ar"
                                      id="desc_ar"><?php echo xssfilter($policy->get_desc_ar()) ?></textarea>
            </div>

            <input type="hidden" name="id" value="<?php echo intval($policy->get_id()) ?>">
            <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
                <?php echo lang('Save Changes'); ?>
            </button>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>


<script type="text/javascript">

    function add_user() {
        var count = $('#more_users .item').length;
        $('#more_users').append('<div class="item m-y-1">' +
            '<div class="form-group m-a-0">' +
            '<input id="user_label_' + count + '" type="text" onclick="find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', \'\',[\'Orm_User_Faculty\',\'Orm_User_Staff\'],\'<?php echo lang('Find Managers'); ?>\')" readonly class="form-control"/>' +
            '<input id="user_id_' + count + '" name="user_ids[' + count + ']" type="hidden"/>' +
            '</div>' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="remove_user(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> Remove' +
            '</button>' +
            '</div>');
    }

    function remove_user(elemnt) {
        $(elemnt).parent('.item').find('textarea').each(function (index) {
            tinymce.remove(this);
        });
        $(elemnt).parent('.item').remove();
        $('#more_users .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                $(this).attr('name', String($(this).attr('name')).replace(/\[\d+\]/g, '[' + index + ']'));
            });
        });
    }

    function change_unit_type(elm) {

        unit_type = $(elm).val();

        switch (unit_type) {
            case '<?php echo Orm_Policies_Procedures::UNIT_INSTITUTION_LEVEL ?>' :
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                break

            case '<?php echo Orm_Policies_Procedures::UNIT_COLLEGE_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                break

            case '<?php echo Orm_Policies_Procedures::UNIT_PROGRAM_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').show();
                $('#program_wrapper').show();
                break
        }

    }

    change_unit_type($('#unit_type'));

</script>