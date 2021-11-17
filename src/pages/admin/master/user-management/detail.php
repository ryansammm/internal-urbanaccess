<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="card">
        <div class="card-content">
            <form class="form form-vertical" method="post" action="/user-management/<?= $detail['idUser'] ?>/update" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5>Data Akun User</h5>
                        </div>
                    </div>
                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>


                    <div class="form-body">

                        <!-- Data Pemohon -->

                        <div class="row">
                            <div class="col">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Role User</label>
                                            <h6><?= $datas['namaRole'] ?></h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">NIK User</label>
                                            <h6><?= $datas['nikUser'] ?></h6>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Nama User</label>
                                            <h6><?= $datas['namaUser'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Username</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Password</label>
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Konfirmasi Password</label>
                                            <input type="password" class="form-control" placeholder="Password" name="konfirmasiPassowrd">
                                        </div>
                                    </div>
                                </div>
                            </div> -->

                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <a href="/user-management" type="button" class="btn btn-secondary me-1 mb-1">CLose</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include('../src/pages/adminhelper/footer.php'); ?>
</div>
</div>

<script src="/assets/js/jquery-3.3.1.min.js"></script>
<script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>

<script src="/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="/assets/js/BsMultiSelect.min.js"></script>


</body>

</html>