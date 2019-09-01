<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Am_Assessment_Metric_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Am_Assessment_Metric_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Am_Assessment_Metric | Orm_Am_Assessment_Metric[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('aam.*');
        $this->db->distinct();
        $this->db->from(Orm_Am_Assessment_Metric::get_table_name() . ' AS aam');
        $this->db->where_in('aam.item_class', Orm_Am_Assessment_Metric::get_item_class_types());
        
        if (isset($filters['id'])) {
            $this->db->where('aam.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('aam.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('aam.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('aam.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('aam.name_en', $filters['name_en']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('aam.name_ar', $filters['name_ar']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('aam.semester_id', $filters['semester_id']);
        }
        if (isset($filters['type'])) {
            $this->db->where('aam.type', $filters['type']);
        }
        if (isset($filters['level'])) {
            $this->db->where('aam.level', $filters['level']);
        }
        if (isset($filters['target'])) {
            $this->db->where('aam.target', $filters['target']);
        }
        if (!empty($filters['item_class'])) {
            $this->db->where('aam.item_class', $filters['item_class']);
        }
        if (!empty($filters['college_id'])) {
            $this->db->where('aam.college_id', $filters['college_id']);
        }
        if (!empty($filters['department_id'])) {
            $this->db->where('aam.department_id', $filters['department_id']);
        }
        if (!empty($filters['program_id'])) {
            $this->db->where('aam.program_id', $filters['program_id']);
        }
        if (!empty($filters['in_program_id'])) {
            $this->db->where_in('aam.program_id', $filters['in_program_id']);
        }
        if (!empty($filters['item_id'])) {
            $this->db->where('aam.item_id', $filters['item_id']);
        }
        if (isset($filters['course_extra_data'])) {
            $this->db->like('aam.extra_data ',  '"course"'.':"'.$filters['course_extra_data'].'"' );
        }

        if (!empty($filters['weakness_en'])) {
            $this->db->where('aam.weakness_en', $filters['weakness_en']);
        }
        if (!empty($filters['weakness_ar'])) {
            $this->db->where('aam.weakness_ar', $filters['weakness_ar']);
        }
        if (!empty($filters['strength_en'])) {
            $this->db->where('aam.strength_en', $filters['strength_en']);
        }
        if (!empty($filters['strength_ar'])) {
            $this->db->where('aam.strength_ar', $filters['strength_ar']);
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
            $row = $this->db->get()->row_array();
            return Orm_Am_Assessment_Metric::to_object($row, (empty($row['item_class']) ? null : $row['item_class']));
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Am_Assessment_Metric::to_object($row, (empty($row['item_class']) ? null : $row['item_class']));
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
        $this->db->insert(Orm_Am_Assessment_Metric::get_table_name(), $params);
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
        return $this->db->update(Orm_Am_Assessment_Metric::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Am_Assessment_Metric::get_table_name(), array('id' => $id));
    }
    
}

