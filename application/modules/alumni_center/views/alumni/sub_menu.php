<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <li <?php if ($class_type == Orm_User::USER_ALUMNI) : ?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/alumni_center?type=<?php echo Orm_User::USER_ALUMNI; ?>" title="<?php echo lang('Alumni'); ?>"><?php echo lang('Alumni'); ?></a>
    </li>
    <li <?php if ($class_type == Orm_User::USER_EMPLOYER) : ?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/alumni_center?type=<?php echo Orm_User::USER_EMPLOYER; ?>" title="<?php echo lang('Employer'); ?>"><?php echo lang('Employer'); ?></a>
    </li>
</ul>