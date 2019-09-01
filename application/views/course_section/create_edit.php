<?php
/* @var $section Orm_Course_Section */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">

        <?php echo form_open("/course_section/save?course_id={$course->get_id()}"); ?>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Semester') ?></label>
            <select name="semester_id" class="form-control">
                <option value=""><?php echo lang('Select One') ?></option>
                <?php foreach (Orm_Semester::get_all() as $semester) : /* @var $semester Orm_Semester */ ?>
                    <?php $selected = ($section->get_semester_id() == $semester->get_id() ? 'selected="selected"' : ''); ?>
                    <option
                            value="<?php echo (int)$semester->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($semester->get_name()) ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo Validator::get_html_error_message('semester_id'); ?>
        </div>

        <div class="form-group">
            <label class="control-label" for="campus"><?php echo lang('Campus') ?></label>
            <select name="campus_id" id="campus" class="form-control">
                <option value=""><?php echo lang('Select One') ?></option>
                <?php foreach (Orm_Campus::get_all() as $campus) : /* @var $semester Orm_Semester */ ?>
                    <?php $selected = ($section->get_campus_id() == $campus->get_id() ? 'selected="selected"' : ''); ?>
                    <option
                            value="<?php echo $campus->get_id() ?>" <?php echo $selected ?>><?php echo htmlfilter($campus->get_name()) ?></option>
                <?php endforeach; ?>
            </select>
            <?php echo Validator::get_html_error_message('campus_id'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Section No') ?></label>
            <input name="section_no" type="text" class="form-control"
                   value="<?php echo htmlfilter($section->get_section_no()); ?>"/>
            <?php echo Validator::get_html_error_message('section_no'); ?>
        </div>

        <div class="form-group">
            <label class="control-label"><?php echo lang('Teachers') ?></label>

            <div id="more_teachers" class="more_items well">
                <?php
                if (!empty($teacher_ids)) {
                    foreach ($teacher_ids as $key => $teacher_id) {
                        ?>
                        <div class="item m-y-1">
                            <div class="form-group m-a-0">
                                <input id="user_label_<?php echo $key ?>" type="text"
                                       onclick="find_users(this,'user_id_<?php echo $key ?>','user_label_<?php echo $key ?>', '<?php echo Orm_User::USER_FACULTY ?>')"
                                       readonly class="form-control"
                                       value="<?php echo($teacher_id ? htmlfilter(Orm_User::get_instance($teacher_id)->get_full_name()) : ''); ?>"/>
                                <input id="user_id_<?php echo $key ?>" name="teacher_ids[<?php echo $key ?>]"
                                       type="hidden"
                                       value="<?php echo $teacher_id; ?>"/>
                                <?php echo Validator::get_html_error_message('teacher_id', $key); ?>
                            </div>
                            <?php if ($key) { ?>
                                <button type="button" class="btn" aria-label="Left Align"
                                        onclick="remove_teacher(this);" style="margin-top: 5px;">
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
                                   onclick="find_users(this,'user_id_0','user_label_0', '<?php echo Orm_User::USER_FACULTY ?>')"
                                   readonly
                                   class="form-control"/>
                            <input id="user_id_0" name="teacher_ids[0]" type="hidden"/>
                        </div>
                    </div>
                <?php } ?>

                <?php echo Validator::get_html_error_message_no_arrow('teacher_ids'); ?>
            </div>

            <div class="more_link">
                <button type="button" class="btn" aria-label="Left Align" onclick="add_teacher();">
                    <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add').' '.lang('More'); ?>
                </button>
            </div>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$section->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>

        <?php echo form_close(); ?>
    </div>
</div>


<script type="text/javascript">
    function add_teacher() {
        var count = $('#more_teachers .item').length;
        $('#more_teachers').append('<div class="item m-y-1">' +
            '<div class="form-group m-a-0">' +
            '<input id="user_label_' + count + '" type="text" onclick="find_users(this,\'user_id_' + count + '\',\'user_label_' + count + '\', \'<?php echo Orm_User::USER_FACULTY ?>\')" readonly class="form-control"/>' +
            '<input id="user_id_' + count + '" name="teacher_ids[' + count + ']" type="hidden"/>' +
            '</div>' +
            '<button type="button" class="btn" aria-label="Left Align" onclick="remove_teacher(this);" style="margin-top: 5px;" >' +
            '<span class="fa fa-trash-o" aria-hidden="true"></span> Remove' +
            '</button>' +
            '</div>');
    }

    function remove_teacher(elemnt) {
        $(elemnt).parent('.item').find('textarea').each(function (index) {
            tinymce.remove(this);
        });
        $(elemnt).parent('.item').remove();
        $('#more_teachers .item').each(function (index) {
            $(this).find('input, select, textarea').each(function () {
                $(this).attr('name', String($(this).attr('name')).replace(/\[\d+\]/g, '[' + index + ']'));
            });
        });
    }
</script>