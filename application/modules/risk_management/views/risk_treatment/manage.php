<?php
/** @var $risk_treatments Orm_Rim_Risk_Treatment[] */
/** @var $risk Orm_Rim_Risk_Management */
/** @var $risk_id int */
/** @var $pager string */
?>
<style>
    .risk_chart tr:last-child td{
        vertical-align: top;
        padding: 3px 0 0 0;
        height: 25px;

    }
    .risk_chart td:first-child{
        width: 5%;
        vertical-align: top;
        padding-right: 3px;
    }
    .risk_chart td{
        width: 19%;
        border: solid #000 2px;
    }
    .rotate {
        /* FF3.5+ */
        -moz-transform: rotate(-90.0deg);
        /* Opera 10.5 */
        -o-transform: rotate(-90.0deg);
        /* Saf3.1+, Chrome */
        -webkit-transform: rotate(-90.0deg);
        /* IE6,IE7 */
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);
        /* IE8 */
        -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
        /* Standard */
        transform: rotate(-90.0deg);
        font-size: 15px;
        font-weight: bold;
        border-right: solid #ccc 1px;
        width: 10%;
    }
    .number{
        font-size: medium;
    }
</style>
<div class="row">
    <div class="table-responsive m-a-0 col-lg-6">
        <div class="well well-sm">
            <div class="table table-heading text-center"><b><?php echo lang('Risk Management Matrix')?></b></div>
            <table style="width: 100%; min-height: 500px;">
                <tr>
                    <td class="text-center rotate"><?php echo lang('Likely');?></td>
                    <td> <table class="risk_chart" style="min-height: 450px; width: 100%; border: none;">
                            <?php
                            $result = '';
                            for($i=5; $i>=1; $i--):
                                echo '<tr>';
                                echo '<td class="text-right number" style="border: none;">'.$i.'</td>';
                                for($x=1; $x<=5; $x++):
                                    if($risk->get_likely() == $i && $risk->get_severity() == $x)
                                    {
                                        $result = $risk->get_likely()*$risk->get_severity();
                                    }
                                    if($i * $x < 10) {
                                        echo '<td class="text-center bg-success">&nbsp<span class="label label-tag label-info text-center" style="font-size: medium;">'.$result.'</span></td>';
                                    } elseif ($i * $x >= 10 && $i * $x < 20){
                                        echo '<td class="text-center bg-warning">&nbsp<span class="label label-tag label-info text-center" style="font-size: medium;">'.$result.'</span></td>';
                                    } else {
                                        echo '<td class="text-center bg-danger">&nbsp<span class="label label-tag label-info text-center" style="font-size: medium;">'.$result.'</td>';
                                    }
                                    $result = '';
                                endfor;
                                echo '</tr>';
                            endfor; ?>
                            <tr>
                                <td style="border: none;" class="text-right number">0</td>
                                <td style="border: none;" class="text-right number">1</td>
                                <td style="border: none;" class="text-right number">2</td>
                                <td style="border: none;" class="text-right number">3</td>
                                <td style="border: none;" class="text-right number">4</td>
                                <td style="border: none;" class="text-right number">5</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr><td></td>
                    <td class="text-center" colspan="2" style="font-size: 15px; font-weight: bold; border-top: solid #ccc 1px;"><?php echo lang('Severity');?></td></tr>
            </table>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="well well-sm">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        <b><?php echo lang('Risk Management Information')?> </b>
                    </div>
                </div>
                <div class="panel-heading">
                    <div>
                        <b><?php echo lang('Risk Title')?>: </b>
                        <span><?php echo $risk->get_type_title()?></span>
                    </div>
                </div>
                <div class="panel-body">
                    <div>
                        <b><?php echo lang('Level')?>: </b>
                        <span><?php echo $risk->get_current_level_type();
                            if($risk->get_current_level_type_id_title()){
                                echo " ({$risk->get_current_level_type_id_title()})";
                            }
                            ?></span>
                    </div>
                    <div>
                        <b><?php echo lang('Risk Type');?>:</b>
                        <span><?php echo lang($risk->get_type()); ?></span>
                    </div>
                    <hr class="page-block">
                    <div>
                        <b><?php echo lang('Risk Level');?>:</b>
                        <span><?php echo $risk->risk_level(); ?></span>
                    </div>
                    <hr class="page-block">
                    <table class="table table-bordered info">
                        <thead class="bg-primary">
                        <tr>
                            <th></th>
                            <th><?php echo lang('Value');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><b><?php echo lang('Likely');?></b></td>
                            <td><?php echo $risk->get_likely(); ?> / 5</td>
                        </tr>
                        <tr>
                            <td><b><?php echo lang('Severity');?></b></td>
                            <td><?php echo $risk->get_severity(); ?> / 5</td>
                        </tr>
                        <tr>
                            <td><b><?php echo lang('Risk Evaluation');?></b></td>
                            <td><?php echo $risk->get_severity()*$risk->get_likely(); ?> / 25 </td>
                        </tr>
                        </tbody>
                        <tfoot class="bg-default">
                        <tr><td colspan="2"><i><b><?php echo lang('Note');?> : </b></i><?php echo lang('Risk evaluation = Likely * Severity');?></td></tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
                    <hr class="page-block">

<?php  if (empty($risk_treatments)) { ?>
    <div class="alert alert-default">
        <div class="m-b-1">
            <?php echo lang('There are no') .' ' . lang('Records have been Entered'); ?>
        </div>
        <a href="/risk_management/risk_treatment/add_edit/?risk_id=<?php echo $risk_id; ?>" data-toggle="ajaxModal" class="btn  btn-block" >
            <span class="btn-label-icon left fa fa-plus"></span><?php echo lang('Add').' '.lang('New'); ?>
        </a>
    </div>
<?php } else { ?>
    <div class="table-primary table-responsive m-a-0">
        <div class="table-header">
            <div class="table-caption m-b-1">
                <?php echo lang('Risk Treatments'); ?>
                <a class="btn pull-right" data-toggle="ajaxModal" href="/risk_management/risk_treatment/add_edit/?risk_id=<?php echo $risk_id; ?>">
                    <span class="btn-label-icon left fa fa-plus"></span> <?php echo lang('Add').' '.lang('New'); ?></a>
            </div>
        </div>
        <table class="table table-bordered">
            <thead class="bg-primary">
            <tr>
                <th class="col-lg-3"><?php echo lang('Risk Description'); ?></th>
                <th class="col-lg-3"><?php echo lang('Impact'); ?></th>
                <th class="col-lg-2"><?php echo lang('Risk Treatment'); ?></th>
                <th class="col-lg-2"><?php echo lang('Responsible'); ?></th>
                <th class="col-lg-2 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($risk_treatments as $risk_treatment) { ?>
                <tr>
                    <td>
                        <?php echo $risk_treatment->get_risk_desc(); ?>
                    </td>
                    <td>
                        <?php echo $risk_treatment->get_impact(); ?>
                    </td>
                    <td>
                        <?php echo $risk_treatment->get_desc(); ?>
                    </td>
                    <td>
                        <ul>
                            <li>
                                <?php echo $risk_treatment->get_user_name()?>
                            </li>
                        </ul>
                    </td>
                    <td class="td last_column_border text-center">
                        <a class="btn btn-block" data-toggle="ajaxModal" href="/risk_management/risk_treatment/add_edit/<?php echo $risk_treatment->get_id(); ?>?risk_id=<?php echo $risk_id ?>"><span class="btn-label-icon left fa fa-edit"></span> <?php echo lang('Edit'); ?></a>
                        <a class="btn btn-block" data-toggle="deleteAction" href="/risk_management/risk_treatment/delete/<?php echo $risk_treatment->get_id(); ?>?risk_id=<?php echo $risk_id ?>" message="<?php echo lang('Are you sure ?')?>"><span class="btn-label-icon left fa fa-remove"></span> <?php echo lang('Delete'); ?></a>
                    </td>
                </tr>
            <?php  } ?>
            </tbody>
        </table>
    </div>
<?php } ?>
