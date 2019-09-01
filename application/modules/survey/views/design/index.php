<?php
/* @var $survey Orm_Survey */
?>
<div>
    <div class="col-md-4 col-md-offset-4" style="margin-bottom: 20px;">

        <a href="javascript:;" onclick="move_page_here('0', '<?php echo htmlfilter($survey->get_id()); ?>');"
           class="move_page_here btn  col-md-6"><span
                class="btn-label-icon left icon fa fa-paste"></span> <?php echo lang('Move Here') ?></a>
        <a href="javascript:;" onclick="cancel_move_page();" class="move_page_here btn  col-md-6"><span
                class="btn-label-icon left icon fa fa-undo"></span> <?php echo lang('Cancel Move') ?></a>

        <a href="javascript:;" onclick="paste_page_here('0', '<?php echo htmlfilter($survey->get_id()); ?>');"
           class="paste_page_here btn  col-md-6"><span
                class="btn-label-icon left icon fa fa-paste"></span> <?php echo lang('Paste Here') ?></a>
        <a href="javascript:;" onclick="cancel_copy_page();"
           class="paste_page_here btn  col-md-6"><span
                class="btn-label-icon left icon fa fa-undo"></span> <?php echo lang('Cancel Copy') ?></a>

        <a class="btn  col-md-6 col-md-offset-3 hide_add_page_when_move_or_paste"
           href="/survey/design/page_add?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"><span
                class="btn-label-icon left icon fa fa-plus"></span> <?php echo lang('Add').' '.lang('Page') ?></a>
    </div>
    <div class="clearfix"></div>

    <?php
    $pages = $survey->get_pages();
    $pages_count = count($pages);
    $order = 0;
    ?>
    <?php foreach ($pages as $page): ?>
        <div id="page_<?php echo $page->get_order(); ?>" class="panel panel-primary">

            <div class="panel-heading">
                <div class="col-md-7">
                    <label
                        class="label label-default m-a-0"><?php echo lang('Page') . ' ' . $page->get_order(); ?></label> <?php echo htmlfilter($page->get_title()) ?>
                </div>
                <div class="col-md-5 text-right">
                    <?php if ($pages_count > 1): ?>
                        <a class="btn btn-sm" href="javascript:;"
                           onclick="move_page('<?php echo htmlfilter($page->get_id()); ?>');"><span
                                class="btn-label-icon left icon fa fa-cut"></span> <?php echo lang('Move') ?></a>
                    <?php endif; ?>
                    <a class="btn btn-sm" href="javascript:;"
                       onclick="copy_page('<?php echo htmlfilter($page->get_id()); ?>');"><span
                            class="btn-label-icon left icon fa fa-copy"></span> <?php echo lang('Copy') ?></a>
                    <a class="btn btn-sm"
                       href="/survey/design/page_edit/<?php echo htmlfilter($page->get_id()); ?>?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"
                       data-toggle="ajaxModal"><span
                            class="btn-label-icon left icon fa fa-edit"></span> <?php echo lang('Edit') ?></a>
                    <?php if ($pages_count > 1): ?>
                        <a class="btn btn-sm"
                           href="/survey/design/page_delete/<?php echo htmlfilter($page->get_id()); ?>?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"><span
                                class="btn-label-icon left icon fa fa-trash-o"></span> <?php echo lang('Delete') ?></a>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="panel-body">

                <?php if ($page->get_description()) { ?>
                    <div class="well well-sm">
                        <?php echo xssfilter($page->get_description()); ?>
                    </div>
                <?php } ?>

                <div class="col-md-4 col-md-offset-4" style="margin-bottom: 15px;">
                    <a href="javascript:;"
                       onclick="move_question_here('0', '<?php echo htmlfilter($page->get_id()); ?>');"
                       class="move_question_here btn col-md-6"><span
                            class="btn-label-icon left icon fa fa-paste"></span> <?php echo lang('Move Here') ?></a>
                    <a href="javascript:;" onclick="cancel_move_question();"
                       class="move_question_here btn col-md-6"><span
                            class="btn-label-icon left icon fa fa-undo"></span> <?php echo lang('Cancel Move') ?></a>

                    <a href="javascript:;"
                       onclick="paste_question_here('0', '<?php echo htmlfilter($page->get_id()); ?>');"
                       class="paste_question_here btn col-md-6"><span
                            class="btn-label-icon left icon fa fa-paste"></span> <?php echo lang('Paste Here') ?></a>
                    <a href="javascript:;" onclick="cancel_copy_question();"
                       class="paste_question_here btn col-md-6"><span
                            class="btn-label-icon left icon fa fa-undo"></span> <?php echo lang('Cancel Copy') ?></a>

                    <div class="hide_add_question_when_move_or_paste">
                        <a href="/survey/design/question_add/<?php echo htmlfilter($page->get_id()); ?>?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"
                           class="btn  col-md-12" data-toggle="ajaxModal"><span
                                class="btn-label-icon left icon fa fa-plus"></span> <?php echo lang('Add').' '.lang('Question') ?></a>
                    </div>
                </div>
                <div class="clearfix"></div>

                <?php
                $questions = $page->get_questions();
                $questions_count = count($questions);
                ?>
                <?php foreach ($questions as $question): ?>
                    <?php $order++; ?>
                    <div id="question_<?php echo $page->get_order() . '_' . $question->get_order(); ?>"
                         class="panel panel-default">
                        <div class="panel-heading">
                            <div class="col-md-7">
                                <label
                                    class="label label-default m-a-0"><?php echo lang('Q') . ' ' . $order; //$question->get_order(); ?></label> <?php echo nl2br(htmlfilter($question->get_question())); ?>
                            </div>
                            <div class="col-md-5 text-right">
                                <a class="btn btn-sm" href="javascript:;"
                                   onclick="move_question('<?php echo htmlfilter($question->get_id()); ?>');"><span
                                        class="btn-label-icon left icon fa fa-cut"></span> <?php echo lang('Move') ?></a>
                                <a class="btn btn-sm" href="javascript:;"
                                   onclick="copy_question('<?php echo htmlfilter($question->get_id()); ?>');"><span
                                        class="btn-label-icon left icon fa fa-copy"></span> <?php echo lang('Copy') ?></a>
                                <a class="btn btn-sm"
                                   href="/survey/design/question_edit/<?php echo htmlfilter($question->get_id()); ?>?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"
                                   data-toggle="ajaxModal"><span
                                        class="btn-label-icon left icon fa fa-edit"></span> <?php echo lang('Edit') ?></a>
                                <a class="btn btn-sm"
                                   href="/survey/design/question_delete/<?php echo htmlfilter($question->get_id()); ?>?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"><span
                                        class="btn-label-icon left icon fa fa-trash-o"></span> <?php echo lang('Delete') ?></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                            <div class="clearfix form-group">
                                <a class="btn btn-sm pull-right"
                                   href="/survey/design/question_note/<?php echo htmlfilter($question->get_id()); ?>?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"
                                   data-toggle="ajaxModal"><span
                                        class="btn-label-icon left icon fa fa-edit"></span> <?php echo lang('Note') ?></a>
                            </div>

                            <?php if ($question->get_description()) { ?>
                                <div class="well well-sm">
                                    <?php echo xssfilter($question->get_description()); ?>
                                </div>
                            <?php } ?>

                            <?php echo $question->draw_question(); ?>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-4" style="margin-bottom: 15px;">
                        <a href="javascript:;"
                           onclick="move_question_here('<?php echo htmlfilter($question->get_id()); ?>');"
                           class="move_question_here btn col-md-6"><span
                                class="btn-label-icon left icon fa fa-paste"></span> <?php echo lang('Move Here') ?></a>
                        <a href="javascript:;" onclick="cancel_move_question();"
                           class="move_question_here btn col-md-6"><span
                                class="btn-label-icon left icon fa fa-undo"></span> <?php echo lang('Cancel Move') ?></a>

                        <a href="javascript:;"
                           onclick="paste_question_here('<?php echo htmlfilter($question->get_id()); ?>');"
                           class="paste_question_here btn col-md-6"><span
                                class="btn-label-icon left icon fa fa-paste"></span> <?php echo lang('Paste Here') ?></a>
                        <a href="javascript:;" onclick="cancel_copy_question();"
                           class="paste_question_here btn col-md-6"><span
                                class="btn-label-icon left icon fa fa-undo"></span> <?php echo lang('Cancel Copy') ?></a>

                        <div class="hide_add_question_when_move_or_paste">
                            <?php if ($questions_count > 1 && $question->get_order() != $questions_count): ?>
                                <a href="/survey/design/page_split_here/<?php echo htmlfilter($question->get_id()); ?>?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"
                                   class="btn col-md-6"><span
                                        class="btn-label-icon left icon fa fa-unlink"></span> <?php echo lang('Split Page Here') ?>
                                </a>
                            <?php endif; ?>
                            <a href="/survey/design/question_add/<?php echo htmlfilter($page->get_id() . '/' . ($question->get_order() + 1)); ?>?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"
                               class="btn  <?php if ($questions_count > 1 && $question->get_order() != $questions_count): ?>col-md-6<?php else : ?>col-md-12<?php endif; ?>"
                               data-toggle="ajaxModal"><span
                                    class="btn-label-icon left icon fa fa-plus"></span> <?php echo lang('Add').' '.lang('Question') ?></a>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-4 col-md-offset-4" style="margin-bottom: 20px;">
            <a href="javascript:;" onclick="move_page_here('<?php echo htmlfilter($page->get_id()); ?>');"
               class="move_page_here btn col-md-6"><span
                    class="btn-label-icon left icon fa fa-paste"></span> <?php echo lang('Move Here') ?></a>
            <a href="javascript:;" onclick="cancel_move_page();"
               class="move_page_here btn col-md-6"><span
                    class="btn-label-icon left icon fa fa-undo"></span> <?php echo lang('Cancel Move') ?></a>

            <a href="javascript:;" onclick="paste_page_here('<?php echo htmlfilter($page->get_id()); ?>');"
               class="paste_page_here btn col-md-6"><span
                    class="btn-label-icon left icon fa fa-paste"></span> <?php echo lang('Paste Here') ?></a>
            <a href="javascript:;" onclick="cancel_copy_page();"
               class="paste_page_here btn col-md-6"><span
                    class="btn-label-icon left icon fa fa-undo"></span> <?php echo lang('Cancel Copy') ?></a>

            <a class="btn  col-md-6 col-md-offset-3 hide_add_page_when_move_or_paste"
               href="/survey/design/page_add/<?php echo htmlfilter($page->get_id()); ?>?survey_id=<?php echo htmlfilter($survey->get_id()); ?>"><span
                    class="btn-label-icon left icon fa fa-plus"></span> <?php echo lang('Add').' '.lang('Page') ?></a>
        </div>
        <div class="clearfix"></div>
    <?php endforeach; ?>
</div>

<script type="text/javascript">
    $('.paste_page_here').hide();
    $('.move_page_here').hide();
    $('.move_question_here').hide();
    $('.paste_question_here').hide();

    /*
     *################
     * move_question #
     *################
     */
    var from_question_id;
    function move_question(question_id) {
        from_question_id = question_id;
        $('.move_question_here').show();

        copy_question_id = '';
        $('.paste_question_here').hide();
        $('.hide_add_question_when_move_or_paste').hide();

        cancel_move_page();
        cancel_copy_page();
    }

    function move_question_here(here_question_id, page_id) {

        page_id = typeof (page_id) != 'undefined' ? '/' + page_id : '';

        $('.move_question_here').hide();
        $('.hide_add_question_when_move_or_paste').show();

        window.location = '/survey/design/question_move/' + from_question_id + '/' + here_question_id + page_id + '?survey_id=<?php echo htmlfilter($survey->get_id()); ?>';
    }

    function cancel_move_question() {
        from_question_id = '';
        $('.move_question_here').hide();
        $('.hide_add_question_when_move_or_paste').show();
    }


    /*
     *################
     * copy_question #
     *################
     */
    var copy_question_id;
    function copy_question(question_id) {
        copy_question_id = question_id;
        $('.paste_question_here').show();

        from_question_id = '';
        $('.move_question_here').hide();
        $('.hide_add_question_when_move_or_paste').hide();

        cancel_move_page();
        cancel_copy_page();
    }

    function paste_question_here(paste_question_id, page_id) {

        page_id = typeof (page_id) != 'undefined' ? '/' + page_id : '';

        $('.paste_question_here').hide();
        $('.hide_add_question_when_move_or_paste').show();

        window.location = '/survey/design/question_copy/' + copy_question_id + '/' + paste_question_id + page_id + '?survey_id=<?php echo htmlfilter($survey->get_id()); ?>';
    }

    function cancel_copy_question() {
        copy_question_id = '';
        $('.paste_question_here').hide();
        $('.hide_add_question_when_move_or_paste').show();
    }

    /*
     *############
     * move_page #
     *############
     */
    var from_page_id;
    function move_page(page_id) {
        from_page_id = page_id;
        $('.move_page_here').show();

        copy_page_id = '';
        $('.paste_page_here').hide();
        $('.hide_add_page_when_move_or_paste').hide();

        cancel_move_question();
        cancel_copy_question();
    }

    function move_page_here(here_page_id, page_id) {

        page_id = typeof (page_id) != 'undefined' ? '/' + page_id : '';

        $('.move_page_here').hide();
        $('.hide_add_page_when_move_or_paste').show();

        window.location = '/survey/design/page_move/' + from_page_id + '/' + here_page_id + page_id + '?survey_id=<?php echo htmlfilter($survey->get_id()); ?>';
    }

    function cancel_move_page() {
        from_page_id = '';
        $('.move_page_here').hide();
        $('.hide_add_page_when_move_or_paste').show();
    }

    /*
     *############
     * copy_page #
     *############
     */
    var copy_page_id;
    function copy_page(page_id) {
        copy_page_id = page_id;
        $('.paste_page_here').show();

        from_page_id = '';
        $('.move_page_here').hide();
        $('.hide_add_page_when_move_or_paste').hide();

        cancel_move_question();
        cancel_copy_question();
    }

    function paste_page_here(paste_page_id, page_id) {

        page_id = typeof (page_id) != 'undefined' ? '/' + page_id : '';

        $('.paste_page_here').hide();
        $('.hide_add_page_when_move_or_paste').show();

        window.location = '/survey/design/page_copy/' + copy_page_id + '/' + paste_page_id + page_id + '?survey_id=<?php echo htmlfilter($survey->get_id()); ?>';
    }

    function cancel_copy_page() {
        copy_page_id = '';
        $('.paste_page_here').hide();
        $('.hide_add_page_when_move_or_paste').show();
    }
</script>