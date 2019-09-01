<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Supervision_Model extends CI_Model {
    
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
        
        $this->db->select('fs.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Supervision::get_table_name().' AS fs');
        
        if (isset($filters['id'])) {
            $this->db->where('fs.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('fs.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('fs.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('fs.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('fs.user_id', $filters['user_id']);
        }
        if (!empty($filters['thises_type'])) {
            $this->db->where('fs.thises_type', $filters['thises_type']);
        }
        if (!empty($filters['thises_title_ar'])) {
            $this->db->where('fs.thises_title_ar', $filters['thises_title_ar']);
        }
        if (!empty($filters['thises_title_en'])) {
            $this->db->where('fs.thises_title_en', $filters['thises_title_en']);
        }
        if (!empty($filters['grant_date'])) {
            $this->db->where('fs.grant_date', $filters['grant_date']);
        }
        if (!empty($filters['researcher'])) {
            $this->db->where('fs.researcher', $filters['researcher']);
        }
        if (!empty($filters['summary_ar'])) {
            $this->db->where('fs.summary_ar', $filters['summary_ar']);
        }
        if (!empty($filters['summary_en'])) {
            $this->db->where('fs.summary_en', $filters['summary_en']);
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
            return Orm_Fp_Supervision::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Supervision::to_object($row);
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
        $this->db->insert(Orm_Fp_Supervision::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Supervision::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Supervision::get_table_name(), array('id' => (int) $id));
    }
    
}

