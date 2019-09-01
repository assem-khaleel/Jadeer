<?php
/** @var $program_id int */
/** @var $types Orm_Cm_Program_Domain[] */
$semester = Orm_Semester::get_active_semester();

?>
<?php $this->load->view('program/links', array('program_id', $program_id)); ?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Program Learning Outcomes'); ?></span>
        <?php if($semester->get_is_current()){ ?>
            <div class="pull-right">
                <a class="btn btn-sm" href="/curriculum_mapping/program/select_domain_type/<?php echo $program_id; ?>"
                   data-toggle="ajaxModal" title="<?php echo lang('Select Domain Type') ?>">
                    <i class="btn-label-icon left fa fa-plus"></i>
                    <?php echo lang('Select Domain Type'); ?>
                </a>
            </div>
        <?php } ?>

    </div>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-md-3"><?php echo lang('Learning Domain'); ?></th>
            <th class="col-md-7"><?php echo lang('Learning Outcome'); ?></th>
            <th class="col-md-2"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <?php
        if ($types) {
        ?>
        <?php
        foreach ($types as $type) :
            $learning = Orm_Cm_Learning_Domain::get_all(array('type' => $type->get_domain_type()));
            ?>
            <thead>
            <tr>
                <th colspan="3" class="text-center">
                    <div  class="col-md-10 col-lg-10">
                        <h3 class="m-a-1">
                            <?php echo Orm_Cm_Program_Domain::get_type_name($type->get_domain_type()); ?>
                        </h3>
                    </div>
                    <div class="col-md-2 col-lg-2">
                        <a class="btn btn-sm" href="/curriculum_mapping/program/delete_type/<?php echo  $type->get_id() ?>"
                           message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" title="<?php echo lang('Delete').' '.lang('Learning Domain Type') ?>">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php if ($learning) { ?>
                <?php foreach ($learning as $key => $learning_domain) { ?>
                    <?php $domain_code = $key + 1; ?>
                    <tr>
                        <td>
                            <span class="label label-primary"><?php echo $domain_code; ?></span>
                            <?php echo htmlfilter($learning_domain->get_title()); ?>
                        </td>
                        <td>
                            <?php $program_learning_outcomes = Orm_Cm_Program_Learning_Outcome::get_program_learning_outcomes($program_id, $learning_domain->get_id());
                            ?>
                            <?php if ($program_learning_outcomes) { ?>
                                <ul class="list-group m-a-0 bg-primary">
                                    <?php foreach ($program_learning_outcomes as $okey => $program_learning_outcome) { ?>
                                        <?php $outcome_code = $okey + 1; ?>
                                        <li class="list-group-item no-border-hr padding-xs-hr">
                                            <?php if (License::get_instance()->check_module('survey')) { ?>
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <span class="label label-pa-purple"><?php echo htmlfilter($program_learning_outcome->get_code()); ?></span>
                                                        <?php echo htmlfilter($program_learning_outcome->get_text()); ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <a class="btn btn-sm pull-right"
                                                           href="/curriculum_mapping/program/plo_survey/<?php echo $program_learning_outcome->get_id(); ?>"
                                                           data-toggle="ajaxModal"
                                                           title="<?php echo lang('Map the PLO with Survey') ?>"><?php echo Orm_Cm_Program_Learning_Outcome_Survey::get_count(array('program_learning_outcome_id' => $program_learning_outcome->get_id())) ? '<i class="btn-label-icon left fa fa-check"></i>' : ''; ?>
                                                            <i class="btn-label-icon left fa fa-tasks"></i><?php echo lang('Surveys'); ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            <?php } else { ?>
                                                <span class="label label-pa-purple"><?php echo htmlfilter($program_learning_outcome->get_code()); ?></span>
                                                <?php echo htmlfilter($program_learning_outcome->get_text()); ?>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } else { ?>
                                <div class="alert m-a-0">
                                    <?php echo lang('There are no') . ' ' . lang('Program Learning Outcome'); ?>
                                </div>
                            <?php } ?>
                        </td>
                        <td>
                         <?php if($semester->get_is_current()){ ?>
                            <a href="/curriculum_mapping/program/learning_outcome_add_edit/<?php echo intval($program_id); ?>/<?php echo intval($learning_domain->get_id()); ?>"
                               data-toggle="ajaxModal" class="btn  btn-block">
                                <span class="btn-label-icon left icon fa fa-plus"></span><?php echo lang('Manage'); ?>
                            </a>
                            <?php if (count($program_learning_outcomes)) { ?>
                                <a href="/curriculum_mapping/program/learning_outcome_target/<?php echo intval($program_id); ?>/<?php echo intval($learning_domain->get_id()); ?>"
                                   data-toggle="ajaxModal" class="btn btn-block">
                                    <span class="btn-label-icon left icon fa fa-plus"></span><?php echo lang('Target'); ?>
                                </a>
                            <?php } ?>
                         <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="3">
                        <div class="alert alert-dafualt">
                            <div class="">
                                <?php echo lang('There are no') . ' ' . lang('Program Learning Outcomes'); ?>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        <?php endforeach; ?>
        <?php } else {
            ?>
           <tr>
               <td colspan="3">
                   <div class="alert alert-dafualt">
                       <div class="m-b-12">
                           <?php echo lang('There are no') . ' ' . lang('Learning Domains'); ?>
                       </div>
                   </div>
               </td>
           </tr>
        <?php } ?>
    </table>
</div>