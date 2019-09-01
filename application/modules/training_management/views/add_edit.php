<?php
/* @var $training Orm_Tm_Training */

$college_id = intval($this->input->post('college_id'));
$college_ids = intval($this->input->post('college_ids'));
$department_id = intval($this->input->post('department_id'));
$program_ids = intval($this->input->post('program_ids'));

$user_login = Orm_User::get_logged_user();

switch ($training->get_level()) {

    case Orm_Tm_Training::COLLEGE_LEVEL:
        $college_ids = $training->get_level_ids() ?: $college_ids;
        $department_id = 0;
        $program_id = 0;
        break;

    case Orm_Tm_Training::PROGRAM_LEVEL:
        $college_id = Orm_College::get_instance($training->get_college_id())->get_id() ?: $college_id;
        $department_id = Orm_Department::get_instance($training->get_department_id())->get_id() ?: $department_id;
        $program_ids = $training->get_level_ids() ?: $program_ids;
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
            <?php echo form_open("/training_management/save"); ?>

            <?php if ($user_login->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)) { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                    <select id="level" name="level" class="form-control" onchange="change_unit_type(this);">
                        <?php
                        foreach (Orm_Tm_Training::get_unit_types() as $unit_type => $unit_type_name) {
                            $selected = ($unit_type == $training->get_level() ? 'selected="selected"' : '');
                            ?>
                            <option
                                    value="<?php echo (int)$unit_type ?>" <?php echo $selected ?>><?php echo htmlfilter($unit_type_name) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('level'); ?>
                </div>

                <div class="form-group" id="college_wrapper_selector">
                    <label class="control-label"><?php echo lang('College') ?></label>
                    <select id="college_block" name="level_ids[]" class="form-control select_elements"
                            multiple="multiple">
                        <option value=""><?php echo lang('All College') ?></option>
                        <?php
                        foreach (Orm_College::get_all() as $college) {
                            $selected = (in_array($college->get_id(), $level_ids) ? 'selected="selected"' : '');
                            ?>
                            <option
                                    value="<?php echo (int)$college->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($college->get_name()) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('level_ids'); ?>
                </div>

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
                            onchange="get_programs_by_department(this, 0, 1);">
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
                    <select id="program_block" name="level_ids[]" class="form-control select_elements"
                            multiple="multiple">
                        <option value=""><?php echo lang('All Program') ?></option>
                        <?php
                        if (!empty($department_id)) {

                            foreach (Orm_Program::get_all(array('department_id' => $department_id)) as $program) {
                                $selected = (in_array($program->get_id(), $level_ids) ? 'selected="selected"' : '');
                                ?>
                                <option
                                        value="<?php echo (int)$program->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($program->get_name()) ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('level_ids'); ?>
                </div>


            <?php } elseif ($user_login->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) { ?>


                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                    <select id="level" name="level" class="form-control" onchange="change_unit_type(this);">
                        <?php
                        foreach (Orm_Tm_Training::get_unit_types() as $unit_type => $unit_type_name) {
                            $selected = ($unit_type == $training->get_level() ? 'selected="selected"' : '');
                            ?>
                            <option
                                    value="<?php echo (int)$unit_type ?>" <?php echo $selected ?>><?php echo htmlfilter($unit_type_name) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('level'); ?>
                </div>

                <div class="form-group" id="college_wrapper_selector">
                    <label class="control-label"><?php echo lang('College') ?></label>
                    <select id="college_block" name="level_ids[]" class="form-control select_elements"
                            multiple="multiple">
                        <option value=""><?php echo lang('All College') ?></option>
                        <option value="<?php echo (int)$user_login->get_college_id() ?>"
                                selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                    </select>
                    <?php echo Validator::get_html_error_message('level_ids'); ?>
                </div>

                <div class="form-group" id="college_wrapper">
                    <label class="control-label"><?php echo lang('College') ?></label>
                    <select id="college_block" name="college_id" class="form-control"
                            onchange="get_departments_by_college(this, 0, 1);">
                        <option value=""><?php echo lang('All College') ?></option>
                        <option value="<?php echo (int)$user_login->get_college_id() ?>"
                                selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                    </select>
                    <?php echo Validator::get_html_error_message('college_id'); ?>
                </div>

                <div class="form-group" id="department_wrapper">
                    <label class="control-label"><?php echo lang('Department') ?></label>
                    <select id="department_block" name="department_id" class="form-control"
                            onchange="get_programs_by_department(this, 0, 1);">
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
                    <select id="program_block" name="level_ids[]" class="form-control select_elements"
                            multiple="multiple">
                        <option value=""><?php echo lang('All Program') ?></option>
                        <?php
                        if (!empty($department_id)) {

                            foreach (Orm_Program::get_all(array('department_id' => $department_id)) as $program) {
                                $selected = (in_array($program->get_id(), $level_ids) ? 'selected="selected"' : '');
                                ?>
                                <option
                                        value="<?php echo (int)$program->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($program->get_name()) ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('level_ids'); ?>
                </div>


            <?php } else { ?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                    <select id="level" name="level" class="form-control" onchange="change_unit_type(this);">
                        <?php
                        foreach (Orm_Tm_Training::get_unit_types() as $unit_type => $unit_type_name) {
                            $selected = ($unit_type == $training->get_level() ? 'selected="selected"' : '');
                            ?>
                            <option
                                    value="<?php echo (int)$unit_type ?>" <?php echo $selected ?>><?php echo htmlfilter($unit_type_name) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('level'); ?>
                </div>

                <div class="form-group" id="college_wrapper_selector">
                    <label class="control-label"><?php echo lang('College') ?></label>
                    <select id="college_block" name="level_ids[]" class="form-control select_elements"
                            multiple="multiple">
                        <option value=""><?php echo lang('All College') ?></option>
                        <option value="<?php echo (int)$user_login->get_college_id() ?>"
                                selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                    </select>
                    <?php echo Validator::get_html_error_message('level_ids'); ?>
                </div>

                <div class="form-group" id="college_wrapper">
                    <label class="control-label"><?php echo lang('College') ?></label>
                    <select id="college_block" name="college_id" class="form-control"
                            onchange="get_departments_by_college(this, 0, 1);">
                        <option value=""><?php echo lang('All College') ?></option>
                        <option value="<?php echo (int)$user_login->get_college_id() ?>"
                                selected="selected"><?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?></option>
                    </select>
                    <?php echo Validator::get_html_error_message('college_id'); ?>
                </div>

                <div class="form-group" id="department_wrapper">
                    <label class="control-label"><?php echo lang('Department') ?></label>
                    <select id="department_block" name="department_id" class="form-control"
                            onchange="get_programs_by_department(this, 0, 1);">
                        <option value=""><?php echo lang('All Department') ?></option>
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
                    <select id="program_block" name="level_ids[]" class="form-control select_elements"
                            multiple="multiple">
                        <option value=""><?php echo lang('All Program') ?></option>
                        <?php
                        if (!empty($user_login->get_department_id())) {
                            ?>
                            <option value="<?php echo (int)$user_login->get_program_id() ?>" selected="selected"><?php echo htmlfilter($user_login->get_program_obj()->get_name()) ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <?php echo Validator::get_html_error_message('level_ids'); ?>
                </div>

            <?php } ?>
            <div class="form-group">
                <label
                        class=" control-label">
                    <?php echo lang('Name') . ' (' . lang('English') . ')' ?></label>
                <input type="text" id="name_en" name="name_en" class="form-control"
                       value="<?php echo htmlfilter($training->get_name_en()) ?>">
                <?php echo Validator::get_html_error_message('name_en'); ?>
            </div>

            <div class="form-group">
                <label
                        class="control-label">
                    <?php echo lang('Name') . ' (' . lang('Arabic') . ')' ?></label>
                <input type="text" id="name_ar" name="name_ar" class="form-control"
                       value="<?php echo htmlfilter($training->get_name_ar()) ?>">
                <?php echo Validator::get_html_error_message('name_ar'); ?>
            </div>

            <div class="form-group">
                <label
                        class="control-label"><?php echo lang('Duration') ?></label>
                <input type="text" id="duration" name="duration" class="form-control"
                       value="<?php echo htmlfilter($training->get_duration()) ?>">
                <?php echo Validator::get_html_error_message('duration'); ?>
            </div>

            <div class="form-group">
                <label
                        class="control-label"><?php echo lang('Date') ?></label>
                <input name="date" id="date" type="text" class="form-control date"
                       value="<?php echo $training->get_date() ? htmlfilter($training->get_date()) : '' ?>"/>
                <?php echo Validator::get_html_error_message('date'); ?>
            </div>

            <div class="form-group">
                <label
                        class="control-label"><?php echo lang('Type') ?></label>
                <select id="type_id" name="type_id" class="form-control">
                    <option value=""><?php echo lang('All Types') ?></option>
                    <?php
                    foreach (Orm_Tm_Type::get_all() as $type) {
                        $selected = ($type->get_id() == $training->get_type_id() ? 'selected="selected"' : '');
                        ?>
                        <option
                                value="<?php echo (int)$type->get_id() ?>"
                            <?php echo $selected ?>><?php echo htmlfilter($type->get_name()) ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php echo Validator::get_html_error_message('type_id'); ?>
            </div>

            <div class="form-group">
                <label
                        class="control-label"><?php echo lang('Organization') ?></label>
                <input type="text" id="organization" name="organization" class="form-control"
                       value="<?php echo htmlfilter($training->get_organization()) ?>">
                <?php echo Validator::get_html_error_message('organization'); ?>
            </div>

            <div class="form-group">
                <label
                        class="control-label"><?php echo lang('Location') ?></label>
                <input type="text" id="location" name="location" class="form-control"
                       value="<?php echo htmlfilter($training->get_organization()) ?>">
                <?php echo Validator::get_html_error_message('location'); ?>
            </div>

            <div class="form-group">
                <label class="col-md-3 control-label" for="status">
                    <?php echo lang('Training Status') ?>
                </label>
                <div class="col-md-9">
                    <?php foreach (Orm_Tm_Training::$status_list as $key => $status) {
                        /* @var $status Orm_Tm_Training */
                        $selected = ($key == $training->get_status() ? 'checked="checked"' : '');
                        ?>
                        <label class="custom-control custom-radio">
                            <input type="radio" name="status" class="custom-control-input"
                                   value="<?php echo intval($key) ?>" <?php echo $selected ?>>
                            <span class="custom-control-indicator"></span>
                            <?php echo lang($status); ?>
                        </label>
                    <?php } ?>
                </div>
            </div>

            <div class="form-group">
                <label class=" control-label"
                       for="instructor_information">
                    <?php echo lang('Instructor Information') ?></label>
                <textarea class="form-control tiny" name="instructor_information"
                          id="instructor_information">
            <?php echo xssfilter($training->get_instructor_information()) ?></textarea>
                <?php echo Validator::get_html_error_message_no_arrow('instructor_information'); ?>
            </div>

            <div class="form-group">
                <label class=" control-label"
                       for="description"><?php echo lang('Description') ?></label>
                <textarea class="form-control tiny" name="description"
                          id="description">
            <?php echo xssfilter($training->get_description()) ?></textarea>
                <?php echo Validator::get_html_error_message_no_arrow('description'); ?>
            </div>

            <div class="form-group">
                <label class=" control-label"
                       for="outline"><?php echo lang('Outline') ?></label>
                <textarea class="form-control tiny" name="outline"
                          id="outline">
            <?php echo xssfilter($training->get_training_outline()) ?></textarea>
                <?php echo Validator::get_html_error_message_no_arrow('outline'); ?>
            </div>

            <input type="hidden" name="id" value="<?php echo intval($training->get_id()) ?>">
            <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
                <?php echo lang('Save Changes'); ?>
            </button>
            <?php echo form_close(); ?>

        </div>
    </div>
</div>

<script type="text/javascript">

    function change_unit_type(elm) {

        unit_type = $(elm).val();

        switch (unit_type) {
            case '<?php echo Orm_Tm_Training::INSTITUTION_LEVEL ?>' :
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                $('#college_wrapper_selector').hide();
                break

            case '<?php echo Orm_Tm_Training::COLLEGE_LEVEL ?>' :
                $('#college_wrapper_selector').show();
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                break

            case '<?php echo Orm_Tm_Training::PROGRAM_LEVEL ?>' :
                $('#college_wrapper_selector').hide();
                $('#college_wrapper').show();
                $('#department_wrapper').show();
                $('#program_wrapper').show();
                break
        }

    }

    change_unit_type($('#level'));


    $(".date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    tinymce.init({
        selector: ".tiny",
        height: 200,
        theme: "modern",
        menubar: false,
        file_browser_callback: elFinderBrowser,
        font_size_style_values: "12px,13px,14px,16px,18px,20px",
        relative_urls: false,
        remove_script_host: false,
        statusbar: true,
        convert_urls: true,
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor"
        ],
        toolbar1: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | fontselect | fontsizeselect",
        toolbar2: "forecolor backcolor emoticons | link image | ltr rtl | print preview"
    });


    $('.select_elements').select2({
        placeholder: '<?php echo lang('Select Element');?>'
    });

</script>
<style>
    .select2-container {
        z-index: 1000000;
    }
</style>


