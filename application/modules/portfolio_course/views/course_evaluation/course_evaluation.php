<?php /** @var $course_id int */ ?>
<div class=" col-lg-12 col-md-12 col-sm-12 col-xs-12 no-border-vr no-border-r form">
    <div class="row">

        <div class="col-md-4">
            <span class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12"> <?php echo lang("Number of Students")?></div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left text-primary font-size-52 ion-ios-people-outline"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1"> <?php echo Orm_Course_Section_Student::get_total_students($course_id); ?></div>
                    </div>
                </div>
            </span>
        </div>
         <div class="col-md-4">
            <span class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12"> <?php echo lang("Number of sections")?></div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left text-warning font-size-52 ion-ios-albums-outline"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1"> <?php echo Orm_Course_Section::get_count(array('course_id' => $course_id, 'semester_id' => Orm_Semester::get_active_semester()->get_id())) ?></div>
                    </div>
                </div>
            </span>
        </div>
         <div class="col-md-4">
            <span class="panel box bg-white text-default">
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-1">
                        <div class="pull-xs-left font-weight-semibold font-size-12">    <?php echo lang("Number of faculty")?></div>
                    </div>
                </div>
                <div class="box-row">
                    <div class="box-cell p-x-3 p-y-2">
                        <i class="box-bg-icon middle left text-success font-size-52 ion-ios-person-outline"></i>
                        <div class="pull-xs-right font-weight-semibold font-size-24 line-height-1"> <?php echo Orm_Course_Section_Teacher::get_count(array('course_id' => $course_id, 'semester_id' => Orm_Semester::get_active_semester()->get_id())); ?></div>
                    </div>
                </div>
            </span>
        </div>

    </div>

    <?php
    if ($survey_id = Orm_Pc_Settings::get_one(array('entity_key' => Orm_Pc_Settings::ENTITY_COURSE_SURVEY))->get_entity_value()) {
        if (License::get_instance()->check_module('survey')) {
            Modules::load('survey');
            $filters['class_type'] = Orm_User_Student::class;
            $filters['course_id'] = $course_id;
            $filters['semester_id'] = Orm_Semester::get_active_semester()->get_id();
            $survey = Orm_Survey::get_instance(Orm_Pc_Settings::get_one(array('entity_key' => Orm_Pc_Settings::ENTITY_COURSE_SURVEY))->get_entity_value());
            ?>
            <?php $this->load->view('survey/report/summary_details', array('survey' => $survey, 'filters' => $filters)); ?>
            <?php
        }
    } else {
        echo '<div class="well well-sm">'. lang('A survey has not been set in the settings for the courses') .'.</div>';
    }
    ?>
</div>