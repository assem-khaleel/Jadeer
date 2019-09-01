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
                        <li><a id="unselect_all" href="#"><?php echo lang('Uncheck All'); ?></a></li>
                    </ul>
                </div>
                <button type="button" title="<?php echo lang('Reload'); ?>" onclick="location.reload();" class="btn">
                    <i class="fa fa-repeat"></i>
                </button>
            </div>

            <div class="btn-group">
                <a href="/thread/groups<?php echo !empty($my_groups) ? '/0' : '/1' ?>" title="<?php echo !empty($my_groups) ? lang('System Groups') : lang('My Groups'); ?>" class="btn btn-warning" style="width: auto;">
                    <?php echo !empty($my_groups) ? lang('System Groups') : lang('My Groups'); ?>
                </a>
                <?php if(!empty($my_groups)) { ?>
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

            if (count($groups) == 0) {
                echo '<tr>&nbsp;</tr><tr>' . lang('No Groups') . '</tr>';
            }

            foreach ($groups as $group) {
                /* @var $group Orm_Thread_Group */ ?>
                <tr>
                    <td class="page-messages-item-actions">
                        <label class="custom-control custom-checkbox custom-control-blank m-a-0 pull-xs-left">
                            <input type="checkbox" class="custom-control-input" value="<?php echo intval($group->get_id()); ?>" name="group_ids[]">
                            <span class="custom-control-indicator"></span>
                        </label>
                        <a class="pull-xs-left m-l-1 text-muted font-size-14">
                            <i class="fa fa-users"></i>
                        </a>
                    </td>
                    <td>
                        <div class="box m-a-0 bg-transparent">
                            <div class="page-messages-item-subject box-cell">
                                <?php if(is_null($group->get_object())) { ?>
                                    <a href="/thread/group_manage/<?php echo $group->get_id() ?>" class="text-default font-weight-bold" data-toggle="ajaxModal"><?php echo htmlfilter($group->get_group_name()); ?></a>
                                <?php } else { ?>
                                    <span class="text-default font-weight-bold"><?php echo htmlfilter($group->get_group_name()); ?></span>
                                <?php } ?>
                                <?php if(trim($group->get_group_desc())) { ?>
                                    <span style="font-weight: normal; font-size: 12px;"> - <?php echo character_limiter(htmlfilter(strip_tags($group->get_group_desc())), 30); ?></span>
                                <?php } ?>
                            </div>
                            <div class="page-messages-item-date box-cell text-muted text-xs-right" style="width: 130px;">
                                <?php
                                $members_count = intval($group->members_count());
                                echo $members_count . ' ' . (($members_count === 1) ? lang('Member') : lang('Members'))
                                ?>
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
        $("#unselect_all").click(function () {
            $("input:checkbox").prop('checked', false);
        });
        $('#do_trash').click(function () {
            do_action('group_delete');
        });
    });

    function get_checked() {

        var checked = [];
        $("input:checkbox[name='group_ids[]']:checked").each(function () {
            checked.push({name: 'group_ids[]', value: $(this).val()});
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