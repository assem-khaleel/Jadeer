<?php
/* @var $facilities Orm_User_Faculty*/
/* @var $form_types Orm_Fp_Forms_Type*/
/* @var $deadline string*/
?>
<?php if( Orm_Fp_Forms_Deadline::get_current_deadline()!=0){?>

<div class="col-md-12 col-lg-12 m-t-4">

    <div class="box p-a-1">
        <button class="btn btn-sm <?php echo($this->input->get_post('fltr') ? 'collapsed' : '') ?>"
                type="button" data-toggle="collapse" data-target="#filters" aria-expanded="false"
                aria-controls="filters">
            <span class="fa fa-filter"></span>
        </button>
        <?php echo lang('User List') ?>
    </div>

    <form class="form-horizontal">
        <div class="collapse <?php echo($this->input->get_post('fltr') ? 'in' : '') ?>" id="filters">
            <div class="well">
                <?php echo Orm_User::draw_common_filters();
                echo Orm_User_Faculty::draw_filters(true,6); ?>
                <div class="clearfix">
                    <a class="btn pull-left " href="/faculty_performance/faculty_report?type_id=6"><span
                            class="btn-label-icon left"><i
                                class="fa fa-recycle"></i></span><?php echo lang('Reset'); ?>
                    </a>
                    <button class="btn pull-right " type="submit" <?php echo data_loading_text() ?>>
                            <span class="btn-label-icon left"><i class="fa fa-filter"></i>
                            </span>
                        <?php echo lang('Filters'); ?>
                    </button>
                </div>
            </div>
        </div>
    </form>


    <div class="table-primary">
        <div class="table-header">
            <div class="row form-group">
                <span class="table-caption"><?php echo lang('Faculty Report'); ?></span>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><?php echo lang('Faculty'); ?></th>
                <?php foreach ($form_types as $type) { /* @var $type Orm_Fp_Forms_Type*/?>
                    <th data-input="<?php echo $type->get_id(); ?>"><?php echo htmlfilter($type->get_name()); ?> (<?php echo htmlfilter($type->get_rate(Orm_Fp_Forms_Deadline::get_current_deadline())); ?>)</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php
            /** @var Orm_Fp_Forms_Type $forms */
            if ($facilities): ?>
            <?php foreach ($facilities as $faculty) : /* @var $faculty Orm_User_Faculty */ ?>
            <tr>
                <td>
                    <?php echo htmlfilter($faculty->get_full_name());
                    $rec = Orm_Fp_Forms_Recommendation::get_one(['category_id' => $faculty->get_id()]);
                    ?>

                </td>
                <?php
                foreach ($form_types as $type) { /* @var $type Orm_Fp_Forms_Type*/
                $evaluation = Orm_Fp_Forms_Evaluations::get_one(['type_id'=>$type->get_id(),'user_id' => $faculty->get_id() ,'deadline_id'=>$deadline]);
                ?>
                <?php if($evaluation->get_type_id() != 0){ ?>
                    <td data-type="<?php echo $evaluation->get_type_id()?>"
                        data-id="<?php echo $evaluation->get_id() ?>"
                        data-value="<?php echo $evaluation->get_value() ? htmlfilter($evaluation->get_value()) :0 ?>">
                        <?php echo $evaluation->get_value() ? htmlfilter($evaluation->get_value()) :0 ?></td>
                      <?php } else {
                        ?>
                        <td data-type="0" data-id="0" data-value="0">0</td>
                        <?php }}
                $hh = $rec::get_recmmedation_by_values($faculty->get_id(),$rec->get_type_id(),$deadline);
                ?>
                <input type="hidden" value="<?php echo htmlfilter($hh->get_recommendation_en())?>" class="recommendation_en">
                <input type="hidden" value="<?php echo htmlfilter($hh->get_recommendation_ar())?>" class="recommendation_ar">
                <input type="hidden" value="<?php echo htmlfilter($hh->get_action_en())?>" class="action_en">
                <input type="hidden" value="<?php echo htmlfilter($hh->get_action_ar())?>" class="action_ar">
                <input type="hidden" class="user_id" value="<?php echo intval( $faculty->get_id())?>">
                <input type="hidden" class="rec_id" value="<?php echo intval($rec->get_id())?>">
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="<?php echo count($form_types)+2?>">
                    <div class="well well-sm m-a-0">
                        <h3 class="text-center m-a-0"><?php echo lang('There are no') . ' ' . lang('Data'); ?></h3>
                    </div>
                </td>
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
        <?php if (!empty($pager)) { ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php } ?>
    </div>
</div>
<?php }else{ ?>
    <div class="well">
        <div class="alert alert-default">
            <h3 class="m-a-0 text-center"><?php echo lang('There is no') . ' ' . lang('Current Deadline'); ?></h3>
        </div>
    </div>
<?php } ?>
<script>





    $('.rateNum').TouchSpin({
        min: 0,
        max: 100,
        boostat: 5,
        maxboostedstep: 10
    });
</script>


