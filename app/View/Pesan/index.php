<?php 

// echo "hello Group Telegram" . "<br>";

// var_dump($model['groups']);
?>

<div class="container-fluid border border-2 p-2 mt-3">
    <header class="navbar navbar-dark p-2 border">
        <h3>header section </h3>
    </header>
    <div class="container-fluid border">
        <div class="row border">
            <sidebar class="sidebar col-md-3 col-sm-12 col-xs-12 border">
                <ul>
                    <li><a href="/">Dashboard</a></li>
                    <li><a href="/group">Group Telegram</a></li>
                    <li><a href="/pesan">Template Pesan</a></li>
                    <li><a href="/broadcast-pesan">Broadcast Pesan</a></li>
                    <li><a class="btn btn-danger" href="/logout">Logout</a></li>
                </ul>
            </sidebar>
            <div class="col-md-9 col-sm-12 col-xs-12 border">
                <div class="container my-3">
                <h2 class="mb-3 text-capitalize">Data Pesan.</h2>
                <a href="/pesan/add" class="btn btn-success mb-3 rounded rounded-pill fw-semibold">tambah</a>
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
                                <a href="/pesan/edit/<?= $messages['id'] ?>" class="btn btn-sm btn-outline-warning rounded rounded-pill px-md-3 mb-sm-2">edit</a>
                                <a href="/pesan/hapus/<?= $messages['id'] ?>" class="btn btn-sm btn-outline-danger rounded rounded-pill px-md-2" onclick="confirm('apa kau yakin ?')">hapus</a>
                            </td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>   
                </div>
            </div>
        </div>
    </div>
    <footer class="border">
        <h3>Designed By : irfanEm</h3>
    </footer>
</div>