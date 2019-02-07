            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Permintaan Pengembalian</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-lg-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="text-right">
                      <div class="pull-left panel-title">Permintaan Pengembalian Barang</div>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                  <!-- /.panel-heading -->
                  <div class="panel-body">
                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                      <thead>
                        <tr>
                          <th>ID Pinjam</th>
                          <th>Nama Peminjam</th>
                          <th>Nama Barang</th>
                          <th>Jumlah Pinjam</th>
                          <th>Tanggal Pinjam</th>
                          <th>Tanggal Kembali</th>
                          <th>Setujui</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($data as $d1) { ?>
                        <tr>
                          <td><?php echo $d1->id_pinjam ?></td>
                          <td><?php echo $d1->name_peminjam ?></td>
                          <td><?php echo $d1->name_barang ?></td>
                          <td><?php echo $d1->jml ?></td>
                          <td><?php echo $d1->tgl_pinjam ?></td>
                          <td><?php echo $d1->tgl_kembali ?></td>
                          <td class="text-center">
                            <form action="<?php echo base_url('admin_system/kembali_setujui') ?>" method="post">
                              <input type="hidden" name="id_pinjam" value="<?php echo $d1->id_pinjam ?>">
                              <input type="hidden" name="id_peminjam" value="<?php echo $d1->id_peminjam ?>">
                              <input type="hidden" name="id_barang" value="<?php echo $d1->id_barang ?>">
                              <input type="hidden" name="jml" value="<?php echo $d1->jml ?>">
                              <input type="hidden" name="tgl_pinjam" value="<?php echo $d1->tgl_pinjam ?>">
                              <input type="hidden" name="tgl_kembali" value="<?php echo $d1->tgl_kembali ?>">
										          <input type="hidden" name="status" value="1">
										          <button class="btn btn-success btn-xs btn-edit" type="submit" data-original-title="Ubah" data-placement="top" data-toggle="tooltip"><i class="fa fa-check"></i> Setujui</button>
								 	          </form>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
              </div>
              <!-- /.col-lg-12 -->
            </div>
