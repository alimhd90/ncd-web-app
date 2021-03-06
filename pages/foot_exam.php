<?php
  include_once('../php/connection.php');
  include_once('../php/getFootExam.php');
  
?>
<!DOCTYPE html>
<html>
<head>
  <title>NCD Web Application</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="icon" href="../images/Medair_Logo_2013.png">
  <link rel="stylesheet" href="../css/vert_tabs.css">
  <link rel="stylesheet" href="../css/textbox.css">
  <style type="text/css" media="print">
    @media print{@page {size: landscape}}
  </style>
</head>
<body>
  <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#"><img src="../images/medair_icon.png""></a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php"> <i class="fa fa-home fa-fw" aria-hidden="true"></i>Home </a>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link active dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Patients
            </a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="patient.php">New Patient</a>
              <a class="dropdown-item" href="patient_profile.php">Patient Profile</a>
              <a class="dropdown-item" href="edit.php">Edit Profile and/or History</a>
              <a class="dropdown-item active" href="diabetes.php">Diabetes List</a>
              <a class="dropdown-item" href="assessment.php">Monthly Assessment Avg</a>
              <a class="dropdown-item" href="labTest.php">Laboratory test Report</a>
              <a class="dropdown-item" href="changeTreatment.php">Change Medication/Treatment</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Visits
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="visit.php">New Visit</a>
              <a class="dropdown-item" href="visit_status.php">Visit Status</a>
              <a class="dropdown-item" href="appointment.php">Next Appointment</a>
              <a class="dropdown-item" href="missed_visit.php">Missed Visit</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-home fa-plus" aria-hidden="true"></i>Pharmacy
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="new_med.php">Medications List</a>
              <a class="dropdown-item" href="new_quantity.php">New Med/Quantity</a>
              <a class="dropdown-item" href="expiredMed.php">Nearly Expired Med</a>
            </div>
          </div>
        </li>
        <li class="nav-item">
          <div class="dropdown">
            <a class="nav-link dropdown-toggle" href="" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-home fa-plus" aria-hidden="true"></i>Reports
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
              <a class="dropdown-item" href="chronic_list.php">Template 3 - Chronic diseases patients</a>
              <a class="dropdown-item" href="clinic_month_report.php">Template 5 - Clinic Monthly Report</a>
              <a class="dropdown-item" href="template_three.php">Template 6 - Chronic diseases patients</a>
              <a class="dropdown-item" href="non_chronic_list.php">Template 7 - Non chronic diseases</a>
              <a class="dropdown-item" href="treatmentReport.php">Template 8 - Change treatment/Medication</a>
              <a class="dropdown-item" href="patient_status_list.php">Template 9 - Patients Discharged/Diceased</a>
              <a class="dropdown-item" href="monthlyReport.php">Monthly Report</a>
              <a class="dropdown-item" href="dailyReport.php">Daily Report</a>
            </div>
          </div>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2 searchElement" type="text" id="searchTxt" name="searchTxt" placeholder="Search...">
        <button type="button" class="btn btn-primary searchElement" id="searchBtn" name="searchBtn"><i class="fa fa-search fa-fw" aria-hidden="true"></i> Search</button>
      </form>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="logout.php"> <i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout </a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="container">
  <div class="row justify-content-md-center" id="wait">
    <div class="col-sm-12">
      <div class="col-sm-6 pull-left">
      <a class="navbar-brand pull-left" href="#"><img src="../images/medair_icon.png""></a>
      </div>
      <div class="col-sm-6 pull-right">
      <button type="button" class="btn btn-danger pull-right" id="print_this"><i class="fa fa-print"></i></button>
    </div></div>
    <div class="a col-xs-12 col-sm-12 col-md-12 col-lg-12 col-lg-push-12 col-md-push-12">
      <table class="table table-bordered table-responsive table-hover table-striped">
        <tr class="bg-info"><th style="text-align: center" colspan="<?php echo $count=$count*2 +2 ?>">Foot Examination</th></tr>
        <tr>
          <th>Foot Screening</th>
          <th>Date</th>
          <?php if($count>0) { foreach($result as $res) { ?>
          <th colspan="2"><?php echo $res['date_of_exam'];?></th>
          <?php } } ?>
        </tr>
        <tr>
          <th>Patient ID: <?php echo $_REQUEST['pid'];?></th>
          <th></th>
          <?php foreach($result as $res) { ?>
          <th>Left Foot</th>
          <th>Right Foot</th>
          <?php } ?>
        </tr>
        <tr>
          <th rowspan="2" style="vertical-align: middle;">History</th>
          <th>1. Previous Ulcer</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['prev_ulcer_left'] ?></td>
          <td><?php echo $res['prev_ulcer_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th>2. Previous Amputation</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['prev_amputation_left'] ?></td>
          <td><?php echo $res['prev_amputation_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th rowspan="2" style="vertical-align: middle;">Physical Exam</th>
          <th>3. Deformity</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['deformity_left'] ?></td>
          <td><?php echo $res['deformity_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th>4. Absent Pedal Pulses (Dorsalis Pedis and/or Posterior Tibial)</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['absent_pedal_pulse_left'] ?></td>
          <td><?php echo $res['absent_pedal_pulse_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th rowspan="5" style="vertical-align: middle;">Foot Lesions</th>
          <th>5. Activre Ulcer</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['active_ulcer_left'] ?></td>
          <td><?php echo $res['active_ulcer_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th>6. Ingrown Toenail</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['ingrown_toenail_left'] ?></td>
          <td><?php echo $res['ingrown_toenail_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th>7. Calluses (Thick plantar skin)</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['calluses_left'] ?></td>
          <td><?php echo $res['calluses_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th>8. Blisters (Fluid-filled sack)</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['blisters_left'] ?></td>
          <td><?php echo $res['blisters_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th>9. Fissure (Linear Crack)</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['fissure_left'] ?></td>
          <td><?php echo $res['fissure_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th rowspan="3">Neuropathy more than 4/10 sites lacking feeling = yes</th>
          <th>10. Monofilament Exam</th>
          <?php foreach($result as $res) { ?>
          <td colspan="2"></td>
          <?php } ?>
        </tr>
        <tr>
          <th>a) Right __/10 negatives (≥ 4 negatives = yes)</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['monofilament_right_left'] ?></td>
          <td><?php echo $res['monofilament_right_right'] ?></td>
          <?php } ?>
        </tr>
        <tr>
          <th>b) Left __/10 negatives (≥ 4 negatives = yes)</th>
          <?php foreach($result as $res) { ?>
          <td><?php echo $res['monofilament_left_left'] ?></td>
          <td><?php echo $res['monofilament_left_right'] ?></td>
          <?php } ?>
        </tr>
      </table>
    </div>
  </div>
  </div>
  <script src="../js/jquery-3.2.1.min.js"></script>
  <script src="../js/tether.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/searchDiabetes.js"></script>
  <script src="../js/footExamination.js"></script>
  <script src="../js/PrintMissedVisits.js"></script>
  <script src="../js/barcodeReader.js"></script>
</body>
</html>