<?php
/** @var $program_id int */
/** @var $level int */
/** @var $method_matrix Orm_Cm_Program_X_Matrix_Method */


$this->load->view('program/links', array('program_id', $program_id));
$program_plans = Orm_Program_Plan::get_all(array('program_id' => $program_id));

//die();
?>
<div class="table-light">
    <div class="table-header">
        <div class="table-caption">
            <button class="btn btn-rounded btn-sm collapsed" type="button" data-toggle="collapse" data-target="#legends" aria-expanded="false" aria-controls="legends"><i class="fa fa-question"></i></button>
            <span class="padding-sm-hr"><?php echo lang('Legends'); ?></span>
        </div>
    </div>
    <div class="collapse" id="legends" aria-expanded="false" style="height: 0;">
        <table class="table table-bordered">
            <tbody>
            <tr>
                <td class="col-md-2 valign-middle text-center"><span class="left fa fa-times fa-2x"></span></td>
                <td class="col-md-10 valign-middle"><?php echo lang('PLO has not Assessment Method')?></td>
            </tr>
            <tr>
                <td class="col-md-2 valign-middle text-center"><span class="left fa fa-times-circle-o fa-2x"></span></td>
                <td class="col-md-10 valign-middle"><?php echo lang('PLO has Assessment Method')?></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div id="matrix-content">
    <div class="tab-content" id="mapping">
        <input type="hidden" name="program_id" id="program_id" value="<?php echo $program_id; ?>"/>

        <div class="table-primary table-responsive">
            <div class="table-header">
                <div class="table-caption m-b-1">
                    <?php echo lang('X-Matrix') ?>
                </div>
            </div>
            <?php
            $plo = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_id));
            if($plo): ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-2"><?php echo lang('PLO'); ?></th>
                        <?php foreach ($program_plans as $plan) { ?>
                            <th class="bg-theme">
                                <Strong><?php echo htmlfilter($plan->get_course_obj()->get_code()) . ' - ' ?></Strong>
                                <?php echo htmlfilter($plan->get_course_obj()->get_name()); ?>
                            </th>
                        <?php } ?>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                    foreach ($plo as $key => $one_plo) {
                    $plo_id = $one_plo->get_id();
                    $plo_obj = Orm_Cm_Program_Learning_Outcome::get_instance($plo_id); ?>
                    <tr>
                        <td>
                            <?php echo lang('PLO ') . ' ' . ($key + 1); ?>
                        </td>

                        <?php foreach ($program_plans as $plan) {
                            $relations = Orm_Cm_Program_X_Matrix::get_one(['course_id' => $plan->get_course_id(), 'program_learning_outcome_id' => $plo_obj->get_id()]);
                            if ($relations->get_xmatrix() == 1) {
                            $method_matrix = Orm_Cm_Program_X_Matrix_Method::get_one(['course_id' => $plan->get_course_id(), 'program_learning_outcome_id' => $plo_obj->get_id(), 'program_id' => $program_id]);
                            if ($method_matrix->get_id()) {
                                ?>
                                <td class="text-center valign-middle">
                                    <a class="text-default"   href="/curriculum_mapping/program/assessment_matrix_edit/<?php echo $program_id; ?>/<?php echo $plan->get_course_id(); ?>/<?php echo $plo_obj->get_id() ?>"
                                       data-toggle="ajaxModal"  title="<?php lang('Add Assessment Methods to PLO')?>">
                                        <i class="fa  fa-times-circle-o fa-2x"></i>
                                    </a>
                                    <input type="hidden" name="course_id"
                                           id="course_id" value="<?php echo intval($plan->get_course_id()) ?>"/>
                                    <input type="hidden" name="plo_id" id="plo"
                                           value="<?php echo intval($plo_obj->get_id()) ?>"/>
                                </td>

                            <?php } else {
                                ?>
                                <td class="text-center valign-middle">
                                    <a class="text-default" href="/curriculum_mapping/program/assessment_matrix_edit/<?php echo $program_id; ?>/<?php echo $plan->get_course_id(); ?>/<?php echo $plo_obj->get_id() ?>"
                                       data-toggle="ajaxModal"  title="<?php lang('Add Assessment Methods to PLO')?>">
                                        <i class="fa  fa-times fa-2x"></i>
                                    </a>
                                    <input type="hidden" name="course_id"
                                           id="course_id" value="<?php echo intval($plan->get_course_id()) ?>"/>
                                    <input type="hidden" name="plo_id" id="plo"
                                           value="<?php echo intval($plo_obj->get_id()) ?>"/>
                                </td>
                            <?php }}else{?>
                                <td class="text-center valign-middle">
                                </td>
                              <?php
                            }
                        }
                } ?>
                      <input type="hidden" name="program_id" id="program_id" value="<?php echo $program_id ?>"/>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-dafualt">
                    <div class="m-b-1">
                        <?php echo lang('There are no') . ' ' . lang('Learning Outcome'); ?>
                    </div>
                </div>
            <?php  endif;?>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo lang("Program Learning Outcomes") ?></span>
            </div>
            <?php
            $plo = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_id));
            if($plo):
            ?>
            <div class="panel-body">
                <table class="table table-striped table-bordered" border="0">
                    <tbody>
                    <?php
                    foreach ($plo as $key => $one_plo) {
                        $plo_id = $one_plo->get_id();
                        $plo_obj = Orm_Cm_Program_Learning_Outcome::get_instance($plo_id); ?>
                        <tr>
                            <td class="col-lg-3"><?php echo lang('PLO ') . ' ' . ($key + 1); ?></td>
                            <td class="col-lg-9"><?php echo htmlfilter($one_plo->get_text()); ?> ( <?php echo htmlfilter($one_plo->get_learning_domain_obj()->get_title()).' - '.htmlfilter(Orm_Cm_Program_Domain::get_type_name($one_plo->get_learning_domain_obj()->get_type())); ?> )</td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php else: ?>
            <div class="alert alert-dafualt">
                <div class="m-b-1">
                    <?php echo lang('There are no') . ' ' . lang('Program Learning Outcomes'); ?>
                </div>
            </div>
        <?php endif;?>
    </div>
</div>
