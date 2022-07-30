<?php

/*
function untuk print_r yang lebih rapi
*/
function pre_print_r($arr)
{
	echo "<pre>";print_r($arr);echo "</pre>";
}

/*
function untuk convert tanggal menjadi format tanggal Indonesia
format date pada input $date_time harus YYYY-mm-dd
*/
function convert_tanggal($date_time)
{
    $bulan = array (
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $tanggal = explode(' ',$date_time);
    $pecahkan = explode('-', $tanggal[0]);
    
    // variabel pecahkan 0 = tahun
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tanggal

    return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0].' '.$tanggal[1];

}
