<?php
/** @var $committee_objs Orm_C_Committee[] */
?>

<?php if (empty($committee_objs)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') .' ' . lang('Committees'); ?>
        </div>
        <?php if(Orm_C_Committee::check_if_can_add() && Orm_User::get_logged_user()->has_role_type() != Orm_Role::ROLE_NOT_ADMIN){?>
        <a href="/committee_work/add_edit" data-toggle="ajaxModal" class="btn btn-block" >
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
                <th class="col-md-2">
                    <?php echo lang('Committee Name') ?>
                </th>
                <th class="col-md-3">
                    <?php echo lang('Level') ?>
                </th>
                <th class="col-md-3">
                    <?php echo lang('Members') ?>
                </th>
                <th class="col-md-1">
                    <?php echo lang('Start date') ?>
                </th>
                <th class="col-md-1">
                    <?php echo lang('End date') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Action') ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($committee_objs as $committee) { ?>
                <tr>
                    <?php /* @var $committee Orm_C_Committee*/?>
                    <td>
                        <?php echo  htmlfilter($committee->get_title()) ?>
                    </td>
                    <td>
                        <span>
                            <b>
                                <?php echo $committee->get_current_type(); ?>
                            </b>
                            <?php if($committee->get_current_type_id_title()){
                                echo " : (".htmlfilter($committee->get_current_type_id_title()).")";
                            } ?>

                        </span>
                    </td>
                    <td>
                        <div>
                            <ul>
                                <?php foreach($committee->get_members() as $member) { ?>
                                    <li>
                                        <?php echo $member->get_user_name() ?>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </td>
                    <td>
                        <?php echo  $committee->get_start_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($committee->get_start_date())) ?>
                    </td>
                    <td>
                        <?php echo  $committee->get_end_date() == '0000-00-00 00:00:00' ? '' : date('Y-m-d', strtotime($committee->get_end_date())) ?>
                    </td>
                    <td>
                        <?php if($committee->check_if_can_edit()){ ?>
                            <a href="/committee_work/add_edit/<?php echo intval($committee->get_id()) ?>"
                               data-toggle="ajaxModal" class="btn btn-sm btn-block" >
                                <span class="btn-label-icon left icon fa fa-pencil-square-o" aria-hidden="true"></span>
                                <?php echo lang('Edit') ?>
                            </a>
                        <?php } ?>
                        <a href="/committee_work/report/<?php echo intval($committee->get_id()) ?>"
                           class="btn btn-sm btn-block" >
                            <span class="btn-label-icon left icon fa fa-eye" aria-hidden="true"></span>
                            <?php echo lang('View') ?>
                        </a>
                        <?php if(Orm_C_Committee::check_if_can_generate_report()){?>
                            <a href="/committee_work/pdf/<?php echo intval($committee->get_id()) ?>"
                               class="btn btn-sm btn-block" >
                                <span class="btn-label-icon left fa fa-file-pdf-o"></span>
                                <?php echo lang('pdf'); ?>
                            </a>
                        <?php } ?>

                        <?php if($committee->check_if_can_delete()){ ?>
                            <a href="/committee_work/delete/<?php echo intval($committee->get_id()) ?>"
                               class="btn btn-sm  btn-block" title="Delete" data-toggle="deleteAction"  message="<?php echo lang('Are you sure ?') ?>">
                                <span class="btn-label-icon left icon fa fa-trash-o" aria-hidden="true"></span>
                                <?php echo lang('Delete') ?>
                            </a>
                        <?php } ?>

                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
<?php } ?>
