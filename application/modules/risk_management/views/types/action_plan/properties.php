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
        <span class="table-caption"><?php echo lang('Action Plan Result') ?></span>
    </div>
    <table class="table table-striped m-a-0" id="action_plans_result">
        <?php echo $risk_management->ajax() ; ?>
    </table>
</div>

<script>
    function select_action_plans() {
        $.ajax({
            type: "POST",
            url: '/risk_management/ajax',
            data: $('#risk-management-form').serialize(),
        }).done(function (html) {
            $('#action_plans_result').html(html);
        });
    }
</script>