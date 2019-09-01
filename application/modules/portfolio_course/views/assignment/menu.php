<div class="panel panel-primary  p-a-0">
    <div class="panel-body remove-spaces p-a-0">

        <ul id="left-nav" class="nav nav-tabs  nav-stacked " style=" overflow-wrap: break-word;">
            <li id="catalog_info" class="<?php echo ($level=='assignment_info')?'active':''; ?>" style="width: 100%;">
                <a href="/portfolio_course/assignment/?id=<?php echo  $course_id ?>&level=assignment_info" style="width: 100%;"><?php echo  lang("Assignments, Exams and Quizzes information")?></a>
            </li>
            <li id="college" style="width: 100%;" class="<?php echo $level=='format_info'?'active':''; ?>">
                <a href="/portfolio_course/assignment/?id=<?php echo  $course_id?>&level=format_info" style="width: 100%;"><?php echo  lang("Format information")?></a>
            </li>
            <?php foreach ( Orm_Pc_Category::get_all( array('course_id'=> $course_id,'level'=>'assignment')) as $category):?>
                <li id="<?php echo $category->get_id()?>" class="<?php echo ($active == $category->get_id())?'active':''; ?>" style="width: 100%;">
                    <a href="/portfolio_course/forms?id=<?php echo $course_id ?>&level=assignment&catid=<?php echo $category->get_id()?>" style="width: 100%;">
                        <?php echo  $category->get_title()?>
                    </a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
   
</div>