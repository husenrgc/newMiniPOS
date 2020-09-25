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
    <?php if ($validation->hasError('name')) : ?>
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fas fa-ban"></i><?= $validation->getError('name'); ?>
      </div>
    <?php endif; ?>
    <div class="card">
      <div class="card-header">
        <h3 class="card-title"><a href="javascript:;" class="btn btn-block btn-primary btn-sm" data-toggle="modal" data-target="#modal-form"><i class="fas fa-plus"></i> Tambah Level Baru</a></h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Level</th>
              <th>Deskripsi</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $x = 1;
            foreach ($levels as $lvl) : ?>
              <tr>
                <td><?= $x; ?></td>
                <td><?= $lvl->name; ?></td>
                <td><?= $lvl->description; ?></td>
                <td><?= $lvl->id; ?></td>
              </tr>
            <?php $x++;
            endforeach; ?>
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
      <form action="<?= base_url(); ?>/users/addUserLevel" method="POST">
        <?= csrf_field(); ?>
        <div class="modal-header">
          <h4 class="modal-title">Tambah Level User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Level</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="i.e. Admin / Kasir / Gudang" required>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control" rows="3" placeholder="(Opsional)"></textarea>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
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
</script>
<?= $this->endSection() ?>