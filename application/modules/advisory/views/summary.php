<?php
/**
 * Created by PhpStorm.
 * User: duaa
 * Date: 11/9/17
 * Time: 9:57 AM
 */
/** @var advisory Orm_Ad_Student_Faculty $advisory[]*/
/** @var student_selected Orm_Ad_Student_Faculty $student_selected[]*/
?>
<h2 class='m-a-0'>
    <?php echo lang('Advisory') ; ?>
</h2>
<hr>
<div class="row m-t-3">
    <div class="col-md-6">
        <div class="panel clearfix">
            <div class="panel-heading p-a-3">
                <div class="panel-title">
                    <i class="panel-title-icon fa fa-check-square-o font-size-16"></i> <?php echo lang('Meeting List'); ?>
                </div>
            </div>
            <div class="ps-block ps-container ps-theme-default ps-active-y" id="list_meeting" style="height: 297px;">
                <?php
                foreach ($meeting_info as $meeting) {
                    ?>
                    <div class="col-xs-12 p-x-1 p-y-2 b-t-1 bg-white">
                        <div class="pull-xs-right font-size-16">
                            <span class="label label-success ticket-label"><b><?php echo lang('Date'); ?>:</b>
                            <span><?php echo htmlfilter(date("Y-m-d", strtotime($meeting->start_date))) ?></span>
                            <b><?php echo lang('From'); ?>:</b>
                            <span><?php echo htmlfilter(date("H:i:s", strtotime($meeting->start_date))) ?></span>
                            <b><?php echo lang('To'); ?>:</b>
                            <span><?php echo htmlfilter(date("H:i:s", strtotime($meeting->end_date))) ?></span>
                            </span>

                        </div>
                        <div class="font-size-15">
                            <?php echo htmlfilter($meeting->name); ?>
                            <?php if(!empty($meeting->objective)): ?>
                            <div class="font-size-15"><?php echo lang('Objective'); ?>
                                :<?php echo ($meeting->objective) ? $meeting->objective : lang('There Are No Data'); ?></div>
                            <?php endif; ?>
                            <?php if(!empty($meeting->meeting_minutes)): ?>
                            <div class="text-muted font-size-14"><?php echo lang('Meeting Minutes'); ?>
                                :<?php echo ($meeting->meeting_minutes) ? $meeting->meeting_minutes : lang('There Are No Data'); ?>
                                <?php if (!empty($meeting->meeting_minutes_attachment)): ?>
                                <a href="<?php echo base_url($meeting->meeting_minutes_attachment);?>"
                                   class="btn btn-sm">
                                    <span
                                        class="btn-label-icon left fa fa-download"></span><?php echo lang('Download Meeting Minutes'); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                          <?php if(!empty($meeting->topic)): ?>
                            <div class="text-muted font-size-14"><?php echo lang('Agenda');?>
                                :<?php echo ($meeting->topic) ? $meeting->topic : lang('There Are No Data'); ?>
                            <?php if (!empty($meeting->agenda_attachment)): ?>
                                <a href="<?php echo base_url($meeting->agenda_attachment); ?>"
                                   class="btn btn-sm">
                                    <span
                                        class="btn-label-icon left fa fa-download"></span><?php echo lang('Download Agenda'); ?>
                                </a>
                                <?php endif; ?>
                            </div>
                          <?php endif; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <?php if (empty($meeting_info)) { ?>
                    <div class="panel p-y-2 p-x-3 m-a-0 text-md-center">
                        <h4 class="m-a-0"><?php echo lang("There are no ") .' '. lang('meeting')?></h4>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>



    <div class="col-md-6">
        <div class="panel clearfix">
            <div class="panel-heading p-a-3">
                <div class="panel-title">
                    <i class="panel-title-icon fa fa-check-square-o font-size-16"></i> <?php echo lang('Student List'); ?>
                </div>
            </div>
            <div class="ps-block ps-container ps-theme-default ps-active-y" id="list_student" style="height: 297px;">
        <?php
        if($student_selected){
            foreach ($student_selected as $student) {
                ?>
                <div class="col-xs-12 p-x-1 p-y-2 b-t-1 bg-white">
                    <div class="pull-xs-right font-size-16">
                            <span class="label label-success ticket-label">
                            <?php echo Orm_Program::get_instance($student->get_program_id())->get_name(); ?>
                            </span>
                    </div>

                    <div
                            class="font-size-15">  <?php echo Orm_User_Faculty::get_instance($student->get_faculty_id())->get_full_name(); ?></div>
                </div>
                <?php
            }
            }else{ ?>
            <div class="panel p-y-2 p-x-3 m-a-0 text-md-center">
                <h4 class="m-a-0"><?php echo lang("There are no ").' ' .lang('student') ?></h4>
            </div>
        <?php } ?>
    </div>
</div>
</div>
















</div>
<script>
    $(function () {
        $('#list_student').perfectScrollbar();
        $('#list_meeting').perfectScrollbar();
    });
</script>


