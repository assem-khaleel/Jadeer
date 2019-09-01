<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 7/24/16
 * Time: 12:53 PM
 */
/** @var Orm_Backup $backup1 */

$params1 = $backup1->get_params();

$period = isset($params1['period']) ? $params1['period'] : '';
?>
<div class="col-md-9 col-lg-10">
    <?php echo form_open('/settings/backup', array('class' => 'form-horizontal', 'id' => 'backup-form')); ?>
    <div class="panel panel-primary panel-dark">
        <div class="panel-heading">
            <span class="panel-title"><?php echo lang('Backup'); ?></span>
        </div>
        <div class="panel-body">

            <div class="row form-group">
                <label class="col-sm-2 control-label"><?php echo lang('Duration'); ?></label>
                <div class="col-sm-10 " id="selector">
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-2 control-label"><?php echo lang('Path'); ?></label>
                <div class="col-sm-10 ">
                    <input type="text" name="path" class="form-control"
                           value="<?php echo isset($params1['path']) ? $params1['path'] : ''; ?>">
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <button class="btn"><?php echo lang('Save'); ?></button>
        </div>
    </div>
    <?php echo form_close(); ?>
    <script type="text/javascript" src="/assets/jadeer/js/jquery-gentleSelect-min.js"></script>
    <link type="text/css" href="/assets/jadeer/css/jquery-gentleSelect.css" rel="stylesheet"/>
    <script type="text/javascript" src="/assets/jadeer/js/jquery-cron-min.js"></script>
    <link type="text/css" href="/assets/jadeer/css/jquery-cron.css" rel="stylesheet"/>
    <script>
        var field = $('#selector').cron({
            useGentleSelect: true,
            onChange: function () {
                $('#period').text($(this).cron("value"));
            }
        });

        <?php if ($period) {
            echo "field.cron('value', '{$period}');";
        } ?>

        $('form#backup-form').submit(function (event) {
            event.preventDefault();
            var items = $(this).serialize() + "&period=" + field.cron('value');
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: items,
                dataType: 'JSON'
            }).done(function (msg) {
                window.location.reload();
            });
        });
    </script>
</div>
