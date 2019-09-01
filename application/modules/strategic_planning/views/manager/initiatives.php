<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 10/20/15
 * Time: 11:53 PM
 */
/** @var Orm_Sp_Initiative[] $initiatives */
/** @var array $perspective */
?>
<div class="table-<?php echo $perspective['color'] ?> table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Initiative'); ?></span>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th class="col-lg-5"><?php echo lang('Title'); ?></th>
            <th class="col-lg-1"><?php echo lang('Status'); ?></th>
            <th class="col-lg-1"><?php echo lang('Trend'); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($initiatives as $initiative) { ?>
            <tr>
                <td><?php echo htmlfilter($initiative->get_title()); ?></td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>