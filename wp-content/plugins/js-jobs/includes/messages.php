<?php

if (!defined('ABSPATH'))
    die('Restricted Access');

class JSJOBSMessages {
    /*
     * setLayoutMessage
     * @params $message = Your message to display
     * @params $type = Messages types => 'updated','error','update-nag'
     */

    public static $counter;

    public static function setLayoutMessage($message, $type, $msgkey) {
        if ( isset($_SESSION[$msgkey]) && isset($_SESSION[$msgkey]['msg'])) {
            $_SESSION[$msgkey]['msg'][$count] = $message;
            $_SESSION[$msgkey]['type'][$count] = $type;
        } else {
            $_SESSION[$msgkey] = array();
            $_SESSION[$msgkey]['msg'][0] = $message;
            $_SESSION[$msgkey]['type'][0] = $type;
        }
    }

    public static function getLayoutMessage($msgkey) {
        $frontend = (is_admin()) ? '' : 'frontend';
        $divHtml = '';
        if(!isset($_SESSION[$msgkey])) return;
        if(!isset($_SESSION[$msgkey]['msg'])) return;
        for ($i = 0; $i < COUNT($_SESSION[$msgkey]['msg']); $i++){
            if (isset($_SESSION[$msgkey]['msg'][$i]) && isset($_SESSION[$msgkey]['type'][$i])) {
                if(is_admin()){
                    $divHtml .= '<div class="frontend ' . $_SESSION[$msgkey]['type'][$i] . '"><p>' . $_SESSION[$msgkey]['msg'][$i] . '</p></div>';
                }else{
                    $theme = wp_get_theme();
                    if($theme == 'Job Manager'){
                        if($_SESSION[$msgkey]['type'][$i] == 'updated'){
                            $alert_class = 'success';
                            $img_name = 'job-alert-successful.png';
                        }elseif($_SESSION[$msgkey]['type'][$i] == 'saved'){
                            $alert_class = 'success';
                            $img_name = 'job-alert-successful.png';
                        }elseif($_SESSION[$msgkey]['type'][$i] == 'saved'){
                                    //$alert_class = 'info';
                                    //$alert_class = 'warning';
                        }elseif($_SESSION[$msgkey]['type'][$i] == 'error'){
                            $alert_class = 'danger';
                            $img_name = 'job-alert-unsuccessful.png';
                        }
                        $divHtml .= '<div class="alert alert-' . $alert_class . '" role="alert" id="autohidealert">
                                        <img class="leftimg" src="'.jsjobs::$_pluginpath.'includes/images/'.$img_name.'" />
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        '. $_SESSION[$msgkey]['msg'][$i] . '
                                    </div>';
                    }else{
                        $divHtml .= '<div class=" ' . $frontend . ' ' . $_SESSION[$msgkey]['type'][$i] . '"><p>' . $_SESSION[$msgkey]['msg'][$i] . '</p></div>';
                    }
                }
            }        
        }
       
	    echo $divHtml;
	    unset($_SESSION[$msgkey]);

        }

    public static function getMSelectionEMessage() { // multi selection error message
        return __('Please first make a selection from the list', 'js-jobs');
    }

    public static function getMessage($result, $entity) {

        $msg['message'] = __('Unknown');
        $msg['status'] = "updated";
        $msg1 = JSJOBSMessages::getEntityName($entity);

        switch ($result) {
            case INVALID_REQUEST:
                $msg['message'] = __('Invalid request', 'js-jobs');
                $msg['status'] = 'error';
                break;
            case SAVED:
                $msg2 = __('has been successfully saved', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case SAVE_ERROR:
                $msg['status'] = "error";
                $msg2 = __('has not been saved', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case DELETED:
                $msg2 = __('has been successfully deleted', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case NOT_EXIST:
                $msg['status'] = "error";
                $msg['message'] = __('Record not exist', 'js-jobs');
                break;
            case DELETE_ERROR:
                $msg['status'] = "error";
                $msg2 = __('has not been deleted', 'js-jobs');
                if ($msg1) {
                    $msg['message'] = $msg1 . ' ' . $msg2;
                    if (JSJOBSMessages::$counter) {
                        if(JSJOBSMessages::$counter > 1){
                            $msg['message'] = JSJOBSMessages::$counter . ' ' . $msg['message'];
                        }
                    }
                }
                break;
            case PUBLISHED:
                $msg2 = __('has been successfully published', 'js-jobs');
                if ($msg1) {
                    $msg['message'] = $msg1 . ' ' . $msg2;
                    if (JSJOBSMessages::$counter) {
                        if(JSJOBSMessages::$counter > 1){
                            $msg['message'] = JSJOBSMessages::$counter . ' ' . $msg['message'];
                        }
                    }
                }
                break;
            case VERIFIED:
                $msg['message'] = __('transaction has been successfully verified', 'js-jobs');
                break;
            case UN_VERIFIED:
                $msg['message'] = __('transaction has been successfully un-verified', 'js-jobs');
                break;
            case VERIFIED_ERROR:
                $msg['message'] = __('transaction has not been successfully verified', 'js-jobs');
                break;
            case UN_VERIFIED_ERROR:
                $msg['message'] = __('transaction has not been successfully un-verified', 'js-jobs');
                break;
            case PUBLISH_ERROR:
                $msg['status'] = "error";
                $msg2 = __('has not been published', 'js-jobs');
                if ($msg1) {
                    $msg['message'] = $msg1 . ' ' . $msg2;
                    if (JSJOBSMessages::$counter) {
                            $msg['message'] = JSJOBSMessages::$counter . ' ' . $msg['message'];
                    }
                }
                break;
            case UN_PUBLISHED:
                $msg2 = __('has been successfully unpublished', 'js-jobs');
                if ($msg1) {
                    $msg['message'] = $msg1 . ' ' . $msg2;
                    if (JSJOBSMessages::$counter) {
                        if(JSJOBSMessages::$counter > 1){
                            $msg['message'] = JSJOBSMessages::$counter . ' ' . $msg['message'];
                        }
                    }
                }
                break;
            case UN_PUBLISH_ERROR:
                $msg['status'] = "error";
                $msg2 = __('has not been unpublished', 'js-jobs');
                if ($msg1) {
                    $msg['message'] = $msg1 . ' ' . $msg2;
                    if (JSJOBSMessages::$counter) {
                            $msg['message'] = JSJOBSMessages::$counter . ' ' . $msg['message'];
                    }
                }
                break;
            case REQUIRED:
                $msg['message'] = __('Fields has been successfully required', 'js-jobs');
                break;
            case REQUIRED_ERROR:
                $msg['status'] = "error";
                if (JSJOBSMessages::$counter) {
                    if (JSJOBSMessages::$counter == 1)
                        $msg['message'] = JSJOBSMessages::$counter . ' ' . __('Field has not been required', 'js-jobs');
                    else
                        $msg['message'] = JSJOBSMessages::$counter . ' ' . __('Fields has not been required', 'js-jobs');
                }else {
                    $msg['message'] = __('Field has not been required', 'js-jobs');
                }
                break;
            case NOT_REQUIRED:
                $msg['message'] = __('Fields has been successfully not required', 'js-jobs');
                break;
            case NOT_REQUIRED_ERROR:
                $msg['status'] = "error";
                if (JSJOBSMessages::$counter) {
                    if (JSJOBSMessages::$counter == 1)
                        $msg['message'] = JSJOBSMessages::$counter . ' ' . __('Field has not been not required', 'js-jobs');
                    else
                        $msg['message'] = JSJOBSMessages::$counter . ' ' . __('Fields has not been not required', 'js-jobs');
                }else {
                    $msg['message'] = __('Field has not been not required', 'js-jobs');
                }
                break;
            case ORDER_UP:
                $msg['message'] = __('Field order up successfully', 'js-jobs');
                break;
            case ORDER_UP_ERROR:
                $msg['status'] = "error";
                $msg['message'] = __('Field order up error', 'js-jobs');
                break;
            case ORDER_DOWN:
                $msg['message'] = __('Field order down successfully', 'js-jobs');
                break;
            case ORDER_DOWN_ERROR:
                $msg['status'] = "error";
                $msg['message'] = __('Field order up error', 'js-jobs');
                break;
            case REJECTED:
                $msg2 = __('has been rejected', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case APPLY:
                $msg['status'] = "updated";
                $msg2 = __('Job applied successfully', 'js-jobs');
                $msg['message'] = $msg2;
                break;
            case APPLY_ERROR:
                $msg2 = __('Error in applying job', 'js-jobs');
                $msg['message'] = $msg2;
                $msg['status'] = "error";
                break;
            case REJECT_ERROR:
                $msg['status'] = "error";
                $msg2 = __('has not been rejected', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case APPROVED:
                $msg2 = __('has been approved', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case APPROVE_ERROR:
                $msg['status'] = "error";
                $msg2 = __('has not been approved', 'js-jobs');
                if ($msg1) {
                    $msg['message'] = $msg1 . ' ' . $msg2;
                    if (JSJOBSMessages::$counter) {
                        $msg['message'] = JSJOBSMessages::$counter . ' ' . $msg['message'];
                    }
                }
                break;
            case SET_DEFAULT:
                $msg2 = __('has been set as default', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case UNPUBLISH_DEFAULT_ERROR:
                $msg['status'] = "error";
                $msg['message'] = __('Unpublished field cannot set default', 'js-jobs');
                break;
            case SET_DEFAULT_ERROR:
                $msg['status'] = "error";
                $msg2 = __('has not been set as default', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case STATUS_CHANGED:
                $msg2 = __('status has been updated', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case STATUS_CHANGED_ERROR:
                $msg['status'] = "error";
                $msg2 = __('has not been updated', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case IN_USE:
                $msg['status'] = "error";
                $msg2 = __('in use cannot deleted', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case ALREADY_EXIST:
                $msg['status'] = "error";
                $msg2 = __('already exist', 'js-jobs');
                if ($msg1)
                    $msg['message'] = $msg1 . ' ' . $msg2;
                break;
            case FILE_TYPE_ERROR:
                $msg['status'] = "error";
                $msg['message'] = __('File type error', 'js-jobs');
                break;
            case FILE_SIZE_ERROR:
                $msg['status'] = "error";
                $msg['message'] = __('File size error', 'js-jobs');
                break;
            case ENABLED:
                $msg['status'] = "updated";
                $msg2 = __('has been enabled', 'js-jobs');
                if ($msg1) {
                    $msg['message'] = $msg1 . ' ' . $msg2;
                }
                break;
            case DISABLED:
                $msg['status'] = "updated";
                $msg2 = __('has been disabled', 'js-jobs');
                if ($msg1) {
                    $msg['message'] = $msg1 . ' ' . $msg2;
                }
                break;
        }
        return $msg;
    }

    static function getEntityName($entity) {
        $name = "";
        $entity = strtolower($entity);
        switch ($entity) {
            case 'salaryrange':$name = __('Salary Range', 'js-jobs');
                break;
            case 'addressdata':$name = __('Address Data', 'js-jobs');
                break;
            case 'age':$name = __('Age', 'js-jobs');
                break;
            case 'careerlevel':case 'careerlevels':$name = __('Career level', 'js-jobs');
                break;
            case 'coverletter':$name = __('Cover Letter', 'js-jobs');
                break;
            case 'coverletters':$name = __('Cover Letter', 'js-jobs');
                break;
            case 'category':$name = __('Category', 'js-jobs');
                break;
            case 'city':$name = __('City', 'js-jobs');
                break;
            case 'company':
                    $name = __('Company', 'js-jobs');
                    if(JSJOBSMessages::$counter){
                        if(JSJOBSMessages::$counter >1){
                            $name = __('Companies', 'js-jobs');
                        }
                    }
                break;
            case 'country':$name = __('Country', 'js-jobs');
                break;
            case 'currency':$name = __('Currency', 'js-jobs');
                break;
            case 'customfield':
            case 'fieldordering':$name = __('Field', 'js-jobs');
                break;
            case 'department':case 'departments':$name = __('Department', 'js-jobs');
                break;
            case 'employerpackages':$name = __('Employer package', 'js-jobs');
                break;
            case 'experience':$name = __('Experience', 'js-jobs');
                break;
            case 'highesteducation':$name = __('Highest education', 'js-jobs');
                break;
            case 'job':
                $name = __('Job', 'js-jobs');
                if(JSJOBSMessages::$counter){
                    if(JSJOBSMessages::$counter >1){
                        $name = __('Jobs', 'js-jobs');
                    }
                }
                break;
            case 'jobstatus':$name = __('Job Status', 'js-jobs');
                break;
            case 'jobtype':$name = __('Job type', 'js-jobs');
                break;
            case 'resume':
                $name = __('Resume', 'js-jobs');
                if(JSJOBSMessages::$counter){
                    if(JSJOBSMessages::$counter >1){
                        $name = __('Resume', 'js-jobs');
                    }
                }
                break;
            case 'salaryrange':$name = __('Salary Range', 'js-jobs');
                break;
            case 'salaryrangetype':$name = __('Salary Range Type', 'js-jobs');
                break;
            case 'shift':$name = __('Shift', 'js-jobs');
                break;
            case 'state':$name = __('State', 'js-jobs');
                break;
            case 'user':$name = __('User', 'js-jobs');
                break;
            case 'userrole':$name = __('User role', 'js-jobs');
                break;
            case 'configuration':$name = __('Configuration', 'js-jobs');
                break;
            case 'emailtemplate':$name = __('Email Template', 'js-jobs');
                break;
            case 'jobsavesearch':$name = __('Job Search', 'js-jobs');
                break;
            case 'resumesearch':$name = __('Resume Search', 'js-jobs');
                break;
            case 'record':
                    $name = __('record', 'js-jobs').'('. __('s','js-jobs') .')';
                break;
            case 'slug':
                    $name = __('Slug', 'js-jobs').'('. __('s','js-jobs') .')';
                break;
            case 'prefix':
                    $name = __('Prefix', 'js-jobs').'('. __('s','js-jobs') .')';
                break;
        }
        return $name;
    }

}

?>
