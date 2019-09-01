<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php
    $this->load->view('syllabus/menu');
    /* @var $policy Orm_Pc_Course_Policies*/
    ?>
</div>
<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vpoliciesr no-border-r form">
    <?php
    $this->load->view('syllabus/course_policies_list');
    ?>
</div>