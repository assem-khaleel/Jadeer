<?php
/**
 * @var Orm_Survey_Evaluator $evaluator
 * @var Orm_Survey_Evaluation $evaluation
 * @var Orm_Survey $survey
 * @var Orm_User $user
 */

$pages = $survey->get_pages();
?>
<!-- Javascript -->
<script>
    pxInit.push(function () {
        $('#wizard-forms').pxWizard({
            onFinish: function () {
                // Disable changing step. To enable changing step just call this.unfreeze()
                this.freeze();
            }
        });
        $('#wizard-forms .wizard-prev-step-btn').on('click', function () {
            $('#wizard-forms').pxWizard('goPrev');
            return false;
        });

        // Pages

        <?php
        foreach ($pages as $page) {
        echo $page->get_js_validator();
        ?>
        $('#wizard-<?php echo $page->get_order(); ?>').on('submit', function () {
            if ($(this).valid()) {
                $('#wizard-forms').pxWizard('goNext');
            }
            return false;
        });
        <?php } ?>

        // Finish page

        $('#wizard-finish button.finish').click(finish);

        $('#wizard-finish button.wizard-prev-step-btn').click(back_on_finish);

    });

    function finish() {

        var $button = $(this);

        var data = '';
        $('.wizard-content form').each(function () {
            if (data) {
                data += '&';
            }
            data += $(this).serialize();
        });

        $.ajax({
            type: "POST",
            url: "/survey/respond/save?token=<?php echo htmlfilter($evaluator->get_hash_code());?>",
            data: data,
            dataType: "json"
        }).done(function (msg) {
            if (msg.success) {
                $('#wizard-finish').html(
                    '<i class="fa fa-check-circle font-size-52 m-y-2 text-success text-slg"></i><br>' +
                    '<span class="text-lg text-slim text-muted"><?php echo lang("THANK YOU!") ?></span>'
                );

                $('#wizard-forms').pxWizard('goNext');
                return false;
            } else {
                $('#wizard-finish').html(
                    '<i class="fa fa-exclamation-triangle font-size-52 m-y-2 text-danger text-slg"></i><br>' +
                    '<span class="text-lg text-slim text-muted"><?php echo lang("SOMETHING WENT WRONG!") ?></span>' +
                    '<button type="button" style="margin: 25px auto;display: block;" class="btn wizard-prev-step-btn"><?php echo lang('Go back') ?></button>'
                );

                $('#wizard-finish button.wizard-prev-step-btn').click(back_on_finish);
                return false;
            }
        }).fail(function () {
            window.location.reload();
        });

    }

    function back_on_finish() {
        $('#wizard-forms').pxWizard('goPrev');

        $('#wizard-finish').html(
            '<i class="fa fa-check font-size-52 m-y-2 text-warning text-slg"></i><br>' +
            '<span class="text-lg text-slim text-muted"><?php echo str_replace("'", "\'", lang("WE'VE ALMOST DONE!")) ?></span>' +
            '<div style="margin: 25px auto;">' +
            '    <button class="btn finish" <?php echo data_loading_text(true) ?>><?php echo lang('Finish') ?></button>' +
            '    <button class="btn wizard-prev-step-btn"><?php echo lang('Go back') ?></button>' +
            '</div>'
        );

        $('#wizard-finish button.finish').click(finish);
        $('#wizard-finish button.wizard-prev-step-btn').click(back_on_finish);

        return false;
    }

</script>
<!-- / Javascript -->
<div class="panel">
    <div class="panel-heading">
        <h3 class="text-default text-center"><?php echo htmlfilter($survey->get_title()); ?></h3>

        <div class="box p-a-1">
            <h4 class="m-t-0"><?php echo lang('Demographics'); ?></h4>

            <div class="row">
                <label class="col-sm-3"><?php echo lang('Evaluation') ?></label>
                <div class="col-sm-9">
                    <?php echo  htmlfilter($evaluation->get_description()) ?>
                </div>
            </div>

            <?php echo $user->draw_demographics(); ?>
        </div>
    </div>
    <div class="panel-body">
        <div class="wizard m-a-0" id="wizard-forms">
            <!-- Steps -->
            <div class="wizard-wrapper no-border">
                <ul class="wizard-steps">
                    <?php
                    foreach ($pages as $page) {
                        ?>
                        <li data-target="#wizard-<?php echo $page->get_order(); ?>">
                            <span class="wizard-step-number"><?php echo $page->get_order(); ?></span>
                            <span class="wizard-step-complete"><i class="fa fa-check text-success"></i></span>
                            <span class="wizard-step-caption">
                                <?php echo htmlfilter($page->get_title()); ?>
                            </span>
                        </li>
                    <?php } ?>
                    <li data-target="#wizard-finish"> <!-- ! Remove space between elements by dropping close angle -->
                        <span class="wizard-step-number"><?php echo(count($pages) + 1); ?></span>
                        <span class="wizard-step-caption">
                            <?php echo lang('Finish') ?>
                        </span>
                    </li>
                </ul>
                <!-- / .wizard-steps -->
            </div>
            <!-- / .wizard-wrapper -->
            <!-- / Steps -->

            <!-- Pages -->
            <div class="wizard-content panel m-a-0 b-x-0 b-b-0 p-b-0">
                <?php
                $order = 0;
                foreach ($pages as $page) {
                    ?>
                    <?php echo form_open('', 'class="wizard-pane" id="wizard-' . $page->get_order() . '"') ?>

                        <?php if ($page->get_description()) { ?>
                            <div class="well well-sm">
                                <?php echo xssfilter($page->get_description()); ?>
                            </div>
                        <?php } ?>

                        <?php
                        foreach ($page->get_questions() as $question) {
                            $order++;
                            ?>
                            <div class="panel panel-primary m-a-0">
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

                        <div class="pull-right m-t-2">
                            <?php if ($page->get_order() != 1) { ?>
                                <button type="button" class="btn wizard-prev-step-btn"><?php echo lang('Go back') ?></button>
                            <?php } ?>
                            <button type="submit" class="btn "><?php echo lang('Next step') ?></button>
                        </div>
                    <?php echo form_close() ?>
                <?php } ?>

                <!-- Finish page -->
                <div class="wizard-pane text-center panel-padding" id="wizard-finish">
                    <i class="fa fa-check font-size-52 m-y-2 text-warning text-slg"></i><br>
                    <span class="text-lg text-slim text-muted"><?php echo lang("WE'VE ALMOST DONE!") ?></span>

                    <div style="margin: 25px auto;">
                        <button class="btn finish"
                                <?php echo data_loading_text() ?>><?php echo lang('Finish') ?></button>
                        <button class="btn wizard-prev-step-btn"><?php echo lang('Go back') ?></button>
                    </div>
                </div>
                <!-- / .wizard-pane -->
                <!-- / Finish page -->
            </div>
            <!-- / .wizard-content -->
            <!-- / Pages -->

        </div>
        <!-- / .wizard -->
    </div>
</div>