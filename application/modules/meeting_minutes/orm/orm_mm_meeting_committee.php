<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Mm_Meeting_Committee extends Orm_Mm_Meeting {

    public function is_valid(){
        if(!License::get_instance()->check_module('committee_work')){
            return parent::is_valid();
        }

        Modules::load('committee_work');


        $committee_id = intval($this->get_ci()->input->post_get('committee_id'));

        Validator::less_than_validator('type_id', $committee_id, 1, lang('You must select one of committee'));

        $committee = Orm_C_Committee::get_instance($committee_id);

        if(!($committee && $committee->get_id())){
            Validator::set_error('type_id', lang('You must select one of committee'));
        }

        if(Validator::success()){

            $this->delete_current_committee_attendees();

            $this->set_type_id($committee_id);
            return true;
        }

        return false;
    }


    /** draw proprities for committe if exxist
    */
    public function draw_properties() {

        if(!License::get_instance()->check_module('committee_work')){
            return parent::draw_properties();
        }

        Modules::load('committee_work');

        $per_page =5;
        $committee_page = $this->get_ci()->input->post_get('page')?: 1;

        $committee_level  = intval($this->get_ci()->input->post_get('committee_level'));
        $committee_search = $this->get_ci()->input->post_get('committee_search');
        
        $committee_id = $this->get_ci()->input->post_get('committee_id')?: $this->get_type_id();
        
        if (!$committee_page) {
            $committee_page = 1;
        }
        $orm_filter =[];
        if(!empty($committee_level)) {
            $orm_filter['type'] = $committee_level;
        }

        if(!empty($committee_search)) {
            $orm_filter['title_like'] = $committee_search;
        }

        $committee_arr = Orm_C_Committee::get_all($orm_filter, $committee_page, $per_page);

        $uri  = explode("?",$_SERVER['REQUEST_URI']);

        $uri =isset($uri[1])?$uri[1]:'';

//        $pager = new Pager(array('url' => "/meeting_minutes/draw_properties?page=$committee_page&committee_id=$committee_id&type_class=Orm_Mm_Meeting_Committee&committee_search=$committee_search"));
//        $pager->set_page($committee_page);
//        $pager->set_per_page($per_page);
//        $pager->set_total_count(Orm_C_Committee::get_count($orm_filter));
//        $pager->set_pager_link_attr('data-toggle="ajaxRequest" data-target="type_filter"');

//        return $this->get_ci()->load->view('list_committee', ['committee_arr' => $committee_arr, 'pager' => $pager->render(), 'committee_id' => $committee_id], true);
        return $this->get_ci()->load->view('list_committee', ['committee_arr' => $committee_arr, 'orm_filter' => $orm_filter, 'committee_page' => $committee_page,'committee_id' => $committee_id], true);
    }

    public function save()
    {
        if(!License::get_instance()->check_module('committee_work')){
            return parent::save();
        }

        Modules::load('committee_work');
        parent::save();

        $committee = Orm_C_Committee::get_instance($this->get_type_id());


        $current_attendances = Orm_Mm_Attendance::get_model()->get_all(['meeting_id'=>$this->get_id()], 0, 0, [], Orm::FETCH_ARRAY);

        if(count($current_attendances)){
            $current_attendances = array_column($current_attendances, 'user_id');
        }

        foreach($committee->get_user_ids() as $id){
            if(in_array($id, $current_attendances)) {
                continue;
            }

            $attendance = new Orm_Mm_Attendance();
            $attendance->set_meeting_id($this->get_id());
            $attendance->set_user_id($id);
            $attendance->save();
        }

        Orm_Mm_Agenda::delete_unsigned_users($this->get_id());

        return $this->get_type_id();

    }

    /** get type of committe
    */
    public function get_type_title()
    {
        if(!License::get_instance()->check_module('committee_work')){
            return parent::get_type_title();
        }

        Modules::load('committee_work');

        return $committee = Orm_C_Committee::get_instance($this->get_type_id())->get_title();
    }

    /** get instance and type information of committee work module
    */
    public function get_type_info()
    {
        if(!License::get_instance()->check_module('committee_work')){
            return parent::get_type_info();
        }

        Modules::load('committee_work');

        return $committee = Orm_C_Committee::get_instance($this->get_type_id());
    }
    /** get instance and type members of committee work module
     */
    public function get_type_memebers()
    {
        if(!License::get_instance()->check_module('committee_work')){
            return parent::get_type_memebers();
        }

        Modules::load('committee_work');

        return $committee = Orm_C_Committee_Member::get_all(array('committee_id'=>$this->get_type_id()));
    }


    /** delete committee
     */
    private function delete_current_committee_attendees(){

        if($this->get_type_class()==self::class && $this->get_type_id()){
            $committee = Orm_C_Committee::get_instance($this->get_type_id());

            foreach($committee->get_user_ids() as $id){
                Orm_Mm_Attendance::get_one(['meeting_id' => $this->get_id(), 'user_id'=>$id])->delete();
            }
        }
    }


    /** generate components of pdf page to draw it
    */
    public function generate_pdf()
    {

        $headerText = lang('Meeting Minutes')." : ";
        $headerText .= $this->get_name(). "<br />";
        $headerText .= lang('Level')." : ";
        $headerText .= $this->get_level(true)." (".$this->get_level_id(true).")";

        $var=Orm::get_ci()->config->item('wk_pdf_options');
        $var['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($var);
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $headerText), true);

        $pdf->setOptions(array(
            'margin-top' => 27,

            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line',
            //footer
            'footer-left' => lang('Meeting Minutes')
        ));

        $pdf->addToc();

        $this->generate_pdf_page($pdf);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory();

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name =  'Meeting Minutes ('.$this->get_name().').pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }


    /** generate pages of pdf
     */
    private function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf &$pdf) {

        Orm::get_ci()->layout->set_layout('layout_pdf');

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page1', array('meeting' => $this), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page2', array('meeting' => $this), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page3', array('meeting' => $this), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page4', array('meeting' => $this), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('meeting_minutes/manage/report/page5', array('meeting' => $this), true);
        $pdf->addPage($content);
    }
}

