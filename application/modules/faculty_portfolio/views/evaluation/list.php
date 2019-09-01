<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/22/16
 * Time: 10:29 AM
 */

$user = Orm_User_Faculty::get_instance($user_id);

$academic_year = Orm_Semester::get_active_semester()->get_year();
$semesters = Orm_Semester::get_all(array('year' => $academic_year));

$levels = Orm_Fp_Evaluation::get_levels();

$tabs_overall =[];

$order_number = 0;
$overall_point = 0;
?>

<div class="container-fluid">

    <h3 class="text-center text-bold"><?php echo lang('Faculty Performance Evaluation') ?></h3>

    <hr>

    <div class="row">
        <div class="col-md-12"><b><?php echo lang('Academic Year') ?></b> : <?php echo htmlfilter($academic_year) ?></div>
    </div>

    <div class="row">
        <div class="col-md-6"><b><?php echo lang('Faculty ID') ?></b> : <?php echo htmlfilter($user->get_integration_id()) ?></div>
        <div class="col-md-6"><b><?php echo lang('Faculty Name') ?></b> : <?php echo htmlfilter($user->get_full_name()) ?></div>
    </div>

    <div class="row">
        <div class="col-md-6"><b><?php echo lang('College') ?></b> : <?php echo htmlfilter($user->get_college_obj()->get_name()) ?></div>
        <div class="col-md-6"><b><?php echo lang('Department') ?></b> : <?php echo htmlfilter($user->get_department_obj()->get_name()) ?></div>
    </div>

    <div class="row">
        <div class="col-md-12"><b><?php echo lang('Program') ?></b> : <?php echo htmlfilter($user->get_program_obj()->get_name()) ?></div>
    </div>

    <hr>
<?php if(Orm_Fp_Eva_Tabs::get_count() !=0){?>
<?php foreach(Orm_Fp_Eva_Tabs::get_all() as $tab_key => $tab): ?>
    <h4 class="text-left"><?php echo 1+$tab_key ?>. <?php echo htmlfilter($tab->get_title()) ?> (<small><?php echo $tab->get_points() . ' ' . lang('Points') ?></small>)</h4>

    <div class="table-primary">
            <div class="table-header"><?php echo htmlfilter($tab->get_legend_id(true)->get_title()) ?></div>
            <table class="table table-bordered">
                    <?php foreach ($tab->get_legend_id(true)->get_items() as $key=>$item): ?>
                    <?php if($key % 2==0): ?>
                <tr>
                    <?php endif; ?>
                    <td class="col-md-2"><span><?php echo htmlfilter($item->get_legend().' ('.$item->get_min().'% '.lang('to').$item->get_max().'%)') ?></span></td>
                    <td class="col-md-4"><?php echo htmlfilter($item->get_desc()) ?></td>
                    <?php if($key % 2): ?>
                </tr>
                    <?php endif; ?>
                    <?php endforeach; ?>
            </table>
    </div>
    <?php

    $cols = $tab->get_tab_cols();
    $rows = $tab->get_tab_rows();



    foreach ($r = $tab->academic_year_list($user_id) as $acad_year):
    ?>
    <div class="table-primary">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="col-md-6" rowspan="2" colspan="2"><?php echo lang('Academic Year').': '.$acad_year ?></td>
                <td class="col-md-6" colspan="<?php echo count($cols)+1 ?>"><?php echo lang('Skills')?></td>
            </tr>
            <tr>
                <?php foreach ($cols as $col): ?>
                    <td><?php echo htmlfilter($col->get_title()) ?></td>
                <?php endforeach; ?>
                <td class="col-md-1"><?php echo lang('Band Performance') ?></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $overall_rows = [] ;
            $evaluation_value_rows = 0;
            ?>
            <tr>
                <td class="valign-middle text-center"
                    rowspan="<?php echo count($rows) + 2 ?>"><?php echo lang('Performance') ?></td>

            </tr>
            <?php foreach($rows as $row): ?>
                <tr>
                    <td><?php echo htmlfilter($row->get_title()) ?></td>

                    <?php
                    $row_evaluation = 0;
                    foreach ($cols as $col):
                        ?>
                    <td><?php

                        $evaluation_obj = $col->get_evaluation($row->get_id(), $acad_year, $user_id);

                        $evaluation_value = ($evaluation_obj->get_user_score() + $evaluation_obj->get_peer_score() + $evaluation_obj->get_supervisor_score())/3;
                        $row_evaluation+= $evaluation_value;
                        if(!isset($overall_rows[$col->get_id()])){
                            $overall_rows[$col->get_id()]=0;
                        }
                        $overall_rows[$col->get_id()] += $evaluation_value;

                        if(Orm_Semester::get_current_semester()->get_year()==$acad_year&&in_array(Orm_User::get_logged_user_id(), array($user_id, $evaluation_obj->get_peer_id(), $evaluation_obj->get_supervisor_id()))) {
                            echo "<a href='/faculty_portfolio/evaluation/manage_score/{$user_id}/{$tab->get_id()}/{$row->get_id()}/{$col->get_id()}' data-toggle='ajaxModal' class='label label-default' title='".lang('Set Score')."'><i class=' left fa fa-edit'></i></a> ";
                        }

                        echo htmlfilter(Orm_Fp_Legend::get_performance($evaluation_value, $tab->get_legend_id()));

                        ?></td>
                    <?php endforeach; ?>

                    <td><?php $evaluation_value_rows += (count($rows)? $row_evaluation/count($cols): 0);echo htmlfilter(Orm_Fp_Legend::get_performance((count($rows)? $row_evaluation/count($cols): 0), $tab->get_legend_id())); ?></td>
                </tr>
            <?php endforeach; ?>
            <tr class="bg-light-green">

                <td>
                    <?php echo lang('Overall Performance') ?>
                </td>

                <?php foreach ($cols as $col): ?>
                    <td><?php echo htmlfilter(count($rows)? round( $overall_rows[$col->get_id()]/count($rows), 2): 0); ?>%</td>
                <?php endforeach; ?>

                <td><?php echo htmlfilter(Orm_Fp_Legend::get_performance((count($rows)? $evaluation_value_rows/count($rows): 0), $tab->get_legend_id())); ?></td>
            </tr>
            </tbody>
        </table>
    </div>
    <?php endforeach; ?>

    <br>

    <div class="table-primary">
        <?php
        $evaluation_obj = Orm_Fp_Evaluation::get_one(array('academic_year' => $academic_year, 'user_id' => $user_id, 'level' => Orm_Fp_Evaluation::Level_4));
        ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="col-md-2">&nbsp;</td>
                <td class="col-md-2"><?php echo lang('Avg. Personal Assessed Score') ?></td>
                <td class="col-md-2"><?php echo lang('Avg. Peer Assessed Score') ?></td>
                <td class="col-md-2"><?php echo lang('Avg. Supervisor Assessed Score') ?></td>
                <td class="col-md-2"><?php echo lang('Overall Mean Avg. Score') ?></td>
                <td class="col-md-2"><?php echo lang('Band Performance') ?></td>
            </tr>
            </thead>
            <tbody>
            <?php
            $overall = $tab->get_evaluation_by_rows($user_id);

            if(!is_null($overall)) {

                $tabs_overall[$tab_key] = [
                    'title' => $tab->get_title(),
                    'points' => $tab->get_points(),
                    'total' => round(($overall->user_score + $overall->peer_score + $overall->supervisor_score) / 3, 2)
                ];

                $overall_point += $tab->get_points();
            }

            ?>
            <tr>
                <td><?php echo lang('Annual Overall') . ' ' . ($overall? $overall->title: '') ?></td>
                <td><?php echo $overall? $overall->user_score: 0 ?> %</td>
                <td><?php echo $overall? $overall->peer_score: 0 ?> %</td>
                <td><?php echo $overall? $overall->supervisor_score: 0 ?> %</td>
                <td><?php echo isset($tabs_overall[$tab_key])? $tabs_overall[$tab_key]['total']: 0 ?> %</td>
                <td><?php echo htmlfilter(Orm_Fp_Legend::get_performance(isset($tabs_overall[$tab_key])? $tabs_overall[$tab_key]['total']: 0, $tab->get_legend_id())); ?></td>
            </tr>
            </tbody>
        </table>
    </div>

<?php endforeach; ?>

    <h4 class="text-left"><?php echo $tab_key+2 ?>. <?php echo lang('Overall Faculty Performance') ?></h4>
<?php }else{ ?>
<div class="well text-center">
  <h3 class="font-weight-bold m-a-0">
        <?php echo lang('There are no').' '.lang('Evaluation')?>
  </h3>
</div>
<?php } ?>
    <br>

    <div class="table-primary">
        <div class="table-header"><?php echo Orm_Fp_Legend::get_instance(1)->get_title() ?></div>
        <table class="table table-bordered">
            <?php foreach (Orm_Fp_Legend::get_instance(1)->get_items() as $key=>$item): ?>
                <?php if($key % 2==0): ?>
                    <tr>
                <?php endif; ?>
                <td class="col-md-2"><span><?php echo htmlfilter($item->get_legend().' ('.$item->get_min().'% '.lang('to').$item->get_max().'%)') ?></span></td>
                <td class="col-md-4"><?php echo htmlfilter($item->get_desc()) ?></td>
                <?php if($key % 2): ?>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>

    <div class="table-primary">

        <?php ; ?>

        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="col-md-4">&nbsp;</td>
                <td class="col-md-2"><?php echo lang('Weights') ?></td>
                <td class="col-md-2"><?php echo lang('Overall Performance Score (%)') ?></td>
                <td class="col-md-2"><?php echo lang('Overall Weighted Score') ?></td>
                <td class="col-md-2"><?php echo lang('Overall Performance Band') ?></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach($tabs_overall as $tab_overall) { ?>
                <tr>
                    <td><?php echo lang($tab_overall['title']) ?></td>
                    <td><?php echo $tab_overall['points'] ?></td>
                    <td><?php echo $tab_overall['total'] ?> %</td>
                    <td><?php echo round(($tab_overall['total'] * $tab_overall['points'] / 100), 2) ?> / <?php echo $tab_overall['points'] ?></td>
                    <td><?php echo htmlfilter(Orm_Fp_Legend::get_performance($tab_overall['total'], 1)); ?></td>
                </tr>
            <?php } ?>
            <tr class="bg-light-green">
                <td><b><?php echo lang('Overall Faculty Performance') ?></b></td>
                <td><b><?php echo $overall_point ?></b></td>
                <td><b><?php
                        $overall = count($tabs_overall) == 0 ? 0: round(array_sum(array_column($tabs_overall, 'total')) / count($tabs_overall), 2) ;
                        echo $overall;
                        ?> %</b></td>
                <td><b><?php
                        $overall_point = array_sum(array_column($tabs_overall, 'points'));
                        echo round($overall* $overall_point/100, 2);
                        ?> / <?php echo $overall_point ?></b></td>
                <td><b><?php echo htmlfilter(Orm_Fp_Legend::get_performance($overall, 1)); ?></b></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>