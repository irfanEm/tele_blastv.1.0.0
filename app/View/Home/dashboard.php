<div class="container-fluid border border-2 p-2 mt-3">
    <header class="navbar navbar-dark p-2 border">
        <h3>header section <?= $model['user']['name'] ?></h3>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
            <a class="nav-link px-3 text-dark" href="/logout">Sign out</a>
            </div>
        </div>
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
            <div class="col-md-9 col-sm12 col-xs-12 border">
                <p>bagian content</p>
            </div>
        </div>
    </div>
    <footer class="border">
        <h3>Designed By : irfanEm</h3>
    </footer>
</div>