<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Booking Montir</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Booking Montir</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseCardExample">
                <div class="card-body">
                    <form action="<?php echo site_url('jasamontir/submitmyorder')?>" method="post">
                        <input type="hidden" name="userid" value="<?=$this->session->userdata('userid')?>"></input>
                        <!-- <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input class="form-control" name="nama" value="<?=$this->input->post('nama')?>" id="nama" type="text" placeholder="John Doe..">
                                    <label class="invalid-text" for="nama"><?php echo form_error('nama'); ?></label>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nohp">No.HP</label>
                                    <input class="form-control" name="nohp" value="<?=$this->input->post('nohp')?>" id="nohp" type="number" placeholder="0812xxx..">
                                    <label class="invalid-text" for="nohp"><?php echo form_error('nohp'); ?></label>
                                </div>     
                            </div>
                        </div> -->
                        <div class="row">
                            
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="orderdate">Booking Untuk Tanggal</label>
                                    <input name="orderdate" type="date" onchange="selectTanggal(event);" class="form-control" id="orderdate" min="<?php echo date("Y-m-d"); ?>" value="<?php echo set_value('orderdate');?>" required>
                                </div>     
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jam">Booking Untuk Jam :</label>
                                    <div id="dinamic-options">
                                        <select class="form-control" id="jam" name="jam" required>
                                            <option value="">- Pilih Jam -</option>
                                            
                                        </select>
                                    </div>
                                    <label class="invalid-text" for="jam"><?php echo form_error('jam'); ?></label>
                                </div>     
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="merk">Merk Motor:</label>
                                    <select class="form-control" id="merk" name="merk" required>
                                        <option value="">- Pilih Jam -</option>
                                        <?php $merk = $this->input->post('merk')?>

                                        <option value="Honda" <?php echo $merk == "Honda" ? 'selected' : null ?>>Honda</option>
                                        <option value="Yamaha" <?php echo $merk == "Yamaha" ? 'selected' : null ?>>Yamaha</option>
                                        <option value="Suzuki" <?php echo $merk == "Suzuki" ? 'selected' : null ?>>Suzuki</option>
                                        <option value="Kawasaki" <?php echo $merk == "Kawasaki" ? 'selected' : null ?>>Kawasaki</option>
                                        <option value="Bajaj" <?php echo $merk == "Bajaj" ? 'selected' : null ?>>Bajaj</option>
                                        <option value="Vespa" <?php echo $merk == "Vespa" ? 'selected' : null ?>>Vespa</option>
                                    </select>
                                </div>     
                            </div> -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="merk">Merk Motor</label>
                                    <select class="form-control" id="merk" name="idmerk" required>
                                        <option value="">- Pilih Merk -</option>
                                        <?php foreach ($motors as $key => $value) {?> 
                                            <option value="<?=$value->id?>" <?php echo $this->input->post('idmerk') == $value->id ? 'selected' : null ?>><?=$value->merk?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="type">Type Motor</label>
                                    <input class="form-control" name="type" value="<?=$this->input->post('type')?>" id="type" type="text" placeholder="Vario, Nmax, dll..">
                                    <label class="invalid-text" for="type"><?php echo form_error('type'); ?></label>
                                </div>     
                            </div>

                        </div>
                        

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="alamatlengkap">Alamat</label>
                                    <textarea class="form-control" id="alamatlengkap" name="alamatlengkap" rows="2"><?=$this->input->post('alamatlengkap') ?></textarea>
                                    <label class="invalid-text" for="nohp"><?php echo form_error('alamatlengkap'); ?></label>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="kendala">Kendala</label>
                                    <textarea class="form-control" id="kendala" name="kendala" rows="2"><?=$this->input->post('kendala') ?></textarea>
                                    <label class="invalid-text" for="nohp"><?php echo form_error('kendala'); ?></label>
                                </div> 
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="rekening">Rekening Pembayaran</label>
                                    <select class="form-control" id="rekening" name="idrekening" required>
                                        <option value="-">- Pilih Rekening -</option>
                                        <?php foreach ($datarekening as $key => $value) {?> 
                                            <option value="<?=$value->id?>" <?php echo $this->input->post('idrekening') == $value->id ? 'selected' : null ?>><?=$value->namabank.' - '.$value->norek.' ('.$value->namaakun.')'?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 offset-lg-6">
                                <div class="form-group">
                                    <button name="submit" type="submit" class="btn btn-submit btn-primary btn-user btn-block">
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

<script>
    function selectTanggal(e){
        // alert(e.target.value);
    
        var BASE_URL = "<?php echo base_url();?>";

        $.ajax({
            url: BASE_URL+ 'jasamontir/getBookedHours',
            type: 'post',
            data: {orderdate : e.target.value},
            dataType: 'json',
            success:function(response) {

            html = '<select class="form-control" id="jam" name="jam" required>' +
                    '<option value="">- Pilih Jam -</option>'

                    $.each(response.data, function(key, value) {
                        html += '<option value="'+key+'" '+(value == "booked" ? 'disabled style="color:red"' : null) +'>'+key + (value == "booked" ? ' - Booked' : ' - Available')+'</option>';             
                    });
            html += '</select>';
            console.log(html);
            $('#dinamic-options').empty();
            $('#dinamic-options').append(html);
            
            } // /success
        });
    }
</script>