<?php
/** @var $program_id int */
/** @var $level int */

$this->load->view('program/links', array('program_id', $program_id));


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
?>

<div id="matrix-content">
    <div class="tab-content" id="mapping">
        <?php if ($empty_outcomes) { ?>
            <div class="well m-a-0">
                <?php echo lang('There is no') . ' ' . lang('Program Learning outcomes'); ?>
            </div>
        <?php }else{ ?>
        <?php echo form_open("/curriculum_mapping/program/x_matrix_save", array('id' => 'curriculum_mapping')); ?>
        <input type="hidden" name="program_id" id="program_id" value="<?php echo $program_id; ?>"/>

        <div class="table-primary table-responsive">
            <div class="table-header">
                <div class="table-caption m-b-1">
                    <?php echo lang('X-Matrix') ?>
                    <div class="panel-heading-controls col-sm-4">

                        <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                            <span class="btn-label-icon left"><i
                                        class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                        </button>
                    </div>
                </div>
            </div>
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
                $plo = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_id));

                foreach ($plo as $key =>$one_plo) {
                    $plo_id = $one_plo->get_id();
                    $plo_obj = Orm_Cm_Program_Learning_Outcome::get_instance($plo_id); ?>
                    <tr>
                        <td>
                            <?php echo lang('PLO ').' '. ($key + 1); ?>
                        </td>
                        <?php foreach ($program_plans as $plan) {
                            $relations = Orm_Cm_Program_X_Matrix::get_one(['course_id' => $plan->get_course_id(), 'program_learning_outcome_id' => $plo_obj->get_id()]);
                            if ($relations->get_xmatrix() == 1) {
                                $checked = 'checked';
                            } else {
                                $checked = '';
                            } ?>
                            <td>
                                <div class="checkbox">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               name="relation[<?php echo intval($plan->get_course_id()) ?>][<?php echo intval($plo_obj->get_id()) ?>]"
                                               id="relation[<?php echo intval($plan->get_course_id()) ?>]"
                                               value="<?php echo intval($plo_obj->get_id()) ?>"
                                               class="custom-control-input" <?php echo $checked ?>/>
                                        <span class="custom-control-indicator"></span>
                                    </label>
                                </div>
                            </td>
                        <?php } ?>

                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo  lang("Program Learning Outcomes") ?></span>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered" border="0">
                <tbody>
                <?php
                $plo = Orm_Cm_Program_Learning_Outcome::get_all(array('program_id' => $program_id));

                foreach ($plo as $key =>$one_plo) {
                    $plo_id = $one_plo->get_id();
                    $plo_obj = Orm_Cm_Program_Learning_Outcome::get_instance($plo_id); ?>
                    <tr>
                        <td class="col-lg-3"><?php echo lang('PLO ').' '. ($key + 1); ?></td>
                        <td class="col-lg-9"><?php echo htmlfilter($one_plo->get_text()); ?> ( <?php echo htmlfilter($one_plo->get_learning_domain_obj()->get_title()).' - '.htmlfilter(Orm_Cm_Program_Domain::get_type_name($one_plo->get_learning_domain_obj()->get_type())); ?> )</td>
                    </tr>
                <?php }}?>
                </tbody>
            </table>
        </div>
    </div>
</div>