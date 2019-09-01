<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 7/10/17
 * Time: 9:22 AM
 */
?>
<ul class="nav nav-tabs nav-tabs-simple nav-sm page-block m-b-2">
    <?php if (Orm_User::has_role_type(Orm_Role::ROLE_PROGRAM_ADMIN) || Orm_User::has_role_type(Orm_Role::ROLE_COLLEGE_ADMIN)) { ?>

        <li <?php if($type == '2'):?>class="active"<?php endif; ?>

            <?php validation_errors('you havnt permissions'); ?>
            <a class="p-y-1" href="/project_management/assigned_sub_phases" title="<?php echo lang('Assigned sub-phases'); ?>"><?php echo lang('Assigned sub-phases'); ?></a>
        </li>
    <?php }else{  ?>

    <li <?php if($type == '0'):?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/project_management" title="<?php echo lang('Strategic Projects'); ?>"><?php echo lang('Strategic Projects');; ?></a>
    </li>
    <li <?php if($type == '1'):?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/project_management/customized_projects" title="<?php echo lang('Customized Projects'); ?>"><?php echo lang('Customized Projects'); ?></a>
    </li>
    <li <?php if($type == '2'):?>class="active"<?php endif; ?>>
        <a class="p-y-1" href="/project_management/assigned_sub_phases" title="<?php echo lang('Assigned sub-phases'); ?>"><?php echo lang('Assigned sub-phases'); ?></a>
    </li>

    <?php } ?>
</ul>


