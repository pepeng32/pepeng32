<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-5">Detail Mahasiswa</h1>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/foto/<?= $mahasiswa['foto']; ?>" class="img-fluid rounded-start">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text">Nim : <?= $mahasiswa['nim']; ?></p>
                            <p class="card-text">Nama : <?= $mahasiswa['nama']; ?></p>
                            <p class="card-text">Alamat : <?= $mahasiswa['alamat']; ?></p>
                            <a href="/mhs/edit/<?= $mahasiswa['nim']; ?>" class="btn btn-success">Edit</a>
                            <form action="/mhs/<?= $mahasiswa['id']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin ?')">Delete</button>
                            </form>
                            <p class="card-text"><a href="/mhs"><small class="text-muted">Back to list</small></a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>