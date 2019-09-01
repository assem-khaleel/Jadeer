<?php
/**
 * Created by PhpStorm.
 * User: bayan
 * Date: 01/06/17
 * Time: 03:34 م
 */
?>
<div class="col-md-12 col-lg-12 m-t-4 ">
    <div class="table-primary">
        <div class="table-header">
            <?php
            $extra_html = form_hidden('type', $type);
            $extra_html .= form_hidden('course_id', $course_id);
            echo filter_block('/portfolio_course/category/filter?type='.$type.'&course_id='.$course_id, '/portfolio_course/category?type='.$type.'&course_id='.$course_id, ['keyword'],'ajax_block',$extra_html); ?>
        </div>
        <div id="ajax_block">
            <?php $this->load->view('portfolio_course/forms/category_table'); ?>
        </div>

    </div>
</div>

