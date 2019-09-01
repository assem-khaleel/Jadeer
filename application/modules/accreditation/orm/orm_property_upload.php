<?php

class Orm_Property_Upload extends Orm_Property
{

    public function draw_html()
    {
        if ($this->get_readonly()) {
            return $this->draw_report();
        }

        $html = '<div class="form-group">';

        $html .= '<div class="panel panel-primary">';

        if ($this->get_description()) {
            $html .= '<div class="panel-heading">';
            $html .= '<span class="panel-title">' . nl2br(htmlfilter($this->get_description())) . '</span>';
            if ($this->get_hint()) {
                $html .= '<div class="panel-heading-controls col-sm-4" >';
                $html .= '<button type="button" class="btn popover-primary" id="popover-' . $this->get_id() . '" data-toggle="popover" data-placement="left" data-content="' . $this->get_hint() . '" data-title="' . lang('Help') . '" >' . lang('Help') . '</button>';
                $html .= '</div>';
                $html .= "<script> $('#popover-{$this->get_id()}').popover({html : true}); </script>";
            }
            $html .= '</div>';
        }

        $html .= '<div class="panel-body">';

        $html .= '<input type="hidden" name="properties[' . htmlfilter($this->get_name()) . ']" />';

        $html .= '<table class="table table-striped">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th class="col-md-1">#</th>';
        $html .= '<th class="col-md-9">Attachments</th>';
        $html .= '<th class="col-md-2">Actions</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody id="files_wrapper_' . $this->get_id() . '">';
        if ($this->get_value() && is_array($this->get_value())) {
            foreach ($this->get_value() as $key => $value) {
                $html .= '<tr>';
                $html .= '<td scope="row">' . ($key + 1) . '</td>';
                $html .= '<td>' . urldecode(preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($value))) . '<input type="hidden" value="' . $value . '" name="properties[' . htmlfilter($this->get_name()) . '][' . $key . ']" /></td>';
                $html .= '<td style="padding-right: 0px;"><a href="' . base_url($value) . '" target="_blank" class="btn" >View</a> <a class="btn" onclick="remove_option_' . htmlfilter($this->get_id()) . '(this);">Delete</a></td>';
                $html .= '</tr>';
            }
        }
        $html .= '</tbody>';
        $html .= '</table>';

        $html .= '<span class="btn" onclick="document.getElementById(\'fileupload_' . htmlfilter($this->get_id()) . '\').click();">';
        $html .= '<i id="attach_' . htmlfilter($this->get_id()) . '" class="fa fa-paperclip"></i>';
        $html .= '<input id="fileupload_' . htmlfilter($this->get_id()) . '" type="file" name="file" >';
        $html .= '</span>';

        $html .= '<span class="btn" style="margin: 0 10px;" onclick="getFileFromSid(\'' . $this->get_id() . '\', this);">';
        $html .= '<i class="fa fa-hdd-o"></i>';
        $html .= '</span>';

        $html .= '</div>';
        $html .= '</div>';

        $html .= '<script>';

        $html .= "function getFileFromSidCallback_{$this->get_id()}(file){";
        $html .= 'var count = $("#files_wrapper_' . $this->get_id() . ' tr").length;';
        $html .= "$('#files_wrapper_{$this->get_id()}').append('";
        $html .= "<tr>";
        $html .= '<td scope="row">\' + (count+1) + \'</td>';
        $html .= '<td>';
        $html .= "' + getFilename(file) + '";
        $html .= '<input type="hidden" value="\' + file + \'" name="properties[' . htmlfilter($this->get_name()) . '][\' + count + \']" />';
        $html .= '</td>';
        $html .= '<td style="padding-right: 0px;"><a href="' . rtrim(base_url(), '/') . '\' + file + \'" target="_blank" class="btn" >View</a> <a class="btn" onclick="remove_option_' . htmlfilter($this->get_id()) . '(this);">Delete</a></td>';
        $html .= '</tr>';
        $html .= "');";
        $html .= '}';

        $html .= 'function remove_option_' . htmlfilter($this->get_id()) . '(elemnt){';
        $html .= "$(elemnt).parents('tr').remove();";
        $html .= "$('#files_wrapper_" . htmlfilter($this->get_id()) . " tr').each(function (index){";
        $html .= '$(this).find("[scope=\'row\']").html((index+1));';
        $html .= "$(this).find('input').each(function() {";
        $html .= "$(this).attr('name', $(this).attr('name').replace( /\[\d+\]/g, '['+index+']'));";
        $html .= "});";
        $html .= "});";
        $html .= '}';

        $html .= '$("#fileupload_' . htmlfilter($this->get_id()) . '").change(function() {';
        $html .= '$("#attach_' . htmlfilter($this->get_id()) . '").removeClass("fa fa-paperclip").html("<i class=\'fa fa-spinner fa-spin\'></i>");';
        $html .= '$.ajax("/accreditation/upload/" + $("#node_id").val(), {';
        $html .= 'files: $(this),';
        $html .= 'iframe: true,';
        $html .= 'dataType: "json"';
        if (Orm::get_ci()->config->item('csrf_protection')) {
            $html .= ",data : { csrf_test_name: $.cookie('csrf_cookie_name') }";
        }
        $html .= '}).always(function() {';
        $html .= '$("#attach_' . htmlfilter($this->get_id()) . '").html("").addClass("fa fa-paperclip");';
        $html .= '}).success(function(msg) {';
        $html .= 'if (msg.status) {';
        $html .= "getFileFromSidCallback_{$this->get_id()}(msg.file);";
        $html .= '} else {';
        $html .= 'alert(msg.error);';
        $html .= '}';
        $html .= '});';
        $html .= '}).hide();';
        $html .= '</script>';

        $html .= Validator::get_html_error_message($this->get_id());
        $html .= '</div>';

        return $html;
    }

    public function draw_report($pdf = false)
    {

        $html = '<table class="table table-striped">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th class="col-md-1">#</th>';
        $html .= '<th class="col-md-10">Attachments</th>';
        $html .= '<th class="col-md-1">Actions</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        if ($this->get_value()) {
            foreach ($this->get_value() as $key => $value) {
                $html .= '<tr>';
                $html .= '<td class="col-md-1">' . ($key + 1) . '</td>';
                $html .= '<td class="col-md-10">' . urldecode(preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($value))) . '</td>';
                $html .= '<td class="col-md-1"><a href="' . base_url($value) . '" target="_blank" >View</a></td>';
                $html .= '</tr>';
            }
        }
        $html .= '</tbody>';
        $html .= '</table>';


        return $this->draw_report_wrapper($html);
    }

}
