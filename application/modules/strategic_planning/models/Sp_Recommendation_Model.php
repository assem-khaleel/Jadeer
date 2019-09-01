<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 * Class Sp_Recommendation_Model
 */
class Sp_Recommendation_Model extends CI_Model
{

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
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS)
    {

        $page = (int)$page;
        $per_page = (int)$per_page;

        $this->db->select('sr.*');
        $this->db->distinct();
        $this->db->from(Orm_Sp_Recommendation::get_table_name().' AS sr');

        License::valid_programs('sr.program_id');

        if (isset($filters['id'])) {
            $this->db->where('sr.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('sr.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('sr.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('sr.id', $filters['not_in_id']);
        }
        if (isset($filters['recommendation_type_id'])) {
            $this->db->where('sr.recommendation_type_id', $filters['recommendation_type_id']);
        }
        if (isset($filters['program_id'])) {
            $this->db->where('sr.program_id', $filters['program_id']);
        }
        if (isset($filters['college_id'])) {
            $this->db->join(Orm_Program::get_table_name() . ' AS p', 'p.id = sr.program_id', 'inner');
            $this->db->join(Orm_Department::get_table_name() . ' AS d', 'd.id = p.department_id', 'inner');
            $this->db->where('d.college_id', $filters['college_id']);

            License::valid_colleges('d.college_id');
        }
        if (!empty($filters['academic_year'])) {
            $this->db->where('sr.academic_year', $filters['academic_year']);
        }
        if (!empty($filters['title_en'])) {
            $this->db->where('sr.title_en', $filters['title_en']);
        }
        if (!empty($filters['title_ar'])) {
            $this->db->where('sr.title_ar', $filters['title_ar']);
        }

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                return Orm_Sp_Recommendation::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Sp_Recommendation::to_object($row);
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
    public function insert($params = array())
    {
        $this->db->insert(Orm_Sp_Recommendation::get_table_name(), $params);
        return $this->db->insert_id();
    }

    /**
     * update item
     *
     * @param int $id
     * @param array $params
     * @return boolean
     */
    public function update($id, $params = array())
    {
        return $this->db->update(Orm_Sp_Recommendation::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_Sp_Recommendation::get_table_name(), array('id' => (int)$id));
    }

}

