<?php
/**
 * Created by PhpStorm.
 * User: mazen
 * Date: 3/15/16
 * Time: 7:53 PM
 */
?>
<form method="GET">
    <div class="row">
        <div style="margin-bottom: 10px;" class="col-md-3">
            <a type="reset" href="/kpi/benchmarks/<?php echo Orm_Kpi::KPI_TYPE_ONE_REPORT; ?>/trend" class="btn btn-md btn-block"><?php echo lang('Trend'); ?></a>
        </div>
        <div style="margin-bottom: 10px;" class="col-md-3">
            <a type="reset" href="/kpi/benchmarks/<?php echo Orm_Kpi::KPI_TYPE_ONE_REPORT; ?>/colleges" class="btn btn-md btn-block"><?php echo lang('Institution'); ?></a>
        </div>
        <div style="margin-bottom: 10px;" class="col-md-3">
            <div class="input-group input-group-sm">
                <span class="input-group-addon">College:</span>
                <select name="fltr[college_id]" class="form-control">
                    <option value="">All College</option>
                    <?php foreach (Orm_College::get_all() as $college) { ?>
                        <?php $selected = $college->get_id() == $fltr['college_id'] ? 'selected="selected"' : ''; ?>
                        <option value="<?php  echo intval($college->get_id()); ?>" <?php echo $selected; ?>><?php echo htmlfilter($college->get_name()) ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div style="margin-bottom: 10px;" class="col-md-3">
            <input type="hidden" value="40" name="id">
            <button type="submit" class="btn btn-md btn-block"><?php echo lang('Go'); ?></button>
        </div>
    </div>
</form>
