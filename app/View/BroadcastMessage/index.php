<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="container my-3">
    <h2 class="mb-5 text-capitalize border-bottom border-dark py-2">Data Broadcast Message.</h2>
    <a href="/pesan-siaran/tambah" class="btn btn-outline-dark mb-4 rounded rounded-pill fw-semibold">tambah</a>
    <div class="border rounded-3 p-3">
        <table class="table table-hover table-borderless table-responsive">
            <thead class="border-bottom border-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Pesan</th>
                <th scope="col">Group</th>
                <th scope="col">Waktu</th>
                <th scope="col">Status</th>
                <th scope="col">Added at</th>
                <th scope="col">Act</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php $i = 1; foreach($model['broadcastMessages'] as $broadcastMessages) : ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $broadcastMessages['id'] ?></td>
                    <td><?= $broadcastMessages['id_pesan'] ?></td>
                    <td><?= $broadcastMessages['id_group'] ?></td>
                    <td><?= $broadcastMessages['waktu'] ?></td>
                    <td><?= $broadcastMessages['status'] ?></td>
                    <td><?= $broadcastMessages['created_at'] ?></td>
                    <td>
                        <a href="/pesan-siaran/edit/<?= $broadcastMessages['id'] ?>" class="btn btn-sm btn-warning rounded rounded-pill px-md-3 mb-lg-0 mb-sm-2">edit</a>
                        <a href="/pesan-siaran/hapus/<?= $broadcastMessages['id'] ?>" class="btn btn-sm btn-danger rounded rounded-pill px-md-2" onclick="confirm('apa kau yakin ?')">hapus</a>
                    </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>   
    </div>
</div>