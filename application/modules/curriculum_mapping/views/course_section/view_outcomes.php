<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 28/03/18
 * Time: 10:39 ص
 */
/** @var int $section_id */
/** @var int $method_id */
/** @var Orm_Cm_Section_Mapping_Question[] $questions */
/** @var Orm_Cm_Course_Learning_Outcome[][] $domains */

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('',array('id' => 'learning_outcomes-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo Orm_Cm_Course_Assessment_Method::get_instance($method_id)->get_text(); ?></span>
        </div>
        <div class="modal-body">
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

            <div class="table-primary">
                <div class="table-header"><span class="table-caption"><?php echo lang('Learning Outcomes'); ?></span></div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-6"><?php echo lang('Questions'); ?></th>
                        <th class="col-md-6"><?php echo lang('Competencies Dimension'); ?></th>
                    </tr>
                    </thead>
                    <?php foreach($questions as $question) { ?>
                        <tr>
                            <td><?php echo htmlfilter($question->get_question()); ?></td>
                            <td>
                                <ul class="list-group">
                                    <?php foreach ($domains as $domain_id => $outcomes) { ?>
                                        <?php $count = 0; ?>
                                        <li class="list-group-item active">
                                            <span class="label pull-right"></span>
                                            <?php echo htmlfilter(Orm_Cm_Learning_Domain::get_instance($domain_id)->get_title()); ?>

                                        </li>
                                        <li class="list-group-item">

                                            <?php foreach ($outcomes as $outcome) { ?>
                                                <?php if (in_array($outcome->get_id(), $question->get_course_learning_outcomes_ids())) { ?>
                                                    <?php $count++; ?>
                                                    <span class="label pull-right"></span>&nbsp;
                                                    <span class="label label-success pull-right"><?php echo htmlfilter($outcome->get_code()); ?></span>

                                                <?php } ?>
                                            <?php } ?>
                                            <?php if (!$count) { ?>
                                                <span class="label label-danger pull-right"><?php echo lang('N/A'); ?></span>
                                                <span class="label pull-right"></span>&nbsp;
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
