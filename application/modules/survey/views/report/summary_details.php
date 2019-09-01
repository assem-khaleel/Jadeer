<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 8/9/15
 * Time: 2:20 PM
 */
/* @var $survey Orm_Survey */
/* @var $filters array */
$overall = 0;
$max_response = 0;
if (!empty($draw_filters)) {
    ?>
    <div class="box p-a-1 clearfix">
        <div class="pull-left">
            <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>"
                    type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false"
                    aria-controls="filters">
                <span class="fa fa-filter"></span>
            </button>
            <?php echo lang($survey->get_type(true)) ?>
        </div>

        <?php
        $url = $this->input->server('REQUEST_URI');
        $explode_url = explode('?', $url);
        $query_string = empty($explode_url[1]) ? '' : ('?' . $explode_url[1]);
        $query_string .= '&fltr[summary]=2';
        ?>

        <div class="pull-right">
            <a class="btn btn-sm " href="/survey/report/pdf<?php echo($query_string); ?>">
                <span class="btn-label-icon left icon fa fa-file-pdf-o"></span> <?php echo lang('PDF'); ?>
            </a>
            <a class="btn btn-sm " href="/survey/report/img<?php echo($query_string); ?>">
                <span class="btn-label-icon left icon fa fa-image"></span> <?php echo lang('Image'); ?>
            </a>
        </div>
    </div>

    <form method="GET" class="form-horizontal">
        <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
            <div class="well">
                <?php
                switch ($survey->get_type()) {
                    case Orm_Survey::TYPE_ALUMNI :
                        echo Orm_User_Alumni::draw_filters();
                        break;

                    case Orm_Survey::TYPE_EMPLOYER :
                        echo Orm_User_Employer::draw_filters();
                        break;

                    case Orm_Survey::TYPE_FACULTY :
                        echo Orm_User_Faculty::draw_filters();
                        break;

                    case Orm_Survey::TYPE_STAFF :
                        echo Orm_User_Staff::draw_filters();
                        break;

                    case Orm_Survey::TYPE_STUDENTS :
                        echo Orm_User_Student::draw_filters();
                        break;

                    case Orm_Survey::TYPE_COURSES :
                        echo '<div class="well well-sm">';
                        echo '<div class="m-x-1">';
                        echo Orm_User_Faculty::draw_find_users('fltr[faculty_id]');
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="well well-sm">';
                        echo '<h5 class="m-a-0 m-t-1">'.lang('Students').'</h5>';
                        echo '<hr>';
                        echo Orm_User_Student::draw_filters(empty($filters['evaluation_id']));
                        echo '</div>';
                        break;
                }
                ?>
                <input type="hidden" name="survey_id" value="<?php echo htmlfilter($survey->get_id()); ?>"/>

                <div class="clearfix">
                    <a class="btn pull-left "
                       href="<?php echo preg_replace('/(.*)\?(.*)/', '$1?survey_id=' . intval($survey->get_id()), $this->input->server('REQUEST_URI')) ?>"><span class="btn-label-icon left"><i class="fa fa-recycle"></i></span><?php echo lang('Reset'); ?></a>
                    <button class="btn pull-right " type="submit"><span class="btn-label-icon left"><i class="fa fa-filter"></i></span><?php echo lang('Filters'); ?></button>
                </div>
            </div>
        </div>
    </form>
<?php } ?>
<?php
$factors = Orm_Survey_Question_Factor::get_all(array('survey_id' => $survey->get_id()));
?>
<div class="table-primary">
    <div class="table-header">
        <div class="table-caption">
            <?php echo htmlfilter($survey->get_title()); ?>
        </div>

    </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th class="col-md-1"><b><?php echo lang('Abbreviation'); ?></b></th>
            <th class="col-md-6"><b><?php echo lang('Title'); ?></b></th>
            <th class="col-md-1 text-center"><?php echo lang('Strongly Disagree (SD)'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Disagree (D)'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Neutral (N)'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Agree (A)'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Strongly Agree (SA)'); ?></th>
        </tr>
        </thead>
        <?php
        $sa = 0; $a = 0; $n = 0; $d = 0; $sd = 0;
        foreach ($factors as $factor) { ?>
            <?php
            $factor_response = $factor->get_detail_user_response($filters);
            $sa += $factor_response['SA'];
            $a  += $factor_response['A'];
            $n  += $factor_response['N'];
            $d  += $factor_response['D'];
            $sd += $factor_response['SD'];
            ?>
            <tr>
                <td><b><?php echo htmlfilter($factor->get_abbreviation()); ?></b></td>
                <td><b><?php echo htmlfilter($factor->get_report_title()); ?></b></td>
                <td class="text-right"><?php echo number_format($factor_response['SD'],0); ?></td>
                <td class="text-right"><?php echo number_format($factor_response['D'],0); ?></td>
                <td class="text-right"><?php echo number_format($factor_response['N'],0); ?></td>
                <td class="text-right"><?php echo number_format($factor_response['A'],0); ?></td>
                <td class="text-right"><?php echo number_format($factor_response['SA'],0); ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2"><b><?php echo lang('Evaluation Overall'); ?></b></td>
            <td class="text-right text-bold"><?php echo number_format((count($factors) ? $sd / count($factors) : 0),0); ?></td>
            <td class="text-right text-bold"><?php echo number_format((count($factors) ? $d  / count($factors) : 0),0); ?></td>
            <td class="text-right text-bold"><?php echo number_format((count($factors) ? $n  / count($factors) : 0),0); ?></td>
            <td class="text-right text-bold"><?php echo number_format((count($factors) ? $a  / count($factors) : 0),0); ?></td>
            <td class="text-right text-bold"><?php echo number_format((count($factors) ? $sa / count($factors) : 0),0); ?></td>
        </tr>
    </table>
    <div class="table-footer">
        <div id="survey-chart" style="width: 100%; height: 300px;"></div>
        <script type="text/javascript">

            if (typeof google.visualization === 'undefined') {
                google.load('visualization', '1', {'packages':['corechart']});
                google.setOnLoadCallback(drawChart);
            } else {
                drawChart();
            }

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                    ['Option', '# of Responses'],
                    ['<?php echo lang('Strongly Disagree (SD)'); ?>', <?php echo $sd; ?>],
                    ['<?php echo lang('Disagree (D)'); ?>', <?php echo $d; ?>],
                    ['<?php echo lang('Neutral (N)'); ?>', <?php echo $n; ?>],
                    ['<?php echo lang('Agree (A)'); ?>', <?php echo $a; ?>],
                    ['<?php echo lang('Strongly Agree (SA)'); ?>', <?php echo $sa;?>]
                ]);

                var options = {
                    title: '<?php echo htmlfilter($survey->get_title()); ?>',
                    is3D: true,
                    pieSliceText: 'Option',
                    fontSize: 12,
                    sliceVisibilityThreshold: 0

                };

                var chart = new google.visualization.PieChart(document.getElementById('survey-chart'));

                chart.draw(data, options);
            }
        </script>
        <script>drawChart();window.onresize = function(){drawChart();};</script>
    </div>
</div>