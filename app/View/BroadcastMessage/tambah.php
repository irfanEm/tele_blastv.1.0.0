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

    <h2 class="mb-5 text-capitalize border-bottom border-dark py-2">Tambah Pesan Siaran.</h2>
    <a href="/pesan-siaran" class="btn btn-sm btn-outline-dark mb-4 rounded rounded-pill fw-semibold shadow">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"></path>
        </svg>
    </a>
    <div class="border rounded-3 px-3 py-4 shadow">
        <form action="/pesan-siaran" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Pilih Pesan </label>
                <select class="form-select" name="pesan_id" aria-label="Default select example">
                    <option selected>Judul pesan</option>
                    <?php foreach($model['messages'] as $message) { ?>
                        <option value="<?= $message['id'] ?>"><?= $message['judul'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="my-3">
                <label for="nama" class="form-label">Pilih Group </label>
                <br>
                <?php foreach($model['groups'] as $group) { ?>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="groups.<?= $group['id'] ?>" type="checkbox" value="<?= $group['id'] ?>" id="<?= $group['id'] ?>">
                        <label class="form-check-label" for="flexCheckDefault">
                            <?= $group['nama'] ?>
                        </label>
                    </div>
                <?php } ?>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Waktu Siaran</label>
                <input type="time" class="form-control" name="waktu" id="waktu">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Hari </label>
                <div class="form-check">
                    <input class="form-check-input" name="minggu" type="checkbox" value="0" id="minggu">
                    <label class="form-check-label text-capitalize" for="flexCheckDefault">
                        Minggu
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="senin" type="checkbox" value="1" id="senin">
                    <label class="form-check-label text-capitalize" for="flexCheckDefault">
                        Senin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="selasa" type="checkbox" value="2" id="selasa">
                    <label class="form-check-label text-capitalize" for="flexCheckDefault">
                        Selasa
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="rabu" type="checkbox" value="3" id="rabu">
                    <label class="form-check-label text-capitalize" for="flexCheckDefault">
                        rabu
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="kamis" type="checkbox" value="4" id="kamis">
                    <label class="form-check-label text-capitalize" for="flexCheckDefault">
                        kamis
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="jumat" type="checkbox" value="5" id="jumat">
                    <label class="form-check-label text-capitalize" for="flexCheckDefault">
                        jumat
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" name="sabtu" type="checkbox" value="6" id="sabtu">
                    <label class="form-check-label text-capitalize" for="flexCheckDefault">
                        sabtu
                    </label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-dark px-3 rounded rounded-pill shadow">Tambah</button>
        </form>
    </div>   
    </div>
</div>