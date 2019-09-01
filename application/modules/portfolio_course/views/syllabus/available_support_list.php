<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <?php echo lang("Available support services") ?>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <a class="btn btn-sm pull-right grading"
                   href="/portfolio_course/syllabus/edit/<?php echo $level; ?>?id=<?php echo $course_id ?>"
                   data-toggle="ajaxModal">
                        <span class="btn-label-icon left icon fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add') ?>
                </a>
            <?php } ?>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th><?php echo lang('Material Title') ?></th>
            <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                <th class="col-md-2"><?php echo lang('Action') ?></th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        $services = Orm_Pc_Support_Service::get_all(['course_id' => $course_id]);
        /* @var $service Orm_Pc_Support_Service */
        if ($services):
            foreach ($services as $service) {
                ?>
                <tr>
                    <?php /* @var $topic Orm_Pc_Topic */ ?>
                    <td>
                        <?php echo htmlfilter($service->get_available_support_service()); ?>
                    </td>
                    <?php if ($can_manage && Orm_Semester::get_current_semester() == Orm_Semester::get_active_semester()) { ?>
                        <td>
                            <a href="/portfolio_course/syllabus/edit/<?php echo $level; ?>/<?php echo intval($service->get_id()) ?>?id=<?php echo $course_id; ?>"
                               data-toggle="ajaxModal" class="btn btn-sm btn-block grading">
                                    <span class="btn-label-icon left icon fa fa-pencil-square-o"
                                          aria-hidden="true"></span> <?php echo lang('Edit') ?>
                            </a>
                            <a href="/portfolio_course/syllabus/delete/<?php echo $level ?>/<?php echo intval($service->get_id()) ?>?id=<?php echo $course_id ?>"
                               class="btn btn-sm  btn-block" title="Delete" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                                <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                                <?php echo lang('Delete') ?>
                            </a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
        <?php else: ?>
            <tr>
                <td colspan="2">
                    <div class="well well-sm m-a-0">
                        <h3 class="m-a-0 text-center">
<?php echo lang('There are no') . ' ' . lang('Available support services'); ?>
                        </h3>
                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>