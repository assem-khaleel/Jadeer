<?php

/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 8/9/15
 * Time: 2:20 PM
 */
/* @var $survey Orm_Survey */
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
            $query_string .= '&fltr[summary]=1';
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
            <th class="col-md-9"><b><?php echo lang('Title'); ?></b></th>
            <th class="col-md-1 text-center"><?php echo lang('Average'); ?></th>
            <th class="col-md-1 text-center"><?php echo lang('Response'); ?></th>
        </tr>
        </thead>
        <?php foreach ($factors as $factor) { ?>
            <?php
            $factor_response = $factor->get_user_response($filters);
            $overall += isset($factor_response['average']) ? round($factor_response['average'], 2) : 0;
            $max_response = isset($factor_response['count']) && $factor_response['count'] > $max_response ? $factor_response['count'] : $max_response;
            ?>
            <tr>
                <td class="col-md-1"><b><?php echo htmlfilter($factor->get_abbreviation()); ?></b></td>
                <td class="col-md-9"><b><?php echo htmlfilter($factor->get_report_title()); ?></b></td>
                <td class="col-md-1 text-center"><?php echo isset($factor_response['average']) ? round($factor_response['average'], 2) : 0 ?>
                    / 5
                </td>
                <td class="col-md-1 text-center"><?php echo isset($factor_response['count']) ? $factor_response['count'] : 0 ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td class="col-md-10" colspan="2"><b><?php echo lang('Evaluation Overall'); ?></b></td>
            <td class="col-md-1 text-center"><?php echo count($factors) ? round($overall / count($factors), 2) : 0 ?> /
                5
            </td>
            <td class="col-md-1 text-center"><?php echo $max_response; ?></td>
        </tr>
    </table>
</div>