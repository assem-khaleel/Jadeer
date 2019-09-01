<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_Topic_Model extends CI_Model {
    
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
        
        $this->db->select('pt.*');
        $this->db->distinct();
        $this->db->from(Orm_Pc_Topic::get_table_name() . ' AS pt');
        
        if (isset($filters['id'])) {
            $this->db->where('pt.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('pt.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('pt.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('pt.id', $filters['not_in_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('pt.course_id', $filters['course_id']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('pt.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('pt.title_en', $filters['title_en']);
        }
        if (!empty($filters['description_ar'])) {
            $this->db->where('pt.description_ar', $filters['description_ar']);
        }
        if (!empty($filters['description_en'])) {
            $this->db->where('pt.description_en', $filters['description_en']);
        }
        if (!empty($filters['start_date'])) {
            $this->db->where('pt.start_date', $filters['start_date']);
        }
        if (!empty($filters['greater_start_date'])) {
            $this->db->where('pt.start_date >=', $filters['greater_start_date']);
        }
        if (!empty($filters['less_start_date'])) {
            $this->db->where('pt.start_date <=', $filters['less_start_date']);
        }
        if (!empty($filters['from_start_date']) && !empty($filters['to_start_date'])) {
            $this->db->group_start();
            $this->db->where('pt.start_date >=', $filters['from_start_date']);
            $this->db->where('pt.start_date <=', $filters['to_start_date']);
            $this->db->group_end();
        }
        if (!empty($filters['end_date'])) {
            $this->db->where('pt.end_date', $filters['end_date']);
        }
        if (!empty($filters['greater_end_date'])) {
            $this->db->where('pt.end_date >=', $filters['greater_end_date']);
        }
        if (!empty($filters['less_end_date'])) {
            $this->db->where('pt.end_date <=', $filters['less_end_date']);
        }
        if (!empty($filters['from_end_date']) && !empty($filters['to_end_date'])) {
            $this->db->group_start();
            $this->db->where('pt.end_date >=', $filters['from_end_date']);
            $this->db->where('pt.end_date <=', $filters['to_end_date']);
            $this->db->group_end();
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('pt.semester_id', $filters['semester_id']);
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
            return Orm_Pc_Topic::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pc_Topic::to_object($row);
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
        $this->db->insert(Orm_Pc_Topic::get_table_name(), $params);
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
        return $this->db->update(Orm_Pc_Topic::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pc_Topic::get_table_name(), array('id' => $id));
    }
    
}

