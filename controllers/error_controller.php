<?php

class Error extends Controller {

    protected $_message = "It's seems requested page doesn't exist...";

	public function index() {
		$this->view->title = "Error";
        $this->view->data["message"] = $this->_message;
        $this->view->data["home_link"] = $this->_home_link();
        $this->view->render('error');
	}

    protected function _home_link() {
        return '<a class="back-link" href="'.BASE_URL.DEFAULT_CONTROLLER.'">&xlarr; Contacts</a>';
    }



}