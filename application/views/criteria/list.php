<?php
/* @var $criterias Orm_Criteria[] */;
function draw_standard($fltr)
{
    ob_start();
    ?>
    <div class="col-md-12 m-b-2">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Standard') ?></span>
            <select id="degree_block" name="fltr[standard_id]" class="form-control">
                <option value=""><?php echo lang('Standard') ?></option>
                <?php foreach (Orm_Standard::get_all() as $standard) : ?>
                    <?php $selected = (isset($fltr['standard_id']) && $standard->get_id() == $fltr['standard_id'] ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo (int)$standard->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($standard->get_title()); ?></option>
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
            <?php echo filter_block('/criteria/filter', '/criteria', ['keyword'], 'ajax_block', draw_standard($fltr)); ?>
        </div>

        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td class="col-md-2"><?php echo lang('Code'); ?></td>
                    <td class="col-md-2"><?php echo lang('Title'); ?></td>
                    <td class="col-md-2"><?php echo lang('Type'); ?></td>
                    <td class="col-md-2"><?php echo lang('Is Program'); ?></td>
                    <td class="col-md-2"><?php echo lang('Standard'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($criterias): ?>
                    <?php foreach ($criterias as $criteria): ?>
                        <tr>
                            <td><?php echo htmlfilter($criteria->get_code()); ?></td>
                            <td><?php echo htmlfilter($criteria->get_title()); ?></td>
                            <td><?php echo $criteria->get_type_name(); ?></td>
                            <td><?php echo $criteria->get_is_program() ? lang('Yes') : lang('No'); ?></td>
                            <td><?php echo htmlfilter($criteria->get_standard_obj()->get_title()); ?></td>
                            <td class="text-center">
                                <a href="/criteria/edit/<?php echo (int)$criteria->get_id(); ?>"
                                   class="btn btn-sm btn-block " title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit"
                                          aria-hidden="true"></span> <?php echo lang('Edit') ?>
                                </a>
                                <a href="/criteria/delete/<?php echo (int)$criteria->get_id(); ?>"
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
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('Criterias'); ?></h3>
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
