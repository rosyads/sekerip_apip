<?php 
    include '../phpqrcode/qrlib.php';

    $kode = $_GET['id'];
    QRcode::png($kode);

    include 'data_guru.php';
?>