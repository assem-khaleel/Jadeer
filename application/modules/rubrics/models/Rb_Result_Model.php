<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rb_Result_Model extends CI_Model {
    
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
        
        $this->db->select('rr.*');
        $this->db->distinct();
        $this->db->from(Orm_Rb_Result::get_table_name() . ' AS rr');
        
        if (isset($filters['id'])) {
            $this->db->where('rr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('rr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('rr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('rr.id', $filters['not_in_id']);
        }
        if (isset($filters['evaluator'])) {
            $this->db->where('rr.evaluator', $filters['evaluator']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('rr.user_id', $filters['user_id']);
        }
        if (isset($filters['in_user_id'])) {
            $this->db->where_in('rr.user_id', $filters['in_user_id']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('rr.semester_id', $filters['semester_id']);
        }
        if (isset($filters['rubric_id'])) {
            $this->db->where('rr.rubric_id', $filters['rubric_id']);
        }
        if (isset($filters['in_rubric_id'])) {
            $this->db->where_in('rr.rubric_id', $filters['in_rubric_id']);
        }
        if (isset($filters['skill_id'])) {
            $this->db->where('rr.skill_id', $filters['skill_id']);
        }
        if (!empty($filters['in_skill_id'])) {
            $this->db->where_in('rr.skill_id', $filters['in_skill_id']);
        }
        if (isset($filters['scale_id'])) {
            $this->db->where('rr.scale_id', $filters['scale_id']);
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
            return Orm_Rb_Result::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Rb_Result::to_object($row);
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
        return $this->db->insert(Orm_Rb_Result::get_table_name(), $params);
    }
    
    /**
    * update item
    *
    * @param int $id
    * @param array $params
    * @return boolean
    */
    public function update($id, $params = array()) {
        return $this->db->update(Orm_Rb_Result::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Rb_Result::get_table_name(), array('id' => $id));
    }
    /**
     * this function get all group by user id by its filters
     * @param array $filters the filters of the get all group by user id  to be call function
     * @return int the call function
     */
    public function get_all_group_by_user_id_count($filters) {
        $this->db->select('rr.user_id,count(*) as count');
        $this->db->group_by('rr.user_id');
        $this->db->from(Orm_Rb_Result::get_table_name() . ' AS rr');
        $this->db->join('user_student as us','rr.user_id = us.user_id');


        if (isset($filters['college_id'])) {
            $this->db->where('us.college_id',$filters['college_id']);
        }

        if (isset($filters['program_id'])) {
            $this->db->where('us.program_id',$filters['program_id']);
        }
        return $this->db->count_all_results();
    }

    /**
     * this function get all group by user id by its filters
     * @param array $filters the filters of the get all group by user id  to be call function
     * @return array the call function
     */
    public function get_all_group_by_user_id($filters) {
        $this->db->select('rr.user_id,count(*) as count');
        $this->db->group_by('rr.user_id');
        $this->db->from(Orm_Rb_Result::get_table_name() . ' AS rr');
        $this->db->limit(10, $filters['page']*10);
        $this->db->join('user_student as us','rr.user_id = us.user_id');


        if (isset($filters['college_id'])) {
            $this->db->where('us.college_id',$filters['college_id']);
        }

        if (isset($filters['program_id'])) {
            $this->db->where('us.program_id',$filters['program_id']);
        }
         return $this->db->get()->result_array();

    }
    
}

