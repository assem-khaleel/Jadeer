<?php
/** @var $program_id int */
/** @var $level int */

$this->load->view('program/links', array('program_id', $program_id));

$program_levels = Orm_Program_Plan::get_program_levels($program_id, true);

$level = $level ?: ($program_levels ? min($program_levels) : 0);

$program_domain = Orm_Cm_Program_Domain::get_one(array('program_id' => $program_id, '$semester_id' => Orm_Semester::get_active_semester()->get_id()));
$domains = Orm_Cm_Learning_Domain::get_all(array('type' => $program_domain->get_domain_type()));


$program_plans = Orm_Program_Plan::get_all(array('program_id' => $program_id));

/** @var Orm_Cm_Program_Learning_Outcome[][] $program_outcomes */
$empty_outcomes = true;
$program_outcomes = array();

foreach ($domains as $key => $domain) {
    $program_outcomes[$domain->get_id()] = Orm_Cm_Program_Learning_Outcome::get_program_learning_outcomes($program_id, $domain->get_id());
    if (!empty($program_outcomes[$domain->get_id()])) {
        $empty_outcomes = false;
    }

}
$program_outcome_nodomain = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_id));
?>

<ul class="nav nav-tabs">

    <li class="pull-right">
        <a href="/curriculum_mapping/program/mapping_matrix_add_edit/<?php echo $program_id; ?>"
           data-toggle="ajaxRequest" data-target="matrix-content"><i class="fa fa-edit"></i> <?php echo lang('Edit') ?>
        </a>
    </li>

</ul>

<div id="matrix-content">
    <div class="tab-content tab-content-bordered" id="mapping">

        <?php if ($empty_outcomes) { ?>
            <div class="well m-a-0">
                <?php echo lang('There is no') . ' ' . lang('Program Learning outcomes'); ?>
            </div>
        <?php }else{ ?>


        <div class="table-light">

            <div class="table-header">
                <div class="table-caption">
                    <button class="btn btn-rounded btn-sm collapsed" type="button" data-toggle="collapse"
                            data-target="#legends" aria-expanded="false" aria-controls="legends"><i
                                class="fa fa-question"></i></button>
                    <span class="padding-sm-hr"><?php echo lang('Learning Outcomes'); ?></span>
                </div>
            </div>

            <div class="collapse" id="legends" aria-expanded="false" style="height: 0;">
                <table class="table table-bordered">
                    <tbody>

                    <?php foreach ($program_outcome_nodomain as $key => $Nodomain) { ?>
                        <tr>
                            <td class="col-md-2 valign-middle"><?php echo htmlfilter($Nodomain->get_code()); ?></td>
                            <td class="col-md-10 valign-middle"><?php echo htmlfilter($Nodomain->get_text()); ?> ( <?php echo htmlfilter($Nodomain->get_learning_domain_obj()->get_title()).' - '.htmlfilter(Orm_Cm_Program_Domain::get_type_name($Nodomain->get_learning_domain_obj()->get_type())); ?> )</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>


        <div class="table-primary table-responsive" id="new-ipaMatrix">

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

                <?php if ($program_outcome_nodomain) { ?>

                    <?php foreach ($program_outcome_nodomain as $key => $Nodomain) { ?>

                        <tr>
                            <td class="bg-theme">

                                <?php echo $Nodomain->get_code(); ?>

                            </td>

                            <?php foreach ($program_plans as $plan) { ?>

                                <td class="valign-middle">
                                    <?php $map_obj = Orm_Cm_Program_Mapping_Matrix::get_one(array('program_id' => $program_id, 'course_id' => $plan->get_course_id(), 'program_learning_outcome_id' => $Nodomain->get_learning_outcome_id())) ?>
                                    <?php if ($map_obj->get_id()) { ?>
                                        <?php echo lang($map_obj->get_ipa(true)) ?>
                                    <?php } else { ?>
                                        <?php echo lang('N/A') ?>
                                    <?php } ?>
                                </td>

                            <?php } ?>
                        </tr>
                    <?php }
                }
                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>