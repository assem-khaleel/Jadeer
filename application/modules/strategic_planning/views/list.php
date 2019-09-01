<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 16/10/17
 * Time: 10:29 AM
 */

/**
 * @var $strategies Orm_Sp_Strategy[]
 *
 */

//print_r()
?>



<div class="table-primary">
    <div class="table-header">
        <div class="table-caption row">
            <div class="col-md-8"><?php echo lang('Strategic Planning') ?></div>
            <div class="col-md-4">
                <a href="/strategic_planning/perspective/" class="btn pull-right">
                    <span class="btn-label-icon left fa fa-gear"></span><?php echo lang('Manage').' '.lang('Perspective'); ?>
                </a>
            </div>
        </div>
    </div>


    <div class="table-responsive m-a-0">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-lg-2"><?php echo lang('Strategic Period'); ?></th>
                <th class="col-lg-1"><?php echo lang('Active'); ?></th>
                <th class="col-lg-4"><?php echo lang('Description'). ' (' . lang('English') . ')'; ?></th>
                <th class="col-lg-3"><?php echo lang('Description'). ' (' . lang('Arabic') . ')'; ?></th>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($strategies as $strategy) { ?>
                <tr>
                    <td>
                        <span><?php echo htmlfilter($strategy->get_start_year()).' - '.htmlfilter($strategy->get_year()); ?></span>
                    </td>
                    <td class="text-center">
                        <span><?php
                            $year = Orm_Semester::get_active_semester()->get_year();
                            echo ($strategy->get_start_year()<=$year&&$strategy->get_year()>=$year)? lang('Active'): '' ;
                            ?></span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($strategy->get_description_en()); ?></span>
                    </td>
                    <td>
                        <span><?php echo htmlfilter($strategy->get_description_ar()); ?></span>
                    </td>
                    <td class="td last_column_border text-center">
                        <a class="btn btn-block" href="/strategic_planning/details/<?php echo (int) $strategy->get_id(); ?>"><span class="btn-label-icon left fa fa-bars"></span> <?php echo lang('Details'); ?></a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if($pager) { ?>
        <div class="table-footer">
            <?php echo $pager ?>
        </div>
    <?php } ?>

</div>

