<?= $this->extend('baseview') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
  <div class="col-12">
    <?php
    if (session()->getFlashdata('msg')) {
      $msg = explode('|', session()->getFlashdata('msg'));
    ?>
      <div class="alert alert-<?= $msg[0]; ?> alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-<?= $msg[1]; ?>"></i><?= $msg[2]; ?>.
      </div>
    <?php } ?>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><a href="javascript:;" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-form"><i class="fas fa-plus"></i> Tambah User Baru</a></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Username</th>
              <th>Nama User</th>
              <th>Level User</th>
              <th>Terakhir Akses</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $usr) : ?>
              <tr>
                <td><?= $usr->username; ?></td>
                <td><?= $usr->name; ?></td>
                <td><?= $usr->nameLvl; ?></td>
                <td><?= $usr->lastaccess; ?></td>
                <td><?= $usr->id; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
</section>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!--------------------------------------------- MODAL VIEW --------------------------------------------->
<div class="modal fade" id="modal-form">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url(); ?>/users/addUser" method="POST">
      <?= csrf_field(); ?>
        <div class="modal-header">
          <h4 class="modal-title">Tambah User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="username" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level" required>
                  <option value="">Pilih Level User</option>
                  <?php foreach ($levels as $lvl) : ?>
                    <option value="<?= $lvl->id; ?>"><?= $lvl->name; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama User</label>
                <input type="text" name="name" class="form-control" required>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" id="mod-sub" disabled>Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!--------------------------------------------- END MODAL --------------------------------------------->
<script src="<?= base_url(); ?>/public/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>/public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>/public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>/public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- <script src="<?= base_url(); ?>/public/assets/module/user.js"></script> -->
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
  $('#username').on('keyup', function() {
    var usr = $(this).val();
    $.ajax({
      type: "post",
      url: "users/cekUsername",
      // penyesuain cek disini
      // https: //stackoverflow.com/questions/1368264/how-to-extract-the-hostname-portion-of-a-url-in-javascript#answer-17336519
      data: "username=" + usr,
      // dataType: "json",
      success: function(response) {
        console.log(response);
        if (response == 'OK') {
          $('#username').removeClass('is-invalid');
          $('#username').addClass('is-valid');
          $('#mod-sub').attr('disabled', false);
        } else {
          $('#username').removeClass('is-valid');
          $('#username').addClass('is-invalid');
          $('#mod-sub').attr('disabled', true);
        }
      }
    });
  });
</script>
<?= $this->endSection() ?>