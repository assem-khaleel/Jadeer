<?php
/** @var Orm_Pc_Teaching_Material[] $manuals */
/** @var Orm_Pc_Teaching_Material $lectureNote */
/** @var Orm_Pc_Teaching_Material $additions */
/** @var Boolean $can_manage */
/** @var int $course_id */
?>
<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <?php $this->load->view('portfolio_course/teaching_material/menu'); ?>
</div>
<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Course Manual") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <span class="pull-right">
                    <?php echo form_open('/portfolio_course/teaching_material/deleteManuals?id=' . $course_id, ['method' => 'post', "class" => 'inline-form', "id" => "editForm", 'data-toggle' => 'ajaxDelete']) ?>
                    <a class="btn btn-sm"
                       href="/portfolio_course/teaching_material/addEditMaterial/1?id=<?php echo $course_id ?>"
                       data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                        <?php echo lang('Add') ?>
                        </a>
                    <?php if (count($manuals)) { ?>
                        <button type="submit" class="btn  btn-sm"><span class="btn-label-icon left"><i
                                    class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                    <?php } ?>
                </span>
            <?php } ?>
        </div>
        <div class="panel-body">
            <?php
            if ($manuals) {
                foreach ($manuals as $manual) { ?>
                    <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                        <div class="col-lg-8 col-md-8 ">
                            <?php if ($can_manage && Orm_Semester::get_current_semester()->get_id() == Orm_Semester::get_active_semester()->get_id()) { ?>
                                <input type="checkbox" name="del[]" value="<?php echo $manual->get_id() ?>"/>
                            <?php } ?>
                            <label><?php echo lang('Click link to download') ?>: </label>
                            <?php echo htmlfilter($manual->get_course_manual_title()); ?>
                        </div>
                        <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                            <a class="btn btn-sm p-r-2"
                               href="/portfolio_course/teaching_material/downloadManuals/<?php echo $manual->get_id() ?>?id=<?php echo $course_id ?>">
                            <span class="btn-label-icon left fa fa-download"
                                  aria-hidden="true"></span><?php echo lang('Download') ?>
                            </a>
                            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/teaching_material/addEditMaterial/1/<?php echo intval($manual->get_id()) ?>?id=<?php echo $course_id ?>"
                                   data-toggle="ajaxModal">
                                <span class="btn-label-icon left fa fa-pencil-square-o"
                                      aria-hidden="true"></span><?php echo lang('Edit') ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                    <hr>

                <?php } ?>
            <?php } else { ?>
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center">
                        <?php echo lang('There are no') . ' ' . lang('Course Manual'); ?>
                    </h3>
                </div>
            <?php } ?>
        </div>
        <?php echo form_close() ?>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Lecture Note") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester()->get_id() == Orm_Semester::get_active_semester()->get_id()) { ?>
                <span class="pull-right">
                    <a class="btn btn-sm"
                       href="/portfolio_course/teaching_material/addEditMaterial/2/<?php echo $lectureNote->get_id(); ?>?id=<?php echo $course_id; ?>"
                       data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-pencil-square-o"></i></span>
                        <?php echo lang('Edit') ?>
                    </a>
                </span>
            <?php } ?>
        </div>
        <div class="panel-body">
            <?php echo htmlfilter($lectureNote->get_lecture_note()) ?>
            <?php if (empty($lectureNote->get_lecture_note())) { ?>
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center">
                        <?php echo lang('There are no') . ' ' . lang('Lecture Note'); ?>
                    </h3>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Additions and Revisions") ?></span>
            <?php if ($can_manage && Orm_Semester::get_current_semester()->get_id() == Orm_Semester::get_active_semester()->get_id()) { ?>
                <span class="pull-right">
                <a class="btn btn-sm"
                   href="/portfolio_course/teaching_material/addEditMaterial/3/<?php echo $additions->get_id(); ?>?id=<?php echo $course_id ?>"
                   data-toggle="ajaxModal">
                    <span class="btn-label-icon left"><i class="fa fa-pencil-square-o"></i></span>
                    <?php echo lang('Edit') ?>
                </a>
            </span>
            <?php } ?>
        </div>
        <div class="panel-body">
            <?php echo htmlfilter($additions->get_addition()); ?>
            <?php if (!$additions->get_addition()) { ?>
                <div class="well well-sm m-a-0">
                    <h3 class="m-a-0 text-center">
                        <?php echo lang('There are no') . ' ' . lang('Addition'); ?>
                    </h3>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
