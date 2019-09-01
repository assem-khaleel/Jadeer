<?php
/* @var $items Orm_Item */;
function draw_item($fltr)
{
    ob_start();
    ?>
    <div class="col-md-12 m-b-2">
        <div class="input-group">
            <span class="input-group-addon"><?php echo lang('Criteria') ?></span>
            <select id="degree_block" name="fltr[criteria_id]" class="form-control">
                <option value=""><?php echo lang('Criteria') ?></option>
                <?php foreach (Orm_Criteria::get_all() as $criteria) : ?>
                    <?php $selected = (isset($fltr['criteria_id']) && $criteria->get_id() == $fltr['criteria_id'] ? 'selected="selected"' : ''); ?>
                    <option value="<?php echo (int)$criteria->get_id(); ?>"<?php echo $selected; ?>><?php echo htmlfilter($criteria->get_title()); ?></option>
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
            <?php echo filter_block('/item/filter', '/item', ['keyword'], 'ajax_block', draw_item($fltr)); ?>
        </div>

        <div class="table-responsive m-a-0">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td clase="col-md-1"><?php echo lang('Code'); ?></td>
                    <td clase="col-md-7"><?php echo lang('Title'); ?></td>
                    <td clase="col-md-2"><?php echo lang('Criteria'); ?></td>
                    <td class="col-md-2 text-center"><?php echo lang('Actions'); ?></td>
                </tr>
                </thead>
                <tbody>
                <?php if ($items): ?>
                    <?php foreach ($items as $item): ?>
                        <tr>
                            <td><?php echo htmlfilter($item->get_code()); ?></td>
                            <td><?php echo htmlfilter($item->get_title()); ?></td>
                            <td><?php echo htmlfilter($item->get_criteria_obj()->get_title()); ?></td>
                            <td class="text-center">
                                <a href="/item/edit/<?php echo (int)$item->get_id(); ?>"
                                   class="btn btn-sm btn-block" title="<?php echo lang('Edit') ?>">
                                    <span class="btn-label-icon left fa fa-edit"
                                          aria-hidden="true"></span> <?php echo lang('Edit') ?>
                                </a>
                                <a href="/item/delete/<?php echo (int)$item->get_id(); ?>"
                                   class="btn btn-sm btn-block" title="<?php echo lang('Delete') ?>"
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
                                <h3 class="m-a-0 text-center"><?php echo lang('There are no') . ' ' . lang('items'); ?></h3>
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
