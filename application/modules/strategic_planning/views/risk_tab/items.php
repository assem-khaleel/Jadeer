<?php
/**
 * @var string $pager
 * @var string $keyword
 * @var string $title
 * @var int $category
 */
/* @var Orm_Sp_Risk_Tab[] $risk_tabs */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Risk Tab'); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-lg-2"><?php echo lang('initiative'); ?></th>
            <th class="col-lg-2"><?php echo lang('objective'); ?></th>
            <th class="col-lg-2"><?php echo lang('risk'); ?></th>
            <th class="col-lg-2"><?php echo lang('impact'); ?></th>
            <th class="col-lg-4"><?php echo lang('Actions'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($risk_tabs as $risk_tab) { ?>
            <tr class="odd gradeX">
                <td><?php echo htmlfilter($risk_tab->get_initiative_id()); ?></td>
                <td><?php echo htmlfilter($risk_tab->get_objective_id()); ?></td>
                <td><?php echo htmlfilter($risk_tab->get_risk()); ?></td>
                <td><?php echo htmlfilter($risk_tab->get_impact()); ?></td>
                <td>
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/risk_tab/add_edit?c=<?php echo urlencode($category); ?>&id=<?php echo urlencode($risk_tab->get_id()); ?>"
                       data-toggle="ajaxModal"><span class="btn-label-icon left"><i
                                class="fa fa-edit"></i></span><?php echo lang('Edit'); ?></a> |
                    <a class="btn btn-sm btn-block"
                       href="/strategic_planning/risk_tab/remove?id=<?php echo urlencode($risk_tab->get_id()); ?>"
                       message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left"><i
                                class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                </td>
            </tr>
        <?php } ?>
        <?php if (empty($risk_tabs)) { ?>
            <tr>
                <td colspan="12">
                    <div class="alert m-a-0">
                        <?php echo lang('There are no') . ' ' . lang('Risk Tabs'); ?>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if (!empty($pager)) { ?>
        <div class="table-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>
<script>
    function after_modal() {
        init_data_toggle();
    }
</script>