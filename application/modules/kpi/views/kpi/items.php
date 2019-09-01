<?php
/**
 * Created by PhpStorm.
 * User: hamza
 * Date: 11/1/14
 * Time: 2:53 PM
 */
/**
 * @var Orm_Kpi[] $items
 * @var string $pager
 * @var string $keyword
 * @var string $title
 * @var int $category
 * @var Orm_Kpi[] $college_items
 * @var int $college_id
 * @var string $college_pager
 */
?>
<div class="table-primary table-responsive">
    <div class="table-header">
        <span class="table-caption"><?php echo htmlfilter($title); ?></span>
        <div class="panel-heading-controls col-sm-4">
            <form action="" class="pull-right">
                <div class="input-group input-group-sm">
                    <input type="text" name="s" placeholder="<?php echo lang('Search'); ?>" class="form-control"
                           value="<?php echo isset($keyword) && $keyword ? $keyword : ''; ?>">
                    <input type="hidden" name="c" value="<?php echo $category; ?>">
                    <span class="input-group-btn">
                        <button type="submit" class="btn">
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <?php  if (count($items)): ?>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="col-lg-1"><?php echo lang('code'); ?></th>
                <th class="col-lg-7"><?php echo lang('KPI Title'); ?></th>
                <th class="col-lg-2"><?php echo lang('Unit Responsible'); ?></th>
                <th class="col-lg-4 text-center"><?php echo lang('Actions'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($items as $kpi) {?>

                <tr class="odd gradeX">
                    <td><?php echo htmlfilter($kpi->get_view_code()); ?>
                        <br><?php echo ($kpi->get_category_id() == Orm_Kpi::KPI_ACCREDITATION && $kpi->get_ncaaa() == Orm_Kpi::KPI_NCAAA) ? '<span class="label label-primary">' . lang('NCAAA') . '</span>' : ''; ?>
                    </td>
                    <td><?php echo htmlfilter($kpi->get_title()); ?></td>
                    <td>
                        <?php echo htmlfilter($kpi->get_unit_obj()->get_name()); ?>
                    </td>
                    <td class="text-center">
                        <a class="btn btn-sm btn-block"
                           href="/kpi/view/?id=<?php echo urlencode($kpi->get_id()); ?>"><span
                                class="btn-label-icon left"><i
                                    class="fa fa-eye"></i></span><?php echo lang('View'); ?></a>
                        <?php if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_INSTITUTION_ADMIN) { ?>
                            <a class="btn btn-sm btn-block"
                               href="/kpi/create/?c=<?php echo urlencode($category); ?>&id=<?php echo urlencode($kpi->get_id()); ?>"
                               data-toggle="ajaxModal"><span class="btn-label-icon left "><i
                                        class="fa fa-edit"></i></span><?php echo lang('Edit'); ?>
                            </a>
                            <a class="btn btn-sm btn-block"
                               href="/kpi/remove/?id=<?php echo urlencode($kpi->get_id()); ?>"
                               message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction"><span
                                    class="btn-label-icon left"><i
                                        class="fa fa-trash-o"></i></span><?php echo lang('Delete'); ?></a>
                        <?php } ?>
                    </td>
                </tr>
            <?php  }?>
            </tbody>
        </table>
        <?php if (!empty($pager)) { ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php } ?>
    <?php else: ?>
        <div class="alert alert-default">
            <div class="m-b-1"><?php echo lang('No KPIs to be display for this KPI type.') ?></div>
        </div>
    <?php endif; ?>
</div>
<?php if (!is_null(Orm_User::get_logged_user()->get_institution_role()) && Orm_User::get_logged_user()->get_institution_role() == Orm_Role::ROLE_INSTITUTION_ADMIN && $category == Orm_Kpi::KPI_ACCREDITATION) { ?>
    <div class="table-primary table-responsive">
        <div class="table-header">
            <span class="table-caption"><?php echo lang('College Defined') . ' ' . htmlfilter($title); ?></span>
        </div>
        <div class="table-header">
            <div class="row">
                <form method="get">
                    <div class="col-md-8" style="margin-bottom: 10px;">
                        <div class="input-group input-group-sm">
                            <span class="input-group-addon"><?php echo lang('College'); ?>:</span>
                            <select class="form-control" name="college_id">
                                <option value=""><?php echo lang('Select a College') ?></option>
                                <?php foreach (Orm_College::get_all() as $college) { ?>
                                    <?php $selected = ($college->get_id() == $college_id ? 'selected="selected"' : ''); ?>
                                    <option
                                        value="<?php echo (int)$college->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($college->get_name()); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-bottom: 10px;">
                        <div class="input-group input-group-sm">
                            <input type="text" name="cs" placeholder="<?php echo lang('Search'); ?>"
                                   class="form-control"
                                   value="<?php echo isset($college_keyword) && $college_keyword ? $college_keyword : ''; ?>">
                            <input type="hidden" name="c" value="<?php echo $category; ?>">
                            <span class="input-group-btn">
                        <button type="submit" class="btn">
                            <span class="fa fa-search"></span>
                        </button>
                    </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php if (count($college_items)): ?>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="col-lg-1"><?php echo lang('code'); ?></th>
                    <th class="col-lg-8"><?php echo lang('Title'); ?></th>
                    <th class="col-lg-3 text-center"><?php echo lang('Actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($college_items as $kpi) { ?>
                    <tr class="odd gradeX">
                        <td><?php echo htmlfilter($kpi->get_view_code()); ?>
                            <br><?php echo ($kpi->get_ncaaa() == Orm_Kpi::KPI_NCAAA) ? '<span class="label label-primary">' . lang('NCAAA') . '</span>' : ''; ?>
                        </td>
                        <td><?php echo htmlfilter($kpi->get_title()); ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-block"
                               href="/kpi/view/?id=<?php echo urlencode($kpi->get_id()); ?>"><span
                                    class="btn-label-icon left"><i
                                        class="fa fa-eye"></i></span><?php echo lang('View'); ?></a>
                            <?php if (Orm_User::get_logged_user()->get_role_obj()->get_admin_level() == Orm_Role::ROLE_INSTITUTION_ADMIN) { ?>
                                <a class="btn btn-sm btn-block "
                                   href="/kpi/create/?c=<?php echo urlencode($category); ?>&id=<?php echo urlencode($kpi->get_id()); ?>"
                                   data-toggle="ajaxModal"><span class="btn-label-icon left"><i class="fa fa-edit"></i></span><?php echo lang('Edit'); ?>
                                </a>
                                <a class="btn btn-sm btn-block"
                                   href="/kpi/remove/?id=<?php echo urlencode($kpi->get_id()); ?>"
                                   message="<?php echo lang('Are you sure ?') ?>" data-toggle="deleteAction"><span
                                        class="btn-label-icon left"><i
                                            class="fa fa-remove"></i></span><?php echo lang('Delete'); ?></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php if (!empty($college_pager)) { ?>
                <div class="table-footer">
                    <?php echo $college_pager; ?>
                </div>
            <?php } ?>

        <?php else: ?>
            <div class="alert alert-default">
                <div class="m-b-1"><?php echo lang('No KPIs to be display for this KPI type.') ?></div>
            </div>
        <?php endif; ?>
    </div>
<?php } ?>
<script>
    function after_modal() {
        init_data_toggle();
    }
</script>