<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 3/14/17
 * Time: 11:50 AM
 */

$committee_level = $this->input->post_get('committee_level');
$committee_search = $this->input->post_get('committee_search');

?>

<div class="form-group" id="committee_filter">
    <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label" for="committee_level"><?php echo lang('Level') ?></label>
            <div class="col-sm-9">
                <select id="committee_level" name="committee_level" class="form-control" onchange="search_committee();">
                    <?php
                    foreach(Orm_C_Committee::get_types() as $key => $type){
                        $selected = $committee_level == $key ? 'selected = "selected" ' : '';
                        ?>
                        <option value="<?php echo $key ?>" <?php echo $selected ?>><?php echo htmlfilter($type) ?></option>
                    <?php } ?>
                </select>
                <?php echo Validator::get_html_error_message('committee_level'); ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label" for="committee_search"><?php echo lang('Search') ?></label>
            <div class="col-sm-7">
                <input id="committee_search" name="committee_search" class="form-control" type="text" value="<?php echo htmlfilter($committee_search) ?>" />
                <?php echo Validator::get_html_error_message('committee_search'); ?>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-block" onclick="search_committee();"><?php echo lang('Search') ?></button>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="table-responsive m-a-0">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td class="col-sm-1">#</td>
                        <td class="col-sm-6"><?php echo lang('name') ?></td>
                        <td class="col-sm-5"><?php echo lang('Level') ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    /** @var Orm_C_Committee $committee */
                    foreach($committee_arr as $committee){
                        $selected = $committee->get_id() == $committee_id ? 'checked = "checked"' : '';
                        ?>
                        <tr>
                            <td><input  <?php echo $selected ?> name='committee_id' id='committee_id_<?php echo  (int) $committee->get_id()?>' value='<?php echo  (int) $committee->get_id()?>' type='radio'></td>
                            <td><label for='committee_id_<?php echo  (int) $committee->get_id()?>'><?php echo  htmlfilter($committee->get_title())?></label></td>
                            <td><label for='committee_id_<?php echo  (int) $committee->get_id()?>'><?php echo htmlfilter($committee->get_type(true))?> <?php ($committee->get_type() != $committee::COMMITTEE_INSTITUTION_LEVEL? htmlfilter($committee->get_current_type_id_title()): '')?></label></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
<!--            --><?php //if($pager) { ?>
<!--                <div class="table-footer">-->
<!--                    --><?php //echo $pager ?>
<!--                </div>-->
<!--            --><?php //} ?>
            <?php

            $pager = new Pager(array('url' => "/meeting_minutes/draw_properties?page=$committee_page&committee_id=$committee_id&type_class=Orm_Mm_Meeting_Committee&committee_search=$committee_search"));
            $pager->set_page($committee_page);
            $pager->set_per_page(5);
            $pager->set_total_count(Orm_C_Committee::get_count($orm_filter));
            $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="type_filter"');
            if ($pager->get_total_count() > $pager->get_per_page()) {
                echo $pager->render();
            }
            
            ?>
        </div>
    </div>
</div>




<script>
    function search_committee() {
        $.get('/meeting_minutes/draw_properties',
            {
                type_class: 'Orm_Mm_Meeting_Committee',
                committee_level: $('#committee_level').val(),
                committee_search: $('#committee_search').val()
            }
        ).done(function (html) {
            $('#type_filter').html(html);

        });

    }
    init_data_toggle();
</script>