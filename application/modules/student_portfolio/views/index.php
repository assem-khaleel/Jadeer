<?php
/**
 * Created by PhpStorm.
 * User: qanah
 * Date: 3/6/16
 * Time: 2:54 PM
 */
/** @var Orm_User_Faculty $user */
/** @var Orm_User_Faculty[] $peers */
/** @var Orm_User_Faculty[] $managers */
?>

<div class="px-content">

    <div class="page-header panel m-b-0 p-y-0 b-a-0 border-radius-0">
        <form action="" method="GET" class="input-group input-group-lg p-y-3">
            <input type="text" name="text" class="form-control" value="<?php echo  $searchText ?>" placeholder="<?php echo lang('Search'); ?>...">
            <span class="input-group-btn">
          <button type="submit" class="btn"><i class="fa fa-search"></i></button>
        </span>
        </form>

        <?php
        if (!$results) {
            ?>
            <hr class="page-wide-block m-y-1">
            <div class="alert alert-default alert-dark">
                <?php if (!empty($searchText)) { ?>
                    <h4 class="alert-heading"><?php echo  lang('No results found for');?> "<?php echo htmlfilter($searchText) ?>".</h4>
                    <p><?php echo  lang('Note');?> : <?php echo  lang('You can search for a student by his/her name or email');?></p>
                <?php } else { ?>
                    <h4 class="alert-heading"><?php echo  lang('Begin by searching for a student.');?></h4>
                    <p><?php echo  lang('Note');?> : <?php echo  lang('You can search for a student by his/her name or email');?></p>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <hr class="page-wide-block m-t-0 b-t-2">
    <div class="tab-content p-y-0">
        <?php
        if ($count !=0){?>
        <div class="m-b-3 text-muted font-size-12"><strong><?php echo  $count; ?> </strong><?php echo  lang('students are Founded'); ?></div>

        <?php foreach ($results as $result) {
                $user = Orm_User_Student::get_instance($result->get_id()); ?>
            <div class="tab-pane fade in active" id="results-pages">
                <div class="panel">
                    <div class="panel-body">
                        <div class="p-b-1 font-weight-semibold font-size-16">
                            <a href="/student_portfolio/view/<?php echo  $result->get_id() ?>"><?php echo  $result->get_first_name() . ' ' . $result->get_last_name() ?></a>
                        </div>
                        <form class="form-inline">
                            <?php $college_name=$user->get_college_obj()->get_name();
                                  $department_name=$user->get_department_obj()->get_name();
                                  $program_name=$user->get_program_obj()->get_name();
                            if($college_name != ""){?>
                            <div class="form-group">
                                <label class="form-control"><?php echo  lang('College');?> : <?php echo htmlfilter($college_name) ?> </label>
                            </div>
                            <?php }?>
                            <?php if($department_name != ""){?>
                            <div class="form-group">
                                <label class="form-control"><?php echo  lang('department');?> : <?php echo htmlfilter($department_name) ?> </label>
                              </div>
                            <?php }?>
                            <?php if($program_name != ""){?>
                            <div class="form-group">
                                <label class="form-control"><?php echo  lang('Program');?> : <?php echo htmlfilter($program_name) ?> </label>
                            </div>
                            <?php }?>
                        </form>
                    </div>
                </div>
            </div>
        <?php } }?>

        <?php if ($pager) { ?>
            <div class="pagination pagination-sm m-a-0">
                <?php echo $pager; ?>
            </div>
        <?php } ?>
    </div>
</div>
