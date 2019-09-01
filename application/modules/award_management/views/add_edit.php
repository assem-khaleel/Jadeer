<?php
/** @var $award Orm_Wa_Award */

$college_id = intval($this->input->post('college_id'));
$department_id = intval($this->input->post('department_id'));
$program_id = intval($this->input->post('program_id'));
$user_login=Orm_User::get_logged_user();

switch ($award->get_level()) {

    case Orm_Wa_Award::COLLEGE_LEVEL:
        $college_id = $award->get_level_id() ?: $college_id;
        $department_id = 0;
        $program_id = 0;
        break;

    case Orm_Wa_Award::PROGRAM_LEVEL:
        $college_id = Orm_Program::get_instance($award->get_level_id())->get_department_obj()->get_college_id() ?: $college_id;
        $department_id = Orm_Program::get_instance($award->get_level_id())->get_department_id() ?: $department_id;
        $program_id = $award->get_level_id() ?: $program_id;
        break;
    default :
        $college_id = 0;
        $department_id = 0;
        $program_id = 0;
        break;
}
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/award_management/save", array('id' => 'award-form')); ?>
        <div class="modal-header">
            <span class="panel-title">
                <?php echo lang('Award Management'); ?>
            </span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                        <div class="col-sm-9">
                            <?php if($user_login->has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN)){
                                foreach (Orm_Wa_Award::get_levels() as $item_type => $level_title) {
                                    $selected = ($item_type == $award->get_level() ? 'selected="selected"' : ''); }
                                ?>
                            <input value="<?php echo (int)$item_type ?>" type="hidden" id="level" name="level" class="form-control">
                                <?php echo htmlfilter($level_title) ?>
                            </input>
                            <?php } elseif ($user_login->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) { ?>

                                <select id="item_type" name="level" class="form-control"
                                        onchange="change_item_type(this);">
                                    <?php
                                    foreach (Orm_Wa_Award::get_levels() as $item_type => $level_title) {

                                        $selected = ($item_type == $award->get_level() ? 'selected="selected"' : '');
                                        ?>
                                        <option
                                                value="<?php echo (int)$item_type ?>" <?php echo $selected ?>><?php echo htmlfilter($level_title) ?></option>
                                        <?php
                                        }
                                    ?>

                                    </select>

                                <?php } else {  ?>

                            <select id="item_type" name="level" class="form-control"
                                    onchange="change_item_type(this);">
                                <?php
                                foreach (Orm_Wa_Award::get_levels() as $item_type => $level_title) {
                                    $selected = ($item_type == $award->get_level() ? 'selected="selected"' : '');
                                    ?>
                                    <option
                                            value="<?php echo (int)$item_type ?>" <?php echo $selected ?>><?php echo htmlfilter($level_title) ?></option>
                                    <?php
                                }
                                ?>
                            </select>

                            <?php } ?>
                            <?php echo Validator::get_html_error_message('level'); ?>
                        </div>
                    </div>
                </div>
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
                                <input  type="hidden" value="<?php echo (int)$user_login->get_college_id() ?>" id="college_block" name="college_id" class="form-control">
                                <?php echo htmlfilter($user_login->get_college_obj()->get_name()) ?>
                                </input>
                                <?php echo Validator::get_html_error_message('college_id'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="department_wrapper">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('Department') ?></label>
                            <div class="col-sm-9">

                                <?php
                                if (!empty($user_login->get_college_id())) {?>
                                <input  type="hidden" value="<?php echo (int)$user_login->get_department_id() ?>" id="department_block" name="department_id" class="form-control">
                                <?php echo htmlfilter($user_login->get_department_obj()->get_name()) ?>
                                </input>

                                    <?php } ?>
                                <?php echo Validator::get_html_error_message('department_id'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="program_wrapper">
                        <div class="row">
                            <label class="col-sm-3 control-label"><?php echo lang('Program') ?></label>
                            <div class="col-sm-9">
                                <?php
                                if (!empty($user_login->get_department_id())) {
                                    ?>
                                <input   id="program_block" type="hidden" value="<?php echo (int)$user_login->get_program_id() ?>" name="program_id" class="form-control">

                                    <?php echo htmlfilter($user_login->get_program_obj()->get_name()) ;
                                }
                                ?>
                                <?php echo Validator::get_html_error_message('program_id'); ?>
                            </div>
                        </div>
                    </div>

                <?php } ?>

                <div class="row form-group">
                    <label for="title_en" class="col-sm-3 control-label">
                        <?php echo lang('Award Name') . ' ( ' . lang('English') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="name_en" id="editTitle_en" class="form-control"
                               placeholder="<?php echo lang('Award Name') . ' ( ' . lang('English') . ' ) ' ?>"
                               value="<?php echo htmlfilter($award->get_name_en()); ?>"/>
                        <?php echo Validator::get_html_error_message('name_en'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="title_ar" class="col-sm-3 control-label">
                        <?php echo lang('Award Name') . ' ( ' . lang('Arabic') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" name="name_ar" id="editTitle_ar" class="form-control"
                               placeholder="<?php echo lang('Award Name') . ' ( ' . lang('Arabic') . ' ) ' ?>"
                               value="<?php echo htmlfilter($award->get_name_ar()); ?>"/>
                        <?php echo Validator::get_html_error_message('name_ar'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="description_en"
                           class="col-sm-3 control-label">
                        <?php echo lang('Award Description') . ' ( ' . lang('English') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <textarea type="text" name="description_en" id="editDesc_en" class="form-control"
                                  placeholder="<?php echo lang('Award Description') . ' ( ' . lang('English') . ' ) ' ?>"><?php echo xssfilter($award->get_description_en()); ?></textarea>
                        <?php echo Validator::get_html_error_message('description_en'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="description_ar"
                           class="col-sm-3 control-label">
                        <?php echo lang('Award Description') . ' ( ' . lang('Arabic') . ' ) ' ?>
                    </label>
                    <div class="col-sm-9">
                        <textarea type="text" name="description_ar" id="editDesc_ar" class="form-control"
                                  placeholder="<?php echo lang('Award Description') . ' ( ' . lang('Arabic') . ' ) ' ?>"><?php echo xssfilter($award->get_description_ar()); ?></textarea>
                        <?php echo Validator::get_html_error_message('description_ar'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Date') ?>
                    </label>
                    <div class="col-sm-9">
                        <input type="text" id="date" name="date" class="form-control date-range"
                               placeholder="<?php echo lang('Date');?>"
                               value="<?php echo $award->get_date() == '0000-00-00' ? '' : date('Y-m-d', strtotime($award->get_date())) ?>">
                        <?php echo Validator::get_html_error_message('date'); ?>
                    </div>
                </div>

                <input type="hidden" name="id" id="id" value="<?php echo intval($award->get_id()) ?>"/>

            </div>
        </div>
        <div class="modal-footer">
            <div class=" text-right">
                <button type="button" class="btn pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left">
                        <i class="fa fa-times"></i>
                    </span>
                    <?php echo lang('Close'); ?>
                </button>
                <button type="submit" class="btn pull-right " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left">
                        <i class="fa fa-floppy-o"></i>
                    </span>
                    <?php echo lang('save'); ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">

    $('#award-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }).fail(function () {
            window.location.reload();
        });
    });
    function change_item_type(elm) {
        item_type = $(elm).val();
        switch (item_type) {
            case '<?php echo Orm_Wa_Award::INSTITUTION_LEVEL ?>' :
                $('#college_wrapper').hide();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                break;

            case '<?php echo Orm_Wa_Award::COLLEGE_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').hide();
                $('#program_wrapper').hide();
                break;

            case '<?php echo Orm_Wa_Award::PROGRAM_LEVEL ?>' :
                $('#college_wrapper').show();
                $('#department_wrapper').show();
                $('#program_wrapper').show();
                break;
        }
    }
    change_item_type($('#item_type'));

    $(".date-range").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: '<?php echo date('Y-m-d'); ?>'
    });
</script>