<?php
/* @var Orm_As_Status[] $program_agencies */;
?>
<div class="row">
    <div class="col-lg-12">
        <?php $this->load->view('legends'); ?>

        <div class="well">
            <h3 class="m-a-0"><?php echo htmlfilter(Orm_User::get_logged_user()->get_program_obj()->get_name()) ?></h3>
        </div>

        <div class="table-primary">
            <div class="table-header">
                <span class="table-caption">
                    <?php echo lang('Program Agencies'); ?>
                </span>
                <div class="panel-heading-controls col-sm-4">
                    <a href="/accreditation/status/agency_add_edit" data-toggle="ajaxModal" class="btn btn-sm pull-right" >
                        <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('Agency'); ?>
                    </a>
                </div>
            </div>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td class="col-md-8"><?php echo lang('Name'); ?></td>
                    <td class="col-md-1 text-center"><?php echo lang('Status'); ?></td>
                    <td class="col-md-3 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($program_agencies): ?>
                    <?php foreach ($program_agencies as $status_obj):  ?>
                        <tr>
                            <td>
                                <a href="/accreditation/status/agency_preview/<?php echo intval($status_obj->get_id()); ?>" data-toggle="ajaxModal" >
                                    <?php echo $status_obj->get_agency_obj()->get_name(); ?>
                                </a>
                            </td>
                            <td class="text-center">
                                <div style="color: <?php echo $status_obj->get_status('color'); ?>;">
									<i class="fa fa-certificate fa-2x"></i>
								</div>
                                <?php echo $status_obj->get_status('name'); ?>
                            </td>
                            <td class="text-center">
                                <a href="/accreditation/status/agency_add_edit/<?php echo intval($status_obj->get_id()); ?>" data-toggle="ajaxModal" class="btn btn-block" title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span> <?php echo lang('Edit') ?>
                                </a>
                                <a href="/accreditation/status/agency_delete/<?php echo intval($status_obj->get_id()); ?>" class="btn btn-sm btn-block" title="<?php echo lang('Delete') ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Delete') ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Program Agencies'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
            <?php if(!empty($pager)):?>
                <div class="table-footer">
                    <?php echo $pager; ?>
                </div>
            <?php endif;?>
        </div>
    </div>
</div>