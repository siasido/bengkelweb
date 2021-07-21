 <!-- Page Heading -->
 <h1 class="h3 mb-2 text-gray-800">Users Account</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>No.HP</th>
                        <th>Image</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $value) { ?>
                    <tr>
                        <td><?=$value->fullname?></td>
                        <td><?=$value->username?></td>
                        <td><?=$value->nohp?></td>
                        <td><img width="80" height="80" src="<?=base_url('uploads/users/'.$value->image)?>"></td>
                        <td><?php echo $value->level == 1 ? 'Admin' : 'Customer' ?></td>
                        <td>
                            <a href="<?=site_url('users/edit/'.$value->userid)?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                            </a>
                            <a onclick="return confirm('apakah anda yakin ingin menghapus data?')" href="<?=site_url('users/delete/'.$value->userid)?>" class="btn btn-danger btn-sm">
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