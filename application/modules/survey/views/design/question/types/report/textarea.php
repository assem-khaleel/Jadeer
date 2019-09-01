<?php
/* @var $question Orm_Tst_Question_Type_Textarea */
$filters['not_empty'] = true;
$responses = $question->get_user_response($filters);
$survey = !isset($survey) ? $filters['survey'] : $survey;
?>
<div class="table-light">
    <div class="table-header">
        <div class="table-caption">
            <?php echo lang('Comment/Essay Box'); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-1 text-center">#</th>
                <th class="col-md-11"><?php echo lang('Response'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $index = 0;
            foreach ($responses as $response) {
                $index++;
                ?>
                <tr>
                    <td class="col-md-1 text-center"><?php echo $index; ?></td>
                    <td class="col-md-11"><?php echo nl2br(htmlfilter($response->get_value())); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if (count($responses) == Orm_Survey_Question_Type_Textarea::NUMBER_OF_RESPONSE) { ?>
        <div class="table-footer">
            <a href="/survey/report/comments/<?php echo intval($question->get_id()); ?>?survey_id=<?php echo intval($survey->get_id()); ?>"
               class="link"><?php echo lang('More Response'); ?></a>
        </div>
    <?php } ?>
</div>