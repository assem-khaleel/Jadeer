<div class="table-primary">
    <div class="table-header">
        <span class="table-caption"><?php echo htmlfilter($form->get_form_name()) ?></span>
        <div class="pull-right">
            <a href="/faculty_performance/add/<?php echo intval($type_id) ?>?form_id=<?php echo intval($form->get_id()) ?>" class="btn btn-sm" data-toggle="ajaxModal">
                <span class="btn-label-icon left fa fa-plus" aria-hidden="true"></span>
                <?php echo lang('Add')?>
            </a>
        </div>
    </div>
    <?php $this->view('form_result', ['result' => $result, 'inputs' => $inputs, 'actions' => true]);?>
</div>