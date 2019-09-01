<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_mysqli_driver $db
 * @property CI_Config $config
 *
 * Class User_Model
 */
class User_Model extends CI_Model
{

    /**
     * get table rows according to the assigned filters and page
     *
     * @param array $filters
     * @param int $page
     * @param int $per_page
     * @param array $orders
     * @param int $fetch_as
     * @return array|int|Orm_User
     */
    public function get_all($filters = array(), $page = 0, $per_page = 10, $orders = array(), $fetch_as = Orm::FETCH_OBJECTS)
    {

        $page = (int)$page;
        $per_page = (int)$per_page;

        $this->db->select('u.*');
        $this->db->distinct();
        $this->db->from(Orm_User::get_table_name().' AS u');

        $this->get_filters($filters);

        if ($orders) {
            $this->db->order_by(implode(',', $orders));
        }

        if ($page) {
            $offset = ($page - 1) * $per_page;
            $this->db->limit($per_page, $offset);
        }

        switch ($fetch_as) {
            case Orm::FETCH_OBJECT:
                $row = $this->db->get()->row_array();
                return Orm_User::to_object(Orm_User::get_user_data($row), (empty($row['class_type']) ? Orm_User_Default::class : $row['class_type']));
                break;
            case Orm::FETCH_OBJECTS:
                $objects = array();
                foreach ($this->db->get()->result_array() as $row) {
                    $objects[] = Orm_User::to_object(Orm_User::get_user_data($row), (empty($row['class_type']) ? Orm_User_Default::class : $row['class_type']));
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

    public function get_filters($filters, $alias = 'u')
    {

        if (!isset($filters['skip_active'])) {
            $this->db->where("{$alias}.is_active", 1);
        }

        if (isset($filters['id'])) {
            $this->db->where("{$alias}.id", $filters['id']);
        }
        if (isset($filters['not_id'])) {
            $this->db->where("{$alias}.id !=", $filters['not_id']);
        }
        if (!empty($filters['in_id'])) {
            $this->db->where_in("{$alias}.id", $filters['in_id']);
        }
        if (!empty($filters['not_in_id'])) {
            $this->db->where_not_in("{$alias}.id", $filters['not_in_id']);
        }
        if (!empty($filters['query_not_in_id']) && $filters['encryption_key'] === $this->config->item('encryption_key')) {
            $query = $filters['query_not_in_id'];
            $this->db->where_not_in("{$alias}.id", $query, false);
        }
        if (!empty($filters['class_type'])) {
            $this->db->where("{$alias}.class_type", $filters['class_type']);
        }
        if (!empty($filters['login_id'])) {
            $this->db->where("{$alias}.login_id", $filters['login_id']);
        }
        if (!empty($filters['integration_id'])) {
            $this->db->where("{$alias}.integration_id", $filters['integration_id']);
        }
        if (!empty($filters['like_integration_id'])) {
            $this->db->like("{$alias}.integration_id", $filters['like_integration_id'], 'after');
        }
        if (!empty($filters['email'])) {
            $this->db->where("{$alias}.email", $filters['email']);
        }
        if (!empty($filters['password'])) {
            $this->db->where("{$alias}.password", $filters['password']);
        }
        if (!empty($filters['birth_date'])) {
            $this->db->where("{$alias}.birth_date", $filters['birth_date']);
        }
        if (!empty($filters['last_login'])) {
            $this->db->where("{$alias}.last_login", $filters['last_login']);
        }
        if (!empty($filters['avatar'])) {
            $this->db->where("{$alias}.avatar", $filters['avatar']);
        }
        if (!empty($filters['first_name'])) {
            $this->db->where("{$alias}.first_name", $filters['first_name']);
        }
        if (!empty($filters['last_name'])) {
            $this->db->where("{$alias}.last_name", $filters['last_name']);
        }
        if (isset($filters['gender'])) {
            $this->db->where("{$alias}.gender", $filters['gender']);
        }
        if (!empty($filters['nationality'])) {
            $this->db->where("{$alias}.nationality", $filters['nationality']);
        }
        if (!empty($filters['phone'])) {
            $this->db->where("{$alias}.phone", $filters['phone']);
        }
        if (!empty($filters['fax_no'])) {
            $this->db->where("{$alias}.fax_no", $filters['fax_no']);
        }
        if (!empty($filters['office_no'])) {
            $this->db->where("{$alias}.office_no", $filters['office_no']);
        }
        if (!empty($filters['address'])) {
            $this->db->where("{$alias}.address", $filters['address']);
        }
        if (!empty($filters['token'])) {
            $this->db->where("{$alias}.token", $filters['token']);
        }
        if (!empty($filters['theme'])) {
            $this->db->where("{$alias}.theme", $filters['theme']);
        }
        if (!empty($filters['theme_fixed_navbar'])) {
            $this->db->where("{$alias}.theme_fixed_navbar", $filters['theme_fixed_navbar']);
        }
        if (!empty($filters['theme_fixed_menu'])) {
            $this->db->where("{$alias}.theme_fixed_menu", $filters['theme_fixed_menu']);
        }
        if (!empty($filters['theme_flip_menu'])) {
            $this->db->where("{$alias}.theme_flip_menu", $filters['theme_flip_menu']);
        }
        if (!empty($filters['keyword'])) {
            $this->db->group_start();
            $this->db->like("{$alias}.email",$filters['keyword']);
            $this->db->or_like("{$alias}.login_id",$filters['keyword']);
            $this->db->or_like("{$alias}.integration_id",$filters['keyword']);
            $this->db->or_like("CONCAT({$alias}.first_name, ' ' ,{$alias}.last_name)", $filters['keyword']);
            $this->db->group_end();
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
        $this->db->insert(Orm_User::get_table_name(), $params);
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
        return $this->db->update(Orm_User::get_table_name(), $params, array('id' => (int)$id));
    }

    /**
     * delete item
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->db->delete(Orm_User::get_table_name(), array('id' => (int)$id));
    }

    public function get_by_user_id($user_id)
    {
        //do nothing
    }

}

