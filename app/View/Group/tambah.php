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
    <h2 class="mb-5 text-capitalize border-bottom border-dark py-2s">Tambah Group.</h2>
    <a href="/group" class="btn btn-sm btn-outline-dark mb-4 rounded rounded-pill fw-bold">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"></path>
        </svg>
    </a>
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
            
            <button type="submit" class="btn btn-dark px-3 rounded rounded-pill">Tambah</button>
        </form>
    </div>   
    </div>
</div>