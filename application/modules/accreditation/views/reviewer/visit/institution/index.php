<?php
    $this->load->view('reviewer/visit/report_panel');
    if($is_admin) {
        $this->load->view('reviewer/visit/reviewer_list');
    }
    $this->load->view('reviewer/visit/recommendation_list');
?>