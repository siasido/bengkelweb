
<div class="row">
    <div class="col-lg-6"> <h1 class="h3 mb-4 text-gray-800">Rekening</h1> </div>
    <div class="col-lg-6 text-right"> <a class="btn btn-primary" href="<?=site_url('rekening/add')?>">Tambah Rekening</a></div>
</div>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">List Rekening</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Bank</th>
                        <th>Nomor Rekening</th>
                        <th>Nama Pemilik Akun</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $key => $value) { ?>
                    <tr>
                        <td><?=$value->namabank?></td>
                        <td><?=$value->norek?></td>
                        <td><?=$value->namaakun?></td>
                        <td class="text-center">
                            <a href="<?=site_url('rekening/edit/'.$value->id)?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return confirm('apakah anda yakin ingin menghapus data?')" href="<?=site_url('rekening/delete/'.$value->id)?>" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>