<?php
/**
 * Created by PhpStorm.
 * User: MAZEN
 * Date: 6/29/15
 * Time: 12:04 PM
 */
/** @var Orm_Kpi_Legend[] $parameters */
/** @var Orm_Kpi $kpi */
$surveys = Orm_Survey::get_all();
?>
<style>
    .jstree-anchor {
        /*enable wrapping*/
        white-space : normal !important;
        /*ensure lower nodes move down*/
        height : auto !important;
        /*offset icon width*/
        padding-right : 24px;
    }
</style>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('/kpi/save_step_2', 'id="kpi-form"') ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($kpi->get_id())) {
                echo lang('Create').' '.lang('Qualitative KPI');
            } else {
                echo lang('Edit').' '.lang('Qualitative KPI');
            }
            ?>
        </div>
            <div class="modal-body">
                <div id="kpi-survey">
                    <ul>
                        <?php foreach ($surveys as $survey) { ?>
                            <li id="s_<?php echo intval($survey->get_id()); ?>"><?php echo trim(htmlfilter($survey->get_title())); ?>
                                <ul>
                                    <?php foreach (Orm_Survey_Question_Factor::get_all(array('survey_id' => $survey->get_id())) as $factor) { ?>
                                        <li id="f_<?php echo intval($factor->get_id()); ?>"><?php echo trim(htmlfilter($factor->get_title())); ?>
                                            <ul>
                                                <?php foreach (Orm_Survey_Question_Statement::get_all(array('factor_id' => $factor->get_id())) as $statement) { ?>
                                                    <li <?php echo(Orm_Kpi_Survey::get_one(array('kpi_id' => $kpi->get_id(), 'survey_id' => $survey->get_id(), 'factor_id' => $factor->get_id(), 'statement_id' => $statement->get_id()))->get_id() ? 'data-checkstate="checked"' : ''); ?>
                                                            id="s_<?php echo intval($survey->get_id()); ?>_f_<?php echo intval($factor->get_id()); ?>_st_<?php echo intval($statement->get_id()); ?>"><?php echo trim(htmlfilter($statement->get_title())); ?></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="<?php echo htmlfilter($kpi->get_id()); ?>">
                <input type="hidden" name="selected_items" value="" id="selected_items">
                <button type="button" class="btn btn-sm pull-left "
                        data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?></button>
            </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();

    $(function () {
        var $_tree = $("#kpi-survey");
        $_tree.jstree({
            'plugins': ["checkbox"],
            'core': {
                'themes': {
                    'name': 'proton',
                    'responsive': true,
                    icons: false
                }
            }
        });

        $_tree.jstree(true).open_all();
        $('li[data-checkstate="checked"]').each(function () {
            $_tree.jstree('check_node', $(this));
        });
        $_tree.jstree(true).close_all();
    });

    $('form#kpi-form').submit(function (event) {
        event.preventDefault();
        $('#selected_items').val(JSON.stringify($('#kpi-survey').jstree("get_selected")));
        $.ajax({
            url: '/kpi/save_step_2',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error == false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
    function after_delete_action(element, msg) {
        if (msg.error == 0) {
            element.remove();
        }
    }
</script>