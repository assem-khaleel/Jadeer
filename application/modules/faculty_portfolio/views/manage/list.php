<div class="table-primary">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Evaluations') ?>
            <a href="/faculty_portfolio/manage/add_edit_tab" data-toggle="ajaxModal" class="pull-right btn btn-sm">
                <span class="btn-label-icon left fa fa-plus"></span>
                <?php echo lang('Add') ?>
            </a>
        </div>

    </div>
    <div class="table-responsive m-a-0">
        <table class="table table-striped table-bordered">
            <thead>
            <tr class="bg-primary">
                <th class="col-md-6">
                    <b><?php echo lang('Title') ?></b>
                </th>
                <th class="col-md-4 text-center">
                    <b><?php echo lang('points') ?></b>
                </th>
                <th class="col-md-2 text-center">
                    <b><?php echo lang('Action') ?></b>
                </th>
            </tr>
            </thead>
            <tbody>

            <?php
            /** @var Orm_Fp_Eva_Tabs $tab */
            if(count($tabs)){
                foreach ($tabs as $tab){
                    ?>
                    <tr>
                        <td>
                            <b><?php echo htmlfilter($tab->get_title()) ?></b>
                        </td>
                        <td>
                            <b><?php echo htmlfilter($tab->get_points()) ?></b>
                        </td>
                        <td class="text-center">
                            <a href="/faculty_portfolio/manage/add_edit_tab/<?php echo (int)$tab->get_id() ?>" data-toggle="ajaxModal" class="btn btn-block"><i class="btn-label-icon left fa fa-edit"></i><?php echo lang('Edit'); ?></a>
                        <?php if(!$tab->have_evaluation()): ?>
                            <a href="/faculty_portfolio/manage/manage_tab/<?php echo (int)$tab->get_id() ?>" data-toggle="ajaxModal"class="btn btn-block"><i class="btn-label-icon left fa fa-gear"></i><?php echo lang('Manage'); ?></a>
                            <a href="/faculty_portfolio/manage/delete_tab/<?php echo (int)$tab->get_id() ?>" data-toggle="deleteAction" class="btn  btn-block"><i class="btn-label-icon left fa fa-trash-o"></i><?php echo lang('Delete'); ?></a>
                        <?php endif; ?>
                        </td>
                    </tr>
                <?php }
            }else {?>
                <tr>
                    <td colspan="7">
                        <div class="well well-sm m-a-0">
                            <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Evaluations'); ?></h3>
                        </div>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
<?php if (!empty($pager)): ?>
    <div class="table-footer">
        <?php echo $pager; ?>
    </div>
<?php endif; ?>
</div>
