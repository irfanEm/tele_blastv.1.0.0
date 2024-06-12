<div class="container-fluid mt-3 p-2 d-flex align-items-center" style="height: 100vh;">
  <div class="container-xxl">
    <div class="row">
      <?php if(isset($model['error'])) : ?>
      <div class="col-12">
        <div class="alert alert-<?= $model['error']['type'] ?> alert-dismissible fade show" role="alert">
          <strong><?= $model['error']['pesan'] ?></strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
      <?php endif; ?>
      <div class="col-md-6 col-xs-12 p-2 d-flex flex-column justify-content-center">
        <div class="d-flex flex-column justify-content-center">
          <h1 class="fw-bolder px-md-3 px-sm-1 text-capitalize">Register User Tele Blast XML</h1>
          <p class="text-secondary text-decoration-none px-md-3 px-sm-1 text-capitalize">  <nbsp>by : <a href="http://instagram.com/irfan.em" class="text-decoration-none text-success fw-bold">irfanEm</a></p>
        </div>
      </div>
      <div class="col-md-6 col-xs-12 p-2">
        <div class="d-flex flex-column justify-content-center p-3 rounded-3 shadow-lg">
          <form action="/user/daftar" method="post">
          <div class="my-3">
              <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
              <input type="text" class="form-control text-secondary" id="nama" name="nama" placeholder="Abdul Mutholib">
          </div>
          <div class="mb-3">
              <label for="email" class="form-label fw-bold">Email </label>
              <input type="email" class="form-control text-secondary" id="email" name="email" placeholder="abdulmutholib@email.com">
          </div>
          <div class="mb-3">
              <label for="password" class="form-label fw-bold">Password </label>
              <input type="password" class="form-control text-secondary" id="password" name="password">
              <div id="passwordHelpBlock" class="form-text">
              Kata sandi Anda harus terdiri dari 8-20 karakter, terdiri dari huruf dan angka, serta tidak boleh mengandung spasi, karakter khusus, atau emoji.
              </div>
          </div>
          <div class="my-3 d-flex justify-content-end">
              <button type="submit" class="btn btn-success px-5 fw-bold">Daftar</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>