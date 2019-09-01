<?php

$fltr = $this->input->get_post('fltr');
?>
<div class="row m-b-1">
    <div class="col-md-6">
        <a type="reset" href="/strategic_planning/details/<?php echo $strategy->get_id()?>" class="btn btn-md btn-block"><?php echo lang('Institution'); ?></a>
    </div>
    <div class="col-md-6">
        <div class="input-group input-group-sm">
            <span class="input-group-addon"><?php echo lang('Unit'); ?>:</span>
            <select name="fltr[unit_id]" class="form-control">
                <option value="0"><?php echo lang('All Units'); ?></option>
                <?php foreach (Orm_Unit::get_all() as $unit) { ?>
                    <?php $selected = $unit->get_id() == $fltr['unit_id'] ? 'selected="selected"' : ''; ?>
                    <option value="<?php echo $unit->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($unit->get_name()); ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>

<div class="row m-b-1">
    <div class="col-md-6">
        <div class="input-group input-group-sm">
            <span class="input-group-addon"><?php echo lang('College'); ?>:</span>
            <select id="college_block" name="fltr[college_id]" class="form-control"
                    onchange="get_programs_by_college(this, 0, 1);">
                <option value="0"><?php echo lang('All College'); ?></option>
                <?php foreach (Orm_College::get_all() as $college) { ?>
                    <?php $selected = $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : ''; ?>
                    <option value="<?php echo $college->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="input-group input-group-sm">
            <span class="input-group-addon"><?php echo lang('Program'); ?>:</span>
            <select id="program_block" name="fltr[program_id]" class="form-control">
                <option value="0"><?php echo lang('All Programs'); ?></option>
                <?php if (!empty($fltr['college_id'])) { ?>
                    <?php foreach (Orm_Program::get_all(array('college_id' => $fltr['college_id'])) as $program) { ?>
                        <?php $selected = $program->get_id() == $fltr['program_id'] ? 'selected="selected"' : ''; ?>
                        <option value="<?php echo $program->get_id(); ?>" <?php echo $selected; ?>><?php echo htmlfilter($program->get_name()); ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-offset-10 col-md-2">
        <button type="submit" class="btn btn-md btn-block ">
            <i class="btn-label-icon left fa fa-search"></i><?php echo lang('Search'); ?>
        </button>
    </div>
</div>