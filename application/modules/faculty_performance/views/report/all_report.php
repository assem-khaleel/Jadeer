<?php
/* @var Orm_Fp_Forms_Type $types */
/* @var Orm_Fp_Forms_Recommendation $recommendations */
/* @var Orm_Fp_Forms_Evaluations $evaluations */
/* @var Orm_User_Faculty $faculty */
/* @var string $user_id */
/* @var string $deadline */

?>
<div class="col-md-12 col-lg-12 m-t-4 m-b-2">
    <div class="panel">
        <div class="panel-heading">
            <b><?php echo lang('Faculty Name').': '.$faculty->get_full_name()?></b>
        </div>
        <div class="panel-body">
            <div class="col-md-6 col-lg-6">
                <div id="recommendation" class="panel panel-primary">
                    <div class="panel-heading"><?php echo lang('Faculty Recommendation')?></div>
                    <div class="panel-body">
                        <?php echo  htmlfilter($recommendations->get_recommendation()) ? htmlfilter($recommendations->get_recommendation()) : lang('There is no').' '.lang('Recommendation')?>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div id="action" class="panel panel-primary">
                    <div class="panel-heading"><?php echo lang('Faculty Actions')?></div>
                    <div class="panel-body">
                        <?php echo  htmlfilter($recommendations->get_action())? htmlfilter($recommendations->get_action()) : lang('There is no').' '.lang('Action')?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 col-lg-12 m-t-4">
    <?php foreach ($types as $type) { /** @var Orm_Fp_Forms_Type $type */
        $evaluation =  Orm_Fp_Forms_Evaluations::get_one(['type_id'=>$type->get_id(),'deadline_id'=>$deadline]);
        /* @var Orm_Fp_Forms_Evaluations $evaluation */
        ?>
        <div class="panel panel-dark">
            <div class="panel-heading text-center p-a-2 m-b-2">
                <h3 class="m-t-2 m-b-2"><?php echo lang('Form Type').': '.$type->get_name(); ?></h3>
                <h5 class="m-a-2 text-success"><?php echo lang('Form Type Evaluation').': ';?><?php echo $evaluation->get_value() ?  $evaluation->get_value() : 0 .'%'?></h5>


            </div>
            <div class="panel-body">
                <?php foreach (Orm_Fp_Forms::get_all(['type_id'=>$type->get_id(),'is_hidden'=>0]) as $form) { ?>
                    <div class="table-primary">
                        <div class="table-header">
                            <div class="row form-group">
                                <span class="table-caption"><?php echo $form->get_form_name(); ?></span>
                            </div>
                        </div>
                        <?php
                        $results = Orm_Fp_Forms_Result::get_res_by_user_form($user_id, $form->get_id(),$deadline);
                        $inputs = Orm_Fp_Forms_Inputs::get_all(['form_id'=>$form->get_id()]);

                        $this->view('form_result', ['result' => $results, 'inputs'=>$inputs, 'actions' => false]);
                        ?>
                    </div>
                <?php } ?>
            </div>

        </div>
    <?php } ?>
</div>


