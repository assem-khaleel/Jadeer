<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/17/16
 * Time: 2:24 PM
 */
/** @var string $pager */
/** @var Orm_Data_Course_Grade[] $items */
/** @var array $fltr */
?>
<?php if (!isset($pdf) || !$pdf) { ?>
    <div class="box bg-primary p-a-2">
        <div class="pull-left">
            <button aria-controls="filters" aria-expanded="false" data-target="#filters" data-toggle="collapse" type="button" class="btn btn-sm ">
                <span class="fa fa-filter"></span>
            </button>
            <?php echo lang('Filters') ?>
        </div>
        <?php
        $url = $this->input->server('REQUEST_URI');
        $explode_url = explode('?', $url);
        $query_string = empty($explode_url[1]) ? '' : ('?' . $explode_url[1]);
        ?>
        <div class="pull-right">
            <a href="/statistics/course_grade/1/<?php echo $query_string; ?>" class="btn btn-sm text-default"><span class="btn-label-icon left icon fa fa-file-pdf-o"></span> <?php echo lang('PDF') ?></a>
        </div>
    </div>
    <form method="GET" class="form-horizontal">
        <div id="filters" class="collapse in" aria-expanded="true" style="">
            <div class="well">
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Semester'); ?></label>
                    <div class="col-sm-9">
                        <select id="semester_id" name="fltr[semester_id]" class="form-control">
                            <option value=""><?php echo lang('All Semesters'); ?></option>
                            <?php foreach (Orm_Semester::get_all() as $semester) {
                            $selected='';
                            if(isset($fltr['semester_id'])){?>
                                <?php $selected = $semester->get_id() == $fltr['semester_id'] ? 'selected="selected"' : ''; }?>
                                <option value="<?php echo intval($semester->get_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($semester->get_name()); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('College'); ?></label>
                    <div class="col-sm-9">
                        <select name="fltr[college_id]" class="form-control" onchange="get_programs_by_college(this, 0, 1);">
                            <option value=""><?php echo lang('All Colleges'); ?></option>
                            <?php foreach (Orm_College::get_all() as $college) {
                            $selected='';
                            if(isset($fltr['college_id'])){?>
                                <?php $selected = $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : ''; }?>
                                <option value="<?php echo intval($college->get_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Program'); ?></label>
                    <div class="col-sm-9">
                        <select name="fltr[program_id]" class="form-control" id="program_block" onchange="get_courses_by_program(this, 0, 1);">
                            <option value=""><?php echo lang('All Programs'); ?></option>
                            <?php if (isset($fltr['college_id'])) { ?>
                                <?php foreach (Orm_Program::get_all(array('college_id' => $fltr['college_id'])) as $program) { ?>
                                    <?php $selected = $program->get_id() == $fltr['program_id'] ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo intval($program->get_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Course'); ?></label>
                    <div class="col-sm-9">
                        <select id="course_block" name="fltr[course_id]" class="form-control" onchange="get_sections_by_course(this, $('#semester_id').val(), 1)">
                            <option value=""><?php echo lang('All Courses'); ?></option>
                            <?php if (isset($fltr['program_id'])) { ?>
                                <?php foreach (Orm_Program_Plan::get_all(array('program_id' => $fltr['program_id']),0,0,array('co.code_en')) as $plan) { ?>
                                    <?php $selected = $plan->get_course_id() == $fltr['course_id'] ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo intval($plan->get_course_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($plan->get_course_obj()->get_code()) . ' - ' . htmlfilter($plan->get_course_obj()->get_name()); ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo lang('Course Section'); ?></label>
                    <div class="col-sm-9">
                        <select id="section_block" name="fltr[section_id]" class="form-control">
                            <option value=""><?php echo lang('All Course Sections'); ?></option>
                            <?php if (isset($fltr['course_id']) && isset($fltr['semester_id'])) { ?>
                                <?php foreach (Orm_Course_Section::get_all(array('course_id' => $fltr['course_id'], 'semester_id' => $fltr['semester_id'])) as $section) { ?>
                                    <?php $selected = $section->get_id() == $fltr['section_id'] ? 'selected="selected"' : ''; ?>
                                    <option value="<?php echo intval($section->get_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($section->get_section_no()); ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="clearfix">
                    <button type="submit" class="btn pull-right "><span class="btn-label-icon left"><i class="fa fa-filter"></i></span><?php echo lang('Search'); ?></button>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption"><?php echo lang('Course Grades'); ?></div>
    </div>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th><?php echo lang('Semester') ?></th>
            <th><?php echo lang('Course') ?></th>
            <th><?php echo lang('Section') . '#' ?></th>
            <th><?php echo lang('Grade') ?></th>
            <th><?php echo lang('Student Count') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($items as $item) { ?>
            <tr>
                <td><?php echo htmlfilter($item->get_semester_obj()->get_name()); ?></td>
                <td><?php echo htmlfilter($item->get_course_obj()->get_code()) . ' - ' . htmlfilter($item->get_course_obj()->get_name()); ?></td>
                <td><?php echo intval($item->get_section_id()); ?></td>
                <td><?php echo htmlfilter($item->get_grade()); ?></td>
                <td><?php echo intval($item->get_student_count()); ?></td>
            </tr>
        <?php } ?>
        <?php if(empty($items)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if ($pager) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
    <?php } ?>
</div>
