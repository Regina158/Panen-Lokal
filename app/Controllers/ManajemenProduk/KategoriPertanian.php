<?php

namespace App\Controllers\ManajemenProduk;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class KategoriPertanian extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }
    public function index()
    {

        $kategori = $this->kategoriModel->findAll();
        $data = [
            'title' => 'Kategori Pertanian',
            'currentPage' => 'kategori-pertanian',
            'kategori'=> $kategori
        ];

        return view('KategoriPertanian/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Kategori',
            'currentPage' => 'kategori-pertanian'
        ];

        return view('KategoriPertanian/create', $data);
    }
    public function store()
    {
        // Validasi Inputan dari form
        $rules = [
            'nama-kategori' => 'required',
            
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
        
        // Mengambil data yang dikirimkan dari form
        $namaKategori = $this->request->getPost('nama-kategori');


        $data = [
            'nama' => $namaKategori,
       
        ];

        if ($this->kategoriModel->insert($data)) {
            return redirect()->to('/kategori-pertanian')->with('success', 'Kategori berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan Kategori. Silakan coba lagi.');
        }
    }
    
    public function edit($id)
{
    // Cari kategori berdasarkan ID
    $kategori = $this->kategoriModel->find($id);

    // Jika kategori tidak ditemukan
    if (!$kategori) {
        return redirect()->to('/kategori-pertanian')->with('error', 'Kategori tidak ditemukan');
    }

    $data = [
        'title' => 'Edit Kategori',
        'currentPage' => 'kategori-pertanian',
        'kategori' => $kategori
    ];

    return view('KategoriPertanian/edit', $data);
}

public function update($id)
{
    // Validasi Inputan dari form
    $rules = [
        'nama-kategori' => 'required',
        
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
    }

    // Mengambil data yang dikirimkan dari form
    $namaKategori = $this->request->getPost('nama-kategori');
  

    $data = [
        'nama' => $namaKategori,
   
    ];

    // Update data kategori
    if ($this->kategoriModel->update($id, $data)) {
        return redirect()->to('/kategori-pertanian')->with('success', 'Kategori berhasil diperbarui.');
    } else {
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui Kategori. Silakan coba lagi.');
    }
}

    public function delete($id)
    {
        
    
        // Cek apakah kategori dengan ID tersebut ada
        $kategori = $this->kategoriModel->find($id);
        
        if ($kategori) {
            // Jika ada, hapus kategori
            $this->kategoriModel->delete($id);
            
            // Set pesan sukses
            session()->setFlashdata('success', 'Kategori berhasil dihapus.');
        } else {
            // Jika kategori tidak ditemukan, set pesan error
            session()->setFlashdata('error', 'Kategori tidak ditemukan.');
        }
    
        // Redirect kembali ke halaman kategori
        return redirect()->to('/kategori-pertanian');
    }
}
