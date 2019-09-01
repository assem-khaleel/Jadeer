<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Academic_Qualification_Model extends CI_Model {
    
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
        
        $this->db->select('faq.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Academic_Qualification::get_table_name().' AS faq');
        
        if (isset($filters['id'])) {
            $this->db->where('faq.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('faq.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('faq.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('faq.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('faq.user_id', $filters['user_id']);
        }
        if (!empty($filters['country'])) {
            $this->db->where('faq.country', $filters['country']);
        }
        if (!empty($filters['city'])) {
            $this->db->where('faq.city', $filters['city']);
        }
        if (!empty($filters['university'])) {
            $this->db->where('faq.university', $filters['university']);
        }
        if (!empty($filters['college'])) {
            $this->db->where('faq.college', $filters['college']);
        }
        if (!empty($filters['date_from'])) {
            $this->db->where('faq.date_from', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('faq.date_to', $filters['date_to']);
        }
        if (!empty($filters['degree'])) {
            $this->db->where('faq.degree', $filters['degree']);
        }
        if (!empty($filters['grade'])) {
            $this->db->where('faq.grade', $filters['grade']);
        }
        if (!empty($filters['speciality'])) {
            $this->db->where('faq.speciality', $filters['speciality']);
        }
        if (!empty($filters['supervisor_name'])) {
            $this->db->where('faq.supervisor_name', $filters['supervisor_name']);
        }
        if (!empty($filters['thises_title'])) {
            $this->db->where('faq.thises_title', $filters['thises_title']);
        }
        if (!empty($filters['description'])) {
            $this->db->where('faq.description', $filters['description']);
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
            return Orm_Fp_Academic_Qualification::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Academic_Qualification::to_object($row);
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
        $this->db->insert(Orm_Fp_Academic_Qualification::get_table_name(), $params);
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
        return $this->db->update(Orm_Fp_Academic_Qualification::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Academic_Qualification::get_table_name(), array('id' => (int) $id));
    }
    
}

