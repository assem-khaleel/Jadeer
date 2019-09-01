<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 03/04/17
 * Time: 09:57 ص
 */
?>

<div class="table-primary">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th class="col-md-9"><?php echo lang('Report Name'); ?></th>
            <th class="col-md-2"><?php echo lang('View') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($reports as $module) {
            if ($module['license']) { ?>
                <tr class="bg-primary">
                    <td colspan="3"><?php echo $module['module'] ?></td>
                </tr>

                <?php foreach ($module['mReports'] as $report) { ?>
                    <tr>
                        <td><?php echo $report['name']; ?></td>
                        <td><a href="<?php echo $report['link'] ?>" class="btn btn-block"><i
                                        class="btn-label-icon left fa fa-eye"></i><?php echo lang('View'); ?></a></td>
                    </tr>
                <?php }
            }
        }
        ?>
        </tbody>
    </table>
</div>