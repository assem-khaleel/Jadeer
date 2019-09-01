<?php
/** @var $rooms Orm_Rm_Room_Management[] */
$college_id = isset($fltr['college_id']) ? $fltr['college_id'] : 0;
$program_id = isset($fltr['program_id']) ? $fltr['program_id'] : 0;
?>
<?php if (empty($rooms)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') .' ' . lang('Data to be displayed.'); ?>
        </div>
        <a href="/room_management/create_edit" data-toggle="ajaxModal" class="btn  btn-block" >
            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add'); ?>
        </a>
    </div>
<?php } else { ?>
    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-3">
                    <?php echo lang('Room Information') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Room Equipments') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Room Type') ?>
                </th>
                <th class="col-md-3">
                    <?php echo lang('College') ?>
                </th>
                <th class="col-md-2">
                    <?php echo lang('Action') ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($rooms as $room) : ?>
                <tr>
                    <td>
                        <b><?php echo lang('Room Title'); ?>:</b>
                   <span style="word-break: break-all"  title="<?php echo   htmlfilter($room->get_name())?>">
                        <?php echo count_chars($room->get_name()) > 250 ? htmlfilter(substr($room->get_name(),0,50)).'...' : htmlfilter($room->get_name())?>
                   </span>
                        <br>
                        <b><?php echo lang('Room Number'); ?>:</b>
                        <?php echo htmlfilter($room->get_room_number())?>
                    </td>

                    <td>
                        <?php if(Orm_Rm_Room_Equipment::get_count(array('room_id'=>$room->get_id()))){  ?>
                            <ul>
                                <?php foreach (Orm_Rm_Room_Equipment::get_all(array('room_id'=>$room->get_id())) as $equipment): ?>
                                    <li>
                                        <?php echo htmlfilter(Orm_Rm_Equipment::get_instance($equipment->get_equipment_id())->get_name())?>
                                    </li>
                                <?php endforeach;?>
                            </ul>
                        <?php }else{?>
                            <?php echo lang('No equipments') ?>
                        <?php } ?>

                    </td>
                    <td><?php echo htmlfilter(lang($room->get_room_type(true)))?></td>
                    <td>
                        <?php $college=Orm_College::get_instance($room->get_college_id()); echo htmlfilter($college->get_name())?>
                    </td>
                    <td>
                        <?php if($room->check_if_can_edit()){?>
                            <a href="/room_management/create_edit/<?php echo $room->get_id(); ?>"
                               data-toggle="ajaxModal" class="btn btn-sm btn-block" >
                                <span class="btn-label-icon left icon fa fa-pencil-square-o" aria-hidden="true"></span>
                                <?php echo lang('Edit') ?>
                            </a>
                            <a href="/room_management/delete/<?php echo $room->get_id(); ?>"
                               class="btn btn-sm  btn-block" title="Delete"  message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction">
                                <span class="btn-label-icon left icon fa fa-trash-o" aria-hidden="true"></span>
                                <?php echo lang('Delete') ?>
                            </a>
                            <a href="/room_management/manage/<?php echo $room->get_id(); ?>"
                               data-toggle="ajaxModal" class="btn btn-sm  btn-block" title="Manage">
                                <span class="btn-label-icon left fa fa-gear" aria-hidden="true"></span>
                                <?php echo lang('Manage') ?>
                            </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>
<?php } ?>