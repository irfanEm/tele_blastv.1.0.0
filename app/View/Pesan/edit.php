<?php
    use IRFANEM\TELE_BLAST\Helper\Alert;
?>

<div class="col-md-9 col-sm-12 col-xs-12 border">
    <div class="container my-3">
    <?php if(isset($model['error'])) : ?>
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong><?= $model['error'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($message = Alert::getFlash('alert')): ?>
        <p style="color: red;"><?php echo $message['success']; ?></p>
    <?php endif; ?>

    <h2 class="mb-3">Form Tambah Pesan.</h2>
    <div class="border rounded-3 p-3">
        <form action="/pesan/edit" method="post">
            <div class="mb-3">
                <input type="hidden" class="form-control" name="id" id="id" value="<?= $model['id'] ?>">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" id="judul" value="<?= $model['judul'] ?>">
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" name="pesan" style="height: 150px;"><?= $model['pesan'] ?></textarea>
                <label for="floatingTextarea2">Isi Pesan</label>
            </div>
                                    
            <button type="submit" class="btn btn-primary rounded rounded-pill">Edit</button>
        </form>
    </div>   
    </div>
</div>