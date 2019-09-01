<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Data_Preparatory_Year_Model
 */
class Data_Preparatory_Year_Model extends CI_Model {
    
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
        
        $this->db->select('dpy.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Preparatory_Year::get_table_name().' AS dpy');
        
        if (isset($filters['id'])) {
            $this->db->where('dpy.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dpy.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dpy.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dpy.id', $filters['not_in_id']);
        }
        if (isset($filters['stream_id'])) {
            $this->db->where('dpy.stream_id', $filters['stream_id']);
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('dpy.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['gender'])) {
            $this->db->where('dpy.gender', $filters['gender']);
        }
        if (!empty($filters['nationality'])) {
            $this->db->where('dpy.nationality', $filters['nationality']);
        }
        if (!empty($filters['student_count'])) {
            $this->db->where('dpy.student_count', $filters['student_count']);
        }
        if (!empty($filters['teaching_staff_count'])) {
            $this->db->where('dpy.teaching_staff_count', $filters['teaching_staff_count']);
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
            return Orm_Data_Preparatory_Year::to_object($this->db->get()->row_array());
            break;
            case Orm::FETCH_OBJECTS:
            $objects = array();
            foreach($this->db->get()->result_array() as $row) {
                $objects[] = Orm_Data_Preparatory_Year::to_object($row);
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
        $this->db->insert(Orm_Data_Preparatory_Year::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Preparatory_Year::get_table_name(), $params, array('id' => (int) $id));
    }
    
    /**
    * delete item
    *
    * @param int $id
    * @return boolean
    */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Preparatory_Year::get_table_name(), array('id' => (int) $id));
    }


    public function get_by_year($year) {
        $query = "
SELECT 
	stream, 
	academic_year, 
	SUM(CASE WHEN nationality = 's' AND gender = 0 THEN student_count ELSE 0 END) AS SAUDI_MALE,
	SUM(CASE WHEN nationality = 's' AND gender = 1 THEN student_count ELSE 0 END) AS SAUDI_FEMALE,
	SUM(CASE WHEN nationality = 'o' AND gender = 0 THEN student_count ELSE 0 END) AS NONESAUDI_MALE,
	SUM(CASE WHEN nationality = 'o' AND gender = 1 THEN student_count ELSE 0 END) AS NONESAUDI_FEMALE,
	SUM(CASE WHEN nationality = 's' THEN student_count ELSE 0 END) AS SAUDI_TOTAL,
	SUM(CASE WHEN nationality = 'o' THEN student_count ELSE 0 END) AS NONESAUDI_TOTAL,
	SUM(CASE WHEN gender = 0  THEN teaching_staff_count ELSE 0 END) AS MALE_STAFF,
	SUM(CASE WHEN gender = 1  THEN teaching_staff_count ELSE 0 END) AS FEMALE_STAFF,
	CASE WHEN SUM(CASE WHEN gender = 0  THEN teaching_staff_count ELSE 0 END) = 0 THEN 0 ELSE SUM(CASE WHEN gender = 0  THEN student_count ELSE 0 END) / SUM(CASE WHEN gender = 0  THEN teaching_staff_count ELSE 0 END) END AS RATIO_MALE,
	CASE WHEN SUM(CASE WHEN gender = 1  THEN teaching_staff_count ELSE 0 END) = 0 THEN 0 ELSE SUM(CASE WHEN gender = 1  THEN student_count ELSE 0 END) / SUM(CASE WHEN gender = 1  THEN teaching_staff_count ELSE 0 END) END AS RATIO_FEMALE,
	CASE when SUM(CASE WHEN gender = 0  THEN student_count ELSE 0 END) = 0 THEN 0 ELSE SUM(CASE WHEN gender = 0  THEN completion_count ELSE 0 END) / SUM(CASE WHEN gender = 0  THEN student_count ELSE 0 END) END * 100 AS COMPLETION_RATE_MALE,
	CASE when SUM(CASE WHEN gender = 1  THEN student_count ELSE 0 END) = 0 THEN 0 ELSE SUM(CASE WHEN gender = 1  THEN completion_count ELSE 0 END) / SUM(CASE WHEN gender = 1  THEN student_count ELSE 0 END) END * 100 AS COMPLETION_RATE_FEMALE
FROM ".Orm_Data_Preparatory_Year::get_table_name()."
WHERE academic_year = {$year}
GROUP BY stream ";

        $result = $this->db->query($query);
        return $result->result_array();
    }
}

