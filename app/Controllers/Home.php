<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //  Memeriksa nilai session
        if (!session()->get('logged_in')) {
            return redirect()->to("/");
        }

        $data = [
            'title' => 'PanenLokal',
            'currentPage' => 'dashboard'
        ];
        return view('dashboard', $data);
    }
}
