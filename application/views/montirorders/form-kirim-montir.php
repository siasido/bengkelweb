<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Booking Montir</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="collapseCardExample">
                <h6 class="m-0 font-weight-bold text-primary">Kirim Montir</h6>
            </a>
            <!-- Card Content - Collapse -->
            <div>
                <div class="card-body">
                    <form action="<?php echo site_url('jasamontir/postsendmontir')?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?=$data->orderid?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="montir">Montir</label>
                                    <select class="form-control" id="montir" name="idmontir" required>
                                        <option value="-">- Pilih Montir -</option>
                                        <?php foreach ($data_montir as $key => $value) {?> 
                                            <option value="<?=$value->idmontir?>" <?php echo $this->input->post('idmontir') == $value->idmontir ? 'selected' : null ?>><?=$value->namamontir.' - ' .$value->nohp?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <button name="submit" type="submit" class="btn btn-submit btn-primary btn-user btn-block">
                                    Send
                                </button>
                            </div>
                        </div>
                                
                    
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>