<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_Section_Student_Model extends CI_Model {
    
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
        
        $this->db->select('css.*');
        $this->db->distinct();
        $this->db->from(Orm_Course_Section_Student::get_table_name().' AS css');
        $this->db->join(Orm_User::get_table_name().' AS u', 'u.id = css.user_id AND u.is_active = 1', 'INNER');

        if (isset($filters['semester_id'])) {
            $this->db->join(Orm_Course_Section::get_table_name().' AS cs', 'cs.id = css.section_id', 'INNER');
            $this->db->where('cs.semester_id', $filters['semester_id']);
        }

        if (isset($filters['id'])) {
            $this->db->where('css.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('css.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('css.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('css.id', $filters['not_in_id']);
        }
        if (isset($filters['section_id'])) {
            $this->db->where('css.section_id', $filters['section_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('css.user_id', $filters['user_id']);
        }
        if (isset($filters['section_id_in'])) {
            $this->db->where_in('css.section_id', $filters['section_id_in']);
        }
        if (isset($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like('first_name', $filters['keyword']);
            $this->db->or_like('last_name', $filters['keyword']);
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
            return Orm_Course_Section_Student::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Course_Section_Student::to_object($row);
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
        $this->db->insert(Orm_Course_Section_Student::get_table_name(), $params);
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
        return $this->db->update(Orm_Course_Section_Student::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Course_Section_Student::get_table_name(), array('id' => (int) $id));
    }

    public function get_total_students($course_id) {
        $semester_id = Orm_Semester::get_active_semester_id();

        $this->db->select('count(user_id) as std_count');
        $this->db->from(Orm_Course_Section_Student::get_table_name() . ' AS css');
        $this->db->join(Orm_Course_Section::get_table_name() . ' AS cs', 'css.section_id = cs.id');
        $this->db->where('cs.course_id', $course_id);
        $this->db->where('cs.semester_id' , $semester_id);

        $result = $this->db->get()->row_array();

        return isset($result['std_count']) ? $result['std_count'] : 0;
    }
    
}

