<?php /* @var $question Orm_Survey_Question_Type_Radio */

$choices = $question->get_choices();


$response = array();
$chart_data = array();
foreach ($choices as $choice) {
    $response[$choice->get_id()] = $choice->get_user_response($filters);
    $chart_data[] = '[ "' . trim(preg_replace('/\s\s+/', ' ', htmlfilter($choice->get_choice()))) . '", ' . $response[$choice->get_id()] . ' ]';
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
            <div class="graph-container">
                <style>
                    #<?php echo $question->get_html_question_name() ?> { height:205px; }
                    <?php if (empty($filters['is_pdf'])) { ?>
                    #<?php echo $question->get_html_question_name() ?> .legendLabel { color:white; }
                    #<?php echo $question->get_html_question_name() ?> .legend>div { background-color:transparent !important; }
                    #<?php echo $question->get_html_question_name() ?> .legendColorBox>div { border: none !important; }
                    <?php } ?>
                </style>
                <div id="<?php echo $question->get_html_question_name() ?>"></div>
                <script>

                    if (typeof google.visualization === 'undefined') {
                        google.load('visualization', '1', {'packages':['corechart']});
                        google.setOnLoadCallback(drawChart_<?php echo $question->get_html_question_name(); ?>);
                    } else {
                        drawChart_<?php echo $question->get_html_question_name(); ?>();
                    }

                    function drawChart_<?php echo $question->get_html_question_name(); ?>() {

                        var data = google.visualization.arrayToDataTable([ ['Option', '% of Responses'], <?php echo implode(', ', $chart_data) ?> ]);

                        var options = {
                            is3D: true,
                            pieSliceText: 'Option',
                            fontSize: 12,
                            sliceVisibilityThreshold: 0

                        };

                        var chart = new google.visualization.PieChart(document.getElementById('<?php echo $question->get_html_question_name(); ?>'));

                        chart.draw(data, options);
                    }
                </script>
            </div>
        </div>
    </div>

</div>

