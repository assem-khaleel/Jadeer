<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_General_Information_Model extends CI_Model {
    
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
        
        $this->db->select('fgi.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_General_Information::get_table_name().' AS fgi');
        
        if (isset($filters['id'])) {
            $this->db->where('fgi.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('fgi.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('fgi.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('fgi.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('fgi.user_id', $filters['user_id']);
        }
        if (!empty($filters['mobile_no'])) {
            $this->db->where('fgi.mobile_no', $filters['mobile_no']);
        }
        if (!empty($filters['personal_email'])) {
            $this->db->where('fgi.personal_email', $filters['personal_email']);
        }
        if (!empty($filters['contract_date'])) {
            $this->db->where('fgi.contract_date', $filters['contract_date']);
        }
        if (!empty($filters['contract_type'])) {
            $this->db->where('fgi.contract_type', $filters['contract_type']);
        }
        if (!empty($filters['contract_attachment'])) {
            $this->db->where('fgi.contract_attachment', $filters['contract_attachment']);
        }
        if (!empty($filters['cv_attachment'])) {
            $this->db->where('fgi.cv_attachment', $filters['cv_attachment']);
        }
        if (!empty($filters['cv_text_ar'])) {
            $this->db->where('fgi.cv_text_ar', $filters['cv_text_ar']);
        }
        if (!empty($filters['cv_text_en'])) {
            $this->db->where('fgi.cv_text_en', $filters['cv_text_en']);
        }
        if (!empty($filters['website'])) {
            $this->db->where('fgi.website', $filters['website']);
        }
        if (!empty($filters['twitter'])) {
            $this->db->where('fgi.twitter', $filters['twitter']);
        }
        if (!empty($filters['facebook'])) {
            $this->db->where('fgi.facebook', $filters['facebook']);
        }
        if (!empty($filters['linkedin'])) {
            $this->db->where('fgi.linkedin', $filters['linkedin']);
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
            return Orm_Fp_General_Information::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_General_Information::to_object($row);
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
        $this->db->insert(Orm_Fp_General_Information::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_General_Information::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_General_Information::get_table_name(), array('id' => (int) $id));
    }
    
}

