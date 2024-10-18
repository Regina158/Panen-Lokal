<?php

namespace App\Controllers\ManajemenProduk;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\ProdukModel;

class ProdukPertanian extends BaseController
{
    protected $produkModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->produkModel = new ProdukModel();
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        // Ambil semua produk dengan menggabungkan kategori
    $produk = $this->produkModel->select('produk.*, kategori.nama as kategori_nama')
    ->join('kategori', 'kategori.id = produk.kategori_id', 'left')
    ->findAll();

    $data = [
    'title' => 'Produk Pertanian',
    'currentPage' => 'produk-pertanian',
    'produk' => $produk // Produk sekarang berisi nama kategori
    ];

    return view('ProdukPertanian/index', $data);
    }

    public function create()
    {
        $kategori =  $this->kategoriModel->findAll();
        $data = [
            'title' => 'Create Produk',
            'currentPage' => 'produk-pertanian',
            'kategori' => $kategori
        ];

        return view('ProdukPertanian/create', $data);
    }

    public function store()
    {
        // Validasi Inputan dari form
        $rules = [
            'nama-produk' => 'required|max_length[100]',
            'harga' => 'required|decimal',
            'stock' => 'required|integer',
            'deskripsi' => 'required',
            'kategori_id' => 'required|integer', // Tambahkan validasi untuk kategori_id
            'gambar' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];
    
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
        
        // Mengambil data yang dikirimkan dari form
        $namaProduk = $this->request->getPost('nama-produk');
        $harga = $this->request->getPost('harga');
        $stock = $this->request->getPost('stock');
        $deskripsi = $this->request->getPost('deskripsi');
        $kategoriId = $this->request->getPost('kategori_id'); // Ambil kategori_id dari form
    
        // Khusus untuk data file gambar yang di-upload
        $gambar = $this->request->getFile('gambar');
        $gambarName = null;
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move(FCPATH . 'uploads', $gambarName); // Menyimpan gambar ke folder public/uploads
        }
    
        $data = [
            'nama' => $namaProduk,
            'harga' => $harga,
            'stock' => $stock,
            'deskripsi' => $deskripsi,
            'kategori_id' => $kategoriId, // Menyimpan kategori_id
            'gambar' => $gambarName
        ];
    
        if ($this->produkModel->insert($data)) {
            return redirect()->to('/produk-pertanian')->with('success', 'Produk berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan produk. Silakan coba lagi.');
        }
    }
    
    public function edit($id)
    {
        // Cari produk berdasarkan ID
        $produk = $this->produkModel->find($id);
    
        // Jika produk tidak ditemukan
        if (!$produk) {
            return redirect()->to('/produk-pertanian')->with('error', 'Produk tidak ditemukan');
        }
    
        $data = [
            'title' => 'Edit Produk',
            'currentPage' => 'produk-pertanian',
            'produk' => $produk,
            'kategori' => $this->kategoriModel->findAll() // Ambil semua kategori untuk dropdown
        ];
    
        return view('ProdukPertanian/edit', $data);
    }
    
    public function update($id)
    {
        // Validasi Inputan dari form
        $rules = [
            'nama-produk' => 'required|max_length[100]',
            'harga' => 'required|decimal',
            'stock' => 'required|integer',
            'deskripsi' => 'required',
            'kategori_id' => 'required|integer', // Tambahkan validasi untuk kategori_id
            'gambar' => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]'
        ];
    
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }
    
        // Mengambil data yang dikirimkan dari form
        $namaProduk = $this->request->getPost('nama-produk');
        $harga = $this->request->getPost('harga');
        $stock = $this->request->getPost('stock');
        $deskripsi = $this->request->getPost('deskripsi');
        $kategoriId = $this->request->getPost('kategori_id'); // Ambil kategori_id dari form
    
        // Cek apakah ada file gambar yang diupload
        $gambar = $this->request->getFile('gambar');
        $produk = $this->produkModel->find($id);
        $gambarName = $produk['gambar']; // Gunakan gambar lama sebagai default
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move(FCPATH . 'uploads', $gambarName); // Simpan gambar baru
        }
    
        $data = [
            'nama' => $namaProduk,
            'harga' => $harga,
            'stock' => $stock,
            'deskripsi' => $deskripsi,
            'kategori_id' => $kategoriId, // Menyimpan kategori_id
            'gambar' => $gambarName
        ];
    
        // Update data produk
        if ($this->produkModel->update($id, $data)) {
            return redirect()->to('/produk-pertanian')->with('success', 'Produk berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui produk. Silakan coba lagi.');
        }
    }
    
    public function delete($id)
    {
        
    
        // Cek apakah produk dengan ID tersebut ada
        $produk = $this->produkModel->find($id);
        
        if ($produk) {
            // Jika ada, hapus produk
            $this->produkModel->delete($id);
            
            // Set pesan sukses
            session()->setFlashdata('success', 'Produk berhasil dihapus.');
        } else {
            // Jika produk tidak ditemukan, set pesan error
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
        }
    
        // Redirect kembali ke halaman produk
        return redirect()->to('/produk-pertanian');
    }
    
}