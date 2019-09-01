<?php

/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 20/12/17
 * Time: 09:04
 */
class Manage extends MX_Controller
{
    private $view_params = array();
    private $header_array = array();

    /**
     * Manage constructor.
     */
    public function __construct()
    {
        parent::__construct();

        if (!License::get_instance()->check_module('faculty_portfolio', true)) {
            show_404();
        }

        Orm_User::check_logged_in();

        Orm_User::check_permission([Orm_User::USER_STAFF], false, 'faculty_portfolio-manage');


        $this->breadcrumbs->push(lang('Faculty Portfolio'), '/faculty_portfolio');
        $this->breadcrumbs->push(lang('Manage'), '/faculty_portfolio/manage');

        $this->layout->add_javascript('/assets/jadeer/js/tinymce/tinymce.min.js', false);


        $this->view_params['menu_tab'] = 'faculty_portfolio';

        $this->header_array = array(
            'title' => lang('Manage'),
            'icon' => 'fa fa-gears'
        );
    }

    /**
     *this function index
     * @return string the html view
     */
    public function index()
    {

        $this->header_array['link_attr'] = 'href="/faculty_portfolio/manage/legend"';
        $this->header_array['link_title'] = lang('Manage') . ' ' . lang('Legend');
        $this->header_array['link_icon'] = 'th-list';

        $this->view_params['page_header'] = $this->load->view('/common/page_header', $this->header_array, true);


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($this->config->item('per_page'));
        $pager->set_page((int)$this->input->get_post('page') ?: 1);
        $pager->set_total_count(Orm_Fp_Eva_Tabs::get_count());

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['tabs'] = Orm_Fp_Eva_Tabs::get_all([], $pager->get_page(), $pager->get_per_page());


        $this->layout->view('manage/list', $this->view_params);
    }

    /**
     * this function add edit tab by itsid
     * @param int $id the id of the add edit tab to be viewed
     * @redirect success or error
     */
    public function add_edit_tab($id = 0)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $tab = Orm_Fp_Eva_Tabs::get_instance($id);

        if (intval($id) > 0 && !$tab->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        $this->view_params['tab'] = $tab;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $title_ar = $this->input->post('title_ar');
            $title_en = $this->input->post('title_en');
            $points = intval($this->input->post('points'));
            $legend_id = intval($this->input->post('legend_id'));

            $tab->set_title_ar($title_ar);
            $tab->set_title_en($title_en);
            $tab->set_points($points);
            $tab->set_legend_id($legend_id);


            if (!Orm_Fp_Legend::get_instance($legend_id)->get_id()) {
                Validator::set_error('legend_id', lang('field required'));
            }

            Validator::required_field_validator('title_ar', $title_ar, lang('field required'));
            Validator::required_field_validator('title_en', $title_en, lang('field required'));
            Validator::less_than_validator('points', $points, 1, lang('field required'));


            if (Validator::success()) {
                $tab->save();

                Validator::set_success_flash_message(lang('Evaluation Successfully Saved'));
                json_response(['success' => true]);
            }

            json_response(['success' => false, 'html' => $this->load->view('manage/add_edit_tabs', $this->view_params, true)]);
        }

        $this->load->view('manage/add_edit_tabs', $this->view_params);
    }

    /**
     * this function delete tab by its id
     * @param int $id the id of the delete tab to be viewed
     * @redirect success or error
     */
    public function delete_tab($id = 0)
    {

        $tab = Orm_Fp_Eva_Tabs::get_instance($id);

        if (intval($id) > 0 && !$tab->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$tab->have_evaluation()) {
            $tab->delete();
            Validator::set_success_flash_message(lang('Evaluation has Deleted'));
        } else {
            Validator::set_error_flash_message(lang('The resource you requested does not able to delete!'));
        }

        if (!$this->input->is_ajax_request()) {
            redirect(base_url('/faculty_portfolio/manage'));
        }
    }

    /**
     * this function manage tab by its id tab
     * @param int $id_tab the id of the manage tab to be viewed
     * @redirect success or error
     */
    public function manage_tab($id_tab = 0)
    {

        $tab = Orm_Fp_Eva_Tabs::get_instance($id_tab);

        if (!$tab->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if ($tab->have_evaluation()) {
            echo error_dialog(lang('The resource you requested could not manage!'));
            exit();
        }

        $this->view_params['tab'] = $tab;

        $this->view_params['rows'] = $tab->get_tab_rows();
        $this->view_params['cols'] = $tab->get_tab_cols();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $row_ids = (array)$this->input->post('row_id');
            $row_title_ar = (array)$this->input->post('row_title_ar');
            $row_title_en = (array)$this->input->post('row_title_en');

            foreach ($row_ids as $key => $id) {
                Validator::required_field_validator('row_title_ar', $row_title_ar[$key], lang('field required'), $key);
                Validator::required_field_validator('row_title_en', $row_title_en[$key], lang('field required'), $key);

                if ($id == 0) {
                    $row = new Orm_Fp_Eva_Tab_Row();
                    $row->set_title_ar($row_title_ar[$key]);
                    $row->set_title_en($row_title_en[$key]);
                    $row->set_eva_tab_id($id_tab);

                    $this->view_params['rows'][] = $row;
                } else {
                    /** @var Orm_Fp_Eva_Tab_Row $row */
                    foreach ($this->view_params['rows'] as $row) {
                        if ($row->get_id() == $id) {
                            $row->set_title_ar($row_title_ar[$key]);
                            $row->set_title_en($row_title_en[$key]);
                            $row->set_eva_tab_id($id_tab);

                            break;
                        }
                    }
                }
            }


            $col_ids = (array)$this->input->post('col_id');
            $col_title_ar = (array)$this->input->post('col_title_ar');
            $col_title_en = (array)$this->input->post('col_title_en');


            foreach ($col_ids as $key => $id) {
                Validator::required_field_validator('col_title_ar', $col_title_ar[$key], lang('field required'), $key);
                Validator::required_field_validator('col_title_en', $col_title_en[$key], lang('field required'), $key);

                if ($id == 0) {
                    $col = new Orm_Fp_Eva_Tab_Col();
                    $col->set_title_ar($col_title_ar[$key]);
                    $col->set_title_en($col_title_en[$key]);
                    $col->set_eva_tab_id($id_tab);

                    $this->view_params['cols'][] = $col;
                } else {
                    /** @var Orm_Fp_Eva_Tab_Col $col */
                    foreach ($this->view_params['cols'] as $col) {
                        if ($col->get_id() == $id) {
                            $col->set_title_ar($col_title_ar[$key]);
                            $col->set_title_en($col_title_en[$key]);
                            $col->set_eva_tab_id($id_tab);

                            break;
                        }
                    }
                }
            }

            if (Validator::success()) {

                foreach ($this->view_params['rows'] as $row) {
                    if (in_array($row->get_id(), $row_ids) || $row->get_id() == 0) {
                        $row->save();
                    } else {
                        $row->delete();
                    }
                }

                foreach ($this->view_params['cols'] as $col) {
                    if (in_array($col->get_id(), $col_ids) || $col->get_id() == 0) {
                        $col->save();
                    } else {
                        $col->delete();
                    }
                }

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success' => true]);
            }

            json_response(['success' => false, 'html' => $this->load->view('manage/manage_tab', $this->view_params, true)]);
        }


        $this->load->view('manage/manage_tab', $this->view_params);
    }

    /**
     *this function legend
     * @redirect success or error
     */
    public function legend()
    {

        $this->breadcrumbs->push(lang('Legends'), '/faculty_portfolio/manage/legend');


        $this->header_array['link_attr'] = 'href="/faculty_portfolio/manage/add_edit_legend" data-toggle="ajaxModal"';
        $this->header_array['link_title'] = lang('Add New');
        $this->header_array['link_icon'] = 'plus';


        $this->header_array['title'] = lang('Manage').' '.lang('Legends');
        $this->header_array['icon'] = 'fa fa-gear';


        $this->view_params['page_header'] = $this->load->view('/common/page_header', $this->header_array, true);


        $pager = new Pager(array('url' => $this->input->server('REQUEST_URI')));
        $pager->set_per_page($this->config->item('per_page'));
        $pager->set_page((int)$this->input->get_post('page') ?: 1);
        $pager->set_total_count(Orm_Fp_Legend::get_count());

        $this->view_params['pager'] = $pager->render(true);
        $this->view_params['legends'] = Orm_Fp_Legend::get_all([], $pager->get_page(), $pager->get_per_page());


        $this->layout->view('manage/legend_list', $this->view_params);
    }

    /**
     * this function add edit legend by its id
     * @param int $id the id of the add edit legend to be viewed
     * @redirect success or error
     */
    public function add_edit_legend($id = 0)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }


        $legend = Orm_Fp_Legend::get_instance($id);

        if (intval($id) > 0 && !$legend->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        $this->view_params['legend'] = $legend;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $title_ar = $this->input->post('title_ar');
            $title_en = $this->input->post('title_en');

            $legend->set_title_ar($title_ar);
            $legend->set_title_en($title_en);


            Validator::required_field_validator('title_ar', $title_ar, lang('field required'));
            Validator::required_field_validator('title_en', $title_en, lang('field required'));


            if (Validator::success()) {
                $legend->save();

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success' => true]);
            }

            json_response(['success' => false, 'html' => $this->load->view('manage/add_edit_legend', $this->view_params, true)]);
        }

        $this->load->view('manage/add_edit_legend', $this->view_params);
    }

    /**
     * this function delete legend by its id
     * @param int id the id of the delete legend to be viewed
     * @redirect success or error
     */
    public function delete_legend($id = 0)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $legend = Orm_Fp_Legend::get_instance($id);

        if (intval($id) > 0 && !$legend->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if (!$legend->used()) {
            $legend->delete();
            Validator::set_success_flash_message(lang('Legend has Deleted'));
        } else {
            Validator::set_error_flash_message(lang('The resource you requested does not able to delete!'));
        }

        if (!$this->input->is_ajax_request()) {
            redirect(base_url('/faculty_portfolio/manage/legend'));
        }
    }

    /**
     * this function manage legend by its legend id
     * @param int $legend_id the legend id of the manage legend to be viewed
     * @redirect success or error
     */
    public function manage_legend($legend_id = 0)
    {

        if (!$this->input->is_ajax_request()) {
            Validator::set_error_flash_message(lang('No direct script access allowed'));
            redirect('/');
        }

        $tab = Orm_Fp_Legend::get_instance($legend_id);

        if (!$tab->get_id()) {
            Validator::set_error_flash_message(lang('The resource you requested does not exist!'));
            redirect(base_url('/'));
        }

        if ($tab->used()) {
            echo error_dialog(lang('The resource you requested could not manage!'));
            exit();
        }

        $this->view_params['legend_id'] = $legend_id;
        $this->view_params['items'] = $tab->get_items();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $ids = (array)$this->input->post('id');
            $legend_ar = (array)$this->input->post('legend_ar');
            $legend_en = (array)$this->input->post('legend_en');
            $min = (array)$this->input->post('min');
            $max = (array)$this->input->post('max');
            $desc_en = (array)$this->input->post('desc_en');
            $desc_ar = (array)$this->input->post('desc_ar');

            foreach ($ids as $key => $id) {
                Validator::required_field_validator('legend_ar', $legend_ar[$key], lang('field required'), $key);
                Validator::required_field_validator('legend_en', $legend_en[$key], lang('field required'), $key);
                Validator::less_than_validator('min', $min[$key], 0, lang('field required'), $key);
                Validator::less_than_validator('max', $max[$key], $min[$key], lang('field required and value should greater or equal than min value'), $key);
                Validator::greater_than_validator('max', $max[$key], 100, lang('value should not greater than 100'), $key);

                if ($id == 0) {
                    $item = new Orm_Fp_Legend_Desc();
                    $item->set_legend_ar($legend_ar[$key]);
                    $item->set_legend_en($legend_en[$key]);
                    $item->set_min($min[$key]);
                    $item->set_max($max[$key]);
                    $item->set_desc_en($desc_en[$key]);
                    $item->set_desc_ar($desc_ar[$key]);
                    $item->set_legend_id($legend_id);

                    $this->view_params['items'][] = $item;
                } else {
                    /** @var Orm_Fp_Legend_Desc $item */
                    foreach ($this->view_params['items'] as $item) {
                        if ($item->get_id() == $id) {
                            $item->set_legend_ar($legend_ar[$key]);
                            $item->set_legend_en($legend_en[$key]);
                            $item->set_min($min[$key]);
                            $item->set_max($max[$key]);
                            $item->set_desc_en($desc_en[$key]);
                            $item->set_desc_ar($desc_ar[$key]);
                            $item->set_legend_id($legend_id);

                            break;
                        }
                    }
                }
            }


            if (Validator::success()) {

                foreach ($this->view_params['items'] as $item) {
                    if (in_array($item->get_id(), $ids) || $item->get_id() == 0) {
                        $item->save();
                    } else {
                        $item->delete();
                    }
                }

                Validator::set_success_flash_message(lang('Successfully Saved'));
                json_response(['success' => true]);
            }

            json_response(['success' => false, 'html' => $this->load->view('manage/manage_legend', $this->view_params, true)]);
        }


        $this->load->view('manage/manage_legend', $this->view_params);
    }

}