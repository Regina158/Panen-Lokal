<?= $this->extend('layout')?>
<?= $this->section('content')?>
<section class="section">
<?php if (!empty(session()->getFlashdata('success'))) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
    <?php if (!empty(session()->getFlashdata('error'))) : ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif ?>
        <div class="card">
        <div class="card-header">
            <h5 class="card-title">Kategori Pertanian</h5>
            <a href="/kategori-pertanian/create" class="btn btn-primary">Tambah Kategori</a>
        </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($kategori as $key => $item) : ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $item['nama'] ?></td>
                            <td>
                            <a href="/kategori-pertanian/edit/<?= $item['id'] ?>" class="btn btn-primary">Edit</a>
                            <form action="/kategori-pertanian/<?= $item['id'] ?>" method="POST" class="d-inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah ingin menghapus?')">Hapus</button>
                            </form>
                            
                        </td>
                           
                        </tr>
                        <?php endforeach?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>


<?= $this->endSection()?>