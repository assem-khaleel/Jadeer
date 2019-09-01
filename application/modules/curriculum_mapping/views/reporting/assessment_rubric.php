<?php
///**
// * Created by PhpStorm.
// * User: mazen
// * Date: 2/3/16
// * Time: 3:53 PM
// */
///** @var Orm_Course[] $courses */
///** @var string $pager */
///** @var int $course_id */
///** @var int $section_id */
//$url = $this->input->server('REQUEST_URI');
//$explode_url = explode('?', $url);
//$query_string = empty($explode_url[1]) ? '' : ('?' . $explode_url[1]);
//$domains_array  = array();
//?>
<div class="m-b-2">
    <?php echo filter_block('/curriculum_mapping/reporting/course_filter', '/curriculum_mapping/reporting/course_assessment_rubric', [Orm_Campus::class, Orm_College::class, Orm_Department::class, Orm_Program::class, 'keyword']); ?>
</div>

<div id="ajax_block" >
    <?php $this->load->view('curriculum_mapping/reporting/course_data_table'); ?>
</div>