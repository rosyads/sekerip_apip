<?php
include 'header.php';
$tanggal = date("Y-m");
$tahun = date("Y");
// $tanggal = "2020-11";
// $tahun = "2020";

$nama_kelas = [];
$array_kualifikasi_bayar = [];
$array_hasil_bayar = [];

$array_kualifikasi_absen = [];
$array_hasil_absen = [];

$array_hasil = [];

$setMinus = 300000;

$hasil_akhir_mtk = false;
$hasil_akhir_pjok = false;
$hasil_akhir_ipa = false;
$hasil_akhir_agama = false;
$hasil_akhir_ind = false;
$hasil_akhir_ing = false;
$hasil_akhir_sund = false;
$hasil_akhir_senbud = false;
$hasil_akhir_ips = false;
$hasil_akhir_pkn = false;

$hasil_bayar = false;

function kualifikasiBayar($awalBulan, $akhirBulan)
{
    for ($x = $awalBulan; $x <= $akhirBulan; $x++) {
        global $tahun;
        global $link;

        global $array_kualifikasi_bayar;
        global $array_hasil_bayar;

        $bulanTahun = $tahun . "-" . str_pad($x, 2, "0", STR_PAD_LEFT);
        $sql = "SELECT * FROM bayar WHERE SUBSTRING(tanggal_bayar,1,7) = '$bulanTahun'";
        $res = mysqli_query($link, $sql);
        $ketemu = mysqli_num_rows($res);

        if ($ketemu) {
            foreach ($res as $data) {
                if (empty($array_kualifikasi_bayar)) {
                    array_push($array_kualifikasi_bayar, array("nis" => $data['nis'], "nominal" => $data['nominal']));
                } else {
                    $i = 0;
                    while ($i < sizeof($array_kualifikasi_bayar)) {
                        if ($array_kualifikasi_bayar[$i]["nis"] == $data['nis']) {
                            $array_kualifikasi_bayar[$i]["nominal"] = $array_kualifikasi_bayar[$i]["nominal"] + $data['nominal'];
                        }

                        $i++;
                    }
                }
            }
        }
    }

    $j = 0;
    while ($j < sizeof($array_kualifikasi_bayar)) {
        if ($array_kualifikasi_bayar[$j]["nominal"] < 300000) {
            $minus = 300000 - $array_kualifikasi_bayar[$j]["nominal"];
            array_push($array_hasil_bayar, array("nis" => $array_kualifikasi_bayar[$j]["nis"], "kurang" => $minus, "hasil" => "Ada tunggakan"));
        } else {
            array_push($array_hasil_bayar, array("nis" => $array_kualifikasi_bayar[$j]["nis"], "kurang" => 0, "hasil" => "Tidak ada tunggakan"));
        }

        $j++;
    }
}

function kualifikasiAbsen($awalBulan, $akhirBulan)
{
    for ($x = $awalBulan; $x <= $akhirBulan; $x++) {
        global $tahun;
        global $link;

        global $array_kualifikasi_absen;
        global $array_hasil_absen;

        $bulanTahun = $tahun . "-" . str_pad($x, 2, "0", STR_PAD_LEFT);
        $sql = "SELECT absen.tanggal_absen, absen.nis, kelas.nama_kelas, mata_pelajaran.nama_matpel, siswa.Agama FROM absen 
                INNER JOIN siswa
                    ON absen.nis=siswa.nis 
                INNER JOIN kelas
                    ON absen.id_kelas=kelas.id_kelas 
                INNER JOIN guru
                    ON absen.kd_guru=guru.kd_guru 
                INNER JOIN mata_pelajaran 
                    ON guru.id_matpel=mata_pelajaran.id_matpel 
                WHERE SUBSTRING(tanggal_absen,1,7) = '$bulanTahun'";
        $res = mysqli_query($link, $sql);
        $ketemu = mysqli_num_rows($res);

        if ($ketemu) {
            foreach ($res as $data) {
                if (empty($array_kualifikasi_absen)) {
                    //Cek kelas angkatan
                    if (substr($data["nama_kelas"], 0, 1) == "8") {
                        //Untuk kelas 8

                        //inisialisasi data array
                        array_push($array_kualifikasi_absen, array(
                            "nis" => $data['nis'],
                            "kelas" => "8",
                            "matematika" => 0,
                            "pjok" => 0,
                            "bahasa" => 0,
                            "english" => 0,
                            "sunda" => 0,
                            "senbud" => 0,
                            "ipa" => 0,
                            "pkn" => 0,
                            "ips" => 0,
                        ));

                        //Set data pertama
                        switch ($data["nama_matpel"]) {
                            case 'Matematika':
                                # code...
                                $array_kualifikasi_absen[0]["matematika"]++;
                                break;
                            case 'PJOK':
                                # code...
                                $array_kualifikasi_absen[0]["pjok"]++;
                                break;
                            case 'Bahasa Indonesia':
                                # code...
                                $array_kualifikasi_absen[0]["bahasa"]++;
                                break;
                            case 'Bahasa Inggris':
                                # code...
                                $array_kualifikasi_absen[0]["english"]++;
                                break;
                            case 'Bahasa Sunda':
                                # code...
                                $array_kualifikasi_absen[0]["sunda"]++;
                                break;
                            case 'Seni Budaya':
                                # code...
                                $array_kualifikasi_absen[0]["senbud"]++;
                                break;
                            case 'IPA':
                                # code...
                                $array_kualifikasi_absen[0]["ipa"]++;
                                break;
                            case 'PPKn':
                                # code...
                                $array_kualifikasi_absen[0]["pkn"]++;
                                break;
                            case 'IPS':
                                # code...
                                $array_kualifikasi_absen[0]["ips"]++;
                                break;

                            default:
                                # code...
                                break;
                        }
                    } else if (substr($data["nama_kelas"], 0, 1) == "9") {
                        //untuk kelas 9

                        //Cek agama
                        if ($data['Agama'] == "ISLAM") {
                            //inisialisasi data array
                            array_push($array_kualifikasi_absen, array(
                                "nis" => $data['nis'],
                                "kelas" => "9",
                                "matematika" => 0,
                                "pjok" => 0,
                                "bahasa" => 0,
                                "english" => 0,
                                "sunda" => 0,
                                "senbud" => 0,
                                "islam" => 0,
                                "ipa" => 0,
                                "pkn" => 0,
                                "ips" => 0,
                            ));

                            //Set data pertama
                            switch ($data["nama_matpel"]) {
                                case 'Matematika':
                                    # code...
                                    $array_kualifikasi_absen[0]["matematika"]++;
                                    break;
                                case 'PJOK':
                                    # code...
                                    $array_kualifikasi_absen[0]["pjok"]++;
                                    break;
                                case 'Bahasa Indonesia':
                                    # code...
                                    $array_kualifikasi_absen[0]["bahasa"]++;
                                    break;
                                case 'Bahasa Inggris':
                                    # code...
                                    $array_kualifikasi_absen[0]["english"]++;
                                    break;
                                case 'Bahasa Sunda':
                                    # code...
                                    $array_kualifikasi_absen[0]["sunda"]++;
                                    break;
                                case 'Seni Budaya':
                                    # code...
                                    $array_kualifikasi_absen[0]["senbud"]++;
                                    break;
                                case 'Pendidikan Agama Islam':
                                    # code...
                                    $array_kualifikasi_absen[0]["islam"]++;
                                    break;
                                case 'IPA':
                                    # code...
                                    $array_kualifikasi_absen[0]["ipa"]++;
                                    break;
                                case 'PPKn':
                                    # code...
                                    $array_kualifikasi_absen[0]["pkn"]++;
                                    break;
                                case 'IPS':
                                    # code...
                                    $array_kualifikasi_absen[0]["ips"]++;
                                    break;

                                default:
                                    # code...
                                    break;
                            }
                        } else if ($data['Agama'] == "PROTESTAN") {
                            //inisialisasi data array
                            array_push($array_kualifikasi_absen, array(
                                "nis" => $data['nis'],
                                "kelas" => "9",
                                "matematika" => 0,
                                "pjok" => 0,
                                "bahasa" => 0,
                                "english" => 0,
                                "sunda" => 0,
                                "senbud" => 0,
                                "kristen" => 0,
                                "ipa" => 0,
                                "pkn" => 0,
                                "ips" => 0,
                            ));

                            //Set data pertama
                            switch ($data["nama_matpel"]) {
                                case 'Matematika':
                                    # code...
                                    $array_kualifikasi_absen[0]["matematika"]++;
                                    break;
                                case 'PJOK':
                                    # code...
                                    $array_kualifikasi_absen[0]["pjok"]++;
                                    break;
                                case 'Bahasa Indonesia':
                                    # code...
                                    $array_kualifikasi_absen[0]["bahasa"]++;
                                    break;
                                case 'Bahasa Inggris':
                                    # code...
                                    $array_kualifikasi_absen[0]["english"]++;
                                    break;
                                case 'Bahasa Sunda':
                                    # code...
                                    $array_kualifikasi_absen[0]["sunda"]++;
                                    break;
                                case 'Seni Budaya':
                                    # code...
                                    $array_kualifikasi_absen[0]["senbud"]++;
                                    break;
                                case 'Pendidikan Agama Kristen':
                                    # code...
                                    $array_kualifikasi_absen[0]["kristen"]++;
                                    break;
                                case 'IPA':
                                    # code...
                                    $array_kualifikasi_absen[0]["ipa"]++;
                                    break;
                                case 'PPKn':
                                    # code...
                                    $array_kualifikasi_absen[0]["pkn"]++;
                                    break;
                                case 'IPS':
                                    # code...
                                    $array_kualifikasi_absen[0]["ips"]++;
                                    break;

                                default:
                                    # code...
                                    break;
                            }
                        }
                    }
                } else {
                    $i = 0;
                    while ($i < sizeof($array_kualifikasi_absen)) {
                        if ($array_kualifikasi_absen[$i]["nis"] == $data['nis']) {
                            //Cek kelas angkatan
                            if (substr($data["nama_kelas"], 0, 1) == "8") {
                                //Untuk kelas 8

                                //Set data
                                switch ($data["nama_matpel"]) {
                                    case 'Matematika':
                                        # code...
                                        $array_kualifikasi_absen[$i]["matematika"]++;
                                        break;
                                    case 'PJOK':
                                        # code...
                                        $array_kualifikasi_absen[$i]["pjok"]++;
                                        break;
                                    case 'Bahasa Indonesia':
                                        # code...
                                        $array_kualifikasi_absen[$i]["bahasa"]++;
                                        break;
                                    case 'Bahasa Inggris':
                                        # code...
                                        $array_kualifikasi_absen[$i]["english"]++;
                                        break;
                                    case 'Bahasa Sunda':
                                        # code...
                                        $array_kualifikasi_absen[$i]["sunda"]++;
                                        break;
                                    case 'Seni Budaya':
                                        # code...
                                        $array_kualifikasi_absen[$i]["senbud"]++;
                                        break;
                                    case 'IPA':
                                        # code...
                                        $array_kualifikasi_absen[$i]["ipa"]++;
                                        break;
                                    case 'PPKn':
                                        # code...
                                        $array_kualifikasi_absen[$i]["pkn"]++;
                                        break;
                                    case 'IPS':
                                        # code...
                                        $array_kualifikasi_absen[$i]["ips"]++;
                                        break;

                                    default:
                                        # code...
                                        break;
                                }
                            } else if (substr($data["nama_kelas"], 0, 1) == "9") {
                                //untuk kelas 9

                                //Cek agama
                                if ($data['Agama'] == "ISLAM") {
                                    //Set data
                                    switch ($data["nama_matpel"]) {
                                        case 'Matematika':
                                            # code...
                                            $array_kualifikasi_absen[$i]["matematika"]++;
                                            break;
                                        case 'PJOK':
                                            # code...
                                            $array_kualifikasi_absen[$i]["pjok"]++;
                                            break;
                                        case 'Bahasa Indonesia':
                                            # code...
                                            $array_kualifikasi_absen[$i]["bahasa"]++;
                                            break;
                                        case 'Bahasa Inggris':
                                            # code...
                                            $array_kualifikasi_absen[$i]["english"]++;
                                            break;
                                        case 'Bahasa Sunda':
                                            # code...
                                            $array_kualifikasi_absen[$i]["sunda"]++;
                                            break;
                                        case 'Seni Budaya':
                                            # code...
                                            $array_kualifikasi_absen[$i]["senbud"]++;
                                            break;
                                        case 'Pendidikan Agama Islam':
                                            # code...
                                            $array_kualifikasi_absen[$i]["islam"]++;
                                            break;
                                        case 'IPA':
                                            # code...
                                            $array_kualifikasi_absen[$i]["ipa"]++;
                                            break;
                                        case 'PPKn':
                                            # code...
                                            $array_kualifikasi_absen[$i]["pkn"]++;
                                            break;
                                        case 'IPS':
                                            # code...
                                            $array_kualifikasi_absen[$i]["ips"]++;
                                            break;

                                        default:
                                            # code...
                                            break;
                                    }
                                } else if ($data['Agama'] == "PROTESTAN") {
                                    //Set data
                                    switch ($data["nama_matpel"]) {
                                        case 'Matematika':
                                            # code...
                                            $array_kualifikasi_absen[$i]["matematika"]++;
                                            break;
                                        case 'PJOK':
                                            # code...
                                            $array_kualifikasi_absen[$i]["pjok"]++;
                                            break;
                                        case 'Bahasa Indonesia':
                                            # code...
                                            $array_kualifikasi_absen[$i]["bahasa"]++;
                                            break;
                                        case 'Bahasa Inggris':
                                            # code...
                                            $array_kualifikasi_absen[$i]["english"]++;
                                            break;
                                        case 'Bahasa Sunda':
                                            # code...
                                            $array_kualifikasi_absen[$i]["sunda"]++;
                                            break;
                                        case 'Seni Budaya':
                                            # code...
                                            $array_kualifikasi_absen[$i]["senbud"]++;
                                            break;
                                        case 'Pendidikan Agama Kristen':
                                            # code...
                                            $array_kualifikasi_absen[$i]["kristen"]++;
                                            break;
                                        case 'IPA':
                                            # code...
                                            $array_kualifikasi_absen[$i]["ipa"]++;
                                            break;
                                        case 'PPKn':
                                            # code...
                                            $array_kualifikasi_absen[$i]["pkn"]++;
                                            break;
                                        case 'IPS':
                                            # code...
                                            $array_kualifikasi_absen[$i]["ips"]++;
                                            break;

                                        default:
                                            # code...
                                            break;
                                    }
                                }
                            }
                        }

                        $i++;
                    }
                }
            }
        }
    }

    $j = 0;
    while ($j < sizeof($array_kualifikasi_absen)) {
        //set minimal 85%
        $minimal_mtk = 5 * 4 * 3 * 0.85;
        $minimal_pjok = 3 * 4 * 3 * 0.85;
        $minimal_ind = 6 * 4 * 3 * 0.85;
        $minimal_ing = 4 * 4 * 3 * 0.85;
        $minimal_senbud = 3 * 4 * 3 * 0.85;
        $minimal_pkn = 3 * 4 * 3 * 0.85;
        $minimal_ips = 4 * 4 * 3 * 0.85;

        //cek kelas angkatan
        if ($array_kualifikasi_absen[$j]["kelas"] == "8") {
            //untuk kelas 8
            $minimal_sund = 5 * 4 * 3 * 0.85;
            $minimal_ipa = 7 * 4 * 3 * 0.85;

            //cek per matpel
            if ($array_kualifikasi_absen[$j]["matematika"] < $minimal_mtk) {
                $hasil_mtk = 0;
            } else {
                $hasil_mtk = 1;
            }

            if ($array_kualifikasi_absen[$j]["pjok"] < $minimal_pjok) {
                $hasil_pjok = 0;
            } else {
                $hasil_pjok = 1;
            }

            if ($array_kualifikasi_absen[$j]["bahasa"] < $minimal_ind) {
                $hasil_ind = 0;
            } else {
                $hasil_ind = 1;
            }

            if ($array_kualifikasi_absen[$j]["english"] < $minimal_ing) {
                $hasil_ing = 0;
            } else {
                $hasil_ing = 1;
            }

            if ($array_kualifikasi_absen[$j]["sunda"] < $minimal_sund) {
                $hasil_sund = 0;
            } else {
                $hasil_sund = 1;
            }

            if ($array_kualifikasi_absen[$j]["senbud"] < $minimal_senbud) {
                $hasil_senbud = 0;
            } else {
                $hasil_senbud = 1;
            }

            if ($array_kualifikasi_absen[$j]["ipa"] < $minimal_ipa) {
                $hasil_ipa = 0;
            } else {
                $hasil_ipa = 1;
            }

            if ($array_kualifikasi_absen[$j]["pkn"] < $minimal_pkn) {
                $hasil_pkn = 0;
            } else {
                $hasil_pkn = 1;
            }

            if ($array_kualifikasi_absen[$j]["ips"] < $minimal_ips) {
                $hasil_ips = 0;
            } else {
                $hasil_ips = 1;
            }

            array_push($array_hasil_absen, array(
                "nis" => $array_kualifikasi_absen[$j]["nis"],
                "kelas" => "8",
                "mtk" => $hasil_mtk,
                "pjok" => $hasil_pjok,
                "ind" => $hasil_ind,
                "ing" => $hasil_ing,
                "sund" => $hasil_sund,
                "senbud" => $hasil_senbud,
                "ipa" => $hasil_ipa,
                "pkn" => $hasil_pkn,
                "ips" => $hasil_ips,
            ));
        } else if ($array_kualifikasi_absen[$j]["kelas"] == "9") {
            //untuk kelas 9
            $minimal_sund = 4 * 4 * 3 * 0.85;
            $minimal_ipa = 5 * 4 * 3 * 0.85;
            $minimal_agama = 3 * 4 * 3 * 0.85;

            //Cek agama
            if ($data['Agama'] == "ISLAM") {
                //cek per matpel
                if ($array_kualifikasi_absen[$j]["matematika"] < $minimal_mtk) {
                    $hasil_mtk = 0;
                } else {
                    $hasil_mtk = 1;
                }

                if ($array_kualifikasi_absen[$j]["pjok"] < $minimal_pjok) {
                    $hasil_pjok = 0;
                } else {
                    $hasil_pjok = 1;
                }

                if ($array_kualifikasi_absen[$j]["bahasa"] < $minimal_ind) {
                    $hasil_ind = 0;
                } else {
                    $hasil_ind = 1;
                }

                if ($array_kualifikasi_absen[$j]["english"] < $minimal_ing) {
                    $hasil_ing = 0;
                } else {
                    $hasil_ing = 1;
                }

                if ($array_kualifikasi_absen[$j]["sunda"] < $minimal_sund) {
                    $hasil_sund = 0;
                } else {
                    $hasil_sund = 1;
                }

                if ($array_kualifikasi_absen[$j]["senbud"] < $minimal_senbud) {
                    $hasil_senbud = 0;
                } else {
                    $hasil_senbud = 1;
                }

                if ($array_kualifikasi_absen[$j]["ipa"] < $minimal_ipa) {
                    $hasil_ipa = 0;
                } else {
                    $hasil_ipa = 1;
                }

                if ($array_kualifikasi_absen[$j]["pkn"] < $minimal_pkn) {
                    $hasil_pkn = 0;
                } else {
                    $hasil_pkn = 1;
                }

                if ($array_kualifikasi_absen[$j]["ips"] < $minimal_ips) {
                    $hasil_ips = 0;
                } else {
                    $hasil_ips = 1;
                }

                if ($array_kualifikasi_absen[$j]["islam"] < $minimal_agama) {
                    $hasil_agama = 0;
                } else {
                    $hasil_agama = 1;
                }

                array_push($array_hasil_absen, array(
                    "nis" => $array_kualifikasi_absen[$j]["nis"],
                    "kelas" => "9",
                    "mtk" => $hasil_mtk,
                    "pjok" => $hasil_pjok,
                    "ind" => $hasil_ind,
                    "ing" => $hasil_ing,
                    "sund" => $hasil_sund,
                    "senbud" => $hasil_senbud,
                    "ipa" => $hasil_ipa,
                    "pkn" => $hasil_pkn,
                    "ips" => $hasil_ips,
                    "agama" => $hasil_agama,
                ));
            } else if ($data['Agama'] == "PROTESTAN") {
                //cek per matpel
                if ($array_kualifikasi_absen[$j]["matematika"] < $minimal_mtk) {
                    $hasil_mtk = 0;
                } else {
                    $hasil_mtk = 1;
                }

                if ($array_kualifikasi_absen[$j]["pjok"] < $minimal_pjok) {
                    $hasil_pjok = 0;
                } else {
                    $hasil_pjok = 1;
                }

                if ($array_kualifikasi_absen[$j]["bahasa"] < $minimal_ind) {
                    $hasil_ind = 0;
                } else {
                    $hasil_ind = 1;
                }

                if ($array_kualifikasi_absen[$j]["english"] < $minimal_ing) {
                    $hasil_ing = 0;
                } else {
                    $hasil_ing = 1;
                }

                if ($array_kualifikasi_absen[$j]["sunda"] < $minimal_sund) {
                    $hasil_sund = 0;
                } else {
                    $hasil_sund = 1;
                }

                if ($array_kualifikasi_absen[$j]["senbud"] < $minimal_senbud) {
                    $hasil_senbud = 0;
                } else {
                    $hasil_senbud = 1;
                }

                if ($array_kualifikasi_absen[$j]["ipa"] < $minimal_ipa) {
                    $hasil_ipa = 0;
                } else {
                    $hasil_ipa = 1;
                }

                if ($array_kualifikasi_absen[$j]["pkn"] < $minimal_pkn) {
                    $hasil_pkn = 0;
                } else {
                    $hasil_pkn = 1;
                }

                if ($array_kualifikasi_absen[$j]["ips"] < $minimal_ips) {
                    $hasil_ips = 0;
                } else {
                    $hasil_ips = 1;
                }

                if ($array_kualifikasi_absen[$j]["kristen"] < $minimal_agama) {
                    $hasil_agama = 0;
                } else {
                    $hasil_agama = 1;
                }

                array_push($array_hasil_absen, array(
                    "nis" => $array_kualifikasi_absen[$j]["nis"],
                    "kelas" => "9",
                    "mtk" => $hasil_mtk,
                    "pjok" => $hasil_pjok,
                    "ind" => $hasil_ind,
                    "ing" => $hasil_ing,
                    "sund" => $hasil_sund,
                    "senbud" => $hasil_senbud,
                    "ipa" => $hasil_ipa,
                    "pkn" => $hasil_pkn,
                    "ips" => $hasil_ips,
                    "agama" => $hasil_agama,
                ));
            }
        }
        $j++;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SMP Ganesa Satria - Keuangan</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include 'sidebar.html'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php include 'topbar.html'; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Keuangan</h1>

                    <!-- query ambil data -->
                    <?php

                    //Cek kualifikasi
                    if (substr($tanggal, 5) >= 1 && substr($tanggal, 5) <= 3) {
                        //UTS
                        kualifikasiBayar(1, 3);
                        kualifikasiAbsen(1, 3);
                    } else if (substr($tanggal, 5) >= 4 && substr($tanggal, 5) <= 6) {
                        //UAS
                        kualifikasiBayar(4, 6);
                        kualifikasiAbsen(4, 6);
                    } elseif (substr($tanggal, 5) >= 7 && substr($tanggal, 5) <= 9) {
                        //UTS
                        kualifikasiBayar(7, 9);
                        kualifikasiAbsen(7, 9);
                    } elseif (substr($tanggal, 5) >= 10 && substr($tanggal, 5) <= 12) {
                        //UAS
                        kualifikasiBayar(10, 12);
                        kualifikasiAbsen(10, 12);
                    }

                    $sql = "SELECT * FROM kelas
                    ORDER BY nama_kelas ASC";
                    $res = mysqli_query($link, $sql);
                    $ketemu = mysqli_num_rows($res);

                    if ($ketemu) {
                        $jml_kelas = 0;
                        foreach ($res as $data) {
                            array_push($nama_kelas, $data["nama_kelas"]);
                        }
                        while ($jml_kelas < $ketemu) {
                            $sql = "SELECT siswa.*
                                    FROM siswa
                                    INNER JOIN kelas
                                    ON siswa.id_kelas = kelas.id_kelas
                                    WHERE kelas.nama_kelas = '$nama_kelas[$jml_kelas]'
                                    ORDER BY nama ASC";
                            $res = mysqli_query($link, $sql);
                            $found = mysqli_num_rows($res);

                    ?>
                    <!-- end query ambil data -->

                    <!-- tabel pembayaran -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran SPP Kelas <?php echo $nama_kelas[$jml_kelas]; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable<?php echo $nama_kelas[$jml_kelas]; ?>" width="100%" cellspacing="0">
                                    <thead>
                                        <tr> <center>
                                            <th rowSpan="2">NIS</th>
                                            <th rowSpan="2">Nama</th>
                                            <th rowSpan="2">Status Pembayaran</th>
                                            <th rowSpan="2">Kekurangan</th>
                                            <?php 
                                                if(substr($nama_kelas[$jml_kelas],0,1) == "8"){ ?>
                                                    <th colSpan="9">Mata Pelajaran</th>
                                            <?php
                                                }else if(substr($nama_kelas[$jml_kelas],0,1) == "9"){ ?>
                                                    <th colSpan="11">Mata Pelajaran</th>
                                            <?php                                                    
                                                }
                                            ?>
                                        </tr>
                                        <tr>
                                            <th>Matematika</th>
                                            <th>PJOK</th>
                                            <th>Bahasa Indonesia</th>
                                            <th>Bahasa Inggris</th>
                                            <th>Bahasa Sunda</th>
                                            <th>Seni Budaya</th>
                                            <?php 
                                                if(substr($nama_kelas[$jml_kelas],0,1) == "9"){ ?>
                                                    <th>Pendidikan Agama Islam</th>
                                                    <th>Pendidikan Agama Kristen</th>
                                            <?php                                                    
                                                }
                                            ?>
                                            <th>IPA</th>
                                            <th>PPKn</th>
                                            <th>IPS</th>
                                        </tr> </center>
                                    </thead>
                                    <tbody> <center>
                                        <?php
                                        if ($found) {
                                            foreach ($res as $data) {
                                                $i = 0;
                                                while ($i < sizeof($array_hasil_bayar)) {
                                                    if ($array_hasil_bayar[$i]["nis"] == $data['nis']) {
                                                        if($array_hasil_bayar[$i]["hasil"] == "Ada tunggakan"){
                                                            $setMinus = $array_hasil_bayar[$i]["kurang"];
                                                            $hasil_bayar = false;
                                                        }else{
                                                            $setMinus = 0;
                                                            $hasil_bayar = true;
                                                        }
                                                        // break;
                                                    }

                                                    $i++;
                                                }

                                                $j = 0;
                                                while ($j < sizeof($array_hasil_absen)) {
                                                    if ($array_hasil_absen[$j]["nis"] == $data['nis']) {
                                                        if($array_hasil_absen[$j]["kelas"] == "8"){
                                                            //kelas 8
                                                            if($array_hasil_absen[$j]["mtk"] == 0){
                                                                $hasil_akhir_mtk = false;
                                                            }else{
                                                                $hasil_akhir_mtk = true;
                                                            }

                                                            if($array_hasil_absen[$j]["pjok"] == 0){
                                                                $hasil_akhir_pjok = false;
                                                            }else{
                                                                $hasil_akhir_pjok = true;
                                                            }

                                                            if($array_hasil_absen[$j]["ind"] == 0){
                                                                $hasil_akhir_ind = false;
                                                            }else{
                                                                $hasil_akhir_ind = true;
                                                            }

                                                            if($array_hasil_absen[$j]["ing"] == 0){
                                                                $hasil_akhir_ing = false;
                                                            }else{
                                                                $hasil_akhir_ing = true;
                                                            }

                                                            if($array_hasil_absen[$j]["sund"] == 0){
                                                                $hasil_akhir_sund = false;
                                                            }else{
                                                                $hasil_akhir_sund = true;
                                                            }

                                                            if($array_hasil_absen[$j]["senbud"] == 0){
                                                                $hasil_akhir_senbud = false;
                                                            }else{
                                                                $hasil_akhir_senbud = true;
                                                            }

                                                            if($array_hasil_absen[$j]["ipa"] == 0){
                                                                $hasil_akhir_ipa = false;
                                                            }else{
                                                                $hasil_akhir_ipa = true;
                                                            }

                                                            if($array_hasil_absen[$j]["pkn"] == 0){
                                                                $hasil_akhir_pkn = false;
                                                            }else{
                                                                $hasil_akhir_pkn = true;
                                                            }

                                                            if($array_hasil_absen[$j]["ips"] == 0){
                                                                $hasil_akhir_ips = false;
                                                            }else{
                                                                $hasil_akhir_ips = true;
                                                            }

                                                            // break;
                                                        }else if($array_hasil_absen[$j]["kelas"] == "9"){
                                                            //kelas 9
                                                            if($array_hasil_absen[$j]["mtk"] == 0){
                                                                $hasil_akhir_mtk = false;
                                                            }else{
                                                                $hasil_akhir_mtk = true;
                                                            }

                                                            if($array_hasil_absen[$j]["pjok"] == 0){
                                                                $hasil_akhir_pjok = false;
                                                            }else{
                                                                $hasil_akhir_pjok = true;
                                                            }

                                                            if($array_hasil_absen[$j]["ind"] == 0){
                                                                $hasil_akhir_ind = false;
                                                            }else{
                                                                $hasil_akhir_ind = true;
                                                            }

                                                            if($array_hasil_absen[$j]["ing"] == 0){
                                                                $hasil_akhir_ing = false;
                                                            }else{
                                                                $hasil_akhir_ing = true;
                                                            }

                                                            if($array_hasil_absen[$j]["sund"] == 0){
                                                                $hasil_akhir_sund = false;
                                                            }else{
                                                                $hasil_akhir_sund = true;
                                                            }

                                                            if($array_hasil_absen[$j]["senbud"] == 0){
                                                                $hasil_akhir_senbud = false;
                                                            }else{
                                                                $hasil_akhir_senbud = true;
                                                            }

                                                            if($array_hasil_absen[$j]["ipa"] == 0){
                                                                $hasil_akhir_ipa = false;
                                                            }else{
                                                                $hasil_akhir_ipa = true;
                                                            }

                                                            if($array_hasil_absen[$j]["pkn"] == 0){
                                                                $hasil_akhir_pkn = false;
                                                            }else{
                                                                $hasil_akhir_pkn = true;
                                                            }

                                                            if($array_hasil_absen[$j]["ips"] == 0){
                                                                $hasil_akhir_ips = false;
                                                            }else{
                                                                $hasil_akhir_ips = true;
                                                            }

                                                            if($array_hasil_absen[$j]["agama"] == 0){
                                                                $hasil_akhir_agama = false;
                                                            }else{
                                                                $hasil_akhir_agama = true;
                                                            }

                                                            // break;
                                                        }
                                                    }

                                                    $j++;
                                                }

                                                if(!$hasil_bayar){
                                        ?>
                                                <tr> <center>
                                                    <td><?php echo "$data[nis]"; ?></td>
                                                    <td><?php echo "$data[nama]"; ?></td>
                                                    <!-- <td style="background-color:#ff0000;"><?php //echo "Ada Tunggakan"; ?></td>
                                                    <td style="background-color:#ff0000;"><?php //echo $setMinus; ?></td> -->
                                                    <td><?php echo "Ada Tunggakan"; ?></td>
                                                    <td><?php echo $setMinus; ?></td>
                                                <!-- matematika -->
                                                <?php
                                                    if(!$hasil_akhir_mtk){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- pjok -->
                                                <?php
                                                    if(!$hasil_akhir_pjok){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- bhs. indonesia -->
                                                <?php
                                                    if(!$hasil_akhir_ind){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- bhs. inggris -->
                                                <?php
                                                    if(!$hasil_akhir_ing){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- bhs. sunda -->
                                                <?php
                                                    if(!$hasil_akhir_sund){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- seni budaya -->
                                                <?php
                                                    if(!$hasil_akhir_senbud){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- agama -->
                                                <?php
                                                    if(substr($nama_kelas[$jml_kelas],0,1) == "9"){
                                                        if($data['Agama'] == "ISLAM"){
                                                            if(!$hasil_akhir_agama){ ?>
                                                                <td>&#10006;</td>
                                                                <td>-</td>
                                                            <?php        
                                                                }else{ ?>
                                                                    <td>&#10004;</td>
                                                                    <td>-</td>
                                                            <?php
                                                                }
                                                             
                                                        }else if($data['Agama'] == "PROTESTAN"){
                                                            if(!$hasil_akhir_agama){ ?>
                                                                <td>-</td>
                                                                <td>&#10006;</td>
                                                            <?php        
                                                                }else{ ?>
                                                                    <td>-</td>
                                                                    <td>&#10004;</td>
                                                            <?php
                                                                }
                                                        }
                                                    }
                                                ?>   

                                                <!-- ipa -->
                                                <?php
                                                    if(!$hasil_akhir_ipa){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- pkn -->
                                                <?php
                                                    if(!$hasil_akhir_pkn){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- ips -->
                                                <?php
                                                    if(!$hasil_akhir_ips){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>
                    
                                                <?php
                                                }else{ //kalo gaada tunggakan.. untuk hasil akhir, hapus dari else...
                                                    ?>
                                                <tr>
                                                    <td><?php echo "$data[nis]"; ?></td>
                                                    <td><?php echo "$data[nama]"; ?></td>
                                                    <!-- <td style="background-color:#ff0000;"><?php //echo "Ada Tunggakan"; ?></td>
                                                    <td style="background-color:#ff0000;"><?php //echo $setMinus; ?></td> -->
                                                    <td><?php echo "Tidak ada Tunggakan"; ?></td>
                                                    <td><?php echo $setMinus; ?></td>
                                                <!-- matematika -->
                                                <?php
                                                    if(!$hasil_akhir_mtk){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- pjok -->
                                                <?php
                                                    if(!$hasil_akhir_pjok){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- bhs. indonesia -->
                                                <?php
                                                    if(!$hasil_akhir_ind){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- bhs. inggris -->
                                                <?php
                                                    if(!$hasil_akhir_ing){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- bhs. sunda -->
                                                <?php
                                                    if(!$hasil_akhir_sund){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- seni budaya -->
                                                <?php
                                                    if(!$hasil_akhir_senbud){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- agama -->
                                                <?php
                                                    if(substr($nama_kelas[$jml_kelas],0,1) == "9"){
                                                        if($data['Agama'] == "ISLAM"){
                                                            if(!$hasil_akhir_agama){ ?>
                                                                <td>&#10006;</td>
                                                                <td>-</td>
                                                            <?php        
                                                                }else{ ?>
                                                                    <td>&#10004;</td>
                                                                    <td>-</td>
                                                            <?php
                                                                }
                                                             
                                                        }else if($data['Agama'] == "PROTESTAN"){
                                                            if(!$hasil_akhir_agama){ ?>
                                                                <td>-</td>
                                                                <td>&#10006;</td>
                                                            <?php        
                                                                }else{ ?>
                                                                    <td>-</td>
                                                                    <td>&#10004;</td>
                                                            <?php
                                                                }
                                                        }
                                                    }
                                                ?>   

                                                <!-- ipa -->
                                                <?php
                                                    if(!$hasil_akhir_ipa){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- pkn -->
                                                <?php
                                                    if(!$hasil_akhir_pkn){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }
                                                ?>

                                                <!-- ips -->
                                                <?php
                                                    if(!$hasil_akhir_ips){ ?>
                                                        <td>&#10006;</td>
                                                <?php        
                                                    }else{ ?>
                                                        <td>&#10004;</td>
                                                <?php
                                                    }

                                                } // ...sampe sini

                                                $setMinus = 300000;

                                                $hasil_akhir_mtk = false;
                                                $hasil_akhir_pjok = false;
                                                $hasil_akhir_ipa = false;
                                                $hasil_akhir_agama = false;
                                                $hasil_akhir_ind = false;
                                                $hasil_akhir_ing = false;
                                                $hasil_akhir_sund = false;
                                                $hasil_akhir_senbud = false;
                                                $hasil_akhir_ips = false;
                                                $hasil_akhir_pkn = false;

                                                $hasil_bayar = false;

                                            }
                                        } else { ?>
                                                <tr>
                                                    <td colspan="15">
                                                        <center>Tidak ada data.
                                                    </td>
                                                    <center>
                                                </tr><?php
                                                    }
                                                        ?>
                                    </tbody> </center>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end tabel pembayaran -->
                    <?php

                            $jml_kelas++;
                        }
                    }

                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include '../footer.html'; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <?php include "../logout_modal.html" ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>