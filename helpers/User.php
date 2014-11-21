<?php

class User {

	protected $_db;

	protected $_id, 
			  $_name,
			  $_password, 
			  $_table_name;

	public function __construct($db, $user_table_name = "users") {
		$this->_db = $db;
		$this->_table_name = $user_table_name;
	}

	/**
	* Get password from database and set $this->_name and $this->_password
	* @param string $username - username to get password from
	* @return mixed (string or false on failure)
	*/
	public function get_password($username) {
		$sql = "SELECT password FROM {$this->_table_name} WHERE username = ? LIMIT 1";
		$pass_obj = $this->_db->query($sql, array($username))->getResults();
		if($pass_obj) {
			$password = $pass_obj[0]->password;
			// set username
			$this->_name = $username;
			// set passwowrd
			$this->_password = $password;
			return $password;
		}
		return false;
	}

	public function get_id() {
		$sql = "
			SELECT ID FROM {$this->_table_name}
			WHERE username = ? 
			AND password = ? 
			LIMIT 1
		";
		$id_obj = $this->_db->query($sql, array($this->_name, $this->_password))
					   ->getResults();
		return (int) $id_obj[0]->ID;
	}

	/**
	* Check if the name has been set
	* @return boolean
	*/
	public function is_name_set() {
		return isset($this->_name) ? true : false;
	}

	/**
	* Set user name
	* @param string $username
	* @return void
	*/
	public function set_name($username) {
		$this->_name = $username;
	}

}