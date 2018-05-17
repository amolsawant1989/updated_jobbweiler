<?php 
if (!defined('ABSPATH')) die('Restricted Access'); 
$c = JSJOBSrequest::getVar('page',null,'jsjobs');
$layout = JSJOBSrequest::getVar('jsjobslt');
$ff = JSJOBSrequest::getVar('ff');
?>
<div id="jsjobsadmin-menu-links">
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/admin.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if( ($c == 'jsjobs' && $layout != 'themes') || $c == 'jsjobs_jobtype' || $c == 'jsjobs_jobstatus' || $c == 'jsjobs_shift' || $c == 'jsjobs_highesteducation' || $c == 'jsjobs_age' || $c == 'jsjobs_careerlevel' || $c == 'jsjobs_experience'  || $c == 'jsjobs_currency' || $c == 'jsjobs_activitylog' || $c == 'jsjobs_systemerror' ) echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Admin' , 'js-vehicle-manager'); ?> <img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
           <a class="jsjobs_js-child" href="admin.php?page=jsjobs"><span class="jsjobs_text"><?php echo __('Control Panel', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_jobtype"><span class="jsjobs_text"><?php echo __('Job Types', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_jobstatus"><span class="jsjobs_text"><?php echo __('Status', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_shift"><span class="jsjobs_text"><?php echo __('Shifts', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_highesteducation"><span class="jsjobs_text"><?php echo __('Highest Educations', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_age"><span class="jsjobs_text"><?php echo __('Ages', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_careerlevel"><span class="jsjobs_text"><?php echo __('Career Levels', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_experience"><span class="jsjobs_text"><?php echo __('Experience', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_currency"><span class="jsjobs_text"><?php echo __('Currency', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_activitylog"><span class="jsjobs_text"><?php echo __('Activity Log', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=translations"><span class="jsjobs_text"><?php echo __('Translations', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_systemerror"><span class="jsjobs_text"><?php echo __('System Errors', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=stepone"><span class="jsjobs_text"><?php echo __('JS Jobs','js-jobs') .'&nbsp'. __('Update', 'js-jobs'); ?></span></a> 
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_slug&jsjobslt=slug"><span class="jsjobs_text"><?php echo __('Slug','js-jobs');?></span></a> 
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_configuration">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/configuration.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_configuration' || $c == 'jsjobs_paymentmethodconfiguration' || ($c == 'jsjobs' && $layout == 'themes')) echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Configuration' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_configuration&jsjobslt=configurations"><span class="jsjobs_text"><?php echo __('General', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_configuration&jsjobslt=configurationsemployer"><span class="jsjobs_text"><?php echo __('Employer', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_configuration&jsjobslt=configurationsjobseeker"><span class="jsjobs_text"><?php echo __('Job Seeker', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Cron Job', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Payment Methods', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Themes', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_company">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/company.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_company' || ($c == 'jsjobs_fieldordering' && $ff == 1))  echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Companies' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_company"><span class="jsjobs_text"><?php echo __('Companies', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_company&jsjobslt=companiesqueue"><span class="jsjobs_text"><?php echo __('Approval Queue', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_fieldordering&ff=1"><span class="jsjobs_text"><?php echo __('Fields', 'js-jobs'); ?></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_departments">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/departments.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_departments') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Departments','js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_departments"><span class="jsjobs_text"><?php echo __('Departments', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_departments&jsjobslt=departmentqueue"><span class="jsjobs_text"><?php echo __('Approval Queue', 'js-jobs'); ?></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_job">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/jobs.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_job' || $c == 'jsjobs_jobalert' || ($c == 'jsjobs_fieldordering' && $ff == 2)) echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Jobs' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_job"><span class="jsjobs_text"><?php echo __('Jobs', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_job&jsjobslt=jobqueue"><span class="jsjobs_text"><?php echo __('Approval Queue', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_fieldordering&ff=2"><span class="jsjobs_text"><?php echo __('Fields', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_fieldordering&jsjobslt=searchfields&ff=2"><span class="jsjobs_text"><?php echo __('Search Fields', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Job alert', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_resume">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/resume.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_resume' || $c == 'jsjobs_coverletter' || ($c == 'jsjobs_fieldordering' && $ff == 3)) echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Resume' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_resume"><span class="jsjobs_text"><?php echo __('Resume', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_resume&jsjobslt=resumequeue"><span class="jsjobs_text"><?php echo __('Approval Queue', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_coverletter"><span class="jsjobs_text"><?php echo __('Cover letter', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_fieldordering&ff=3"><span class="jsjobs_text"><?php echo __('Fields', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_fieldordering&jsjobslt=searchfields&ff=3"><span class="jsjobs_text"><?php echo __('Search Fields', 'js-jobs'); ?></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs&jsjobslt=profeatures">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/credits.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_credits' || $c == 'jsjobs_creditspack') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Credits' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Credits', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Credits Pack', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        </div>
    </div>

    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs&jsjobslt=profeatures">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/credits-log.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_creditslog') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Credits Log' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Employer Credits Log', 'js-jobs'); ?><<img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/>/span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Job Seeker Credits Log', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs&jsjobslt=profeatures">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/payment.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_purchasehistory') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Purchase History' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Purchase History', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        </div>
    </div>

    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_report">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/reports.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_report') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Reports' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_report&jsjobslt=overallreports"><span class="jsjobs_text"><?php echo __('Overall Reports', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Employer Reports', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Job Seeker Reports', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs&jsjobslt=profeatures">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/premade.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_message') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Messages' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Messages', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Approval Queue', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs&jsjobslt=profeatures">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/folder.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_folder') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Folders' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Folder', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Approval Queue', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_category">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/category.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_category') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Categories' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_category"><span class="jsjobs_text"><?php echo __('Categories', 'js-jobs'); ?></span></a>
        </div>
    </div>

    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs&jsjobslt=profeatures">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/tag.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_tag') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Tags' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=profeatures"><span class="jsjobs_text"><?php echo __('Tags', 'js-jobs'); ?><img id="jslefticon" src="<?php echo jsjobs::$_pluginpath; ?>includes/images/pro-icon.png"/></span></a>
        </div>
    </div>

    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_salaryrange">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/salary_range.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_salaryrange' || $c == 'jsjobs_salaryrangetype' ) echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Salary Range' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_salaryrange"><span class="jsjobs_text"><?php echo __('Salary Range', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_salaryrangetype"><span class="jsjobs_text"><?php echo __('Salary Range Type', 'js-jobs'); ?></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_user">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/users.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_user') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Users' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_user&jsjobslt=users"><span class="jsjobs_text"><?php echo __('Users', 'js-jobs'); ?></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs&jsjobslt=shortcodes">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/short-code.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs' && $layout = 'shortcodes') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Short codes' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs&jsjobslt=shortcodes"><span class="jsjobs_text"><?php echo __('Short codes', 'js-jobs'); ?></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_emailtemplate">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/email_tempeltes.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_emailtemplate') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Email Templates','js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplatestatus'); ?>"><span class="jsjobs_text"><?php echo __('Options', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ew-cm'); ?>"><span class="jsjobs_text"><?php echo __('New company', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=d-cm'); ?>"><span class="jsjobs_text"><?php echo __('Delete company', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=cm-sts'); ?>"><span class="jsjobs_text"><?php echo __('Company status', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ew-ob'); ?>"><span class="jsjobs_text"><?php echo __('New job', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ew-obv'); ?>"><span class="jsjobs_text"><?php echo __('New visitor job', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ob-sts'); ?>"><span class="jsjobs_text"><?php echo __('Job Status', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ob-d'); ?>"><span class="jsjobs_text"><?php echo __('Job delete', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ew-rm'); ?>"><span class="jsjobs_text"><?php echo __('New resume', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ew-rmv'); ?>"><span class="jsjobs_text"><?php echo __('New visitor resume', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=rm-sts'); ?>"><span class="jsjobs_text"><?php echo __('Resume status', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=d-rs'); ?>"><span class="jsjobs_text"><?php echo __('Delete resume', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=em-n'); ?>"><span class="jsjobs_text"><?php echo __('New employer', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=obs-n'); ?>"><span class="jsjobs_text"><?php echo __('New Job seeker', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=em-pc'); ?>"><span class="jsjobs_text"><?php echo __('Employer purchase credits pack', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=obs-pc'); ?>"><span class="jsjobs_text"><?php echo __('Job seeker purchase credits pack', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ob-pe'); ?>"><span class="jsjobs_text"><?php echo __('Job seeker package expiry', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=em-pe'); ?>"><span class="jsjobs_text"><?php echo __('Employer package expiry', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ad-jap'); ?>"><span class="jsjobs_text"><?php echo __('Job apply admin', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=em-jap'); ?>"><span class="jsjobs_text"><?php echo __('Job apply employer', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=js-jap'); ?>"><span class="jsjobs_text"><?php echo __('Job apply job seeker', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=ap-jap'); ?>"><span class="jsjobs_text"><?php echo __('Applied resume status change', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=jb-at'); ?>"><span class="jsjobs_text"><?php echo __('Job alert', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="<?php echo admin_url('admin.php?page=jsjobs_emailtemplate&for=jb-to-fri'); ?>"><span class="jsjobs_text"><?php echo __('Tell to friend', 'js-jobs'); ?></span></a>
        </div>
    </div>
    <div class="jsjobs_js-divlink">
        <a href="admin.php?page=jsjobs_country">
            <img src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/countries.png'; ?>"/>
        </a>
        <a href="#" class="jsjobs_js-parent <?php if($c == 'jsjobs_country' || $c == 'jsjobs_addressdata') echo 'jsjobs_lastshown'; ?>"><span class="jsjobs_text"><?php echo __('Country' , 'js-vehicle-manager'); ?><img class="jsjobs_arrow" src="<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>"/></span></a>
        <div class="jsjobs_js-innerlink">
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_country"><span class="jsjobs_text"><?php echo __('Countries', 'js-jobs'); ?></span></a>
            <a class="jsjobs_js-child" href="admin.php?page=jsjobs_addressdata"><span class="jsjobs_text"><?php echo __('Load Address Data', 'js-jobs'); ?></span></a>
        </div>
    </div>
    
    </div>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery("img#jsjobs_js-admin-responsive-menu-link").click(function(e){
            e.preventDefault();
            if(jQuery("div#jsjobsadmin-leftmenu").css('display') == 'none'){
                jQuery("div#jsjobsadmin-leftmenu").show();
                jQuery("div#jsjobsadmin-leftmenu").width(280);
                jQuery("div#jsjobsadmin-leftmenu").find('a.jsjobs_js-parent,a.jsjobs_js-parent2').show();
                jQuery('a.jsjobs_js-parent.jsjobs_lastshown').next().find('a.jsjobs_js-child').css('display','block');
                jQuery('a.jsjobs_js-parent.jsjobs_lastshown').find('img.jsjobs_arrow').attr("src","<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow2.png'; ?>");
                jQuery('a.jsjobs_js-parent.jsjobs_lastshown').find('span').css('color','#ffffff');
            }else{
                jQuery("div#jsjobsadmin-leftmenu").hide();
            }
        });
        jQuery("div#jsjobsadmin-leftmenu").hover(function(){
            jQuery(this).find('#jsjobsadmin-menu-links').width(280);
            jQuery(this).find('a.jsjobs_js-parent,a.jsjobs_js-parent2').show();
            jQuery('a.jsjobs_js-parent.jsjobs_lastshown').next().find('a.jsjobs_js-child').css('display','block');
            jQuery('a.jsjobs_js-parent.jsjobs_lastshown').find('img.jsjobs_arrow').attr("src","<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow2.png'; ?>");
            jQuery('a.jsjobs_js-parent.jsjobs_lastshown').find('span').css('color','#ffffff');
        },function(){
            jQuery(this).find('#jsjobsadmin-menu-links').width(65);
            jQuery(this).find('a.jsjobs_js-parent,a.jsjobs_js-parent2').hide();
            jQuery('a.jsjobs_js-parent.jsjobs_lastshown').next().find('a.jsjobs_js-child').css('display','none');
            jQuery('a.jsjobs_js-parent.lastshown').find('img.jsjobs_arrow').attr("src","<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>");
            jQuery('a.jsjobs_js-parent.lastshown').find('span').css('color','#acaeb2');
        });
        jQuery("a.jsjobs_js-child").find('span.jsjobs_text').click(function(e){
            jQuery(this).css('color','#ffffff');
        });
        jQuery("a.jsjobs_js-parent").click(function(e){
            e.preventDefault();
            jQuery('a.jsjobs_js-parent.jsjobs_lastshown').next().find('a.jsjobs_js-child').css('display','none');
            jQuery('a.jsjobs_js-parent.jsjobs_lastshown').find('span').css('color','#acaeb2');
            jQuery('a.jsjobs_js-parent.jsjobs_lastshown').find('img.jsjobs_arrow').attr("src","<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow1.png'; ?>");
            jQuery('a.jsjobs_js-parent.jsjobs_lastshown').removeClass('jsjobs_lastshown');
            jQuery(this).find('span').css('color','#ffffff');
            jQuery(this).addClass('jsjobs_lastshown');
            if(jQuery(this).next().find('a.jsjobs_js-child').css('display') == 'none'){
                jQuery(this).next().find('a.jsjobs_js-child').css({'display':'block'},800);
                jQuery(this).find('img.jsjobs_arrow').attr("src","<?php echo jsjobs::$_pluginpath.'includes/images/left-icons/arrow2.png'; ?>");
            }
        });
    });
</script>