<?php
/** @var Orm_Fp_Eva_Tabs $tab */
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("/faculty_portfolio/manage/add_edit_tab/".$tab->get_id(), ['id' => 'tab-form', 'method' => 'post']); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo ($tab->get_id()? lang('Edit'): lang('Add New')).' '.lang('Evaluation'); ?></span>
        </div>
        <div class="modal-body">
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label" for="title_ar"> <?php echo lang('Title'); ?> (<?php echo lang('Arabic'); ?>)</label>
                    <input id="title_ar" name="title_ar" type="text" class="form-control"
                           value="<?php echo htmlfilter($tab->get_title_ar()); ?>"/>
                    <?php echo Validator::get_html_error_message('title_ar'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for="title_en"> <?php echo lang('Title'); ?> (<?php echo lang('English'); ?>)</label>
                    <input id="title_en" name="title_en" type="text" class="form-control" value="<?php echo htmlfilter($tab->get_title_en()); ?>"/>
                    <?php echo Validator::get_html_error_message('title_en'); ?>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="points"> <?php echo lang('Points'); ?></label>
                    <input name="points" type="text" class="number form-control" value="<?php echo htmlfilter($tab->get_points()); ?>" />
                    <?php echo Validator::get_html_error_message('points'); ?>
                </div>

                <div class="form-group">
                    <label class="control-label" for="legend_id"> <?php echo lang('Legend'); ?></label>
                    <select class="form-control" name="legend_id" id="legend_id">
                        <option value=""><?php echo lang('Select Legend') ?></option>
                    <?php foreach (Orm_Fp_Legend::get_all([],0, 30) as $legend): ?>
                        <option value="<?php echo (int) $legend->get_id() ?>" <?php if($legend->get_id() == $tab->get_legend_id()){ echo 'selected=""';} ?>><?php echo htmlfilter($legend->get_title()) ?></option>
                    <?php endforeach; ?>
                    </select>
                    <?php echo Validator::get_html_error_message('legend_id'); ?>
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


</script>

