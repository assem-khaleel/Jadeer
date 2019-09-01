<?php
/** @var $programs Orm_Program */

?>

<?php if (empty($programs)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') . ' ' . lang('Programs'); ?>
        </div>
        <?php if (Orm_User::get_logged_user()->has_role_type() != Orm_Role::ROLE_NOT_ADMIN) { ?>
            <a href="/advisory/add_edit_topic" data-toggle="ajaxModal" class="btn btn-block">
                <span class="btn-label-icon left fa fa-plus"></span>
                <?php echo lang('Add New'); ?>
            </a>
        <?php } ?>

    </div>
<?php } else { ?>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-10">
                    <?php echo lang('Program') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Action') ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($programs as $program) {
                ?>
                <tr>
                    <?php /* @var $program Orm_Program */ ?>
                    <td>
                        <h5 class="m-t-0"><?php echo htmlfilter($program->get_name()); ?></h5>
                        <ul>
                            <li>
                                <i><?php echo lang('College'); ?></i> : <?php echo htmlfilter($program->get_department_obj()->get_college_obj()->get_name()); ?>
                            </li>
                            <li>
                                <i><?php echo lang('Department'); ?></i> : <?php echo htmlfilter($program->get_department_obj()->get_name()); ?>
                            </li>
                        </ul>
                    </td>
                    <td >
                        <a href="/advisory/view_topic/<?php echo intval($program->get_id()) ?>"
                           class="btn btn-sm btn-block">
                            <span class="btn-label-icon left icon fa fa-eye" aria-hidden="true"></span>
                            <?php echo lang('View').' '.lang('Topics') ?>
                        </a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if ($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
<?php } ?>
