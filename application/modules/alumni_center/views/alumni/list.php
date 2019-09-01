<?php
/** @var Orm_User[] $items */
/** @var string $class_type */
/* @var $pager string  */
$i = 0;
?>

<div class="box p-a-1">
    <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>" type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false" aria-controls="filters">
        <span class="fa fa-filter"></span>
    </button>

    <?php echo lang('User List') ?>
</div>

<?php echo form_open('', array('class'=>"form-horizontal")); ?>
    <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
        <div class="well">
            <?php
            switch ($class_type) {

                case Orm_User::USER_ALUMNI :
                    echo Orm_User_Alumni::draw_filters();
                    break;

                case Orm_User::USER_EMPLOYER :
                    echo Orm_User_Employer::draw_filters();
                    break;
            }
            ?>

            <div class="clearfix">
                <a class="btn pull-left" href="<?php echo($this->input->server('REQUEST_URI')) ?>"><span class="btn-label-icon left fa fa-recycle"></span><?php echo lang('Reset'); ?></a>
                <button class="btn pull-right" type="submit"><span class="btn-label-icon left fa fa-filter"></span><?php echo lang('Filters'); ?></button>
            </div>
        </div>
    </div>
<?php echo form_close() ?>

<div class="table-primary table-responsive">
    <div class="table-header">
        <?php echo lang(str_replace('orm_user_', '', strtolower($class_type))); ?>
    </div>

    <?php if ($items): ?>
        <table class="table table-bordered">
            <thead>
                <tr class="titles_line">
                    <th class="col-md-1"><?php echo lang('Serial No.'); ?></th>
                    <th class="col-md-4"><?php echo lang('User Info'); ?></th>
                    <th class="col-md-3"><?php echo lang('User Personal Info'); ?></th>
                    <th class="col-md-4 text-center"><?php echo lang('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $key => $item) : ?>
                    <tr class="tr <?php echo $key % 2 == 0 ? 'even' : 'odd'; ?>">
                        <td class="td first_column_border"><?php echo ++$i; ?></td>
                        <td class="td td_align_left">
                            <div><b><?php echo lang('Email') ?> :</b> <?php echo htmlfilter($item->get_email()) ?></div>
                            <div class=" form-horizontal m-t-1" style="font-size: 10px;">
                                <?php echo $item->draw_demographics() ?>
                            </div>
                        </td>
                        <td class="td td_align_left">
                            <div style="font-size: 10px;">
                                <div>&#187; <b><?php echo lang('Nationality') ?> :</b> <?php echo htmlfilter($item->get_nationality()); ?></div>
                                <div>&#187; <b><?php echo lang('Cell Phone') ?> :</b> <?php echo htmlfilter($item->get_phone()); ?></div>
                                <div>&#187; <b><?php echo lang('Fax No') ?> :</b> <?php echo htmlfilter($item->get_fax_no()); ?></div>
                                <div>&#187; <b><?php echo lang('Office No') ?> :</b> <?php echo htmlfilter($item->get_office_no()); ?></div>
                                <div>&#187; <b><?php echo lang('Address') ?> :</b> <?php echo htmlfilter($item->get_address()); ?></div>
                            </div>
                        </td>

                        <td class="td last_column_border text-center">
                            <a class="btn btn-block" href="/alumni_center/create_edit?id=<?php echo urlencode($item->get_id()); ?>&type=<?php echo urlencode($item->get_class_type()); ?>"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                            <a class="btn btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction" href="/alumni_center/delete/<?php echo urlencode($item->get_id()); ?>"><span class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ($pager) { ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php } ?>

    <?php else: ?>
        <div class="alert alert-default"><?php echo lang('There are no') . ' ' . ($class_type == Orm_User::USER_ALUMNI ? lang('Alumni') : lang('Employers')); ?>
            <div class="m-t-1" style="font-size:12px;">
                <a href="/alumni_center/create_edit?type=<?php echo urlencode($class_type); ?>"><?php echo lang('Add').' '.lang('New') . ' ' . ($class_type == Orm_User::USER_ALUMNI ? lang('Alumni') : lang('Employers')); ?></a>
            </div>
        </div>
    <?php endif; ?>
</div>