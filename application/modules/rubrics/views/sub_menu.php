<?php /** @var int $type */
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <?php if (!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, ['rubrics-manage', 'rubrics-admin'])): ?>
        <li class="<?php echo ($list == 'list') ? 'active' : ''; ?>">
            <a class="p-y-1" href="/rubrics"
               title="<?php echo lang('Rubrics'); ?>"><?php echo lang('Rubrics'); ?>
            </a>
        </li>
    <?php endif; ?>
    <li class="<?php echo ($list == 'assigned') ? 'active' : ''; ?>">
        <a class="p-y-1" href="/rubrics/Assigned"
           title="<?php echo lang('Assigned'); ?>"><?php echo lang('Assigned To Me'); ?>
        </a>
    </li>
    <?php if (!Orm_User::check_credential([Orm_User::USER_STAFF, Orm_User::USER_FACULTY], false, ['rubrics-admin'])): ?>
        <li class="<?php echo ($list == 'settings') ? 'active' : ''; ?>">
            <a class="p-y-1" href="/rubrics/settings"
            <a class="p-y-1" href="/rubrics/settings"
               title="<?php echo lang('Settings'); ?>"><?php echo lang('Settings'); ?>
            </a>
        </li>
    <?php endif; ?>
</ul>