<?php
/** @var Orm_Course $course */
/** @var Orm_Course_Section[] $sections */
?>
<div class="panel panel-primary panel-dark widget-profile">
    <div class="panel-heading">
<!--        <div class="widget-profile-bg-icon"><i class="fa fa-suitcase"></i></div>-->
        <div class="widget-profile-header">
            <span class="font-size-15 font-weight-semibold"><?php echo htmlfilter($course->get_name()); ?> - <?php echo htmlfilter($course->get_department_obj()->get_name()) ?></span>
        </div>
    </div> <!-- / .panel-heading -->
    <div class="widget-profile-counters">
        <div class="col-xs-6"><?php echo lang("Course Code")?><br><span><?php echo htmlfilter($course->get_code()) ?></span></div>
        <div class="col-xs-6"><?php echo lang("Credit hours")?><br>
            <?php foreach (Orm_Program_Plan::get_all(['course_id' => $course->get_id()]) as $plan) { ?>
                <span><?php echo $plan->get_program_obj()->get_name() . " :" . $plan->get_credit_hours(); ?> <?php echo lang('cr.'); ?></span><br>
            <?php } ?>
        </div>
    </div>
    <div>
        <table class="table table-striped table-bordered" border="0">
            <thead>
            <tr>
                <th colspan="3"></th>
            </tr>
            <tr>
                <th colspan="3" class="text-center"><?php echo lang("Section Information")?></th>
            </tr>
            <tr>
                <th class="text-center"><?php echo lang("Course section")?></th>
                <th class="text-center"><?php echo lang("Classroom location")?></th>
                <th class="text-center"><?php echo lang("Lecture time")?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($sections as $section) {?>
                <tr>
                    <?php /* @var $section Orm_Course_Section*/?>
                    <td><?php echo htmlfilter($section->get_name())?></td>
                    <td><?php echo htmlfilter($section->get_extra_item('location'))?></td>

                    <td class="text-left"><?php
                        $extra =(array) $section->get_extra_item('schedule');
                        foreach( $extra as $key=>$value) {
                            echo lang($key)." : ".$value['from']." - ".$value['to']."<br>";
                        }
                        ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>