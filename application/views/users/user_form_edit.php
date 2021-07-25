<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Edit User</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Edit User</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('users/update')?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="userid" value="<?=$this->input->post('userid') ?? $row->userid ?>"></input>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fullname">Nama Lengkap</label>
                                    <input class="form-control" name="fullname" value="<?=$this->input->post('fullname') ?? $row->fullname ?>" id="fullname" type="text" placeholder="Full name..">
                                    <label class="invalid-text" for="fullname"><?php echo form_error('fullname'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email">Nama Lengkap</label>
                                    <input class="form-control" name="email" value="<?=$this->input->post('email') ?? $row->email ?>" id="email" type="email" placeholder="Full name..">
                                    <label class="invalid-text" for="email"><?php echo form_error('email'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="level">Role</label>
                                    <select class="form-control" id="level" name="level" required>
                                        <option value="">- Pilih Kategori -</option>
                                        <?php $level = $this->input->post('level') ? $this->input->post('level') : $row->level ?>

                                        <option value="1" <?php echo $level == 1 ? 'selected' : null ?> >Admin</option>
                                        <option value="2" <?php echo $level == 2 ? 'selected' : null ?>>Pelanggan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input class="form-control" name="username" value="<?=$this->input->post('username') ?? $row->username ?>" id="username" type="text" placeholder="Price..">
                                    <label class="invalid-text" for="username"><?php echo form_error('username'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nohp">No.HP</label>
                                    <input class="form-control" name="nohp" value="<?=$this->input->post('nohp') ?? $row->nohp ?>" id="nohp" type="number" placeholder="0812xxx..">
                                    <label class="invalid-text" for="nohp"><?php echo form_error('nohp'); ?></label>
                                </div>     
                            </div>
                        </div>

                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="password">Password (kosongkan jika tidak ingin ganti)</label>
                                    <input class="form-control" name="password" value="<?=$this->input->post('password') ?>" id="password" type="password" placeholder="Password">
                                    <label class="invalid-text" for="password"><?php echo form_error('password'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="passconf">Password Confirmation</label>
                                    <input class="form-control" name="passconf" value="<?=$this->input->post('passconf') ?>" id="passconf" type="password" placeholder="Password Confirmation">
                                    <label class="invalid-text" for="passconf"><?php echo form_error('passconf'); ?></label>
                                </div>     
                            </div>
                        </div>
                        

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <!-- <label for="foto">Foto</label> -->
                                    <div class="input-group">
                                        <div class="custom-file">
                                        <input type="file" name="image" class="btn-primary custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Pilih Foto</label>
                                        </div>
                                    </div>
                                        <?php if($row->image != null) { ?>
                                            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 2 MB</div>
                                            <label for="">Current Image:</label>
                                            <div class="text-left" >
                                                <img  width="80" height="80" src="<?=base_url('uploads/users/'.$row->image)?>" class="rounded" alt="...">
                                            </div>
                                        <?php } ?> 
                                    
                                </div>
                                
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button name="submit" class="btn btn-submit btn-primary btn-user btn-block">
                                        Simpan
                                    </button>
                                </div>                                
                            </div>
                        </div>
                                
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>