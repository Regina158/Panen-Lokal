<?= $this->extend('layout')?>
<?= $this->section('content')?>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Produk</h4>
                    <a href="/produk-pertanian" class="btn btn-primary">Kembali</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="/produk-pertanian/store" enctype="multipart/form-data" data-parsley-validate>
                            <?= csrf_field() ?>  
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="nama-produk" class="form-label">Nama Produk</label>
                                        <input type="text" id="nama-produk" class="form-control" placeholder="Nama Produk" name="nama-produk" data-parsley-required="true" />
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="number" id="harga" class="form-control" name="harga" placeholder="Harga" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" id="stock" class="form-control" name="stock" placeholder="Stock" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-12">
                                <div class="form-group mandatory">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="kategori" name="kategori_id" required>
                                            <option value="">Pilih Kategori</option>
                                            <?php foreach ($kategori as $kat): ?>
                                                <option value="<?= $kat['id'] ?>"><?= $kat['nama'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </fieldset>
                                </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea id="summernote" name="deskripsi"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="gambar" class="form-label">Gambar</label>
                                        <input type="file" name="gambar" id="gambar" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-primary me-4 mb-1">Submit</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection()?>