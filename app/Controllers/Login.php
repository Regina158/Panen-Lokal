<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to("/dashboard");
        }
        return view('login');
    }

    public function login_action()
    {
        // Mengambil data dari form login
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Mencari pengguna berdasarkan email
        $user = $this->userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Jika login berhasil
            session()->set('logged_in', true);
            session()->set('user_id', $user['id']);
            session()->setFlashdata('success', 'Login berhasil!');
            return redirect()->to('/dashboard'); // Ganti dengan route setelah login
        } else {
            // Jika login gagal
            session()->setFlashdata('error', 'Email atau Password salah');
            return redirect()->to('/'); // Kembali ke halaman login
        }
    }

    public function logout()
    {
        // Menghapus sesi pengguna
        session()->destroy();
        return redirect()->to('/'); // Redirect ke halaman login setelah logout
    }
}
