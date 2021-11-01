<?php include('../src/pages/adminhelper/header.php'); ?>
<?php include('../src/pages/adminhelper/sidebar.php'); ?>
<div id="main">
    <div class="card">
        <div class="card-content">
            <form class="form form-vertical" method="post" action="/user-management/store" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <a href="/user-management" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i></a>
                        </div>
                        <div class="col">
                            <h4 class="card-title">Form Tambah Akun User</h4>
                            <p style="font-size: 13px;">Data Akun</p>
                        </div>
                    </div>
                    <div style="background-color: #589cd1;height: 2px;margin-bottom: 20px;"></div>


                    <div class="form-body">

                        <!-- Data Pemohon -->
                        <h5>Data Akun User</h5>
                        <div class="row">
                            <div class="col">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Role User</label>
                                            <select name="idRole" id="" class="form-select" required>
                                                <option value="">-- Pilih Role --</option>
                                                <?php foreach ($roles as $key => $role) { ?>
                                                <option value="<?= $role['idRole'] ?>"><?= $role['namaRole'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">NIK User</label>
                                            <input type="text" class="form-control" name="nikUser">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Nama User</label>
                                            <input type="text" class="form-control" name="namaUser" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body border border-1 rounded">
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Username</label>
                                            <input type="text" class="form-control" name="username" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Password</label>
                                            <input type="password" class="form-control" name="password" id="password" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Konfirmasi Password</label>
                                            <input type="password" class="form-control" name="konfirmasiPassowrd" id="confirm_password" required>
                                            <span id='message'></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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

<script>
    $('#password, #confirm_password').on('keyup', function() {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').html('Password Matching').css('color', 'green');
        } else
            $('#message').html('Password Not Matching').css('color', 'red');
    });
</script>

<script src="/assets/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<script src="/assets/js/BsMultiSelect.min.js"></script>


</body>

</html>