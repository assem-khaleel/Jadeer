<?php
/** @var $fieldsvalue Orm_Pc_Syllabus_Fields_Value[] */
/** @var $can_manage bool */
/** @var $course_id int */
/** @var $cat int */
/** @var $fields array */
?>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" xmlns="http://www.w3.org/1999/html"
     xmlns="http://www.w3.org/1999/html">
    <?php $this->load->view( $menu_params['type'].'/menu'); ?>
</div>
<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <?php $this->load->view('forms/custom_category_list'); ?>
</div>