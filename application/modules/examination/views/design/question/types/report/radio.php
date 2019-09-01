<?php /* @var $question Orm_Survey_Question_Type_Radio */

$choices = $question->get_choices();


$response = array();
$chart_data = array();
foreach ($choices as $choice) {
    $response[$choice->get_id()] = $choice->get_user_response($filters);
    $chart_data[] = '{ label: "' . htmlfilter($choice->get_choice()) . '", data: ' . $response[$choice->get_id()] . ' }';
}

?>
<div class="table-light">
    <div class="table-header">
        <div class="table-caption">
            <?php echo lang('Multiple Choice (Only One Answer)'); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-10"><?php echo lang('Choice'); ?></th>
                <th class="col-md-1 text-center"><?php echo lang('Average'); ?></th>
                <th class="col-md-1 text-center"><?php echo lang('Response'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($choices as $choice) { ?>
                <tr>
                    <td class="col-md-10"><?php echo htmlfilter($choice->get_choice()); ?></td>
                    <td class="col-md-1 text-center"><?php echo array_sum($response) ? round(($response[$choice->get_id()] / array_sum($response)) * 100, 2) : 0; ?>
                        %
                    </td>
                    <td class="col-md-1 text-center"><?php echo $response[$choice->get_id()] ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <div class="table-footer">
            <style>
                #<?php echo $question->get_html_question_name() ?> { height:205px; }
                #<?php echo $question->get_html_question_name() ?> .legendLabel { color:white; }
                #<?php echo $question->get_html_question_name() ?> .legend>div { background-color:transparent !important; }
                #<?php echo $question->get_html_question_name() ?> .legendColorBox>div { border: none !important; }
            </style>
            <script>
                pxInit.push(function () {
                    // Doughnut Chart Data
                    var doughnutChartData = [<?php echo implode(', ', $chart_data) ?>];

                    // Init Chart
                    $('#<?php echo $question->get_html_question_name() ?>').plot(doughnutChartData, {
                        series: {
                            pie: {
                                show: true,
                                radius: 1,
                                innerRadius: 0.5,
                                label: {
                                    show: true,
                                    radius: 3 / 4,
                                    formatter: function (label, series) {
                                        return '<div style="font-size:14px;text-align:center;padding:2px;color:white;">' + Math.round(series.percent) + '%</div>';
                                    },
                                    background: {opacity: 0}
                                }
                            }
                        }
                    });
                });
            </script>
            <div class="graph-container">
                <div id="<?php echo $question->get_html_question_name() ?>"></div>
            </div>
        </div>
    </div>

</div>

