<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo base_url('master_doc/add_action'); ?>" method="POST">
        <h1>Input Doc</h1>
        <label > Nama dokumen</label>
        <input type="text" name="nama_dokumen"> </br>
        <button type="submit">simpan</button>
        </form>
</body>
</html>