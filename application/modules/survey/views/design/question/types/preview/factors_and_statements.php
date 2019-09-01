<?php /* @var $question Orm_Survey_Question_Type_Factors_And_Statements */ ?>
<div class="form-group form-message-dark">
    <div class="table-light">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th class="col-md-1"><?php echo lang('Abbreviation') ?></th>
                <th class="col-md-8"><?php echo lang('Title') ?></th>
                <th class="col-md-3 text-center">
                    <?php if (UI_LANG == 'arabic') { ?>
                        <span>١ →→→→→←←←←← ٥</span>
                        <br>
                        <span>لا. ب. ----- ل. أ. ----- م. ----- أ. ----- أ. ب.</span>
                    <?php } else { ?>
                        <span>1 ←←←←←→→→→→ 5</span>
                        <br>
                        <span>SD ---- D ----- N ----- A ----- SA</span>
                    <?php } ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($question->get_factors() as $factor) { ?>
                <tr class="bg-default">
                    <td class="col-md-1"><b><?php echo htmlfilter($factor->get_abbreviation()); ?></b></td>
                    <td class="col-md-8"><b><?php echo htmlfilter($factor->get_title()) ?></b></td>
                    <td class="col-md-3 text-center">&ensp;</td>
                </tr>
                <?php
                $index = 0;
                foreach ($factor->get_statements() as $statement) {
                    $index++;
                    ?>
                    <tr <?php echo($index % 2 ? '' : 'class="active"') ?> >
                        <td class="col-md-1"><?php echo htmlfilter($statement->get_abbreviation() ? $statement->get_abbreviation() : $factor->get_abbreviation() . '-' . $index); ?></td>
                        <td class="col-md-8"><?php echo htmlfilter($statement->get_title()) ?></td>
                        <td class="col-md-3">
                            <div class="row">
                                <div class="form-group dark m-a-0">
                                    <div class="col-md-12">
                                        <div class="clearfix radio m-a-0 no-padding">
                                            <div class="pull-left text-center" style="width: 20%;">
                                                <div class="radio m-a-0">
                                                    <label>
                                                        <input type="radio" value="1"
                                                               name="<?php echo $question->get_html_question_name() ?>[<?php echo $statement->get_id() ?>]"
                                                               class="px">
                                                        <span class="lbl">1</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="pull-left text-center" style="width: 20%;">
                                                <div class="radio m-a-0">
                                                    <label>
                                                        <input type="radio" value="2"
                                                               name="<?php echo $question->get_html_question_name() ?>[<?php echo $statement->get_id() ?>]"
                                                               class="px">
                                                        <span class="lbl">2</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="pull-left text-center" style="width: 20%;">
                                                <div class="radio m-a-0">
                                                    <label>
                                                        <input type="radio" value="3"
                                                               name="<?php echo $question->get_html_question_name() ?>[<?php echo $statement->get_id() ?>]"
                                                               class="px">
                                                        <span class="lbl">3</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="pull-left text-center" style="width: 20%;">
                                                <div class="radio m-a-0">
                                                    <label>
                                                        <input type="radio" value="4"
                                                               name="<?php echo $question->get_html_question_name() ?>[<?php echo $statement->get_id() ?>]"
                                                               class="px">
                                                        <span class="lbl">4</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="pull-left text-center" style="width: 20%;">
                                                <div class="radio m-a-0">
                                                    <label>
                                                        <input type="radio" value="5"
                                                               name="<?php echo $question->get_html_question_name() ?>[<?php echo $statement->get_id() ?>]"
                                                               class="px">
                                                        <span class="lbl">5</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>