<?php /* @var $course Orm_Course */

function draw_semester($fltr)
{
    ob_start();
    ?>
    <div class="col-md-12 m-b-2">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Semester') ?></span>
            <select id="degree_block" name="fltr[semester_id]" class="form-control">
                <option value=""><?php echo lang('Semesters') ?></option>
                <?php foreach (Orm_Semester::get_all() as $semester) : ?>
                    <?php $selected = (isset($fltr['semester_id']) && $semester->get_id() == $fltr['semester_id'] ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo (int)$semester->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($semester->get_name()); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <h4 class="m-t-0">
                <?php echo lang('Course') . ' : ' . htmlfilter($course->get_name()); ?>
            </h4>

            <?php
            $extra_html = form_hidden('course_id', $course->get_id());
            $extra_html .= draw_semester($fltr);
            echo filter_block('/course_section/filter?course_id=' . $course->get_id(), '/course_section?course_id=' . $course->get_id(), ['keyword'], 'ajax_block', $extra_html);
            ?>
        </div>

        <div id="ajax_block" >
            <?php $this->load->view('course_section/data_table'); ?>
        </div>
    </div>
</div>
