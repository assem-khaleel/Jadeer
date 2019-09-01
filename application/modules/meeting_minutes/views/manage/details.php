<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 3/6/17
 * Time: 3:36 PM
 *
 * @var Orm_Mm_Meeting $meeting
 *
 */
?>
<div class="well">
    <?php if ($meeting->check_if_can_edit()) { ?>
        <div class="row">
            <div class="col-sm-offset-10 col-sm-2 m-b-2">
                <a href="/meeting_minutes/add_edit/<?php echo $meeting->get_id() ?>" data-toggle="ajaxModal"
                   class="btn btn-primary btn-block">
                    <span class="btn-label-icon left fa fa-edit"></span><?php echo lang('Edit'); ?>
                </a>
            </div>
        </div>
    <?php } ?>

    <div class="row list-group-demo">
        <div class="col-sm-12">
            <ul class="list-group form-horizontal">
                <?php if (!$meeting->can_edit()): ?>
                    <li class="list-group-item">
                        <div class="row">
                            <label
                                class="col-sm-12">* <?php echo lang('This meeting has done. you cannot edit anymore') ?></label>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="list-group-item">
                    <div class="row">
                        <label class="col-sm-2"><?php echo lang('Meeting Subject') ?>: </label>
                        <div class="col-sm-10"><?php echo lang($meeting->get_name()) ?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <label class="col-sm-2"><?php echo lang('Coordinator') ?>: </label>
                        <div class="col-sm-10"><?php echo $meeting->get_facilitator_id(true)->get_full_name() ?></div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <label class="col-sm-2"><?php echo lang('Type') ?></label>
                        <div class="col-sm-10">
                            <?php echo lang(htmlfilter(Orm_Mm_Meeting_Individual::get_type($meeting->get_type_class()))); ?>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2"><?php echo lang('Level') ?></label>
                        <div class="col-sm-10"><?php
                            echo $meeting->get_level(true);
                            if ($meeting->get_level()) {
                                echo " ({$meeting->get_level_title()})";
                            }
                            ?></div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2"><?php echo lang('Date') ?></label>
                        <div
                            class="col-sm-10"><?php echo $meeting->get_date() . ' &nbsp; ' . $meeting->get_start_time() ?></div>
                    </div>
                    <?php if (Orm_Mm_Meeting::need_room()) { ?>
                        <div class="row">
                            <label class="col-sm-2"><?php echo lang('Location') ?></label>

                            <div class="col-sm-10">
                                <?php
                                $location = Orm_Rm_Room_Management::get_instance($meeting->get_room_id());
                                ?>
                                <b><?php echo lang('Room'); ?>:</b>
                                <?php echo htmlfilter($location->get_name()); ?>
                                <br>
                                <b><?php echo lang('Room Number'); ?>:</b>
                                <?php echo htmlfilter($location->get_room_number()); ?>
                                <br>
                                <b><?php echo lang('College'); ?>:</b>
                                <?php echo htmlfilter($location->get_college_obj()->get_name()); ?>
                            </div>
                        </div>
                    <?php } ?>
                </li>
                <?php if ($meeting->get_type_class() == 'Orm_Mm_Meeting_Committee') { ?>
                    <li class="list-group-item">

                        <div class="row">
                            <label class="col-sm-2"><?php echo lang('Committee Information') ?></label>

                            <div class="col-sm-10">
                                <?php
                                ?>
                                <b><?php echo lang('Name'); ?>:</b>
                                <?php echo htmlfilter($meeting->get_type_title()); ?>
                                <br>
                                <b><?php echo lang('Level'); ?>:</b>
                                <?php echo htmlfilter($meeting->get_type_info()->get_current_type()); ?>
                                <?php if ($meeting->get_type_info()->get_current_type_id_title()) {
                                    echo " : (" . htmlfilter($meeting->get_type_info()->get_current_type_id_title()) . ")";
                                } ?>

                                <br>
                                <b><?php echo lang('Members'); ?>:</b>
                                <?php foreach ($meeting->get_type_memebers() as $memeber): ?>
                                    <ul>
                                        <li>
                                            <?php echo  Orm_User::get_instance($memeber->get_user_id())->get_full_name()?>
                                        </li>
                                    </ul>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>