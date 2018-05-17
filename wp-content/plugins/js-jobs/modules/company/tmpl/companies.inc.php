<?php if (!defined('ABSPATH')) die('Restricted Access'); ?>
<script>

    function makeExpiry() {
        jQuery(".goldnew").hover(function () {
            jQuery(this).find(".goldnew-onhover").show();
        }, function () {
            jQuery(this).find('span.goldnew-onhover').fadeOut("slow");
        });
        jQuery(".featurednew").hover(function () {
            jQuery(this).find("span.featurednew-onhover").show();
        }, function () {
            jQuery(this).find('.featurednew-onhover').fadeOut("slow");
        });
    }


    jQuery(document).ready(function () {
        //makeExpiry();
        multicities = <?php echo isset(jsjobs::$_data['filter']['jsjobs-city']) ? jsjobs::$_data['filter']['jsjobs-city'] : "''" ?>;
        var cityArray = '<?php echo admin_url("admin.php?page=jsjobs_city&action=jsjobtask&task=getaddressdatabycityname"); ?>';
        jQuery("#jsjobs-city").tokenInput(cityArray, {
            theme: "jsjobs",
            preventDuplicates: true,
            hintText: "<?php echo __('Type In A Search Term', 'js-jobs'); ?>",
            noResultsText: "<?php echo __('No Results', 'js-jobs'); ?>",
            searchingText: "<?php __('Searching', 'js-jobs'); ?>",
            // tokenLimit: 1,
            width: 260,
            prePopulate: multicities,
        });
    });

    function resetFrom() {
        document.getElementById('jsjobs-company').value = '';
        document.getElementById('jsjobs-city').value = '';
        return true;
    }
    function addSpaces() {
        document.getElementById('jsjobs-company').value = fillSpaces(document.getElementById('jsjobs-company').value);
        return true;
    }
</script>
