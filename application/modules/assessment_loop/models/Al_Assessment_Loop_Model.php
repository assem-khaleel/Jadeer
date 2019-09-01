<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Al_Assessment_Loop_Model extends CI_Model {
    
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
        
        $this->db->select('aal.*');
        $this->db->distinct();
        $this->db->from(Orm_Al_Assessment_Loop::get_table_name() . ' AS aal');

        $this->db->where_in('aal.item_class', Orm_Al_Assessment_Loop::get_item_class_types());

        if (isset($filters['id'])) {
            $this->db->where('aal.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('aal.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('aal.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('aal.id', $filters['not_in_id']);
        }
        if (!empty($filters['item_id'])) {
            $this->db->where('aal.item_id', $filters['item_id']);
        }
        if (!empty($filters['item_class'])) {
            $this->db->where('aal.item_class', $filters['item_class']);

        }
        if (isset($filters['item_type'])) {
            $this->db->where('aal.item_type', $filters['item_type']);
        }
        if (isset($filters['item_type_id'])) {
            $this->db->where('aal.item_type_id', $filters['item_type_id']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('aal.semester_id', $filters['semester_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('aal.user_id', $filters['user_id']);
        }
        if (isset($filters['course_extra_data'])) {
            $this->db->like('aal.extra_data ',  '"course"'.':"'.$filters['course_extra_data'].'"' );
        }
        if (isset($filters['program_extra_data'])) {
            $this->db->like('aal.extra_data ',  '"program"'.':"'.$filters['program_extra_data'].'"' );
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
            return Orm_Al_Assessment_Loop::to_object($row, (empty($row['item_class']) ? null : $row['item_class']));
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Al_Assessment_Loop::to_object($row, (empty($row['item_class']) ? null : $row['item_class']));
            }
           // echo $this->db->last_query();die;
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
        $this->db->insert(Orm_Al_Assessment_Loop::get_table_name(), $params);
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
        return $this->db->update(Orm_Al_Assessment_Loop::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Al_Assessment_Loop::get_table_name(), array('id' => $id));
    }
    
}

