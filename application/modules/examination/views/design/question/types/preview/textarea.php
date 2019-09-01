<?php /* @var $question Orm_Tst_Question_Type_Textarea */ ?>
<div class="form-group form-message-dark m-a-0">
    <div class="col-md-12">
        <textarea style="min-height: 200px;" class="form-control" name="<?php echo $question->get_html_question_name() ?>"><?php if(isset($value) && $value->get_id()){echo htmlfilter($value->get_text());} ?></textarea>
    </div>
</div>