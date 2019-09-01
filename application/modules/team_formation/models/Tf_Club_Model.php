<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Tf_Club_Model
 *
 * @property CI_DB_query_builder | CI_DB_mysqli_driver $db
 */
class Tf_Club_Model extends CI_Model {

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     *
     * @return Orm_Tf_Club | Orm_Tf_Club[] | array | int
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS) {

        $page = (int) $page;
        $per_page = (int) $per_page;

        $this->db->select('tc.*');
        $this->db->distinct();
        $this->db->from(Orm_Tf_Club::get_table_name() . ' AS tc');
        $this->db->where('tc.is_deleted', 0);

        if (isset($filters['id'])) {
            $this->db->where('tc.id', $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where('tc.id !=', $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in('tc.id', $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in('tc.id', $filters['not_in_id']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('tc.name_ar', $filters['name_ar']);
        }
        if (!empty($filters['name_en'])) {
            $this->db->where('tc.name_en', $filters['name_en']);
        }
        if (!empty($filters['policies_en'])) {
            $this->db->where('tc.policies_en', $filters['policies_en']);
        }
        if (!empty($filters['policies_ar'])) {
            $this->db->where('tc.policies_ar', $filters['policies_ar']);
        }
        if (!empty($filters['description_en'])) {
            $this->db->where('tc.description_en', $filters['description_en']);
        }
        if (!empty($filters['description_ar'])) {
            $this->db->where('tc.description_ar', $filters['description_ar']);
        }
        if (isset($filters['creator'])) {
            $this->db->where('tc.creator', $filters['creator']);
        }
        if (isset($filters['not_creator'])) {
            $this->db->where('tc.creator !=', $filters['not_creator']);
        }
        if (isset($filters['approval_post'])) {
            $this->db->where('tc.approval_post', $filters['approval_post']);
        }
        if (!empty($filters['logo'])) {
            $this->db->where('tc.logo', $filters['logo']);
        }
        if (!empty($filters['cover'])) {
            $this->db->where('tc.cover', $filters['cover']);
        }
        if (isset($filters['member_gender'])) {
            $this->db->where('tc.member_gender', $filters['member_gender']);
        }
        if (!empty($filters['name_ar'])) {
            $this->db->where('tc.name_ar', '%'.$filters['name_ar'].'%');
        }
        if (!empty($filters['gender'])) {
            $this->db->group_start();
            $this->db->where('tc.member_gender', $filters['gender']);
            $this->db->or_where('tc.member_gender', 0);
            $this->db->group_end();
        }
        if (!empty($filters['name_en'])) {
            $this->db->like('tc.name_en', '%'.$filters['name_en'].'%');
        }
        if (!empty($filters['search'])) {
            $this->db->group_start();
            $this->db->like('tc.name_ar', $filters['search']);
            $this->db->or_like('tc.name_en', $filters['search']);
            $this->db->group_end();
        }
        
        if (isset($filters['status']) && isset($filters['user_id'])) {
            $this->db->join(Orm_Tf_User_Club::get_table_name().' AS cc', 'tc.id = cc.club_id', 'Left');
            $this->db->group_start();
            $this->db->where('cc.status', $filters['status']);
            $this->db->where('cc.user_id', $filters['user_id']);
            $this->db->group_end();
        }
        if (isset($filters['not_member'])) {
            $this->db->join(Orm_Tf_User_Club::get_table_name().' AS cc', 'tc.id = cc.club_id', 'Left');
            $this->db->where('cc.status !=', Orm_Tf_User_Club::CLUB_MEMEBER);
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
                return Orm_Tf_Club::to_object($this->db->get()->row_array());
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_Tf_Club::to_object($row);
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
        $this->db->insert(Orm_Tf_Club::get_table_name(), $params);
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
        return $this->db->update(Orm_Tf_Club::get_table_name(), $params, array('id' => $id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id) {
        return $this->db->update(Orm_Tf_Club::get_table_name(), array('is_deleted' => 1), array('id' => $id));
    }

    public function last_query(){
        return $this->db->last_query();
    }
}

