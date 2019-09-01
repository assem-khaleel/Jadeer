<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 2/1/16
 * Time: 5:46 PM
 */
/** @var string $link */
?>
<div class="well well-table-header">
    <h3 class="m-t-0"><?php echo htmlfilter(Orm_Program::get_instance($program_id)->get_name()) ?></h3>
    <div class="row">
        <div class="col-md-3">
            <a class="btn btn-block <?php echo $link == 'learning_outcome' ? 'btn-primary' : '' ?>"
               href="/curriculum_mapping/program/learning_outcome/<?php echo $program_id ?>"><i
                        class="btn-label-icon left fa fa-list-alt"></i><?php echo lang('Learning Outcomes'); ?></a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-block <?php echo $link == 'assessment_method' ? 'btn-primary' : '' ?>"
               href="/curriculum_mapping/program/assessment_method/<?php echo $program_id ?>"><i
                        class="btn-label-icon left fa fa-pencil-square-o"></i><?php echo lang('Assessment Methods'); ?>
            </a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-block <?php echo $link == 'x-matrix' ? 'btn-primary' : '' ?>"
               href="/curriculum_mapping/program/x_matrix/<?php echo $program_id ?>"><i
                        class="btn-label-icon left fa fa-map-signs"></i><?php echo lang('X-Matrix'); ?></a>
        </div>
        <div class="col-md-3">
            <a class="btn btn-block <?php echo $link == 'mapping' ? 'btn-primary' : '' ?>"
               href="/curriculum_mapping/program/mapping_matrix/<?php echo $program_id ?>"><i
                        class="btn-label-icon left fa fa-map"></i><?php echo lang('IPMA-Matrix'); ?></a>
        </div>
        <div class="col-md-3 m-t-1">
            <a class="btn btn-block <?php echo $link == 'assessment-matrix' ? 'btn-primary' : '' ?>"
               href="/curriculum_mapping/program/assessment_matrix/<?php echo $program_id ?>"><i
                        class="btn-label-icon left fa fa-map-signs"></i><?php echo lang('Assessment Matrix'); ?></a>
        </div>


    </div>
</div>
