<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 1/11/17
 * Time: 1:24 PM
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */
?>

<div class="table-primary m-a-0">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('KPI Result') ?></span>
    </div>
    <table class="table table-striped m-a-0" id="kpis_result">
        <?php echo $risk_management->ajax() ; ?>
    </table>
</div>

<script>
    function select_kpis() {
        $.ajax({
            type: "POST",
            url: '/risk_management/ajax',
            data: $('#risk-management-form').serialize(),
        }).done(function (html) {
            $('#kpis_result').html(html);
        });
    }
</script>