<div class="container-fluid p-2 border border-2 border-danger" style="height: 100vh;">
    <header class="mb-2 border">
        <nav class="navbar navbar-expand-lg bg-dark border-bottom navbar-dark">
          <div class="container">
            <a class="navbar-brand" href="#">
              <!-- <img src="/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> -->
              Tele_blasT <span class="fw-bold">XML</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
              <ul class="navbar-nav me-auto my-2 my-lg-0" style="--bs-scroll-height: 100px;">
                <li class="nav-item"><a class="nav-link fw-semibold active" href="/">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/group">Group Telegram</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/pesan">Template Pesan</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="/broadcast-pesan">Broadcast Pesan</a></li>
              </ul>
              <form class="d-flex border-sm-top" role="search">
                <a class="btn btn-outline-light rounded-pill px-3 fw-bold" href="/logout">Keluar</a>
              </form>
            </div>
          </div>
        </nav>
    </header>
    <div class="container mb-2">
        <div class="row ">
            <div class="col-md-12 col-sm-12 col-xs-12 ">
                <div class="container my-3">
                <h2 class="mb-3 text-capitalize">Data Pesan.</h2>
                <a href="/pesan/add" class="btn btn-outline-dark mb-3 rounded rounded-pill fw-semibold">tambah</a>
                <div class="border rounded-3 p-3">
                    <table class="table table-hover table-responsive">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">First</th>
                          <th scope="col">Last</th>
                          <th scope="col">Handle</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">1</th>
                          <td>Mark</td>
                          <td>Otto</td>
                          <td>@mdo</td>
                        </tr>
                        <tr>
                          <th scope="row">2</th>
                          <td>Jacob</td>
                          <td>Thornton</td>
                          <td>@fat</td>
                        </tr>
                        <tr>
                          <th scope="row">3</th>
                          <td colspan="2">Larry the Bird</td>
                          <td>@twitter</td>
                        </tr>
                      </tbody>
                    </table>
                </div>   
                </div>
            </div>
        </div>
    </div>
    <div class="container fixed-bottom">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
          </a>
          <span class="mb-3 mb-md-0 text-body-secondary">© 2024 IrfanEm</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
        </ul>
      </footer>
    </div>
</div>


