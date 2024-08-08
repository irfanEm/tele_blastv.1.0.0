<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="container my-3">
    <h2 class="mb-5 text-capitalize border-bottom border-dark py-2">Data Group.</h2>
    <a href="/group/add" class="btn btn-outline-dark mb-4 rounded rounded-pill fw-semibold">tambah</a>
    <div class="border rounded-3 p-3">
        <table class="table table-hover table-borderless table-responsive">
            <thead class="border-bottom border-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Added at</th>
                <th scope="col">Act</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php $i = 1; foreach($model['groups'] as $groups) : ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $groups['id'] ?></td>
                    <td><?= $groups['nama'] ?></td>
                    <td><a href="https://t.me/<?= $groups['username'] ?>" class="text-decoration-none fw-semibold"><?= $groups['username'] ?></a></td>
                    <td><?= $groups['created_at'] ?></td>
                    <td>
                        <a href="/group/edit/<?= $groups['id'] ?>" class="btn btn-sm btn-outline-warning rounded rounded-pill px-md-3 mb-lg-0 mb-sm-2">edit</a>
                        <a href="/group/hapus/<?= $groups['id'] ?>" class="btn btn-sm btn-outline-danger rounded rounded-pill px-md-2" onclick="confirm('apa kau yakin ?')">hapus</a>
                    </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>   
    </div>
</div>