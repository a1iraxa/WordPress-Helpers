<?php

require_once("class.rest.php");

class API extends REST {

    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }

    public function dbConnect() {
        mysql_connect("localhost", "root", "");
        mysql_select_db("vipul_test");
    }

    public function processApi() {
        $func = strtolower(trim(str_replace("/", "", $_REQUEST['action'])));
        if ((int) method_exists($this, $func) > 0)
            $this->$func();
        else
            $this->response('', 404);
    }

    private function login() {

        if ($this->get_request_method() != "POST") {
            $this->response($this->json(array('status' => 'false', 'message' => 'method not allowed.')), 405);
        }

        if (isset($this->_request['email']) && isset($this->_request['password']) && !empty($this->_request['email']) && !empty($this->_request['password'])) {

            $email = $this->_request['email'];
            $password = $this->_request['password'];
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $sql = "SELECT * FROM user WHERE email='" . $email . "' AND password='" . $password . "'";
                $q = mysql_query($sql);
                if (mysql_num_rows($q) > 0) {
                    $res = array('status' => 'true', 'message' => 'user successfully logged in.');
                    $this->response($this->json($res), 200);
                }
                $res = array('status' => 'false', 'message' => 'wrong email or password.');
                $this->response($this->json($res), 404);
            }
        }

        $error = array('status' => 'false', 'message' => 'Invalid email or password');
        $this->response($this->json($error), 200);
    }

    private function json($data) {
        if (is_array($data)) {
            return json_encode($data);
        }
    }

}

$api = new API;
$api->processApi();
?>