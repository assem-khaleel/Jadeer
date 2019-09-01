<?php $this->load->view('course/links', array('course_id' => $course_id)); ?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Course Learning Domain'); ?></span>
    </div>
    <?php

    $program_id = Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id))->get_program_obj()->get_id();
    $types = Orm_Cm_Program_Domain::get_all(array('program_id' => $program_id, 'semester_id' => Orm_Semester::get_active_semester()->get_id()),0,0,array('id'));
    ?>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-md-1">#</th>
            <th class="col-md-2"><?php echo lang('Learning Domain'); ?></th>
            <th class="col-md-6"><?php echo lang('Learning Outcome'); ?></th>
            <th class="col-md-3"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php if ($types) { ?>
        <?php
        foreach ($types as $type):
        $domains = Orm_Cm_Learning_Domain::get_all(array('type' => $type->get_domain_type()));
        ?>
        <thead>
        <tr>
            <th colspan="4"><?php echo Orm_Cm_Program_Domain::get_type_name($type->get_domain_type()); ?></th>
        </tr>
        </thead>
        <?php if ($domains) { ?>
            <?php foreach ($domains as $key => $domain) { ?>
                <tr>
                    <td><span class="label label-primary"><?php echo($key + 1); ?></span></td>
                    <td><b><?php echo htmlfilter($domain->get_title()); ?></b></td>
                    <td>
                        <?php $outcomes = Orm_Cm_Course_Learning_Outcome::get_all(array('course_id' => $course_id, 'learning_domain_id' => $domain->get_id()), 0, 0, array('code')); ?>
                        <?php if ($outcomes) { ?>
                            <ul class="list-group m-a-0 bg-primary">
                                <?php foreach ($outcomes as $okey => $outcome) { ?>
                                    <?php $outcome_code = $okey + 1; ?>
                                    <li class="list-group-item no-border-hr padding-xs-hr">
                                        <?php if (License::get_instance()->check_module('survey')) { ?>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <span class="label label-pa-purple"><?php echo htmlfilter($outcome->get_code()); ?></span>
                                                    <?php echo htmlfilter($outcome->get_text()); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <a class="btn btn-sm pull-right"
                                                       href="/curriculum_mapping/course/clo_assessment_method/<?php echo $course_id ?>/<?php echo $outcome->get_id(); ?>"
                                                       data-toggle="ajaxModal"><i
                                                                class="btn-label-icon left fa fa-tasks"></i><?php echo lang('Mapping'); ?>
                                                    </a>
                                                </div>
                                                <div class="col-md-3">
                                                    <a class="btn btn-sm pull-right"
                                                       href="/curriculum_mapping/course/clo_survey/<?php echo $outcome->get_id(); ?>"
                                                       data-toggle="ajaxModal"
                                                       title="<?php echo lang('Map the PLO with Survey') ?>"><?php echo Orm_Cm_Course_Learning_Outcome_Survey::get_count(array('course_learning_outcome_id' => $outcome->get_id())) ? '<i class="btn-label-icon left fa fa-check"></i>' : ''; ?>
                                                        <i class="btn-label-icon left fa fa-tasks"></i><?php echo lang('Surveys'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <span class="label label-pa-purple"><?php echo htmlfilter($outcome->get_code()); ?></span>
                                                    <?php echo htmlfilter($outcome->get_text()); ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <a class="btn btn-sm pull-right"
                                                       href="/curriculum_mapping/course/clo_assessment_method/<?php echo $course_id ?>/<?php echo $outcome->get_id(); ?>"
                                                       data-toggle="ajaxModal"><i
                                                                class="btn-label-icon left fa fa-tasks"></i><?php echo lang('Mapping'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else { ?>
                            <div class="alert m-a-0">
                                <?php echo lang('There are no') . ' ' . lang('Learning Outcome'); ?>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if (Orm_Cm_Program_Learning_Outcome::get_program_learning_outcomes(Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id))->get_program_id(), $domain->get_id())) { ?>
                            <a href="/curriculum_mapping/course/learning_outcome_add_edit/<?php echo intval($course_id); ?>/<?php echo intval($domain->get_id()); ?>"
                               data-toggle="ajaxModal" class="btn  btn-block">
                                <span class="btn-label-icon left icon fa fa-plus"></span><?php echo lang('Manage') . ' ' . lang('Learning Outcome'); ?>
                            </a>
                            <?php if (count($outcomes)) { ?>
                                <a href="/curriculum_mapping/course/learning_outcome_target/<?php echo intval($course_id); ?>/<?php echo intval($domain->get_id()); ?>"
                                   data-toggle="ajaxModal" class="btn btn-block">
                                    <span class="btn-label-icon left icon fa fa-plus"></span><?php echo lang('Target'); ?>
                                </a>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="alert m-a-0"><?php echo lang('There are no') . ' ' . lang('Learning Outcome in') . ' ' . $domain->get_title() . ' ' . lang('in') . ' ' . Orm_Cm_Course_Offered_Program::get_one(array('course_id' => $course_id))->get_program_obj()->get_name(); ?></div>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr>
                <td colspan="4">
                    <div class="alert alert-dafualt">
                        <div class="">
                            <?php echo lang('There are no') . ' ' . lang('Program Learning Outcome'); ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>

        <?php endforeach; ?>

        <?php } else { ?>
            <tr>
                <td colspan="4">
                    <div class="alert alert-default">
                        <div class="">
                            <?php echo lang('There are no') . ' ' . lang('Learning Domains'); ?>
                        </div>
                    </div>
                </td>
            </tr>
        <?php } ?>

        </tbody>
    </table>
</div>