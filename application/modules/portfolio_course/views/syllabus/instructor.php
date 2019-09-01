<?php
/** @var $faculty Orm_Course_Section_Teacher[] */
/** @var $can_manage bool */
/** @var $course_id int */
?>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php
    $this->load->view('syllabus/menu');
    ?>
</div>
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <?php $this->load->view('syllabus/instructor_list'); ?>
</div>