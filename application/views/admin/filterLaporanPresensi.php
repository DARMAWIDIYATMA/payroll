<div class="container-fluid">

    <div class="card mx-auto" style="width: 35%">
        <div class="card-header bg-primary text-white text-center">
            Filter Laporan Presensi Pegawai
        </div>

    <form>

        <div class="card-body">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Bulan</label>
                <div class="col-sm-9">
                    <select class="form-control" name="bulan">
                        <option value="">--Pilih Bulan--</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select> 
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Tahun</label>
                <div class="col-sm-9">
                    <select class="form-control" name="tahun">
                        <option value="">--Pilih Tahun--</option>
                        <?php $tahun = date('Y');
                        for($i=2022;$i<$tahun+5;$i++) {?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                    </select> 
                </div>
            </div>

            <?php if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun'])&& $_GET['tahun']!='')){
                $bulan = $_GET['bulan'];
                $tahun = $_GET['tahun'];
                $bulantahun = $bulan.$tahun;
            }else{
                $bulan = date('m');
                $tahun = date('Y');
                $bulantahun = $bulan.$tahun;
            }?>


        <button style="width:100%" type="submit" class="btn btn-primary mb-2 ml-auto"></i>Konfirmasi Bulan dan Tahun</button><br>
                <?php if(count($presensi) > 0){?>
                    <a style="width:100%" href="<?php echo base_url('admin/laporanPresensi/cetakLaporanPresensi?bulan='.$bulan),'&tahun='.$tahun?>" class="btn btn-success"><i class="fas fa-print"></i> Cetak Laporan Presensi Pegawai </a>
                <?php }else{ ?>
                    <button style="width:100%" type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        <i class="fas fa-print"></i> Cetak Laporan Presensi Pegawai
                    </button>
                <?php } ?>
        </div>
    </div>
    </form>
</div>




