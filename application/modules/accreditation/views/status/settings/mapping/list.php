<?php
/* @var $mapping Orm_As_Agency_Mapping */;
?>
<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('/accreditation/status_settings/mapping/filter', '/accreditation/status_settings/mapping/'.$agency_id, ['keyword']); ?>
        </div>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-3"><?php echo lang('Agency'); ?></td>
                    <td class="col-md-9"><?php echo lang('College'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($mappings): ?>
                    <?php foreach ($mappings as $mapping): ?>
                        <tr>
                            <td><?php echo htmlfilter($mapping->get_agency_obj()->get_name()); ?></td>
                            <td><?php echo htmlfilter($mapping->get_college_obj()->get_name()); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" >
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Mapping'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if(!empty($pager)):?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php endif;?>
    </div>
</div>