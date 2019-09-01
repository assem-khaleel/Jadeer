<?php
/** @var $program_id int */
?>
<?php $this->load->view('course/links',array('course_id' => $course_id)); ?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Course Assessment Method'); ?></span>
    </div>
    <?php $assessment_methods = Orm_Cm_Program_Assessment_Method::get_all(array('program_id' => $program_id)); ?>
    <?php if($assessment_methods) { ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-1">#</th>
                <th class="col-md-2"><?php echo lang('Program Assessment Method'); ?></th>
                <th class="col-md-6"><?php echo lang('Course Assessment Method'); ?></th>
                <th class="col-md-3"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($assessment_methods as $key => $method) { ?>
                <tr>
                    <td><span class="label label-primary"><?php echo ($key + 1); ?></span></td>
                    <td>
                        <b>
                            <?php echo htmlfilter($method->get_assessment_method_obj()->get_title()); ?>
                        </b>
                    </td>
                    <td>
                        <?php $course_methods = Orm_Cm_Course_Assessment_Method::get_all(array('course_id' => $course_id, 'program_assessment_method_id' => $method->get_id())); ?>
                        <?php if (!empty($course_methods)) { ?>
                            <ul class="list-group m-a-0 bg-primary">
                            <?php foreach ($course_methods as $course_method) { ?>
                                <li class="list-group-item no-border-hr padding-xs-hr">
                                    <?php echo htmlfilter($course_method->get_text()); ?>
                                </li>
                            <?php } ?>
                            </ul>
                        <?php } else { ?>
                            <div class="alert m-a-0">
                                <?php echo lang('This Assessment Method not used in this Course'); ?>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="/curriculum_mapping/course/assessment_method_add_edit/<?php echo intval($course_id); ?>/<?php echo intval($method->get_id()); ?>" data-toggle="ajaxModal" class="btn  btn-block" >
                            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Manage').' '.lang('Assessment Methods'); ?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="alert alert-dafualt">
            <div class="m-b-1">
                <?php echo lang('There are no') . ' ' . lang('Program Assessment Method'); ?>
            </div>
        </div>
    <?php } ?>
</div>