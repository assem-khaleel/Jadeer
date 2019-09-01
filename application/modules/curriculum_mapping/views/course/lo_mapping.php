<?php $this->load->view('course/links', array('course_id' => $course_id)); ?>

<div class="row">
    <div class="col-md-3">
        <div class="well">
            <?php foreach (Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $course_id)) as $assessment_method) { ?>
                <a href="/curriculum_mapping/course/lo_mapping/<?php echo $course_id ?>/<?php echo $assessment_method->get_id()?>" class="btn  btn-block text-left <?php echo($course_assessment_method_id == $assessment_method->get_id() ? 'btn-primary' : '') ?>">
                    <span class="btn-label-icon left">
                        <i class="fa fa-tasks"></i>
                    </span>
                    <?php echo htmlfilter($assessment_method->get_text(true)); ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <div class="col-md-9">
        <div class="well">
            <?php if (empty($course_assessment_method_id)) { ?>
                <div class="alert alert-primary">
                    <?php echo lang('Please Select Assessment Method'); ?>
                </div>
            <?php } else { ?>
                <?php echo form_open("/curriculum_mapping/course/lo_mapping/{$course_id}/{$course_assessment_method_id}"); ?>
                <div class="table-primary">
                    <div class="table-header">
                        <h3 class="m-a-0"><?php echo $course_assessment_method->get_text(true) .' - '. lang('Learning Outcome Mapping'); ?></h3>
                    </div>

                    <table class="table" style="color: #FFF;">
                        <?php foreach($mapping as $assessment_component_id => $assessment_component) { ?>
                            <tr class="bg-tree-node-1">
                                <td colspan="4">
                                    <?php echo $assessment_component['text'] ?>
                                </td>
                            </tr>

                            <?php foreach($assessment_component['domains'] as $program_domain_id => $domain) { ?>
                                <tr class="bg-tree-node-3">
                                    <td></td>
                                    <td colspan="3">
                                        <?php echo $domain['text'] ?>
                                    </td>
                                </tr>

                                <?php foreach($domain['outcomes'] as $course_outcome_id => $outcome) { ?>
                                    <tr class="bg-tree-node-5">
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <label for="<?php echo "{$assessment_component_id}{$program_domain_id}{$course_outcome_id}" ?>"><?php echo $outcome['text'] ?></label>
                                        </td>
                                        <td>
                                            <label class="checkbox-inline">
                                                <input type="checkbox" class="px" name="selected_<?php echo $assessment_component_id ?>_<?php echo $program_domain_id ?>_<?php echo $course_outcome_id ?>" value="1" <?php echo $outcome['selected'] ? 'checked="checked"' : '' ?> id="<?php echo "{$assessment_component_id}{$program_domain_id}{$course_outcome_id}" ?>"><span class="lbl"><?php echo lang('Select') ?></span>
                                            </label>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        <?php } ?>
                    </table>

                    <div class="table-footer text-right">
                        <button class="btn" type="submit" <?php echo data_loading_text() ?>>
                            <span class="btn-label-icon left fa fa-save" ></span>
                            <?php echo lang('Save'); ?>
                        </button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            <?php } ?>
        </div>
    </div>
</div>