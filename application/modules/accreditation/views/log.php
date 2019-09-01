<?php
/* @var $node Orm_Node */
$id_perfix = 'node_';
?>
<div class="modal-dialog" style="width: 90%;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><i class="fa fa-history"></i>&ensp;<?php echo lang('Logs'); ?></h4>
            <br>
            <h5 class="modal-title"><?php echo htmlfilter($node->get_name()); ?></h5>
        </div>
        <div class="modal-body">

            <table class="table">
                <thead>
                <tr>
                    <th class="col-md-2"><?php echo lang('Date'); ?></th>
                    <th class="col-md-8"><?php echo lang('User'); ?></th>
                    <th class="col-md-2"><?php echo lang('Actions'); ?></th>
                </tr>
                </thead>
            </table>

            <div id="perfect-scrollbar-scroll-y" style="position: relative; height: 200px;">
                <table class="table table-striped">
                    <?php foreach ($logs as $log) : /* @var $log Orm_Node_Log */ ?>
                        <tr>
                            <td class="col-md-2"><?php echo htmlfilter($log->get_date_added()); ?></td>
                            <td class="col-md-8"><?php echo htmlfilter($log->get_user_obj()->get_full_name()); ?></td>
                            <td class="col-md-2">
                                <a href="javascript:void(0);" onclick="get_log_node(<?php echo (int)$log->get_id(); ?>);">
                                    <?php echo lang('Show'); ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title"><?php echo lang('Log'); ?> <span id="history_title"></span></span>
                            <div class="panel-heading-controls">
                                <button id="apply" <?php echo data_loading_text() ?> class="btn btn-xs btn-success btn-outline btn-outline-colorless" disabled="disabled">
                                    <span class='btn-label-icon left'><i class='fa fa-check'></i></span> <?php echo lang('Apply'); ?>
                                </button>
                            </div>
                        </div>
                        <div class="panel-body" id="history_node"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading"><span class="panel-title"><?php echo lang('Current'); ?></span></div>
                        <div class="panel-body" id="current_node"><?php echo $node->draw_properties(); ?></div>
                    </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn" data-dismiss="modal">
                <span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?>
            </button>
        </div>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->
<script type="text/javascript">
    init_data_toggle();

    $(function() {
        $('#perfect-scrollbar-scroll-y').perfectScrollbar({
            suppressScrollX: true
        });

        $('#apply').on('click', function (e) {
            e.preventDefault();

            var log_id = $(this).attr('node_log_id');

            $.ajax({
                type: "POST",
                url: "/accreditation/apply_node_log",
                data: {log_id: log_id},
                dataType: "json"
            }).done(function (msg) {
                window.location.reload();
            }).fail(function () {
                window.location.reload();
            });
        });

        $(window).on('resize', function() {
            $('#perfect-scrollbar-scroll-y').perfectScrollbar('update');
        });
    });

    function get_log_node(log_id) {

        tinymce.remove("#history_node textarea");
        $("#history_node").html('<i class="fa fa-spinner fa-spin"></i> <?php echo lang('Loading'); ?>');

        $.ajax({
            type: "POST",
            url: "/accreditation/get_node_log",
            data: {log_id: log_id},
            dataType: "json"
        }).done(function (msg) {
            $("#history_node").html(msg.html);
            $("#history_title").html('( ' + msg.title + ' )');
            $('#apply').removeAttr('disabled').attr('node_log_id', log_id);
        }).fail(function () {
            window.location.reload();
        });
    }
</script>