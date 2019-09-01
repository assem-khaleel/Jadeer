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
        <?php echo form_open("/faculty_portfolio/academic/academic_rank_manage" , array('id' => 'academic_rank-form','class' => 'form-horizontal')); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <span class="panel-title"><?php echo lang('Academic Rank'); ?></span>
        </div>
        <div class="modal-body">
            <table class="table table-striped table-bordered" id="more_academic_rank">
                <tr class="item">
                    <td class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Academic Rank')?></label>
                            <div class="col-md-9">
                                <select name="academic_rank" class="form-control" >
                                    <option value=""><?php echo lang('Rank')?>...</option>
                                    <?php foreach(Orm_User_Faculty::$academic_ranks as $rank_key => $rank_rank) { ?>
                                        <?php $selected = ($rank_key == $academic_rank->get_academic_rank() ? 'selected="selected"' : ''); ?>
                                        <option value="<?php echo $rank_key; ?>" <?php echo $selected; ?>><?php echo lang($rank_rank); ?></option>
                                    <?php } ?>
                                </select>
                                <?php echo Validator::get_html_error_message('rank'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3"><?php echo lang('Rank Date')?></label>
                            <div class="col-md-9">
                                <input type="text" name="rank_date" value="<?php echo ($academic_rank->get_rank_date() != '0000-00-00' ? htmlfilter($academic_rank->get_rank_date()) : ''); ?>" readonly="readonly" class="form-control datepicker_date" >
                                <?php echo Validator::get_html_error_message('rank_date'); ?>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo intval($academic_rank->get_id()); ?>" >
                    </td>
                </tr>
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

    $(".datepicker_date").datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    });

    $('#academic_rank-form').on('submit', function (e) {
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
</script>