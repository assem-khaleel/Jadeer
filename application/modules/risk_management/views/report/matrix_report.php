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
            <table style="width: 90%; min-height: 500px;">
                <tr>
                    <td class="text-center rotate"><?php echo lang('Likely')?></td>
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
                    <td class="text-center" colspan="2" style="font-size: 15px; font-weight: bold; border-top: solid #ccc 1px;"><?php echo lang('Severity')?></td></tr>
            </table>
        </div>
    </div>
