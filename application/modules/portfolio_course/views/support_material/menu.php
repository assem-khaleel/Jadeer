<?php
/** @var $can_manage bool */
/** @var $custom_menus Orm_Pc_Category[] */
$categories = Orm_Pc_Category::get_all( array('course_id'=> $course_id,'level'=>'support_material'));
?>


<div class="panel panel-primary  p-a-0">
    <div class="panel-body remove-spaces p-a-0">

        <ul id="left-nav" class="nav nav-tabs  nav-stacked " style=" overflow-wrap: break-word;">
            <li id="support_material" style="width: 100%;" class="<?php echo $active=='support_material'?'active':''; ?>">
                <a href="/portfolio_course/support_material?id=<?php echo $course_id ?>&level=support_material" style="width: 100%;"><?php echo  lang("Documentation")?></a>
            </li>
            <?php foreach ( $categories as  $category):?>
                <li id="<?php echo $category->get_id()?>" class="<?php echo ($active== $category->get_id())?'active':''; ?>" style="width: 100%;">
                    <a href="/portfolio_course/forms?id=<?php echo $course_id ?>&level=support_material&catid=<?php echo $category->get_id()?>" style="width: 100%;">
                        <?php echo  $category->get_title()?>
                    </a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>