<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends MY_Controller {

    var $data;
	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('jembatan/jembatan_model','jembatan_model');
        $this->load->model('homepage/dashboard_model','dashboard_model');
	}

	public function index()
	{
        redirect('homepage/dashboard');
    }
    
	public function detail($id = NULL)
	{
        $this->data['page_title'] = "Detail Jembatan";
        $this->data['nk_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Nilai Kondisi');
        $this->data['umur_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Umur');
        $this->data['lingkungan_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Lingkungan');
        $this->data['beban_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Beban');
        $this->data['bencana_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Bencana Alam');
        $this->data['lhr_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('LHR');
        $this->data['lajur_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Jumlah Lajur');
        $this->data['aspal_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Kondisi permukaan aspal');
        $this->data['drainase_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Sistem Drainase');
        $this->data['historis_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Kepentingan Historis Jembatan');
        $this->data['sosial_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Sosial');
        $this->data['ekonomi_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Ekonomi');
        $this->data['politik_options'] = $this->jembatan_model->getBobotKriteriaOptionsBySubKriteria('Politik');
        $this->data['action_url'] = base_url()."jembatan/view/save";

        if($id != NULL)
		{
            $data_jembatan = $this->jembatan_model->getJembatanById($id);
            $data_struktural = $this->jembatan_model->getStrukturalByIdJembatan($id);
            $data_fungsional = $this->jembatan_model->getFungsionalByIdJembatan($id);
            $data_nonteknis = $this->jembatan_model->getNonTeknisByIdJembatan($id);
            $data_skor_prioritas = $this->jembatan_model->getSkorPrioritasByIdJembatan($id);

            $this->data['general'] = $data_jembatan;
            $this->data['struktural'] = $data_struktural;
            $this->data['fungsional'] = $data_fungsional;
            $this->data['nonteknis'] = $data_nonteknis;
            $this->data['skor_prioritas'] = $data_skor_prioritas;
            
            if($data_skor_prioritas['id_penanganan'] == 2) {
                $kerusakan = $this->hitungKerusakanDanBiaya($data_jembatan);
                $this->data['kerusakan']    = $kerusakan[0];
                $this->data['biaya']        = $kerusakan[1];
            } else if($data_skor_prioritas['id_penanganan'] >= 3) {
                if($data_skor_prioritas['id_penanganan'] == 3) {
                    $biayaRehab       = $this->kalkulasiYDenormalisasiRehab($data_jembatan,$data_skor_prioritas['skor_total']);
                    $this->data['biayaRehab']    = $biayaRehab;
                } else {
                    $biayaReplace       = $this->kalkulasiYDenormalisasiReplace($data_jembatan,$data_skor_prioritas['skor_total']);
                    $this->data['biayaReplace']    = $biayaReplace;
                }
            }

            $this->render_page('jembatan/detail',$this->data);
            
        } else {
			$this->render_page('jembatan/tambah',$this->data);
		}
		
    }

    function tambah_data() {
        $this->detail();
    }
    
    public function save() {
        $id_jembatan = $_POST['id_jembatan'];
		
        // parameter tabel jembatan
        $param_jembatan['nama']                 = $_POST['nama'];
		$param_jembatan['propinsi']		        = $_POST['propinsi'];
        $param_jembatan['kabupaten']		    = $_POST['kabupaten'];
		$param_jembatan['ruas']                 = $_POST['ruas'];
		$param_jembatan['panjang']              = $_POST['panjang'];
        $param_jembatan['jml_bentang']          = $_POST['jml_bentang'];
        $param_jembatan['lebar']                = $_POST['lebar'];
        $param_jembatan['lebar_jalan']          = $_POST['lebar_jalan'];
        $param_jembatan['tipe_bangunan_atas']   = $_POST['tipe_bangunan_atas'];
        $param_jembatan['thn_pembuatan']        = $_POST['thn_pembuatan'];
        $param_jembatan['thn_survey']           = $_POST['thn_survey'];
        $param_jembatan['kode_kerusakan']       = $_POST['kode_kerusakan'];
        $param_jembatan['volume']               = $_POST['volume'];
        $param_jembatan['udc']           = $_POST['udc'];
        
		// parameter tabel struktural
        $param_struktural['aliran_sungai']        = $_POST['aliran_sungai'];
        $param_struktural['bangunan_pengaman']    = $_POST['bangunan_pengaman'];
        $param_struktural['tanah_timbunan']       = $_POST['tanah_timbunan'];
        $param_struktural['pondasi']              = $_POST['pondasi'];
        $param_struktural['kepala_jembatan']      = $_POST['kepala_jembatan'];
        $param_struktural['sistem_gelagar']       = $_POST['sistem_gelagar'];
        $param_struktural['jembatan_pelat']       = $_POST['jembatan_pelat'];
        $param_struktural['pelengkung']           = $_POST['pelengkung'];
        $param_struktural['balok_pelengkung']     = $_POST['balok_pelengkung'];
        $param_struktural['rangka']               = $_POST['rangka'];
        $param_struktural['sistem_gantung']       = $_POST['sistem_gantung'];
        $param_struktural['sistem_lantai']        = $_POST['sistem_lantai'];
        $param_struktural['expansion_joint']      = $_POST['expansion_joint'];
        $param_struktural['landasan']             = $_POST['landasan'];
        $param_struktural['sandaran']             = $_POST['sandaran'];
        $param_struktural['perlengkapan']         = $_POST['perlengkapan'];
        $param_struktural['gorong']               = $_POST['gorong'];
        $param_struktural['lintasan']             = $_POST['lintasan'];
        $param_struktural['umur']                 = $_POST['umur'];
        $param_struktural['lingkungan']           = $_POST['lingkungan'];
        $param_struktural['beban']                = $_POST['beban'];
        $param_struktural['bencana_alam']         = $_POST['bencana_alam'];
        
        // parameter tabel fungsional
        $param_fungsional['lhr']                        = $_POST['lhr'];
        $param_fungsional['lajur']                      = $_POST['lajur'];
        $param_fungsional['kondisi_permukaan_aspal']    = $_POST['kondisi_permukaan_aspal'];
        $param_fungsional['sistem_drainase']            = $_POST['sistem_drainase'];
        
        // parameter tabel non_teknis
        $param_nonteknis['kepentingan_historis']    = $_POST['kepentingan_historis'];
        $param_nonteknis['sosial']                  = $_POST['sosial'];
        $param_nonteknis['ekonomi']                 = $_POST['ekonomi'];
        $param_nonteknis['politik']                 = $_POST['politik'];
        
        // parameter tabel skor_prioritas
        // $param_skor['skor_struktural']  = $_POST['skor_struktural'];
        // $param_skor['skor_fungsional']  = $_POST['skor_fungsional'];
        // $param_skor['skor_nonteknis']   = $_POST['skor_nonteknis'];

        if (!empty($id_jembatan)) {
            $this->jembatan_model->updateJembatan($id_jembatan,$param_jembatan);
            redirect('jembatan/view/detail/'.$id_jembatan);
        } else {
            $jembatanBaru = $this->jembatan_model->insertJembatan($param_jembatan);
            $id_jembatan = $jembatanBaru[1];

            // kalkulasi skor total
            $kalkulasiSkorTotal = $this->hitungSkorTotal($param_struktural,$param_fungsional,$param_nonteknis);
            
            // parameter tabel skor_prioritas
            $param_skor['id_jembatan']      = $id_jembatan;
            $param_skor['skor_struktural']  = $kalkulasiSkorTotal[0];
            $param_skor['skor_fungsional']  = $kalkulasiSkorTotal[1];
            $param_skor['skor_nonteknis']   = $kalkulasiSkorTotal[2];
            $param_skor['skor_total']       = $kalkulasiSkorTotal[3];
            $param_skor['id_penanganan']    = $kalkulasiSkorTotal[4];
            $this->jembatan_model->insertSkor($param_skor);
            
            $param_struktural['id_jembatan'] = $id_jembatan;
            $this->jembatan_model->insertStruktural($param_struktural);
            $param_fungsional['id_jembatan'] = $id_jembatan;
            $this->jembatan_model->insertFungsional($param_fungsional);
            $param_nonteknis['id_jembatan'] = $id_jembatan;
            $this->jembatan_model->insertNonteknis($param_nonteknis);

            redirect('homepage/dashboard');
        }
    }

    public function hitungSkorTotal($param_struktural,$param_fungsional,$param_nonteknis) {
        $cMin = 0;
        $cMax = 5;
        $naMin = 0;
        $naMax = 2.25;

        $bobot_kriteria_pls = $this->jembatan_model->getBobotKriteria();
        $bobot_kriteria = [];
        $sum_bobot_kriteria = 0;
        foreach ($bobot_kriteria_pls as $key => $value) {
            $bobot_kriteria[$value['elemen']] = $value['nilai'];
            $sum_bobot_kriteria += $value['nilai'];
        }

        $skor_struktural = 0;
        foreach($param_struktural as $key => $value) {
            if($key == "umur") {
                $bobot = $bobot_kriteria['U'];
            } else if($key == "lingkungan") {
                $bobot = $bobot_kriteria['L'];
            } else if($key == "beban") {
                $bobot = $bobot_kriteria['B'];
            } else if($key == "bencana_alam") {
                $bobot = $bobot_kriteria['BA'];
            } else {
                $bobot = $bobot_kriteria['NK'];
            }
            $nilaiUtility = ( (float)$value - $cMin ) / ($cMax - $cMin);
            $normalisasi = $bobot / $sum_bobot_kriteria;
            $nilaiAkhir = $nilaiUtility * $normalisasi;
            $skor_struktural += $nilaiAkhir;
        }

        $skor_fungsional = 0;
        foreach($param_fungsional as $key => $value) {
            if($key == "lhr") {
                $bobot = $bobot_kriteria['LHR'];
            } else if($key == "lajur") {
                $bobot = $bobot_kriteria['LJR'];
            } else if($key == "kondisi_permukaan_aspal") {
                $bobot = $bobot_kriteria['ASP'];
            } else if($key == "sistem_drainase") {
                $bobot = $bobot_kriteria['D'];
            } else {
                $bobot = $bobot_kriteria['NK'];
            }
            $nilaiUtility = ( (float)$value - $cMin ) / ($cMax - $cMin);
            $normalisasi = $bobot / $sum_bobot_kriteria;
            $nilaiAkhir = $nilaiUtility * $normalisasi;
            $skor_fungsional += $nilaiAkhir;
        }
        
        $skor_nonteknis = 0;
        foreach($param_nonteknis as $key => $value) {
            if($key == "kepentingan_historis") {
                $bobot = $bobot_kriteria['KHJ'];
            } else if($key == "sosial") {
                $bobot = $bobot_kriteria['SOS'];
            } else if($key == "ekonomi") {
                $bobot = $bobot_kriteria['EKO'];
            } else if($key == "politik") {
                $bobot = $bobot_kriteria['POL'];
            } else {
                $bobot = $bobot_kriteria['NK'];
            }
            $nilaiUtility = ( (float)$value - $cMin ) / ($cMax - $cMin);
            $normalisasi = $bobot / $sum_bobot_kriteria;
            $nilaiAkhir = $nilaiUtility * $normalisasi;
            $skor_nonteknis += $nilaiAkhir;
        }
        $skor_total = (($skor_struktural + $skor_fungsional + $skor_nonteknis) - $naMin) / ($naMax - $naMin);
        $penanganan = $this->jembatan_model->getKategoriPenanganan($skor_total);
        return [$skor_struktural, $skor_fungsional, $skor_nonteknis, $skor_total, $penanganan['id'], $penanganan['kategori_penanganan']];
    }

    public function reCalculateSkorTotal($id_jembatan) {
        $data_struktural = $this->jembatan_model->getStrukturalByIdJembatan($id_jembatan);
        unset($data_struktural['id']);
        unset($data_struktural['id_jembatan']);
        unset($data_struktural['nama']);
        $data_fungsional = $this->jembatan_model->getFungsionalByIdJembatan($id_jembatan);
        unset($data_fungsional['id']);
        unset($data_fungsional['id_jembatan']);
        unset($data_fungsional['nama']);
        $data_nonteknis = $this->jembatan_model->getNonTeknisByIdJembatan($id_jembatan);
        unset($data_nonteknis['id']);
        unset($data_nonteknis['id_jembatan']);
        unset($data_nonteknis['nama']);
        $rekalkulasi =  $this->hitungSkorTotal($data_struktural,$data_fungsional,$data_nonteknis);
        
        $param_skor['skor_struktural']  = $rekalkulasi[0];
        $param_skor['skor_fungsional']  = $rekalkulasi[1];
        $param_skor['skor_nonteknis']   = $rekalkulasi[2];
        $param_skor['skor_total']       = $rekalkulasi[3];
        $param_skor['id_penanganan']    = $rekalkulasi[4];
        $this->jembatan_model->updateSkor($id_jembatan,$param_skor);
        
        return $rekalkulasi;
    }

    public function save_opsi() {
        // POST data
        $postData = $this->input->post();
        
        // get data
        $params[$postData['element']]        = $postData['value'];
        if($postData['kategori'] == 'struktural') {
            $this->jembatan_model->updateStruktural($postData['id_jembatan'],$params);
        } else if($postData['kategori'] == 'fungsional') {
            $this->jembatan_model->updateFungsional($postData['id_jembatan'],$params);
        } else if($postData['kategori'] == 'nonteknis') {
            $this->jembatan_model->updateNonTeknis($postData['id_jembatan'],$params);
        }

        $rekalkulasi = $this->reCalculateSkorTotal($postData['id_jembatan']);

        $data_jembatan = $this->jembatan_model->getJembatanById($postData['id_jembatan']);
        
        $result = [
            'skor_struktural' => number_format($rekalkulasi[0],3),
            'skor_fungsional' => number_format($rekalkulasi[1],3),
            'skor_nonteknis' => number_format($rekalkulasi[2],3),
            'skor_total' => number_format($rekalkulasi[3],3),
            'id_penanganan' => $rekalkulasi[4],
            'penanganan' => $rekalkulasi[5],
            'biaya_ganti' => ($rekalkulasi[4] > 3) ? $this->kalkulasiYDenormalisasiReplace($data_jembatan,$rekalkulasi[3]) : '',
            'biaya_rehab' => ($rekalkulasi[4] == 3) ? $this->kalkulasiYDenormalisasiRehab($data_jembatan,$rekalkulasi[3]) : '',
            'pemeliharaan' => ($rekalkulasi[4] == 2) ? $this->hitungKerusakanDanBiaya($data_jembatan) : []
        ];
        
        echo json_encode($result);

        // return $result;
    }
	
    public function skor_prioritas() {
        $this->data['page_title'] = "Detail Skor Prioritas";
        // recalculate all data skor_prioritas
        // $daftar_jembatan = $this->dashboard_model->getDaftarJembatan();
        // foreach ($daftar_jembatan as $data) {
        //     $rekalkulasi = $this->reCalculateSkorTotal($data['id']);
        // }
        $dataJembatan = $this->jembatan_model->getAllSkorJembatan();
        $i = 0;
        foreach($dataJembatan as $data) {
            $kerusakan      = $this->hitungKerusakanDanBiaya($data);
            $biayaRehab     = $this->kalkulasiYDenormalisasiRehab($data,$data['skor_total']);
            $biayaReplace   = $this->kalkulasiYDenormalisasiReplace($data,$data['skor_total']);
            $dataJembatan[$i]['kerusakan'] = $kerusakan;
            $dataJembatan[$i]['rehab'] = $biayaRehab;
            $dataJembatan[$i]['replace'] = $biayaReplace;
            $i++;
        }
        // echo '<pre>';print_r($dataJembatan);echo '</pre>';
        $this->data['jembatan'] = $dataJembatan;
        $this->render_page('jembatan/skor_prioritas',$this->data);
    }

    public function hapus($id = NULL) {
        if($id != NULL)
		{
            $this->jembatan_model->deleteJembatan($id);
            $this->jembatan_model->deleteStruktural($id);
            $this->jembatan_model->deleteFungsional($id);
            $this->jembatan_model->deleteNonTeknis($id);
            $this->jembatan_model->deleteSkor($id);
        }
        redirect('homepage/dashboard');
    }

    public function kalkulasiYNormalisasi($bobotAwalInput, $bobotAwalBias, $bobotAwalLapisan, $bias, $x) {
        $i = 0;
        foreach ($bobotAwalInput as $key => $ba) {
            $j=1;
            $zInj[$i] = $bobotAwalBias[$i]['bias'];
            foreach($x as $key => $val) {
                $zInj[$i] += ($ba['x'.$j] * $val);
                $j++;
            }
            $z[$i] = 1/(1+exp(-$zInj[$i]));
            $i++;
        }

        $k = 0;
        $y1Normalisasi = $bias;
        foreach($z as $key => $value) {
            $y1Normalisasi += ($bobotAwalLapisan[$k]['bobot'] * $value);
            $k++;
        }
        return $y1Normalisasi;
    }
    
    public function kalkulasiYDenormalisasi($data_jembatan, $tipeY, $tahun, $kerusakan = NULL, $biaya = NULL) {
        $panjang = $data_jembatan['panjang'];
        $lebar = $data_jembatan['lebar'];
        $lebar_jalan = $data_jembatan['lebar_jalan'];
        $kode_kerusakan = $data_jembatan['kode_kerusakan'];
        $volume = $data_jembatan['volume'];
        $total_area = $panjang * $lebar;

        $meanX = array(27.05, 12.26, 11.18, 662.32, 1.62, 233.81, 0.00, 913159.40, 0.32, 934798.40, 0.26, 1458747.05, 0.27, 2781560.01, 0.33, 5993316.29);
        $sdX = array(32.02, 6.42, 7.12, 105.70, 1.91, 245.05, 1.00, 2968121.31, 0.50, 4849738.21, 0.63, 9370460.08, 0.96, 19794140.71, 1.61, 45433495.80);
        
        $x[0] = ( $panjang - $meanX[0] ) / $sdX[0];
        $x[1] = ( $lebar - $meanX[1] ) / $sdX[1];
        $x[2] = ( $lebar_jalan - $meanX[2] ) / $sdX[2];
        $x[3] = ( $kode_kerusakan - $meanX[3] ) / $sdX[3];
        $x[4] = ( $volume - $meanX[4] ) / $sdX[4];
        $x[5] = ( $total_area - $meanX[5] ) / $sdX[5];

        if($tipeY == 1) {
            # hitung Y sebagai angka biaya pemeliharaan
            if($tahun == 1)
            {
                $meanY1 = $meanX[7];
                $sdY1   = $sdX[7];
                $bias   = 0.80;
                $kerusakan1 = $kerusakan[0];
                $x[6] = ( $kerusakan1 - $meanX[6] ) / $sdX[6];
            } else if($tahun == 2) {
                $meanY1 = $meanX[9];
                $sdY1   = $sdX[9];
                $bias   = 1.07;
                $kerusakan1 = $kerusakan[0];
                $biaya1 = $biaya[0];
                $kerusakan2 = $kerusakan[1];
                $x[6] = ( $kerusakan1 - $meanX[6] ) / $sdX[6];
                $x[7] = ( $biaya1 - $meanX[7] ) / $sdX[7];
                $x[8] = ( $kerusakan2 - $meanX[8] ) / $sdX[8];
            } else if($tahun == 3) {
                $meanY1 = $meanX[11];
                $sdY1   = $sdX[11];
                $bias   = -0.04;
                $kerusakan1 = $kerusakan[0];
                $biaya1 = $biaya[0];
                $kerusakan2 = $kerusakan[1];
                $biaya2 = $biaya[1];
                $kerusakan3 = $kerusakan[2];
                $x[6] = ( $kerusakan1 - $meanX[6] ) / $sdX[6];
                $x[7] = ( $biaya1 - $meanX[7] ) / $sdX[7];
                $x[8] = ( $kerusakan2 - $meanX[8] ) / $sdX[8];
                $x[9] = ( $biaya2 - $meanX[9] ) / $sdX[9];
                $x[10] = ( $kerusakan3 - $meanX[10] ) / $sdX[10];
            } else if($tahun == 4) {
                $meanY1 = $meanX[13];
                $sdY1   = $sdX[13];
                $bias   = -0.82;
                $kerusakan1 = $kerusakan[0];
                $biaya1 = $biaya[0];
                $kerusakan2 = $kerusakan[1];
                $biaya2 = $biaya[1];
                $kerusakan3 = $kerusakan[2];
                $biaya3 = $biaya[2];
                $kerusakan4 = $kerusakan[3];
                
                $x[6] = ( $kerusakan1 - $meanX[6] ) / $sdX[6];
                $x[7] = ( $biaya1 - $meanX[7] ) / $sdX[7];
                $x[8] = ( $kerusakan2 - $meanX[8] ) / $sdX[8];
                $x[9] = ( $biaya2 - $meanX[9] ) / $sdX[9];
                $x[10] = ( $kerusakan3 - $meanX[10] ) / $sdX[10];
                $x[11] = ( $biaya3 - $meanX[11] ) / $sdX[11];
                $x[12] = ( $kerusakan4 - $meanX[12] ) / $sdX[12];
            } else if($tahun == 5) {
                $meanY1 = $meanX[15];
                $sdY1   = $sdX[15];
                $bias   = 0.59;
                $kerusakan1 = $kerusakan[0];
                $biaya1 = $biaya[0];
                $kerusakan2 = $kerusakan[1];
                $biaya2 = $biaya[1];
                $kerusakan3 = $kerusakan[2];
                $biaya3 = $biaya[2];
                $kerusakan4 = $kerusakan[3];
                $biaya4 = $biaya[3];
                $kerusakan5 = $kerusakan[4];
                
                $x[6] = ( $kerusakan1 - $meanX[6] ) / $sdX[6];
                $x[7] = ( $biaya1 - $meanX[7] ) / $sdX[7];
                $x[8] = ( $kerusakan2 - $meanX[8] ) / $sdX[8];
                $x[9] = ( $biaya2 - $meanX[9] ) / $sdX[9];
                $x[10] = ( $kerusakan3 - $meanX[10] ) / $sdX[10];
                $x[11] = ( $biaya3 - $meanX[11] ) / $sdX[11];
                $x[12] = ( $kerusakan4 - $meanX[12] ) / $sdX[12];
                $x[13] = ( $biaya4 - $meanX[13] ) / $sdX[13];
                $x[14] = ( $kerusakan5 - $meanX[14] ) / $sdX[14];
            }
            $bobotAwalInput = $this->jembatan_model->getBobotAwalInputBiaya($tahun);
            $bobotAwalBias = $this->jembatan_model->getBobotAwalBiasBiaya($tahun);
            $bobotAwalLapisan = $this->jembatan_model->getBobotAwalLapisanBiaya($tahun);
        } else {
            # hitung Y sebagai angka kuantitas kerusakan
            if($tahun == 1) {
                $meanY1 = 0.52;
                $sdY1   = 0.56;
                $bias   = 5.45;
            } else if($tahun == 2) {
                $meanY1 = $meanX[8];
                $sdY1   = $sdX[8];
                $bias   = 2.08;
                $kerusakan1 = $kerusakan[0];
                $biaya1 = $biaya[0];
                $x[6] = ( $kerusakan1 - $meanX[6] ) / $sdX[6];
                $x[7] = ( $biaya1 - $meanX[7] ) / $sdX[7];
            } else if($tahun == 3) {
                $meanY1 = $meanX[10];
                $sdY1   = $sdX[10];
                $bias   = 0.61;
                $kerusakan1 = $kerusakan[0];
                $biaya1 = $biaya[0];
                $kerusakan2 = $kerusakan[1];
                $biaya2 = $biaya[1];
                $x[6] = ( $kerusakan1 - $meanX[6] ) / $sdX[6];
                $x[7] = ( $biaya1 - $meanX[7] ) / $sdX[7];
                $x[8] = ( $kerusakan2 - $meanX[8] ) / $sdX[8];
                $x[9] = ( $biaya2 - $meanX[9] ) / $sdX[9];
            } else if($tahun == 4) {
                $meanY1 = $meanX[12];
                $sdY1   = $sdX[12];
                $bias   = -0.51;
                $kerusakan1 = $kerusakan[0];
                $biaya1 = $biaya[0];
                $kerusakan2 = $kerusakan[1];
                $biaya2 = $biaya[1];
                $kerusakan3 = $kerusakan[2];
                $biaya3 = $biaya[2];
                
                $x[6] = ( $kerusakan1 - $meanX[6] ) / $sdX[6];
                $x[7] = ( $biaya1 - $meanX[7] ) / $sdX[7];
                $x[8] = ( $kerusakan2 - $meanX[8] ) / $sdX[8];
                $x[9] = ( $biaya2 - $meanX[9] ) / $sdX[9];
                $x[10] = ( $kerusakan3 - $meanX[10] ) / $sdX[10];
                $x[11] = ( $biaya3 - $meanX[11] ) / $sdX[11];
            } else if($tahun == 5) {
                $meanY1 = $meanX[14];
                $sdY1   = $sdX[14];
                $bias   = 0.32;
                $kerusakan1 = $kerusakan[0];
                $biaya1 = $biaya[0];
                $kerusakan2 = $kerusakan[1];
                $biaya2 = $biaya[1];
                $kerusakan3 = $kerusakan[2];
                $biaya3 = $biaya[2];
                $kerusakan4 = $kerusakan[3];
                $biaya4 = $biaya[3];
                
                $x[6] = ( $kerusakan1 - $meanX[6] ) / $sdX[6];
                $x[7] = ( $biaya1 - $meanX[7] ) / $sdX[7];
                $x[8] = ( $kerusakan2 - $meanX[8] ) / $sdX[8];
                $x[9] = ( $biaya2 - $meanX[9] ) / $sdX[9];
                $x[10] = ( $kerusakan3 - $meanX[10] ) / $sdX[10];
                $x[11] = ( $biaya3 - $meanX[11] ) / $sdX[11];
                $x[12] = ( $kerusakan4 - $meanX[12] ) / $sdX[12];
                $x[13] = ( $biaya4 - $meanX[13] ) / $sdX[13];
            }
            $bobotAwalInput = $this->jembatan_model->getBobotAwalInputKerusakan($tahun);
            $bobotAwalBias = $this->jembatan_model->getBobotAwalBiasKerusakan($tahun);
            $bobotAwalLapisan = $this->jembatan_model->getBobotAwalLapisanKerusakan($tahun);
        }        
        
        $y1Normalisasi = $this->kalkulasiYNormalisasi($bobotAwalInput, $bobotAwalBias, $bobotAwalLapisan, $bias, $x);

        $y1Denormalisasi = abs($meanY1 + ($sdY1 * $y1Normalisasi));
        
        return $y1Denormalisasi;
    }

    public function hitungKerusakanDanBiaya($data_jembatan) {
        $kerusakan[0]   = $this->kalkulasiYDenormalisasi($data_jembatan,0,1);
        $biaya[0]       = $this->kalkulasiYDenormalisasi($data_jembatan,1,1,$kerusakan);
        $kerusakan[1]   = $this->kalkulasiYDenormalisasi($data_jembatan,0,2,$kerusakan,$biaya);
        $biaya[1]       = $this->kalkulasiYDenormalisasi($data_jembatan,1,2,$kerusakan,$biaya);
        $kerusakan[2]   = $this->kalkulasiYDenormalisasi($data_jembatan,0,3,$kerusakan,$biaya);
        $biaya[2]       = $this->kalkulasiYDenormalisasi($data_jembatan,1,3,$kerusakan,$biaya);
        $kerusakan[3]   = $this->kalkulasiYDenormalisasi($data_jembatan,0,4,$kerusakan,$biaya);
        $biaya[3]       = $this->kalkulasiYDenormalisasi($data_jembatan,1,4,$kerusakan,$biaya);
        $kerusakan[4]   = $this->kalkulasiYDenormalisasi($data_jembatan,0,5,$kerusakan,$biaya);
        $biaya[4]       = $this->kalkulasiYDenormalisasi($data_jembatan,1,5,$kerusakan,$biaya);
        return [$kerusakan,$biaya];
    }

    public function kalkulasiYDenormalisasiRehab($data_jembatan,$skor) {
        $umur   = date('Y') - $data_jembatan['thn_pembuatan'];
        $udc    = $data_jembatan['udc'];
        $meanX  = array(13.70, 0.12, 17.60);
        $sdX    = array(14.37, 0.01, 18.24);

        $x[0] = ( $umur - $meanX[0] ) / $sdX[0];
        $x[1] = ( $skor - $meanX[1] ) / $sdX[1];
        $x[2] = ( $udc - $meanX[2] ) / $sdX[2];

        $meanY1 = 2383775452.67;
        $sdY1   = 7764839146.57;
        $bias   = -0.13;

        $bobotAwalInput = $this->jembatan_model->getBobotAwalInputRehab();
        $bobotAwalBias = $this->jembatan_model->getBobotAwalBiasRehab();
        $bobotAwalLapisan = $this->jembatan_model->getBobotAwalLapisanRehab();

        $y1Normalisasi = $this->kalkulasiYNormalisasi($bobotAwalInput, $bobotAwalBias, $bobotAwalLapisan, $bias, $x);

        $y1Denormalisasi = abs($meanY1 + ($sdY1 * $y1Normalisasi));
        
        return $y1Denormalisasi;
    }

    public function kalkulasiYDenormalisasiReplace($data_jembatan,$skor) {
        $umur   = date('Y') - $data_jembatan['thn_pembuatan'];
        $udc    = $data_jembatan['udc'];
        $meanX  = array(23.84, 0.21, 86.21);
        $sdX    = array(11.41, 0.01, 39.71);

        $x[0] = ( $umur - $meanX[0] ) / $sdX[0];
        $x[1] = ( $skor - $meanX[1] ) / $sdX[1];
        $x[2] = ( $udc - $meanX[2] ) / $sdX[2];

        $meanY1 = 1655877046413.02;
        $sdY1   = 6269914617090.08;
        $bias   = 0.92;

        $bobotAwalInput = $this->jembatan_model->getBobotAwalInputReplace();
        $bobotAwalBias = $this->jembatan_model->getBobotAwalBiasReplace();
        $bobotAwalLapisan = $this->jembatan_model->getBobotAwalLapisanReplace();

        $y1Normalisasi = $this->kalkulasiYNormalisasi($bobotAwalInput, $bobotAwalBias, $bobotAwalLapisan, $bias, $x);

        $y1Denormalisasi = abs($meanY1 + ($sdY1 * $y1Normalisasi));
        
        return $y1Denormalisasi;
    }

}