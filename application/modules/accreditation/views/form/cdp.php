<div class="form-group">
    <label class="control-label"><?php echo lang('College'); ?></label>
    <select name="college_id" class="form-control" onchange="get_departments(this,1);">
        <option value=""><?php echo lang('Select One'); ?></option>
        <?php foreach (Orm_College::get_all() as $college) { ?>
            <?php $selected = (isset($college_id) && $college->get_id() == $college_id ? 'selected="selected"' : ''); ?>
            <option
                value="<?php echo (int)$college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
        <?php } ?>
    </select>
    <?php echo Validator::get_html_error_message('college_id'); ?>
</div>
<div id="department_block_wizard">
    <?php if (!empty($college_id)): ?>
        <div class="form-group">
            <label class="control-label"><?php echo lang('Department'); ?></label>
            <select name="department_id" class="form-control" onchange="get_programs(this);">
                <option value=""><?php echo lang('Select One'); ?></option>
                <?php foreach (Orm_Department::get_all(array('college_id' => $college_id)) as $department) { ?>
                    <?php $selected = (isset($department_id) && $department->get_id() == $department_id ? 'selected="selected"' : ''); ?>
                    <option
                        value="<?php echo (int)$department->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($department->get_name()); ?></option>
                <?php } ?>
            </select>
            <?php echo Validator::get_html_error_message('department_id'); ?>
        </div>
        <div id="program_block_wizard">
            <?php if (!empty($department_id)): ?>
                <div class="form-group">
                    <label class="control-label"><?php echo lang('Program'); ?></label>
                    <select name="program_id" class="form-control">
                        <option value=""><?php echo lang('Select One'); ?></option>
                        <?php foreach (Orm_Program::get_all(array('department_id' => $department_id)) as $program) { ?>
                            <?php $selected = (isset($program_id) && $program->get_id() == $program_id ? 'selected="selected"' : ''); ?>
                            <option
                                value="<?php echo (int)$program->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                        <?php } ?>
                    </select>
                    <?php echo Validator::get_html_error_message('program_id'); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script>

    function get_departments(element, enable_programs, option_only) {

        var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';
        if (option_only) {
            loading = '<option value="">Loading ...</option>';
        }

        $('#department_block_wizard').html(loading);

        $.ajax({
            type: "POST",
            url: "/department/get_departments",
            data: {
                college_id: $(element).val(),
                enable_programs: enable_programs,
                option_only: option_only,
                block_name: '_wizard'
            }
        }).done(function (msg) {
            $('#department_block_wizard').html(msg);
        }).fail(function () {
            window.location.reload();
        });
    }

    function get_programs(element, option_only) {

        var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';
        if (option_only) {
            loading = '<option value="">Loading ...</option>';
        }

        $('#program_block_wizard').html(loading);

        $.ajax({
            type: "POST",
            url: "/program/get_programs",
            data: {
                department_id: $(element).val(),
                option_only: option_only
            }
        }).done(function (msg) {
            $('#program_block_wizard').html(msg);
        }).fail(function () {
            window.location.reload();
        });
    }

</script>