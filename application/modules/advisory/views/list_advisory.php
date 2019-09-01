<?php
$advisory_search = $this->input->post_get('advisory_search');


?>

<div class="form-group" id="committee_filter">

    <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label" for="advisory_search"><?php echo lang('Search') ?></label>
            <div class="col-sm-7">
                <input id="advisory_search" name="advisory_search" class="form-control" type="text" value="<?php echo htmlfilter($advisory_search) ?>" />
                <?php echo Validator::get_html_error_message('advisory_search'); ?>
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-block" onclick="search_advisory();"><?php echo lang('Search') ?></button>
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
                        <td class="col-sm-6"><?php echo lang('Student Name') ?></td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $student_url = '';
                    $student_attendance_ids=[];
                    foreach ($student_ids as $student_id){
                        $student_url.= "&student_id[]={$student_id->get_user_id()}";
                        $student_attendance_ids[] = $student_id->get_user_id();
                    }

                    /** @var Orm_Ad_Student_Faculty $student */
                    foreach($students as $student){

                        $selected = in_array($student->get_student_id(),$student_attendance_ids )? 'checked = "checked"' : '';
                        ?>
                        <tr>
                            <td>

                                <input  <?php echo $selected ?> name='student_ids[]'value='<?php echo  (int) $student->get_student_id()?>'
                                                                type='checkbox'>
                            </td>
                            <td>
                                <label for='student_ids[]'><?php echo  htmlfilter(Orm_User::get_instance($student->get_student_id())->get_full_name())?></label>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php


            $pager = new Pager(array('url' => "/meeting_minutes/draw_properties?page=$advisory_page$student_url&type_class=Orm_Mm_Meeting_Advisory&advisory_search=$advisory_search"));
            $pager->set_page($advisory_page);
            $pager->set_per_page(5);
            $pager->set_total_count(Orm_Ad_Student_Faculty::get_count($orm_filter));
            $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="type_filter"');
            if ($pager->get_total_count() > $pager->get_per_page()) {
                echo $pager->render();
            }

            ?>
        </div>
    </div>
</div>

<script>
    function search_advisory() {
        $.get('/meeting_minutes/draw_properties',
            {
                type_class: 'Orm_Mm_Meeting_Advisory',
                advisory_search: $('#advisory_search').val()
            }
        ).done(function (html) {
            $('#type_filter').html(html);

        });
    }
    init_data_toggle();
</script>

