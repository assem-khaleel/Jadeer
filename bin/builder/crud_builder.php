<?php

require_once dirname(__FILE__) . '/config.php';

/* @var $connection Mysql_Connection */

if (!$tables) {
    $tables = $connection->get_tables();
}

$tables = array_diff($tables, $not_tables);

if(!is_dir($crud_output_dir)) {
    mkdir($crud_output_dir, 0777, true);
}

foreach ($tables as $table_name) {

    $orm_class_name = 'Orm_' . str_replace(' ', '_', ucwords(strtolower(str_replace('_', ' ', $table_name))));
    $model_class_name = str_replace(' ', '_', ucwords(strtolower(str_replace('_', ' ', $table_name)))) . '_Model';

    $name = str_replace('fp_','',$table_name);
    $ucwords_name = ucwords(str_replace('_',' ',$name));

    $file_name = strtolower($orm_class_name) . '.php';

    $table_desc = $connection->get_table_description($table_name);

    $fields = '';
    $fields_1 = '';
    $fields_2 = '';
    $fields_3 = '';
    $fields_4 = '';
    foreach ($table_desc as $key => $field_desc) {

        $fields .= "\${$name}s[\${$name}->get_id()]['{$field_desc['Field']}'] = \${$name}->get_{$field_desc['Field']}();\n";

        if ($field_desc['Field'] !== 'id') {

            $ucwords_field = ucwords(str_replace('_',' ', $field_desc['Field']));

            $fields_1 .= "\${$name}_obj->set_{$field_desc['Field']}(\${$name}['{$field_desc['Field']}']);\n";

            $fields_2 .= <<<CODE2
            <div class="form-group">
                <label class="control-label col-md-3"><?php echo lang('{$ucwords_field}')?></label>
                <div class="col-md-9">
                    <input type="text" name="{$name}s[<?php echo intval(\$key) ?>][{$field_desc['Field']}]" value="<?php echo htmlfilter(\${$name}['{$field_desc['Field']}']); ?>" class="form-control" >
                    <?php echo Validator::get_html_error_message('{$field_desc['Field']}_'.intval(\$key)); ?>
                </div>
            </div>\n
CODE2;

            $fields_3 .= <<<CODE3
            '<div class="form-group">' +
                '<label class="control-label col-md-3"><?php echo lang('{$ucwords_field}')?></label>' +
                '<div class="col-md-9">' +
                '<input type="text" name="{$name}s[' + {$name} + '][{$field_desc['Field']}]" class="form-control" >' +
                '</div>' +
            '</div>' +\n
CODE3;

$fields_4 .= <<<CODE4
            <div>
                <label class="control-label"><?php echo lang('{$ucwords_field}')?> : </label>
                <?php echo htmlfilter(\${$name}->get_{$field_desc['Field']}()) ?>
            </div>\n
CODE4;



        }

    }


    //
    // create class
    //
    $class_body = <<<CODE
        <?php
        public function {$name}_manage() {
        \$user_id = Orm_User::get_logged_user_id();

        \${$name}s = array();

        foreach({$orm_class_name}::get_all(array('user_id' => \$user_id)) as \${$name}) {
            {$fields}
        }

        if (\$this->input->server('REQUEST_METHOD') == 'POST') {

            \$old_{$name}_ids = array_keys(\${$name}s);

            \${$name}s = (array) \$this->input->post('{$name}s');

            if(Validator::success()) {
                \${$name}_ids = array();
                foreach (\${$name}s as \$key => \${$name}) {
                    \${$name}_obj = {$orm_class_name}::get_instance(\${$name}['id']);
                    {$fields_1}

                    if (!(\${$name}_obj->get_id() && \${$name}_obj->get_user_id() != \$user_id)) {

                        if (\${$name}['id']) {
                            \${$name}_ids[] = \${$name}['id'];
                        }

                        \${$name}_obj->set_user_id(\$user_id);
                        \${$name}_obj->save();
                    }
                }

                \$remove_{$name}_ids = array_diff(\$old_{$name}_ids, \${$name}_ids);
                if (\$remove_{$name}_ids) {
                    foreach (\$remove_{$name}_ids as \${$name}_id) {
                        \${$name}_obj = {$orm_class_name}::get_instance(\${$name}_id);
                        \${$name}_obj->delete();
                    }
                }

                json_response(array('status' => true, 'html' => \$this->info(\$user_id, true)));
            }
        }

        \$this->view_params['{$name}s'] = \${$name}s;

        \$html = \$this->load->view('faculty_portfolio/publication/{$name}', \$this->view_params, true);
        if (\$this->input->server('REQUEST_METHOD') == 'POST') {
            json_response(array('status' => false, 'html' => \$html));
        } else {
            echo \$html;
        }
    }
    ?>

<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/10/16
 * Time: 12:06 PM
 */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/publication/{$name}_manage" , array('id' => '{$name}-form')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('{$ucwords_name}'); ?></span>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <button class="btn btn-labeled btn-success btn-block" onclick="add_more_{$name}();" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span><?php echo lang('Add {$ucwords_name}'); ?></button>
            </div>

            <table class="table table-striped table-bordered more_items" id="more_{$name}">
                <?php if (!empty(\${$name}s)) { ?>
                    <?php foreach (\${$name}s as \$key => \${$name}) { ?>
                        <tr class="item">
                            <td class="col-md-10">
                                {$fields_2}
                            </td>
                            <td class="col-md-2 valign-middle text-center">
                                <input type="hidden" name="{$name}s[<?php echo intval(\$key) ?>][id]" value="<?php echo intval(\${$name}['id']); ?>" >
                                <button type="button" class="btn btn-labeled btn-danger" onclick="remove_option(this);" >
                                    <i class="fa fa-trash-o btn-label"></i><?php echo lang('Delete'); ?>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-danger pull-left btn-labeled" data-dismiss="modal"><span class="btn-label"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm btn-primary pull-right btn-labeled" <?php echo data_loading_text() ?>><span class="btn-label"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('#{$name}-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status == 1) {
                $('#profile-general-info').html(msg.html);
                $('#ajaxModal').modal('toggle');
                init_data_toggle();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    function add_more_{$name}() {
        var {$name} = new Date().getTime();
        var more_items = $('#more_{$name}');
        more_items.append(
            '<tr class="item">' +
            '<td class="col-md-10">' +
                {$fields_3}
            '</td>' +
            '<td class="col-md-2 valign-middle text-center">' +
            '<input type="hidden" name="{$name}s[' + {$name} + '][id]" >' +
            '<button type="button" class="btn btn-labeled btn-danger" onclick="remove_option(this);" >' +
            '<i class="fa fa-trash-o btn-label"></i><?php echo lang('Delete'); ?>' +
            '</button>' +
            '</td>' +
            '</tr>'
        );
        rename(more_items);
    }
    function remove_option(element) {
        var more_items = $(element).parents('.more_items').get(0);
        var item = $(element).parents('.item').get(0);

        $(item).hide().find('input[name], select[name], textarea[name]').each(function () {
            $(this).attr('disabled', 'disabled');
        });

        rename(more_items);
    }
    function rename(element) {
        $(element).find('input[name], select[name], textarea[name]').each(function () {
            var map = get_map($(this).parents('.item').get(0)).reverse();
            var old_name = $(this).attr('name');
            var new_name = get_field_name(old_name, map);
            $(this).attr('name', new_name);
        });
    }
    function get_map(item_element, map) {
        if (!map) {
            map = [];
        }
        map.push($(item_element).parent().children('.item').index(item_element));
        var parent_item = $(item_element).parents('.item');
        if ($(parent_item).length) {
            return get_map(parent_item, map);
        } else {
            return map;
        }
    }
    function get_field_name(name, map, parent_name, index, field_name) {
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
            return get_field_name(name, map, parent_name, index, field_name);
        } else {
            field_name += name;
            return field_name;
        }
    }
</script>



<div class="note note-info clearfix">
    <div class="pull-left">
        <b><?php echo lang('{$ucwords_name}s')?></b>
    </div>
    <?php if(\$user_id == Orm_User::get_logged_user_id()) { ?>
        <div class="pull-right">
            <a href="/faculty_portfolio/publication/{$name}_manage" data-toggle="ajaxModal" class="btn btn-primary btn-sm btn-labeled"><i class="btn-label fa fa-edit"></i><?php echo lang('Edit')?></a>
        </div>
    <?php } ?>
</div>

<?php \${$name}s = {$orm_class_name}::get_all(array('user_id' => \$user_id)) ?>
<?php if(\${$name}s) { ?>
    <ul class="list-group">
        <?php foreach(\${$name}s as \$key => \${$name}) { ?>
            <li class="list-group-item <?php echo \$key % 2 ? '' : 'list-group-item-warning'?>">
                {$fields_4}
            </li>
        <?php } ?>
    </ul>
<?php } ?>

CODE;

    $file = $crud_output_dir . $file_name;

    if (!file_exists($file)) {
        file_put_contents($file, indent_php_code($class_body));
    }

    echo '.';
}

echo "\n";