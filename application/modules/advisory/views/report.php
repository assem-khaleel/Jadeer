<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 11/9/17
 * Time: 9:57 AM
 */
/** @var $student_faculty Orm_Ad_Student_Faculty */
/** @var $student_selected Orm_Ad_Student_Faculty[] */
?>

<div class="row m-t-3">
    <div class="col-md-6">
        <div class="panel clearfix">
            <div class="panel-heading p-a-3">
                <div class="panel-title">
                    <i class="panel-title-icon fa fa-check-square-o font-size-16"></i> <?php echo lang('Student List'); ?>
                </div>
            </div>
            <div class="ps-block ps-container ps-theme-default ps-active-y" id="list_student" style="height: 297px;">
                <?php
                if ($student_selected) {
                    foreach ($student_selected as $student) {
                        ?>
                        <div class="col-xs-12 p-x-1 p-y-2 b-t-1 bg-white">
                            <div class="pull-xs-right font-size-16">
                            <span class="label label-success ticket-label">
                            <?php echo Orm_Program::get_instance($student->get_program_id())->get_name(); ?>
                            </span>
                                <!--                                <span class="label label-success ticket-label">-->
                                <!--                            --><?php //echo Orm_User_Faculty::get_instance($student->get_faculty_id())->get_full_name(); ?>
                                <!--                            </span>-->
                            </div>

                            <div
                                    class="font-size-15"><?php echo Orm_User::get_instance($student->get_student_id())->get_full_name(); ?></div>
                        </div>
                        <?php
                    }
                } else { ?>
                    <div class="panel p-y-2 p-x-3 m-a-0 text-md-center">
                        <h4 class="m-a-0"><?php echo lang("There are no").' '.lang('student') ?></h4>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel clearfix">
            <div class="panel-heading p-a-3">
                <div class="panel-title">
                    <i class="panel-title-icon fa fa-check-square-o font-size-16"></i> <?php echo lang('Meeting List'); ?>
                </div>
            </div>
            <div class="ps-block ps-container ps-theme-default ps-active-y" id="list_meeting" style="height: 297px;">
                <?php
                if ($meeting_info) {
                    foreach ($meeting_info as $meeting) {
                        ?>
                        <div class="col-xs-12 p-x-1 p-y-2 b-t-1 bg-white">
                            <div class="pull-xs-right font-size-16">
                            <span class="label label-success ticket-label">

                                <b><?php echo lang('Date'); ?>:</b>
                            <span><?php echo htmlfilter($meeting->get_date()) ?></span>
                            <b><?php echo lang('From'); ?>:</b>
                            <span><?php echo htmlfilter($meeting->get_start_time()) ?></span>
                            <b><?php echo lang('To'); ?>:</b>
                            <span><?php echo htmlfilter($meeting->get_end_time()) ?></span>
                            </span>
                            </div>
                            <div class="font-size-15">
                                <?php echo htmlfilter($meeting->get_name()); ?>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                <?php } else { ?>
                    <div class="panel p-y-2 p-x-3 m-a-0 text-md-center">
                        <h4 class="m-a-0"><?php echo lang("There are no").' '.lang('Meeting') ?></h4>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
if (!$faculty_program) {
    ?>
    <div class="panel p-y-2 p-x-3 m-a-0 text-md-center">
        <h4 class="m-a-0"><?php echo lang("Program Advisory Performance") ?></h4>
    </div>
    <?php
} else {
    ?>
    <div class="row">
        <div id="curve_chart" style="height: 500px" class="col-sm-12"></div>
    </div>
    <?php
    $chartData = array();

    foreach ($faculty_program as $key) {
        /** @var Orm_Ad_Faculty_Program $key */
        $chartData[] = "[ '" . htmlfilter(Orm_Program::get_instance($key['program_id'])->get_name()) . "'," . Orm_Ad_Faculty_Program::get_program_avg($key['program_id']) / $key['count'] . "]";
    }
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $(function () {
            $('#list_student').perfectScrollbar();
            $('#list_meeting').perfectScrollbar();
        });


        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {


            google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawBasic);

            function drawBasic() {

                var data = google.visualization.arrayToDataTable([
                    ['<?php echo lang('Programs'); ?>', '<?php echo lang('Average'); ?>'],
                    <?php echo implode(',', $chartData); ?>
                ]);


                var options = {
                    title: '<?php echo lang('Program Advisory Performance'); ?>',
                    chartArea: {width: '50%'},
                    hAxis: {
                        title: '<?php echo lang('Values'); ?>',
                        minValue: 0
                    },
                    vAxis: {
                        title: '<?php echo lang('Programs'); ?>'
                    }
                };

                var chart = new google.visualization.BarChart(document.getElementById('curve_chart'));

                chart.draw(data, options);
            }
        }
    </script>

<?php } ?>

