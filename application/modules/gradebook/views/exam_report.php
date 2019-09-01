<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 10/09/17
 * Time: 10:43
 */

/**
 * @var int $exam_id
 */
?>

<div class="row">

    <?php echo Orm_Tst_Exam_Student_Mark::get_normal_distribution_chart($exam_id); ?>
    <?php echo Orm_Tst_Exam_Student_Mark::get_passed_students_chart($exam_id); ?>
    <?php echo Orm_Tst_Exam_Student_Mark::get_low_scour_students_chart($exam_id); ?>
    <?php echo Orm_Tst_Exam_Student_Mark::get_high_scour_students_chart($exam_id); ?>
    <?php echo Orm_Tst_Exam_Student_Mark::get_full_mark_students_chart($exam_id); ?>
    <?php echo Orm_Tst_Exam_Student_Mark::get_attendees_chart($exam_id); ?>

</div>

<script>

    var config = {
        animate: 2000,
        scaleColor: false,
        lineWidth: 4,
        lineCap: 'square',
        size: 90,
        trackColor: 'rgba(0, 0, 0, .09)',
        onStep: function(_from, _to, currentValue) {
            var value = $(this.el).attr('data-max-value') * currentValue / 100;

            $(this.el)
                .find('> span')
                .text(Math.round(value) + $(this.el).attr('data-suffix'));
        }
    };

    $('.easy-pie-chart')
        .easyPieChart($.extend({}, config, { barColor: '#72B159'}));

</script>