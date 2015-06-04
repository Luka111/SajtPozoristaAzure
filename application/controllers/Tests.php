<?php

include_once APPPATH . '/controllers/Base.php';

class Tests extends Base {

    private $viewIndicator;

    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('predstave_m');
        $this->load->model('pozorista_m');
        $this->load->model('vesti_m');
        $this->load->model('kritike_m');
        $this->load->model('komentari_m');
        $this->load->model('user');
    }

    protected function obrada($data = NULL) {
        if ($this->viewIndicator) {
            echo '<br/><br/><br/><br/>';
            echo $this->unit->report();
            echo '<h2><a style="color:green" href="' . route_url('tests/view') . '"> < Back to testing</a></h2><hr>';
        } else {
            $this->load->view('tests/testList', $data);
        }
    }

    public function testPredstaveModel() {
        $expected_result = 'is_false';

        $test = $this->predstave_m->insert(null, 'smth');
        $test_name = 'Insert with no creator username';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no username passed');

        $_POST['pozID'] = null;
        $test = $this->predstave_m->insert('LukaAdmin', 'smth');
        $test_name = 'Insert with no pozID in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no pozID in POST');

        $_POST['pozID'] = '3';
        $_POST['naziv'] = null;
        $test = $this->predstave_m->insert('LukaAdmin', 'smth');
        $test_name = 'Insert with no naziv in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no naziv in POST');

        $test = $this->predstave_m->findOne(null);
        $test_name = 'findOne with no id';
        $this->unit->run($test, $expected_result, $test_name, 'findOne should return FALSE if no id passed');

        $test = $this->predstave_m->findIDsByPozId(null);
        $test_name = 'findIDsByPozId with no pozID';
        $this->unit->run($test, $expected_result, $test_name, 'findIDsByPozId should return FALSE if no PozID passed');

        $test = $this->predstave_m->obrisiPredstavu(null, 'admin');
        $test_name = 'obrisiPredstavu with no PredID';
        $this->unit->run($test, $expected_result, $test_name, 'obrisiPredstavu should return FALSE if no PredID passed');

        $test = $this->predstave_m->obrisiPredstavu(6, null);
        $test_name = 'obrisiPredstavu with no user role';
        $this->unit->run($test, $expected_result, $test_name, 'obrisiPredstavu should return FALSE if no userRole passed');

        $_POST['pozID'] = null;
        $test = $this->predstave_m->update('LukaAdmin', 'smth');
        $test_name = 'Update with no pozID in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no pozID in POST');

        $_POST['pozID'] = '3';
        $_POST['naziv'] = null;
        $test = $this->predstave_m->update('LukaAdmin', 'smth');
        $test_name = 'Update with no naziv in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no naziv in POST');

        $this->viewIndicator = 'testPredstaveModel';
        $this->view();
    }

    public function testKritikeModel() {
        $expected_result = 'is_false';

        $test = $this->kritike_m->insert(null, '3');
        $test_name = 'Insert with no creator username';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no username passed');

        $test = $this->kritike_m->insert('LukaAdmin', null);
        $test_name = 'Insert with no predID';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no predID passed');
        
        $_POST['naslov'] = null;
        $test = $this->kritike_m->insert('LukaAdmin', 'smth');
        $test_name = 'Insert with no naslov in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no naslov in POST');

        $_POST['naslov'] = 'Neki naziv kritike';
        $_POST['sadrzaj'] = null;
        $test = $this->kritike_m->insert('LukaAdmin', 'smth');
        $test_name = 'Insert with no sadrzaj in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Sadrzaj in POST');

        $test = $this->kritike_m->findOne(null);
        $test_name = 'findOne with no id';
        $this->unit->run($test, $expected_result, $test_name, 'findOne should return FALSE if no id passed');

        $test = $this->kritike_m->findIDs(null);
        $test_name = 'findIDs with no KritID';
        $this->unit->run($test, $expected_result, $test_name, 'findIDs should return FALSE if no predID passed');

        $test = $this->kritike_m->removeOne(null);
        $test_name = 'removeOne with no KritID';
        $this->unit->run($test, $expected_result, $test_name, 'removeOne should return FALSE if no KritID passed');

        $_POST['naslov'] = null;
        $test = $this->kritike_m->update('smth');
        $test_name = 'Update with no naslov in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no naslov in POST');

        $_POST['sadrzaj'] = null;
        $test = $this->kritike_m->update('smth');
        $test_name = 'Update with no sadrzaj in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no sadrzaj in POST');

        $this->viewIndicator = 'testKritikeModel';
        $this->view();
    }

    public function testPozoristaModel() {

        $expected_result = 'is_false';

        $test = $this->pozorista_m->insert(null, 'smth');
        $test_name = 'Insert with no creator username';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no username passed');

        $_POST['naziv'] = null;
        $test = $this->pozorista_m->insert('LukaAdmin', null);
        $test_name = 'Insert with no Naziv in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Naziv in POST');

        $_POST['naziv'] = 'Poz1';
        $_POST['adresa'] = null;
        $test = $this->pozorista_m->insert('LukaAdmin', 'smth');
        $test_name = 'Insert with no Adresa in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Adresa in POST');

        $_POST['adresa'] = 'Milana Rakica 1';
        $_POST['telefon'] = null;
        $test = $this->pozorista_m->insert('LukaAdmin', 'smth');
        $test_name = 'Insert with no Telefon in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Telefon in POST');

        $_POST['telefon'] = '0112412345';
        $_POST['email'] = null;
        $test = $this->pozorista_m->insert('LukaAdmin', 'smth');
        $test_name = 'Insert with no Email in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Email in POST');

        $_POST['email'] = 'da@ne.com';
        $_POST['opis'] = null;
        $test = $this->pozorista_m->insert('LukaAdmin', 'smth');
        $test_name = 'Insert with no Opis in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Opis in POST');

        $test = $this->pozorista_m->findOne(null);
        $test_name = 'findOne with no id';
        $this->unit->run($test, $expected_result, $test_name, 'findOne should return FALSE if no id passed');

        $test = $this->pozorista_m->findNaziv(null);
        $test_name = 'findNaziv with no id';
        $this->unit->run($test, $expected_result, $test_name, 'findNaziv should return FALSE if no id passed');

        $test = $this->pozorista_m->removeOne(null);
        $test_name = 'removeOne with no PozID';
        $this->unit->run($test, $expected_result, $test_name, 'removeOne should return FALSE if no PozID passed');


        $_POST['naziv'] = null;
        $test = $this->pozorista_m->update('smth');
        $test_name = 'Update with no Naziv in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no Naziv in POST');

        $_POST['naziv'] = 'Poz1';
        $_POST['adresa'] = null;
        $test = $this->pozorista_m->update('smth');
        $test_name = 'Update with no Adresa in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no Adresa in POST');

        $_POST['adresa'] = 'Milana Rakica 1';
        $_POST['telefon'] = null;
        $test = $this->pozorista_m->update('smth');
        $test_name = 'Update with no Telefon in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no Telefon in POST');

        $_POST['telefon'] = '0112412345';
        $_POST['email'] = null;
        $test = $this->pozorista_m->update('smth');
        $test_name = 'Update with no Email in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no Email in POST');

        $_POST['email'] = 'da@ne.com';
        $_POST['opis'] = null;
        $test = $this->pozorista_m->update('smth');
        $test_name = 'Update with no Opis in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no Opis in POST');

        $this->viewIndicator = 'testPozoristaModel';
        $this->view();
    }

    public function testVestiModel() {
        $expected_result = 'is_false';

        $test = $this->vesti_m->insert(null, 'smth');
        $test_name = 'Insert with no creator username';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no username passed');

        $_POST['Naslov'] = null;
        $test = $this->vesti_m->insert('LukaAdmin', null);
        $test_name = 'Insert with no Naslov in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Naslov in POST');

        $_POST['Naslov'] = 'neki';
        $_POST['Sadrzaj'] = null;
        $test = $this->vesti_m->insert('LukaAdmin', null);
        $test_name = 'Insert with no Sadrzaj in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Sadrzaj in POST');

        $test = $this->vesti_m->findOne(null);
        $test_name = 'findOne with no id';
        $this->unit->run($test, $expected_result, $test_name, 'findOne should return FALSE if no id passed');

        $test = $this->vesti_m->removeOne(null);
        $test_name = 'removeOne with no VestID';
        $this->unit->run($test, $expected_result, $test_name, 'removeOne should return FALSE if no VestID passed');

        $_POST['Naslov'] = null;
        $test = $this->vesti_m->update(null);
        $test_name = 'Update with no Naslov in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no Naslov in POST');

        $_POST['Naslov'] = 'neki';
        $_POST['Sadrzaj'] = null;
        $test = $this->vesti_m->update(null);
        $test_name = 'Update with no Sadrzaj in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Update should return FALSE if no Sadrzaj in POST');

        $this->viewIndicator = 'testVestiModel';
        $this->view();
    }
    
    public function testKomentariModel() {
        $expected_result = 'is_false';

        $test = $this->komentari_m->insert(null, '3');
        $test_name = 'Insert with no creator username';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no username passed');

        $test = $this->komentari_m->insert('LukaAdmin', null);
        $test_name = 'Insert with no predID';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no predID passed');
        
        $_POST['Tekst'] = null;
        $test = $this->komentari_m->insert('LukaAdmin', 'smth');
        $test_name = 'Insert with no naslov in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Tekst in POST');

        $test = $this->komentari_m->find(null);
        $test_name = 'find with no predID';
        $this->unit->run($test, $expected_result, $test_name, 'findOne should return FALSE if no predID passed');

        $test = $this->komentari_m->findIDs(null);
        $test_name = 'findIDs with no predID';
        $this->unit->run($test, $expected_result, $test_name, 'findIDs should return FALSE if no PredID passed');

        $test = $this->komentari_m->removeOne(null);
        $test_name = 'removeOne with no id';
        $this->unit->run($test, $expected_result, $test_name, 'removeOne should return FALSE if no id passed');

        $this->viewIndicator = 'testKritikeModel';
        $this->view();
    }
    
        public function testUserModel() {
        $expected_result = 'is_false';

        $_POST['username'] = null;
        $test = $this->user->insert();
        $test_name = 'Insert with no username in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no username in POST');

        $_POST['username'] = 'LukaAdmin';
        $_POST['password'] = null;
        $test = $this->user->insert();
        $test_name = 'Insert with no password in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no password in POST');

        $_POST['password'] = 'nesto123';
        $_POST['telefon'] = null;
        $test = $this->user->insert();
        $test_name = 'Insert with no Telefon in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Telefon in POST');

        $_POST['telefon'] = '0112412345';
        $_POST['email'] = null;
        $test = $this->user->insert();
        $test_name = 'Insert with no Email in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Email in POST');

        $_POST['email'] = 'da@ne.com';
        $_POST['role'] = null;
        $test = $this->user->insert();
        $test_name = 'Insert with no Role in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Role in POST');
        
        $_POST['role'] = 'admin';
        $_POST['posta'] = null;
        $test = $this->user->insert();
        $test_name = 'Insert with no Posta in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Posta in POST');

        $_POST['posta'] = 'on';
        $_POST['birthyear'] = null;
        $test = $this->user->insert();
        $test_name = 'Insert with no Birthyear in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no Birthyear in POST');

        $_POST['username'] = null;
        $test = $this->user->findOne();
        $test_name = 'findOne with no username in POST';
        $this->unit->run($test, $expected_result, $test_name, 'findIDs should return FALSE if no username in POST');

        $test = $this->user->removeOne(null);
        $test_name = 'removeOne with no username';
        $this->unit->run($test, $expected_result, $test_name, 'removeOne should return FALSE if no username passed');
        
        $test = $this->user->makeSession(null);
        $test_name = 'makeSession with no userData';
        $this->unit->run($test, $expected_result, $test_name, 'removeOne should return FALSE if no userData passed');

        $this->viewIndicator = 'testKritikeModel';
        $this->view();
    }

    public function testHelperFunctions() {

        $test;

        try {
            $test = asset_url(10);
        } catch (Exception $e) {
            $expected_result = 'is_object';
            $test_name = 'asset_url with non-string parametar';
            $this->unit->run($e, $expected_result, $test_name, 'asset_url should THROW if you pass anything but string');
        }

        try {
            $test = route_url(35351);
        } catch (Exception $e) {
            $expected_result = 'is_object';
            $test_name = 'route_url with non-string parametar';
            $this->unit->run($e, $expected_result, $test_name, 'route_url should THROW if you pass anything but string');
        }

        $test = checkPermission('smth', 'admin');
        $expected_result = 'is_false';
        $test_name = 'checkPermission with non-array first paramter';
        $this->unit->run($test, $expected_result, $test_name, 'checkPermission should return FALSE if first parametar is not array');

        $test = checkPermission(array('admin'), 4);
        $expected_result = 'is_false';
        $test_name = 'checkPermission with non-string second paramter';
        $this->unit->run($test, $expected_result, $test_name, 'checkPermission should return FALSE if second parametar is not string');

        try {
            $test = display_image(10, 'smth', 'smth');
        } catch (Exception $e) {
            $expected_result = 'is_object';
            $test_name = 'display_image with non-string first parametar';
            $this->unit->run($e, $expected_result, $test_name, 'display_image should THROW if you pass anything but string');
        }

        try {
            $test = display_image('smth', 10, 'smth');
        } catch (Exception $e) {
            $expected_result = 'is_object';
            $test_name = 'display_image with non-string second parametar';
            $this->unit->run($e, $expected_result, $test_name, 'display_image should THROW if you pass anything but string');
        }

        try {
            $test = display_image('smth', 'smth', 10);
        } catch (Exception $e) {
            $expected_result = 'is_object';
            $test_name = 'display_image with non-string third parametar';
            $this->unit->run($e, $expected_result, $test_name, 'display_image should THROW if you pass anything but string');
        }

        $this->viewIndicator = 'testPredstaveController';
        $this->view();
    }

}
