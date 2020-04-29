<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
session_start();
if(!isset($_SESSION["sess_login"]["full_name"]) && !isset($_SESSION["sess_login"]["email_addr"]) && !isset($_SESSION["sess_login"]["employeeid"])&& strlen(!isset($_SESSION["sess_login"]["name"])<=8)) 
{
echo "Please Login";
echo " ...";
header("Refresh:1; url=/login");
exit;
}
?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js">
</script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
</script>
<!-- DataTable load script -->
<link rel="stylesheet" type="text/css" href="/DataTables/datatables.min.css"/>
<script type="text/javascript" src="/DataTables/datatables.min.js">
</script>
<head>
  <link rel="shortcut icon" href="/icon/sms.png" />   
  <title>
  รายละเอียด
  </title>
</head>
<div>
  @include('navbar')
</div>
<div  id="demo" style="margin-top:75px;margin-left:1%;margin-right:1%;">
  <?php foreach ($sed as $seat_data) ?>
  <?php foreach ($sud as $subject_data) ?>
  <div class="card">
  <h4 class="card-header text-white"style="background: #004a99; padding-left:27px;">รายละเอียด</h4>
  <div class="card-body">
    <h5 class="card-title" style="padding-left:8px;"> <strong>วิชา :
      </strong> {{$seat_data->exs_sub}}  {{$subject_data->sub_name}}     <!-- se = seat_examp ชื่อดาต้าเบส -->
      <br>
      <br>
      <strong>ผู้สอน :  
      </strong>{{$subject_data->teacher}} <!-- sub = subject ชื่อดาต้าเบส -->
      <br>
      <br>
      <strong>ห้องสอบ : 
      </strong>{{$subject_data->room_name}} 
    </h5>
  </div>
    <span style="position:absolute; right:40px; top:7px;">
      <a href="/export_pdf/{{$seat_data->exs_sub}}/{{$subject_data->date}}/{{$subject_data->room_id}}">
        <button type="button" class="btn btn-">
          <i class="fa fa-download" aria-hidden="true">
          </i> Export as PDF
        </button>
      </a>
    </span>
    <div class="card-body panel-border h-100" style="padding:0px;">
      <span class=" " style="margin-bottom:0x;">
        <div class="container-fluid" style="margin-top:10px;">
          <div class="col-md-12">
            <table class="table table-bordered data-table table-striped" id="table1" style="width:100%">
              <thead class="bg-primary text-white">
                <tr align="center">
                  <th scope="col">ลำดับ 
                  </th>
                  <th scope="col">รหัสนิสิต 
                  </th>
                  <th scope="col">ชื่อ-นามสกุล 
                  </th>
                  <th scope="col">กลุ่มเรียน 
                  </th>
                  <th scope="col">เลที่นั่งสอบ 
                  </th>
                </tr>
              </thead>
              <tbody>
                @if(!is_null($sed))
                @foreach ($sed as $seat_data)
                <tr>
                  <td align="center" >{{$loop->iteration}}
                  </td>
                  <td align="center">{{$seat_data->exs_code}}
                  </td>
                  <td>{{$seat_data->exs_name}}
                  </td>
                  <td align="center">{{$seat_data->exs_group}}
                  </td>
                  <td align="center">{{$seat_data->exs_seat}}
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
        </div>
    </div>
  </div>
  <style type="text/css">
    body {
      font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      color: #333;
      background-color: #d3d3d3ad;
    }
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
      background :  #primary;
    }
    .myTable td, .myTable th {
      border:3px solid #007fff;
    }
    .panel-border{
  
    }
    .pull-right{
      float: right !important;
    }
    .pull-left{
      float: left !important;
    }
    .dataTables_length {
      margin-top: 10px;
      margin-left: 20px;
    }
  </style>
  <!-- DATA TABES SCRIPT -->
  <script type="text/javascript">
    // การกำหนดค่าเรื่มต้นสำหรับ Datatable
    $(document).ready(function() {
      $.fn.dataTable.ext.classes.sPageButton = 'button button-primary';
      $('#dtBasicExample').DataTable({
        "paging": false 
      });
      $('#table1').DataTable( {
        "iDisplayLength": 10,
        async: true,
        language: {
          searchPlaceholder: "ค้นหาด้วยรหัสนิสิต หรือชื่อ",
          search: "",
          "emptyTable": "ไม่พบข้อมูล",
          "zeroRecords": "ไม่พบข้อมูลที่ตรงกับการค้นหา"
        }
        ,
        "bSort" : true, 
        "order": [[0, 'asc']],
        "dom": 'Bflrtip',
      });
      $('.dataTables_paginate').addClass('pagination');
      $('.dataTables_filter').addClass('pull-right');
      $('.dataTables_length').addClass('pull-left');
      $('.dataTables_info').css({
        'margin-bottom':'20px'});
      $(".dataTables_paginate").css({
        'position': 'absolute','right': '15px','bottom': '-7px'});
      $('.dataTables_filter').css({
        'position': 'absolute','right': '15px','top': '10px','width':'55vh'});
      $('#table1_filter input').css({
        'width':'50vh'});
    });
  </script>
