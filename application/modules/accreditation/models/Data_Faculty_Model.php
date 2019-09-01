<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_Faculty_Model extends CI_Model {
    
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
        
        $this->db->select('df.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Faculty::get_table_name().' AS df');
        $this->db->join(Orm_Program::get_table_name().' AS p', 'p.id = df.program_id','inner');
        $this->db->join(Orm_Department::get_table_name().' AS d', 'd.id = p.department_id', 'inner');

        License::valid_programs('p.id');
        License::valid_colleges('d.college_id');

        if (isset($filters['id'])) {
            $this->db->where('df.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('df.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('df.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('df.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('df.program_id', $filters['program_id']);
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('df.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['teaching_assistant_male'])) {
            $this->db->where('df.teaching_assistant_male', $filters['teaching_assistant_male']);
        }
        if (!empty($filters['teaching_assistant_female'])) {
            $this->db->where('df.teaching_assistant_female', $filters['teaching_assistant_female']);
        }
        if (!empty($filters['instructor_male'])) {
            $this->db->where('df.instructor_male', $filters['instructor_male']);
        }
        if (!empty($filters['instructor_female'])) {
            $this->db->where('df.instructor_female', $filters['instructor_female']);
        }
        if (!empty($filters['assistant_prof_male'])) {
            $this->db->where('df.assistant_prof_male', $filters['assistant_prof_male']);
        }
        if (!empty($filters['assistant_prof_female'])) {
            $this->db->where('df.assistant_prof_female', $filters['assistant_prof_female']);
        }
        if (!empty($filters['associate_prof_male'])) {
            $this->db->where('df.associate_prof_male', $filters['associate_prof_male']);
        }
        if (!empty($filters['associate_prof_female'])) {
            $this->db->where('df.associate_prof_female', $filters['associate_prof_female']);
        }
        if (!empty($filters['prof_male'])) {
            $this->db->where('df.prof_male', $filters['prof_male']);
        }
        if (!empty($filters['prof_female'])) {
            $this->db->where('df.prof_female', $filters['prof_female']);
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
            return Orm_Data_Faculty::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Faculty::to_object($row);
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
        $this->db->insert(Orm_Data_Faculty::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Faculty::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Faculty::get_table_name(), array('id' => (int) $id));
    }
    
}

