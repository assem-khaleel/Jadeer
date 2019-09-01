<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 16/10/17
 * Time: 10:29 AM
 */

/**
 * @var $perspectives Orm_Sp_Perspective[]
 */
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption row">
            <?php echo lang('Perspectives') ?>
        </div>
    </div>

    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-5"><?php echo lang('Title'). ' (' . lang('English') . ')'; ?></th>
                <th class="col-lg-5"><?php echo lang('Title'). ' (' . lang('Arabic') . ')'; ?></th>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($perspectives as $perspective) { ?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter($perspective->get_name_en()); ?></span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($perspective->get_name_ar()); ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                        <a class="btn btn-block" data-toggle="ajaxModal" href="/strategic_planning/perspective/add_edit/<?php echo (int) $perspective->get_id(); ?>"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <?php if($perspective->can_delete()) : ?>
                        <a class="btn btn-block" data-toggle="deleteAction" href="/strategic_planning/perspective/delete/<?php echo (int)$perspective->get_id(); ?>"><span class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                        <?php endif; ?>
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

</div>

