<div class="col-md-9 col-sm-12 col-xs-12 border">
    <div class="container my-3">
    <h2 class="mb-3 text-capitalize">Data Broadcast Message.</h2>
    <a href="/broadcast-pesan/add" class="btn btn-success mb-3 rounded rounded-pill fw-semibold">tambah</a>
    <div class="border rounded-3 p-3">
        <table class="table table-hover table-responsive">
            <thead>
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
                    <a href="/group/edit/<?= $broadcastMessages['id'] ?>" class="btn btn-sm btn-outline-warning rounded rounded-pill px-md-3">edit</a>
                    <a href="/group/hapus/<?= $broadcastMessages['id'] ?>" class="btn btn-sm btn-outline-danger rounded rounded-pill px-md-2" onclick="confirm('apa kau yakin ?')">hapus</a>
                </td>
                </tr>
                <?php $i++; endforeach; ?>
            </tbody>
        </table>
    </div>   
    </div>
</div>