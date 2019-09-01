<?php
/* @var $notifications Orm_Notification[] */;
?>
<div class="col-md-9 col-lg-10">
    <section class="content">
        <div class="table-primary">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-5"><?php echo lang('Notification Subject'); ?></td>
                    <td class="col-md-5"><?php echo lang('Notification Name'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($notifications as $notification): ?>
                    <td><?php echo $notification->get_subject(); ?></td>
                    <td><?php echo lang($notification->get_name()); ?></td>
                    <td class="text-center">
                        <a href="/notification/edit/<?php echo (int)$notification->get_id(); ?>"
                           class="btn btn-sm btn-block" title="<?php echo lang('Edit') ?>">
                            <span class="btn-label-icon left fa fa-edit"
                                  aria-hidden="true"></span><?php echo lang('Edit') ?>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php if (!empty($pager)): ?>
                <div class="table-footer">
                    <?php echo $pager; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</div>
