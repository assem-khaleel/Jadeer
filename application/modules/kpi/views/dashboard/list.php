<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 11/19/15
 * Time: 11:13 AM
 */
$ok = true;
$kpi_count = Orm_Kpi::get_count();
?>
<div class="row">
    <div class="col-md-4">
        <div class="panel box bg-white text-default">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('KPIs Categories'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell">
                    <div id="kpi-category">
                        <?php if (!$kpi_count) { ?>
                            <div class="alert alert-default">
                                <div class="m-b-1"><?php echo lang('No KPIs to be displayed') ?>.</div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if ($kpi_count) { ?>
                    <script type="text/javascript">

                        if (typeof google.visualization === 'undefined') {
                            google.setOnLoadCallback(drawKPICategory);
                        } else {
                            drawKPICategory();
                        }

                        function drawKPICategory() {
                            var data = google.visualization.arrayToDataTable([
                                ['<?php echo lang('KPI Category') ?>', '<?php echo lang('No. Of KPIs') ?>'],
                                ['<?php echo lang(Orm_Kpi::get_category_by_id(Orm_Kpi::KPI_ACCREDITATION)) ?>', <?php echo Orm_Kpi::get_count(array('category_id' => Orm_Kpi::KPI_ACCREDITATION)) ?>],
                                ['<?php echo lang(Orm_Kpi::get_category_by_id(Orm_Kpi::KPI_STRATEGIC)) ?>', <?php echo Orm_Kpi::get_count(array('category_id' => Orm_Kpi::KPI_STRATEGIC)) ?>],
                            ]);

                            var options = {
                                legend: {position: 'bottom'},
                                fontSize: 8,
                                pieHole: 0.4
                            };

                            var chart = new google.visualization.PieChart(document.getElementById('kpi-category'));
                            chart.draw(data, options);
                        }
                    </script>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel box bg-white text-default">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('KPIs Measure Type'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell">
                    <div id="kpi-measure">
                        <?php if (!$kpi_count) { ?>
                            <div class="alert alert-default">
                                <div class="m-b-1"><?php echo lang('No KPIs to be displayed') ?>.</div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if ($kpi_count) { ?>
                        <script type="text/javascript">

                            if (typeof google.visualization === 'undefined') {
                                google.setOnLoadCallback(drawKPIMeasure);
                            } else {
                                drawKPIMeasure();
                            }

                            function drawKPIMeasure() {
                                var data = google.visualization.arrayToDataTable([
                                    ['<?php echo lang('KPI Measure Type') ?>', '<?php echo lang('No. Of KPIs') ?>'],
                                    ['<?php echo lang('Qualitative KPI') ?>', <?php echo Orm_Kpi::get_count(array('kpi_type' => Orm_Kpi::KPI_QUALITATIVE)) ?>],
                                    ['<?php echo lang('Quantitative KPI') ?>', <?php echo Orm_Kpi::get_count(array('kpi_type' => Orm_Kpi::KPI_QUANTITATIVE)) ?>]
                                ]);

                                var options = {
                                    legend: {position: 'bottom'},
                                    fontSize: 8,
                                    pieHole: 0.4
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('kpi-measure'));
                                chart.draw(data, options);
                            }
                        </script>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel box bg-white text-default">
            <div class="box-row">
                <div class="box-cell p-x-3 p-y-1">
                    <div class="pull-xs-left font-weight-semibold font-size-12"><?php echo lang('NCAAA KPIs'); ?></div>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell">
                    <div id="kpi-ncaaa">
                        <?php if (!$kpi_count) { ?>
                            <div class="alert alert-default">
                                <div class="m-b-1"><?php echo lang('No KPIs to be displayed') ?>.</div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php if ($kpi_count) { ?>
                        <script type="text/javascript">

                            if (typeof google.visualization === 'undefined') {
                                google.setOnLoadCallback(drawKPINCAAA);
                            } else {
                                drawKPINCAAA();
                            }

                            function drawKPINCAAA() {
                                var data = google.visualization.arrayToDataTable([
                                    ['<?php echo lang('NCAAA out of All') ?>', '<?php echo lang('No. Of KPIs') ?>'],
                                    ['<?php echo lang('NCAAA KPI') ?>', <?php echo Orm_Kpi::get_count(array('ncaaa' => Orm_Kpi::KPI_NCAAA)) ?>],
                                    ['<?php echo lang('Non-NCAAA KPI') ?>', <?php echo Orm_Kpi::get_count(array('ncaaa' => Orm_Kpi::KPI_NOT_NCAAA)) ?>]
                                ]);

                                var options = {
                                    legend: {position: 'bottom'},
                                    fontSize: 8,
                                    pieHole: 0.4
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('kpi-ncaaa'));
                                chart.draw(data, options);
                            }
                        </script>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="panel">
    <div class="panel-heading">
        <span class="panel-title"><i class="panel-title-icon fa fa-line-chart text-danger"></i><?php echo lang('KPI Results for the 5 Periodic Points'); ?></span>
        <ul class="nav nav-tabs nav-xs">
            <li id="category-<?php echo Orm_Kpi::KPI_ACCREDITATION ?>" class="kpi-category"><a href="javascript:void(0);" onclick="callKPIs(<?php echo Orm_Kpi::KPI_ACCREDITATION ?>)" ><?php echo Orm_Kpi::get_category_by_id(Orm_Kpi::KPI_ACCREDITATION); ?></a></li>
            <li id="category-<?php echo Orm_Kpi::KPI_STRATEGIC ?>" class="kpi-category"><a href="javascript:void(0);" onclick="callKPIs(<?php echo Orm_Kpi::KPI_STRATEGIC ?>)" ><?php echo Orm_Kpi::get_category_by_id(Orm_Kpi::KPI_STRATEGIC); ?></a></li>
        </ul>
    </div>
    <div class="panel-heading" id="standards">
        <div class="input-group">
            <label for="standard-selector" class="input-group-addon"><?php echo lang('Select a Standard'); ?></label>
            <select id="standard-selector" class="form-control" >
                <?php foreach (Orm_Standard::get_all() as $standard) { ?>
                    <?php $selected = $ok ? 'selected="selected"' : ''; ?>
                    <option <?php echo $selected; ?> value="<?php echo htmlfilter($standard->get_id()); ?>" ><?php echo htmlfilter($standard->get_title()); ?></option>
                    <?php $ok = false; ?>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="panel-body">
        <div id="kpi-table" class="ps-block tab-pane active"></div>
    </div>
</div>
<script>
    google.load('visualization', '1', {'packages':['corechart', 'bar', 'table']});
    pxInit.push(function () {
        callKPIs(<?php echo Orm_Kpi::KPI_ACCREDITATION ?>);
    });

    $('#standard-selector').change(function () {
        callKPIs(<?php echo Orm_Kpi::KPI_ACCREDITATION ?>);
    });

    function callKPIs(category) {

        var kpiTable = $('#kpi-table');
        kpiTable.css('min-height', '300px');
        kpiTable.addClass('form-loading');
        kpiTable.addClass('form-loading-inverted');
        kpiTable.html('');
        $('.kpi-category').removeClass('active');
        $('#category-'+category).addClass('active');

        var data = {
            category_id: category
        };

        if (category == <?php echo Orm_Kpi::KPI_ACCREDITATION ?>) {
            $('#standards').css('display','block');
            data['standard_id'] = $('#standard-selector').val();
        } else {
            $('#standards').css('display','none');
        }

        $.ajax({
            type: "POST",
            url: "<?php echo $this->input->server('REQUEST_URI') ?>",
            data: data
        }).done(function (msg) {
            $('#kpi-table').html(msg);
            $('#kpi-table').removeClass('form-loading');
            $('#kpi-table').removeClass('form-loading-inverted');
            $('#kpi-table').css('min-height', '0');
        });
    }
</script>