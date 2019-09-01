<?php
/** @var $can_manage bool */
/** @var $custom_menus Orm_Pc_Category[] */
?>
<div class="panel panel-primary  p-a-0">
    <div class="panel-body remove-spaces p-a-0">

        <ul id="left-nav" class="nav nav-tabs  nav-stacked " style=" overflow-wrap: break-word;">
            <li id="catalog_info" class="<?php echo ($active=='catalog_info')?'active':''; ?>" style="width: 100%;">
                <a href="/portfolio_course/syllabus?id=<?php echo $course_id ?>&level=catalog_info" style="width: 100%;"><?php echo  lang("Catalogue information")?></a>
            </li>
            <li id="college" style="width: 100%;" class="<?php echo $active=='instructor_info'?'active':''; ?>">
                <a href="/portfolio_course/syllabus?id=<?php echo $course_id ?>&level=instructor_info" style="width: 100%;"><?php echo  lang("Instructor information")?></a>
            </li>
            <li id="program" style="width: 100%;" class="<?php echo $active=='required_material'?'active':''; ?>">
                <a href="/portfolio_course/syllabus?id=<?php echo $course_id ?>&level=required_material" style="width: 100%;"><?php echo  lang("Required and recommended materials")?></a>
            </li>
            <li id="objective" style="width: 100%;" class="<?php echo $active=='course_desc'?'active':''; ?>">
                <a href="/portfolio_course/syllabus?id=<?php echo $course_id ?>&level=course_desc" style="width: 100%;"><?php echo  lang("Course description and education objectives")?></a>
            </li>
            <li id="goal" style="width: 100%;" class="<?php echo $active=='course_calender'?'active':''; ?>">
                <a href="/portfolio_course/syllabus?id=<?php echo $course_id ?>&level=course_calender" style="width: 100%;"><?php echo  lang("Course calender")?></a>
            </li>
            <li id="plo" style="width: 100%;" class="<?php echo $active=='course_policies'?'active':''; ?>">
                <a href="/portfolio_course/syllabus?id=<?php echo $course_id ?>&level=course_policies" style="width: 100%;"><?php echo  lang("Course policies")?></a>
            </li>
            <li id="ncaaa" style="width: 100%;" class="<?php echo $active=='available_support'?'active':''; ?>">
                <a href="/portfolio_course/syllabus?id=<?php echo $course_id ?>&level=available_support"  style="width: 100%;"><?php echo  lang("Available support services for course")?></a>
            </li>
            <?php foreach ( Orm_Pc_Category::get_all( array('course_id'=> $course_id,'level'=>'syllabus')) as $category):?>
            <li id="<?php echo $category->get_id()?>" class="<?php echo ($active== $category->get_id())?'active':''; ?>" style="width: 100%;">
                <a href="/portfolio_course/forms?id=<?php echo $course_id ?>&level=syllabus&catid=<?php echo $category->get_id()?>" style="width: 100%;">
                    <?php echo  $category->get_title()?>
                </a>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
