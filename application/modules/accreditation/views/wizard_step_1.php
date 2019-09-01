<style>
    .bs-glyphicons-list {
        list-style: outside none none;
        padding-left: 0;
    }

    .bs-glyphicons li {
        border: 1px solid #fff;
        float: left;
        height: 150px;
        line-height: 1.4;
        padding: 10px;
        text-align: center;
        font-size: 12px;
        width: 117.5px;
        position: relative;
        cursor: pointer;
    }

    .bs-glyphicons li:hover {
        background-color: #563D7C;
        color: #fff;
    }

    .bs-glyphicons .glyphicon {
        font-size: 24px;
        margin-bottom: 10px;
        margin-top: 5px;
    }

    .bs-glyphicons .glyphicon-class {
        display: block;
        text-align: center;
        word-wrap: break-word;
    }

    .bs-glyphicons li input {
        bottom: 10px;
        left: 45px;
        position: absolute;
    }
</style>

<script>
    var url = '/accreditation/wizard_step_2';
</script>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <?php echo form_open('', 'id="create_system"'); ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title"><?php echo lang('Create').' '.lang('Wizard Step 1'); ?></h4>
        </div>
        <div class="modal-body p-a-0 p-b-1">

            <div class="form-group m-y-0">
                <div class="checkbox hidden"></div>
                <?php echo Validator::get_html_error_message('common_error'); ?>
            </div>

            <div class="bs-glyphicons">
                <ul class="bs-glyphicons-list">
                    <?php foreach ($systems as $system) : ?>
                        <?php echo $system->draw_system_node(); ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn pull-left"
                    data-dismiss="modal"><span class="btn-label-icon left fa fa-times"></span><?php echo lang('Close'); ?></button>
            <button type="submit" class="btn pull-right"
                    <?php echo data_loading_text() ?>><span class="btn-label-icon left fa fa-step-forward"></span><?php echo lang('Next'); ?></button>
            <div class="clearfix"></div>
        </div>
        <input type="hidden" name="type" value="<?php echo $type ?>"/>
        <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
</div> <!-- /.modal-dialog -->

<script type="text/javascript">
    init_data_toggle();
    $('#create_system').on('submit', function () {
        $.ajax({
            type: "POST",
            url: url,
            data: $(this).serialize()
        }).done(function (msg) {
            $('#ajaxModalDialog').html(msg);
        }).fail(function () {
            window.location.reload();
        });

        return false;
    });
</script>