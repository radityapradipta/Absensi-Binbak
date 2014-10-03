<?php

class ConverterController extends BaseController {

    public function __construct() {
        $this->converter = new AccessConverter();
    }

    public function index() {
        return View::make('converters.convertDocument');
    }

    public function execute() {
        /* $input = Input::all();
          $rules = array('file' => 'mimes:mdb');
          $validasi = Validator::make($input, $rules);
          if ($validasi->fails()) {
          return 'error';
          } else {
          //$directory = public_path().'/'.'images';
          $directory = public_path();
          $mdb = Input::file('file');
          $filename = $mdb->getClientOriginalName();
          $upload_sukses = $mdb->move($directory, $filename);
          if ($upload_sukses) { */
        $start = time();
//        $this->converter = new AccessConverter();
        $this->converter->convert();
        return 'berhasil ' . date('s', time() - $start);
        /* } else {
          return 'gagal';
          }
          } */
    }

}
