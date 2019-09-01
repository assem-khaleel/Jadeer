<?php
function draw_inst($fltr)
{
    ob_start();
    ?>
    <?php if(Orm_User::get_logged_user()->has_role_type(Orm_Role::ROLE_INSTITUTION_ADMIN)){?>
    <div class="col-md-3 m-b-1">
        <a class="btn btn-md btn-block" href="/meeting_minutes/?fltr[institution]=1" type="reset" ><?php echo lang('Institution') ?></a>
    </div>
    <div class="col-md-9 m-b-1">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Unit') ?></span>
            <select id="unit_block" name="fltr[unit_id]" class="form-control">
                <option value=""><?php echo lang('All Units') ?></option>
                <?php foreach (Orm_Unit::get_all() as $unit) : ?>
                    <?php $selected = (isset($fltr['unit_id']) && $unit->get_id() == $fltr['unit_id'] ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo intval($unit->get_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($unit->get_name()); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php }else{ ?>
    <div class="col-md-12 m-b-1">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Unit') ?></span>
            <select id="unit_block" name="fltr[unit_id]" class="form-control">
                <option value=""><?php echo lang('All Units') ?></option>
                <?php foreach (Orm_Unit::get_all() as $unit) : ?>
                    <?php $selected = (isset($fltr['unit_id']) && $unit->get_id() == $fltr['unit_id'] ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo intval($unit->get_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($unit->get_name()); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <?php } ?>

    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <div class="table-caption m-b-1">
            <?php echo lang('Meeting Minutes') ?>
        </div>

            <?php echo filter_block('/meeting_minutes/filter', '/meeting_minutes', [Orm_Campus::class, Orm_College::class, Orm_Program::class, 'keyword'], 'ajax_block', draw_inst($fltr)); ?>
    </div>

      <div id="ajax_block">
        <?php $this->load->view('data_table'); ?>
    </div>
</div>