<?php
/** @var int $section_id */
/** @var Orm_Cm_Course_Assessment_Method[] $assessment_methods */
/** @var Orm_Course $course */
/** @var $method_id */
/** @var $domains Orm_Cm_Course_Learning_Outcome[][] */
/** @var $questions array */
$items = array();
?>
<?php $this->load->view('course/links',array('course_id' => $course->get_id())); ?>
<div class="panel-group panel-group-primary" id="accordion-domains">
    <?php foreach ($domains as $domain_id => $outcomes) { ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-domains" href="#domain-<?php echo $domain_id; ?>">
                    <?php echo htmlfilter(Orm_Cm_Learning_Domain::get_instance($domain_id)->get_title()); ?>
                </a>
            </div>
            <div id="domain-<?php echo $domain_id; ?>" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul class="list-group m-a-0-b">
                        <?php foreach ($outcomes as $outcome) { ?>
                            <li class="list-group-item"><span class="badge badge-primary"><?php echo htmlfilter($outcome->get_code()); ?></span><?php echo htmlfilter($outcome->get_text()); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="well">
            <?php foreach($assessment_methods as $method) { ?>
                <a href="/curriculum_mapping/course_section/question_mapping/<?php echo intval($section_id) ?>/<?php echo intval($method->get_id()) ?>/?course_id=<?php echo intval($course->get_id()); ?>" class="btn btn-block  <?php echo $method_id == $method->get_id() ? 'btn-primary' : '' ?>" type="button">
                    <?php echo htmlfilter($method->get_text()); ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <div id="questions">
        <?php $this->load->view('course_section/questions'); ?>
    </div>
</div>