<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Register extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        
        if (session()->get('logged_in')) {
            
                return redirect()->to("/dashboard");
            
        }
        return view('register');
    }

    public function store()
    {
      // Validasi input form
      $validation = $this->validate([
        'email' => 'required|valid_email|is_unique[users.email]',
        'name' => 'required|min_length[3]|max_length[50]',
        'password' => 'required|min_length[6]'
    ]);

    if (!$validation) {
        // Menyimpan pesan error ke session flashdata
        $errors = $this->validator->getErrors();
        if (isset($errors['email'])) {
            // Jika error ada pada email, simpan pesan khusus
            session()->setFlashdata('error', 'Email sudah terdaftar. Silakan gunakan email lain.');
        }
        return redirect()->back()->withInput()->with('errors', $errors);
    }

    // Hash password menggunakan bcrypt
    $hashedPassword = password_hash(htmlspecialchars($this->request->getVar('password')), PASSWORD_BCRYPT);

    // Simpan ke database
    $this->userModel->save([
        'email' => $this->request->getPost('email'),
        'name' => $this->request->getPost('name'),
        'password' => $hashedPassword
    ]);

    // Redirect ke halaman login atau dashboard setelah berhasil
    return redirect()->to('/')->with('success', 'Registrasi berhasil, Silahkan login.');
    }
}
