<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pc_Support_Material_Model extends CI_Model {
    
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
        
        $this->db->select('psm.*');
        $this->db->distinct();
        $this->db->from(Orm_Pc_Support_Material::get_table_name() . ' AS psm');
        
        if (isset($filters['id'])) {
            $this->db->where('psm.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('psm.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('psm.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('psm.id', $filters['not_in_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('psm.course_id', $filters['course_id']);
        }
        if (!empty($filters['construction_technique_file'])) {
            $this->db->where('psm.construction_technique_file', $filters['construction_technique_file']);
        }
        if (!empty($filters['equipment_documentation_file'])) {
            $this->db->where('psm.equipment_documentation_file', $filters['equipment_documentation_file']);
        }
        if (!empty($filters['computer_documentation_file'])) {
            $this->db->where('psm.computer_documentation_file', $filters['computer_documentation_file']);
        }
        if (!empty($filters['troubleshooting_tip_file'])) {
            $this->db->where('psm.troubleshooting_tip_file', $filters['troubleshooting_tip_file']);
        }
        if (!empty($filters['debugging_tip_file'])) {
            $this->db->where('psm.debugging_tip_file', $filters['debugging_tip_file']);
        }
        if (!empty($filters['addition_ar'])) {
            $this->db->where('psm.addition_ar', $filters['addition_ar']);
        }
        if (!empty($filters['addition_en'])) {
            $this->db->where('psm.addition_en', $filters['addition_en']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('psm.semester_id', $filters['semester_id']);
        }
        if (!empty($filters['file_name_ar'])) {
            $this->db->where('psm.file_name_ar', $filters['file_name_ar']);
        }
        if (!empty($filters['file_name_en'])) {
            $this->db->where('psm.file_name_en', $filters['file_name_en']);
        }
        if (isset($filters['type'])) {
            $this->db->where('psm.type', $filters['type']);
        }
        if (isset($filters['is_not_null'])) {
            $this->db->where('psm.'.$filters['is_not_null'].' IS NOT NULL');
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
            return Orm_Pc_Support_Material::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Pc_Support_Material::to_object($row);
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
        $this->db->insert(Orm_Pc_Support_Material::get_table_name(), $params);
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
        return $this->db->update(Orm_Pc_Support_Material::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Pc_Support_Material::get_table_name(), array('id' => $id));
    }
    
}

