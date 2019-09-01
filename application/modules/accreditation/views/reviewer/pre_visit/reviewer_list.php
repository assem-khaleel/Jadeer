<?php
/** @var $programs Orm_Program[]
 * @var $reviewer Orm_Acc_Pre_Visit_Reviewer */
?>
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><?php echo lang('Reviewers'); ?> : <?php echo htmlfilter(Orm_Acc_Pre_Visit_Reviewer::get_type_element($type, $type_id)->get_name()) ?></span>
            <div class="panel-heading-controls">

                <a class="btn btn-xs btn-success btn-outline btn-outline-colorless" href="/accreditation/reviewer_pre_visit/reviewer_add/<?php echo htmlfilter($type); ?>/<?php echo intval($type_id); ?>" data-toggle="ajaxModal" >
                    <span class="btn-label-icon left"><i class="fa fa-plus"></i></span> <?php echo lang('Add').' '.lang('Reviewer'); ?>
                </a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                <tr class="bg-primary" >
                    <td class="col-md-7"><?php echo lang('Reviewer Name'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($reviewers) { ?>
                    <?php foreach ($reviewers as $reviewer) { ?>
                        <tr>
                            <td><?php echo $reviewer->get_reviewer_obj()->draw_compose_link(); ?></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-block" href="/accreditation/reviewer_pre_visit/reviewer_delete/<?php echo intval($reviewer->get_id()); ?>" data-toggle="deleteAction" message="<?php echo lang('Are you sure ?')?>"><span class="btn-label-icon left"><i class="fa fa-trash"></i></span><?php echo lang('Delete'); ?></a>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Reviewers'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php if (!empty($pager)) { ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php } ?>