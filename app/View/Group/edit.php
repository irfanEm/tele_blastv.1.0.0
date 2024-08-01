<?php
use IRFANEM\TELE_BLAST\Helper\Alert;
?>

<div class="col-md-9 col-sm-12 col-xs-12 border">
    <?php if(isset($model['error'])) : ?>
    <div class="col-12">
        <div class="alert alert-<?= $model['error']['type'] ?> alert-dismissible fade show" role="alert">
        <strong><?= $model['error']['pesan'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($message = Alert::getFlash('alert')): ?>
        <p style="color: red;"><?php echo $message['success']; ?></p>
    <?php endif; ?>
    <div class="container my-3">
    <h2 class="mb-3">Form Edit Group.</h2>
    <div class="border rounded-3 p-3">
        <form action="/group/edit" method="post">
            <div class="mb-3">
                <label for="id" class="form-label">Id Group</label>
                <input type="text" class="form-control" name="id" id="id" aria-describedby="emailHelp" value="<?= $model['id'] ?>" >
                <div id="emailHelp" class="form-text text-danger">Id group tidak bisa diubah, jika terdapat kesalahan, silahkan hapus dan tambahkan baru.</div>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Group</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= $model['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username Group</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= $model['username'] ?>">
            </div>
            
            <button type="submit" class="btn btn-dark rounded rounded-pill px-3">Edit</button>
        </form>
    </div>   
    </div>
</div>