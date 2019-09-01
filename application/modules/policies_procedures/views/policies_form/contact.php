<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 23/03/17
 * Time: 01:10 م
 */
/** @var $policy Orm_Policies_Procedures */
/** @var $contacts Orm_Policies_Procedures_Contacts[] */
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/policies_procedures/add_edit_contact/{$policy_id}/contact", array('id' => 'contact-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Contacts Definition'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="contact_def_en"><?php echo lang('Contact definition') . '(' . lang('English').' ) ' ?></label>
                        <div class="col-sm-9">
                            <textarea class="form-control tiny" name="contact_def_en"
                                      id="contact_def_en"><?php echo xssfilter($policy->get_contact_def_en()) ?></textarea>
                            <?php echo Validator::get_html_error_message('contact_def_en'); ?>

                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <label class="col-sm-3 control-label"
                               for="contact_def_ar"><?php echo lang('Contact definition') . ' ( ' . lang('Arabic').' ) ' ?></label>
                        <div class="col-sm-9">
                            <textarea class="form-control tiny" name="contact_def_ar"
                                      id="contact_def_ar"><?php echo xssfilter($policy->get_contact_def_ar()) ?></textarea>
                            <?php echo Validator::get_html_error_message('contact_def_ar'); ?>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-primary">
                            <div class="table-header">
                                <span class="table-caption"><?php echo lang('Contacts'); ?></span>
                                <div class="panel-heading-controls col-sm-4">
                                    <button class="btn  btn-xs  pull-right" onclick="add_more_contact();" type="button"><span class="btn-label-icon left"><i class="fa fa-plus"></i></span><?php echo lang('Add'); ?></button>
                                </div>
                            </div>
                            <table class="table table-bordered" >
                                <thead>
                                <tr>
                                    <th class="col-md-3"><?php echo lang('Subject'); ?> </th>
                                    <th class="col-md-3"><?php echo lang('Contact Name'); ?> </th>
                                    <th class="col-md-2"><?php echo lang('Phone'); ?> </th>
                                    <th class="col-md-3"><?php echo lang('email'); ?></th>
                                    <th class="col-md-1 text-center"><?php echo lang('Actions'); ?></th>
                                </tr>
                                </thead>
                                <tbody id="more_contact">
                                <?php if ($contacts) { ?>
                                    <?php foreach ($contacts as $key => $contact) { ?>
                                        <tr class="item">
                                            <td>
                                                <div class="form-group m-a-0-vr">
                                                     <input type="text" id="subject" name="contacts[<?php echo intval($key); ?>][subject]" class="form-control" value="<?php echo htmlfilter(isset($contact['subject']) ? $contact['subject'] : ''); ?>">
                                                    <?php echo Validator::get_html_error_message('required_subject_'.$key); ?>
                                                </div>

                                            </td>
                                            <td>
                                                <div class="form-group m-a-0-vr">
                                                    <input type="text" id="name" name="contacts[<?php echo intval($key); ?>][contact_name]" class="form-control" value="<?php echo htmlfilter(isset($contact['contact_name']) ? $contact['contact_name'] : ''); ?>">
                                                    <?php echo Validator::get_html_error_message('required_name_'.$key); ?>
                                                </div>

                                            </td>  
                                            <td>
                                                <div class="form-group m-a-0-vr">
                                                    <input type="text" id="phone" name="contacts[<?php echo intval($key); ?>][phone]" class="form-control" value="<?php echo htmlfilter(isset($contact['phone']) ? $contact['phone'] : ''); ?>">
                                                    <?php echo Validator::get_html_error_message('required_phone_'.$key); ?>
                                                </div>

                                            </td>  
                                            <td>
                                                <div class="form-group m-a-0-vr">
                                                    <input type="text" id="mail" name="contacts[<?php echo intval($key); ?>][mail]" class="form-control" value="<?php echo htmlfilter(isset($contact['mail']) ? $contact['mail'] : ''); ?>">
                                                    <?php echo Validator::get_html_error_message('required_mail_'.$key); ?>
                                                </div>

                                            </td>
                                            <td class="text-center">
                                                <input type="hidden" name="contacts[<?php echo intval($key); ?>][id]" class="form-control" value="<?php echo intval(isset($contact['id']) ? $contact['id'] : 0); ?>">
                                                <a class="btn btn-sm" onclick="remove_option_contact(this);">
                                                    <span><i class="fa fa-trash"></i></span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                </tbody>
                            </table>
                            <div class="form-group m-a-0">
                                <?php echo Validator::get_html_error_message('contacts'); ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="policies_id" value="<?php echo intval($policy->get_id()) ?>">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    init_data_toggle();

    $('#contact-form').on('submit', function (e) {
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

    function add_more_contact() {
        var key = new Date().getTime();
        $('#more_contact').append('<tr class="item">' +
            '<td>' +
            '<input type="text" id="subject" name="contacts['+ key +'][subject]" class="form-control">' +
            '</td>' +
            '<td>' +
            '<input type="text" id="name" name="contacts['+ key +'][contact_name]" class="form-control">' +
            '</td>' +
            '<td>' +
            '<input type="text" id="phone" name="contacts['+ key +'][phone]" class="form-control">' +
            '</td>' +
            '<td>' +
            '<input type="text" id="mail" name="contacts['+ key +'][mail]" class="form-control">' +
            '</td>' +
            '<td class="text-center">' +
            '<input type="hidden" name="contacts[' + key + '][id]" class="form-control" >' +
            '<a class="btn btn-sm" onclick="remove_option_contact(this);">' +
            '<span class=""><i class="fa fa-trash-o"></i></span>' +
            '</a>' +
            '</td>' +
            '</tr>');
        rename_contact();
    }
    function remove_option_contact(element) {
        $(element).parents('.item').remove();
        rename_contact();
    }
    function rename_contact() {
        $('#more_contact').find('input[name], select[name], textarea[name]').each(function () {
            var map = get_map_contact($(this).parents('.item').get(0)).reverse();
            var old_name = $(this).attr('name');
            var new_name = get_field_name_contact(old_name, map);
            $(this).attr('name', new_name);
        });
    }
    function get_map_contact(item_element, map) {
        if (!map) {
            map = [];
        }
        map.push($(item_element).parent().children('.item').index(item_element));
        var parent_item = $(item_element).parents('.item');
        if ($(parent_item).length) {
            return get_map_contact(parent_item, map);
        } else {
            return map;
        }
    }
    function get_field_name_contact(name, map, parent_name, index, field_name) {
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
            return get_field_name_contact(name, map, parent_name, index, field_name);
        } else {
            field_name += name;
            return field_name;
        }
    }

</script>
