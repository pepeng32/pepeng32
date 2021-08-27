<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="mt-5">Edit Data</h1>
            <form action="/mhs/update/<?= $mahasiswa['id']; ?>" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" value="<?= $mahasiswa['nim']; ?>" id="nimOld" name="nimOld">
                <input type="hidden" value="<?= $mahasiswa['foto']; ?>" id="fotoOld" name="fotoOld">
                <div class="row mb-3">
                    <label for="nim" class="col-sm-2 col-form-label">Nim</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= (old('nim')) ? old('nim') : $mahasiswa['nim'] ?>" class="form-control <?= ($validation->hasError('nim')) ? 'is-invalid' : ''; ?>" id="nim" name="nim" autofocus>
                        <div class="invalid-feedback">
                            <?= $validation->getError('nim'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= (old('nama')) ? old('nama') : $mahasiswa['nama'] ?>" class="form-control" id="nama" name="nama">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?= (old('alamat')) ? old('alamat') : $mahasiswa['alamat'] ?>" class="form-control" id="alamat" name="alamat">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="formFileFoto" class="col-sm-2 col-form-label">Foto</label>
                    <div class="col-sm-2">
                        <img src="/foto/<?= $mahasiswa['foto'] ?>" class="img-thumbnail" id="previewFoto">
                    </div>
                    <div class="col-sm-8">
                        <input type="file" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="formFileFoto" name="foto" onchange="showPreview()">
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto'); ?>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/mhs" class="btn btn-warning">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>