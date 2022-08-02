<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jembatan_model extends CI_Model
{

    public function __construct()
	{
		parent::__construct();
    }

    public function getJembatanById($id){
        $this->db->where('jembatan.id', $id);
        $query = $this->db->get('jembatan');
        return $query->row_array();
    }

    public function getStrukturalByIdJembatan($id){
        $this->db->where('struktural.id_jembatan', $id);
        $query = $this->db->get('struktural');
        return $query->row_array();
    }

    public function getFungsionalByIdJembatan($id){
        $this->db->where('fungsional.id_jembatan', $id);
        $query = $this->db->get('fungsional');
        return $query->row_array();
    }

    public function getNonTeknisByIdJembatan($id){
        $this->db->where('non_teknis.id_jembatan', $id);
        $query = $this->db->get('non_teknis');
        return $query->row_array();
    }

    public function getSkorPrioritasByIdJembatan($id){
        $this->db->select('sp.*, p.kategori_penanganan, p.id as penanganan_id');
        $this->db->from('skor_prioritas sp');
        $this->db->join('penanganan p', 'sp.id_penanganan = p.id', 'left');
        $this->db->where('sp.id_jembatan', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getKategoriPenanganan($skor_total) {
        $this->db->where('penanganan.min_value <= ', $skor_total);
        $this->db->where('penanganan.max_value > ', $skor_total);
        $query = $this->db->get('penanganan');
        return $query->row_array();
    }

    public function getBobotKriteria(){
        $query = $this->db->get('bobot_kriteria_pls');
        return $query->result_array();
    }

    public function getBobotKriteriaOptionsBySubKriteria($subkriteria){
        $this->db->where('bobot_kriteria.subkriteria', $subkriteria);
        $query = $this->db->get('bobot_kriteria');
        return $query->result_array();
    }

    public function getAllSkorJembatan(){
        $this->db->select('j.*, ROUND(sp.skor_total,3) as skor_total, p.kategori_penanganan, p.id as id_penanganan');
        $this->db->from('jembatan j');
        $this->db->join('skor_prioritas sp', 'j.id = sp.id_jembatan', 'left');
        $this->db->join('penanganan p', 'sp.id_penanganan = p.id', 'left');
        $this->db->order_by('sp.skor_total', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    // get bobot awal perhitungan kerusakan dan biaya
    public function getBobotAwalInputKerusakan($tahun){
        $query = $this->db->get('bobot_awal_input_kerusakan_'.$tahun);
        return $query->result_array();
    }

    public function getBobotAwalBiasKerusakan($tahun){
        $query = $this->db->get('bobot_awal_bias_kerusakan_'.$tahun);
        return $query->result_array();
    }

    public function getBobotAwalLapisanKerusakan($tahun){
        $query = $this->db->get('bobot_awal_lapisan_kerusakan_'.$tahun);
        return $query->result_array();
    }

    public function getBobotAwalInputBiaya($tahun){
        $query = $this->db->get('bobot_awal_input_biaya_'.$tahun);
        return $query->result_array();
    }

    public function getBobotAwalBiasBiaya($tahun){
        $query = $this->db->get('bobot_awal_bias_biaya_'.$tahun);
        return $query->result_array();
    }

    public function getBobotAwalLapisanBiaya($tahun){
        $query = $this->db->get('bobot_awal_lapisan_biaya_'.$tahun);
        return $query->result_array();
    }

    public function getBobotAwalInputRehab(){
        $query = $this->db->get('bobot_awal_input_rehab');
        return $query->result_array();
    }

    public function getBobotAwalBiasRehab(){
        $query = $this->db->get('bobot_awal_bias_rehab');
        return $query->result_array();
    }

    public function getBobotAwalLapisanRehab(){
        $query = $this->db->get('bobot_awal_lapisan_rehab');
        return $query->result_array();
    }

    public function getBobotAwalInputReplace(){
        $query = $this->db->get('bobot_awal_input_replace');
        return $query->result_array();
    }

    public function getBobotAwalBiasReplace(){
        $query = $this->db->get('bobot_awal_bias_replace');
        return $query->result_array();
    }

    public function getBobotAwalLapisanReplace(){
        $query = $this->db->get('bobot_awal_lapisan_replace');
        return $query->result_array();
    }

    public function getKategoriPenilaianBaru($idJembatan){
        $this->db->select('j.id as id_jembatan, kb.id as id_bobot, kb.nama as nama_bobot, kb.bobot, kn.*');
        $this->db->from('jembatan j');
        $this->db->join('kategori_nilai kn', 'j.id = kn.id_jembatan', 'left');
        $this->db->join('kategori_bobot kb', 'kn.id_kategori = kb.id', 'left');
        $this->db->where('j.id', $idJembatan);
        $this->db->order_by('kb.id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    //insert/update/delete jembatan functions
    public function insertJembatan($params){
        $result = $this->db->insert('jembatan', $params);
        return array($result,$this->db->insert_id());
    }

    public function insertStruktural($params){
        $result = $this->db->insert('struktural', $params);
        return array($result,$this->db->insert_id());
    }

    public function insertFungsional($params){
        $result = $this->db->insert('fungsional', $params);
        return array($result,$this->db->insert_id());
    }

    public function insertNonteknis($params){
        $result = $this->db->insert('non_teknis', $params);
        return array($result,$this->db->insert_id());
    }

    public function insertSkor($params){
        $result = $this->db->insert('skor_prioritas', $params);
        return array($result,$this->db->insert_id());
    }
    
    public function updateJembatan($idJembatan, $params) {
        $this->db->where('id', $idJembatan);
        $this->db->update('jembatan', $params);
    }

    public function updateStruktural($idJembatan, $params) {
        $this->db->where('id_jembatan', $idJembatan);
        $this->db->update('struktural', $params);
    }

    public function updateFungsional($idJembatan, $params) {
        $this->db->where('id_jembatan', $idJembatan);
        $this->db->update('fungsional', $params);
    }

    public function updateNonTeknis($idJembatan, $params) {
        $this->db->where('id_jembatan', $idJembatan);
        $this->db->update('non_teknis', $params);
    }

    public function updateSkor($idJembatan, $params) {
        $this->db->where('id_jembatan', $idJembatan);
        $query = $this->db->update('skor_prioritas', $params);
    }

    public function deleteJembatan($idJembatan) {
        $this->db->where('id', $idJembatan);
        $this->db->delete('jembatan');
    }

    public function deleteStruktural($idJembatan) {
        $this->db->where('id_jembatan', $idJembatan);
        $this->db->delete('struktural');
    }

    public function deleteFungsional($idJembatan) {
        $this->db->where('id_jembatan', $idJembatan);
        $this->db->delete('fungsional');
    }

    public function deleteNonTeknis($idJembatan) {
        $this->db->where('id_jembatan', $idJembatan);
        $this->db->delete('non_teknis');
    }

    public function deleteSkor($idJembatan) {
        $this->db->where('id_jembatan', $idJembatan);
        $this->db->delete('skor_prioritas');
    }

    public function insertNilaiBaru($params) {
        $result = $this->db->insert_batch('kategori_nilai', $params);
        return array($result,$this->db->insert_id());
    }

    public function updateNilaiBaru($conditions, $params) {
        $this->db->where($conditions);
        $this->db->update('kategori_nilai', $params);
    }

    public function deleteNilaiBaru($idJembatan) {
        $this->db->where('id_jembatan', $idJembatan);
        $this->db->delete('kategori_nilai');
    }

}