<?php

$program_id = $data['item_id'];
$programs = $data['programs'];
$clos = $data['clos'];

/* @var $programs Orm_Program_Plan[]*/
/* @var $clos Orm_Cm_Course_Learning_Outcome[]*/

$program_obj = Orm_Program::get_instance($program_id);

$program_plans = Orm_Program_Plan::get_all(array('program_id' => $program_id));

/** @var Orm_Cm_Program_Learning_Outcome[][] $program_outcomes */

?>


<div id="matrix-content">
        <div class="table-light">
            <div class="table-header">
                <div class="table-caption">
                    <button class="btn btn-rounded btn-sm " type="button" ><i
                                class="fa fa-question"></i></button>
                    <span class="padding-sm-hr"><?php echo lang('Learning Outcomes'); ?></span>
                </div>
            </div>

            <div class="" id="legends" >
                <table class="table table-bordered">
                    <tbody>
                    <?php foreach ($clos as $key => $clo) { ?>
                        <tr>
                            <td class="col-md-2 valign-middle"><?php echo htmlfilter($clo->get_code()); ?></td>
                            <td class="col-lg-10"><?php echo htmlfilter($clo->get_text()); ?> ( <?php echo htmlfilter($clo->get_learning_domain_obj()->get_title()).' - '.htmlfilter(Orm_Cm_Program_Domain::get_type_name($clo->get_learning_domain_obj()->get_type())); ?> )</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="table-primary table-responsive" id="new-ipaMatrix">
            <div class="table-header">
                <span class="table-caption"><?php echo  htmlfilter($program_obj->get_name())?></span>
            </div>

            <table class="table table-bordered">

                <thead>

                <tr>
                    <th class="col-md-2"><?php echo lang('Course'); ?></th>

                    <?php foreach ($program_plans as $plan) { ?>
                        <th>
                            <Strong><?php echo htmlfilter($plan->get_course_obj()->get_code()) . ' - ' ?></Strong>
                            <?php echo htmlfilter($plan->get_course_obj()->get_name()); ?>
                        </th>
                    <?php } ?>
                </tr>

                </thead>

                <tbody>

                <?php if ($clos) { ?>

                    <?php foreach ($clos as $key => $clo) { ?>

                        <tr>
                            <td class="bg-theme">

                                <?php echo $clo->get_code(); ?>

                            </td>

                            <?php foreach ($program_plans as $plan) {  ?>

                                <td class="valign-middle">
                                    <?php $map_obj = Orm_Cm_Program_Mapping_Matrix::get_one(array('program_id' => $program_id, 'course_id' => $plan->get_course_id(), 'program_learning_outcome_id' => $clo->get_learning_outcome_id())) ?>
                                    <?php if($map_obj->get_id()) { ?>
                                        <?php echo lang($map_obj->get_ipa(true)) ?>
                                    <?php } else { ?>
                                        <?php echo lang('N/A') ?>
                                    <?php } ?>
                                </td>

                            <?php } ?>
                        </tr>
                    <?php }} ?>
                </tbody>
            </table>
        </div>
</div>
