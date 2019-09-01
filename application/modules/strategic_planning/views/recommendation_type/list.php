<?php
/** @var Orm_Sp_Recommendation_Type[] $types */
/** @var string $pager */
?>
<div class="table-primary">
	<div class="table-header">
		<span class="table-caption"><?php echo lang('Recommendation Types'); ?></span>

		<div class="panel-heading-controls col-sm-4">
			<a class="btn pull-right" data-toggle="ajaxModal" data-target="add_edit_panel"
			   href="/strategic_planning/recommendation_type/add_edit">
						<span class="btn-label-icon left"><i
								class="fa fa-plus"></i> </span>&nbsp;&nbsp;<?php echo lang('Create'); ?>
			</a>
		</div>
	</div>

	<table class="table table-striped table-bordered">
		<thead>
		<tr>
			<td class="col-md-4"><?php echo lang('Type Title'); ?> (<?php echo lang('Arabic'); ?>)</td>
			<td class="col-md-4"><?php echo lang('Type Title'); ?> (<?php echo lang('English'); ?>)</td>
			<td class="col-md-1"><?php echo lang('Code'); ?></td>
			<td class="col-md-3 text-center"><?php echo lang('Actions'); ?></td>
		</tr>
		</thead>
		<tbody>
		<?php if ($types): ?>
			<?php foreach ($types as $type): ?>
				<tr>
					<td><?php echo htmlfilter($type->get_title_ar()); ?></td>
					<td><?php echo htmlfilter( $type->get_title_en()); ?></td>
					<td><?php echo htmlfilter($type->get_code()); ?></td>
					<td class="text-center">
						<a href="/strategic_planning/recommendation_type/add_edit/<?php echo (int)$type->get_id(); ?>"
						   class="btn btn-sm btn-block" data-toggle="ajaxModal"
						   data-target="add_edit_panel"
						   title="<?php echo lang('Edit') ?>">
                                <span class="btn-label-icon left icon fa fa-edit"
									  aria-hidden="true"></span> <?php echo lang('Edit') ?>
						</a>

						<a href="/strategic_planning/recommendation_type/delete/<?php echo (int)$type->get_id(); ?>"
						   class="btn btn-sm btn-block" message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction"
						   title="<?php echo lang('Delete') ?>"
						   message="<?php echo lang('Are you sure ?')?>" data-toggle="deleteAction">
                                <span class="btn-label-icon left icon fa fa-trash-o"
									  aria-hidden="true"></span> <?php echo lang('Delete') ?>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php else: ?>
			<tr>
				<td colspan="12" >
					<div class="alert m-a-0">
						<?php echo lang('There are no') . ' ' . lang('Recommendation Types'); ?>
					</div>
				</td>
			</tr>
		<?php endif; ?>
		</tbody>
	</table>
</div>