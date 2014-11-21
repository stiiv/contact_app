<?php

class Contacts extends Controller {

    // control how much results per page
    public $per_page = 3;

    // store contacts values for saving in database
    protected $_contact_vals;

    public function __construct() {
        if(!Session::get("id_user")) {
            redir_to('main');
        }
        parent::__construct();
        $this->_load_model('contact');
        $this->data("username::".$this->model->get_username());
    }

    public function index() {
        $this->view->title = "Kontakti";
        $this->_contact_check();
        $this->_action_message();
        $this->view->render('contacts');
    }

    protected function _action_message() {
        $message = ( Session::get('action_message') != null ) ? Session::get('action_message') : false;
        if($message) {
            $this->data(array(
                'succ_or_err' => 'success',
                'action_message' => $message
            ));
            unset($_SESSION['succ_or_err'], $_SESSION['action_message']);
        }
    }

    public function search() {
        if(FORM_SUBMIT == "POST") {
            $input = new Input();
            $query = $input->escape($_POST["search"]);
            unset($input);
            $this->view->title = "Kontakti";
            if( $this->model->is_search($query) ) {
                $this->view->data["contacts"] = $this->model->search_query($query);
                $this->view->data["contact_num"] = $this->model->countRes();
                $this->view->data["results_num"] = "Pronađeno rezultata";
            } else {
                $this->view->data["results_num"] = "Pronađeno rezultata";
                $this->view->data["no_contacts"] = "Niti jedan resultat nije pronađen";
            }
            $this->view->render('contacts');
        } else {
            redir_to('error');
        }
    }

    /**
     * Check if contacts exist
     */
    protected function _contact_check() {
        if( $this->model->has_results() ) {
            $this->view->data["contacts"] = $this->model->get_all_contacts();
            $this->view->data["contact_num"] = $this->model->total_contacts();
            $this->view->data["results_num"] = "Kontakti ukupno";
            $this->view->data["pagination"] = $this->_paginate();
        } else {
            $this->view->data["results_num"] = "Kontakti ukupno";
            $this->view->data["no_contacts"] = "Kontakt lista je prazna";
        }
    }

    /**
     * Check and return string if pagination is needed
     * @return string | void
     */
    protected function _paginate() {
        $html = "";
        $current_page = (int)( isset($_GET['page']) && is_numeric($_GET['page']) ) ? $_GET['page'] : 1;
        $per_page = $this->per_page;
        $total = $this->model->total_contacts();

        $paginate = new Pagination($current_page, $per_page, $total);

        // check if the page needs pagination
        if( $paginate->needs_pagination() ) {
            $this->view->data["contacts"] = $this->model->get_all_contacts($per_page, $paginate->offset());

            if( $paginate->has_prev_page() ) {
                $html .= '<a href="?page='.$paginate->prev_page().'">&xlarr; Previous</a>';
            }
                

            for($i = 1; $i <= $paginate->total_pages(); $i++) {
                if($current_page == $i) {
                    $html .= '<span>'.$i.'</span>';
                } else {
                    $html .= '<a href="?page='.$i.'">'.$i.'</a>';
                }
            }

            if( $paginate->has_next_page() ) {
                $html .= '<a href="?page='.$paginate->next_page().'">Next &xrarr;</a>';
            }
                
            return $html;

        } else { // there is no need for pagination
            $this->view->data["contacts"] = $this->model->get_all_contacts();
        }

    }

    public function view($id) {
        $id = (int)$id;
        //pretty_print($this->model->view_contact($id));
        $this->view->title = "Detalji";
        $this->view->data["contact"] = $this->model->view_contact($id);
        $this->view->render('view_contact');
    }

    public function insert() {
        $this->view->title = "Unesi novi kontakt";
        $this->view->data["form_title"] = "Unesite novi kontakt";
        $this->view->data["cities"] = $this->model->get_cities();
        $this->_insert_message();
        $this->view->render('insert');
    }

    protected function _insert_message() {
        $message = ( Session::get('errorMsg') != null ) ? Session::get('errorMsg') : false;
        if($message) {
            $this->data(array(
                'succ_or_err' => 'success',
                'errorMsg' => $message
            ));
            unset($_SESSION['succ_or_err'], $_SESSION['errorMsg'], $_POST);
        }
    }

    public function save() {
        if(FORM_SUBMIT == "POST") {
            $input = new Input();
            // if these fields are empty, do not safe anything
            if( empty($_POST['mob1']) && empty($_POST['mob2']) && empty($_POST['home_tel']) && empty($_POST['job_tel']) ) {
                $this->view->data["succ_or_err"] = "failure";
                $this->view->data["errorMsg"] = "Nema podataka za spremanje. Barem jedan broj mora biti unešen.";
                $this->insert();
                return;
            }
    // save to the database
            if( $this->_validate_input($input) ) {
                $this->_save_to_db();
                Session::multi_set(array(
                    'succ_or_err' => 'success',
                    'errorMsg' => 'Kontakt uspješno spremljen'
                ));
                redir_to('contacts/insert');

            } else { // display existing errors
                $this->view->data["succ_or_err"] = "failure";
                $this->view->data["errorMsg"] = $input->get_formatted_errors();
                $this->insert();
            }

        } else {
            redir_to('error');
        }
    }

    /**
     * Check if data are ready to be safe in database
     * @param $input - validation class
     * @return bool
     */
    protected function _validate_input(&$input) {
        $name         = ucwords( $input->escape($_POST['name']) );
        $last_name    = ucwords( $input->escape($_POST['last_name']) );
        $city         = ($_POST['city'] != 0) ? $_POST['city'] : null;
        $mob1         = !empty( $_POST['mob1'] ) ? $input->check($_POST['mob1'], "Mobitel 1", array("digit" => true)) : "";
        $mob2         = !empty( $_POST['mob2'] ) ? $input->check($_POST['mob2'], "Mobitel 2", array("digit" => true)) : "";
        $home_tel     = !empty( $_POST['home_tel'] ) ? $input->check($_POST['home_tel'], "Kućni", array("digit" => true)) : "";
        $job_tel      = !empty( $_POST['job_tel'] ) ? $input->check($_POST['job_tel'], "Posao", array("digit" => true)) : "";
        $pic_contact  = "";
        $desc_contact = $input->escape($_POST['desc_contact']);

        $input->check($name, "Ime", array(
            "required" => true,
            "minlength" => 3
        ));

        // if something has been uploaded => set name of the file
        if($input->handle_upload(IMAGES.'contacts')) {
            $pic_contact = $input->upload_name();
            $input->check($pic_contact, "Picture", array(
                'maxlength' => 255
            ));
        } else {
            $pic_contact = "default.jpg";
        }

        $this->_contact_vals = array(
            $name, $last_name,
            $mob1, $mob2, $home_tel, $job_tel,
            $pic_contact, $desc_contact, $city
        );

        return !$input->has_errors();
    }

    /**
     * Save to the database
     * @return void
     */
    protected function _save_to_db() {
        if( !empty($this->_contact_vals) ) {
            list($name, $last_name, $mob1, $mob2, $home_tel, $job_tel, $pic_contact, $desc_contact, $city) = $this->_contact_vals;
            $this->model->insert_contact($name, $last_name, $mob1, $mob2, $home_tel, $job_tel, $pic_contact, $desc_contact, $city);
        }
    }

    public function logout() {
        Session::clean();
        Session::destroy();
        redir_to('main');
    }

    public function edit($id) {
        //pretty_print($this->model->edit_contact($id), "contact");
        //pretty_print($_POST, "post");
        if(FORM_SUBMIT == "POST" && isset($_POST['cancel_edit'])) {
            redir_to('contacts/view/'.(int)$id);
        } else {
            $this->_update($id);
        }
        $this->data(array(
            "contact" => $this->model->edit_contact($id),
            "cities" => $this->model->get_cities()
        ));
        $this->view->render('edit');
    }

    protected function _update($id) {
        if(FORM_SUBMIT == "POST" && isset($_POST['submit'])) {
            $input = new Input();
            // if these fields are empty, do not safe anything
            if( empty($_POST['mob1']) && empty($_POST['mob2']) && empty($_POST['home_tel']) && empty($_POST['job_tel']) ) {
                $this->view->data["succ_or_err"] = "failure";
                $this->data("errorMsg::Nema podataka za spremanje. Barem jedan broj mora biti unešen.");
                return;
            }

            if($this->_validate_input($input)) {
                $this->_update_to_db($id);
                Session::multi_set(array(
                    'succ_or_err' => 'success',
                    'action_message' => 'Promjene uspješno spremljene'
                ));
                redir_to('contacts/view/'.$id);

            } else { // display existing errors
                $this->data(array(
                    "succ_or_err" => "failure",
                    "errorMsg" => $input->get_formatted_errors(),
                    "contact" => $this->model->edit_contact($id),
                    "cities" => $this->model->get_cities()
                ));
                $this->view->render('edit');
            }

        }
    }

    /**
     * Save updated informations to the database
     * @return void
     */
    protected function _update_to_db($id) {
        if( !empty($this->_contact_vals) ) {
            list($name, $last_name, $mob1, $mob2, $home_tel, $job_tel, $pic_contact, $desc_contact, $city) = $this->_contact_vals;
            $this->model->update($id, $name, $last_name, $mob1, $mob2, $home_tel, $job_tel, $pic_contact, $desc_contact, $city);
        }
    }

    public function delete($id) {
        if( $this->model->delete_contact($id) ) {
            Session::multi_set(array(
                'succ_or_err' => 'success',
                'action_message' => 'Kontakt uspješno izbrisan',
            ));
            redir_to('contacts');
            
        } else {
            Session::multi_set(array(
                'succ_or_err' => 'failure',
                'action_message' => 'Došlo je do pogreške. Molimo Vas, pokušajte ponovo.',
            ));
            redir_to('contacts/view/'.$id);
        }
    }

    public function test() {
        
    }

} 