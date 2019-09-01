
<?php
$role=Orm_User::get_logged_user()->get_institution_role();
?>

<div class="panel-body remove-spaces remove-br p-a-0">

    <ul id="left-nav" class="nav nav-tabs  nav-stacked " style=" overflow-wrap: break-word;">
        <?php if($role==Orm_Role::ROLE_INSTITUTION_ADMIN) {?>
        <li id="university" class="<?php echo ($active == 'university') ? 'active' : ''; ?>" style="width: 100%;">
            <a href="/program_tree/edit/<?php echo  intval($programs->get_id()); ?>"
               style="width: 100%;"><?php echo  lang("University Mission") ?></a>
        </li>
        <?php }?>
        <?php if($role==Orm_Role::ROLE_COLLEGE_ADMIN || $role==Orm_Role::ROLE_INSTITUTION_ADMIN) {?>
        <li id="college" style="width: 100%;" class="<?php echo $active == 'college' ? 'active' : ''; ?>">
            <a href="/program_tree/edit/<?php echo  intval($programs->get_id()); ?>/college"
               style="width: 100%;"><?php echo  lang("Consistency (University Mission to College Mission)") ?></a>
        </li>
        <?php }?>
        <?php if($role==Orm_Role::ROLE_PROGRAM_ADMIN || $role==Orm_Role::ROLE_INSTITUTION_ADMIN) {?>
        <li id="program" style="width: 100%;" class="<?php echo $active == 'program' ? 'active' : ''; ?>">
            <a href="/program_tree/edit/<?php echo  intval($programs->get_id()); ?>/program"
               style="width: 100%;"><?php echo  lang("Consistency (College Mission to Program Mission)") ?></a>
        </li>
        <li id="objective" style="width: 100%;" class="<?php echo $active == 'objective' ? 'active' : ''; ?>">
            <a href="/program_tree/edit/<?php echo  intval($programs->get_id()); ?>/objective"
               style="width: 100%;"><?php echo  lang("Program Mission to Program Objectives") ?></a>
        </li>
            <?php if (License::get_instance()->check_module('curriculum_mapping')){?>
        <li id="plo" style="width: 100%;" class="<?php echo $active == 'plo' ? 'active' : ''; ?>">
            <a href="/program_tree/edit/<?php echo  intval($programs->get_id()); ?>/plo"
               style="width: 100%;"><?php echo  lang("PLO to Program Objectives") ?></a>
        </li>
                <?php }?>
        <?php }?>
    </ul>
</div>
<style>
    input[type=checkbox]{
        margin-top: -6px;
        margin-left: -22px;
        z-index: 1;
    }
</style>