<?php
/* @var Orm_Program_Plan[] $courses */
$this->load->view('course/links', array('course_id' => $course_id));
$clos = Orm_Cm_Course_Learning_Outcome::get_all(['course_id' => $course_id]);

?>

<?php echo form_open('/curriculum_mapping/Course/save_x_matrix', ['method' => 'post', "class" => 'inline-form', 'id' => "form"]) ?>
<div class="panel panel-primary">
    <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo lang("PLO - CLO Matrix") ?></span>
        <?php if(!empty($clos))?>
        <div class=" pull-right ">
            <button class="btn btn-sm"><?php echo lang('save') ?></button>
        </div>
        <?php ?>
    </div>

    <div class="panel-body">
        <table class="table table-striped table-bordered table-responsive">

            <?php if (!empty($courses)): ?>
                <thead>
                <tr>
                    <th class="no-border"></th>
                    <?php

                    foreach ($clos as $key => $clo) {

                        echo '<th>' . lang('C.L.O') . ' ' . ($key + 1) . '</th>';
                    } ?>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($courses as  $course){

                $plos = Orm_Cm_Program_Learning_Outcome::get_all(['program_id' => $course->get_program_id()]);

                foreach ($plos as $key => $plo) { ?>
                <tr>
                    <?php echo '<th>' . lang('P.L.O') . ' ' . ($key + 1) . '</th>';

                    foreach ($clos as $key => $clo) {

                        $checked = '';

                        $check = Orm_Cm_Course_Matrix::get_all(['clo_id' => $clo->get_id(), 'plo_id' => $plo->get_id()]);

                        if (!empty($check)) {
                            $checked = 'checked';
                        }

                        ?>
                        <td>
                            <label class="custom-control custom-checkbox checkbox-inline"
                                   for="relation_<?php echo intval($plo->get_id()) ?>-<?php echo (int)$key ?>">
                                <input type="checkbox" style="z-index: 9999;margin-top:-10px;"
                                       name="relation[<?php echo $plo->get_id(); ?>][<?php echo intval($clo->get_id()) ?>]"
                                       id="<?php echo intval($clo->get_id()) ?>-<?php echo intval($clo->get_id()) ?>"
                                       value="<?php echo intval($clo->get_id()) ?>"
                                       class="custom-control-input" <?php echo $checked ?> />
                                <span class="custom-control-indicator"></span>
                            </label>
                        </td>

                    <?php }}} ?>
                </tr>
                </tbody>
            <?php else: ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('X-Matrix to be displayed'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</div>

<?php echo form_close(); ?>


<div class="panel panel-primary">
    <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo lang("CLO Keywords") ?></span>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered" border="0">
            <tbody>
            <?php


            if (count($courses)) {
                foreach ($clos as $key => $objectiveObj) { ?>
                    <tr>
                        <td class="col-lg-3"><?php echo lang('C.L.O ') . ' ' . ($key + 1); ?></td>
                        <td class="col-lg-9"><?php echo $objectiveObj->get_text(); ?></td>
                    </tr>
                <?php }
            } else { ?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('CLO keywords to be displayed'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<div class="panel panel-primary">
    <div class="panel-heading clearfix">
            <span class="panel-title pull-left"
                  style="padding-top: 7.5px;"><?php echo lang("PLO Keywords") ?></span>
    </div>
    <div class="panel-body">
        <table class="table table-striped table-bordered" border="0">
            <tbody>
            <?php
            if (count($courses)) {
                foreach ($courses as $course) {
                    foreach (Orm_Cm_Program_Learning_Outcome::get_all(['program_id' => $course->get_program_id()]) as $key => $objectiveObj) {
                        ?>
                        <tr>
                            <td class="col-lg-3"><?php echo lang('p.l.o ') . ' ' . ($key + 1); ?></td>
                            <td class="col-lg-9"><?php echo $objectiveObj->get_text(); ?> ( <?php echo htmlfilter($objectiveObj->get_learning_domain_obj()->get_title()).' - '.htmlfilter(Orm_Cm_Program_Domain::get_type_name($objectiveObj->get_learning_domain_obj()->get_type())); ?> )</td>
                        </tr>
                    <?php }
                }
            }else{?>
                <tr>
                    <td colspan="10">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('PLO keywords to be displayed'); ?></h3>
                        </div>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
