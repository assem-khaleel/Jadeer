<?php /* @var $question Orm_Tst_Question_Type_Radio */ ?>


<div class="panel box">
    <div class="box-row">
        <div class="well box-cell col-md-2 p-a-3 valign-top b-a-0" >
            <h4 class="m-y-1 font-weight-normal text-center">
                <i class="fa fa-check text-primary"></i>&nbsp;&nbsp;<?php echo lang('Mark') . ' ('.$question_mark.')' ?></h4>
            <ul class="list-group m-x-0 m-t-0 m-b-0">
                <li class="list-group-item b-x-0 b-t-0 b-b-0">
                    <span class="label label-pill label-primary ">
                    <input class="col-md-offset-3 b-a-0 bg-primary col-md-6 text-center" readonly="" type="number" value="<?php echo $mark ?>" />
                    </span>
                </li>
            </ul>
        </div>
        <div class="box-cell col-md-10 p-a-1">
            <div class="form-group form-message-dark">

                <div class="col-md-12 m-b-1">
                    <?php echo rtrim($question->get_text(), '?').'?'; ?>
                </div>

                <?php foreach ($question->get_choices() as $choice): ?>
                    <div class="col-md-12">
                        <label class="custom-control custom-radio">
                            <input disabled="" type="radio" class="custom-control-input" <?php
                            if(isset($value) && $value->get_id()){
                                echo $choice->get_id()==$value->get_choice_id()? 'checked=""': '';
                            }
                            ?> />
                            <span class="custom-control-indicator"></span>
                            <?php echo htmlfilter($choice->get_choice()); ?>
                        </label>
                    </div>
                <?php endforeach; ?>
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