<?= $this->extend('layout')?>
<?= $this->section('content')?>

<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tambah Kategori</h4>
                    <a href="/kategori-pertanian" class="btn btn-primary">Kembali</a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" method="POST" action="/kategori-pertanian/store"  data-parsley-validate>
                            <?= csrf_field() ?>  
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mandatory">
                                        <label for="nama-kategori" class="form-label">Nama Kategori</label>
                                        <input type="text" id="nama-kategori" class="form-control" placeholder="Nama Kategori" name="nama-kategori" data-parsley-required="true" />
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