<?= $this->extend('layout/template'); ?>

<!-- more css -->
<?= $this->section('additionalCss'); ?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
<?= $this->endSection(); ?>

<!-- more js -->
<?= $this->section('additionalJs'); ?>
<script type="text/javascript" src="//code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable').DataTable({
            "order": [],
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?= site_url('dtt/getTable'); ?>",
                "type": "POST",
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }]
        });
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?> <div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mb-3">Datatables</h1>
            <table id="myTable" class="table" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nim</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>