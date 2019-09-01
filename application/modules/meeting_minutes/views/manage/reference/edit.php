<?php
/** @var $meeting Orm_Mm_Meeting */
/** @var $meeting_objs Orm_Mm_Meeting[] */
?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("meeting_minutes/reference_save/{$meeting->get_id()}", array('id' => 'reference-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Edit') . ' ' . lang('Meeting Reference'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-12"><?php
                        echo lang('Reference Meeting') . " : ";
                        if ($meeting->get_meeting_ref_id(true)->get_id()) {

                            $date = trim($meeting->get_meeting_ref_id(true)->get_date() . ' ' . $meeting->get_meeting_ref_id(true)->get_start_time());

                            echo $meeting->get_meeting_ref_id(true)->get_name() . ($date == '' ? '' : ' (' . $date . ')');
                        } else {
                            echo lang('No Meeting Reference');
                        }

                        ?></label>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-2" for="keyword"><?php echo lang('Keyword') ?></label>
                    <div class="col-sm-6">
                        <div class="input-group input-group-sm">
                            <input type="text" id="keyword" placeholder="<?php echo lang('Search') ?>" name="keyword"
                                   class="form-control" value="<?php echo $keyword ?>">
                            <span class="input-group-btn">
                                <button type="button" class="btn"
                                        data-loading-text="<span class='fa fa-spinner fa-spin'></span>"
                                        onclick="search(this);">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <button type="button" class="btn" id="clear"><?php echo lang('Clear Selection') ?></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row" id="search-tab">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-lg-1 text-center">#</th>
                            <th class="col-lg-3"><?php echo lang('Reference Name'); ?></th>
                            <th class="col-lg-3"><?php echo lang('Level'); ?></th>
                            <th class="col-lg-3"><?php echo lang('Date'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($meeting_objs as $meeting_obj) { ?>
                            <tr>
                                <td class="td last_column_border text-center">
                                    <input type="radio" id="meeting_id_<?php echo (int)$meeting_obj->get_id() ?>"
                                           name="meeting_id" value="<?php echo (int)$meeting_obj->get_id() ?>"
                                        <?php echo $meeting_obj->get_id() == $meeting->get_meeting_ref_id() ? 'checked = " checked " ' : '' ?> />
                                </td>
                                <td>
                                    <label
                                        for="meeting_id_<?php echo (int)$meeting_obj->get_id() ?>"><?php echo htmlfilter($meeting_obj->get_name()); ?></label>
                                </td>
                                <td>
                                    <label for="meeting_id_<?php echo (int)$meeting_obj->get_id() ?>">
                                        <?php
                                        echo htmlfilter($meeting_obj->get_level(true));
                                        if ($meeting_obj->get_level()) {
                                            echo "(" . htmlfilter($meeting_obj->get_level_title()) . ")";
                                        } ?>
                                    </label>
                                </td>
                                <td class="text-center valign-middle">
                                    <label
                                        for="meeting_id_<?php echo (int) $meeting_obj->get_id() ?>"><?php echo lang('Date').': &nbsp; '. htmlfilter($meeting->get_date()).'<br>'.lang('From').': &nbsp; '.htmlfilter($meeting->get_start_time()).' &nbsp; <br> '.lang('To').': &nbsp; '.htmlfilter($meeting->get_end_time()) ?>
                                    </label>
                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php echo $pager ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right "
                <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>


<script type="text/javascript">

    $('#reference-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    function search(btn) {
        $(btn).button('load');
        $.get('/meeting_minutes/reference_edit/<?php echo $meeting->get_id() ?>', {keyword: $('#keyword').val()})
            .done(function (msg) {
                $('#ajaxModalDialog').html(msg);
            });
    }

    $('#clear').click(function () {
        $('input[name="meeting_id"]').prop('checked', false);
    });

    $('#keyword').keydown(function (e) {
        if (e.which == 13) {
            $(this).parent().find('button').click();
//            search($(this).parent().find('button'));
            e.preventDefault();
        }
    });

</script>
