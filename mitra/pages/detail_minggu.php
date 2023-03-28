<?php
// Require the RazorFlow php wrapper
require('razorflow_php/razorflow.php');

// You can rename the "MyDashboard" class to anything you want
class MyDashboard extends EmbeddedDashboard {
    public function buildDashboard(){
        include "koneksi.php";

        if (isset($_GET['minggu'])){
            $mingguke=$_GET['minggu'];
            if($mingguke==1){
                $awal=1;
                $akhir=7;
            }
            if($mingguke==2){
                $awal=8;
                $akhir=14;
            }
            if($mingguke==3){
                $awal=15;
                $akhir=21;
            }
            if($mingguke==4){
                $awal=22;
                $akhir=28;
            }
            if($mingguke==5){
                $awal=29;
                $akhir=35;
            }
        }

        //seleksi data
        $query_produksi="SELECT tgldocin, ayammasuk FROM produksi WHERE idproduksi=1";
        $jalan_produksi=mysqli_query($koneksi,$query_produksi);

        $query_recording1="SELECT mati, jmlpakan FROM recording WHERE idproduksi=1 AND umur BETWEEN '1' AND '".$akhir."'";
        $jalan_recording1=mysqli_query($koneksi,$query_recording1);

        $query_recording2="SELECT bbrata FROM recording WHERE idproduksi=1 AND umur=".$akhir;
        $jalan_recording2=mysqli_query($koneksi,$query_recording2);

        $query_target="SELECT * FROM target WHERE minggu=".$mingguke;
        $jalan_target=mysqli_query($koneksi,$query_target);

        if($row = mysqli_fetch_assoc($jalan_produksi)){
            $tgldocin = $row['tgldocin'];
            $ayammasuk = $row['ayammasuk'];
        }

        while($row1 = mysqli_fetch_assoc($jalan_recording1)){
            $mati = $row1['mati'];
            $jmlpakan = $row1['jmlpakan'];
            //menjumlahkan ayam yang mati dan jumlah pakan menggunakan array
            $mati_ar[]=$mati;
            $jmlpakan_ar[]=$jmlpakan;
        }
        //hasil penjumlahan tadi dimasukkan ke dua variabel ini
        $totalmati = array_sum($mati_ar);
        $totaljmlpakan = array_sum($jmlpakan_ar);

        if($row2 = mysqli_fetch_assoc($jalan_recording2)){
            $bbrata = $row2['bbrata'];
        }

        /*------------mulai analisis metode KPI (Key Performance Indicators)------------*/
        //1. inisialisasi bobot KPI
        $bobotbbrata=20;
        $bobotdayahidup=25;
        $bobotfi=20;
        $bobotfcr=20;
        $bobotip=15;

        //2. target KPI
        if($baris = mysqli_fetch_assoc($jalan_target)){
           	$targetdayahidup = $baris['targetdayahidup'];
            $targetbbrata = $baris['targetbbrata'];
            $targetfi = $baris['targetfi'];
            $targetfcr = $baris['targetfcr'];
            $targetip = $baris['targetip'];
        }

        //3. pencapaian KPI
        $dayahidup=($ayammasuk-$totalmati)/$ayammasuk*100;
        $fi=(1000*50*$totaljmlpakan)/($ayammasuk-$totalmati);
        $fcr=(1000*50*$totaljmlpakan)/($bbrata*($ayammasuk-$totalmati));
        $ip=($dayahidup*$bbrata*100/($fcr*$akhir))/1000;

        //4. skor tiap KPI
        $skorbbrata=($bbrata/$targetbbrata)*100;
        $skordayahidup=($dayahidup/$targetdayahidup)*100;
        $skorfi=($targetfi/$fi)*100;
        $skorfcr=($targetfcr/$fcr)*100;
        $skorip=($ip/$targetip)*100;

        //5. skor akhir KPI
        $akhirbbrata=$skorbbrata*$bobotbbrata/100;
        $akhirdayahidup=$skordayahidup*$bobotdayahidup/100;
        $akhirfi=$skorfi*$bobotfi/100;
        $akhirfcr=$skorfcr*$bobotfcr/100;
        $akhirip=$skorip*$bobotip/100;
        //rata-rata skor akhir KPI
        $summary=$akhirbbrata+$akhirdayahidup+$akhirfi+$akhirfcr+$akhirip;
        /*--------------------akhir metode KPI :)--------------------*/

        // Build your dashboard here.
		//$this->setDashboardTitle ("Performance Dashboard ".$tgldocin);

        $simple = new KPIGroupComponent ('kpi');
        $simple->setDimensions (12, 2);
        $simple->setCaption('Pencapaian Kinerja Minggu '.$mingguke);

        $simple->addKPI('bobot', array(
          'caption' => 'Bobot Rata',
          'value' => $bbrata,
          'numberSuffix' => ' g'
        ));
        $simple->addKPI('dayahidup', array(
          'caption' => 'Daya Hidup',
          'value' => $dayahidup,
          'numberSuffix' => ' %'
        ));
        $simple->addKPI('fi', array(
          'caption' => 'Feed Intake',
          'value' => $fi
        ));
        $simple->addKPI('fcr', array(
          'caption' => 'Feed Convertion Ratio',
          'value' => $fcr
        ));
        $simple->addKPI('IP', array(
          'caption' => 'Index Performance',
          'value' => $ip
        ));

        $this->addComponent ($simple);

		$chart = new ChartComponent("minggu");
		$chart->setCaption("Skor Minggu ".$mingguke);
		$chart->setDimensions (6,4);
		$chart->setLabels (array("Bobot rata", "Daya Hidup", "Feed Intake", "Feed Convertion Ratio", "Index Performance"));
        $chart->addSeries ("Pencapaian", "Pencapaian", array($skorbbrata, $skordayahidup, $skorfi, $skorfcr, $skorip), array(
		//'numberPrefix' => "$",
		'seriesDisplayType' => "area"
    ));
        $chart->addSeries ("Target", "Target", array(100, 100, 100, 100, 100), array(
		//'numberPrefix' => "$",
		'seriesDisplayType' => "line"
    ));
        $chart->setYAxis('Skor', array("numberHumanize"=> false));
        $this->addComponent ($chart);

        $kpi = new GaugeComponent ("kpiminggu");
        $kpi->setDimensions (6, 4);
        $kpi->setCaption ("Skor Akhir Minggu ".$mingguke);
        $kpi->setLimits (0, 100);
        $kpi->setValue ($summary);
        $this->addComponent ($kpi);

  }
}

?>