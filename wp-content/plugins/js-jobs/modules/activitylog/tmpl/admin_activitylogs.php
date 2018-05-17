<?php
if (!defined('ABSPATH'))
    die('Restricted Access');
wp_enqueue_script('jsjob-res-tables', jsjobs::$_pluginpath . 'includes/js/responsivetable.js');
$categoryarray = array(
    (object) array('id' => 1, 'text' => __('ID', 'js-jobs')),
    (object) array('id' => 2, 'text' => __('User Name', 'js-jobs')),
    (object) array('id' => 3, 'text' => __('Reference For', 'js-jobs')),
    (object) array('id' => 4, 'text' => __('Created', 'js-jobs'))
);
?>
<script>
    jQuery(document).ready(function () {
        jQuery("div#full_background,img#popup_cross").click(function () {
            HidePopup();
        });
    });

    function ShowPopup() {
        jQuery("div#full_background").show();
        jQuery("div#popup_main").fadeIn(300);
    }

    function HidePopup() {
        jQuery("div#full_background").hide();
        jQuery("div#popup_main").fadeOut(300);
    }
    function submitfrom() {
        jQuery("form#filter_form").submit();

    }

    function changeSortBy() {
        var value = jQuery('a.sort-icon').attr('data-sortby');
        var img = '';
        if (value == 1) {
            value = 2;
            img = jQuery('a.sort-icon').attr('data-image2');
        } else {
            img = jQuery('a.sort-icon').attr('data-image1');
            value = 1;
        }
        jQuery("img#sortingimage").attr('src', img);
        jQuery('input#sortby').val(value);
        jQuery('form#filter_form').submit();
    }

    function buttonClick() {
        changeSortBy();
    }
    function changeCombo() {
        jQuery("input#sorton").val(jQuery('select#sorting').val());
        changeSortBy();
    }
</script>
<div id="jsjobsadmin-wrapper">
	<div id="jsjobsadmin-leftmenu">
        <?php JSJOBSincluder::getClassesInclude('jsjobsadminsidemenu'); ?>
    </div>
    <div id="jsjobsadmin-data">
    <?php 
    $msgkey = JSJOBSincluder::getJSModel('activitylog')->getMessagekey();
    JSJOBSMessages::getLayoutMessage($msgkey); 
    ?>
    <span class="js-admin-title">
        <span class="heading">
            <a href="<?php echo admin_url('admin.php?page=jsjobs'); ?>"><img src="<?php echo jsjobs::$_pluginpath; ?>includes/images/back-icon.png" /></a>
            <span class="heading-text"><?php echo __('Activity Log', 'js-jobs') ?></span> 
        </span>
    </span>		
        <div id="full_background" style="display:none;"></div>
        <div id="popup_main" style="display:none;">
            <span class="popup-top">
                <span id="popup_title" >
                    <?php echo __('Settings', 'js-jobs'); ?>
                </span>
                <img id="popup_cross" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/popup-close.png">
            </span>
            <div id="checkbox-popup-wrapper">  
                <form id="filter_form" method="post" action="?page=jsjobs_activitylog&jsjobslt=activitylogs">
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[age]', array('1' => __('Ages', 'js-jobs')), isset(jsjobs::$_data['filter']['age']) ? jsjobs::$_data['filter']['age'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[job]', array('1' => __('Jobs', 'js-jobs')), isset(jsjobs::$_data['filter']['job']) ? jsjobs::$_data['filter']['job'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[company]', array('1' => __('Company', 'js-jobs')), isset(jsjobs::$_data['filter']['company']) ? jsjobs::$_data['filter']['company'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[careerlevel]', array('1' => __('Career Level', 'js-jobs')), isset(jsjobs::$_data['filter']['careerlevel']) ? jsjobs::$_data['filter']['careerlevel'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[city]', array('1' => __('City', 'js-jobs')), isset(jsjobs::$_data['filter']['city']) ? jsjobs::$_data['filter']['city'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[state]', array('1' => __('State', 'js-jobs')), isset(jsjobs::$_data['filter']['state']) ? jsjobs::$_data['filter']['state'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[country]', array('1' => __('Country', 'js-jobs')), isset(jsjobs::$_data['filter']['country']) ? jsjobs::$_data['filter']['country'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[category]', array('1' => __('Category', 'js-jobs')), isset(jsjobs::$_data['filter']['category']) ? jsjobs::$_data['filter']['category'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[currency]', array('1' => __('Currency', 'js-jobs')), isset(jsjobs::$_data['filter']['currency']) ? jsjobs::$_data['filter']['currency'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[customfield]', array('1' => __('Custom Field', 'js-jobs')), isset(jsjobs::$_data['filter']['customfield']) ? jsjobs::$_data['filter']['customfield'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[emailtemplate]', array('1' => __('Email Template', 'js-jobs')), isset(jsjobs::$_data['filter']['emailtemplate']) ? jsjobs::$_data['filter']['emailtemplate'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[experience]', array('1' => __('Experience', 'js-jobs')), isset(jsjobs::$_data['filter']['experience']) ? jsjobs::$_data['filter']['experience'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[highesteducation]', array('1' => __('Highest Education', 'js-jobs')), isset(jsjobs::$_data['filter']['highesteducation']) ? jsjobs::$_data['filter']['highesteducation'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[coverletter]', array('1' => __('Cover Letter', 'js-jobs')), isset(jsjobs::$_data['filter']['coverletter']) ? jsjobs::$_data['filter']['coverletter'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[jobstatus]', array('1' => __('Job Status', 'js-jobs')), isset(jsjobs::$_data['filter']['jobstatus']) ? jsjobs::$_data['filter']['jobstatus'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[jobtype]', array('1' => __('Job Type', 'js-jobs')), isset(jsjobs::$_data['filter']['jobtype']) ? jsjobs::$_data['filter']['jobtype'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[salaryrangetype]', array('1' => __('Salary Range Type', 'js-jobs')), isset(jsjobs::$_data['filter']['salaryrangetype']) ? jsjobs::$_data['filter']['salaryrangetype'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[salaryrange]', array('1' => __('Salary Range', 'js-jobs')), isset(jsjobs::$_data['filter']['salaryrange']) ? jsjobs::$_data['filter']['salaryrange'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[shift]', array('1' => __('Shift', 'js-jobs')), isset(jsjobs::$_data['filter']['shift']) ? jsjobs::$_data['filter']['shift'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[department]', array('1' => __('Department', 'js-jobs')), isset(jsjobs::$_data['filter']['department']) ? jsjobs::$_data['filter']['department'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[resume]', array('1' => __('Resume', 'js-jobs')), isset(jsjobs::$_data['filter']['resume']) ? jsjobs::$_data['filter']['resume'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[resumesearches]', array('1' => __('Resume Search', 'js-jobs')), isset(jsjobs::$_data['filter']['resumesearches']) ? jsjobs::$_data['filter']['resumesearches'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[jobsearch]', array('1' => __('Job Search', 'js-jobs')), isset(jsjobs::$_data['filter']['jobsearch']) ? jsjobs::$_data['filter']['jobsearch'] : 0, array('class' => 'checkbox')); ?></div>
                    <div class="checkbox-filter"><?php echo JSJOBSformfield::checkbox('filter[jobapply]', array('1' => __('Job Apply', 'js-jobs')), isset(jsjobs::$_data['filter']['jobapply']) ? jsjobs::$_data['filter']['jobapply'] : 0, array('class' => 'checkbox')); ?></div>
                    <?php echo JSJOBSformfield::hidden('searchsubmit', 1 ); ?>
                    <?php echo JSJOBSformfield::hidden('sortby', jsjobs::$_data['sortby']); ?>
                    <?php echo JSJOBSformfield::hidden('sorton', jsjobs::$_data['sorton']); ?>
                    <span class="submit-button-popup" onclick="submitfrom()"><?php echo __('Submit', 'js-jobs'); ?></span>
                </form>
            </div>
        </div>

            <div class="page-actions js-row no-margin">
                <?php
                $image1 = jsjobs::$_pluginpath . "includes/images/up.png";
                $image2 = jsjobs::$_pluginpath . "includes/images/down.png";
                if (jsjobs::$_data['sortby'] == 1) {
                    $image = $image1;
                } else {
                    $image = $image2;
                }
                ?>
                <span class="sort">
                    <span class="sort-text"><?php echo __('Sort by', 'js-jobs'); ?>:</span>
                    <span class="sort-field"><?php echo JSJOBSformfield::select('sorting', $categoryarray, jsjobs::$_data['combosort'], '', array('class' => 'inputbox', 'onchange' => 'changeCombo();')); ?></span>
                    <a class="sort-icon" href="#" data-image1="<?php echo $image1; ?>" data-image2="<?php echo $image2; ?>" data-sortby="<?php echo jsjobs::$_data['sortby']; ?>" onclick="buttonClick();"><img id="sortingimage" src="<?php echo $image; ?>" /></a>
                </span>
                <span Onclick="ShowPopup()" id="filter-activity-log">
                    <img src="<?php echo jsjobs::$_pluginpath; ?>includes/images/settings.png">        
                    <?php echo __('Settings', 'js-jobs'); ?>
                </span>
            </div>
    <?php if (!empty(jsjobs::$_data[0])) { ?> 
            <table id="js-table">               
                <thead>
                    <tr>
                        <th ><?php echo __('ID', 'js-jobs'); ?></th>
                        <th class="left-row"><?php echo __('User Name', 'js-jobs'); ?></th>
                        <th class="left-row"><?php echo __('Description', 'js-jobs'); ?></th>
                        <th ><?php echo __('Reference For', 'js-jobs'); ?></th>
                        <th ><?php echo __('Created', 'js-jobs'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (jsjobs::$_data[0] AS $data) { ?>
                        <tr >
                            <td><?php echo $data->id; ?></td>
                            <td class="left-row"><?php echo $data->first_name . ' ' . $data->last_name; ?></td>
                            <td class="left-row"><?php echo $data->description; ?></td>
                            <td><?php echo ucwords($data->referencefor); ?></td>
                            <td><?php echo $data->created; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>

        </table>
        <?php
        if (jsjobs::$_data[1]) {
            echo '<div class="tablenav"><div class="tablenav-pages">' . jsjobs::$_data[1] . '</div></div>';
        }
    } else {
        $msg = __('No record found','js-jobs');
        echo JSJOBSlayout::getNoRecordFound($msg);
    }
    ?>

    </div>
</div>
