<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 7/18/17
 * Time: 12:29 PM
 */
?>
<?php
/** @var $rooms Orm_Rm_Room_Management[] */
?>

<div id="search-tab">
    <?php if ($viewRooms == 1) { ?>

        <div class="form-group">
            <div class="row">

                <label class="control-label col-sm-3" for="keyword"><?php echo lang('Search') ?></label>
                <div class="col-sm-7">
                    <input type="text" id="keyword" placeholder="<?php echo lang('Search') ?>" name="keyword"
                           class="form-control" value="<?php ?>">
                </div>
                <div class="col-sm-2">
                    <button type="button" class="btn btn-block"
                            data-loading-text="<span class='fa fa-spinner fa-spin'></span>"
                            onclick="search(this);">
                        <?php echo lang('Search') ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="table-responsive m-a-0">
                  <table class="table table-bordered">
                      <thead>
                      <tr>
                          <th class="col-lg-1 text-center">#</th>
                          <th class="col-lg-3"><?php echo lang('Room Information') ?></th>
                          <th class="col-lg-3"><?php echo lang('Room Equipments') ?></th>
                          <th class="col-lg-2"><?php echo lang('Room Type'); ?></th>
                          <th class="col-lg-3"><?php echo lang('College'); ?></th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      if (!empty($rooms)) {
                          foreach ($rooms as $room) { ?>
                              <tr>
                                  <td class="td last_column_border">
                                      <input type="radio" name="room_id" value="<?php echo (int)$room->get_id() ?>"
                                          <?php echo  ($room->get_id() == $current_room_id) ? 'checked = "checked" ' : '' ?>/>

                                  </td>
                                  <td>
                                      <label for="room_id_<?php echo (int)$room->get_id() ?>">
                                          <b><?php echo lang('Room Name'); ?>:</b>
                                       <span style="word-break: break-all"  title="<?php echo   htmlfilter($room->get_name())?>">
                                           <?php echo count_chars($room->get_name()) > 250 ? htmlfilter(substr($room->get_name(), 0, 50)). '...' : htmlfilter($room->get_name()) ?>
                                       </span>
                                          <br>
                                          <b><?php echo lang('Room Number'); ?>:</b>
                                          <?php echo htmlfilter($room->get_room_number()) ?>
                                      </label>
                                  </td>
                                  <td>
                                      <label for="room_id_<?php echo (int)$room->get_id() ?>">
                                          <?php if (Orm_Rm_Room_Equipment::get_count(array('room_id' => $room->get_id()))) { ?>
                                              <ul>
                                                  <?php foreach (Orm_Rm_Room_Equipment::get_all(array('room_id' => $room->get_id())) as $equipment): ?>
                                                      <li>
                                                          <?php echo htmlfilter(Orm_Rm_Equipment::get_instance($equipment->get_equipment_id())->get_name()) ?>
                                                      </li>
                                                  <?php endforeach; ?>
                                              </ul>
                                          <?php } else { ?>
                                              <?php echo lang('No equipments') ?>
                                          <?php } ?>
                                      </label>
                                  </td>
                                  <td>
                                      <?php echo lang($room->get_room_type(true)) ?>
                                  </td>

                                  <td>
                                      <label
                                          for="room_id_<?php echo (int)$room->get_id() ?>"><?php $college = Orm_College::get_instance($room->get_college_id());
                                          echo htmlfilter($college->get_name()) ?></label>
                                  </td>
                              </tr>
                          <?php }
                      } else {
                          ?>
                          <div class="alert alert-default">
                              <div class="m-b-1">
                                  <?php echo lang('There are no').' '.lang('room please go to room management and add one'); ?>
                              </div>
                          </div>
                      <?php } ?>
                      </tbody>
                  </table>
              </div>
            <?php if($pager) { ?>
                    <?php echo $pager ?>
            <?php } ?>
        </div>
        </div>
    <?php } else { ?>

        <div class="form-group">
            <div class="row">
                <div class="form-message validation-error-no-arrow">
                    <?php echo isset($error['date']) ? ($error['date']) : ''; ?>
                    <?php echo isset($error['start_time']) ? ($error['start_time']) : ''; ?>
                    <?php echo isset($error['end_time']) ? ($error['end_time']) : ''; ?>
                </div>
            </div>
        </div>
    <?php } ?>

</div>


<script>
    init_data_toggle();
    $(".form-message").parents(".form-group").addClass("form-message-light has-error");
</script>

