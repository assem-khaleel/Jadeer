<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Ad_Faculty_Program_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Ad_Faculty_Program_Model extends CI_Model {

    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Ad_Faculty_Program | Orm_Ad_Faculty_Program[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('afp.*');
        $this->db->distinct();
        $this->db->from(Orm_Ad_Faculty_Program::get_table_name() . ' AS afp');
        
        if (isset($filters['id'])) {
            $this->db->where('afp.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('afp.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('afp.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('afp.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('afp.program_id', $filters['program_id']);
        }
        if (isset($filters['faculty_id'])) {
            $this->db->where('afp.faculty_id', $filters['faculty_id']);
        } 
        if (isset($filters['survey_status'])) {
            $this->db->where('afp.survey_status', $filters['survey_status']);
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
            return Orm_Ad_Faculty_Program::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Ad_Faculty_Program::to_object($row);
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
     * this function get all group by program
     * @return array the calling function
     */
    public function get_all_group_by_program() {

        $this->db->select('afp.program_id,count(*) as count');
        $this->db->group_by('afp.program_id');
        $this->db->from(Orm_Ad_Faculty_Program::get_table_name() . ' AS afp');
        return $this->db->get()->result_array();
    }

    /**
     * this function get all group by program id by its program id
     * @param int $program_id the program id of the get all group by program to be call function
     * @return array the calling function
     */
    public function get_all_group_by_program_id($program_id) {

        $this->db->select('afp.program_id,count(*) as count');
        $this->db->where('afp.program_id',$program_id);
        $this->db->group_by('afp.program_id');
        $this->db->from(Orm_Ad_Faculty_Program::get_table_name() . ' AS afp');
        return $this->db->get()->result_array();
    }

    /**
     * this function get all group by program ids by its program id
     * @param int $program_ids the program ids of the to et all group by program ids be call function
     * @return array the calling function
     */
    public function get_all_group_by_program_ids($program_ids) {

        $this->db->select('afp.program_id,count(*) as count');
        $this->db->where_in('afp.program_id',$program_ids);
        $this->db->group_by('afp.program_id');
        $this->db->from(Orm_Ad_Faculty_Program::get_table_name() . ' AS afp');
        return $this->db->get()->result_array();
    }


    /**
    * insert new row to the table
    *
    * @param array $params
    * @return int
    */
    public function insert($params = array()) {
        $this->db->insert(Orm_Ad_Faculty_Program::get_table_name(), $params);
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
        return $this->db->update(Orm_Ad_Faculty_Program::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Ad_Faculty_Program::get_table_name(), array('id' => $id));
    }

    /**
     * this function get program avg by its program id
     * @param int $id the id of the get program avg to be call function
     * @return int the calling function
     */
    public function get_program_avg($id) {

        $students =$this->db
            ->where('program_id',$id)
            ->from(Orm_Ad_Student_Faculty::get_table_name())
            ->count_all_results();


        return $students;
    }
    
}

