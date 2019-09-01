<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Class Ad_Student_Faculty_Model
*
* @property CI_DB_query_builder | CI_DB_mysqli_driver $db
*/
class Ad_Student_Faculty_Model extends CI_Model {
    
    /**
    * get table rows according to the assigned filters and page
    *
    * @param array $filters
    * @param int $page
    * @param int $per_page
    * @param array $orders
    * @param int $fetch_as
    *
    * @return Orm_Ad_Student_Faculty | Orm_Ad_Student_Faculty[] | array | int
    */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        
        $page = (int) $page;
        $per_page = (int) $per_page;
        
        $this->db->select('asf.*');
        $this->db->distinct();
        $this->db->from(Orm_Ad_Student_Faculty::get_table_name() . ' AS asf');
        
        if (isset($filters['id'])) {
            $this->db->where('asf.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('asf.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('asf.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('asf.id', $filters['not_in_id']);
        }
        if (isset($filters['student_id'])) {
            $this->db->where('asf.student_id', $filters['student_id']);
        }
        if (isset($filters['faculty_id'])) {
            $this->db->where('asf.faculty_id', $filters['faculty_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('asf.program_id', $filters['program_id']);
        }
        if (!empty($filters['student_like'])) {
            $this->db->group_start();
            $this->db->join(Orm_User::get_table_name() . ' AS usr', 'usr.id = asf.student_id', 'left');
            $this->db->like('usr.first_name', $filters['student_like']);
            $this->db->or_like('usr.last_name', $filters['student_like']);
            $this->db->group_end();
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
            return Orm_Ad_Student_Faculty::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Ad_Student_Faculty::to_object($row);
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
        $this->db->insert(Orm_Ad_Student_Faculty::get_table_name(), $params);
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
        return $this->db->update(Orm_Ad_Student_Faculty::get_table_name(), $params, array('id' => $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Ad_Student_Faculty::get_table_name(), array('id' => $id));
    }

    /**
     * this function deleteMany by its $array
     * @param array $array the program id of the orm_ad_student_faculty
     * @return mixed the calling function
     */
      public function deleteMany($array=[]) {
        return $this->db->delete(Orm_Ad_Student_Faculty::get_table_name(), $array);

      }

    /**
     * this function get meeting
     * @return array the calling function
     */
    public function get_meeting(){
        if (!License::get_instance()->check_module('meeting_minutes', true)) {
            show_404();
        }
         return $this->db
            ->select('*')
            ->where('mm_attendance.user_id',Orm_User::get_logged_user()->get_id())
            ->join('mm_attendance',Orm_Ad_Student_Faculty::get_table_name().".student_id =mm_attendance.user_id")
            ->join('mm_meeting',"mm_meeting.id =mm_attendance.meeting_id",'left')
            ->join('mm_agenda',"mm_agenda.meeting_id =mm_meeting.id",'left')
            ->from(Orm_Ad_Student_Faculty::get_table_name())
            ->get()->result_object();
    }
}

