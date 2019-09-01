<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/7/16
 * Time: 3:17 PM
 */
/** @var array $complaints */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/student_portfolio/manage_complaint", 'id="complaint-form" class="form-horizontal"') ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Complaints'); ?></span>
        </div>
        <div class="modal-body">

            <div class="form-group">
                <button class="btn btn-block" onclick="add_more_complaint();" type="button"><span class="btn-label-icon left"><i class="fa fa-plus"></i></span><?php echo lang('Add').' '.lang('Complaint'); ?></button>
            </div>

            <table class="table table-bordered more_items" id="more_complaint">
                <?php if (!empty($complaints)) { ?>
                    <?php foreach ($complaints as $key => $complaint) { ?>
                        <tr class="item">
                            <td class="col-md-10">
                                <div class="form-group">
                                    <label for="complaints" class="col-sm-2 control-label"><?php echo lang('Complaints'); ?></label>
                                    <div class="col-sm-10">
                                        <textarea name="complaints[<?php echo $key; ?>][complaints]" class="form-control" id="complaints"><?php echo xssfilter($complaint['complaints']); ?></textarea>
                                        <?php echo Validator::get_html_error_message('complaints_'.$key); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="date" class="col-sm-2 control-label"><?php echo lang('Date'); ?>:</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly="readonly" name="complaints[<?php echo $key; ?>][date]" class="form-control date" value="<?php echo $complaint['date'] == '0000-00-00' ? '' : date('Y-m-d', strtotime($complaint['date'])); ?>" id="date"/>
                                        <?php echo Validator::get_html_error_message('date'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo lang('Attachment'); ?> *</label>

                                    <div class="col-md-9">
                                        <div id="attachment_<?php echo intval($key) ?>" >
                                            <input type="file" name="attachments[<?php echo intval($key) ?>]"  />
                                            <?php echo Validator::get_html_error_message('attachment', $key); ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="col-md-2 valign-middle text-center">
                                <input type="hidden" name="complaints[<?php echo intval($key) ?>][id]" value="<?php echo intval($complaint['id']); ?>" >
                                <button type="button" class="btn" onclick="remove_option(this);" >
                                    <i class="fa fa-trash-o btn-label-icon left"></i><?php echo lang('Delete'); ?>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal"><span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?></button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>><span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true});

    $('#complaint-form').on('submit', function (e) {
        e.preventDefault();

        var files = $(":file:enabled", this);

        if(files.length) {
            $.ajax($(this).attr('action'), {
                data: $(this).serializeArray(),
                files: $(":file:enabled", this),
                iframe: true,
                dataType: "json"
            }).complete(function(data) {
                handle_response(data.responseJSON);
            });
        } else {
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'JSON'
            }).done(function (msg) {
                handle_response(msg);
            });
        }

        function handle_response(msg) {
            if (msg.status == true) {
                $('#profile-recommendation_complaint').html(msg.html);
                $('#ajaxModal').modal('toggle');
                init_data_toggle();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        }

    });

    function add_more_complaint() {
        var complaint = new Date().getTime();
        var more_items = $('#more_complaint');
        more_items.append(
            '<tr class="item">' +
            '<td class="col-md-10">' +
            '<div class="form-group">'+
            '<label for="title_'+complaint+'" class="col-sm-2 control-label"><?php echo lang('Complaints'); ?>:</label>'+
            '<div class="col-sm-10">'+
            '<input type="text" name="complaints['+complaint+'][complaints]" id="complaints_'+complaint+'" class="form-control" value=""/>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label for="date_'+complaint+'" class="col-sm-2 control-label"><?php echo lang('Date'); ?></label>'+
            '<div class="col-sm-10">'+
            '<input type="text" readonly="readonly" name="complaints['+complaint+'][date]" class="form-control date" id="date_'+complaint+'"/>'+
            '</div>'+
            '</div>'+
            '<div class="form-group">'+
            '<label class="col-sm-2 control-label"><?php echo lang('Attachment'); ?> *</label>'+
            '<div class="col-md-9">'+
            '<div id="attachment_'+complaint+'">'+
            '<input type="file" name="attachments['+complaint+']" />'+
            '</div>'+
            '</div>'+
            '</div>'+
            '</td>' +
            '<td class="col-md-2 valign-middle text-center">' +
            '<input type="hidden" name="complaints[' + complaint + '][id]" >' +
            '<button type="button" class="btn" onclick="remove_option(this);" >' +
            '<i class="fa fa-trash-o btn-label-icon left"></i><?php echo lang('Delete'); ?>' +
            '</button>' +
            '</td>' +
            '</tr>'
        );
        rename(more_items);
        $(".date").datepicker({format: 'yyyy-mm-dd', autoclose: true});
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
$('.custom-file').pxFile();
</script>