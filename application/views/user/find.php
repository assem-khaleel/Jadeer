<form method="GET" id="find-user">
    <input type="hidden" name="allow_change_types" value="<?php echo $this->input->get_post('allow_change_types') ?>">
    <input type="hidden" name="user_class" value="<?php echo $this->input->get_post('user_class') ?>">
    <input type="hidden" id="property_id" name="property_id"
           value="<?php echo $this->input->get_post('property_id') ?>">
    <input type="hidden" id="property_label" name="property_label"
           value="<?php echo $this->input->get_post('property_label'); ?>">

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
        <div class="panel-body p-a-1">
            <table class="table table-hover m-a-0">
                <thead>
                <tr>
                    <td style="width: 20px;">#</td>
                    <td><?php echo lang('Full Name'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) : /* @var $user Orm_User */ ?>
                    <tr onclick="select_option(<?php echo htmlfilter($user->get_id()); ?>);">
                        <td>
                            <input type="radio" id="id_<?php echo htmlfilter($user->get_id()); ?>" name="user_id"
                                   value="<?php echo htmlfilter($user->get_id()); ?>"
                                   label="<?php echo htmlfilter($user->get_full_name()); ?>">
                        </td>
                        <td>
                            <?php echo htmlfilter($user->get_full_name()); ?>
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
    function select_option(id) {
        var option = $('#id_' + id);

        option.prop('checked', true);

        var property_id = $('#property_id').val();
        var property_label = $('#property_label').val();

        parent.document.getElementById(property_id).value = option.val();
        parent.document.getElementById(property_label).value = option.attr('label');

        parent.find_onselect(option.val(), property_id, property_label);

        parent.document.getElementById('wrapper_' + property_id).remove();
    }
</script>