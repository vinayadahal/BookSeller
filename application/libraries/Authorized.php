<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authorized {

    public function showPublicError404() {
        if (empty($data)) {
            show_error("Requested resource could not be found.", '404', $heading = '404 Error');
        }
    }

    public function check_auth($obj_select, $user_id) {
        $user_array = (array) $obj_select->getSingleRecord('user', $user_id);
        $role_array = (array) $obj_select->getSingleRecord('role', $user_array['role']);
        $current_url = $_SERVER['REQUEST_URI'];
        if ($role_array['role'] == 'role_admin') {
            if (strpos($current_url, 'admin') != TRUE) {
                show_error("You are not authorized to perform this operation as Administrative user.", '404', $heading = '401 - Unauthorized Error');
            }
        }
        if ($role_array['role'] == 'role_user') {
            if (strpos($current_url, 'admin') == TRUE) {
                show_error("You are not authorized to perform this operation as normal user.", '404', $heading = '401 - Unauthorized Error');
            }
        }
    }

}
