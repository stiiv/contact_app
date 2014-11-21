<?php

class Main_Model extends Model {

	public $user;

	public function __construct() {
		parent::__construct();
		$this->user = new User($this->_db);
	}

	public function insert_new_user($username, $password, $first_name, $last_name, $email) {
		$this->_db->insert('users', array(
			'username' => $username,
			'password' => $password,
			'first_name' => $first_name,
			'last_name' => $last_name,
			'email' => $email
		));

		return ($this->_db->countResults() > 0) ? true : false;
	}

}