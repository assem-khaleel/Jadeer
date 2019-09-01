<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" xmlns="http://www.w3.org/1999/html"
     xmlns="http://www.w3.org/1999/html">
    <?php
    $this->load->view('assignment/menu');
    ?>
</div>
<?php echo form_open('/portfolio_course/assignment/deleteFormatInfo/' . $level . '?id=' . $course_id, ['method' => 'post', "class" => 'inline-form', "id" => "editForm", 'data-toggle' => 'ajaxDelete']) ?>

<div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <?php /* @var $assignment Orm_Pc_Assignment */ ?>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Assignment format") ?>
                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                    <span class="pull-right">
                         <a class="btn btn-sm"
                            href="/portfolio_course/assignment/addEditFormat/<?php echo $level ?>/assignment?id=<?php echo $course_id ?>"
                            data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                             <?php echo lang('Add') ?>
                         </a>
                        <?php if($assignments){ ?>
                            <button type="submit" class="btn btn-sm"><span class="btn-label-icon left"><i
                                        class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                        <?php } ?>

                    </span>
                <?php } ?>
            </span>
        </div>
        <div class="panel-body">
            <?php
            if ($assignments):
                if (count($assignments))
                    foreach ($assignments as $assignment) { ?>
                        <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                            <div class="col-lg-8 col-md-8 ">
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <input type="checkbox" name="del[]"
                                           value="<?php echo intval($assignment->get_id()) ?>"/>
                                <?php } ?>
                                <label><?php echo lang('Click link to download') ?>: </label>
                                <?php echo htmlfilter($assignment->get_file_name()) ?>
                            </div>
                            <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/assignment/download/<?php echo intval($assignment->get_id()) ?>/<?php echo $level ?>/assignment?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/assignment/addEditformat/<?php echo $level ?>/assignment/<?php echo intval($assignment->get_id()) ?>?id=<?php echo $course_id ?>"
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
                        <?php echo lang('There are no') . ' ' . lang('Assignment format'); ?>
                    </h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Homework problems") ?>
                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                    <span class="pull-right">
                         <a class="btn btn-sm manual"
                            href="/portfolio_course/assignment/addEditFormat/<?php echo $level ?>/homework?id=<?php echo $course_id ?>"
                            data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                             <?php echo lang('Add') ?>                      </a>
                        <?php if(count($homeworks)){ ?>
                            <button type="submit" class="btn btn-sm"><span class="btn-label-icon left"><i
                                        class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                        <?php } ?>
                    </span>
                <?php } ?>
            </span>
        </div>
        <div class="panel-body">
            <?php
            if ($homeworks):
                if (count($homeworks))
                    foreach ($homeworks as $homework) { ?>
                        <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                            <div class="col-lg-8 col-md-8 ">
                                <?php if ($can_manage) { ?>
                                    <input type="checkbox" name="del[]"
                                           value="<?php echo intval($homework->get_id()) ?>"/>
                                <?php } ?>
                                <label><?php echo lang('Click link to download') ?>: </label>
                                <?php echo htmlfilter($homework->get_file_name()) ?>
                            </div>
                            <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/assignment/download/<?php echo intval($homework->get_id()) ?>/<?php echo $level ?>/homework?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/assignment/addEditformat/<?php echo $level ?>/homework/<?php echo intval($homework->get_id()) ?>?id=<?php echo $course_id ?>"
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
                        <?php echo lang('There are no') . ' ' . lang('Homework problems'); ?>
                    </h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("Laboratory experiment format") ?>
                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                    <span class="pull-right">
                         <a class="btn btn-sm manual"
                            href="/portfolio_course/assignment/addEditFormat/<?php echo $level ?>/laboratory?id=<?php echo $course_id ?>"
                            data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                             <?php echo lang('Add') ?>                      </a>
                        <?php if(count($laboratories)){ ?>
                            <button type="submit" class="btn btn-sm"><span class="btn-label-icon left"><i
                                        class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                        <?php } ?>
                    </span>
                <?php } ?>
            </span>
        </div>
        <div class="panel-body">
            <?php
            if ($laboratories):
                if (count($laboratories))
                    foreach ($laboratories as $laboratory) { ?>
                        <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                            <div class="col-lg-8 col-md-8 ">
                                <?php if ($can_manage) { ?>
                                    <input type="checkbox" name="del[]"
                                           value="<?php echo intval($laboratory->get_id()) ?>"/>
                                <?php } ?>
                                <label><?php echo lang('Click link to download') ?>: </label>
                                <?php echo htmlfilter($laboratory->get_file_name()) ?>
                            </div>
                            <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/assignment/download/<?php echo intval($laboratory->get_id()) ?>/<?php echo $level ?>/laboratory?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/assignment/addEditformat/<?php echo $level ?>/laboratory/<?php echo intval($laboratory->get_id()) ?>?id=<?php echo $course_id ?>"
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
                        <?php echo lang('There are no') . ' ' . lang('Laboratory experiment format'); ?>
                    </h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <span class="font-size-15 font-weight-semibold"><?php echo lang("In-class exercises format") ?>
                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                    <span class="pull-right">
                         <a class="btn btn-sm manual"
                            href="/portfolio_course/assignment/addEditFormat/<?php echo $level ?>/exercise?id=<?php echo $course_id ?>"
                            data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                             <?php echo lang('Add') ?>                      </a>

                        <?php if(count($exercises)){ ?>
                            <button type="submit" class="btn btn-sm"><span class="btn-label-icon left"><i
                                        class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                        <?php } ?>
                    </span>
                <?php } ?>
            </span>
        </div>
        <div class="panel-body">
            <?php
            if ($exercises):
                if (count($exercises))
                    foreach ($exercises as $exercise) { ?>
                        <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                            <div class="col-lg-8 col-md-8 ">
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <input type="checkbox" name="del[]" value="<?php echo $exercise->get_id() ?>"/>
                                <?php } ?>
                                <label><?php echo lang('Click link to download') ?>: </label>
                                <?php echo htmlfilter($exercise->get_file_name()) ?>
                            </div>
                            <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/assignment/download/<?php echo intval($exercise->get_id()) ?>/<?php echo $level ?>/exercises?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/assignment/addEditformat/<?php echo $level ?>/exercises/<?php echo intval($exercise->get_id()) ?>?id=<?php echo $course_id ?>"
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
                        <?php echo lang('There are no') . ' ' . lang('In-class exercises format'); ?>
                    </h3>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php form_close() ?>