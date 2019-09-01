<?php /* @var $question Orm_Survey_Question_Type_Checkbox */ ?>
<div class="form-group form-message-dark m-a-0">
    <div class="col-md-12">
        <?php
        $index = 0;
        $choices = $question->get_choices();
        $count = count($choices);
        foreach ($choices as $choice) {
            $index++;
            ?>
            <div class="checkbox <?php echo($index == $count ? 'm-a-0-b' : '') ?>">
                <label>
                    <input type="checkbox" class="px"
                           name="<?php echo $question->get_html_question_name() ?>[<?php echo (int)$choice->get_id(); ?>]"
                           value="<?php echo (int)$choice->get_id(); ?>"/>
                    <span class="lbl"><?php echo htmlfilter($choice->get_choice()); ?></span>
                </label>
            </div>
        <?php } ?>
    </div>
</div>