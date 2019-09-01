<?php
$inbox_count = Orm_Thread::get_count(array('type' => Orm_Thread::LIST_TYPE_INBOX, 'is_read' => false));
$important_count = Orm_Thread::get_count(array('type' => Orm_Thread::LIST_TYPE_IMPORTANT));
?>

<script>
    $('.page-mail .navigation li.active a').click(function (event) {
        if ($(window).width() < 992) {
            event.preventDefault();
        }
    });

    $('.page-mail .navigation li.active').click(function () {
        if ($('.page-mail .navigation').hasClass('open')) {
            $('.page-mail .navigation').removeClass('open');
        } else {
            $('.page-mail .navigation').addClass('open');
        }
    });
</script>

<style>

    /* Common styles */

    .box, .box-row, .box-cell {
        overflow: visible !important;
        -webkit-mask-image: none !important;
    }

    .page-messages-container > .box-row > .box-cell {
        display: block !important;
    }

    .page-messages-label {
        width: 8px;
        height: 8px;
        display: block;
        border-radius: 999px;
        float: left;
        margin-top: 6px;
        margin-right: 12px;
    }

    html[dir="rtl"] .page-messages-label {
        float: right;
        margin-left: 12px;
        margin-right: 0;
    }

    #page-messages-aside-nav {
        max-height: 0;
        overflow: hidden;
        -webkit-transition: max-height .3s;
        transition: max-height .3s;
    }

    #page-messages-aside-nav.show {
        max-height: 2000px;
    }

    @media (min-width: 768px) {
        .page-messages-container > .box-row > .box-cell {
            display: table-cell !important;
            padding-top: 15px;
        }

        .page-messages-aside {
            width: 200px;
        }

        .page-messages-content {
            padding-left: 20px;
        }

        html[dir="rtl"] .page-messages-content {
            padding-left: 0;
            padding-right: 20px;
        }

        #page-messages-aside-nav {
            max-height: none !important;
        }

        .page-messages-wide-buttons .btn {
            width: 60px;
        }
    }

    /* Special styles */

    .page-messages-pages {
        line-height: 31px;
    }

    .page-messages-items td {
        border: none !important;
        padding-top: 12px !important;
        padding-bottom: 12px !important;
    }

    .page-messages-item-actions {
        width: 60px;
    }

    .page-messages-item-from,
    .page-messages-item-subject {
        display: block;
    }

    .page-messages-item-date {
        display: block;
        position: absolute;
        right: 0;
        top: 0;
    }

    html[dir="rtl"] .page-messages-item-date {
        right: auto;
        left: 0;
    }

    @media (min-width: 768px) {
        .page-messages-item-from,
        .page-messages-item-subject {
            display: table-cell;
        }

        .page-messages-item-from {
            width: 140px;
        }

        .page-messages-item-date {
            display: table-cell;
            position: static;
            width: 80px;
        }
    }
</style>

<div class="page-messages-container box m-a-0 bg-transparent">
    <div class="box-row">
        <div class="page-messages-aside box-cell valign-top">
            <div class="clearfix">
                <div class="box-container">
                    <div class="box-row">
                        <div class="box-cell">
                            <?php if ($type == Orm_Thread::LIST_TYPE_GROUPS) { ?>
                                <a href="/thread/group_manage" data-toggle="ajaxModal" class="btn btn-block">
                                    <span class="btn-label-icon left fa fa-pencil-square-o"></span>
                                    <?php echo lang('New Group'); ?>
                                </a>
                            <?php } else { ?>
                                <a href="/thread/compose" data-toggle="ajaxModal" class="btn btn-block">
                                    <span class="btn-label-icon left fa fa-pencil-square-o"></span>
                                    <?php echo lang('New Email'); ?>
                                </a>
                            <?php } ?>
                        </div>
                        <div class="box-cell p-l-3 hidden-md hidden-lg hidden-xl" style="width: 60px;">
                            <button type="button" class="btn btn-block btn-outline btn-outline-colorless p-x-0" id="page-messages-aside-nav-toggle">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="m-t-3" id="page-messages-aside-nav">
                    <div class="list-group m-b-1">
                        <a href="/thread/items/<?php echo Orm_Thread::LIST_TYPE_INBOX ?>" class="list-group-item <?php if ($type == Orm_Thread::LIST_TYPE_INBOX) echo 'active'; ?>">
                            <i class="list-group-icon fa fa-inbox"></i>
                            <?php echo lang('Inbox') ?><?php if ($inbox_count) { ?>&ensp;<span class="label pull-right"><?php echo $inbox_count; ?></span><?php } ?>
                        </a>
                        <a href="/thread/items/<?php echo Orm_Thread::LIST_TYPE_IMPORTANT ?>" class="list-group-item <?php if ($type == Orm_Thread::LIST_TYPE_IMPORTANT) echo 'active'; ?>">
                            <i class="list-group-icon fa fa-star"></i>
                            <?php echo lang('Important') ?><?php if ($important_count) { ?>&ensp;<span class="label pull-right"><?php echo $important_count; ?></span><?php } ?>
                        </a>
                        <a href="/thread/items/<?php echo Orm_Thread::LIST_TYPE_SENT ?>" class="list-group-item <?php if ($type == Orm_Thread::LIST_TYPE_SENT) echo 'active'; ?>">
                            <i class="list-group-icon fa fa-envelope"></i>
                            <?php echo lang('Sent mail') ?>
                        </a>
                        <a href="/thread/items/<?php echo Orm_Thread::LIST_TYPE_TRASH ?>" class="list-group-item <?php if ($type == Orm_Thread::LIST_TYPE_TRASH) echo 'active'; ?>">
                            <i class="list-group-icon fa fa-trash-o"></i><?php echo lang('Trash') ?>
                        </a>
                        <a href="/thread/groups" class="list-group-item <?php if ($type == Orm_Thread::LIST_TYPE_GROUPS) echo 'active'; ?>">
                            <i class="list-group-icon fa fa-users"></i>
                            <?php echo lang('Groups') ?>
                        </a>
                    </div>
                    <div class="m-t-3 visible-xs visible-sm"></div>
                </div>
            </div>
        </div>

        <hr class="page-wide-block m-t-0 visible-xs visible-sm">

        <div class="page-messages-content box-cell valign-top">
            <?php $this->load->view($content_view); ?>
        </div>

    </div>
</div>