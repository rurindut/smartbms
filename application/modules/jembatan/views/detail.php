<script>
    submitform = function(){
		document.getElementById("form1").submit();
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
    function save_opsi(kategori,id_jembatan,element,event){
        var selectElement = event.target;
        var value = selectElement.value;
        $.ajax({
            url:'<?=base_url()?>jembatan/view/save_opsi',
            method: 'post',
            data: {id_jembatan: id_jembatan,element:element,value:value,kategori:kategori},
            dataType: 'json',
            success: function(response){
                
                $('td.skor_struktural').html(response.skor_struktural);
                $('td.skor_fungsional').html(response.skor_fungsional);
                $('td.skor_nonteknis').html(response.skor_nonteknis);
                $('td.skor_total').html(response.skor_total);
                $('td.penanganan').html(response.penanganan);

                var biaya_ganti = (response.biaya_ganti) ? new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(response.biaya_ganti) : '';
                var biaya_rehab = (response.biaya_rehab) ? new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(response.biaya_rehab) : '';
                // $('td.biaya_ganti').html(biaya_ganti);
                // $('td.biaya_rehab').html(biaya_rehab);

                var pemeliharaan = response.pemeliharaan;
                var kerusakan1 = (pemeliharaan.length > 0) ? pemeliharaan[0][0].toFixed(3) : '';
                var kerusakan2 = (pemeliharaan.length > 0) ? pemeliharaan[0][1].toFixed(3) : '';
                var kerusakan3 = (pemeliharaan.length > 0) ? pemeliharaan[0][2].toFixed(3) : '';
                var kerusakan4 = (pemeliharaan.length > 0) ? pemeliharaan[0][3].toFixed(3) : '';
                var kerusakan5 = (pemeliharaan.length > 0) ? pemeliharaan[0][4].toFixed(3) : '';
                var biaya1 = (pemeliharaan.length > 0) ? new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(pemeliharaan[1][0]) : '';
                var biaya2 = (pemeliharaan.length > 0) ? new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(pemeliharaan[1][1]) : '';
                var biaya3 = (pemeliharaan.length > 0) ? new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(pemeliharaan[1][2]) : '';
                var biaya4 = (pemeliharaan.length > 0) ? new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(pemeliharaan[1][3]) : '';
                var biaya5 = (pemeliharaan.length > 0) ? new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR" }).format(pemeliharaan[1][4]) : '';

                // $('td.kerusakan1').html(kerusakan1);
                // $('td.kerusakan2').html(kerusakan1);
                // $('td.kerusakan3').html(kerusakan1);
                // $('td.kerusakan4').html(kerusakan1);
                // $('td.kerusakan5').html(kerusakan1);

                // $('td.biaya1').html(biaya1);
                // $('td.biaya2').html(biaya2);
                // $('td.biaya3').html(biaya3);
                // $('td.biaya4').html(biaya4);
                // $('td.biaya5').html(biaya5);

            }
        });
    };

    function save_opsi_baru(elemen,id_jembatan,id_bobot,kolom){
        $.ajax({
            url:'<?=base_url()?>jembatan/view/save_opsi_baru',
            method: 'post',
            data: {id_jembatan: id_jembatan,id_bobot:id_bobot,kolom:kolom, value:elemen.value},
            dataType: 'json',
            success: function(response){
                console.log(response);
                $('td#totalnoservice').html(response.nilai_akhir.tanpa_pemeliharaan);
                $('td#totalminorrehab').html(response.nilai_akhir.pemeliharaan_rutin);
                $('td#totalmayorrehab').html(response.nilai_akhir.rehabilitasi);
                $('td#totalreplace').html(response.nilai_akhir.penggantian);
                $('div.result').html(response.hasil_penilaian);
            }
        });
    }
</script>
<style type="text/css">
    table#tabel_pemeliharaan th {
        text-align: center;
    }
</style>

<div class="col-lg-12">
<div class="card">
    <div class="card-header">
        <p class="text-muted m-b-15">
        <?= $general['nama'] . ' - ' . $general['ruas'] ?>
        </p>
    </div>
    <div class="card-body">						
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Data Umum</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="struktural-tab" data-toggle="tab" href="#struktural" role="tab" aria-controls="struktural" aria-selected="false">Struktural</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="fungsional-tab" data-toggle="tab" href="#fungsional" role="tab" aria-controls="fungsional" aria-selected="false">Fungsional</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nonteknis-tab" data-toggle="tab" href="#nonteknis" role="tab" aria-controls="nonteknis" aria-selected="false">Non-Teknis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="skorprioritas-tab" data-toggle="tab" href="#skorprioritas" role="tab" aria-controls="skorprioritas" aria-selected="false">Skor Prioritas Jembatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="kategoripenanganan-tab" data-toggle="tab" href="#kategoripenanganan" role="tab" aria-controls="kategoripenanganan" aria-selected="false">Kategori Penanganan</a>
                </li>
            </ul>
            <div class="tab-content pl-3 p-1" id="myTabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <form action="<?php echo $action_url;?>" method="post" class="form-horizontal" id="form1">
                    <input type="hidden" id="id_jembatan" name="id_jembatan" value="<?php echo $general['id'];?>">
                    <h3>Data umum</h3>
                    <p></p>
                    <div class="col-lg-6">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th scope="row">Nama Jembatan</th>
                            <td>
                            <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $general['nama'];?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Propinsi</th>
                            <td>
                                <input type="text" id="propinsi" name="propinsi" class="form-control" value="<?= $general['propinsi'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Kabupaten</th>
                            <td>
                                <input type="text" id="kabupaten" name="kabupaten" class="form-control" value="<?= $general['kabupaten'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Ruas</th>
                            <td>
                                <input type="text" id="ruas" name="ruas" class="form-control" value="<?= $general['ruas'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Panjang</th>
                            <td>
                                <input type="text" id="panjang" name="panjang" class="form-control" value="<?= $general['panjang'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Bentang</th>
                            <td>
                                <input type="text" id="jml_bentang" name="jml_bentang" class="form-control" value="<?= $general['jml_bentang'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Lebar</th>
                            <td>
                                <input type="text" id="lebar" name="lebar" class="form-control" value="<?= $general['lebar'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Lebar Jalan</th>
                            <td>
                                <input type="text" id="lebar_jalan" name="lebar_jalan" class="form-control" value="<?= $general['lebar_jalan'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tipe Bangunan Atas</th>
                            <td>
                                <input type="text" id="tipe_bangunan_atas" name="tipe_bangunan_atas" class="form-control" value="<?= $general['tipe_bangunan_atas'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tahun Pembuatan</th>
                            <td>
                                <input type="text" id="thn_pembuatan" name="thn_pembuatan" class="form-control" value="<?= $general['thn_pembuatan'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tahun Survey</th>
                            <td>
                                <input type="text" id="thn_survey" name="thn_survey" class="form-control" value="<?= $general['thn_survey'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Kode Kerusakan</th>
                            <td>
                                <input type="text" id="kode_kerusakan" name="kode_kerusakan" class="form-control" value="<?= $general['kode_kerusakan'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Volume</th>
                            <td>
                                <input type="text" id="volume" name="volume" class="form-control" value="<?= $general['volume'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">UDC</th>
                            <td>
                                <input type="text" id="udc" name="udc" class="form-control" value="<?= $general['udc'] ?>">
                            </td>
                        </tr>
                        <tr>
                            <th colspan="2">
                            <button type="submit" class="btn btn-primary btn-sm" onclick="submitform()">
                                <i class="fa fa-dot-circle-o"></i> Ubah Data 
                            </button>
                            </th>
                        </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="struktural" role="tabpanel" aria-labelledby="struktural-tab">
                    <h3>Struktural</h3>
                    <p></p>
                    <div class="col-lg-6">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Nilai Kriteria</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <!-- aliran_sungai,bangunan_pengaman,tanah_timbunan,pondasi,kepala_jembatan, -->
                            <th scope="row">Aliran Sungai</th>
                            <td>
                                <select class="form-control" name="aliran_sungai" id="aliran_sungai" onchange="save_opsi('struktural','<?= $general['id'] ?>','aliran_sungai',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['aliran_sungai']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Bangunan Pengaman</th>
                            <td>
                                <select class="form-control" name="bangunan_pengaman" id="bangunan_pengaman" onchange="save_opsi('struktural','<?= $general['id'] ?>','bangunan_pengaman',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['bangunan_pengaman']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tanah Timbunan</th>
                            <td>
                                <select class="form-control" name="tanah_timbunan" id="tanah_timbunan" onchange="save_opsi('struktural','<?= $general['id'] ?>','tanah_timbunan',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['tanah_timbunan']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Pondasi</th>
                            <td>
                                <select class="form-control" name="pondasi" id="pondasi" onchange="save_opsi('struktural','<?= $general['id'] ?>','pondasi',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['pondasi']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Kepala Jembatan</th>
                            <td>
                                <select class="form-control" name="kepala_jembatan" id="kepala_jembatan" onchange="save_opsi('struktural','<?= $general['id'] ?>','kepala_jembatan',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['kepala_jembatan']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <!-- sistem_gelagar,jembatan_pelat,pelengkung,balok_pelengkung,rangka, -->
                        <tr>
                            <th scope="row">Sistem Gelagar</th>
                            <td>
                                <select class="form-control" name="sistem_gelagar" id="sistem_gelagar" onchange="save_opsi('struktural','<?= $general['id'] ?>','sistem_gelagar',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['sistem_gelagar']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Jembatan Pelat</th>
                            <td>
                                <select class="form-control" name="jembatan_pelat" id="jembatan_pelat" onchange="save_opsi('struktural','<?= $general['id'] ?>','jembatan_pelat',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['jembatan_pelat']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Pelengkung</th>
                            <td>
                                <select class="form-control" name="pelengkung" id="pelengkung" onchange="save_opsi('struktural','<?= $general['id'] ?>','pelengkung',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['pelengkung']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Balok Pelengkung</th>
                            <td>
                                <select class="form-control" name="balok_pelengkung" id="balok_pelengkung" onchange="save_opsi('struktural','<?= $general['id'] ?>','balok_pelengkung',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['balok_pelengkung']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Rangka</th>
                            <td>
                                <select class="form-control" name="rangka" id="rangka" onchange="save_opsi('struktural','<?= $general['id'] ?>','rangka',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['rangka']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <!-- sistem_gantung,sistem_lantai,expansion_joint,landasan,sandaran, -->
                        <tr>
                            <th scope="row">Sistem Gantung</th>
                            <td>
                                <select class="form-control" name="sistem_gantung" id="sistem_gantung" onchange="save_opsi('struktural','<?= $general['id'] ?>','sistem_gantung',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['sistem_gantung']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Sistem Lantai</th>
                            <td>
                                <select class="form-control" name="sistem_lantai" id="sistem_lantai" onchange="save_opsi('struktural','<?= $general['id'] ?>','sistem_lantai',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['sistem_lantai']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Expansion Joint</th>
                            <td>
                                <select class="form-control" name="expansion_joint" id="expansion_joint" onchange="save_opsi('struktural','<?= $general['id'] ?>','expansion_joint',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['expansion_joint']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Landasan</th>
                            <td>
                                <select class="form-control" name="landasan" id="landasan" onchange="save_opsi('struktural','<?= $general['id'] ?>','landasan',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['landasan']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Sandaran</th>
                            <td>
                                <select class="form-control" name="sandaran" id="sandaran" onchange="save_opsi('struktural','<?= $general['id'] ?>','sandaran',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['sandaran']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <!-- perlengkapan,gorong,lintasan,umur,lingkungan,beban,bencana_alam -->
                        <tr>
                            <th scope="row">Perlengkapan</th>
                            <td>
                                <select class="form-control" name="perlengkapan" id="perlengkapan" onchange="save_opsi('struktural','<?= $general['id'] ?>','perlengkapan',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['perlengkapan']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Gorong-gorong</th>
                            <td>
                                <select class="form-control" name="gorong" id="gorong" onchange="save_opsi('struktural','<?= $general['id'] ?>','gorong',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['gorong']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Lintasan</th>
                            <td>
                                <select class="form-control" name="lintasan" id="lintasan" onchange="save_opsi('struktural','<?= $general['id'] ?>','lintasan',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($nk_options as $key => $value) {
                                        if($value['bobot'] == $struktural['lintasan']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Umur</th>
                            <td>
                                <select class="form-control" name="umur" id="umur" onchange="save_opsi('struktural','<?= $general['id'] ?>','umur',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($umur_options as $key => $value) {
                                        if($value['bobot'] == $struktural['umur']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Lingkungan</th>
                            <td>
                                <select class="form-control" name="lingkungan" id="lingkungan" onchange="save_opsi('struktural','<?= $general['id'] ?>','lingkungan',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($lingkungan_options as $key => $value) {
                                        if($value['bobot'] == $struktural['lingkungan']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Beban</th>
                            <td>
                                <select class="form-control" name="beban" id="beban" onchange="save_opsi('struktural','<?= $general['id'] ?>','beban',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($beban_options as $key => $value) {
                                        if($value['bobot'] == $struktural['beban']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Bencana Alam</th>
                            <td>
                                <select class="form-control" name="bencana_alam" id="bencana_alam" onchange="save_opsi('struktural','<?= $general['id'] ?>','bencana_alam',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($bencana_options as $key => $value) {
                                        if($value['bobot'] == $struktural['bencana_alam']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr><th>Skor Prioritas Struktural</th><td class="skor_struktural"><?= (isset($skor_prioritas['skor_struktural']))?number_format($skor_prioritas['skor_struktural'],3):0.000 ?></td></tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="fungsional" role="tabpanel" aria-labelledby="fungsional-tab">
                    <h3>Fungsional</h3>
                    <p></p>
                    <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Nilai Kriteria</th>
                        </tr>
                        </thead>
                        <!-- LHR, Lajur, Kondisi Permukaan Aspal, Sistem Drainase -->
                        <tbody>
                        <tr>
                            <th scope="row">LHR</th>
                            <td>
                                <select class="form-control" name="lhr" id="lhr" onchange="save_opsi('fungsional','<?= $general['id'] ?>','lhr',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($lhr_options as $key => $value) {
                                        if($value['bobot'] == $fungsional['lhr']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Lajur</th>
                            <td>
                                <select class="form-control" name="lajur" id="lajur" onchange="save_opsi('fungsional','<?= $general['id'] ?>','lajur',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($lajur_options as $key => $value) {
                                        if($value['bobot'] == $fungsional['lajur']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Kondisi Permukaan Aspal</th>
                            <td>
                                <select class="form-control" name="kondisi_permukaan_aspal" id="kondisi_permukaan_aspal" onchange="save_opsi('fungsional','<?= $general['id'] ?>','kondisi_permukaan_aspal',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($aspal_options as $key => $value) {
                                        if($value['bobot'] == $fungsional['kondisi_permukaan_aspal']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Sistem Drainase</th>
                            <td>
                                <select class="form-control" name="sistem_drainase" id="sistem_drainase" onchange="save_opsi('fungsional','<?= $general['id'] ?>','sistem_drainase',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($drainase_options as $key => $value) {
                                        if($value['bobot'] == $fungsional['sistem_drainase']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr><th>Skor Prioritas Fungsional</th><td class="skor_fungsional"><?= (isset($skor_prioritas['skor_fungsional']))?number_format($skor_prioritas['skor_fungsional'],3):0.000 ?></td></tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nonteknis" role="tabpanel" aria-labelledby="nonteknis-tab">
                    <h3>Non-Teknis</h3>
                    <p></p>
                    <div class="col-lg-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Nilai Kriteria</th>
                        </tr>
                        </thead>
                        <!-- kepentingan_historis,sosial,ekonomi,politik -->
                        <tbody>
                        <tr>
                            <th scope="row">Kepentingan Historis</th>
                            <td>
                                <select class="form-control" name="kepentingan_historis" id="kepentingan_historis" onchange="save_opsi('nonteknis','<?= $general['id'] ?>','kepentingan_historis',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($historis_options as $key => $value) {
                                        if($value['bobot'] == $nonteknis['kepentingan_historis']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Sosial</th>
                            <td>
                                <select class="form-control" name="sosial" id="sosial" onchange="save_opsi('nonteknis','<?= $general['id'] ?>','sosial',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($sosial_options as $key => $value) {
                                        if($value['bobot'] == $nonteknis['sosial']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Ekonomi</th>
                            <td>
                                <select class="form-control" name="ekonomi" id="ekonomi" onchange="save_opsi('nonteknis','<?= $general['id'] ?>','ekonomi',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($ekonomi_options as $key => $value) {
                                        if($value['bobot'] == $nonteknis['ekonomi']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Politik</th>
                            <td>
                                <select class="form-control" name="politik" id="politik" onchange="save_opsi('nonteknis','<?= $general['id'] ?>','politik',event);">
                                    <option value="">-- pilih opsi --</option>
                                    <?php 
                                    foreach($politik_options as $key => $value) {
                                        if($value['bobot'] == $nonteknis['politik']) {
                                            $selected = 'selected="selected"';
                                        } else {
                                            $selected = '';
                                        }
                                    ?>
                                    <option value="<?= $value['bobot'] ?>" <?= $selected ?>><?= $value['bobot'].'. '.$value['keterangan'] ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr><th>Skor Prioritas Non Teknis</th><td class="skor_nonteknis"><?= (isset($skor_prioritas['skor_nonteknis']))?number_format($skor_prioritas['skor_nonteknis'],3):0.000 ?></td></td></tr>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="skorprioritas" role="tabpanel" aria-labelledby="skorprioritas-tab">
                    <h3>Skor Prioritas</h3>
                    <p></p>
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Skor Prioritas Struktural</th>
                                <th scope="col">Skor Prioritas Fungsional</th>
                                <th scope="col">Skor Prioritas Non-Teknis</th>
                                <th scope="col">Skor Prioritas Jembatan</th>
                                <th scope="col">Kategori Penanganan</th>
                                <!-- <th scope="col">Biaya Penggantian</th>
                                <th scope="col">Biaya Rehab</th> -->
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="skor_struktural"><?= (isset($skor_prioritas['skor_struktural']))?number_format($skor_prioritas['skor_struktural'],3):0.000 ?></td>
                                <td class="skor_fungsional"><?= (isset($skor_prioritas['skor_fungsional']))?number_format($skor_prioritas['skor_fungsional'],3):0.000 ?></td>
                                <td class="skor_nonteknis"><?= (isset($skor_prioritas['skor_nonteknis']))?number_format($skor_prioritas['skor_nonteknis'],3):0.000 ?></td>
                                <td class="skor_total"><?= (isset($skor_prioritas['skor_total']))?number_format($skor_prioritas['skor_total'],3):0.000 ?></td>
                                <td class="penanganan"><?= (isset($skor_prioritas['kategori_penanganan']))?$skor_prioritas['kategori_penanganan']:'Data tidak lengkap' ?></td>
                                <?php /*
                                <td class="biaya_ganti"><?= ($skor_prioritas['penanganan_id'] > 3) ? 'Rp '.number_format($biayaReplace,2,',','.') : '' ?></td>
                                <td class="biaya_rehab"><?= ($skor_prioritas['penanganan_id'] == 3) ? 'Rp '.number_format($biayaRehab,2,',','.') : '' ?></td>
                                */ ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <?php /*
                    <h3>Prediksi Kuantitas Kerusakan</h3>
                    <p></p>
                    <div class="col-lg-12">
                        <table class="table table-bordered" id="tabel_pemeliharaan">
                            <thead>
                            <tr>
                                <th colspan="5">Prediksi Kuantitas Kerusakan</th>
                                <th colspan="5">Prediksi Biaya Pemeliharaan</th>
                            </tr>
                            <tr>
                                <th scope="col">1</th>
                                <th scope="col">2</th>
                                <th scope="col">3</th>
                                <th scope="col">4</th>
                                <th scope="col">5</th>
                                <th scope="col">1</th>
                                <th scope="col">2</th>
                                <th scope="col">3</th>
                                <th scope="col">4</th>
                                <th scope="col">5</th>
                            </tr>
                            </thead>
                            <tbody>
                                <td class="kerusakan1"><?= (!empty($kerusakan[0]))?number_format($kerusakan[0],3):'' ?></td>
                                <td class="kerusakan2"><?= (!empty($kerusakan[1]))?number_format($kerusakan[1],3):'' ?></td>
                                <td class="kerusakan3"><?= (!empty($kerusakan[2]))?number_format($kerusakan[2],3):'' ?></td>
                                <td class="kerusakan4"><?= (!empty($kerusakan[3]))?number_format($kerusakan[3],3):'' ?></td>
                                <td class="kerusakan5"><?= (!empty($kerusakan[4]))?number_format($kerusakan[4],3):'' ?></td>
                                <td class="biaya1"><?= (!empty($biaya[0]))?'Rp '.number_format($biaya[0],2,',','.'):'' ?></td>
                                <td class="biaya2"><?= (!empty($biaya[1]))?'Rp '.number_format($biaya[1],2,',','.'):'' ?></td>
                                <td class="biaya3"><?= (!empty($biaya[2]))?'Rp '.number_format($biaya[2],2,',','.'):'' ?></td>
                                <td class="biaya4"><?= (!empty($biaya[3]))?'Rp '.number_format($biaya[3],2,',','.'):'' ?></td>
                                <td class="biaya5"><?= (!empty($biaya[4]))?'Rp '.number_format($biaya[4],2,',','.'):'' ?></td>
                            </tbody>
                        </table>
                    </div>
                    */ ?>
                </div>
                <div class="tab-pane fade" id="kategoripenanganan" role="tabpanel" aria-labelledby="kategoripenanganan-tab">
                    <h3>Kategori Penanganan</h3>
                    <p></p>
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">&nbsp;</th>
                                <th scope="col">Bobot</th>
                                <th scope="col">Tidak ada pemeliharaan</th>
                                <th scope="col">Pemeliharaan rutin</th>
                                <th scope="col">Rehabilitasi</th>
                                <th scope="col">Penggantian</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $totalTanpaPemeliharaan = 0;
                                $totalPemeliharaanRutin = 0;
                                $totalRehabilitasi = 0;
                                $totalPenggantian = 0;
                                foreach ($dataNilaiBaru as $dataNilai) {
                                ?>
                                <tr>
                                    <td><i><?= $dataNilai['nama_bobot'] ?></i></td>
                                    <td><?= $dataNilai['bobot'] ?>%</td>
                                    <td><input type="text" id="tanpa_pemeliharaan[<?= $dataNilai['id_bobot'] ?>]" name="tanpa_pemeliharaan[<?= $dataNilai['id_bobot'] ?>]" class="form-control" value="<?= $dataNilai['tanpa_pemeliharaan'] ?>" onkeyup="save_opsi_baru(this,'<?= $dataNilai['id_jembatan'] ?>','<?= $dataNilai['id_bobot'] ?>','tanpa_pemeliharaan');"></td>
                                    <td><input type="text" id="pemeliharaan_rutin[<?= $dataNilai['id_bobot'] ?>]" name="pemeliharaan_rutin[<?= $dataNilai['id_bobot'] ?>]" class="form-control" value="<?= $dataNilai['pemeliharaan_rutin'] ?>" onkeyup="save_opsi_baru(this,'<?= $dataNilai['id_jembatan'] ?>','<?= $dataNilai['id_bobot'] ?>','pemeliharaan_rutin');"></td>
                                    <td><input type="text" id="rehabilitasi[<?= $dataNilai['id_bobot'] ?>]" name="rehabilitasi[<?= $dataNilai['id_bobot'] ?>]" class="form-control" value="<?= $dataNilai['rehabilitasi'] ?>" onkeyup="save_opsi_baru(this,'<?= $dataNilai['id_jembatan'] ?>','<?= $dataNilai['id_bobot'] ?>','rehabilitasi');"></td>
                                    <td><input type="text" id="penggantian[<?= $dataNilai['id_bobot'] ?>]" name="penggantian[<?= $dataNilai['id_bobot'] ?>]" class="form-control" value="<?= $dataNilai['penggantian'] ?>" onkeyup="save_opsi_baru(this,'<?= $dataNilai['id_jembatan'] ?>','<?= $dataNilai['id_bobot'] ?>','penggantian');"></td>
                                </tr>
                                <?php
                                    $totalTanpaPemeliharaan += ($dataNilai['tanpa_pemeliharaan'] * $dataNilai['bobot']);
                                    $totalPemeliharaanRutin += ($dataNilai['pemeliharaan_rutin'] * $dataNilai['bobot']);
                                    $totalRehabilitasi += ($dataNilai['rehabilitasi'] * $dataNilai['bobot']);
                                    $totalPenggantian += ($dataNilai['penggantian'] * $dataNilai['bobot']);
                                }
                                ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td id="totalnoservice"><?= number_format($totalTanpaPemeliharaan,3)?></td>
                                <td id="totalminorrehab"><?= number_format($totalPemeliharaanRutin,3) ?></td>
                                <td id="totalmayorrehab"><?= number_format($totalRehabilitasi,3) ?></td>
                                <td id="totalreplace"><?= number_format($totalPenggantian,3) ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php 
                        $totalArray = [
                            'tanpa_pemeliharaan' => $totalTanpaPemeliharaan,
                            'pemeliharaan_rutin' => $totalPemeliharaanRutin,
                            'rehabilitasi' => $totalRehabilitasi,
                            'penggantian' => $totalPenggantian
                        ];
                        $maxs = array_keys($totalArray, max($totalArray));
                        $hasilPenilaian = (!empty($maxs)) ? str_replace('_',' ',$maxs[0]) : 'tidak ada pemeliharaan';
                    ?>
                    <div class="result">
                        <?php 
                        echo ucwords($hasilPenilaian)." adalah penanganan terbaik";
                        ?>
                    </div>
                </div>
                </form>
            </div>
    </div>
</div>
</div>

