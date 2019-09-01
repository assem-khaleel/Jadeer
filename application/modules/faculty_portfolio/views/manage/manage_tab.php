<?php
/** @var Orm_Fp_Eva_Tabs $tab       */
/** @var Orm_Fp_Eva_Tab_Row[] $rows */
/** @var Orm_Fp_Eva_Tab_Col[] $cols */
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/manage/manage_tab/".$tab->get_id(), ['id' => 'tab-form', 'method' => 'post']); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Manage Evaluation'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label"> <?php echo lang('Performances'); ?></label>
                    <br />
                </div>
                
                <div class="well" id="row_tab">

                <?php if(!count($rows)): ?>
                    <div class="form-group">
                        <input name="row_id[]" type="hidden" value="0"/>
                        <input name="row_title_ar[]" type="text" class="form-control" placeholder="<?php echo lang('Title') .' ('.lang('Arabic').')'; ?>" value=""/>
                        <br />
                        <input name="row_title_en[]" type="text" placeholder="<?php echo lang('Title') .' ('.lang('English').')'; ?>" class="form-control" value=""/>
                        <br />
                    </div>
                <?php else: ?>
                <?php foreach($rows as $key=>$row): ?>

                    <div class="form-group">
                        <input name="row_id[]" type="hidden" value="<?php echo htmlfilter($row->get_id()); ?>"/>
                        <input name="row_title_ar[]" type="text" class="form-control" placeholder="<?php echo lang('Title') .' ('.lang('Arabic').')'; ?>" value="<?php echo htmlfilter($row->get_title_ar()); ?>"/>
                        <?php echo Validator::get_html_error_message('row_title_ar', $key); ?>
                        <br />
                        <input name="row_title_en[]" type="text" placeholder="<?php echo lang('Title') .' ('.lang('English').')'; ?>" class="form-control" value="<?php echo htmlfilter($row->get_title_en()); ?>"/>
                        <?php echo Validator::get_html_error_message('row_title_en', $key); ?>
                    <?php if($key!=0): ?>
                        <button type="button" class="btn" aria-label="Left Align" onclick="remove_monitor(this);" style="margin-top: 5px;">
                            <span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>
                        </button>
                    <?php else: ?>
                        <br />
                    <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                <?php endif; ?>

                    <div class="form-group">
                        <hr />
                        <div class="more_link">
                            <button type="button" class="btn" aria-label="Left Align" onclick="add_row();">
                                <span class="fa fa-plus" aria-hidden="true"></span> <?php echo lang('Add').' '.lang('More'); ?>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label"> <?php echo lang('Skills'); ?></label>
                    <br />
                </div>
                
                <div class="well" id="col_tab">

                    <?php if(!count($cols)): ?>
                        <div class="form-group">
                            <input name="col_id[]" type="hidden" value="0"/>
                            <input name="col_title_ar[]" type="text" class="form-control" placeholder="<?php echo lang('Title') .' ('.lang('Arabic').')'; ?>" value=""/>
                            <br />
                            <input name="col_title_en[]" type="text" placeholder="<?php echo lang('Title') .' ('.lang('English').')'; ?>" class="form-control" value=""/>
                            <br />
                        </div>
                    <?php else: ?>
                        <?php foreach($cols as $key=>$col): ?>

                            <div class="form-group">
                                <input name="col_id[]" type="hidden" value="<?php echo htmlfilter($col->get_id()); ?>"/>
                                <input name="col_title_ar[]" type="text" class="form-control" placeholder="<?php echo lang('Title') .' ('.lang('Arabic').')'; ?>" value="<?php echo htmlfilter($col->get_title_ar()); ?>"/>
                                <?php echo Validator::get_html_error_message('col_title_ar', $key); ?>
                                <br />
                                <input name="col_title_en[]" type="text" placeholder="<?php echo lang('Title') .' ('.lang('English').')'; ?>" class="form-control" value="<?php echo htmlfilter($col->get_title_en()); ?>"/>
                                <?php echo Validator::get_html_error_message('col_title_en', $key); ?>
                                <?php if($key!=0): ?>
                                    <button type="button" class="btn" aria-label="Left Align" onclick="remove_monitor(this);" style="margin-top: 5px;">
                                        <span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>
                                    </button>
                                <?php else: ?>
                                    <br />
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="form-group">
                        <hr />
                        <div class="more_link">
                            <button type="button" class="btn" aria-label="Left Align" onclick="add_col();">
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

    $('#tab-form').on('submit', function (e) {
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
        var row_tab = $('#row_tab');
//        var new_key = row_tab.children().length-1;

        row_tab.children().last().before(function() {
            var form_group = $('<div class="form-group">');

            form_group.append($('<input type="hidden" value="0" />').attr('name', 'row_id[]'));
            form_group.append($('<input type="text" class="form-control" placeholder="<?php echo lang('Title') .' ('.lang('Arabic').')'; ?>" />').attr('name', 'row_title_ar[]'));
            form_group.append('<br />');
            form_group.append($('<input type="text" class="form-control" placeholder="<?php echo lang('Title') .' ('.lang('English').')'; ?>" />').attr('name', 'row_title_en[]'));
            form_group.append('<button type="button" class="btn" aria-label="Left Align" onclick="remove_monitor(this);" style="margin-top: 5px;">' +
                              '<span class="fa fa-trash-o" aria-hidden="true"></span> <?php echo lang('Remove'); ?>'+
                              '</button>');

            return form_group;
        });
    }

    function add_col() {
        var col_tab = $('#col_tab');
//        var new_key = col_tab.children().length-1;

        col_tab.children().last().before(function() {
            var form_group = $('<div class="form-group">');

            form_group.append($('<input type="hidden" value="0" />').attr('name', 'col_id[]'));
            form_group.append($('<input type="text" class="form-control" placeholder="<?php echo lang('Title') .' ('.lang('Arabic').')'; ?>" />').attr('name', 'col_title_ar[]'));
            form_group.append('<br />');
            form_group.append($('<input type="text" class="form-control" placeholder="<?php echo lang('Title') .' ('.lang('English').')'; ?>" />').attr('name', 'col_title_en[]'));
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

