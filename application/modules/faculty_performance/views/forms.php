<?php
$form_id = isset($form) ? $form->get_id() : 0;

$forms = Orm_Fp_Forms::get_all(['type_id' => $type_id, 'is_hidden' => 0]);
?>
<?php if($forms){ ?>
    <ul class="nav nav-sm nav-pills nav-stacked m-b-3">
        <?php foreach ($forms as $form ) {?>
            <?php $active = ($form_id == $form->get_id() ? ' active' : ''); ?>
            <li class="b-a-1 border-default <?php echo $active; ?>">
                <a href="/faculty_performance/manage/<?php echo $form->get_type_id()?>/<?php echo $form->get_id(); ?>" title="<?php echo htmlfilter($form->get_form_name()); ?>">
                    <?php echo htmlfilter($form->get_form_name()); ?>
                </a>
            </li>
        <?php } ?>
    </ul>
    <div class="col-md-2 col-lg-2 m-t-4">

    </div>
<?php } else { ?>
        <div class="well">
            <div class="alert alert-default">
                <?php echo lang('There are no').' '.lang('Forms for This type') ?>
            </div>
        </div>
<?php } ?>
