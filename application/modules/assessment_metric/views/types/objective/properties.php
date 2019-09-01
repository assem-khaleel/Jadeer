<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/11/17
 * Time: 1:24 PM
 *
 * @var $assessment_metric Orm_Am_Assessment_Metric
 *
 */
?>
<div class="row form-group">
    <label class="col-sm-3 control-label"></label>
    <div class="col-sm-9">
        <button type="button" onclick="refresh_objectives(this)" class="btn btn-sm pull-right " data-loading-text="<span class='btn-label-icon left'><i class='fa fa-spinner fa-spin'></i></span> <?php echo lang('Loading') ?>">
            <span class="btn-label-icon left"><i class="fa fa-refresh"></i></span><?php echo lang('Refresh') ?>
        </button>
    </div>
</div>

<div class="table-primary m-a-0">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Objectives Result') ?></span>
    </div>
    <table class="table table-striped m-a-0" id="objectives_result">
        <?php echo $assessment_metric->ajax() ; ?>
    </table>
</div>

<script>
    function refresh_objectives(btn) {
        $.ajax({
            type: "POST",
            url: '/assessment_metric/ajax',
            data: $('#assessment-metric-form').serialize()
        }).done(function (html) {
            $('#objectives_result').html(html);
            $(btn).button('reset');
        });
    }
</script>