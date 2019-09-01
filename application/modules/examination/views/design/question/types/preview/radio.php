<?php /* @var $question Orm_Tst_Question_Type_Radio */ ?>
<div class="form-group form-message-dark m-a-0">
    <div class="col-md-12">
        <?php
        $index = 0;
        $choices = $question->get_choices();
        $count = count($choices);
        foreach ($choices as $choice) {
            $index++;
            ?>
            <div class="radio <?php echo($index == $count ? 'm-a-0-b' : '') ?>">
                <label>
                    <input type="radio" class="px" <?php if(isset($value) && $value->get_id()){echo $choice->get_id()==$value->get_choice_id()? 'checked=""': '';} ?>
                           name="<?php echo $question->get_html_question_name() ?>"
                           value="<?php echo (int)$choice->get_id(); ?>"/>
                    <span class="lbl"><?php echo htmlfilter($choice->get_choice()); ?></span>
                </label>
            </div>
        <?php } ?>
    </div>
</div>