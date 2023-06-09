<?php
// Require the RazorFlow php wrapper
require('razorflow.php');
// You can rename the "MyDashboard" class to anything you want


class SalesDashboard extends Dashboard {
  public function buildDashboard(){
    $chart = new ChartComponent("chart1");
    $chart->setCaption("The first Chart");
    $chart->setDimensions (4, 4);
    $chart->setLabels (["Jan", "Feb", "Mar"]);
    $chart->addSeries ("beverages", "Beverages", array(1355, 1916, 1150));
    $chart->addSeries ("packaged_foods", "Packaged Foods", array(1513, 976, 1321));

    $this->setDashboardTitle('Sales');
    $this->setActive();
    $this->addComponent ($chart);
  }
}

class UsersDashboard extends Dashboard {

  public function buildDashboard() {
    $kpi = new KPIComponent('kpi');
    $kpi->setDimensions(3, 3);
    $kpi->setCaption('Online Users');
    $kpi->setValue(10);

    $this->setDashboardTitle('Online Users');
    $this->addComponent($kpi);
  }
}


class MyDashboard extends TabbedDashboard {
  public function buildDashboard () {
    $sales = new SalesDashboard();
    $users = new UsersDashboard();

    $this->setTabbedDashboardTitle("Tabbed Dashboard");
    $this->addDashboardTab($sales);
    $this->addDashboardTab($users);
  }
}

$dashboard = new MyDashboard ();
$dashboard->renderStandalone ();
?>