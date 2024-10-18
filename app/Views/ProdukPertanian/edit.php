<?= $this->extend('layout')?>
<?= $this->section('content')?>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Produk</h4>
                    <a href="/produk-pertanian" class="btn btn-primary">Kembali</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="/produk-pertanian/update/<?= $produk['id'] ?>" enctype="multipart/form-data" data-parsley-validate>
                            <?= csrf_field() ?>  
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="nama-produk" class="form-label">Nama Produk</label>
                                        <input type="text" id="nama-produk" class="form-control" value="<?= old('nama-produk', $produk['nama']) ?>" name="nama-produk" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" id="harga" class="form-control" name="harga" value="<?= old('harga', $produk['harga']) ?>" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" id="stock" class="form-control" name="stock" value="<?= old('stock', $produk['stock']) ?>" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <fieldset class="form-group">
                                            <select class="form-select" id="kategori" name="kategori_id" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php foreach ($kategori as $kat): ?>
                                                    <option value="<?= $kat['id'] ?>" <?= $kat['id'] == $produk['kategori_id'] ? 'selected' : '' ?>><?= $kat['nama'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea id="summernote" name="deskripsi"><?= old('deskripsi', $produk['deskripsi']) ?></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <small class="text-muted d-block mb-2 ">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                                        <input type="file" name="gambar" id="gambar" class="form-control">
                                        <?php if ($produk['gambar']): ?>
                                            <img src="/uploads/<?= $produk['gambar'] ?>" alt="gambar" class="img-thumbnail mt-2" width="150">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-primary me-4 mb-1">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
