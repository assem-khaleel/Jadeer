<?php
/* @var $survey Orm_Survey */
$order = 0;
?>
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

                        <?php echo $question->draw_question(); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>