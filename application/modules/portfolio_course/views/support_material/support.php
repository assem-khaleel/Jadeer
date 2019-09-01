<?php

echo form_open('/portfolio_course/support_material/delete?id=' . $course_id, ['method' => 'post', "class" => 'inline-form', "id" => "editForm", 'data-toggle' => 'ajaxDelete'])
?>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <?php $this->load->view('portfolio_course/support_material/menu'); ?>
    </div>
    <div class=" col-lg-9 col-md-9 col-sm-12 col-xs-12 no-border-vr no-border-r form">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="font-size-15 font-weight-semibold"><?php echo lang("Construction Technique") ?>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                        <span class="pull-right">
                            <a class="btn btn-sm manual"
                               href="/portfolio_course/support_material/addEditAttachment/construction?id=<?php echo $course_id; ?>"
                               data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                                <?php echo lang('Add') ?>                      </a>
                            <?php if (!empty($constructions)) { ?>
                                <button type="submit" class="btn btn-sm"><span class="btn-label-icon left"><i
                                            class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>
            </div>

            <div class="panel-body">
                <?php
                if ($constructions) {
                    foreach ($constructions as $construction) { ?>
                        <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                            <div class="col-lg-8 col-md-8 ">
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <input type="checkbox" name="del[]"
                                           value="<?php echo intval($construction->get_id()) ?>"/>
                                <?php } ?>
                                <label><?php echo lang('Click link to download') ?>:</label>
                                <?php echo htmlfilter($construction->get_file_name()) ?>
                            </div>
                            <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/support_material/download/<?php echo intval($construction->get_id()) ?>/construction?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/support_material/addEditAttachment/construction/<?php echo intval($construction->get_id()) ?>?id=<?php echo $course_id; ?>"
                                       data-toggle="ajaxModal">
                                        <span class="btn-label-icon left fa fa-pencil-square-o"
                                              aria-hidden="true"></span><?php echo lang('Edit') ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
                            <?php echo lang('There are no') . ' ' . lang('Construction Technique'); ?>
                        </h3>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="font-size-15 font-weight-semibold"><?php echo lang("Equipment Documentation") ?>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                        <span class="pull-right">
                            <a class="btn btn-sm manual"
                               href="/portfolio_course/support_material/addEditAttachment/equipment?id=<?php echo $course_id; ?>"
                               data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                                <?php echo lang('Add') ?>                      </a>
                            <?php if (!empty($equipments)) { ?>
                                <button type="submit" class="btn btn-sm"><span class="btn-label-icon left"><i
                                            class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                            <?php } ?>
                    </span>
                    <?php } ?>
                </div>
            </div>
            <div class="panel-body">
                <?php
                if ($equipments) {
                    foreach ($equipments as $equipment) { ?>
                        <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                            <div class="col-lg-8 col-md-8 ">
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <input type="checkbox" name="del[]"
                                           value="<?php echo intval($equipment->get_id()) ?>"/>
                                <?php } ?>
                                <label><?php echo lang('Click link to download') ?>:</label>
                                <?php echo htmlfilter($equipment->get_file_name()) ?>
                            </div>
                            <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/support_material/download/<?php echo intval($equipment->get_id()) ?>/equipment?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/support_material/addEditAttachment/equipment/<?php echo intval($equipment->get_id()) ?>?id=<?php echo $course_id ?>"
                                       data-toggle="ajaxModal">
                                        <span class="btn-label-icon left fa fa-pencil-square-o"
                                              aria-hidden="true"></span><?php echo lang('Edit') ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>

                    <?php } ?>
                <?php } else { ?>
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
                            <?php echo lang('There are no') . ' ' . lang('Equipment Documentation'); ?>
                        </h3>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="font-size-15 font-weight-semibold"><?php echo lang("Computer Documentation") ?>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                        <span class="pull-right">
                            <a class="btn btn-sm manual"
                               href="/portfolio_course/support_material/addEditAttachment/computerDocumentation?id=<?php echo $course_id; ?>"
                               data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                                <?php echo lang('Add') ?>                      </a>

                            <?php if (!empty($computerDocumentations)) { ?>
                                <button type="submit" class="btn btn-sm"><span class="btn-label-icon left"><i
                                            class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>
            </div>
            <div class="panel-body">
                <?php
                if ($computerDocumentations) {
                    foreach ($computerDocumentations as $computerDocumentation) { ?>
                        <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                            <div class="col-lg-8 col-md-8 ">
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <input type="checkbox" name="del[]"
                                           value="<?php echo intval($computerDocumentation->get_id()) ?>"/>
                                <?php } ?>
                                <label><?php echo lang('Click link to download') ?>:</label>
                                <?php echo htmlfilter($computerDocumentation->get_file_name()) ?>
                            </div>
                            <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/support_material/download/<?php echo intval($computerDocumentation->get_id()) ?>/computerDocumentation?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/support_material/addEditAttachment/computerDocumentation/<?php echo intval($computerDocumentation->get_id()) ?>?id=<?php echo $course_id ?>"
                                       data-toggle="ajaxModal">
                                        <span class="btn-label-icon left fa fa-pencil-square-o"
                                              aria-hidden="true"></span><?php echo lang('Edit') ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
                            <?php echo lang('There are no') . ' ' . lang('Computer Documentation'); ?>
                        </h3>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="font-size-15 font-weight-semibold"><?php echo lang("Troubleshooting Tips") ?>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                        <span class="pull-right">
                                <a class="btn btn-sm manual"
                                   href="/portfolio_course/support_material/addEditAttachment/troubleshootingTip?id=<?php echo $course_id; ?>"
                                   data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                                    <?php echo lang('Add') ?>                      </a>
                            <?php if (!empty($troubleshootingTips)) { ?>
                                <button type="submit" class="btn btn-sm"><span class="btn-label-icon left"><i
                                            class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                            <?php } ?>
                        </span>
                    <?php } ?>
                </div>
            </div>
            <div class="panel-body">
                <?php
                if ($troubleshootingTips) {
                    foreach ($troubleshootingTips as $troubleshootingTip) { ?>
                        <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                            <div class="col-lg-8 col-md-8 ">
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <input type="checkbox" name="del[]"
                                           value="<?php echo intval($troubleshootingTip->get_id()) ?>"/>
                                <?php } ?>
                                <label><?php echo lang('Click link to download') ?>:</label>
                                <?php echo htmlfilter($troubleshootingTip->get_file_name()) ?>
                            </div>
                            <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/support_material/download/<?php echo intval($troubleshootingTip->get_id()) ?>/troubleshootingTip?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/support_material/addEditAttachment/troubleshootingTip/<?php echo intval($troubleshootingTip->get_id()) ?>?id=<?php echo $course_id ?>"
                                       data-toggle="ajaxModal">
                                        <span class="btn-label-icon left fa fa-pencil-square-o"
                                              aria-hidden="true"></span><?php echo lang('Edit') ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
                            <?php echo lang('There are no') . ' ' . lang('Troubleshooting Tips'); ?>
                        </h3>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="font-size-15 font-weight-semibold"><?php echo lang("Debugging Tips") ?>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                        <span class="pull-right">
                             <a class="btn btn-sm manual"
                                href="/portfolio_course/support_material/addEditAttachment/debugging?id=<?php echo $course_id; ?>"
                                data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                                 <?php echo lang('Add') ?>                      </a>
                            <?php if (!empty($debuggingTips)) { ?>
                                <button type="submit" class="btn btn-sm"><span class="btn-label-icon left"><i
                                            class="fa fa-trash-o"></i></span><?php echo lang('Delete') . ' ' . lang('Selected'); ?></button>
                            <?php } ?>
                        </span>
                    <?php } ?>

                </div>
            </div>
            <div class="panel-body">
                <?php
                if ($debuggingTips) {
                    foreach ($debuggingTips as $debuggingTip) { ?>
                        <div class="col-lg-12 col-md-12  m-b-1 clearfix">
                            <div class="col-lg-8 col-md-8 ">
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <input type="checkbox" name="del[]"
                                           value="<?php echo intval($debuggingTip->get_id()) ?>"/>
                                <?php } ?>
                                <label><?php echo lang('Click link to download') ?>:</label>
                                <?php echo htmlfilter($debuggingTip->get_file_name()) ?>
                            </div>
                            <div class="pull-right col-lg-4 col-md-4 col-sm-6 text-right ">
                                <a class="btn btn-sm p-r-2"
                                   href="/portfolio_course/support_material/download/<?php echo intval($debuggingTip->get_id()) ?>/debugging?id=<?php echo $course_id ?>">
                                    <span class="btn-label-icon left fa fa-download"
                                          aria-hidden="true"></span><?php echo lang('Download') ?>
                                </a>
                                <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                                    <a class="btn btn-sm p-r-2"
                                       href="/portfolio_course/support_material/addEditAttachment/debugging/<?php echo intval($debuggingTip->get_id()) ?>?id=<?php echo $course_id ?>"
                                       data-toggle="ajaxModal">
                                        <span class="btn-label-icon left fa fa-pencil-square-o"
                                              aria-hidden="true"></span><?php echo lang('Edit') ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
                            <?php echo lang('There are no') . ' ' . lang('Debugging Tips'); ?>
                        </h3>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="font-size-15 font-weight-semibold"><?php echo lang("Additions and Revisions") ?>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                        <span class="pull-right">
                                 <a class="btn btn-sm manual"
                                    href="/portfolio_course/support_material/addEditAddition/<?php echo $addition->get_id(); ?>?id=<?php echo $course_id ?>"
                                    data-toggle="ajaxModal">
                        <span class="btn-label-icon left"><i class="fa fa-pencil-square-o"></i></span>
                                     <?php echo lang('Edit') ?>                      </a>
                    </span>
                    <?php } ?>
                </div>
            </div>
            <div class="panel-body">
                <?php if ($addition->get_addition()) { ?>
                    <?php echo htmlfilter($addition->get_addition()) ?>
                <?php } else { ?>
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
                            <?php echo lang('There are no') . ' ' . lang('Additions and Revisions'); ?>
                        </h3>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

<?php form_close() ?>