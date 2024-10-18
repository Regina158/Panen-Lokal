<?= $this->extend('layout')?>
<?= $this->section('content')?>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Kategori</h4>
                    <a href="/kategori-pertanian" class="btn btn-primary">Kembali</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="/kategori-pertanian/update/<?= $kategori['id'] ?>"  data-parsley-validate>
                            <?= csrf_field() ?>  
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="nama-kategori" class="form-label">Nama Kategori</label>
                                        <input type="text" id="nama-kategori" class="form-control" value="<?= old('nama-kategori', $kategori['nama']) ?>" name="nama-kategori" data-parsley-required="true" />
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
