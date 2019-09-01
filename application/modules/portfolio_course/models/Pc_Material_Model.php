<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_Material_Model extends CI_Model {
    
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
        
        $this->db->select('pm.*');
        $this->db->distinct();
        $this->db->from(Orm_Pc_Material::get_table_name() . ' AS pm');
        
        if (isset($filters['id'])) {
            $this->db->where('pm.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('pm.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('pm.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('pm.id', $filters['not_in_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('pm.course_id', $filters['course_id']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('pm.title_ar', $filters['title_ar']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('pm.title_en', $filters['title_en']);
        }
        if (!empty($filters['description_ar'])) {
            $this->db->where('pm.description_ar', $filters['description_ar']);
        }
        if (!empty($filters['description_en'])) {
            $this->db->where('pm.description_en', $filters['description_en']);
        }
        if (isset($filters['material_type'])) {
            $this->db->where('pm.material_type', $filters['material_type']);
        }
        if (isset($filters['material_location'])) {
            $this->db->where('pm.material_location', $filters['material_location']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('pm.semester_id', $filters['semester_id']);
        }
        if (!empty($filters['author'])) {
            $this->db->where('pm.author', $filters['author']);
        }
        if (!empty($filters['release_date'])) {
            $this->db->where('pm.release_date', $filters['release_date']);
        }
        if (!empty($filters['greater_release_date'])) {
            $this->db->where('pm.release_date >=', $filters['greater_release_date']);
        }
        if (!empty($filters['less_release_date'])) {
            $this->db->where('pm.release_date <=', $filters['less_release_date']);
        }
        if (!empty($filters['from_release_date']) && !empty($filters['to_release_date'])) {
            $this->db->group_start();
            $this->db->where('pm.release_date >=', $filters['from_release_date']);
            $this->db->where('pm.release_date <=', $filters['to_release_date']);
            $this->db->group_end();
        }
        if (!empty($filters['edition'])) {
            $this->db->where('pm.edition', $filters['edition']);
        }
        if (!empty($filters['publisher'])) {
            $this->db->where('pm.publisher', $filters['publisher']);
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
            return Orm_Pc_Material::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pc_Material::to_object($row);
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
        $this->db->insert(Orm_Pc_Material::get_table_name(), $params);
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
        return $this->db->update(Orm_Pc_Material::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pc_Material::get_table_name(), array('id' => $id));
    }
    
}

