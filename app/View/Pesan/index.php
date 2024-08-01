<div class="col-md-9 col-sm-12 col-xs-12 border">
    <div class="container my-3">
    <h2 class="mb-3 text-capitalize">Data Pesan.</h2>
    <a href="/pesan/add" class="btn btn-outline-success btn-sm mb-3 rounded rounded-pill fw-semibold">tambah</a>
    <div class="border rounded-3 p-3">
        <table class="table table-hover table-responsive">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Judul</th>
                <th scope="col">Pesan</th>
                <th scope="col">Added at</th>
                <th scope="col">Act</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php $i = 1; foreach($model['messages'] as $messages) : ?>
                <tr>
                <th scope="row"><?= $i ?></th>
                <td><?= $messages['id'] ?></td>
                <td><?= $messages['judul'] ?></td>
                <td><?= $messages['pesan'] ?></td>
                <td><?= $messages['created_at'] ?></td>
                <td class="text-center">
                    <a href="/pesan/edit/<?= $messages['id'] ?>" class="btn btn-sm btn-outline-warning rounded rounded-pill px-md-3">edit</a>
                    <a href="/pesan/hapus/<?= $messages['id'] ?>" class="btn btn-sm btn-outline-danger rounded rounded-pill px-md-2" onclick="confirm('apa kau yakin ?')">hapus</a>
                </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>   
    </div>
</div>