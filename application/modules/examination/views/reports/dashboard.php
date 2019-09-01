<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 5/14/17
 * Time: 11:10 AM
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


    <div class="col-xs-12 col-sm-4">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                    <?php echo lang('Highest Mark') ?>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-y-2 text-center">
                    <h3 class="m-y-3"><?php echo  Orm_Tst_Exam_Student_Mark::get_max($exam_id); ?> / <?php echo Orm_Tst_Exam::get_instance($exam_id)->get_fullmark(); ?></h3>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xs-12 col-sm-4">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                    <?php echo lang('Lowest Mark') ?>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-y-2 text-center">
                    <h3 class="m-y-3"><?php echo Orm_Tst_Exam_Student_Mark::get_min($exam_id); ?> / <?php echo Orm_Tst_Exam::get_instance($exam_id)->get_fullmark(); ?></h3>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xs-12 col-sm-4">
        <div class="panel box">
            <div class="box-row">
                <div class="box-cell p-x-2 p-y-1 bg-black text-xs-center font-size-11 font-weight-semibold">
                    <?php echo lang('Median') ?>
                </div>
            </div>
            <div class="box-row">
                <div class="box-cell p-y-2 text-center">
                    <h3 class="m-y-3"><?php echo Orm_Tst_Exam_Student_Mark::get_median($exam_id); ?> / <?php echo Orm_Tst_Exam::get_instance($exam_id)->get_fullmark(); ?></h3>
                </div>
            </div>
        </div>
    </div>



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