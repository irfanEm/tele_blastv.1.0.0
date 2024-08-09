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
    <?php 
        foreach($model['groups'] as $group) {
            echo $group['id'] . "<br>";
        }

        foreach($model['messages'] as $message) {
            echo $message['id'] . "<br>";
        }
    ?>
    <h2 class="mb-5 text-capitalize border-bottom border-dark py-2">Tambah Pesan Siaran.</h2>
    <a href="/broadcast-pesan" class="btn btn-sm btn-outline-dark mb-4 rounded rounded-pill fw-semibold">kembali</a>
    <div class="border rounded-3 p-3">
        <form action="/group" method="post">
            <div class="mb-3">
                <label for="id" class="form-label">Group</label>
                <select class="form-select" name="group_id" aria-label="Default select example">
                    <option selected>Pilih group</option>
                    <?php foreach($model['groups'] as $group) { ?>
                        <option value="<?= $group['id'] ?>"><?= $group['nama'] ?></option>
                    <?php } ?>
                </select>
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