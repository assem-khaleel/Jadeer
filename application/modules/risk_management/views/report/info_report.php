<?php
/**
 * Created by PhpStorm.
 * User: laith
 * Date: 11/20/17
 * Time: 10:25 AM
 */
?>
<style>
    body{
        width: 100% !important;
    }
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
        height: 160px;
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
        font-size: 20px;
        font-weight: bold;
        border-right: solid #ccc 1px;
        width: 3%;
    }
    .number{
        font-size: medium;
    }
</style>
<div class="row">

    <div>
        <div class="well well-sm">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h3><?php echo lang('Risk Management Information')?> </h3>
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
                        <span><?php echo $risk->get_type(); ?></span>
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
    <hr class="page-block">

    <?php  if (empty($risk_treatments)) { ?>
        <div class="alert alert-default">
            <div class="m-b-1">
                <?php echo lang('There are no') .' ' . lang('Records have been Entered'); ?>
            </div>
        </div>
    <?php } else { ?>
        <div class="table-primary table-responsive m-a-0">
            <div class="table-header">
                <div class="table-caption m-b-1">
                    <h3><?php echo lang('Risk Treatments'); ?></h3>
                </div>
            </div>
            <table class="table table-bordered">
                <thead class="bg-primary">
                <tr>
                    <th class="col-lg-4"><?php echo lang('Risk Description'); ?></th>
                    <th class="col-lg-3"><?php echo lang('Impact'); ?></th>
                    <th class="col-lg-3"><?php echo lang('Risk Treatment'); ?></th>
                    <th class="col-lg-2"><?php echo lang('Responsible'); ?></th>
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
                            <?php echo $risk_treatment->get_user_name()?>
                        </td>
                    </tr>
                <?php  } ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>
