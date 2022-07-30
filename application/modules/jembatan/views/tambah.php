<script>
    submitform = function(){
		document.getElementById("form1").submit();
    }
</script>

<div class="col-lg-12">
<div class="card">
    <div class="card-header">
        <p class="text-muted m-b-15">
        <?= "Tambah Data Jembatan" ?>
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
            </ul>
            <div class="tab-content pl-3 p-1" id="myTabContent">
                <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <form action="<?php echo $action_url;?>" method="post" class="form-horizontal" id="form1">
                <input type="hidden" id="id_jembatan" name="id_jembatan" value="">
                    <h3>Data umum</h3>
                    <p></p>
                    <div class="col-lg-6">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th scope="row">Nama Jembatan</th>
                            <td>
                            <input type="text" id="nama" name="nama" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Propinsi</th>
                            <td>
                                <input type="text" id="propinsi" name="propinsi" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Kabupaten</th>
                            <td>
                                <input type="text" id="kabupaten" name="kabupaten" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Ruas</th>
                            <td>
                                <input type="text" id="ruas" name="ruas" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Panjang</th>
                            <td>
                                <input type="text" id="panjang" name="panjang" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Jumlah Bentang</th>
                            <td>
                                <input type="text" id="jml_bentang" name="jml_bentang" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Lebar</th>
                            <td>
                                <input type="text" id="lebar" name="lebar" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Lebar Jalan</th>
                            <td>
                                <input type="text" id="lebar_jalan" name="lebar_jalan" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tipe Bangunan Atas</th>
                            <td>
                                <input type="text" id="tipe_bangunan_atas" name="tipe_bangunan_atas" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tahun Pembuatan</th>
                            <td>
                                <input type="text" id="thn_pembuatan" name="thn_pembuatan" class="form-control" value="">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Tahun Survey</th>
                            <td>
                                <input type="text" id="thn_survey" name="thn_survey" class="form-control" value="">
                            </td>
                        </tr>
                        <input type="hidden" id="kode_kerusakan" name="kode_kerusakan" class="form-control" value="">
                        <input type="hidden" id="volume" name="volume" class="form-control" value="">
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
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <!-- aliran_sungai,bangunan_pengaman,tanah_timbunan,pondasi,kepala_jembatan, -->
                            <th scope="row">Aliran Sungai</th>
                            <td>
                                <select class="form-control" name="aliran_sungai" id="aliran_sungai" style="width:450px">
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
                                <select class="form-control" name="bangunan_pengaman" id="bangunan_pengaman">
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
                                <select class="form-control" name="tanah_timbunan" id="tanah_timbunan">
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
                                <select class="form-control" name="pondasi" id="pondasi">
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
                                <select class="form-control" name="kepala_jembatan" id="kepala_jembatan">
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
                                <select class="form-control" name="sistem_gelagar" id="sistem_gelagar">
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
                                <select class="form-control" name="jembatan_pelat" id="jembatan_pelat">
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
                                <select class="form-control" name="pelengkung" id="pelengkung">
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
                                <select class="form-control" name="balok_pelengkung" id="balok_pelengkung">
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
                                <select class="form-control" name="rangka" id="rangka">
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
                                <select class="form-control" name="sistem_gantung" id="sistem_gantung">
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
                                <select class="form-control" name="sistem_lantai" id="sistem_lantai">
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
                                <select class="form-control" name="expansion_joint" id="expansion_joint">
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
                                <select class="form-control" name="landasan" id="landasan">
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
                                <select class="form-control" name="sandaran" id="sandaran">
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
                                <select class="form-control" name="perlengkapan" id="perlengkapan">
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
                                <select class="form-control" name="gorong" id="gorong">
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
                                <select class="form-control" name="lintasan" id="lintasan">
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
                                <select class="form-control" name="umur" id="umur">
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
                                <select class="form-control" name="lingkungan" id="lingkungan">
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
                                <select class="form-control" name="beban" id="beban">
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
                                <select class="form-control" name="bencana_alam" id="bencana_alam">
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
                        <!-- <tr>
                            <th scope="row">Skor Struktural</th>
                            <td>
                            <input type="text" id="skor_struktural" name="skor_struktural" class="form-control" value="0" readonly>
                            </td>
                        </tr> -->
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
                                <select class="form-control" name="lhr" id="lhr">
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
                                <select class="form-control" name="lajur" id="lajur">
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
                                <select class="form-control" name="kondisi_permukaan_aspal" id="kondisi_permukaan_aspal">
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
                                <select class="form-control" name="sistem_drainase" id="sistem_drainase">
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
                        <!-- <tr>
                            <th scope="row">Skor Fungsional</th>
                            <td>
                            <input type="text" id="skor_fungsional" name="skor_fungsional" class="form-control" value="0" readonly>
                            </td>
                        </tr> -->
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
                                <select class="form-control" name="kepentingan_historis" id="kepentingan_historis">
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
                                <select class="form-control" name="sosial" id="sosial">
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
                                <select class="form-control" name="ekonomi" id="ekonomi">
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
                                <select class="form-control" name="politik" id="politik">
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
                        <!-- <tr>
                            <th scope="row">Skor Non-teknis</th>
                            <td>
                            <input type="text" id="skor_nonteknis" name="skor_nonteknis" class="form-control" value="0" readonly>
                            </td>
                        </tr> -->
                        </tbody>
                    </table>
                    </div>
                </div>          
            </form>
            </div>
    </div>
    <div class="card-footer text-right">
        <button type="submit" class="btn btn-primary btn-sm" onclick="submitform()">
            <i class="fa fa-dot-circle-o"></i> Submit
        </button>
        <!-- <button type="reset" class="btn btn-danger btn-sm">
            <i class="fa fa-ban"></i> Reset
        </button> -->
    </div>
</div>
</div>

