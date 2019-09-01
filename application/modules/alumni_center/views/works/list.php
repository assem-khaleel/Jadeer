<?php
/** @var $items Orm_Alumni_Work[]  */
/** @var string $pager */
/** @var $user Orm_user */
$i = 0;
?>
<div class="table-primary" >
    <div class="table-header">
        <span class="table-caption">
            <?php echo lang('Alumni works') ?>
        </span>
        <div class="panel-heading-controls col-sm-4">
            <form>
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" name="ftr[name]" placeholder="<?php echo lang('search'); ?>" value="<?php echo !empty($filters['name']) ? htmlfilter($filters['name']) : '' ?>" />
                    <span class="input-group-btn">
                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <?php if ($items) : ?>
        <table class="table table-bordered">
            <thead>
            <tr class="titles_line">
                <th class="col-md-1"></th>
                <th class="th"><?php echo lang('Employer'); ?></th>
                <th class="th"><?php echo lang('Alumni'); ?></th>
                <th class="th"><?php echo lang('Position'); ?></th>
                <th class="th"><?php echo lang('Start date'); ?></th>
                <th class="th"><?php echo lang('End date'); ?></th>
                <?php if ($user->get_class_type() == Orm_User::USER_ALUMNI): ?>
                    <th class="th last_column_border"><?php echo lang('action(s)') ?></th>
                <?php endif; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $key => $item) : ?>
                <tr class="tr <?php ($key % 2 == 0 ? print 'even' : print 'odd'); ?>">

                    <td class="td first_column_border first_column_border"><?php echo ++$i; ?></td>
                    <td class="td"><?php echo htmlfilter($item->get_employer_obj()->get_full_name()); ?></td>
                    <td class="td"><?php echo htmlfilter($item->get_alumni_obj()->get_full_name()); ?></td>
                    <td class="td"><?php echo htmlfilter($item->get_position()); ?></td>
                    <td class="td"><?php echo htmlfilter(date('Y-m-d', $item->get_start_date())); ?></td>
                    <td class="td"><?php echo htmlfilter(date('Y-m-d', $item->get_end_date())); ?></td>
                    <?php if ($user->get_class_type() == Orm_User::USER_ALUMNI): ?>
                        <td class="td last_column_border">
                            <a class="btn btn-block" href="/alumni_center/works/create_edit?id=<?php echo urlencode($item->get_id()); ?>&user_id=<?php echo (int) $user->get_id(); ?>"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a> |
                            <a class="btn btn-block" href="/alumni_center/works/delete?id=<?php echo urlencode($item->get_id()); ?>&user_id=<?php echo (int) $user->get_id(); ?>" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"><span class="btn-label-icon left fa fa-trash-o"></span> <?php echo lang('Delete') ?></a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($pager) { ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php } ?>
    <?php else : ?>
        <div class="list-group-item">
            <?php echo lang('There are no') . ' ' . lang('Works'); ?>
            <?php if ($user->get_class_type() == Orm_User::USER_ALUMNI) { ?>
                <a href="/alumni_center/works/create_edit?user_id=<?php echo (int) $user->get_id(); ?>"><?php echo lang('Add').' '.lang('New Works'); ?></a>
            <?php } ?>
        </div>
    <?php endif; ?>
</div>

<script type="text/javascript">
    function after_delete_action(element, msg) {
        window.location.reload();
    }
</script>