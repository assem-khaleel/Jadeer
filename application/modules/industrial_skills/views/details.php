<div class="m-b-2">
    <?php echo filter_block("/industrial_skills/details_filter/{$industrial->get_id()}/", "/industrial_skills/details/{$industrial->get_id()}", ['keyword']); ?>
</div>
<div id="ajax_block">
    <?php $this->load->view('industrial_skills/details_data_table'); ?>
</div>