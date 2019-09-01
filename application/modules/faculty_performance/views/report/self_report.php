<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 4/18/17
 * Time: 9:36 AM
 */
$username = Orm_User_Faculty::get_instance(Orm_User::get_logged_user_id());
?>
<script>
    google.load('visualization', '1', {'packages':['corechart', 'bar']});
</script>
<style>
    .charts {
        width: 100%;
        min-height: 200px;

    }
</style>
<div class="col-lg-8 col-md-8 m-t-4">

    <div class="col-lg-12 col-md-12 m-t-4">
        <div class="panel panel-danger">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('Report For');
                    echo ' ';
                    echo $username->get_full_name() ?></span>
            </div>
            <div class="panel-body loading">
                <div class="" id="forms">
                    <div class="m-t-1 row">
                        <div id="chart_div" class="charts"></div>
                    </div>
                    <div class="m-t-1 row">
                        <div id="chart_div5" class="charts"></div>
                    </div>
                    <div class="m-t-1 row">
                        <div class="charts" id="chart_div2"></div>
                    </div>
                    <div class="m-t-1 row">
                        <div id="chart_div3" class="charts"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<div class="col-lg-4 col-md-2 m-t-4">
    <div class="m-t-4">


        <div class="panel panel-danger">
            <div class="panel-heading">
                <span class="panel-title"><?php echo lang('University Report') ?></span>
            </div>
            <div class="panel-body  loading">
                <div class="" style="height:200px" id="chart_div4"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-2 m-t-4">
    <div class="m-a-4" style="height:200px" id="chart_div4"></div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var loading = $('.loading');
        loading.css('min-height', '500px');
        loading.addClass('form-loading');


        $.ajax({
            url: '/faculty_performance/faculty_report/summaryReport',
            data: {'user_id': <?php echo $username->get_id(); ?>}
        }).done(function (data) {
            var option = {
                isStacked: true,
                legend : 'bottom',
                hAxis: {
                    title: data.common.performance,
                    minValue: 0
                },
                vAxis: {
                    title: data.common.type
                }
            };
            var facultyOptions = jQuery.extend(true, {}, option),
                universityOptions = jQuery.extend(true, {}, option),
                departmentOptions = jQuery.extend(true, {}, option),
                programOptions = jQuery.extend(true, {}, option),
                collegeOptions = jQuery.extend(true, {}, option),
                departmentDiv = 'chart_div2',
                facultyDiv = 'chart_div',
                programDiv = 'chart_div5',
                collegeDiv = 'chart_div3',
                universityDiv = 'chart_div4';

            loading.removeClass('form-loading');
            loading.css('min-height', '0');


            universityOptions.title = data.university.title;
            universityOptions.colors = ['#DC3912','#d95f02'];

            facultyOptions.title = data.faculty.title;
            facultyOptions.colors = ['#DC3912','#9575cd'];

            departmentOptions.title = data.department.title;
            departmentOptions.colors = ['#DC3912','#b87333'];

            programOptions.title = data.program.title;
            programOptions.colors = ['#DC3912','#b87553'];

            collegeOptions.title = data.college.title;
            collegeOptions.colors = ['#DC3912','#76A7FA'];

            if (typeof google.visualization === 'undefined') {
                google.setOnLoadCallback(drawChart(data.faculty.data, facultyOptions, facultyDiv,2));
                google.setOnLoadCallback(drawChart(data.department.data, departmentOptions, departmentDiv,3));
                google.setOnLoadCallback(drawChart(data.program.data, programOptions, programDiv));
                google.setOnLoadCallback(drawChart(data.college.data, collegeOptions, collegeDiv));
                google.setOnLoadCallback(drawChart(data.university.data, universityOptions, universityDiv ,1));
            } else {
                drawChart(data.faculty.data, facultyOptions, facultyDiv,2);
                drawChart(data.department.data, departmentOptions, departmentDiv,3);
                drawChart(data.program.data, programOptions, programDiv);
                drawChart(data.college.data, collegeOptions, collegeDiv);
                drawChart(data.university.data, universityOptions, universityDiv ,1);
            }

        });
    });
    function drawChart(data, options, div ,chart_type) {
        var chart ;
        switch (chart_type){
            case 1:
                chart = new google.visualization.LineChart(document.getElementById(div));
                break;
            case 2:
                chart = new google.visualization.SteppedAreaChart(document.getElementById(div));
                break;
            case 3:
                chart = new google.visualization.SteppedAreaChart(document.getElementById(div));
                break;
            default:
                chart = new google.visualization.BarChart(document.getElementById(div));
        }
        var dataChart = google.visualization.arrayToDataTable(data);
        chart.draw(dataChart, options);
        function resizeHandler() {
            chart.draw(dataChart, options);
        }

        if (window.addEventListener) {
            window.addEventListener('resize', resizeHandler, false);
        }
        else if (window.attachEvent) {
            window.attachEvent('onresize', resizeHandler);
        }
    }
</script>