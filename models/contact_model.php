<?php


class Contact_Model extends Model {

    public $id_user;
    // initialize user object
    public $user;

    public function __construct() {
        parent::__construct();
        $this->user = new User($this->_db);
        $this->id_user = Session::get('id_user');
    }

    public function get_username() {
        $sql = "SELECT username from users WHERE ID = ?";
        $user_obj = $this->_db->query($sql, array($this->id_user))->getResults();
        return $user_obj[0]->username;
    }

    public function search_query($query) {
        $param = "%{$query}%";
        $sql  = "SELECT ";
        $sql .= "id as ID, ime, prezime, mob1, mob2, kucni, posao ";
        $sql .= "FROM contacts ";
        $sql .= "WHERE ime LIKE ? ";
        return $this->_db->query($sql, array($param))->getResults();
    }

    public function is_search($query) {
        $search = $this->search_query($query);
        return !empty( $search );
    }

    public function count_table($table) {
        $sql  = "SELECT COUNT(*) AS count FROM {$table} ";
        $sql .= "WHERE id_user = ? ";
        $results = $this->_db->query($sql, array($this->id_user))->getResults();
        return (int)$results[0]->count;
    }

    public function total_contacts() {
        return $this->count_table('contacts');
    }

    public function get_cities() {
        return $this->_db->query("SELECT id, ime FROM gradovi ORDER BY ime")->getResults();
    }


    public function insert_contact($ime, $prezime, $mob1, $mob2, $kucni, $posao, $slika, $opis, $id_grad) {
        $this->_db->insert('contacts', array(
            'id_user' => $this->id_user,
            'ime' => $ime,
            'prezime' => $prezime,
            'mob1' => $mob1,
            'mob2' => $mob2,
            'kucni' => $kucni,
            'posao' => $posao,
            'slika' => $slika,
            'opis' => $opis,
            'id_grad' => $id_grad
        ));

        return $this->_db->countResults();
    }

    /**
     * Get all contacts
     * @param null $limit - optional
     * @param null $offset - optional
     * @return mixed
     */
    public function get_all_contacts($limit = null, $offset = null) {
        $sql  = "SELECT ";
        $sql .= "c.id as ID, c.ime, c.prezime, c.mob1, c.mob2, c.kucni, c.posao, c.slika, c.opis, ";
        $sql .= "g.ime AS ime_grada ";
        $sql .= "FROM contacts AS c ";
        $sql .= "LEFT OUTER JOIN gradovi AS g ";
        $sql .= "ON g.id = c.id_grad ";
        $sql .= "WHERE c.id_user = ? ";
        $sql .= "ORDER BY c.ime, c.prezime ";
        $sql .= ( !is_null($limit) ) ? "LIMIT ".(int)$limit : null;
        $sql .= ( !is_null($offset) ) ? " OFFSET ".(int)$offset : null;
        return $this->_db->query($sql, array($this->id_user))->getResults();
    }

    public function has_results() {
        return ($this->count_table('contacts') > 0);
    }

    public function view_contact($id) {
        $sql  = "SELECT ";
        $sql .= "c.id as ID, c.ime, c.prezime, c.mob1, c.mob2, c.kucni, c.posao, c.slika, c.opis, ";
        $sql .= "g.id AS id_grada, g.ime AS ime_grada ";
        $sql .= "FROM contacts AS c ";
        $sql .= "LEFT OUTER JOIN gradovi AS g ";
        $sql .= "ON g.id = c.id_grad ";
        $sql .= "WHERE c.id = ? ";
        $sql .= "AND c.id_user = ? ";
        $sql .= "LIMIT 1 ";
        return $this->_db->query($sql, array($id, $this->id_user))->getResults()[0];
    }

    public function edit_contact($id) {
        return $this->view_contact($id);
    }

    public function update($id, $ime, $prezime, $mob1, $mob2, $kucni, $posao, $slika, $opis, $id_grad) {

        $this->_db->update('contacts', $id, array(
            'id_user' => $this->id_user,
            'ime' => $ime,
            'prezime' => $prezime,
            'mob1' => $mob1,
            'mob2' => $mob2,
            'kucni' => $kucni,
            'posao' => $posao,
            'slika' => $slika,
            'opis' => $opis,
            'id_grad' => $id_grad
        ));
        return ($this->_db->countResults()) ? true : false;
    }

    public function delete_contact($id) {
        $this->_db->delete('contacts', array('id' => $id));
        return ($this->_db->countResults()) ? true : false;
    }

} 