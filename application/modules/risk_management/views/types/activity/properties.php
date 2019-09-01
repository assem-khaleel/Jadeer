<?php
/**
 * Created by PhpStorm.
 *
 * @var $risk_management Orm_Rim_Risk_Management
 *
 */
?>

<div class="table-primary m-a-0">
    <div class="table-header">
        <span class="table-caption"><?php echo lang('Activities Result') ?></span>
    </div>
    <table class="table table-striped m-a-0" id="activities_result">
        <?php echo $risk_management->ajax() ; ?>
    </table>
</div>

<script>
    function select_activities() {
        $.ajax({
            type: "POST",
            url: '/risk_management/ajax',
            data: $('#risk-management-form').serialize(),
        }).done(function (html) {
            $('#activities_result').html(html);
        });
    }
</script>