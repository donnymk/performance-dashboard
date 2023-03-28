<?php
require('razorflow.php');
class SampleDashboard extends StandaloneDashboard {
  public function buildDashboard(){
    $simple = new KPIGroupComponent ('kpi');
    $simple->setDimensions (12, 2);
    $simple->setCaption('Laporan Harian Kandang Farm Kemitraan Broiler');

    $simple->addKPI('beverages', array(
      'caption' => 'Ayam Mati',
      'value' => 559,
      'numberSuffix' => ' units'
    ));
    $simple->addKPI('condiments', array(
      'caption' => 'Condiments',
      'value' => 507,
      'numberSuffix' => ' units'
    ));
    $simple->addKPI('confections', array(
      'caption' => 'Confections',
      'value' => 386,
      'numberSuffix' => ' units'
    ));
    $simple->addKPI('daily_products', array(
      'caption' => 'Daily Products',
      'value' => 393,
      'numberSuffix' => ' units'
    ));

    $this->addComponent ($simple);
  }
}

$db = new SampleDashboard();
$db->renderStandalone();
?>