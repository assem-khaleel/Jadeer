<?php
/* @var $unit Orm_Unit */
?>
<div class="col-md-9 col-lg-10">
    <div class="well">
        <?php echo form_open("/unit/save"); ?>
        <div class="form-group">
            <label class="control-label" for="type"> <?php echo lang('Unit Type'); ?></label>
            <select name="type" id="type" class="form-control" onchange="type_changed()">
                <?php foreach (Orm_Unit::class_types() as $type) { ?>
                    <?php $selected = $unit->get_class_type() == $type ? 'selected="selected"' : ''; ?>
                    <option value="<?php echo $type ?>" <?php echo $selected; ?>><?php echo lang($type) ?></option>
                <?php } ?>
            </select>
            <?php echo Validator::get_html_error_message('type'); ?>
        </div>
        <div class="form-group">
            <div id="filters" class="m-a-0"></div>
            <?php echo Validator::get_html_error_message('parent_id'); ?>
        </div>
        <div class="form-group">
            <label class="control-label" for="name_ar"> <?php echo lang('Name'); ?> (<?php echo lang('Arabic'); ?>)</label>
            <input name="name_ar" id="name_ar" type="text" class="form-control"
                   value="<?php echo htmlfilter($unit->get_name_ar()); ?>"/>
            <?php echo Validator::get_html_error_message('name_ar'); ?>
        </div>
        <div class="form-group">
            <label class="control-label" for="name_en"> <?php echo lang('Name'); ?> (<?php echo lang('English'); ?>
                )</label>
            <input name="name_en" id="name_en" type="text" class="form-control"
                   value="<?php echo htmlfilter($unit->get_name_en()); ?>"/>
            <?php echo Validator::get_html_error_message('name_en'); ?>
        </div>
        <div class="form-group">
            <label class="control-label"><?php echo lang('Unit Head') ?></label>
            <div class="item m-y-1">
                <div class="form-group m-a-0">
                    <input id="user_label" type="text"
                           onclick="find_users(this,'user_id','user_label', '', ['<?php echo Orm_User::USER_FACULTY ?>','<?php echo Orm_User::USER_STAFF ?>'],'<?php echo lang('Choose Unit Head') ?>')"
                           readonly class="form-control"
                           value="<?php echo($unit->get_unit_head()->get_user_id() ? htmlfilter($unit->get_unit_head()->get_user_obj()->get_full_name()) : ''); ?>"/>
                    <input id="user_id" name="head_id" type="hidden"
                           value="<?php echo $unit->get_unit_head()->get_user_id(); ?>"/>
                </div>
            </div>
        </div>

        <input type="hidden" name="id" value="<?php echo (int)$unit->get_id(); ?>">

        <button class="btn btn-outline" type="submit" <?php echo data_loading_text() ?>>
            <span class="btn-label-icon left fa fa-save" aria-hidden="true"></span>
            <?php echo lang('Save Changes'); ?>
        </button>
        <?php echo form_close(); ?>
    </div>
</div>

<script>

    pxInit.push(function () {
        type_changed();
    });

    function type_changed() {

        var class_type = $('#type').val();
        var filters = $('#filters');

        filters.html('<div class="progress progress-striped active no-margin" >' +
            '<div class="progress-bar" style="width: 100%;"><i class="fa fa-spinner fa-spin"></i> Loading</div>' +
            '</div>');

        $.ajax({
            url: '/unit/filter/' + class_type + '/<?php echo $unit->get_id() ?>',
            type: 'GET',
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error === false) {
                window.location.reload();
            } else {
                if (msg.html) {
                    filters.addClass('well');
                } else {
                    filters.removeClass('well');
                }
                filters.html(msg.html);
            }
        });
    }
</script>


