<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <title><?= $title; ?></title>

    <?= $this->renderSection('additionalCss'); ?>
</head>

<body>
    <!-- navbar -->
    <?= $this->include('layout/navbar') ?>

    <!-- content -->
    <?= $this->renderSection('content'); ?>

    <!-- script js -->
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        function showPreview() {
            const foto = document.querySelector('#formFileFoto');
            const previewFoto = document.querySelector('#previewFoto');
            const fileFoto = new FileReader();

            fileFoto.readAsDataURL(foto.files[0]);
            fileFoto.onload = function(e) {
                previewFoto.src = e.target.result;
            }
        }
    </script>

    <?= $this->renderSection('additionalJs'); ?>
</body>

</html>