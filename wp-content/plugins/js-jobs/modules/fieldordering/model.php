<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSJOBSFieldorderingModel {

    function __construct() {
        
    }

    function fieldsRequiredOrNot($ids, $value) {
        if (empty($ids))
            return false;
        if (!is_numeric($value))
            return false;
        //Db class limitations
        $total = 0;
        foreach ($ids as $id) {
            if(is_numeric($id) && is_numeric($value)){
                $query = "UPDATE " . jsjobs::$_db->prefix . "js_job_fieldsordering SET required = " . $value . " WHERE id = " . $id . " AND sys=0";
                if (false === jsjobsdb::query($query)) {
                    $total += 1;
                }
            }else{
                $total += 1;
            }
        }
        if ($total == 0) {
            JSJOBSMessages::$counter = false;
            if ($value == 1)
                return REQUIRED;
            else
                return NOT_REQUIRED;
        }else {
            JSJOBSMessages::$counter = $total;
            if ($value == 1)
                return REQUIRED_ERROR;
            else
                return NOT_REQUIRED_ERROR;
        }
    }

    function getFieldsOrdering($fieldfor) {
        if (is_numeric($fieldfor) == false)
            return false;
        $title = JSJOBSrequest::getVar('title');
        $ustatus = JSJOBSrequest::getVar('ustatus');
        $vstatus = JSJOBSrequest::getVar('vstatus');
        $required = JSJOBSrequest::getVar('required');
        $formsearch = JSJOBSrequest::getVar('JSJOBS_form_search', 'post');
        if ($formsearch == 'JSJOBS_SEARCH') {
            $_SESSION['JSJOBS_SEARCH']['title'] = $title;
            $_SESSION['JSJOBS_SEARCH']['ustatus'] = $ustatus;
            $_SESSION['JSJOBS_SEARCH']['vstatus'] = $vstatus;
            $_SESSION['JSJOBS_SEARCH']['required'] = $required;
        }
        if (JSJOBSrequest::getVar('pagenum', 'get', null) != null) {
            $title = (isset($_SESSION['JSJOBS_SEARCH']['title']) && $_SESSION['JSJOBS_SEARCH']['title'] != '') ? $_SESSION['JSJOBS_SEARCH']['title'] : null;
            $ustatus = (isset($_SESSION['JSJOBS_SEARCH']['ustatus']) && $_SESSION['JSJOBS_SEARCH']['ustatus'] != '') ? $_SESSION['JSJOBS_SEARCH']['ustatus'] : null;
            $vstatus = (isset($_SESSION['JSJOBS_SEARCH']['vstatus']) && $_SESSION['JSJOBS_SEARCH']['vstatus'] != '') ? $_SESSION['JSJOBS_SEARCH']['vstatus'] : null;
            $required = (isset($_SESSION['JSJOBS_SEARCH']['required']) && $_SESSION['JSJOBS_SEARCH']['required'] != '') ? $_SESSION['JSJOBS_SEARCH']['required'] : null;
        } else if ($formsearch !== 'JSJOBS_SEARCH') {
            unset($_SESSION['JSJOBS_SEARCH']);
        }
        $inquery = '';
        if ($title != null)
            $inquery .= " AND field.fieldtitle LIKE '%$title%'";
        if (is_numeric($ustatus))
            $inquery .= " AND field.published = $ustatus";
        if (is_numeric($vstatus))
            $inquery .= " AND field.isvisitorpublished = $vstatus";
        if (is_numeric($required))
            $inquery .= " AND field.required = $required";

        jsjobs::$_data['filter']['title'] = $title;
        jsjobs::$_data['filter']['ustatus'] = $ustatus;
        jsjobs::$_data['filter']['vstatus'] = $vstatus;
        jsjobs::$_data['filter']['required'] = $required;

        //Pagination
        $query = "SELECT COUNT(field.id) FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering AS field WHERE field.fieldfor = " . $fieldfor;
        $query .= $inquery;
        $total = jsjobsdb::get_var($query);
        jsjobs::$_data['total'] = $total;
        jsjobs::$_data[1] = JSJOBSpagination::getPagination($total);

        //Data
        $query = "SELECT field.* 
                    FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering AS field
                    WHERE field.fieldfor = " . $fieldfor;
        $query .= $inquery;
        $query .= ' ORDER BY';
        $query .= ' field.ordering';
        if ($fieldfor == 3)
            $query .=' ,field.section';        

        $query .=" LIMIT " . JSJOBSpagination::$_offset . "," . JSJOBSpagination::$_limit;

        jsjobs::$_data[0] = jsjobsdb::get_results($query);
        //  echo '<pre>';print_r(jsjobs::$_data[0]);die();
        return;
    }

    function getSearchFieldsOrdering($fieldfor) {
        if (is_numeric($fieldfor) == false)
            return false;
        $search = JSJOBSrequest::getVar('search','',0);
        $inquery = '';
            $inquery .= " AND field.cannotsearch = 0";
        if ($search == 0){
            $inquery .= " AND (field.search_user  = 1 OR field.search_visitor = 1 ) ";
        }
        jsjobs::$_data['filter']['search'] = $search;
        //Data
        $query = "SELECT field.fieldtitle,field.id,field.search_user,field.search_visitor,field.ordering 
                    FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering AS field
                    WHERE field.fieldfor = " . $fieldfor;
        $query .= $inquery;
        $query .= ' ORDER BY';
        $query .= ' field.ordering';

        jsjobs::$_data[0] = jsjobsdb::get_results($query);
//          echo '<pre>';print_r(jsjobs::$_data[0]);die();
        return;
    }

    function getFieldsOrderingforForm($fieldfor) {
        if (is_numeric($fieldfor) == false)
            return false;
        $published = (JSJOBSincluder::getObjectClass('user')->isguest()) ? "isvisitorpublished" : "published";
        $query = "SELECT * FROM `" . jsjobs::$_db->prefix . "js_job_fieldsordering`
                 WHERE $published = 1 AND fieldfor = " . $fieldfor . " ORDER BY";
        if ($fieldfor == 3) // for resume it must be order by section and ordering
            $query.=" section , ";
        $query.=" ordering";

        $rows = jsjobsdb::get_results($query);
        return $rows;
    }

    function getFieldsOrderingforSearch($fieldfor) {
        if (is_numeric($fieldfor) == false)
            return false;
        if (JSJOBSincluder::getObjectClass('user')->isguest()) {
            $published = ' AND search_visitor = 1 ';
        } else {
            $published = ' AND search_user = 1 ';
        }
        $query = "SELECT * FROM `" . jsjobs::$_db->prefix . "js_job_fieldsordering`
                 WHERE cannotsearch = 0 AND  fieldfor = " . $fieldfor . $published . " ORDER BY ordering";
        $rows = jsjobsdb::get_results($query);
        return $rows;
    }

    function getFieldsOrderingforView($fieldfor) {
        if (is_numeric($fieldfor) == false)
            return false;
        $published = (JSJOBSincluder::getObjectClass('user')->isguest()) ? "isvisitorpublished" : "published";
        $query = "SELECT field,fieldtitle FROM `" . jsjobs::$_db->prefix . "js_job_fieldsordering`
                WHERE $published = 1 AND fieldfor =  " . $fieldfor . " ORDER BY";
        if ($fieldfor == 3) // fields for resume
            $query.=" section ,";
        $query.=" ordering";
        $rows = jsjobsdb::get_results($query);
        $return = array();

//had make changes impliment fieldtitle in view compnay
        // if($fieldfor == 3){
        //     foreach ($rows AS $row) {
        //         $return[$row->field] = $row->required;
        //     }
        // }else{
            foreach ($rows AS $row) {
                $return[$row->field] = $row->fieldtitle;
            }
        // }

        return $return;
    }

    function fieldsPublishedOrNot($ids, $value) {
        if (empty($ids))
            return false;
        if (!is_numeric($value))
            return false;

        $total = 0;
        foreach ($ids as $id) {
            if(is_numeric($id) && is_numeric($value)){
                $query = "UPDATE " . jsjobs::$_db->prefix . "js_job_fieldsordering SET published = " . $value . " WHERE id = " . $id . " AND cannotunpublish=0";
                if (false === jsjobsdb::query($query)) {
                    $total += 1;
                }
            }else{
                $total += 1;
            }
        }
        if ($total == 0) {
            JSJOBSMessages::$counter = false;
            if ($value == 1)
                return PUBLISHED;
            else
                return UN_PUBLISHED;
        }else {
            JSJOBSMessages::$counter = $total;
            if ($value == 1)
                return PUBLISH_ERROR;
            else
                return UN_PUBLISH_ERROR;
        }
    }

    function visitorFieldsPublishedOrNot($ids, $value) {
        if (empty($ids))
            return false;
        if (!is_numeric($value))
            return false;
        $total = 0;
        foreach ($ids as $id) {
            if(is_numeric($id) && is_numeric($value)){
                $query = "UPDATE " . jsjobs::$_db->prefix . "js_job_fieldsordering SET isvisitorpublished = " . $value . " WHERE id = " . $id . " AND cannotunpublish=0";
                if (false === jsjobsdb::query($query)) {
                    $total += 1;
                }
            }else{
                $total += 1;
            }
        }
        if ($total == 0) {
            JSJOBSMessages::$counter = false;
            if ($value == 1)
                return PUBLISHED;
            else
                return UN_PUBLISHED;
        }else {
            JSJOBSMessages::$counter = $total;
            if ($value == 1)
                return PUBLISH_ERROR;
            else
                return UN_PUBLISH_ERROR;
        }
    }

    function fieldOrderingUp($field_id) {
        if (is_numeric($field_id) == false)
            return false;
        $query = "UPDATE " . jsjobs::$_db->prefix . "js_job_fieldsordering AS f1, " . jsjobs::$_db->prefix . "js_job_fieldsordering AS f2
                SET f1.ordering = f1.ordering + 1
                WHERE f1.ordering = f2.ordering - 1
                AND f1.fieldfor = f2.fieldfor
                AND f2.id = " . $field_id;

        if (false == jsjobsdb::query($query)) {
            return ORDER_UP_ERROR;
        }

        $query = " UPDATE " . jsjobs::$_db->prefix . "js_job_fieldsordering
                    SET ordering = ordering - 1
                    WHERE id = " . $field_id;

        if (false == jsjobsdb::query($query)) {
            return ORDER_UP_ERROR;
        }
        return ORDER_UP;
    }

    function fieldOrderingDown($field_id) {
        if (is_numeric($field_id) == false)
            return false;

        $query = "UPDATE " . jsjobs::$_db->prefix . "js_job_fieldsordering AS f1, " . jsjobs::$_db->prefix . "js_job_fieldsordering AS f2
                    SET f1.ordering = f1.ordering - 1
                    WHERE f1.ordering = f2.ordering + 1
                    AND f1.fieldfor = f2.fieldfor
                    AND f2.id = " . $field_id;

        if (false == jsjobsdb::query($query)) {
            return ORDER_DOWN_ERROR;
        }

        $query = " UPDATE " . jsjobs::$_db->prefix . "js_job_fieldsordering
                    SET ordering = ordering + 1
                    WHERE id = " . $field_id;

        if (false == jsjobsdb::query($query)) {
            return ORDER_DOWN_ERROR;
        }
        return ORDER_DOWN;
    }

    function storeUserField($data) {
        if (empty($data)) {
            return false;
        }
        $row = JSJOBSincluder::getJSTable('fieldsordering');
        if ($data['isuserfield'] == 1) {
            // value to add as field ordering
            if ($data['id'] == '') { // only for new
                $query = "SELECT max(ordering) FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering WHERE fieldfor = " . $data['fieldfor'];
                $var = jsjobsdb::get_var($query);
                $data['ordering'] = $var + 1;
                // search ordering code //
                $query = "SELECT max(ordering) FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering WHERE fieldfor = " . $data['fieldfor'];
                $var = jsjobsdb::get_var($query);
                $data['search_ordering'] = $var + 1;
                
                $data['cannotsearch'] = 0;
                $query = "SELECT max(id) FROM `".jsjobs::$_db->prefix."js_job_fieldsordering` ";
                $maxid = jsjobsdb::get_var($query);
                $maxid++;
                $data['field'] = 'ufield_'.$maxid;
            }
            $params = array();
            //code for depandetn field
            if (isset($data['userfieldtype']) && $data['userfieldtype'] == 'depandant_field') {
                if ($data['id'] != '') {
                    //to handle edit case of depandat field
                    $data['arraynames'] = $data['arraynames2'];
                }
                $flagvar = $this->updateParentField($data['parentfield'], $data['field'], $data['fieldfor']);
                if ($flagvar == false) {
                    return SAVE_ERROR;
                }
                if (!empty($data['arraynames'])) {
                    $valarrays = explode(',', $data['arraynames']);
                    foreach ($valarrays as $key => $value) {
                        $keyvalue = $value;
                        $value = str_replace(' ','__',$value);
                        $value = str_replace('.','___',$value);
                        if ( isset($data[$value]) && $data[$value] != null) {
                            $params[$keyvalue] = array_filter($data[$value]);
                        }
                    }
                }
            }

            if (!empty($data['values'])) {
                foreach ($data['values'] as $key => $value) {
                    if ($value != null) {
                        $params[] = trim($value);
                    }
                }
            }
            $params_string = json_encode($params);
            $data['userfieldparams'] = $params_string;
            
        }
        if($data['fieldfor'] == 3 && $data['section'] != 1){
            $data['cannotshowonlisting'] = 1;
        }
        
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }

        if (!$row->store()) {
            return SAVE_ERROR;
        }

        $stored_id = $row->id;
        return SAVED;
    }

    function updateParentField($parentfield, $field, $fieldfor) {
        if(!is_numeric($parentfield)) return false;
        if(!is_numeric($fieldfor)) return false;
        $query = "UPDATE `".jsjobs::$_db->prefix."js_job_fieldsordering` SET depandant_field = '' WHERE fieldfor = ".$fieldfor." AND depandant_field = '".$parentfield."'";
        jsjobs::$_db->query($query);
        $row = JSJOBSincluder::getJSTable('fieldsordering');
        $row->update(array('id' => $parentfield, 'depandant_field' => $field));
        return true;
    }

    function storeSearchFieldOrdering($data) {// 
        if (empty($data)) {
            return false;
        }
        $row = JSJOBSincluder::getJSTable('fieldsordering');
        if (!$row->bind($data)) {
            return SAVE_ERROR;
        }

        if (!$row->store()) {
            return SAVE_ERROR;
        }

        $stored_id = $row->id;
        return SAVED;
    }

    function storeSearchFieldOrderingByForm($data) {// 
        if (empty($data)) {
            return false;
        }
        parse_str($data['fields_ordering_new'],$sorted_array);
        $sorted_array = reset($sorted_array);
        if(!empty($sorted_array)){
            $row = JSJOBSincluder::getJSTable('fieldsordering');
            for ($i=0; $i < count($sorted_array) ; $i++) { 
                $row->update(array('id' => $sorted_array[$i], 'ordering' => 1 + $i));
                //$row->update(array('id' => $sorted_array[$i], 'search_ordering' => 1 + $i));
            }
        }
        return SAVED;
    }

    function getFieldsForComboByFieldFor() {
        $fieldfor = JSJOBSrequest::getVar('fieldfor');
        $parentfield = JSJOBSrequest::getVar('parentfield');
        if(!is_numeric($fieldfor)) return false;
        $wherequery = '';
        if($parentfield){
            $query = "SELECT id FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering WHERE fieldfor = $fieldfor AND (userfieldtype = 'radio' OR userfieldtype = 'combo' OR userfieldtype = 'depandant_field') AND depandant_field = '" . $parentfield . "' ";
            $parent = jsjobsdb::get_var($query);
            $wherequery = ' OR id = '.$parent;
        }else{
            $parent = '';
        }
        $query = "SELECT fieldtitle AS text ,id FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering WHERE fieldfor = " . $fieldfor . " AND (userfieldtype = 'radio' OR userfieldtype = 'combo' OR userfieldtype = 'depandant_field') && ( depandant_field = '' ".$wherequery." ) ";
        $data = jsjobsdb::get_results($query);
        $jsFunction = 'getDataOfSelectedField();';
        $html = JSJOBSformfield::select('parentfield', $data, $parent, __('Select','js-jobs') .'&nbsp;'. __('Parent Field', 'js-jobs'), array('onchange' => $jsFunction, 'class' => 'inputbox one'));
        $data = json_encode($html);
        return $data;
    }

    function getSectionToFillValues() {
        $field = JSJOBSrequest::getVar('pfield');
        $query = "SELECT userfieldparams FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering WHERE id=$field";
        $data = jsjobsdb::get_var($query);
        $datas = json_decode($data);
        $html = '';
        $fieldsvar = '';
        $comma = '';
        foreach ($datas as $data) {
            if(is_array($data)){    
                for ($i = 0; $i < count($data); $i++) {
                    $fieldsvar .= $comma . "$data[$i]";
                    $textvar = $data[$i];
                    $textvar = str_replace(' ','__',$textvar);
                    $textvar = str_replace('.','___',$textvar);
                    $divid = $textvar;
                    $textvar = $textvar."[]";
                    $html .= "<div class='js-field-wrapper js-row no-margin'>";
                    $html .= "<div class='js-field-title js-col-lg-3 js-col-md-3 no-padding'>" . $data[$i] . "</div>";
                    $html .= "<div class='js-col-lg-9 js-col-md-9 no-padding combo-options-fields' id='" . $divid . "'>
                                    <span class='input-field-wrapper'>
                                        " . JSJOBSformfield::text($textvar, '', array('class' => 'inputbox one user-field')) . "
                                        <img class='input-field-remove-img' src='" . jsjobs::$_pluginpath . "includes/images/remove.png' />
                                    </span>
                                    <input type='button' id='depandant-field-button' onClick='getNextField(\"" . $divid . "\",this);'  value='Add More' />
                                </div>";
                    $html .= "</div>";
                    $comma = ',';
                }
            }else{
                $fieldsvar .= $comma . $data;
                $textvar = $data;
                $textvar = str_replace(' ','__',$data);
                $textvar = str_replace('.','___',$data);
                $divid = $textvar;
                $textvar = $textvar."[]";
                $html .= "<div class='js-field-wrapper js-row no-margin'>";
                $html .= "<div class='js-field-title js-col-lg-3 js-col-md-3 no-padding'>" . $data . "</div>";
                $html .= "<div class='js-col-lg-9 js-col-md-9 no-padding combo-options-fields' id='" . $divid . "'>
                                <span class='input-field-wrapper'>
                                    " . JSJOBSformfield::text($textvar, '', array('class' => 'inputbox one user-field')) . "
                                    <img class='input-field-remove-img' src='" . jsjobs::$_pluginpath . "includes/images/remove.png' />
                                </span>
                                <input type='button' id='depandant-field-button' onClick='getNextField(\"" . $divid . "\",this);'  value='Add More' />
                            </div>";
                $html .= "</div>";
                $comma = ',';
            }
        }
        $html .= " <input type='hidden' name='arraynames' value='" . $fieldsvar . "' />";
        $html = json_encode($html);
        return $html;
    }

    function getOptionsForFieldEdit() {
        $field = JSJOBSrequest::getVar('field');
        $yesno = array(
            (object) array('id' => 1, 'text' => __('Yes', 'js-jobs')),
            (object) array('id' => 0, 'text' => __('No', 'js-jobs')));

        if(!is_numeric($field)) return false;
        $query = "SELECT * FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering WHERE id=" . $field;
        $data = jsjobsdb::get_row($query);

        $html = '<span class="popup-top">
                    <span id="popup_title" >
                    ' . __("Edit Field", "js-jobs") . '
                    </span>
                    <img id="popup_cross" onClick="closePopup();" src="' . jsjobs::$_pluginpath . 'includes/images/popup-close.png">
                </span>';
        $html .= '<form id="jsjobs-form" class="popup-field-from" method="post" action="' . admin_url("admin.php?page=jsjobs_fieldordering&task=saveuserfield") . '">';
        $html .= '<div class="popup-field-wrapper">
                    <div class="popup-field-title">' . __('Field Title', 'js-jobs') . '<font class="required-notifier">*</font></div>
                    <div class="popup-field-obj">' . JSJOBSformfield::text('fieldtitle', isset($data->fieldtitle) ? $data->fieldtitle : 'text', '', array('class' => 'inputbox one', 'data-validation' => 'required')) . '</div>
                </div>';
        if ($data->cannotunpublish == 0) {
            $html .= '<div class="popup-field-wrapper">
                        <div class="popup-field-title">' . __('User Published', 'js-jobs') . '</div>
                        <div class="popup-field-obj">' . JSJOBSformfield::select('published', $yesno, isset($data->published) ? $data->published : 0, '', array('class' => 'inputbox one', 'data-validation' => 'required')) . '</div>
                    </div>';
            $html .= '<div class="popup-field-wrapper">
                        <div class="popup-field-title">' . __('Visitor published', 'js-jobs') . '</div>
                        <div class="popup-field-obj">' . JSJOBSformfield::select('isvisitorpublished', $yesno, isset($data->isvisitorpublished) ? $data->isvisitorpublished : 0, '', array('class' => 'inputbox one', 'data-validation' => 'required')) . '</div>
                    </div>';

            $html .= '<div class="popup-field-wrapper">
                    <div class="popup-field-title">' . __('Required', 'js-jobs') . '</div>
                    <div class="popup-field-obj">' . JSJOBSformfield::select('required', $yesno, isset($data->required) ? $data->required : 0, '', array('class' => 'inputbox one', 'data-validation' => 'required')) . '</div>
                </div>';
        }

        if ($data->cannotsearch == 0) {
            $html .= '<div class="popup-field-wrapper">
                        <div class="popup-field-title">' . __('User Search', 'js-jobs') . '</div>
                        <div class="popup-field-obj">' . JSJOBSformfield::select('search_user', $yesno, isset($data->search_user) ? $data->search_user : 0, '', array('class' => 'inputbox one', 'data-validation' => 'required')) . '</div>
                    </div>';
            $html .= '<div class="popup-field-wrapper">
                        <div class="popup-field-title">' . __('Visitor Search', 'js-jobs') . '</div>
                        <div class="popup-field-obj">' . JSJOBSformfield::select('search_visitor', $yesno, isset($data->search_visitor) ? $data->search_visitor : 0, '', array('class' => 'inputbox one', 'data-validation' => 'required')) . '</div>
                    </div>';
        }
        $showonlisting = true;
        if($data->fieldfor == 3 && $data->section != 1 ){
            $showonlisting = false;
        }
        if (($data->isuserfield == 1 || $data->cannotshowonlisting == 0) && $showonlisting == true) {
            $html .= '<div class="popup-field-wrapper">
                        <div class="popup-field-title">' . __('Show On Listing', 'js-jobs') . '</div>
                        <div class="popup-field-obj">' . JSJOBSformfield::select('showonlisting', $yesno, isset($data->showonlisting) ? $data->showonlisting : 0, '', array('class' => 'inputbox one', 'data-validation' => 'required')) . '</div>
                    </div>';
        }
        $html .= JSJOBSformfield::hidden('form_request', 'jsjobs');
        $html .= JSJOBSformfield::hidden('id', $data->id);
        $html .= JSJOBSformfield::hidden('isuserfield', $data->isuserfield);
        $html .= JSJOBSformfield::hidden('fieldfor', $data->fieldfor);
        $html .='<div class="js-submit-container js-col-lg-10 js-col-md-10 js-col-md-offset-1 js-col-md-offset-1">
                    ' . JSJOBSformfield::submitbutton('save', __('Save', 'js-jobs'), array('class' => 'button'));
        if ($data->isuserfield == 1) {
            $html .= '<a id="user-field-anchor" href="'.admin_url('admin.php?page=jsjobs_fieldordering&jsjobslt=formuserfield&jsjobsid=' . $data->id . '&ff='.$data->fieldfor).'"> ' . __('Advanced', 'js-jobs') . ' </a>';
        }

        $html .='</div>
            </form>';
        return json_encode($html);
    }

    function deleteUserField($id){
        if (!is_numeric($id))
           return false;
        $query = "SELECT field,fieldfor FROM `".jsjobs::$_db->prefix."js_job_fieldsordering` WHERE id = " . $id;
        $result = jsjobsdb::get_row($query);
        $row = JSJOBSincluder::getJSTable('fieldsordering');
        if ($this->userFieldCanDelete($result) == true) {
            if (!$row->delete($id)) {
                return DELETE_ERROR;        
            }else{
                return DELETED;
            }
        }
        return IN_USE;
    }

    function enforceDeleteUserField($id){
        if (is_numeric($id) == false)
           return false;
        $query = "SELECT field,fieldfor FROM `".jsjobs::$_db->prefix."js_job_fieldsordering` WHERE id = " . $id;
        $result = jsjobsdb::get_row($query);
        $row = JSJOBSincluder::getJSTable('fieldsordering');
        if ($this->userFieldCanDelete($result) == true) {
            if (!$row->delete($id)) {
                return DELETE_ERROR;        
            }else{
                return DELETED;
            }
        }
        return IN_USE;
    }

    function userFieldCanDelete($field) {
        $fieldname = $field->field;
        $fieldfor = $field->fieldfor; 

        if($fieldfor == 1){//for deleting a company field
            $table = "companies";
        }elseif($fieldfor == 2){//for deleting a job field
            $table = "jobs";
        }elseif($fieldfor == 3){//for deleting a resume field
            $table = "resume";
        }
        $query = ' SELECT
                    ( SELECT COUNT(id) FROM `' . jsjobs::$_db->prefix . 'js_job_'.$table.'` WHERE 
                        params LIKE \'%"' . $fieldname . '":%\' 
                    )
                    AS total';
        $total = jsjobsdb::get_var($query);
        if ($total > 0)
            return false;
        else
            return true;
    }

    function getUserfieldsfor($fieldfor, $resumesection = null) {
        if (!is_numeric($fieldfor))
            return false;
        if (JSJOBSincluder::getObjectClass('user')->isguest()) {
            $published = ' isvisitorpublished = 1 ';
        } else {
            $published = ' published = 1 ';
        }
        if ($resumesection != null) {
            $published .= " AND section = $resumesection ";
        }
        $query = "SELECT field,userfieldparams,userfieldtype FROM `" . jsjobs::$_db->prefix . "js_job_fieldsordering` WHERE fieldfor = " . $fieldfor . " AND isuserfield = 1 AND " . $published;
        $fields = jsjobsdb::get_results($query);
        return $fields;
    }

    function getUserFieldbyId($id, $fieldfor) {
        if ($id) {
            if (is_numeric($id) == false)
                return false;
            $query = "SELECT * FROM " . jsjobs::$_db->prefix . "js_job_fieldsordering WHERE id = " . $id;
            jsjobs::$_data[0]['userfield'] = jsjobsdb::get_row($query);
            $params = jsjobs::$_data[0]['userfield']->userfieldparams;
            jsjobs::$_data[0]['userfieldparams'] = !empty($params) ? json_decode($params, True) : '';
        }
        jsjobs::$_data[0]['fieldfor'] = $fieldfor;
        return;
    }
    function makeDependentComboFiledForResume($val,$childfield,$type,$section,$sectionid,$themecall){

        $query = "SELECT field,depandant_field,userfieldparams,fieldtitle, required FROM `".jsjobs::$_db->prefix."js_job_fieldsordering` WHERE field = '".$childfield."'"; 
        $data = jsjobs::$_db->get_row($query); 
        $decoded_data = json_decode($data->userfieldparams); 
        $comboOptions = array(); 
        $themeclass=($themecall)?getJobManagerThemeClass('select'):"";

        $flag = 0; 
        foreach ($decoded_data as $key => $value) { 
            if($key==$val){ 
               for ($i=0; $i <count($value) ; $i++) {  
                   $comboOptions[] = (object)array('id' => $value[$i], 'text' => $value[$i]); 
                   $flag = 1; 
               } 
            } 
        }
        if($themecall == 1){
            $theme_string = ' ,'.$themecall;
        }else{
            $theme_string = '';
        }

        $jsFunction = '';
        if ($data->depandant_field != null) {
            $jsFunction = "getDataForDepandantFieldResume('" . $data->field . "','" . $data->depandant_field . "','" . $type . "','" . $section . "','" . $sectionid . "'".$theme_string.");";
        }
        $cssclass="";
        if($data->required == 1){
            $cssclass = 'required';
        }
        //end
        $extraattr = array('data-validation' => $cssclass, 'class' => "inputbox one $cssclass $themeclass");
        if(""!=$jsFunction){
            $extraattr['onchange']=$jsFunction;
        }
        // handleformresume
        if($section AND $section != 1){
            if($ishidden){
                if ($required == 1) {
                    $extraattr['data-myrequired'] = $cssclass;
                    $extraattr['class'] = "inputbox one";
                }
            }
        }
        $textvar =  ($flag == 1) ?  __('Select', 'js-jobs').' '.$data->fieldtitle : '';  
        $html =JSJOBSincluder::getObjectClass('customfields')->selectResume($childfield, $comboOptions, '', $textvar, $extraattr , null,$section , $sectionid);   
        $phtml = json_encode($html); 
        return $phtml; 
    }
    function DataForDepandantFieldResume(){
        $val = JSJOBSrequest::getVar('fvalue'); 
        $childfield = JSJOBSrequest::getVar('child'); 
        $section = JSJOBSrequest::getVar('section'); 
        $sectionid = JSJOBSrequest::getVar('sectionid'); 
        $type = JSJOBSrequest::getVar('type'); 
        $themecall = JSJOBSrequest::getVar('themecall'); 
        switch ($type) {
            case 1: //select type dependent combo
            case 2: //radio type dependent combo
                return $this->makeDependentComboFiledForResume($val,$childfield,$type,$section,$sectionid,$themecall);
            break;
        }
        return;
    }

    function DataForDepandantField(){ 
        $val = JSJOBSrequest::getVar('fvalue'); 
        $childfield = JSJOBSrequest::getVar('child'); 
        $themecall = JSJOBSrequest::getVar('themecall'); 
        $themeclass="";
        if($themecall){
            $theme_string = ','. $themecall ;
            if(function_exists("getJobManagerThemeClass")){
                $themeclass=getJobManagerThemeClass("select");
            }
        }else{
            $theme_string = '';
        }
        $query = "SELECT userfieldparams, fieldtitle, required, depandant_field,field  FROM `".jsjobs::$_db->prefix."js_job_fieldsordering` WHERE field = '".$childfield."'"; 
        $data = jsjobs::$_db->get_row($query); 
        $decoded_data = json_decode($data->userfieldparams); 
        $comboOptions = array(); 
        $flag = 0; 
        if(!empty($decoded_data) && $decoded_data != ''){
            foreach ($decoded_data as $key => $value) { 
                if($key==$val){ 
                   for ($i=0; $i <count($value) ; $i++) {  
                       $comboOptions[] = (object)array('id' => $value[$i], 'text' => $value[$i]); 
                       $flag = 1; 
                   }
                }
            }
        }
        $textvar =  ($flag == 1) ?  __('Select', 'js-jobs').' '.$data->fieldtitle : '';  
        $required = '';
        if($data->required == 1){
            $required = 'required';
        }
        $jsFunction = '';
        if ($data->depandant_field != null) {
            $jsFunction = " getDataForDepandantField('" . $data->field . "','" . $data->depandant_field . "','1','',''". $theme_string.");";
        }
        $html = JSJOBSformfield::select($childfield, $comboOptions, '',$textvar, array('data-validation' => $required,'class' => 'inputbox one '.$themeclass, 'onchange' => $jsFunction));
        $phtml = json_encode($html); 
        return $phtml; 
    }

    function getFieldTitleByFieldAndFieldfor($field,$fieldfor){
        if(!is_numeric($fieldfor)) return false;
        $query = "SELECT fieldtitle FROM `".jsjobs::$_db->prefix."js_job_fieldsordering` WHERE field = '".$field."' AND fieldfor = ".$fieldfor;
        $title = jsjobs::$_db->get_var($query);
        return $title;
    }
    function getMessagekey(){
        $key = 'fieldordering';if(is_admin()){$key = 'admin_'.$key;}return $key;
    }

}

?>
