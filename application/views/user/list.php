<?php
/** @var Orm_User[] $items */
/** @var string $pager */
$i = 0;
?>
<div class="col-md-9 col-lg-10">

    <div class="box p-a-1">
        <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>"
                type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false"
                aria-controls="filters">
            <span class="fa fa-filter"></span>
        </button>

        <?php echo lang('User List') ?>
    </div>

    <form class="form-horizontal">
        <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
            <div class="well">
                <?php

                echo Orm_User::draw_common_filters();

                switch ($class_type) {

                    case Orm_User::USER_FACULTY :
                        echo Orm_User_Faculty::draw_filters(true);
                        break;

                    case Orm_User::USER_STAFF :
                        echo Orm_User_Staff::draw_filters(true);
                        break;

                    case Orm_User::USER_STUDENT :
                        echo Orm_User_Student::draw_filters(true,false);
                        break;
                }
                ?>

                <div class="clearfix">
                    <a class="btn pull-left " href="<?php echo base_url('/user?type=' . $class_type) ?>">
                        <span class="btn-label-icon left">
                            <i class="fa fa-recycle"></i>
                        </span><?php echo lang('Reset'); ?>
                    </a>
                    <button class="btn pull-right " type="submit" <?php echo data_loading_text() ?>>
                        <span class="btn-label-icon left">
                            <i class="fa fa-filter"></i>
                        </span><?php echo lang('Filters'); ?>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <div class="table-primary table-responsive">
        <div class="table-header">
            <?php echo lang(str_replace('orm_user_', '', strtolower($class_type))); ?>
        </div>

        <?php if ($items): ?>
            <table class="table table-bordered">
                <thead>
                <tr class="titles_line">
                    <th class="col-md-1"><?php echo lang('Serial No.'); ?></th>
                    <th class="col-md-5"><?php echo lang('User Info'); ?></th>
                    <th class="col-md-4"><?php echo lang('User Personal Info'); ?></th>
                    <th class="col-md-2 text-center"><?php echo lang('Actions') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $key => $item) :
                    ?>
                    <tr class="tr <?php echo $key % 2 == 0 ? 'even' : 'odd'; ?>">
                        <td class="td first_column_border"><?php echo ++$i; ?></td>
                        <td class="td td_align_left">
                            <div><b><?php echo lang('Email') ?> :</b> <?php echo htmlfilter($item->get_email()) ?>
                            </div>
                            <div class="form-horizontal" style="margin-top:5px; font-size: 10px;">
                                <?php echo $item->draw_demographics() ?>
                            </div>
                        </td>
                        <td class="td td_align_left">
                            <div style="font-size: 10px;">
                                <div>&#187; <b><?php echo lang('Nationality') ?>
                                        :</b> <?php echo htmlfilter($item->get_nationality()); ?></div>
                                <div>&#187; <b><?php echo lang('Cell Phone') ?>
                                        :</b> <?php echo htmlfilter($item->get_phone()); ?></div>
                                <div>&#187; <b><?php echo lang('Fax No') ?>
                                        :</b> <?php echo htmlfilter($item->get_fax_no()); ?></div>
                                <div>&#187; <b><?php echo lang('Office No') ?>
                                        :</b> <?php echo htmlfilter($item->get_office_no()); ?></div>
                                <div>&#187; <b><?php echo lang('Address') ?>
                                        :</b> <?php echo htmlfilter($item->get_address()); ?></div>
                            </div>
                        </td>

                        <td class="td last_column_border text-center">
                            <?php if($item->get_is_active() == 1){  ?>

                                <?php if (Orm_User::check_credential(array(Orm_User::USER_STAFF), false, 'settings-login_as')) { ?>
                                    <a class="btn btn-sm btn-block"
                                       href="/user/login_as_user/<?php echo urlencode($item->get_id()); ?>"><span
                                                class="btn-label-icon left"><i
                                                    class="fa fa-key"></i></span> <?php echo lang('Login as'); ?></a>
                                <?php } ?>
                                <a class="btn btn-sm btn-block"
                                   href="/user/create_edit?id=<?php echo urlencode($item->get_id()); ?>&type=<?php echo urlencode($item->get_class_type()); ?>"><span
                                            class="btn-label-icon left"><i
                                                class="fa fa-edit"></i></span> <?php echo lang('Edit'); ?></a>

                                <a class="btn btn-sm btn-block" data-toggle="deleteAction" message="<?php echo lang('Are you sure You want to Inactive this user?') ?>"
                                   href="/user/inactivate/<?php echo urlencode($item->get_id()); ?>"><span
                                            class="btn-label-icon left"><i
                                                class="fa fa-remove"></i></span> <?php echo lang('Inactivate'); ?></a>

                            <?php }else{ ?>

                                <a class="btn btn-sm btn-block" data-toggle="deleteAction" message="<?php echo lang('Are you sure You want to active this user?') ?>"
                                   href="/user/activate/<?php echo urlencode($item->get_id()); ?>"><span
                                            class="btn-label-icon left"><i
                                                class="fa fa-undo"></i></span> <?php echo lang('Activate'); ?></a>
                            <?php } ?>

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
            <div class="alert alert-default"><?php echo lang('There are no') . ' ' . lang('Users'); ?>
                <div style="font-size:12px; margin-top:6px;">
                    <a href="/user/create_edit?type=<?php echo urlencode($class_type); ?>"><?php echo lang('Create').' '.lang('User'); ?></a>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
