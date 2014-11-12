<?php

class ConverterController extends BaseController {

    public function index() {
        return View::make('converters.convertDocument');
    }

    public function upload() {
        $directory = public_path();
        $mdb = Input::file('file');
        $filename = 'att2000.mdb';
        $upload_sukses = $mdb->move($directory, $filename);
        if ($upload_sukses) {
            return 'berhasil';
        } else {
            return 'gagal';
        }
    }

    public function convert() {
        $start = time();
        $converter = new AccessConverter();
        $num_data = $converter->convert();
        return $num_data . ' data berhasil ditambahkan dalam ' . (time() - $start) . ' detik';
    }

}
