<form method="GET">
    <input type="hidden" id="property_id" name="property_id"
           value="<?php echo $this->input->get_post('property_id') ?>">
    <input type="hidden" id="property_label" name="property_label"
           value="<?php echo $this->input->get_post('property_label'); ?>">
    <div class="panel m-a-0">
        <div class="panel-heading p-l-0">
            <div class="col-md-4" style="margin-bottom: 5px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><?php echo lang('College') ?>:</span>
                    <select class="form-control" name="fltr[college_id]" onchange="get_departments_by_college(this, 0, 1);">
                        <option value=""><?php echo lang('All College') ?></option>
                        <?php foreach (Orm_College::get_all() as $college) { ?>
                            <?php $selected = (isset($fltr['college_id']) && $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : ''); ?>
                            <option value="<?php echo (int)$college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class=" col-md-4" style="margin-bottom: 5px;">
                <div class="input-group input-group-sm">
                    <span class="input-group-addon"><?php echo lang('Department') ?>:</span>
                    <select class="form-control" name="fltr[department_id]" id="department_block">
                        <option value=""><?php echo lang('All Department') ?></option>
                        <?php if (!empty($fltr['college_id'])): ?>
                            <?php foreach (Orm_Department::get_all(array('college_id' => $fltr['college_id'])) as $department) { ?>
                                <?php $selected = (isset($fltr['department_id']) && $department->get_id() == $fltr['department_id'] ? 'selected="selected"' : ''); ?>
                                <option value="<?php echo (int)$department->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($department->get_name()); ?></option>
                            <?php } ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4" style="margin-bottom: 5px;">
                <div class="input-group input-group-sm">
                    <input type="text"
                           value="<?php echo(empty($fltr['keyword']) ? '' : htmlfilter($fltr['keyword'])); ?>"
                           class="form-control" name="fltr[keyword]" placeholder="<?php echo lang('Keyword') ?>">
                    <span class="input-group-btn">
            <button class="btn" type="submit">
                <span class="fa fa-search" aria-hidden="true"></span> <?php echo lang('Search') ?>
            </button>
            </span>
                </div>
            </div>

        </div>
    </div>
    <div class="panel-body p-a-1">
        <table class="table table-hover m-a-0">
            <thead>
            <tr>
                <td style="width: 20px;">#</td>
                <td><?php echo lang('Full Name'); ?></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($courses as $course) : /* @var $course Orm_Course */ ?>
                <tr onclick="select_option(<?php echo htmlfilter($course->get_id()); ?>);">
                    <td>
                        <input type="radio" id="id_<?php echo htmlfilter($course->get_id()); ?>" name="course_id"
                               value="<?php echo htmlfilter($course->get_id()); ?>"
                               label="<?php echo htmlfilter($course->get_name()); ?>">
                    </td>
                    <td><?php echo htmlfilter($course->get_name()); ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php echo(isset($pager) ? '<div class="panel-footer p-y-0">' . $pager . '</div>' : ""); ?>
</form>

<script>
    function select_option(id) {
        var option = $('#id_' + id);

        option.prop('checked', true);

        var property_id = $('#property_id').val();
        var property_label = $('#property_label').val();

        parent.document.getElementById(property_id).value = option.val();
        parent.document.getElementById(property_label).value = option.attr('label');

        parent.find_onselect(option.val(), property_id, property_label);

        parent.document.getElementById('wrapper_' + property_id).remove();
    }
</script>
