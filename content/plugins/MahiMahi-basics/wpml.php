<?php

if ( ! function_exists('wpml_get_language')):
// GET CURRENT LANGUAGE
function wpml_get_language() {
    global $sitepress;
    $current_language = 'lang-'.$sitepress->get_current_language();
    return $current_language;
}
endif;