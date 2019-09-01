<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_Independent_Reviewer_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return array
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('air.*');
        $this->db->distinct();
        $this->db->from(Orm_Acc_Independent_Reviewer::get_table_name() . ' AS air');
        
        if (isset($filters['id'])) {
            $this->db->where('air.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('air.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('air.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('air.id', $filters['not_in_id']);
        }
        if (!empty($filters['type'])) {
            $this->db->where('air.type', $filters['type']);
        }
        if (isset($filters['type_id'])) {
            $this->db->where('air.type_id', $filters['type_id']);
        }
        if (isset($filters['reviewer_id'])) {
            $this->db->where('air.reviewer_id', $filters['reviewer_id']);
        }
        if (!empty($filters['cv_attachment'])) {
            $this->db->where('air.cv_attachment', $filters['cv_attachment']);
        }
        if (!empty($filters['cv_text'])) {
            $this->db->where('air.cv_text', $filters['cv_text']);
        }
        
        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }
        
        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }
        
        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
            return Orm_Acc_Independent_Reviewer::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Acc_Independent_Reviewer::to_object($row);
            }
            return $objects;
            break;
            case Orm::FETCH_ARRAY:
            return $this->db->get()->result_array();
            break;
            case Orm::FETCH_COUNT:
            return $this->db->count_all_results();
            break;
        }
    }
    
    /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Acc_Independent_Reviewer::get_table_name(), $params);
        return $this->db->insert_id();
    }
    
    /**
    * update item
    *
    * @param int $id
    * @param array $params
    * @return boolean
    */
    public function update($id, $params = array()) {
        return $this->db->update(Orm_Acc_Independent_Reviewer::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Acc_Independent_Reviewer::get_table_name(), array('id' => $id));
    }

    public function get_reviewer_program_ids($user_id, $type) {
        $this->db->select('type_id');
        $this->db->distinct();
        $this->db->from(Orm_Acc_Independent_Reviewer::get_table_name());
        $this->db->where('reviewer_id', intval($user_id));
        $this->db->where('type', $type);

        return array_column($this->db->get()->result_array(), 'type_id');
    }
    
}

