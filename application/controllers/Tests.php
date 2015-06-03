<?php

include_once APPPATH . '/controllers/Base.php';

class Tests extends Base {

    private $viewIndicator;

    public function __construct() {
        parent::__construct();
        $this->load->library('unit_test');
        $this->load->model('predstave_m');
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

        $test = $this->predstave_m->insert(null, null);
        $test_name = 'Insert with no creator username';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no username passed');

        $_POST['pozID'] = null;
        $test = $this->predstave_m->insert('LukaAdmin', null);
        $test_name = 'Insert with no pozID in POST';
        $this->unit->run($test, $expected_result, $test_name, 'Insert should return FALSE if no pozID in POST');

        $_POST['naziv'] = null;
        $test = $this->predstave_m->insert('LukaAdmin', null);
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

        $this->viewIndicator = 'testPredstaveModel';
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
