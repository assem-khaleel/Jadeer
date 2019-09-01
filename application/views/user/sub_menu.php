<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-0">
    <li <?php echo ($class_type == Orm_User_Student::class) ? 'class="active"' : '' ?>>
        <a href="/user?type=<?php echo Orm_User::USER_STUDENT; ?>" class="p-y-1"
           title="<?php echo lang('Student'); ?>"><?php echo lang('Student'); ?></a>
    </li>
    <li <?php echo ($class_type == Orm_User_Faculty::class) ? 'class="active"' : '' ?>>
        <a href="/user?type=<?php echo Orm_User::USER_FACULTY; ?>" class="p-y-1"
           title="<?php echo lang('Faculty'); ?>"><?php echo lang('Faculty'); ?></a>
    </li>
    <li <?php echo ($class_type == Orm_User_Staff::class) ? 'class="active"' : '' ?>>
        <a href="/user?type=<?php echo Orm_User::USER_STAFF; ?>" class="p-y-1"
           title="<?php echo lang('Staff'); ?>"><?php echo lang('Staff'); ?></a>
    </li>
</ul>