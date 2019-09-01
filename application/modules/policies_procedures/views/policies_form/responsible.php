<?php

/** @var $roles Orm_Policies_Procedures_Responsible[] */

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('/policies_procedures/add_edit_response/' . intval($policy_id) . '/' . $type, array('id' => 'roles-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Roles & Responsibilities'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <button class="btn btn-block" onclick="add_more_roles();" type="button">
                    <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                    <?php echo lang('Add') . ' ' . lang('Roles & Responsibilities'); ?>
                </button>
            </div>
            <div class="table-primary">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th class="col-md-5"><?php echo lang('Roles'); ?></th>
                        <th class="col-md-5"><?php echo lang('Responsibilities'); ?></th>
                        <th class="col-md-2 text-center"><?php echo lang('Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody id="more_roles">
                    <?php if ($roles) { ?>
                        <?php foreach ($roles as $key => $role) { ?>
                            <tr class="item">
                                <td>
                                    <div class="form-group m-a-0-vr">
                                        <textarea name="roles[<?php echo intval($key); ?>][role]"
                                                  class="form-control"><?php echo xssfilter(isset($role['role']) ? $role['role'] : ''); ?></textarea>
                                        <?php echo Validator::get_html_error_message('required_role_' . $key); ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group m-a-0-vr">
                                        <textarea name="roles[<?php echo intval($key); ?>][responsibilities]"
                                                  class="form-control"><?php echo xssfilter(isset($role['responsibilities']) ? $role['responsibilities'] : ''); ?></textarea>
                                        <?php echo Validator::get_html_error_message('required_responsibilities_' . $key); ?>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <input type="hidden" name="roles[<?php echo intval($key); ?>][id]"
                                           class="form-control"
                                           value="<?php echo intval(isset($role['id']) ? $role['id'] : 0); ?>">
                                    <a class="btn btn-sm" onclick="remove_option_roles(this);">
                                        <span><i class="fa fa-trash"></i></span>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
                <div class="form-group m-a-0">
                    <?php echo Validator::get_html_error_message('roles'); ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="policy_id" value="<?php echo intval($policy_id) ?>">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span
                    class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span
                    class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('Save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    init_data_toggle();

    $('#roles-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == 1) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    function add_more_roles() {

        var key = new Date().getTime();
        $('#more_roles').append('<tr class="item">' +
            '<td>' +
            '<textarea name="roles[' + key + '][role]" class="form-control" ></textarea>' +
            '</td>' +
            '<td>' +
            '<textarea name="roles[' + key + '][responsibilities]" class="form-control" ></textarea>' +
            '</td>' +
            '<td class="text-center">' +
            '<input type="hidden" name="roles[' + key + '][id]" class="form-control" >' +
            '<a class="btn btn-sm" onclick="remove_option_roles(this);">' +
            '<span><i class="fa fa-trash-o"></i></span>' +
            '</a>' +
            '</td>' +
            '</tr>');

        rename_roles();
    }
    function remove_option_roles(element) {
        $(element).parents('.item').remove();
        rename_roles();
    }
    function rename_roles() {
        $('#more_roles').find('input[name], select[name], textarea[name]').each(function () {
            var map = get_map_roles($(this).parents('.item').get(0)).reverse();
            var old_name = $(this).attr('name');
            var new_name = get_field_name_roles(old_name, map);
            $(this).attr('name', new_name);
        });
    }
    function get_map_roles(item_element, map) {
        if (!map) {
            map = [];
        }
        map.push($(item_element).parent().children('.item').index(item_element));
        var parent_item = $(item_element).parents('.item');
        if ($(parent_item).length) {
            return get_map_roles(parent_item, map);
        } else {
            return map;
        }
    }
    function get_field_name_roles(name, map, parent_name, index, field_name) {
        if (!index) {
            index = 0;
        }
        if (!field_name) {
            field_name = '';
        }
        var patt = new RegExp(/\[\d+\]/);
        if (parent_name) {
            name = name.replace(parent_name, '');
            name = name.replace(patt, '');
        }
        parent_name = name.substr(0, name.indexOf(name.match(patt)));
        if (patt.test(name)) {
            field_name += parent_name + '[' + map[index] + ']';
            index++;
            return get_field_name_roles(name, map, parent_name, index, field_name);
        } else {
            field_name += name;
            return field_name;
        }
    }

</script>
