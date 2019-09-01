<?php
    $this->load->view('reviewer/pre_visit/report_panel');
    if($is_admin) {
        $this->load->view('reviewer/pre_visit/reviewer_list');
    }
    $this->load->view('reviewer/pre_visit/recommendation_list');
?>