<?php
/* @var $semesters Orm_Semester */;

function draw_semester($fltr)
{
    ob_start();
    ?>
    <div class="col-md-12 m-b-1">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Year') ?></span>
            <select id="semester_block" name="fltr[year]" class="form-control">
                <option value=""><?php echo lang('All Years') ?></option>
                <?php foreach (Orm_Semester::get_years() as $year) : ?>
                    <?php $selected = (!empty($fltr['year']) && $fltr['year'] == $year ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo $year; ?>" <?php echo $selected; ?>><?php echo $year; ?></option>
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

<div class="col-md-9 col-lg-10">
    <div class="table-primary">
        <div class="table-header">
            <?php echo filter_block('', '/semester', ['keyword'], 'ajax_block', draw_semester($fltr)) ?>
        </div>
        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-1"><?php echo lang('Year'); ?></td>
                    <td class="col-md-6"><?php echo lang('Semester'); ?></td>
                    <td class="col-md-1"><?php echo lang('Start'); ?></td>
                    <td class="col-md-1"><?php echo lang('End'); ?></td>
                    <td class="col-md-1"><?php echo lang('Current'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($semesters): ?>
                    <?php foreach ($semesters as $semester) : /** @var $semester Orm_Semester */ ?>
                        <tr>
                            <td><?php echo $semester->get_year(); ?></td>
                            <td><?php echo htmlfilter($semester->get_name()); ?></td>
                            <td><?php echo $semester->get_start(); ?></td>
                            <td><?php echo $semester->get_end(); ?></td>
                            <td><?php echo($semester->get_is_current() ? lang('Yes') : lang('No')); ?></td>
                            <td class="text-center">
                                <a href="/semester/edit/<?php echo (int)$semester->get_id(); ?>"
                                   class="btn btn-sm btn-block " title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit"
                                          aria-hidden="true"></span> <?php echo lang('Edit') ?>
                                </a>
                                <a href="/semester/delete/<?php echo (int)$semester->get_id(); ?>"
                                   class="btn btn-sm btn-block " title="<?php echo lang('Delete') ?>"
                                   data-toggle="deleteAction" message="<?php echo lang('Are you sure ?') ?>">
                                    <span class="btn-label-icon left fa fa-trash-o"
                                          aria-hidden="true"></span> <?php echo lang('Delete') ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10">
                            <div class="well well-sm m-a-0">
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Semesters'); ?></h3>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if (!empty($pager)): ?>
            <div class="table-footer">
                <?php echo $pager; ?>
            </div>
        <?php endif; ?>
    </div>
</div>