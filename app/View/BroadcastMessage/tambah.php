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
    <h2 class="mb-3">Form Tambah Group.</h2>
    <div class="border rounded-3 p-3">
        <form action="/group" method="post">
            <div class="mb-3">
                <label for="id" class="form-label">Id Group</label>
                <input type="text" class="form-control" name="id" id="id" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Pastikan id group benar, kesalahan id group akan menimbulkan <strong class="text-danger">error</strong>.</div>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Group</label>
                <input type="text" class="form-control" name="nama" id="nama">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username Group</label>
                <input type="text" class="form-control" name="username" id="username">
            </div>
            
            <button type="submit" class="btn btn-primary rounded rounded-pill">Tambah</button>
        </form>
    </div>   
    </div>
</div>