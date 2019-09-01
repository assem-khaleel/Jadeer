<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Is_Industrial_Relation_Model
 *
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Is_Industrial_Relation_Model extends CI_Model {

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     *
     * @return Orm_Is_Industrial_Relation | Orm_Is_Industrial_Relation[] | array | int
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

        $page = (int) $page;
        $per_page = (int) $per_page;

        $this->db->select('iir.*');
        $this->db->distinct();
        $this->db->from(Orm_Is_Industrial_Relation::get_table_name() . ' AS iir');

        if (isset($filters['id'])) {
            $this->db->where('iir.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('iir.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('iir.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('iir.id', $filters['not_in_id']);
        }
        if (!empty($filters['not_in_rubric_row_id'])) {
            $this->db->where_not_in('iir.rubric_row_id', $filters['not_in_rubric_row_id']);
        }
        if (isset($filters['industrial_id'])) {
            $this->db->where('iir.industrial_id', $filters['industrial_id']);
        }
        if (isset($filters['rubric_row_id'])) {
            $this->db->where('iir.rubric_row_id', $filters['rubric_row_id']);
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
                return Orm_Is_Industrial_Relation::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Is_Industrial_Relation::to_object($row);
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
        $this->db->insert(Orm_Is_Industrial_Relation::get_table_name(), $params);
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
        return $this->db->update(Orm_Is_Industrial_Relation::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Is_Industrial_Relation::get_table_name(), array('id' => $id));
    }

}

