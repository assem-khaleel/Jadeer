<?php
/** @var $room Orm_Rm_Room_Management */
/** @var $equipments Orm_Rm_Equipment */
/** @var $room_equipment Orm_Rm_Room_Equipment */

$allEquipment = array();
for ($i=0 ;$i<count($room_equipment) ;$i++){
   $equ= $room_equipment[$i]->get_equipment_id();
    array_push($allEquipment, $equ);
}

?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open("room_management/equipment_save/{$room->get_id()}", array('id' => 'reference-form')); ?>
        <div class="modal-header">
            <span class="panel-title"><?php echo lang('Select') . ' ' . lang('Equipments'); ?></span>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="row">
                    <label class="control-label col-sm-2" for="keyword"><?php echo lang('Keyword') ?></label>
                    <div class="col-sm-6">
                        <div class="input-group input-group-sm">
                            <input type="text" id="keyword" placeholder="<?php echo lang('Search') ?>" name="keyword"
                                   class="form-control" value="<?php echo $filtersKeyword; ?>">
                            <span class="input-group-btn">
                                <button type="button" class="btn"
                                        data-loading-text="<span class='fa fa-spinner fa-spin'></span>"
                                        onclick="search(this);">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <button type="button" class="btn" id="clear"><?php echo lang('Clear Selection') ?></button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row" id="search-tab">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th class="col-lg-1 text-center">#</th>
                            <th class="col-lg-3"><?php echo lang('Equipment Title'); ?></th>
                            <th class="col-lg-3"><?php echo lang('Notes'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(count($equipments)){?>
                        <?php foreach ($equipments as $equipment) { ?>
                            <tr>
                                <td class="td last_column_border text-center">
                                    <input type="checkbox" name="equipment_id[]" data-id="equip_id" value="<?php echo (int)$equipment->get_id() ?>"
                                        <?php echo in_array($equipment->get_id(),$allEquipment) ? 'checked = " checked " ' : '' ?>/>
                                </td>
                                <td>
                                    <label for="equipment_id_<?php echo (int)$equipment->get_id() ?>"><?php echo htmlfilter($equipment->get_name()); ?></label>
                                </td>
                                <td class="text-center valign-middle">
                                    <label for="equipment_id_<?php echo (int)$equipment->get_id() ?>"><?php echo htmlfilter($equipment->get_additional()); ?></label>
                                </td>
                            </tr>
                        <?php } ?>
                        <?php }else{ ?>
                            <tr>
                                <td colspan="3">
                                    <div class="well well-sm m-a-0">
                                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Equipments'); ?></h3>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <?php  ?>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm pull-left " data-dismiss="modal">
                <span class="btn-label-icon left"><i class="fa fa-times"></i></span><?php echo lang('close'); ?>
            </button>
            <button type="submit" class="btn btn-sm pull-right "
                <?php echo data_loading_text() ?>>
                <span class="btn-label-icon left"><i class="fa fa-floppy-o"></i></span><?php echo lang('save'); ?>
            </button>
        </div>
        <input type="hidden" name="room_id" value="<?php echo intval($room->get_id());?>" />
        <?php echo form_close(); ?>
    </div>
</div>


<script type="text/javascript">

    $('#reference-form').on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.status) {
                window.location.reload();
            } else {
                $('#ajaxModalDialog').html(msg.html);
            }
        });
    });

    function search(btn) {
        $(btn).button('load');
        $.get('/room_management/manage/<?php echo $room->get_id()?>', {keyword: $('#keyword').val()})
            .done(function (msg) {
                $('#ajaxModalDialog').html(msg);
            });
    }

    $('#clear').click(function () {
        $('input').attr('data-id','equip_id').prop('checked', false);
    });

    $('#keyword').keydown(function (e) {
        if (e.which == 13) {
            $(this).parent().find('button').click();
//            search($(this).parent().find('button'));
            e.preventDefault();
        }
    });

</script>
