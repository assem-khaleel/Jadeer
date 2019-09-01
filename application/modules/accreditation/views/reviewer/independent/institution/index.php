<?php
$active_institutional = Orm_Node::get_active_institutional_node();
?>
<?php
if($is_admin) {
    $this->load->view('reviewer/independent/reviewer_list');
} else {
    $this->load->view('reviewer/independent/reviewer_panel');
}
?>