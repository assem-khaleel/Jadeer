<?php
/** @var $meeting Orm_Mm_Meeting */

$college_id = intval($this->input->post('college_id'));
$department_id = intval($this->input->post('department_id'));
$program_id = intval($this->input->post('program_id'));
$unit_id = intval($this->input->post('unit_id'));


switch ($meeting->get_level()) {

    case Orm_Mm_Meeting::COLLEGE_LEVEL:
        $college_id = $meeting->get_level_id() ?: $college_id;
        $department_id = 0;
        $program_id = 0;
        break;

    case Orm_Mm_Meeting::PROGRAM_LEVEL:
        $college_id = Orm_Program::get_instance($meeting->get_level_id())->get_department_obj()->get_college_id() ?: $college_id;
        $department_id = Orm_Program::get_instance($meeting->get_level_id())->get_department_id() ?: $department_id;
        $program_id = $meeting->get_level_id() ?: $program_id;
        break;

    case Orm_Mm_Meeting::UNIT_LEVEL:
        $college_id = 0;
        $department_id = 0;
        $program_id = 0;
        $unit_id = $meeting->get_level_id() ?: $unit_id;
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
        <?php echo form_open("/advisory/save_meeting", array('id' => 'meeting-minutes-form')); ?>
        <div class="modal-header">
            <span
                    class="panel-title"><?php echo $meeting->get_id() ? lang('Edit') . ' ' . lang('Meeting Minutes') : lang('Add') . ' ' . lang('Meeting Minutes'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <?php if ($meeting->can_edit()): ?>

                    <?php if($user_login->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){ ?>

                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                                <div class="col-sm-9">
                                    <select id="item_type" name="level" class="form-control"
                                            onchange="change_item_type(this);">
                                        <?php
                                        foreach (Orm_Mm_Meeting::get_levels() as $item_type => $level_title) {
                                            $selected = ($item_type == $meeting->get_level() ? 'selected="selected"' : '');
                                            ?>
                                            <option
                                                value="<?php echo (int)$item_type ?>" <?php echo $selected ?>><?php echo htmlfilter($level_title) ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <?php echo Validator::get_html_error_message('level'); ?>
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
                                    <?php echo  Validator::get_html_error_message('program_id'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="unit_wrapper">
                            <div class="row">
                                <label class="col-sm-3 control-label"><?php echo lang('Unit') ?></label>
                                <div class="col-sm-9">
                                    <select id="unit_block" name="unit_id" class="form-control">
                                        <option value=""><?php echo lang('All Units') ?></option>
                                        <?php
                                        foreach (Orm_Unit::get_all() as $unit) {
                                            $selected = ($unit->get_id() == $unit_id ? 'selected="selected"' : '');
                                            ?>
                                            <option
                                                value="<?php echo (int)$unit->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($unit->get_name()) ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php echo Validator::get_html_error_message('unit_id'); ?>
                                </div>
                            </div>
                        </div>

                    <?php  } elseif($user_login->has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)){ ?>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-3 control-label"><?php echo lang('Level') ?></label>
                                <div class="col-sm-9">
                                    <select id="item_type" name="level" class="form-control"
                                            onchange="change_item_type(this);">
                                        <?php
                                        foreach (Orm_Mm_Meeting::get_levels() as $item_type => $level_title) {
                                            $selected = ($item_type == $meeting->get_level() ? 'selected="selected"' : '');
                                            ?>
                                            <option
                                                value="<?php echo (int)$item_type ?>" <?php echo $selected ?>><?php echo htmlfilter($level_title) ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <?php echo Validator::get_html_error_message('level'); ?>
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
                        <?php $this->load->view('add_edit_advisory'); ?>

                <?php } ?>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"
                                   for="facilitator_name"><?php echo lang('Coordinator') ?></label>
                            <div class="col-sm-9">
                                <input type="text"
                                       placeholder="<?php echo lang('Select') . ' ' . lang('Coordinator') ?>"
                                       onclick="find_users(this, 'facilitator_id', 'facilitator_name', null, ['<?php echo Orm_User::USER_FACULTY . "', '" . Orm_User::USER_STAFF ; ?>'])"
                                       readonly class="form-control"
                                       id="facilitator_name" name="facilitator_name"
                                       value="<?php if ($meeting->get_facilitator_id()) {
                                           echo $meeting->get_facilitator_id(true)->get_full_name();
                                       } ?>"/>
                                <input id="facilitator_id" name="facilitator_id" data-type="chair" type="hidden"
                                       value="<?php echo $meeting->get_facilitator_id(); ?>"/>
                                <?php echo  Validator::get_html_error_message('facilitator_id'); ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label"
                                   for="name"><?php echo lang('Meeting Subject') ?></label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="<?php echo lang('Meeting Subject') ?>" id="name"
                                       name="name" class="form-control" value="<?php echo $meeting->get_name() ?>">
                                <?php echo Validator::get_html_error_message('name'); ?>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

                <?php if ($meeting->get_id()): ?>
                    <hr/>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label" for="date"><?php echo lang('Date') ?></label>
                            <div class="col-sm-4">
                                <input type="text" placeholder="<?php echo lang('Date') ?>" id="date" name="date"
                                       name="date" class="form-control date"
                                       value="<?php echo $meeting->get_date()? htmlfilter($meeting->get_date()):'' ?>">
                                <?php echo Validator::get_html_error_message('date'); ?>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <input type="text" placeholder="<?php echo lang('Start Time') ?>" id="start_time"
                                           name="start_time"
                                           class="form-control time" value="<?php echo $meeting->get_start_time() ?>">

                                    <span class="input-group-addon bootstrap-timepicker-trigger"><?php echo lang('To')?></span>
                                    <input type="text" placeholder="<?php echo lang('End Time') ?>" id="end_time"
                                           name="end_time"
                                           class="form-control time" value="<?php echo $meeting->get_end_time() ?>">

                                </div>
                                <?php echo Validator::get_html_error_message('start_time'); ?>
                                <?php echo Validator::get_html_error_message('end_time'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-3 control-label" for="type_class"><?php echo lang('Type') ?></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" disabled=""
                                       value="<?php echo Orm_Mm_Meeting::get_type($meeting->get_type_class()) ?>">
                                <?php echo Validator::get_html_error_message('type_class'); ?>
                                <?php echo Validator::get_html_error_message('type_id'); ?>
                            </div>
                        </div>
                    </div>

                <?php else: ?>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="date"><?php echo lang('Date') ?></label>
                        <div class="col-sm-4">
                            <input type="text" placeholder="<?php echo lang('Date') ?>" id="date" name="date"
                                   class="form-control date"
                                   value="<?php echo $meeting->get_date() ? htmlfilter($meeting->get_date()) :'' ?>">
                            <?php echo Validator::get_html_error_message('date'); ?>
                        </div>

                        <div class="col-sm-5">
                            <div class="input-group">
                                <input type="text" placeholder="<?php echo lang('Start Time') ?>" id="start_time"
                                       name="start_time"
                                       class="form-control time" value="<?php echo $meeting->get_start_time() ?>">

                                <span class="input-group-addon bootstrap-timepicker-trigger"><?php echo lang('To')?></span>
                                <input type="text" placeholder="<?php echo lang('End Time') ?>" id="end_time"
                                       name="end_time"
                                       class="form-control time" value="<?php echo $meeting->get_end_time() ?>">

                            </div>
                            <?php echo Validator::get_html_error_message('start_time'); ?>
                            <?php echo Validator::get_html_error_message('end_time'); ?>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label" for="type_class"><?php echo lang('Type') ?></label>
                        <div class="col-sm-9">

                            <select name="type_class" id="type_class" class="form-control">
                                <option value="0"><?php echo lang('Select One') ?></option>
                                <?php// foreach (Orm_Mm_Meeting::get_types() as $key => $type) { ?>
                                    <option <?php echo($meeting->get_type_class() == 'Orm_Mm_Meeting_Advisory'? 'selected="selected"' : '')
                                    ?> value="<?php echo htmlfilter('Orm_Mm_Meeting_Advisory') ?>"><?php echo lang('Meeting Advisory') ?>
                                    </option>
                                <?php //} ?>
                            </select>
                            <?php echo Validator::get_html_error_message('type_class'); ?>
                            <?php echo Validator::get_html_error_message('type_id'); ?>
                        </div>
                    </div>
                </div>

                    <?php endif; ?>
                <div class="form-group" id="type_filter">
                    <?php echo $meeting->draw_properties() ?>
                </div>
                </div>
            <?php  if (Orm_Mm_Meeting::need_room()) { ?>
                <div class="form-group">
                    <div class="row">
                            <button type="button" id="roomBtn" class="btn  btn-block">
                                <span class="btn-label-icon left"><i
                                            class="fa fa-plus"></i></span><?php echo lang('Rooms'); ?>
                            </button>
                    </div>
                    <?php echo Validator::get_html_error_message_no_arrow('select_room'); ?>
                </div>
                <input type="hidden" name="current_room_id"  id="current_room_id" value="<?php echo $meeting->get_room_id()?>"/>
                <?php echo Modules::run('meeting_minutes/load_room', [1]) ?>
            <?php } ?>

            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" id="id" value="<?php echo intval($meeting->get_id()) ?>"/>
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
        init_data_toggle();

        var $changeDT=0;
        $('#search-tab').html('');

        $('.date').click(function () {
            $('#search-tab').html('');
            $changeDT=1;
        });

        $('.time').click(function () {
            $('#search-tab').html('');
            $changeDT=1;
        });



        $('#type_class').change(function () {
            $.get('/meeting_minutes/draw_properties', {
                'id': $('#id').val(),
                'type_class': $(this).val()
            }).done(function (html) {
                $('#type_filter').html(html);

            });
        });

        function change_item_type(elm) {
            item_type = $(elm).val();

            switch (item_type) {
                case '<?php echo Orm_Mm_Meeting::INSTITUTION_LEVEL ?>' :
                    $('#college_wrapper').hide();
                    $('#department_wrapper').hide();
                    $('#program_wrapper').hide();
                    $('#unit_wrapper').hide();
                    break;

                case '<?php echo Orm_Mm_Meeting::COLLEGE_LEVEL ?>' :
                    $('#college_wrapper').show();
                    $('#department_wrapper').hide();
                    $('#program_wrapper').hide();
                    $('#unit_wrapper').hide();
                    break;

                case '<?php echo Orm_Mm_Meeting::PROGRAM_LEVEL ?>' :
                    $('#college_wrapper').show();
                    $('#department_wrapper').show();
                    $('#program_wrapper').show();
                    $('#unit_wrapper').hide();
                    break;

                case '<?php echo Orm_Mm_Meeting::UNIT_LEVEL ?>' :
                    $('#college_wrapper').hide();
                    $('#department_wrapper').hide();
                    $('#program_wrapper').hide();
                    $('#unit_wrapper').show();
                    break;
            }
        }

        change_item_type($('#item_type'));

        $('#meeting-minutes-form').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serializeArray(),
                dataType: 'JSON'
            }).done(function (msg) {
                if (msg.success) {
                    window.location.reload();
                } else {
                    $('#ajaxModalDialog').html(msg.html);
                }
            });
        });

        $(".date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '<?php echo date('Y-m-d'); ?>'
        });

        $('.time').timepicker({
            scrollDefault: 'now',
            format: '00:00',
            autoclose: true
        });


        function search(btn) {
            $(btn).button('load');
            $.get('/meeting_minutes/load_room', {keyword: $('#keyword').val(),start_time: $('#start_time').val(),
                end_time: $('#end_time').val(),
                date: $('#date').val()})
                .done(function (msg) {
                    $('#search-tab').html(msg);
                });
        }
        $('#roomBtn').on('click', function (e) {
            e.preventDefault();
            $.get({
                url: '/meeting_minutes/load_room',
                data: {
                    current_room_id: $('#current_room_id').val(),
                    start_time: $('#start_time').val(),
                    end_time: $('#end_time').val(),
                    date: $('#date').val(),
                    changeDT:$changeDT
                }
            }).done(function (msg) {
                $('#search-tab').html(msg);
            });
        });

        $('#clear').click(function () {
            $('input[name="room_id"]').prop('checked', false);
        });

        $('#keyword').keydown(function (e) {
            if (e.which == 13) {
                $(this).parent().find('button').click();
                e.preventDefault();
            }

        });

    </script>
