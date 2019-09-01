<?php
/* @var $survey Orm_Survey */
?>

<?php if (!empty($filters['evaluation_id'])) { ?>
    <?php $evaluation = Orm_Survey_Evaluation::get_instance($filters['evaluation_id']); ?>
    <div class="row">
        <label class="col-sm-3"><?php echo lang('Description') ?></label>

        <div class="col-sm-9">
            <div class="well well-sm"><?php echo htmlfilter($evaluation->get_description()) ?></div>
        </div>
    </div>

    <hr class="page-block m-t-0">
<?php } ?>

<?php
if (!empty($draw_filters)) {
    ?>
    <div class="box p-a-1 clearfix">
        <?php if($survey->get_type(true)) { ?>
            <div class="pull-left">
                <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>"
                        type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false"
                        aria-controls="filters">
                    <span class="fa fa-filter"></span>
                </button>
                <?php echo lang($survey->get_type(true)) ?>
            </div>
        <?php } ?>

        <?php
        $url = $this->input->server('REQUEST_URI');
        $explode_url = explode('?', $url);
        $query_string = empty($explode_url[1]) ? '' : ('?' . $explode_url[1]);
        $query_string .= '&fltr[summary]=0';
        $query_string .= !empty($filters['evaluation_id']) ? '&fltr[evaluation_id]=' . $filters['evaluation_id'] : '';
        ?>

        <div class="pull-right">
            <a class="btn btn-sm " href="/survey/report/pdf<?php echo($query_string); ?>">
                <span class="btn-label-icon left icon fa fa-file-pdf-o"></span> <?php echo lang('PDF'); ?>
            </a>
            <a class="btn btn-sm " href="/survey/report/csv<?php echo($query_string); ?>">
                <span class="btn-label-icon left icon fa fa-file-excel-o"></span> <?php echo lang('CSV'); ?>
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
                    <a class="btn pull-left"
                       href="<?php echo preg_replace('/(.*)\?(.*)/', '$1?survey_id=' . intval($survey->get_id()), $this->input->server('REQUEST_URI')) ?>"><span class="btn-label-icon left"><i class="fa fa-recycle"></i></span><?php echo lang('Reset'); ?></a>
                    <button class="btn pull-right " type="submit"><span class="btn-label-icon left"><i class="fa fa-filter"></i></span><?php echo lang('Filters'); ?></button>
                </div>
            </div>
        </div>
    </form>
<?php } ?>

<?php $order = 0; ?>

<?php foreach ($survey->get_pages() as $page) { ?>
    <div id="page_<?php echo $page->get_order(); ?>" class="panel panel-primary">

        <div class="panel-heading">
            <label
                class="label label-default m-a-0"><?php echo lang('Page') . ' ' . $page->get_order(); ?></label> <?php echo htmlfilter($page->get_title()) ?>
        </div>

        <div class="panel-body">

            <?php if ($page->get_description()) { ?>
                <div class="well well-sm">
                    <?php echo xssfilter($page->get_description()); ?>
                </div>
            <?php } ?>

            <?php
            $questions = $page->get_questions();
            $questions_count = count($questions);
            ?>
            <?php foreach ($questions as $question) { $order++; ?>
                <div id="question_<?php echo $page->get_order() . '_' . $question->get_order(); ?>"
                     class="panel panel-primary">
                    <div class="panel-heading">
                        <label
                            class="label label-default m-a-0"><?php echo lang('Q') . ' ' . $order; //$question->get_order(); ?></label> <?php echo nl2br(htmlfilter($question->get_question())); ?>
                    </div>
                    <div class="panel-body">

                        <?php if ($question->get_description()) { ?>
                            <div class="well well-sm">
                                <?php echo xssfilter($question->get_description()); ?>
                            </div>
                        <?php } ?>

                        <?php echo $question->draw_report($filters); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>