<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 4/18/17
 * Time: 9:36 AM
 */
$username = Orm_User_Faculty::get_instance($user_id);
?>

<script>
    google.load('visualization', '1', {'packages':['corechart', 'bar']});
</script>

<style>
    .charts {
        width: 100%;
        min-height: 300px;

    }
</style>

<div class="panel panel-danger m-t-2">
    <div class="panel-heading">
        <span class="panel-title">
            <?php echo lang('Report For') . ' ' . $username->get_full_name() ?>
        </span>
    </div>
    <div class="panel-body loading">
        <div class="m-t-0">
            <div id="chart_div" class="charts"></div>
        </div>
        <div class="m-t-2">
            <div id="chart_div2" class="charts"></div>
        </div>
        <div class="m-t-2">
            <div id="chart_div3" class="charts"></div>
        </div>
        <div class="m-t-2">
            <div id="chart_div4" class="charts"></div>
        </div>
        <div class="m-t-2">
            <div id="chart_div5" class="charts"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        var loading = $('.loading');
        loading.css('min-height', '500px');
        loading.addClass('form-loading');

        $.ajax({
            url: '/faculty_performance/faculty_report/summaryReport',
            data: {'user_id': <?php echo $user_id?>}
        }).done(function (data) {

            var option = {
                legend : 'bottom',
                hAxis: {
                    title: data.common.performance,
                    minValue: 0
                },
                vAxis: {
                    title: data.common.type
                }
            };

            var facultyOptions = jQuery.extend(true, { title: data.faculty.title }, option);
            var programOptions = jQuery.extend(true, { title: data.program.title }, option);
            var departmentOptions = jQuery.extend(true, { title: data.department.title }, option);
            var collegeOptions = jQuery.extend(true, { title: data.college.title }, option);
            var universityOptions = jQuery.extend(true, { title: data.university.title }, option);

            if (typeof google.visualization === 'undefined') {
                google.setOnLoadCallback(drawChart(data.faculty.data, facultyOptions, 'chart_div'));
                google.setOnLoadCallback(drawChart(data.program.data, programOptions, 'chart_div2'));
                google.setOnLoadCallback(drawChart(data.department.data, departmentOptions, 'chart_div3'));
                google.setOnLoadCallback(drawChart(data.college.data, collegeOptions, 'chart_div4'));
                google.setOnLoadCallback(drawChart(data.university.data, universityOptions, 'chart_div5'));
            } else {
                drawChart(data.faculty.data, facultyOptions, 'chart_div');
                drawChart(data.program.data, programOptions, 'chart_div2');
                drawChart(data.department.data, departmentOptions, 'chart_div3');
                drawChart(data.college.data, collegeOptions, 'chart_div4');
                drawChart(data.university.data, universityOptions, 'chart_div5');
            }

            loading.removeClass('form-loading');
        });
    });
    function drawChart(data, options, div) {

        var chart = new google.visualization.BarChart(document.getElementById(div));

        var dataChart = google.visualization.arrayToDataTable(data);

        chart.draw(dataChart, options);

        function resizeHandler() {
            chart.draw(dataChart, options);
        }

        if (window.addEventListener) {
            window.addEventListener('resize', resizeHandler, false);
        } else if (window.attachEvent) {
            window.attachEvent('onresize', resizeHandler);
        }
    }
</script>