<?php /* @var $question Orm_Tst_Question_Type_Textarea */ ?>


<div class="panel box">
    <div class="box-row">
        <div class="well box-cell col-md-2 p-a-3 valign-top b-a-0" >
            <h4 class="m-y-1 font-weight-normal text-center">
                <i class="fa fa-check text-primary"></i>&nbsp;&nbsp;<?php echo lang('Mark') . ' ('.$question_mark.')' ?></h4>
            <ul class="list-group m-x-0 m-t-0 m-b-0">
                <li class="list-group-item b-x-0 b-t-0 b-b-0">
                    <?php
                    if(isset(Validator::get_errors()[$question->get_html_question_name()])){
                        echo '<div class="col-md-12 bg-danger">'.Validator::get_errors()[$question->get_html_question_name()].'</div>';
                    } ?>
                    <span class="label label-pill label-primary ">
                    <input class="col-md-offset-3 b-a-0 bg-primary col-md-6 text-center" type="number" name="<?php echo htmlfilter($question->get_html_question_name()) ?>" value="<?php
                    if(is_null($this->input->post($question->get_html_question_name()))){
                        echo $mark;
                    }
                    else {
                        echo abs($this->input->post($question->get_html_question_name()));
                    }
                    ?>" />
                    </span>

                </li>
            </ul>
        </div>
<!---->
<!--        <div class="box-cell col-md-2 p-a-3  bg-success valign-top" style="color: #000000 !important;">-->
<!--            <h4 class="m-y-1 font-weight-normal">-->
<!--                <i class="fa fa-check text-primary"></i>&nbsp;&nbsp;--><?php //echo lang('Mark') . ' ('.$question_mark.')' ?><!--</h4>-->
<!--            <ul class="list-group m-x-0 m-t-0 m-b-0">-->
<!--                <li class="list-group-item b-x-0 b-t-0 b-b-0">-->
<!--                    --><?php
//                    if(isset(Validator::get_errors()[$question->get_html_question_name()])){
//                        echo '<div class="col-md-12 bg-danger">'.Validator::get_errors()[$question->get_html_question_name()].'</div>';
//                    } ?>
<!--                    <input class="col-md-offset-6 b-a-0 bg-warning col-md-6 text-center " style="color: #000000 !important;" type="number" name="--><?php //echo $question->get_html_question_name() ?><!--" value="--><?php
//                    if(is_null($this->input->post($question->get_html_question_name()))){
//                        echo $mark;
//                    }
//                    else {
//                        echo abs($this->input->post($question->get_html_question_name()));
//                    }
//                    ?><!--" />-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
        <div class="box-cell col-md-10 p-a-1">
            <div class="form-group form-message-dark m-a-0">
                <div class="col-md-12 m-b-1">
                    <?php echo rtrim($question->get_text(), '?').'?'; ?>
                </div>

                <div class="col-md-12">
                    <textarea readonly="" style="min-height: 200px;" class="form-control"><?php if(isset($value) && $value->get_id()){echo htmlfilter($value->get_text());} ?></textarea>
                </div>
            </div>
            <?php if($attach && $attach->get_id() && $attach->get_path_file()):?>
                <div class="form-group form-message-dark">
                    <div class="col-md-12 text-right">
                        <br>
                        <a class="btn" href="<?php echo $attach->get_path_file() ?>" >
                            <span class="btn-label-icon left"><i class="fa fa-download"></i></span>
                            <?php echo lang('View File') ?>
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>