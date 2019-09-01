<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title">
            <?php
            echo lang('Ratio of programs in') . ' ';
            echo ($college_id ? '('. Orm_College::get_instance($college_id)->get_name().')' : lang('Institution')) . ' ';
            echo lang('per accreditation statuses') . ' ';
            echo ($agency_id ? lang('within') . ' ('.Orm_As_Agency::get_instance($agency_id)->get_name().')' : lang('with all agencies'));
            ?>
        </span>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6" id="chart_agency" style="height: 250px;"></div>
            <div class="col-md-6 table-primary text-primary" id="table_div" style="height: 250px;"></div>
        </div>
    </div>
</div>

<div id="status_container"></div>

<script type="text/javascript">

    if (typeof google.visualization === 'undefined') {
        google.setOnLoadCallback(drawAgencyChart);
    } else {
        drawAgencyChart();
    }

    function drawAgencyChart() {

        var data = google.visualization.arrayToDataTable([<?php echo implode(',', $data_table) ?>]);

        var chart = new google.visualization.PieChart(document.getElementById('chart_agency'));
        google.visualization.events.addListener(chart, 'select', function() { selectHandler(chart.getSelection()); });
        chart.draw(data, {colors: [<?php echo "'". implode("', '", array_column(Orm_As_Status::$types, 'color')) ."'"; ?>]});

        var data_view = new google.visualization.DataView(data);
        data_view.setColumns([0,1]); //here you set the columns you want to display

        var table = new google.visualization.Table(document.getElementById('table_div'));
        google.visualization.events.addListener(table, 'select', function() { selectHandler(table.getSelection()); });
        table.draw(data_view, {width: '100%', height: '100%'});

        $('.gradient').removeClass('gradient');

        function selectHandler(selection) {
            var status = data.getValue(selection[0].row, 2);
            if (status) {
                var agency_id = $('#agency-filter').val();
                var college_id = $('#college-filter').val();

                ajaxRender('status_container', "/accreditation/status/chart_status?agency_id=" + agency_id + "&college_id=" + college_id + "&status=" + status);
            }
        }
    }
</script>
