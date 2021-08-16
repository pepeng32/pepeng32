<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-5 text-center">Daftar Mahasiswa</h1>
            <a class="btn btn-primary mb-3" href="/mhs/create">Create</a>
            <form action="/mhs" method="GET">
                <div class="input-group mb-3">
                    <input type="text" value="<?= isset($_GET['keyword']) ? $_GET['keyword'] : '' ?>" class="form-control" name="keyword" placeholder="What to search" aria-label="What to search" autofocus>
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php if (session()->getFlashdata('message')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= session()->getFlashdata('message'); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <table class="table table-bordered align-middle align-center text-center">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nim</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mahasiswa as $key => $m) : ?>
                        <tr>
                            <td width="5%"><b><?= $startNumber++ ?></b></td>
                            <td width="10%"><?= $m['nim'] ?></td>
                            <td width="30%"><?= $m['nama'] ?></td>
                            <td width="40%"><?= $m['alamat'] ?></td>
                            <td width="5%"><img class="foto" src="/foto/<?= $m['foto'] ?>" alt=""></td>
                            <td width="10%"><a class="btn btn-primary" href="/mhs/detail/<?= $m['nim'] ?>">Detail</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('default', 'bootstrap_pagination'); ?>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>