<div class="container-fluid mt-3 p-2 d-flex align-items-center" style="height: 100vh;">
  <div class="container">
    <div class="row">
      <?php if(isset($model['error'])) : ?>
      <div class="col-12">
        <div class="alert alert-<?= $model['error']['type'] ?> alert-dismissible fade show" role="alert">
          <strong><?= $model['error']['pesan'] ?></strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
      <?php endif; ?>
      <div class="col-md-6 col-xs-12 p-3">
        <div class="d-flex flex-column justify-content-center">
          <h1 class="fw-bolder px-md-3 px-sm-1 text-capitalize">Login User Tele Blast XML</h1>
          <p class="text-secondary text-decoration-none px-md-3 px-sm-1 text-capitalize">  <nbsp>by : <a href="http://instagram.com/irfan.em" class="text-decoration-none text-success fw-bold">irfanEm</a></p>
        </div>
      </div>
      <div class="col-md-6 col-xs-12 p-3">
        <div class="d-flex flex-column justify-content-center p-3 rounded-3 shadow-lg">
          <form action="/user/login" method="post">
          <div class="my-3">
              <!-- <label for="email" class="form-label fw-bold">Email </label> -->
              <input type="email" class="form-control text-secondary" id="email" name="email" placeholder="Email">
          </div>
          <div class="mb-3">
              <!-- <label for="password" class="form-label fw-bold">Password </label> -->
              <input type="password" class="form-control text-secondary" id="password" name="password" placeholder="Password">
              <div id="passwordHelpBlock" class="form-text fw-light text-secondary text-opacity-75 text-secondary mt-2" style="font-size: .8em;">
              Password Anda harus terdiri dari 8-20 karakter, terdiri dari huruf dan angka, serta tidak boleh mengandung spasi, karakter khusus, atau emoji.
              </div>
          </div>
          <div class="my-2 d-flex justify-content-between align-items-end flex-sm-wrap">
              <p class="text-secondary order-sm-2 order-lg-1 order-xl-1 order-xxl-1 mt-sm-2" style="font-size:.9em;">Belum punya akun ?<a href="/user/daftar" class="text-secondary fw-semibold text-decoration-none"> daftar disini.</a></p>
              <button type="submit" class="btn btn-outline-success px-5 fw-bold order-sm-1 order-lg-2 order-xl-2 order-xxl-2 flex-sm-fill">Login</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>