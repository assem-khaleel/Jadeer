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
        <span class="table-caption"><?php echo lang('CLO Result') ?></span>
    </div>
    <table class="table table-striped m-a-0" id="clos_result">
        <?php echo $risk_management->ajax() ; ?>
    </table>
</div>

<script>
    function select_leaning_domain() {
        var data = $('#risk-management-form').serializeArray();

        data.push({name: 'filter_type', value:'plo'});

        $.ajax({
            type: "post",
            url: '/risk_management/draw_properties',
            data: data,
        }).done(function (html) {
            $('#plo_selector').html(html);
            $('#course_selector').val(-1).find('[value!=-1]').remove();
//            select_course();
            $('#clos_result').html('');
        });
    }

    function select_plos() {
        var data = $('#risk-management-form').serializeArray();

        data.push({name: 'filter_type', value:'course'});

        $.ajax({
            type: "post",
            url: '/risk_management/draw_properties',
            data: data,
        }).done(function (html) {
            $('#course_selector').html(html).val(-1);
//            select_course();
            $('#clos_result').html('');
        });
    }

    function select_course() {
        $.ajax({
            type: "POST",
            url: '/risk_management/ajax',
            data: $('#risk-management-form').serialize(),
        }).done(function (html) {
            $('#clos_result').html(html);
        });
    }
</script>