<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Tm_Members_Model
 *
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Tm_Members_Model extends CI_Model {

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     *
     * @return Orm_Tm_Members | Orm_Tm_Members[] | array | int
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

        $page = (int) $page;
        $per_page = (int) $per_page;

        $this->db->select('tm.*');
        $this->db->distinct();
        $this->db->from(Orm_Tm_Members::get_table_name() . ' AS tm');

        if (isset($filters['id'])) {
            $this->db->where('tm.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('tm.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('tm.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('tm.id', $filters['not_in_id']);
        }
        if (isset($filters['training_id'])) {
            $this->db->where('tm.training_id', $filters['training_id']);
        }
        if (!empty($filters['in_training_id'])) {
            $this->db->where_in('tm.training_id', $filters['in_training_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('tm.user_id', $filters['user_id']);
        } 
        if (isset($filters['status'])) {
            $this->db->where('tm.status', $filters['status']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->join(Orm_User::get_table_name().' AS user', 'user.id = tm.user_id', 'INNER');
            $this->db->group_start();
            $this->db->like('user.first_name', $filters['keyword']);
            $this->db->or_like('user.last_name', $filters['keyword']);
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
                return Orm_Tm_Members::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Tm_Members::to_object($row);
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
        $this->db->insert(Orm_Tm_Members::get_table_name(), $params);
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
        return $this->db->update(Orm_Tm_Members::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Tm_Members::get_table_name(), array('id' => $id));
    }

}
