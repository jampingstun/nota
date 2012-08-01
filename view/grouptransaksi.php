        <div class="span9">
            <div class="well" style="background-color: white;">
                <div class="page-header">
                    <h3>Form Tambah Group Transaksi <br/><small> Masukkan Data Identitas Group Transaksi</small></h3>
                </div>
                <br/>
                <form class="form-horizontal" method="POST" style="padding-right:0%;">
                <div class="page-header">
                    <h3>Identitas Group</h3>
                </div>
            <div class="accordion" id="accordion1">
            <div class="accordion-group">
              <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion1" href="#collapse1" style="background-color:whitesmoke;">
                  Masukkan Data
                </a>
              </div>
              <div id="collapse1" class="accordion-body collapse in">
                <div class="accordion-inner">
                    <div class="control-group">
                    <label class="control-label">Nama Group</label>
                    <div class="controls">
                    <input type="text" class="input-large" name="f[namagroup]" value="<?php echo $f[nik];?>">
                    </div>
                    </div>

                    <div class="control-group">
                    <label class="control-label">Status Group</label>
                    <div class="controls">
                    <label class="checkbox">
                    <input type="checkbox" name="f[status]" value="<?php echo $f[status];?>"> Tidak Aktif
                    </div>
                    </div>
                    </div>
            
                </div>          
                </div>
            </div>
          
             <br/>
             <br/>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" name="simpan" value="simpan"/>
                    <a onclick="history.go(-1)" class="btn">Batal</a>
            </div>
             </form>
            </div>
            </div>
<!--        </div>
    </div>-->
