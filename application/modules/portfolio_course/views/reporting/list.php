<?php
/** @var $reports Orm_Pc_Report[] */
/** @var $pager string */
?>
<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <div class="table-primary">
        <div class="table-header">
            <span class="table-caption"><?php echo lang("Reports") ?></span>
            <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'portfolio_course-manage')): ?>
                <a class="btn btn-sm pull-right"
                   href="/portfolio_course/reporting/add_edit?id=<?php echo $course_id; ?>" data-toggle="ajaxModal">
                    <span class="btn-label-icon left fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add') ?>
                </a>
            <?php endif; ?>
        </div>
        <table class="table table-striped table-bordered" border="0">
            <thead>
            <tr>
                <th class="col-md-2"><?php echo lang('Report Title') ?></th>
                <th class="col-md-4"><?php echo lang('Core Component') ?></th>
                <th class="col-md-4"><?php echo lang('Custom Component') ?></th>
                <th class="col-md-2"><?php echo lang('Action') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            if ($reports):
                foreach ($reports as $report) { ?>
                    <?php /* @var $report Orm_Pc_Report */ ?>
                    <tr>
                        <td><?php echo htmlfilter($report->get_title()) ?></td>
                        <td>
                            <ul class="list-group m-b-0">
                                <?php foreach ($report->get_components() as $component) { ?>
                                    <li class="list-group-item">
                                        <?php echo lang(Orm_Pc_Report::$COMPONENTS[$component->get_component_id()]); ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </td>
                        <td>
                            <ul class="list-group m-b-0">
                                <?php foreach ($report->get_components(0) as $component) { ?>
                                    <?php if ($component->get_component_obj()->get_id()) { ?>
                                        <li class="list-group-item">
                                            <?php echo htmlfilter(Orm_Pc_Category::get_instance($component->get_component_id())->get_title()); ?>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-block" target="_blank"
                               href="/portfolio_course/reporting/pdf/<?php echo intval($report->get_id()) ?>">
                                <span class="btn-label-icon left fa fa-download"
                                      aria-hidden="true"></span><?php echo lang('Print') ?>
                            </a>
                            <?php if (Orm_User::check_credential(array(Orm_User::USER_FACULTY, Orm_User::USER_STAFF), false, 'portfolio_course-manage')): ?>
                                <a class="btn btn-sm btn-block"
                                   href="/portfolio_course/reporting/add_edit/<?php echo intval($report->get_id()) ?>?id=<?php echo $course_id; ?>"
                                   data-toggle="ajaxModal">
                                    <span class="btn-label-icon left fa fa-pencil-square-o"
                                          aria-hidden="true"></span><?php echo lang('Edit') ?>
                                </a>
                                <a class="btn btn-sm btn-block"
                                   href="/portfolio_course/reporting/delete/<?php echo intval($report->get_id()) ?>"
                                   message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction">
                                    <span class="btn-label-icon left fa fa-trash-o"
                                          aria-hidden="true"></span><?php echo lang('Delete') ?>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center">
                                <?php echo lang('There are no') . ' ' . lang('Reports'); ?>
                            </h3>
                        </div>

                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php if ($pager) { ?>
            <div class="table-footer"><?php echo $pager; ?></div>
        <?php } ?>
    </div>
</div>