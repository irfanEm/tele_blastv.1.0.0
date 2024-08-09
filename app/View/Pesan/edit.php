<?php
    use IRFANEM\TELE_BLAST\Helper\Alert;
?>

<div class="col-md-12 col-sm-12 col-xs-12">
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

    <h2 class="mb-5 text-capitalize border-bottom border-dark py-2">Edit Pesan.</h2>
    <a href="/pesan" class="btn btn-sm btn-outline-dark mb-4 rounded rounded-pill fw-semibold">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"></path>
        </svg>
        kembali
    </a>
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
                                    
            <button type="submit" class="btn btn-dark px-3 rounded rounded-pill">Edit</button>
        </form>
    </div>   
    </div>
</div>