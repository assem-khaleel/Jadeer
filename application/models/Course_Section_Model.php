<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Course_Section_Model
 */
class Course_Section_Model extends CI_Model {
    
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
        
        $this->db->select('cs.*');
        $this->db->distinct();
        $this->db->from(Orm_Course_Section::get_table_name().' AS cs');
        $this->db->where('cs.is_deleted', 0);
        $this->db->join(Orm_Course::get_table_name().' AS cr',  'cr.id = cs.course_id AND cr.is_deleted = 0', 'INNER');
        $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = cr.department_id AND d.is_deleted = 0', 'INNER');

        License::valid_colleges('d.college_id');

        if (isset($filters['department_id'])) {
            $this->db->where('d.id', $filters['department_id']);
        }
        if (isset($filters['college_id'])) {
            $this->db->where('d.college_id', $filters['college_id']);
        }
        if (!empty($filters['teacher_id'])) {
            $this->db->join(Orm_Course_Section_Teacher::get_table_name() . ' AS cst','cs.id = cst.section_id', 'left');
            $this->db->where('cst.user_id',$filters['teacher_id']);
        }
        if (isset($filters['id'])) {
            $this->db->where('cs.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('cs.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('cs.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('cs.id', $filters['not_in_id']);
        }
        if (isset($filters['integration_id'])) {
            $this->db->where('cs.integration_id', $filters['integration_id']);
        }
        if (isset($filters['course_id'])) {
            $this->db->where('cs.course_id', $filters['course_id']);
        }
        if (isset($filters['course_in'])) {
            $this->db->where_in('cs.course_id', $filters['course_in']);
        }
        if (isset($filters['semester_id'])) {
            $this->db->where('cs.semester_id', $filters['semester_id']);
        }
        if (isset($filters['campus_id'])) {
            $this->db->where('cs.campus_id', $filters['campus_id']);
        }
        if (!empty($filters['is_deleted'])) {
            $this->db->where('cs.is_deleted', $filters['is_deleted']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->join(Orm_Course_Section_Student::get_table_name().' AS css',  'css.section_id = cs.id ', 'INNER');
            $this->db->join(Orm_User::get_table_name().' AS us',  'us.id = css.user_id ', 'INNER');
            $this->db->like('cs.section_no', $filters['keyword']);
            $this->db->or_like("CONCAT(us.first_name, ' ' ,us.last_name)", $filters['keyword']);
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
            return Orm_Course_Section::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Course_Section::to_object($row);
            }
            //echo "<pre>".$this->db->last_query()."</pre><br>";
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
        $this->db->insert(Orm_Course_Section::get_table_name(), $params);
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
        return $this->db->update(Orm_Course_Section::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->update(Orm_Course_Section::get_table_name(), array('is_deleted'=>1), array('id' => (int) $id));
    }
}

