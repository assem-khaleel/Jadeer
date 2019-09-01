<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 4/8/16
 * Time: 7:47 PM
 */
/** @var Orm_Survey $survey */
/** @var Orm_Survey_Evaluator[] $items */
/** @var string $pager */

$statements = Orm_Survey_Question_Statement::get_all(array('survey_id' => $survey->get_id()));

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

<div class="panel">
    <div class="panel-heading">
        <div class="panel-title">
            <?php echo htmlfilter($survey->get_title()); ?>
        </div>
    </div>

    <div class="panel-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th><b><?php echo lang('Abbreviation'); ?></b></th>
                <th><b><?php echo lang('Question'); ?></b></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($statements as $statement) { ?>
                <tr>
                    <td><?php echo htmlfilter($statement->get_abbreviation()); ?></td>
                    <td><?php echo htmlfilter($statement->get_title()); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><b><?php echo lang('Evaluator'); ?></b></th>
                    <?php foreach ($statements as $statement) { ?>
                        <th><?php echo htmlfilter($statement->get_abbreviation()) ?></th>
                    <?php } ?>
                </tr>
                </thead>
                <?php foreach ($items as $item) { ?>
                    <tr>
                        <td><b><?php echo htmlfilter($item->get_user_obj()->get_full_name()); ?></b></td>
                        <?php foreach ($statements as $statement) { ?>
                            <th><?php echo Orm_Survey_User_Response_Factor::get_one(array('survey_evaluator_id' => $item->get_id(),'statement_id' => $statement->get_id()))->get_rank(); ?></th>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <?php if(empty($items)) { ?>
                    <tr>
                        <td colspan="<?php echo (1 + count($statements)) ?>">
                            <div class="alert m-a-0">
                                <?php echo  lang("There is no").' '.lang('Data to be displayed.')?>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

    <?php if($pager) { ?>
        <div class="panel-footer">
            <?php echo $pager; ?>
        </div>
    <?php } ?>
</div>