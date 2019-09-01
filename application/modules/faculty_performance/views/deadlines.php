
<div class="alert">

    <span class=" text-size-50 font-weight-bold"><?php echo lang('Note').': '?></span>
    <span class="text-size-16">
       <?php echo lang('Between any two different deadlines must be one day')?>
    </span>

</div>

<table class="table table-bordered">
    <tr>
        <th><?php echo lang('Start Date')?></th>
        <th><?php echo lang('End Date')?></th>
        <th><?php echo lang('Created At')?></th>
        <th><?php echo lang('Actions')?></th>
    </tr>
    <?php
    /** @var Orm_Fp_Forms_Deadline $deadline*/
    foreach ($deadlines as $deadline){
        ?>
        <tr data-id="<?php echo $deadline->get_id()?>">
            <td><?php echo htmlfilter(date('Y-m-d',strtotime($deadline->get_start_date()))) ?></td>
            <td><?php echo htmlfilter(date('Y-m-d',strtotime($deadline->get_end_date()))) ?></td>
            <td><?php echo htmlfilter(date('Y-m-d',strtotime($deadline->get_created_at())))?></td>
            <td>
                <a  class="btn btn-sm btn-block edit" title="<?php echo lang('Edit') ?>">
                    <span class="btn-label-icon left fa fa-edit" aria-hidden="true"></span>
                    <?php echo lang('Edit') ?>
                </a>
                <?php if($deadline->get_id() != Orm_Fp_Forms_Deadline::get_current_deadline()){  ?>
                <a href="/faculty_performance/faculty_settings/delete/<?php echo (int)$deadline->get_id(); ?>" class="btn btn-sm btn-block" title="<?php echo lang('Delete') ?>" data-toggle="deleteAction" message="<?php echo lang('Are you sure ?')?>">
                    <span class="btn-label-icon left fa fa-trash-o" aria-hidden="true"></span>
                    <?php echo lang('Delete') ?>
                </a>
                <?php }?>
            </td>
        </tr>
    <?php }?>
    <?php if (count($deadlines)==0){?>
    <tr>
        <td colspan="4" align="center"><?php echo lang('No data') ?></td>
        <?php }?>
</table>


<div id="deadline_modal"  class="modal fade in" tabindex="-1" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sx animated fadeIn">
        <form id="deadline_form">
            <div class="modal-content">
                <?php echo form_open("/faculty_performance/save", array('id' => 'static-form')); ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title"><?php echo  lang('Deadline') ?></h4>
                </div>
                <div class="padding-sm-hr">
                    <div class="modal-body">
                        <div class="input-group input-daterange">
                            <input id="start_date" class="form-control date-picker"  name="start_date"/>
                            <?php echo Validator::get_html_error_message('start_date'); ?>
                            <div class="input-group-addon">to</div>
                            <input id="end_date" class="form-control date-picker" name="end_date"/>
                            <?php echo Validator::get_html_error_message('end_date'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hidden alert alert-danger text-left"  id="error_message">
                    </div>
                    <div class="row form-group">
                        <div class=" text-right">
                            <input name="save" type="submit" class="btn editbtn" value="<?php echo  lang('Save') ?>" />
                            <button type="button" id="close" class="btn delbtn" data-dismiss="modal" aria-hidden="true"><?php echo  lang('Cancel') ?></button>
                        </div>
                    </div>
                </div>
                <input name="process" type="hidden" value="add">
                <input name="id" id="id" type="hidden" value="add">
                <?php echo form_close()?>
            </div>
        </form>
    </div>
</div>

<script>
    $('#deadline_form').on('submit', function (e) {
        var formData=$(this).serialize();
        $.ajax({
            type: "POST",
            url: '/faculty_performance/faculty_settings/save',
            data: formData,
            dataType: 'JSON'
        }).done(function (msg) {
            if (msg.success) {
                window.location.reload();
            } else {
                $('#error_message').html(msg.html).removeClass('hidden');
            }
        }).fail(function () {
            window.location.reload();
        });
        return false;
    });
    $(".edit").off().click(function () {
        var date = new Date();
        date.setDate(date.getDate());
        $(".date-picker").datepicker({format: 'yyyy-mm-dd',startDate: date, autoclose: true});
        var tr=$(this).parent().parent(),
            td=  tr.find('td');
        $('#id').val(tr.attr('data-id'));

        $('[name="process"]').val('edit');
//        $('#start_date').datepicker('setDate',td.eq(0).html());
        $('#start_date').val(td.eq(0).html()).datepicker('setDate',td.eq(0).html());
        $('#end_date').val(td.eq(1).html()).datepicker('setDate',td.eq(1).html());
//        $('#end_date').datepicker('setDate',td.eq(1).html());

        $("#deadline_modal").modal('show');
    });
    $("#new_deadline").off().click(function () {
        var date = new Date();
        date.setDate(date.getDate());

        $(".date-picker").datepicker({format: 'yyyy-mm-dd', startDate: date, autoclose: true});

        $('#id').val(0);
        $('[name="process"]').val('add');
        $("#deadline_modal").modal('show');
    });

        $('#deadline_modal').on('hidden.bs.modal', function () {
            $(".date-picker").datepicker( "destroy" );
            $('#start_date').val('');
            $('#end_date').val('');
            $("#error_message").addClass('hidden');
            $("#deadline_modal").modal('hide');
        });


</script>
