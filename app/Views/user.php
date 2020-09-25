<?= $this->extend('baseview') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<style>
  #example1 tbody tr td:first-child,
  #example1 tbody tr td:last-child {
    text-align: center;
  }
</style>
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
        <h3 class="card-title"><a href="javascript:;" class="btn btn-block btn-primary btn-sm bt-add" data-toggle="modal" data-target="#modal-form"><i class="fas fa-plus"></i> Tambah User Baru</a></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Nama User</th>
              <th>Level User</th>
              <th>Terakhir Akses</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $n = 1;
            foreach ($users as $usr) : ?>
              <tr>
                <td><?= $n++; ?></td>
                <td><?= $usr->username; ?></td>
                <td><?= $usr->name; ?></td>
                <td><?= $usr->nameLvl; ?></td>
                <td><?= $usr->lastaccess; ?></td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-info bt-edit" title="Ubah Data" data-toggle="modal" data-target="#modal-form" data-id="<?= $usr->id; ?>"><i class="fas fa-edit"></i></button>
                    <button type="button" class="btn btn-sm btn-danger bt-del" title="Hapus Data" data-toggle="modal" data-target="#modal-delete" data-id="<?= $usr->id; ?>" data-name="<?= $usr->name; ?>"><i class="fas fa-trash-alt"></i></button>
                  </div>
                </td>
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
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<!--------------------------------------------- MODAL VIEW --------------------------------------------->
<div class="modal fade" id="modal-form">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url(); ?>/users/addUser" id="writeForm" method="POST">
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
                <input type="password" name="password" id="password" class="form-control" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Level</label>
                <select class="form-control" name="level" id="level" required>
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
                <input type="text" name="name" id="name" class="form-control" required>
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

<div class="modal fade" id="modal-delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?= base_url(); ?>/users/delUser" id="delForm" method="POST">
        <?= csrf_field(); ?>
        <div class="modal-header">
          <h4 class="modal-title">Hapus User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="delId" name="id">
          Apakah anda yakin ingin menghapus user <b id="delName"></b>?
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
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
<script src="<?= base_url(); ?>/public/assets/module/user.min.js"></script>
<?= $this->endSection() ?>