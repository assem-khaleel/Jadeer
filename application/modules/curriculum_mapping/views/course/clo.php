<div class="panel m-a-0">
    <div class="panel-heading p-x-0">
        <?php echo form_open('/curriculum_mapping/course/find_clo', ['method="GET"'], [
            'property_id' => $this->input->post_get('property_id'),
            'property_label' => $this->input->post_get('property_label')
        ]); ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo lang('College') ?></span>
                        <select id="college_block" name="college_id" class="form-control" onchange="filter_department(this)">
                            <option value=""><?php echo lang('Select College') ?></option>
                            <?php foreach(Orm_College::get_all() as $college): ?>
                                <option value="<?php echo $college->get_id() ?>" <?php echo $college->get_id()==$college_id?'selected=""': '' ?>><?php echo htmlfilter($college->get_name()) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo lang('Department') ?></span>
                        <select id="department_block" name="department_id" class="form-control" onchange="filter_program(this)">
                            <option value=""><?php echo lang('Select Department') ?></option>
                            <?php foreach(Orm_Department::get_all(['college_id'=>$college_id]) as $department): ?>
                                <option value="<?php echo $department->get_id() ?>" <?php echo $department->get_id()==$department_id?'selected=""': '' ?>><?php echo htmlfilter($department->get_name()) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo lang('Program') ?></span>
                        <select id="program_block" name="program_id" class="form-control" onchange="filter_course(this)">
                            <option value=""><?php echo lang('Select Program') ?></option>
                            <?php foreach(Orm_Program::get_all(['department_id'=>$department_id]) as $program): ?>
                                <option value="<?php echo $program->get_id() ?>" <?php echo $program->get_id()==$program_id?'selected=""': '' ?>><?php echo htmlfilter($program->get_name()) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row m-t-3">
                <div class="col-sm-4">
                    <div class="input-group">
                        <span class="input-group-addon"><?php echo lang('Course') ?></span>
                        <select id="course_block" name="course_id" class="form-control">
                            <option value=""><?php echo lang('Select Course') ?></option>
                            <?php foreach(Orm_Course::get_all(['program_plan' => true, 'program_id' => $program_id]) as $course): ?>
                                <option value="<?php echo $course->get_id() ?>" <?php echo $course->get_id()==$course_id?'selected=""': '' ?>><?php echo htmlfilter($course->get_code().' - '.$course->get_name()) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6 p-l-2">
                    <?php echo lang('You have to choose course'); ?>
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn pull-right" aria-label="Left Align">
                        <span class="fa fa-search" aria-hidden="true"></span> <?php echo lang('Search') ?>
                    </button>
                </div>
            </div>
            <?php echo form_close(); ?>

            <div class="panel-body p-a-1">
                <table class="table table-hover m-a-0">
                    <tbody>
                    <?php foreach (Orm_Cm_Course_Learning_Outcome::get_all(['course_id'=>$course_id], 0, 0, ['learning_domain_id']) as $clo): ?>
                        <tr onclick="select_option(<?php echo htmlfilter($clo->get_id()); ?>);">
                            <td>
                                <input type="radio" id="id_<?php echo $clo->get_id(); ?>"
                                    <?php echo $clo->get_id()==$clo_id? 'checked=""': '' ?>
                                       value="<?php echo $clo->get_id(); ?>"
                                       label="<?php echo htmlfilter($clo->get_learning_domain_obj()->get_title().' : '.strtoupper($clo->get_code()).' - '.$clo->get_text()); ?>">
                            </td>
                            <td>
                                <?php echo htmlfilter($clo->get_learning_domain_obj()->get_title().' : '.strtoupper($clo->get_code()).' - '.$clo->get_text()); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>

<script>
    function select_option(id) {
        var option = $('#id_' + id);

        option.prop('checked', true);

        var property_id = "<?php echo $this->input->get_post('property_id') ?>";
        var property_label = "<?php echo $this->input->get_post('property_label') ?>";

        $(parent.document.getElementById(property_id)).val(option.val());
        $(parent.document.getElementById(property_label)).val(option.attr('label'));

        $(parent.document.getElementById('wrapper_' + property_id)).remove();
    }
</script>

<script>
    function filter_department(element) {
        //set colleges
        get_departments_by_college(element, 0, 1);
//        submit_filter();
    }

    function filter_program(element) {
        //set programs
        get_programs_by_department(element, 0, 1);
    }

    function filter_course(element) {
        //set course
        get_courses_by_program(element, 0, 1);
    }

</script>