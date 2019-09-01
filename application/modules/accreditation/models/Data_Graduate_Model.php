<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Data_Graduate_Model
 */
class Data_Graduate_Model extends CI_Model {

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

        $this->db->select('dg.*');
        $this->db->distinct();
        $this->db->from(Orm_Data_Graduate::get_table_name().' AS dg');

        $this->get_filters($filters);

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Data_Graduate::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Data_Graduate::to_object($row);
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

    public function get_filters($filters) {

        License::valid_programs('dg.program_id');

        if (isset($filters['id'])) {
            $this->db->where('dg.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('dg.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('dg.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('dg.id', $filters['not_in_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('dg.program_id', $filters['program_id']);
        }
        if (!empty($filters['college_id'])) {
            $this->db->join(Orm_Program::get_table_name(). ' AS p', 'p.id = dg.program_id','inner');
            $this->db->join(Orm_Department::get_table_name(). ' AS d', 'd.id = p.department_id','inner');
            $this->db->where('d.college_id', $filters['college_id']);

            License::valid_colleges('d.college_id');
        }
        if (isset($filters['academic_year'])) {
            $this->db->where('dg.academic_year', $filters['academic_year']);
        }
        if (isset($filters['gender'])) {
            $this->db->where('dg.gender', $filters['gender']);
        }
        if (!empty($filters['nationality'])) {
            $this->db->where('dg.nationality', $filters['nationality']);
        }
        if (!empty($filters['major'])) {
            $this->db->where('dg.major', $filters['major']);
        }
        if (!empty($filters['graduate_count'])) {
            $this->db->where('dg.graduate_count', $filters['graduate_count']);
        }
        if (!empty($filters['enrolled_count'])) {
            $this->db->where('dg.enrolled_count', $filters['enrolled_count']);
        }
        if (isset($filters['program_in'])) {
            $this->db->where_in('dg.program_id', $filters['program_in']);
        }
    }

    /**
     * insert new row to the table
     *
     * @param array $params
     * @return int
     */
    public function insert($params = array()) {
        $this->db->insert(Orm_Data_Graduate::get_table_name(), $params);
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
        return $this->db->update(Orm_Data_Graduate::get_table_name(), $params, array('id' => (int) $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Data_Graduate::get_table_name(), array('id' => (int) $id));
    }

    /**
     * @param array $filters
     * @param null $type
     * @return mixed
     */
    public function get_sum($filters = array(), $type = null) {

        $this->db->select_sum('dg.graduate_count', 'graduate');
        $this->db->select_sum('dg.enrolled_count', 'enrolled');
        $this->db->from(Orm_Data_Graduate::get_table_name().' AS dg');

        $this->get_filters($filters);

        $result = $this->db->get()->row_array();

        if(!is_null($type) && isset($result[$type])) {
            $result = $result[$type];
        } elseif (!is_null($type)) {
            $result = 0;
        }
        return $result;
    }

    public function grouped_result($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

        $page = (int) $page;
        $per_page = (int) $per_page;

        $this->db->select('dg.id, dg.program_id, dg.academic_year, dg.gender, dg.nationality, sum(dg.graduate_count) as graduate_count, sum(dg.enrolled_count) as enrolled_count');
        $this->db->distinct();
        $this->db->from(Orm_Data_Graduate::get_table_name().' AS dg');
        $this->db->group_by('dg.program_id, academic_year, gender, nationality');

        $this->get_filters($filters);

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Data_Graduate::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Data_Graduate::to_object($row);
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
}

