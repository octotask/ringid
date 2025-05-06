<?php
class singletone {

    private static $class_instance;
    private static $loading_time = 0;
    private static $loading_interval = 30;
    private static $admin_user,$bidpack_type;

    private function __construct() {
        //echo "singletone constructor called<br />\n";
        self::check_for_reload();
    }

    public static function get_instance() {
        if (!self::$class_instance) {
            self::$class_instance = new singletone();
        }
        return self::$class_instance;
    }

    private function reload() {
        $CI = & get_instance();
        $CI->load->model('mod_common');
        self::$admin_user=$CI->mod_common->get_admin_user_rep();
        self::$bidpack_type=$CI->mod_common->get_bidpack_type();
    }

    private function check_for_reload() {
        $current_time = time();
        if ($current_time - self::$loading_time > self::$loading_interval) {
            self::$loading_time = $current_time;
            self::reload();
        }
    }

    public static function force_reload() {
        self::$loading_time = time();
        self::reload();
    }

    public function get_user($user_id) {
        self::check_for_reload();
        //retrieve user information from repository
        echo "retrieve user information from repository<br>";
    }
    public static function get_admin_user() {
        self::check_for_reload();
        $admin=self::$admin_user;
        $result=array();
        foreach ($admin as $row){
            $result[$row[admin_username]]=$row;
        }
        return $result;
    }

    public static function get_bidpack_type($sel=''){
        self::check_for_reload();
        $bidpack=self::$bidpack_type;
        $opt.="<option value=''>- Select -</option>";
        foreach ($bidpack as $row) {
            if ($row[bidpack_type_id] == $sel) {
                $opt.="<option value='$row[bidpack_type_id]' selected='selected'>$row[bidpack_type]</option>";
            } else {
                $opt.="<option value='$row[bidpack_type_id]'>$row[bidpack_type]</option>";
            }
        }
        return $opt;
    }
}
?>
