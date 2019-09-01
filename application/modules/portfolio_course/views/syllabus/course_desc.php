<?php
/** @var $assessment_method Orm_Cm_Course_Assessment_Method[] */
/** @var $clo Orm_Cm_Course_Learning_Outcome[] */
?>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php $this->load->view('syllabus/menu'); ?>
</div>
<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <?php $this->load->view('syllabus/course_desc_list'); ?>
</div>