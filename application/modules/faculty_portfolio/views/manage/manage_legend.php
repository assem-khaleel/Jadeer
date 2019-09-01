<?php
/** @var Orm_Fp_Legend_Desc[] $items */
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/manage/manage_legend/".$legend_id, ['id' => 'legend_form', 'method' => 'post']); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Manage Legend '); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label"> <?php echo lang('Legend Items'); ?></label>
                    <br />
                </div>
                
                <div class="well" id="legend_items">

                <?php if(!count($items)): ?>
                    <div class="form-group">
                        <input name="id[]" type="hidden" value="0"/>
                        <div class="row m-b-2">
                            <div class="col-md-12">
                                <input name="legend_ar[]" type="text" class="form-control" placeholder="<?php echo lang('Legend') .' ('.lang('Arabic').')'; ?>" value=""/>
                            </div>
                        </div>
                        <div class="row m-b-2">
                            <div class="col-md-12">
                                <input name="legend_en[]" type="text" placeholder="<?php echo lang('Legend') .' ('.lang('English').')'; ?>" class="form-control" value=""/>
                            </div>
                        </div>
                        <div class="row m-b-2">
                            <div class="col-md-6">
                                <input name="min[]" type="text" placeholder="<?php echo lang('Min'); ?>" class="form-control number" value=""/>
                            </div>
                            <div class="col-md-6">
                                <input name="max[]" type="text" placeholder="<?php echo lang('Max'); ?>" class="form-control number" value=""/>
                            </div>
                        </div>
                        <div class="row m-b-2">
                            <div class="col-md-12">
                                <textarea name="desc_ar[]" placeholder="<?php echo lang('Description') .' ('.lang('Arabic').')'; ?>" class="form-control" ></textarea>
                            </div>
                        </div>
                        <div class="row m-b-2">
                            <div class="col-md-12">
                                <textarea name="desc_en[]" placeholder="<?php echo lang('Description') .' ('.lang('English').')'; ?>" class="form-control" ></textarea>
                            </div>
                        </div>
                        <hr />
                    </div>
                <?php else: ?>
                <?php foreach($items as $key=> $item): ?>

                    <div class="form-group">
                        <input name="id[]" type="hidden" value="<?php echo $item->get_id() ?>"/>
                        <div class="row m-b-2">
                            <div class="col-md-12">
                                <input name="legend_ar[]" type="text" class="form-control" placeholder="<?php echo lang('Legend') .' ('.lang('Arabic').')'; ?>" value="<?php echo htmlfilter($item->get_legend_ar()); ?>"/>
                                <?php echo Validator::get_html_error_message('legend_ar', $key); ?>
                            </div>
                        </div>
                        <div class="row m-b-2">
                            <div class="col-md-12">
                                <input name="legend_en[]" type="text" class="form-control" placeholder="<?php echo lang('Legend') .' ('.lang('English').')'; ?>" value="<?php echo htmlfilter($item->get_legend_en()); ?>"/>
                                <?php echo Validator::get_html_error_message('legend_en', $key); ?>
                            </div>
                        </div>
                        <div class="row m-b-2">
                            <div class="col-md-6">
                                <input name="min[]" type="text" placeholder="<?php echo lang('Min'); ?>" class="form-control number" value="<?php echo htmlfilter($item->get_min()); ?>"/>
                                <?php echo Validator::get_html_error_message('min', $key); ?>
                            </div>
                            <div class="col-md-6">
                                <input name="max[]" type="text" placeholder="<?php echo lang('Max'); ?>" class="form-control number" value="<?php echo htmlfilter($item->get_max()); ?>"/>
                                <?php echo Validator::get_html_error_message('max', $key); ?>
                            </div>
                        </div>
                        <div class="row m-b-2">
                            <div class="col-md-12">
                                <textarea name="desc_ar[]" placeholder="<?php echo lang('Description') .' ('.lang('Arabic').')'; ?>" class="form-control" ><?php echo htmlfilter($item->get_desc_ar()); ?></textarea>
                                <?php echo Validator::get_html_error_message('desc_ar', $key); ?>
                            </div>
                        </div>
                        <div class="row m-b-2">
                            <div class="col-md-12">
                                <textarea name="desc_en[]" placeholder="<?php echo lang('Description') .' ('.lang('English').')'; ?>" class="form-control" ><?php echo htmlfilter($item->get_desc_en()); ?></textarea>
                                <?php echo Validator::get_html_error_message('desc_en', $key); ?>
                            </div>
                        </div>

                    <?php if($key!=0): ?>
                        <button type="button" class="btn" aria-label="Left Align" onclick="remove_monitor(this);" style="margin-top: 5px;">
                            <span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>
                        </button>
                    <?php endif; ?>
                        <hr />
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>

                    <div class="form-group">
                        <div class="more_link">
                            <button type="button" class="btn" aria-label="Left Align" onclick="add_row();">
                                <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add').' '.lang('More'); ?>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                    <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
                </button>
                <button type="submit" class="btn btn-sm pull-right " <?php echo data_loading_text() ?>>
                    <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
                </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">

    $('.number').keypress(function(e){

        var key =  e.charCode || e.which;
        var char = String.fromCharCode(key);
        if( !(/[\d]/).test(char) ) {
            e.preventDefault();
            return false;
        }
    });

    $('#legend_form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json"
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });

        return false;
    });

    function add_row() {
        var legend_items = $('#legend_items');
//        var new_key = legend_items.children().length-1;

        legend_items.children().last().before(function() {
            var form_group = $('<div class="form-group">');

            form_group.append($('<input type="hidden" value="0" />').attr('name', 'id[]'));
            form_group.append('<div class="row m-b-2"><div class="col-md-12"><input name="legend_ar[]" type="text" class="form-control" placeholder="<?php echo lang('Legend') .' ('.lang('Arabic').')'; ?>" value=""/></div></div>');
            form_group.append('<div class="row m-b-2"><div class="col-md-12"><input name="legend_en[]" type="text" placeholder="<?php echo lang('Legend') .' ('.lang('English').')'; ?>" class="form-control" value=""/></div></div>');
            form_group.append('<div class="row m-b-2"><div class="col-md-6"><input name="min[]" type="text" placeholder="<?php echo lang('Min'); ?>" class="form-control number" value=""/></div><div class="col-md-6"><input name="max[]" type="text" placeholder="<?php echo lang('Max'); ?>" class="form-control number" value=""/></div></div>');
            form_group.append('<div class="row m-b-2"><div class="col-md-12"><textarea name="desc_ar[]" placeholder="<?php echo lang('Description') .' ('.lang('Arabic').')'; ?>" class="form-control" ></textarea></div></div>');
            form_group.append('<div class="row m-b-2"><div class="col-md-12"><textarea name="desc_en[]" placeholder="<?php echo lang('Description') .' ('.lang('English').')'; ?>" class="form-control" ></textarea></div></div>');
            form_group.append('<hr />');
            form_group.append('<button type="button" class="btn" aria-label="Left Align" onclick="remove_monitor(this);" style="margin-top: 5px;">' +
                              '<span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>'+
                              '</button>');

            return form_group;
        });
    }

    function remove_monitor(btn) {
        $(btn).parent().remove();
    }
</script>

