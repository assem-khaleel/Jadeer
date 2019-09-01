<?php
$this->load->helper('text');
?>

<div class="row">
    <h3 class="p-x-3 col-xs-12 col-md-7 col-lg-8" style="margin-top: 5px;"><?php echo lang($type); ?></h3>

    <div class="col-xs-12 col-md-5 col-lg-4">
        <form action="" method="GET" class="input-group">
            <input type="text" name="search" value="<?php echo isset($search) ? htmlfilter($search) : '' ?>" class="form-control" placeholder="<?php echo lang('Search')?>">
            <span class="input-group-btn">
                  <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                </span>
        </form>
    </div>
</div>

<div class="m-t-3 visible-xs visible-sm"></div>

<div class="panel">
    <div class="panel-body p-a-1 clearfix">
        <div class="btn-toolbar page-messages-wide-buttons pull-left" role="toolbar">
            <div class="btn-group">
                <div class="btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-check-square-o"></i>&nbsp;
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a id="select_all" href="#"><?php echo lang('Check All'); ?></a></li>
                        <li><a id="select_all_read" href="#"><?php echo lang('Check Read'); ?></a></li>
                        <li><a id="select_all_unread" href="#"><?php echo lang('Check Unread'); ?></a></li>
                        <li><a id="select_all_starred" href="#"><?php echo lang('Check Starred'); ?></a></li>
                        <li><a id="select_all_unstarred" href="#"><?php echo lang('Check Unstarred'); ?></a></li>
                        <li class="divider"></li>
                        <li><a id="unselect_all" href="#"><?php echo lang('Uncheck All'); ?></a></li>
                    </ul>
                </div>
                <button type="button" title="<?php echo lang('Reload'); ?>" onclick="location.reload();" class="btn">
                    <i class="fa fa-repeat"></i>
                </button>
            </div>

            <div class="btn-group">
                <?php if ($type == Orm_Thread::LIST_TYPE_TRASH) { ?>
                    <button type="button" id="do_recycle" title="<?php echo lang('Restore'); ?>" class="btn">
                        <i class="fa fa-recycle"></i>
                    </button>
                <?php } else { ?>
                    <button type="button" id="do_unread" title="<?php echo lang('Unread'); ?>" class="btn">
                        <i class="fa fa fa-file-text-o"></i>
                    </button>
                    <button type="button" id="do_important" title="<?php echo lang('Important'); ?>" class="btn">
                        <i class="fa fa-star"></i>
                    </button>
                    <button type="button" id="do_unimportant" title="<?php echo lang('Unimportant'); ?>" class="btn">
                        <i class="fa fa-star-o"></i>
                    </button>
                    <button type="button" id="do_trash" title="<?php echo lang('Delete'); ?>" class="btn">
                        <i class="fa fa-trash-o"></i>
                    </button>
                <?php } ?>
            </div>
        </div>

        <?php if ($total_count > $per_page) { ?>
            <div class="btn-toolbar pull-right" role="toolbar">
                <div class="btn-group">
                    <button type="button" <?php if ($page > 1) { ?>onclick="window.location = '<?php echo handle_url(array('page' => ($page - 1))); ?>';"<?php } ?> class="btn">
                        <i class="fa fa-chevron-left"></i>
                    </button>
                    <button type="button" <?php if (ceil($total_count / $per_page) > $page) { ?>onclick="window.location = '<?php echo handle_url(array('page' => ($page + 1))); ?>';"<?php } ?> class="btn">
                        <i class="fa fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            <div class="page-messages-pages pull-right p-r-1 text-muted">
                <?php echo((($page - 1) * $per_page) + 1) ?>-<?php echo min(($page * $per_page), $total_count) ?> of <?php echo $total_count ?>
            </div>
        <?php } ?>
    </div>

    <hr class="m-y-0">

    <div class="panel-body p-a-1 clearfix">
        <table class="page-messages-items table table-striped m-a-0">
            <tbody>
            <?php

            if (count($threads) == 0) {
                echo '<tr>&nbsp;</tr><tr>' . lang('No Messages') . '</tr>';
            }

            foreach ($threads as $thread) {
                /* @var $thread Orm_Thread */ ?>
                <tr>
                    <td class="page-messages-item-actions">
                        <label class="custom-control custom-checkbox custom-control-blank m-a-0 pull-xs-left">
                            <input type="checkbox" class="custom-control-input" value="<?php echo intval($thread->get_last_message_id()); ?>" name="message_ids[]">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <a href="/thread/star/<?php echo intval($thread->get_last_message_id()); ?>" class="pull-xs-left m-l-1 text-muted font-size-14">
                            <i class="fa fa-<?php echo(empty($thread->get_logged_participant()->get_is_important()) ? 'star-o' : 'star') ?>"></i>
                        </a>
                    </td>
                    <td>
                        <div class="box m-a-0 bg-transparent">
                            <a href="/thread/show/<?php echo $type; ?>/<?php echo intval($thread->get_last_message_id()); ?>" class="page-messages-item-from box-cell text-default">
                                <?php echo htmlfilter($thread->get_last_message_obj()->get_sender_obj()->get_full_name()); ?>
                            </a>
                            <div class="page-messages-item-subject box-cell">
                                <a href="/thread/show/<?php echo $type; ?>/<?php echo (int)$thread->get_last_message_id(); ?>" class="text-default <?php echo(empty($thread->get_last_message_obj()->get_logged_read_state()->get_id()) ? 'font-weight-bold' : ''); ?>">
                                    <?php echo htmlfilter($thread->get_last_message_obj()->get_subject()); ?>
                                </a>
                                <span style="font-weight: normal; font-size: 12px;"> - <?php echo character_limiter(xssfilter(strip_tags($thread->get_last_message_obj()->get_body())), 30); ?></span>
                            </div>
                            <div class="page-messages-item-date box-cell text-muted text-xs-right" style="width: 130px;">
                                <?php echo htmlfilter($thread->get_last_message_obj()->get_sent_date()); ?>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#select_all").click(function () {
            $("input:checkbox").prop('checked', true);
        });
        $("#select_all_read").click(function () {
            $("input:checkbox").prop('checked', false);
            $(".mail-list .read input:checkbox").prop('checked', true);
        });
        $("#select_all_unread").click(function () {
            $("input:checkbox").prop('checked', false);
            $(".mail-list .unread input:checkbox").prop('checked', true);
        });
        $("#select_all_starred").click(function () {
            $("input:checkbox").prop('checked', false);
            $(".mail-list .starred input:checkbox").prop('checked', true);
        });
        $("#select_all_unstarred").click(function () {
            $("input:checkbox").prop('checked', false);
            $(".mail-list .unstarred input:checkbox").prop('checked', true);
        });
        $("#unselect_all").click(function () {
            $("input:checkbox").prop('checked', false);
        });

        <?php if ($type == Orm_Thread::LIST_TYPE_TRASH) { ?>
        $('#do_recycle').click(function () {
            do_action('restore');
        });
        <?php } else { ?>
        $('#do_unread').click(function () {
            do_action('unread');
        });
        $('#do_important').click(function () {
            do_action('important');
        });
        $('#do_unimportant').click(function () {
            do_action('unimportant');
        });
        $('#do_trash').click(function () {
            do_action('trash');
        });
        <?php } ?>
    });

    function get_checked() {

        var checked = [];
        $("input:checkbox[name='message_ids[]']:checked").each(function () {
            checked.push({name: 'message_ids[]', value: $(this).val()});
        });

        if (config.csrf_protection) {
            checked.push({name: config.csrf_token_name, value: $.cookie(config.csrf_cookie_name)});
        }

        return checked;
    }

    function do_action(action) {
        $.ajax({
            type: "POST",
            url: "/thread/" + action,
            data: get_checked(),
            dataType: "json"
        }).done(function (msg) {
            window.location.reload();
        }).fail(function () {
            window.location.reload();
        });
    }
</script>
