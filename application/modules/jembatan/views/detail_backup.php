<script>
    submitform = function(){
		document.getElementById("form1").submit();
    }
</script>
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
    // $(document).ready(function(){
        function save_struktural(id_jembatan,element,event){
            var selectElement = event.target;
            var value = selectElement.value;
            console.log(value);
            // // var username = $(this).val();
            $.ajax({
                url:'<?=base_url()?>jembatan/view/save_struktural',
                method: 'post',
                data: {id_jembatan: id_jembatan,element:element,value:value},
                dataType: 'json',
                success: function(response){
                    console.log(response.output);
                    var len = response.length;
                    // $('#sum_skor_struktural').text('');
                    if(len > 0){
                    // //     // Read values
                    //     var uname = response.output;
                    // //     var name = response[0].name;
                    // //     var email = response[0].email;
                    //     $('#sum_skor_struktural').html(uname);
                    // //     $('#sname').text(name);
                    // //     $('#semail').text(email);
                    }
                }
            });
        };
    // });
</script>
<div class="col-lg-12">
<div class="card">
    <div class="card-header">
        <p class="text-muted m-b-15">
        <?= $general['ruas'] ?>
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
                <!-- <li class="nav-item">
                    <a class="nav-link" id="distjoin-tab" data-toggle="tab" href="#distjoin" role="tab" aria-controls="distjoin" aria-selected="false">Prediksi Biaya Pemeliharaan</a>
                </li> -->
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
                            <th scope="row">ID</th>
                            <td>
                                <span class="help-block"><?= $general['id'] ?></span>
                            </td>
                        </tr>
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
                    <?php
                        $cMin = 0;
                        $cMax = 5;
                        $naMin = 0;
                        $naMax = 2.25;
                    ?>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Kriteria</th>
                            <th scope="col">Nilai Kriteria</th>
                            <!-- <th scope="col">Nilai Utility</th>
                            <th scope="col">Normalisasi</th>
                            <th scope="col">Nilai Akhir</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <!-- aliran_sungai,bangunan_pengaman,tanah_timbunan,pondasi,kepala_jembatan, -->
                            <th scope="row">Aliran Sungai</th>
                            <td>
                                <select class="form-control" name="aliran_sungai" id="aliran_sungai" style="width:450px" onchange="save_struktural('<?= $general['id'] ?>','aliran_sungai',event);">
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
                            <?php 
                                $nilaiUtility = ( $struktural['aliran_sungai'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[0] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[0] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Bangunan Pengaman</th>
                            <td>
                                <select class="form-control" name="bangunan_pengaman" id="bangunan_pengaman">
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
                            <?php 
                                $nilaiUtility = ( $struktural['bangunan_pengaman'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[1] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[1] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Tanah Timbunan</th>
                            <td>
                                <select class="form-control" name="tanah_timbunan" id="tanah_timbunan">
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
                            <?php 
                                $nilaiUtility = ( $struktural['tanah_timbunan'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[2] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[2] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Pondasi</th>
                            <td>
                                <select class="form-control" name="pondasi" id="pondasi">
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
                            <?php 
                                $nilaiUtility = ( $struktural['pondasi'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[3] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[3] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Kepala Jembatan</th>
                            <td>
                                <select class="form-control" name="kepala_jembatan" id="kepala_jembatan">
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
                            <?php 
                                $nilaiUtility = ( $struktural['kepala_jembatan'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[4] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[4] ?></span>
                            </td> -->
                        </tr>
                        <!-- sistem_gelagar,jembatan_pelat,pelengkung,balok_pelengkung,rangka, -->
                        <tr>
                            <th scope="row">Sistem Gelagar</th>
                            <td>
                                <select class="form-control" name="sistem_gelagar" id="sistem_gelagar">
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
                            <?php 
                                $nilaiUtility = ( $struktural['sistem_gelagar'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[5] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[5] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Jembatan Pelat</th>
                            <td>
                                <select class="form-control" name="jembatan_pelat" id="jembatan_pelat">
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
                            <?php 
                                $nilaiUtility = ( $struktural['jembatan_pelat'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[6] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[6] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Pelengkung</th>
                            <td>
                                <select class="form-control" name="pelengkung" id="pelengkung">
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
                            <?php 
                                $nilaiUtility = ( $struktural['pelengkung'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[7] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[7] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Balok Pelengkung</th>
                            <td>
                                <select class="form-control" name="balok_pelengkung" id="balok_pelengkung">
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
                            <?php 
                                $nilaiUtility = ( $struktural['balok_pelengkung'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[8] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[8] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Rangka</th>
                            <td>
                                <select class="form-control" name="rangka" id="rangka">
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
                            <?php 
                                $nilaiUtility = ( $struktural['rangka'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[9] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[9] ?></span>
                            </td> -->
                        </tr>
                        <!-- sistem_gantung,sistem_lantai,expansion_joint,landasan,sandaran, -->
                        <tr>
                            <th scope="row">Sistem Gantung</th>
                            <td>
                                <select class="form-control" name="sistem_gantung" id="sistem_gantung">
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
                            <?php 
                                $nilaiUtility = ( $struktural['sistem_gantung'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[10] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[10] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Sistem Lantai</th>
                            <td>
                                <select class="form-control" name="sistem_lantai" id="sistem_lantai">
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
                            <?php 
                                $nilaiUtility = ( $struktural['sistem_lantai'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[11] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[11] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Expansion Joint</th>
                            <td>
                                <select class="form-control" name="expansion_joint" id="expansion_joint">
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
                            <?php 
                                $nilaiUtility = ( $struktural['expansion_joint'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[12] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[12] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Landasan</th>
                            <td>
                                <select class="form-control" name="landasan" id="landasan">
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
                            <?php 
                                $nilaiUtility = ( $struktural['landasan'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[13] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[13] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Sandaran</th>
                            <td>
                                <select class="form-control" name="sandaran" id="sandaran">
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
                            <?php 
                                $nilaiUtility = ( $struktural['sandaran'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[14] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[14] ?></span>
                            </td> -->
                        </tr>
                        <!-- perlengkapan,gorong,lintasan,umur,lingkungan,beban,bencana_alam -->
                        <tr>
                            <th scope="row">Perlengkapan</th>
                            <td>
                                <select class="form-control" name="perlengkapan" id="perlengkapan">
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
                            <?php 
                                $nilaiUtility = ( $struktural['perlengkapan'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[15] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[15] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Gorong-gorong</th>
                            <td>
                                <select class="form-control" name="gorong" id="gorong">
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
                            <?php 
                                $nilaiUtility = ( $struktural['gorong'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[16] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[16] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Lintasan</th>
                            <td>
                                <select class="form-control" name="lintasan" id="lintasan">
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
                            <?php 
                                $nilaiUtility = ( $struktural['lintasan'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['NK'] / $sum_bobot_kriteria;
                                $nilaiAkhir[17] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[17] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Umur</th>
                            <td>
                                <select class="form-control" name="umur" id="umur">
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
                            <?php 
                                $nilaiUtility = ( $struktural['umur'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['U'] / $sum_bobot_kriteria;
                                $nilaiAkhir[18] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[18] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Lingkungan</th>
                            <td>
                                <select class="form-control" name="lingkungan" id="lingkungan">
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
                            <?php 
                                $nilaiUtility = ( $struktural['lingkungan'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['L'] / $sum_bobot_kriteria;
                                $nilaiAkhir[19] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[19] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Beban</th>
                            <td>
                                <select class="form-control" name="beban" id="beban">
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
                            <?php 
                                $nilaiUtility = ( $struktural['beban'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['B'] / $sum_bobot_kriteria;
                                $nilaiAkhir[20] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[20] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Bencana Alam</th>
                            <td>
                                <select class="form-control" name="bencana_alam" id="bencana_alam">
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
                            <?php 
                                $nilaiUtility = ( $struktural['bencana_alam'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['BA'] / $sum_bobot_kriteria;
                                $nilaiAkhir[21] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[21] ?></span>
                            </td> -->
                        </tr>
                        <?php 
                        // $sumOfStruktural = 0;
                        // for ($i=0; $i<=21; $i++) {
                        //     $sumOfStruktural += $nilaiAkhir[$i];
                        // }
                        ?>
                        <tr><th>Skor Prioritas Struktural</th><td id="sum_skor_struktural"><?= $struktural['skor_prioritas'] ?></td></tr>
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
                            <!-- <th scope="col">Nilai Utility</th>
                            <th scope="col">Normalisasi</th>
                            <th scope="col">Nilai Akhir</th> -->
                        </tr>
                        </thead>
                        <!-- LHR, Lajur, Kondisi Permukaan Aspal, Sistem Drainase -->
                        <tbody>
                        <tr>
                            <th scope="row">LHR</th>
                            <td>
                                <select class="form-control" name="lhr" id="lhr">
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
                            <?php 
                                $nilaiUtility = ( $fungsional['lhr'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['LHR'] / $sum_bobot_kriteria;
                                $nilaiAkhir[22] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[22] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Lajur</th>
                            <td>
                                <select class="form-control" name="lajur" id="lajur">
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
                            <?php 
                                $nilaiUtility = ( $fungsional['lajur'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['LJR'] / $sum_bobot_kriteria;
                                $nilaiAkhir[23] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[23] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Kondisi Permukaan Aspal</th>
                            <td>
                                <select class="form-control" name="kondisi_permukaan_aspal" id="kondisi_permukaan_aspal">
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
                            <?php 
                                $nilaiUtility = ( $fungsional['kondisi_permukaan_aspal'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['ASP'] / $sum_bobot_kriteria;
                                $nilaiAkhir[24] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[24] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Sistem Drainase</th>
                            <td>
                                <select class="form-control" name="sistem_drainase" id="sistem_drainase">
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
                            <?php 
                                $nilaiUtility = ( $fungsional['sistem_drainase'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['D'] / $sum_bobot_kriteria;
                                $nilaiAkhir[25] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[25] ?></span>
                            </td> -->
                        </tr>
                        <?php 
                        $sumOfFungsional = 0;
                        for ($i=22; $i<=25; $i++) {
                            $sumOfFungsional += $nilaiAkhir[$i];
                        }
                        ?>
                        <tr><th>Skor Prioritas Fungsional</th><td id="sum_skor_fungsional"><?= $fungsional['skor_prioritas'] ?></td></tr>
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
                            <!-- <th scope="col">Nilai Utility</th>
                            <th scope="col">Normalisasi</th>
                            <th scope="col">Nilai Akhir</th> -->
                        </tr>
                        </thead>
                        <!-- kepentingan_historis,sosial,ekonomi,politik -->
                        <tbody>
                        <tr>
                            <th scope="row">Kepentingan Historis</th>
                            <td>
                                <select class="form-control" name="kepentingan_historis" id="kepentingan_historis">
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
                            <?php 
                                $nilaiUtility = ( $nonteknis['kepentingan_historis'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['KHJ'] / $sum_bobot_kriteria;
                                $nilaiAkhir[26] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[26] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Sosial</th>
                            <td>
                                <select class="form-control" name="sosial" id="sosial">
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
                            <?php 
                                $nilaiUtility = ( $nonteknis['sosial'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['SOS'] / $sum_bobot_kriteria;
                                $nilaiAkhir[27] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[27] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Ekonomi</th>
                            <td>
                                <select class="form-control" name="ekonomi" id="ekonomi">
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
                            <?php 
                                $nilaiUtility = ( $nonteknis['ekonomi'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['EKO'] / $sum_bobot_kriteria;
                                $nilaiAkhir[28] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[28] ?></span>
                            </td> -->
                        </tr>
                        <tr>
                            <th scope="row">Politik</th>
                            <td>
                                <select class="form-control" name="politik" id="politik">
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
                            <?php 
                                $nilaiUtility = ( $nonteknis['politik'] - $cMin ) / ($cMax - $cMin);
                                $normalisasi = $bobot_kriteria['POL'] / $sum_bobot_kriteria;
                                $nilaiAkhir[29] = $nilaiUtility * $normalisasi;
                            ?>
                            <!-- <td>
                                <span class="help-block"><?= $nilaiUtility ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $normalisasi ?></span>
                            </td>
                            <td>
                                <span class="help-block"><?= $nilaiAkhir[29] ?></span>
                            </td> -->
                        </tr>
                        <?php 
                        $sumOfNonTeknis = 0;
                        for ($i=26; $i<=29; $i++) {
                            $sumOfNonTeknis += $nilaiAkhir[$i];
                        }
                        ?>
                        <tr><th>Skor Prioritas Non Teknis</th><td id="sum_skor_nonteknis"><?= $nonteknis['skor_prioritas'] ?></td></td></tr>
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
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?= $struktural['skor_prioritas'] ?></td>
                                <td><?= $fungsional['skor_prioritas'] ?></td>
                                <td><?= $nonteknis['skor_prioritas'] ?></td>
                                <td><?= ( $struktural['skor_prioritas'] + $fungsional['skor_prioritas'] + $nonteknis['skor_prioritas'] ) ?></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </form>
            </div>
    </div>
    <!-- <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary btn-sm" onclick="submitform()">
            <i class="fa fa-dot-circle-o"></i> Submit
        </button>
        <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-ban"></i> Reset
        </button>
    </div> -->
</div>
</div>

