<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fp_Forms_Evaluations_Model extends CI_Model {
    
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
        
        $this->db->select('ffe.*');
        $this->db->distinct();
        $this->db->from(Orm_Fp_Forms_Evaluations::get_table_name() . ' AS ffe');
        
        if (isset($filters['id'])) {
            $this->db->where('ffe.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('ffe.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('ffe.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('ffe.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('ffe.user_id', $filters['user_id']);
        }
        if (isset($filters['type_id'])) {
            $this->db->where('ffe.type_id', $filters['type_id']);
        }
        if (isset($filters['value'])) {
            $this->db->where('ffe.value', $filters['value']);
        }
        if (isset($filters['value_greater_than'])) {
            $this->db->where('ffe.value >', $filters['value_greater_than']);
        }
        if (isset($filters['deadline_id'])) {
            $this->db->where('ffe.deadline_id', $filters['deadline_id']);
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
            return Orm_Fp_Forms_Evaluations::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Fp_Forms_Evaluations::to_object($row);
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
    * @return boolean
    */
    public function insert($params = array()) {
        return $this->db->insert(Orm_Fp_Forms_Evaluations::get_table_name(), $params);
    }
    
    /**
    * update item
    *
    * @param int $id
    * @param array $params
    * @return boolean
    */
    public function update($id, $params = array()) {
        return $this->db->update(Orm_Fp_Forms_Evaluations::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Fp_Forms_Evaluations::get_table_name(), array('id' => $id));
    }

    /**
     * get average value for forms depends on type id and deadline
     * @param $type_id
     * @param $ids
     * @param int $deadline
     * @return mixed
     */
    public function get_avg_by_type($type_id, $ids, $deadline=-1) {

        $this->db->select_avg('value');

        $this->db->where('type_id', $type_id);

        if(count($ids) != 0){
            $this->db->where_in('user_id', $ids);
        }

        if($deadline != -1){
            $this->db->where('deadline_id', $deadline);
        }

        return $this->db->get('fp_forms_evaluations')->row()->value;

    }
}

