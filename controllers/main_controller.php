<?php

class Main extends Controller {

	public function __construct() {
		parent::__construct();
		if( Session::get('id_user') ) {
			redir_to("contacts");
		}
		$this->_load_model('main');
	}

	public function index() {
		$this->title("Dobrodošli");
		$this->data("sign_up::Sign up");
		$this->view->render("main");
		//echo password_hash("stiiv85", PASSWORD_BCRYPT); // user id = 1
		//echo password_hash("kreso", PASSWORD_BCRYPT); // user id = 2
	}

	// LOG IN
	public function login() {

		if(FORM_SUBMIT == "POST") {
			$input = new Input();
			$username = trim($_POST['username']);
			$password = trim($_POST['password']);

			$username = $input->escape($username);
			$password = $input->escape($password);

			// check if the username exists in database
			$user = $this->model->user;
			if($user->get_password($username)) {
				$hashed_password = $user->get_password($username);
				//var_dump($hashed_password);
				$this->_password_check($input, $password, $hashed_password);
				
			} else { // username doesn't exists
				$this->_errorMsg($input);
				$this->_incorrect_user_or_pass($input);
			}
			
		} else { // forbid access 
			redir_to('error');
		}
	}

	protected function _password_check($input, $password, $hashed_password) {
		$user = $this->model->user;

		if( password_verify($password, $hashed_password) && !$input->has_errors() ) {
			//var_dump($user->get_id());
			Session::set("id_user", $user->get_id());
			redir_to('contacts');
		} else { // password is not correct
			$this->_errorMsg($input);
			$this->_incorrect_user_or_pass($input);
		}
	}

	protected function _errorMsg($input) {
		$error = "Vaše korisničko ime ili lozinka nisu točni. Molimo Vas, pokušajte ponovno";
		return $input->errorMsg["login_error"] = $error;
	}

	protected function _incorrect_user_or_pass($input) {
		$this->data("sign_up::Sign up");
		$this->data("succ_or_err::failure");
		$this->data("errorMsg::".$input->errorMsg["login_error"]);
		$this->view->render('main');
	}

	// SIGN UP
	public function register() {
		if(FORM_SUBMIT == "POST") {
			$input = new Input();

			$username   = $input->check($_POST['username'], "Username", array(
				'required' => true,
				'minlength' => 3,
				'maxlength' => 20
			));

			$password   = $input->check($_POST['password'], "Password", array(
				'required' => true,
				'minlength' => 5
			));
			$hashed_password = $input->hash($password);

			$password_again = $input->check($_POST['password_again'], "Retype Password", array(
				'match' => 'password'
			));

			$first_name = $input->check($_POST['first_name'], "Ime", array(
				'required' => true,
			));
			$first_name = ucwords($first_name);

			$last_name  = $input->check($_POST['last_name'], "Prezime", array(
				'required' => true
			));
			$last_name  = ucwords($last_name);

			$email      = $input->check($_POST['email'], "E-mail", array(
				'required' => true,
				'email' => true
			));
			
			if( $this->_is_ready_for_db($input) ) {

				if( $this->model->insert_new_user($username, $hashed_password, $first_name, $last_name, $email) ) {
					unset($_POST);
					$this->data("success_message::Registracija uspješna");
					$this->view->render('success');
					redir_sec('main');
				} else { // something went wrong
					$input->errorMsg["unknown_error"] = "Došlo je do greške. Molimo Vas, pokušajte ponovno";
					$this->data("succ_or_err::failure");
					$this->data("errorMsg::".$input->errorMsg["unknown_error"]);
				}

			}

		} else { // no post request
			redir_to('error');
		}
	}

	protected function _is_ready_for_db($input) {
		if( !$input->has_errors() ) {
			return true;
		}
		// otherwise display errors
		$this->data(array(
			'succ_or_err' => 'failure',
			'errorMsg' => $input->get_formatted_errors(),
			'sign_up' => 'Sign up'
		));
		$this->view->render('main');
		return false;
	}

}