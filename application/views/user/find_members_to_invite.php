<form method="GET" id="find-user">
    <input type="hidden" name="allow_change_types" value="<?php echo $this->input->get_post('allow_change_types') ?>">
    <input type="hidden" name="user_class" value="<?php echo $this->input->get_post('user_class') ?>">
    <input type="hidden" id="property_id" name="property_id"
           value="<?php echo $this->input->get_post('property_id') ?>">
    <input type="hidden" id="property_label" name="property_label"
           value="<?php echo $this->input->get_post('property_label'); ?>">
    <input type="hidden" id="club_id" name="club_id"
           value="<?php echo $this->input->get_post('club_id'); ?>">

    <div class="panel m-a-0">
        <div class="panel-heading p-x-0">
            <div class="<?php echo $allow_change_types ? 'col-sm-5' : 'col-md-12' ?>">
                <div class="input-group input-group-sm">
                    <input type="text" placeholder="<?php echo lang('Keyword'); ?>" name="fltr[keyword]"
                           class="form-control"
                           value="<?php echo(isset($fltr['keyword']) ? htmlfilter($fltr['keyword']) : '') ?>"/>
                    <span class="input-group-btn"><button class="btn" type="submit"><span
                                class="fa fa-search"></span></button></span>
                </div>
            </div>
            <?php if ($allow_change_types) { ?>
                <ul class="nav nav-tabs nav-xs">
                    <?php foreach ($allowed_types as $allowed_type) { ?>
                        <li <?php echo($user_class == $allowed_type ? 'class="active"' : '') ?>>
                            <a href="<?php echo handle_url(array('user_class' => $allowed_type, 'allow_change_types' => $allow_change_types)) ?>">
                                <?php echo lang(str_replace('Orm_User_', '', $allowed_type)) ?>
                            </a>
                            <input type="hidden" name="allowed_types[]" value="<?php echo $allowed_type ?>">
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
        <a id="refresh_users" style="display: none;" href="<?php echo handle_url(array('user_class' => $user_class, 'allow_change_types' => $allow_change_types)) ?>">
        </a>
        <div class="panel-body p-a-1">
            <table class="table table-hover m-a-0">
                <thead>
                <tr>
                    <td><?php echo lang('Full Name'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) : /* @var $user Orm_User */ ?>
                    <tr>

                        <td style="width: 85%;">
                            <?php echo htmlfilter($user->get_full_name()); ?>
                        </td>
                        <td >
                            <input type="checkbox" id="id_<?php echo htmlfilter($user->get_id()); ?>" name="user_ids[]"
                                   value="<?php echo htmlfilter($user->get_id()); ?>"
                                   label="<?php echo htmlfilter($user->get_full_name()); ?>" style="display: none;">
                            <div style="cursor: pointer;"  onclick="select_option(<?php echo htmlfilter($user->get_id()); ?>);">
                                <a class = "btn btn-sm ">
                                    <span class="btn-label-icon left fa fa-plus"></span>
                                    <?php echo lang('Invite')?> </a>
                            </div>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php echo(isset($pager) ? '<div class="panel-footer p-y-0">' . $pager . '</div>' : ""); ?>
    </div>
</form>
<script>
    $(document).ready(function(){

    });
    function select_option(id) {
        $.ajax({
            type: "POST",
            url: "/team_formation/invite_user",
            data: {
                user_id : id,
                club_id : $('#club_id').val()
            },
        }).done(function (success) {
            var href = $('#refresh_users').attr('href');
            window.location.href = href;

        });
    }

</script>