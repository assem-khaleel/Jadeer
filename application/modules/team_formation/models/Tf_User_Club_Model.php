<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Tf_User_Club_Model
 *
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Tf_User_Club_Model extends CI_Model {

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     *
     * @return Orm_Tf_User_Club | Orm_Tf_User_Club[] | array | int
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {
        $page = (int) $page;
        $per_page = (int) $per_page;

        $this->db->select('tuc.*');
        $this->db->distinct();
        $this->db->from(Orm_Tf_User_Club::get_table_name() . ' AS tuc');

        if (isset($filters['id'])) {
            $this->db->where('tuc.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('tuc.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('tuc.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('tuc.id', $filters['not_in_id']);
        }
        if (isset($filters['user_id'])) {
            $this->db->where('tuc.user_id', $filters['user_id']);
        }
        if (isset($filters['user_id_in'])) {
            $this->db->where_in('tuc.user_id', $filters['user_id_in']);
        }
        if (isset($filters['club_id'])) {
            $this->db->where('tuc.club_id', $filters['club_id']);
        }
        if (isset($filters['status'])) {
            $this->db->where('tuc.status', $filters['status']);
        }
        if (isset($filters['is_admin'])) {
            $this->db->where('tuc.is_admin', $filters['is_admin']);
        }
        if (isset($filters['search']) && !isset($filters['club_creator'])) {

            $this->db->join(Orm_Tf_Club::get_table_name().' AS cc', 'cc.id = tuc.club_id', 'inner');
            $this->db->group_start();
            $this->db->like('cc.name_ar', $filters['search']);
            $this->db->or_like('cc.name_en', $filters['search']);
            $this->db->group_end();
        }
        if (isset($filters['club_creator'])) {
            $this->db->join(Orm_Tf_Club::get_table_name().' AS cc', 'cc.id = tuc.club_id', 'Left');
            $this->db->where('cc.creator', $filters['club_creator']);
            if (!empty($filters['search'])) {
                $this->db->group_start();
                $this->db->like('cc.name_ar', $filters['search']);
                $this->db->or_like('cc.name_en', $filters['search']);
                $this->db->group_end();
            }
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
                return Orm_Tf_User_Club::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Tf_User_Club::to_object($row);
                }
//                echo "<pre>".$this->db->last_query();die;
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
        $this->db->insert(Orm_Tf_User_Club::get_table_name(), $params);
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
        return $this->db->update(Orm_Tf_User_Club::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->delete(Orm_Tf_User_Club::get_table_name(), array('id' => $id));
    }

}
