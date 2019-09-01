<div class="panel panel-primary  p-a-0">
    <div class="panel-heading">
        <span class="panel-title"><?php echo lang('Sub Menu'); ?></span>
    </div>
    <div class="panel-body remove-spaces p-a-0">

        <ul id="left-nav" class="nav nav-tabs  nav-stacked " style=" overflow-wrap: break-word;">
            <?php if (!Orm_User::has_role_type(Orm_Role::ROLE_NOT_ADMIN)) { ?>
                <li id="course_evaluation" class="<?php echo ($active=='course_evaluation')?'active':''; ?>" style="width: 100%;">
                    <a href="/portfolio_course/settings/?id=<?php echo  $course_id?>&level=course_evaluation" style="width: 100%;"><?php echo  lang("Course evaluation")?></a>
                </li>
                <li id="college" style="width: 100%;" class="<?php echo $active=='instructor_info'?'active':''; ?>">
                    <a href="/portfolio_course/settings/?id=<?php echo  $course_id?>&level=instructor_info" style="width: 100%;"><?php echo  lang("Instructor information")?></a>
                </li>
                <li id="program" style="width: 100%;" class="<?php echo $active=='required_material'?'active':''; ?>">
                    <a href="/portfolio_course/settings/?id=<?php echo  $course_id?>&level=required_material" style="width: 100%;"><?php echo  lang("Required and recommended materials")?></a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>