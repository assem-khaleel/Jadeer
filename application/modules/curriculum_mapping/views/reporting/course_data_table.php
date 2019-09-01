<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 2/3/16
 * Time: 3:53 PM
 */
/** @var Orm_Course[] $courses */
/** @var string $pager */
/** @var int $course_id */
/** @var int $section_id */
$url = $this->input->server('REQUEST_URI');
$explode_url = explode('?', $url);
$query_string = empty($explode_url[1]) ? '' : ('?' . $explode_url[1]);
$domains_array  = array();
?>
<div class="row">
    <div class="col-md-12">
        <div class="table-primary table-responsive">
            <div class="table-header">
                <div class="table-caption">
                    <button class="btn btn-rounded btn-sm" type="button" data-toggle="collapse" data-target="#legends" aria-expanded="false" aria-controls="legends">
                        <i class="fa fa-question"></i>
                    </button>
                    <span class="padding-sm-hr"><?php echo lang('Band Performance Legend'); ?></span>
                    <div class="pull-right">
                        <a class="btn btn-sm " href="/curriculum_mapping/reporting/report/pdf/<?php echo $course_id.'/'.$section_id; ?>">
                            <span class="btn-label-icon left icon fa fa-file-pdf-o"></span> <?php echo lang('PDF'); ?>
                        </a>
                        <a class="btn btn-sm " href="/curriculum_mapping/reporting/report/img/<?php echo $course_id.'/'.$section_id; ?>">
                            <span class="btn-label-icon left icon fa fa-image"></span> <?php echo lang('Image'); ?>
                        </a>
                    </div>
                </div>
            </div>
            <div class="collapse" id="legends">
                <table class="table table-bordered bg-theme text-bold">
                    <tr>
                        <td class="col-md-2"><span>B1 (0% to 10%)</span></td>
                        <td class="col-md-4"><?php echo lang('Not Reported') ?></td>
                        <td class="col-md-2"><span>B2 (11% to 30%)</span></td>
                        <td class="col-md-4"><?php echo lang('Means') ?> 2.5 – 2.99</td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><span>B3 (31% to 50%)</span></td>
                        <td class="col-md-4"><?php echo lang('Means') ?> 3.0 – 3.49</td>
                        <td class="col-md-2"><span>B4 (51% to 65%)</span></td>
                        <td class="col-md-4"><?php echo lang('Means') ?> 3.5 – 3.99</td>
                    </tr>
                    <tr>
                        <td class="col-md-2"><span>B5 (66% to 85%)</span></td>
                        <td class="col-md-4"><?php echo lang('Means') ?> 4.0 – 4.49</td>
                        <td class="col-md-2"><span>B6 (85% to 100%)</span></td>
                        <td class="col-md-4"><?php echo lang('Means') ?> 4.5 <?php echo lang("and above")?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<?php if ($pager) { ?>
    <div class="well text-center-md">
        <?php echo $pager; ?>
    </div>
<?php } ?>
<div class="row">
    <div class="col-md-3" id="course-list">
        <div class="well">
            <?php foreach ($courses as $course) { ?>
                <a href="/curriculum_mapping/reporting/course_assessment_rubric/<?php echo $course->get_id().$query_string; ?>" data-original-title="<?php echo htmlfilter($course->get_name()); ?>" class="btn  btn-block <?php echo $course_id == $course->get_id() ? 'btn-primary' : ''; ?>">
                    <i class="btn-label-icon left fa fa-tasks"></i><?php echo htmlfilter($course->get_code()); ?>
                </a>
                <?php if ($course_id && $course_id == $course->get_id()) { ?>
                    <?php foreach (Orm_Course_Section::get_all(array('semester_id' => Orm_Semester::get_active_semester()->get_id(),'course_id' => $course_id)) as $section) { ?>
                        <a href="/curriculum_mapping/reporting/course_assessment_rubric/<?php echo $section->get_course_id() ?>/<?php echo $section->get_id().$query_string; ?>" title="<?php echo htmlfilter($course->get_code() . ' - ' . $course->get_name() . ' ( ' . lang('Section') . ' #: ' . $section->get_section_no() . ' )'); ?>"
                           class="btn  btn-block <?php echo $section_id == $section->get_id() ? 'btn-primary' : ''; ?>"><i class="btn-label-icon left fa fa-users"></i><?php echo htmlfilter(' ( ' . lang('Section') . ' #: ' . $section->get_section_no() . ' )'); ?>
                        </a>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
    <div class="col-md-9">
        <div class="well">
            <?php if (!empty($course_id) || !empty($section_id)) { ?>
                <?php echo $this->load->view('reporting/rubric'); ?>
            <?php } else { ?>
                <div class="alert alert-default">
                    <?php echo lang('Please Select a Course!') ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>