<?php
/* @var $all_training Orm_Tm_Training[] */

function draw_type($fltr)
{
    ob_start();
    ?>
    <div class="col-md-12 m-b-2">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Type') ?></span>
            <select id="degree_block" name="fltr[type_id]" class="form-control">
                <option value=""><?php echo lang('All Types') ?></option>
                <?php foreach (Orm_Tm_Type::get_all() as $type) : ?>
                    <?php $selected = (isset($fltr['type_id']) && $type->get_id() == $fltr['type_id'] ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo (int)$type->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($type->get_name()); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

?>

<div class="panel panel default">
    <div class="panel-heading">
        <div class="panel-title">
            <?php echo lang('Training Management') ?>
            <?php if(Orm_Tm_Training::check_if_can_add()){?>
                <div class="panel-heading-controls">
                    <a class="btn btn-sm btn-primary btn-outline btn-outline-colorless" href="/training_management/add">
                        <span class="btn-label-icon left"><i class="fa fa-plus"></i></span>
                        <?php echo lang('Add') . ' ' . lang('Training'); ?>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-primary table-responsive">
            <div class="table-header">

                <?php
                echo filter_block('/training_management/filter', '/training_management', ['keyword'], 'ajax_block', draw_type($fltr));
                ?>

            </div>
            <div id="ajax_block">
                <?php $this->load->view('data_table'); ?>
            </div>

        </div>

    </div>
</div>
