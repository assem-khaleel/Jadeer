<?php
/**
 * Created by PhpStorm.
 * User: abdelqader osama
 * Date: 11/4/17
 * Time: 1:24 PM
 *
 * @var $assessment_loop Orm_Al_Assessment_Loop
 *
 */
?>
<div class="row form-group">
    <label for="type" class="col-sm-3 control-label"><?php echo lang('Learning Domain Types'); ?></label>
    <div class="col-sm-9">
        <select name="type_id" id="type_id" class="form-control" onchange="get_domains(this);">
            <option value="0"> <?php echo lang('Select One')?></option>
            <?php foreach (Orm_Learning_Domain_Type::get_all() as $type) { ?>
                <?php $selected = ($type->get_id() == $assessment_loop->get_type_id() ? 'selected="selected"' : ''); ?>
                <option value="<?php echo $type->get_id(); ?>" <?php echo $selected; ?> ><?php echo $type->get_name(); ?></option>
            <?php } ?>
        </select>
        <?php echo Validator::get_html_error_message('type_id'); ?>
    </div>
</div>
<div class="row form-group">
    <label class="col-sm-3 control-label"><?php echo lang('Learning Domain'); ?></label>
    <div class="col-sm-9">
        <select id ="domain_block_wizard" name="extra_data[learning_domain]" class="form-control" onchange="select_plos();">
            <option value="-1"><?php echo lang('Select One'); ?></option>
            <?php
            foreach(Orm_Cm_Learning_Domain::get_all() as $domain) {
                $selected = (!is_null($assessment_loop->get_item_from_extra_data('learning_domain')) && $domain->get_id() == $assessment_loop->get_item_from_extra_data('learning_domain')) ? 'selected="selected"' : '';
                ?>
                <option value="<?php echo $domain->get_id() ?>" <?php echo $selected ?> ><?php echo $domain->get_title() ?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="table-primary m-a-0">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('PLO Result') ?></span>
    </div>
    <table class="table table-striped m-a-0" id="plos_result">
        <?php echo $assessment_loop->ajax() ; ?>
    </table>
</div>

<script>

    function get_domains(element, option_only) {

        var loading = '<i class="fa fa-spinner fa-spin"></i> Loading';
        if (option_only) {
            loading = '<option value="">Loading ...</option>';
        }

        $('#domain_block_wizard').html(loading);

        $.ajax({
            type: "POST",
            url: "/assessment_loop/assessment_loop/get_domain",
            data: {
                type_id: $(element).val(),
                option_only: option_only,
            }
        }).done(function (msg) {
            $('#domain_block_wizard').html(msg);
        }).fail(function () {
            window.location.reload();
        });
    }

    function select_plos() {
        $.ajax({
            type: "POST",
            url: '/assessment_loop/ajax',
            data: $('#assessment-loop-form').serialize(),
        }).done(function (html) {
            $('#plos_result').html(html);
        });
    }
</script>