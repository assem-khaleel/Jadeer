<?php
/** @var Orm_Role $role */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <?php
            if (!($role->get_id())) {
                echo lang('Create').' '.lang('Role');
            } else {
                echo lang('Edit').' '.lang('Role');
            }
            ?>
        </div>
        <?php echo form_open('/role/save', 'id="role-form"') ?>
        <div class="modal-body">
            <div class="row form-group">
                <label class="col-sm-2 control-label"><?php echo lang('Role Name'); ?></label>
                <div class="col-sm-10">
                    <input class="form-control" type="text" name="name"
                           value="<?php echo htmlfilter($role->get_name()); ?>">
                    <?php echo Validator::get_html_error_message('name'); ?>
                </div>
            </div>

            <div class="row form-group">
                <label class="col-sm-2 control-label"><?php echo lang('Role Type'); ?></label>
                <div class="col-sm-10">
                    <?php foreach (Orm_Role::$admin_levels as $key => $admin_level) { ?>
                        <?php $selected = ($role->get_admin_level() == $key ? 'checked="checked"' : '') ?>
                        <div class="radio">
                            <label>
                                <input type="radio" class="px" value="<?php echo $key ?>" <?php echo $selected ?>
                                       name="admin_level">
                                <span class="lbl"><?php echo lang($admin_level) ?></span>
                            </label>
                        </div>
                    <?php } ?>
                    <?php echo Validator::get_html_error_message('admin_level'); ?>
                </div>
            </div>

            <hr>

            <?php
            // Load config file
            $this->load->config('acl');
            // Get breadcrumbs display options
            $acl_map = $this->config->item('map');
            ?>
            <div class="row form-group">
                <label class="col-sm-2 control-label"><?php echo lang('Credentials'); ?></label>
                <div class="col-sm-10">
                    <div id="credentials">
                        <ul>
                            <?php foreach ($acl_map as $module => $permissions) { ?>
                                <li><?php echo lang($module) ?>
                                    <ul>
                                        <?php foreach ($permissions as $permission => $acl) { ?>
                                            <li <?php echo(is_array($role->get_credential()) && in_array($acl, $role->get_credential()) ? 'data-checkstate="checked"' : ''); ?>
                                                    id="<?php echo $acl ?>"><?php echo lang($permission) ?></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <input type="hidden" name="id" value="<?php echo urlencode($role->get_id()); ?>">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span
                        class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span
                        class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
            </button>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<script>
    init_data_toggle();
    $(function () {
        var $_tree = $("#credentials");
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

    $('form#role-form').submit(function (e) {
        e.preventDefault();

        var form_data = $(this).serializeArray();

        var credentials = $('#credentials').jstree('get_selected');
        $.each(credentials, function (index, value) {
            form_data.push({
                name: "credentials[]",
                value: value
            });
        });

        $.ajax({
            url: '/role/save',
            type: 'POST',
            data: form_data,
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.error === false) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });
</script>