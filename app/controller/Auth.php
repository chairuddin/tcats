<?php


Class AuthController {

    public function index() {
        
    }
    public function AuthId() {
        return $_SESSION['s_id'];
    }
	public function AuthData() {
        return array(
            'id' => $_SESSION['s_id'],
            'username' => $_SESSION['s_username'],
            's_fullname' => $_SESSION['s_fullname'],
            's_level' => $_SESSION['s_level'],
            's_status' => $_SESSION['s_status']
        );
    }
}