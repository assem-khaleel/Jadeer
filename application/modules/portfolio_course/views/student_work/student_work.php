<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php $this->load->view('portfolio_course/student_work/menu'); ?>
</div>


<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span
                class="font-size-15 font-weight-semibold"><?php echo lang("List of Previous student projects") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                    <?php echo form_open('/portfolio_course/student_work/deleteProjects?id=' . $course_id, ['method' => 'post', "class" => 'inline-form', "id" => "editForm", 'data-toggle' => 'ajaxDelete']) ?>
                    <a class="btn btn-sm project"
                       href="/portfolio_course/student_work/addEditWork/1?id=<?php echo $course_id ?>"
                       data-toggle="ajaxModal">
                                <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                        <?php echo lang('Add') ?>
                        </a>
                    <?php if (count($projects)) { ?>
                        <button type="submit" class="btn  btn-sm"><span class="btn-label-icon left"><i
                                    class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                    <?php } ?>
                </span>
            <?php } ?>
        </div>
        <div class="panel-body">
            <?php
            if ($projects):
                if (count($projects))
                    foreach ($projects as $project) { ?>
                        <div>
                            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                <input type="checkbox" name="del[]" value="<?php echo intval($project->get_id()) ?>"/>
                            <?php } ?>
                            <label><?php echo lang('Click link to download') ?>: </label>
                            <?php echo htmlfilter($project->get_title()) ?>
                            <div class="pull-right col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/student_work/downloadProjects/<?php echo intval($project->get_id()) ?>?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/student_work/addEditWork/1/<?php echo intval($project->get_id()) ?>?id=<?php echo $course_id; ?>"
                                       data-toggle="ajaxModal">
                                    <span class="btn-label-icon left fa fa-pencil-square-o"
                                          aria-hidden="true"></span><?php echo lang('Edit') ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
            <?php else: ?>
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center">
                        <?php echo lang('There are no') . ' ' . lang('List of Previous student projects'); ?>
                    </h3>
                </div>
            <?php endif; ?>
            <?php form_close() ?>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Project grading guideline") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                    <a class="btn btn-sm"
                       href="/portfolio_course/student_work/addEditWork/2/<?php echo $guideline->get_id(); ?>?id=<?php echo $course_id ?>"
                       data-toggle="ajaxModal">
                       <span class="btn-label-icon left"><i class="fa fa-pencil-square-o"></i></span>
                        <?php echo $guideline->get_grading_guideline() ? lang('Edit') : lang('Add') ?>
                        </a>
                    </span>
            <?php } ?>
        </div>
        <div class="panel-body">
            <?php if ($guideline->get_grading_guideline()):
                echo htmlfilter($guideline->get_grading_guideline()) ?>
            <?php else: ?>
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center">
                        <?php echo lang('There are no') . ' ' . lang('Project grading guideline'); ?>
                    </h3>
                </div>

            <?php endif; ?>
        </div>
    </div>
</div>