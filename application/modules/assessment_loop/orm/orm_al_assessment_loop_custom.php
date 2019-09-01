<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orm_Al_Assessment_Loop_Custom extends Orm_Al_Assessment_Loop {

    protected $item_class = __CLASS__;

     /**draw properties page to draw properties for custom assessment loop after check credentials for program learning outcome
     */

    public function draw_properties() {


        echo Orm::get_ci()->load->view('types/custom/properties', array('assessment_loop' => $this), true);
    }

    /** check validation for object and components of object , if sucess save and return true
    */
    public function is_valid(){
        $ci = Orm::get_ci();
        $title = $ci->input->post('title');
        $desc = $ci->input->post('desc')?: '';

        $custom = Orm_Al_Custom::get_instance($this->get_item_id());

        Validator::required_field_validator('title', $title, lang('Required Filed'));
        Validator::required_field_validator('desc', $desc, lang('Required Filed'));
        Validator::database_unique_field_validator($custom, 'title', 'title', $title, lang('Unique Field'));

        Uploader::validator('attachment',true, $custom->get_attachment());

        if($this->get_item_id() == -1) {
            $this->set_item_id(0);
        }

        $custom->set_title($title);
        $custom->set_description($desc);

        if(Validator::success()) {

            $file = Uploader::do_process('attachment', '/files/Documents/' . $this->get_attachments_directory($this->get_item_type(), $this->get_item_type_id()) . '/' . $this->get_item_id());
            if($file) {
                $custom->set_attachment($file);
            }

            if ($custom->save()) {
                $this->set_item_id($custom->get_id());
                return true;
            }
        }

        return false;
    }

    public function get_item_title() {
        return Orm_Al_Custom::get_instance($this->get_item_id())->get_title();
    }

    /** find path of files and return array of files
    */
    public static function mime_type($file, $mime_types = array()) {

        $file = FCPATH . ltrim(str_replace(FCPATH, '', $file), DIRECTORY_SEPARATOR);
        $file_exists = $file && file_exists($file);

        if ($file_exists) {

            if (!is_array($mime_types)) {
                $mime_types = array($mime_types);
            }

            $lower_mime_types = array();
            foreach ($mime_types as $mime_type) {
                $lower_mime_types[strtolower($mime_type)] = strtolower($mime_type);
            }

            $file_type = @mime_content_type($file);

            if ($file_type) {
                if (in_array(strtolower($file_type), $lower_mime_types)) {
                    return true;
                }
            }
        }

        return false;
    }

    /** draw custom object when return files from mime type function
    */
    public function draw($pdf = false) {

        $custom = Orm_Al_Custom::get_instance($this->get_item_id());
        $desc = htmlfilter($custom->get_description());
        $description_title = lang('Description');
        if(self::mime_type($custom->get_attachment(), array('image/png', 'image/gif', 'image/jpeg', 'image/xbm'))) {


            $attachment = base_url($custom->get_attachment());
            $html = "<img src='{$attachment}' class='img-responsive' />";
        } else {
            $title = lang('Download');

            $attachment = base_url($custom->get_attachment());
            $html = "<a href='{$attachment}' target='_blank'>{$title}</a>";
        }

        return <<<HTML
        <div>{$html}</div>
        <h2 class="m-y-1">{$description_title}</h2>
        <p>{$desc}</p>
HTML;
    }

    /** draw pdf page for custom assessment loop type
     */
    public function generate_pdf() {
        $title=preg_replace('/([^\w\p{Arabic}]|[_])+/u', " ",$this->get_item_title());

        $headerText = lang('Assessment Loop')." : ";
        $headerText .= $title. "<br />";
        $headerText .= lang('Level')." : ";
        $headerText .= $this->get_item_types()[$this->get_item_type()];

        switch ($this->get_item_type()) {
            case Orm_Al_Assessment_Loop::ASSESSMENT_COLLEGE_LEVEL:
                $headerText .= " (". preg_replace('/([^\w\p{Arabic}]|[_])+/u', " ",Orm_College::get_instance($this->get_item_type_id())->get_name()) .")";
                break;
            case Orm_Al_Assessment_Loop::ASSESSMENT_PROGRAM_LEVEL:
                $headerText .= " (".preg_replace('/([^\w\p{Arabic}]|[_])+/u', " ",Orm_Program::get_instance($this->get_item_type_id())->get_name()).")";
                break;
        }
        $config_array = Orm::get_ci()->config->item('wk_pdf_options');
        $config_array['zoom']=1.5;
        $pdf = new \mikehaertl\wkhtmlto\Pdf($config_array);
        $header_html = Orm::get_ci()->load->view('pdf_header', array('header' => $headerText), true);

        $pdf->setOptions(array(
            'margin-top' => 27,
            //header
            'header-html' => $header_html,
            'header-spacing' => 2,
            'header-line',
            'footer-left' => lang('Assessment Loop')
        ));

        $pdf->addToc();

        $this->generate_pdf_page($pdf);

        $files_dir = '/files/Documents/' . $this->get_attachments_directory($this->get_item_type(), $this->get_item_type_id());

        //check if file exists or not
        $files_fulldir = rtrim(FCPATH, '/') . $files_dir;
        if (!is_dir($files_fulldir)) {
            mkdir($files_fulldir, 0777, true);
        }

        $name =  'Assessment Loop ('.$title.').pdf';
        $file_name = rtrim($files_fulldir, '/') . '/' . $name;

        // Save the PDF
        $pdf->saveAs($file_name);
        if (!$pdf->send($name)) {
            echo $pdf->getCommand()->getOutput();
            die($pdf->getError());
        }
    }

    /** set layout for pdf page and draw it
     */
    public function generate_pdf_page(\mikehaertl\wkhtmlto\Pdf $pdf) {

        Orm::get_ci()->layout->set_layout('layout_pdf');

        $content = Orm::get_ci()->layout->content_as_html(true)->view($this->draw(true), array(), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/analysis', array('analysis' => $this->get_analysis_obj()), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/measure', array('measures' => $this->get_measure_objs()), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/result', array('results' => $this->get_result_objs()), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/recommendation', array('recommendations' => $this->get_recommendation_objs()), true);
        $pdf->addPage($content);

        $content = Orm::get_ci()->layout->content_as_html(false)->view('assessment_loop/report/action', array('actions' => $this->get_action_objs()), true);
        $pdf->addPage($content);
    }

}

