<!-- 
  Author: รัชชานนท์ พึ่งตา
  ID : 59160683
  Desciption: หน้า View สำหรับการแสดงรายการรายวิชา
  Input: -
  Output: รายการรายวิชา
 -->

<!-- การเช็ค Session เมื่่อทำการ Login -->
<?php 
session_start();
if(!isset($_SESSION["sess_login"]["full_name"]) && !isset($_SESSION["sess_login"]["email_addr"]) && !isset($_SESSION["sess_login"]["employeeid"]) && strlen(!isset($_SESSION["sess_login"]["name"])<=8)) 
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
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<!-- DataTable load script -->
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js">
</script>
<head>
  <link rel="shortcut icon" href="/icon/sms.png" />  
  <title>รายวิชา
  </title>
</head>
<body style="background-color:#d3d3d3ad">
<div>
  @include('navbar')
</div>
<div  id="demo" style="margin-top:75px;margin-left:1%;margin-right:1%;">
<div  style="width:100%;  display:inline-block;" align="center" >
      <a style="border-radius: 20px;" href="/room-use" class="card-property bg-secondary card d-inline-block btn text-white  col-xs-3 col-md-3">
          <span class="fa fa-sitemap " style="font-size:50px;"></span> <br/>ดูห้องที่ทำการจัด
      </a>
      <a style="border-radius: 20px; href="/add-room" class="card-property bg-primary card d-inline-block  btn text-white col-xs-3 col-md-3">
           <span class="fa fa-cog " style="font-size:50px;"></span> <br/>จัดการห้อง
      </a>
      <a style="border-radius: 20px; href="/add-data" class="card-property bg-success card d-inline-block btn text-white col-xs-3 col-md-3">
          <span class="fa fa-plus" style="font-size:50px;"></span> <br/>สร้างการสอบ
      </a>
    </div>
  <div class="card ">
    <h5 class="card-header text-white" style="background-color:#004a99;">รายวิชา 
    </h5>
    
    <div class="card-body h-100" style="padding:0px;">
      <span class=" " style="margin-bottom:0x;">
        <div class="container-fluid" style="margin-top:30px;">
          <div class="col-md-12">
            <table class="table table-bordered data-table" id="table1" style="width:100%">
              <thead class="bg-primary text-white">
                <tr align="center">
                  <th scope="col">ลำดับ 
                  </th>
                  <th scope="col">รหัสวิชา 
                  </th>
                  <th scope="col">ชื่อวิชา 
                  </th>
                  <th scope="col">วันที่ 
                  </th>
                  <th scope="col">เวลา 
                  </th>
                  <th scope="col">ดำเนินการ 
                  </th>
                </tr>
              </thead>
              <tbody>
                @if(!is_null($sjt))
                @foreach ($sjt as $subject)
                <tr>
                  <td align="center" >{{$loop->iteration}}
                  </td>
                  <td>{{$subject->sub_code}}
                  </td>
                  <td>{{$subject->sub_name}}
                  </td>
                  <td align="center">{{formatDateThai(date('d M Y', strtotime($subject->date)))}}
                  </td>
                  <td align="center">{{$subject->exam_time_start}} น. - {{$subject->exam_time_end}} น.
                  </td>
                  <td align="center">
                    <a href="/show_detail/{{$subject->sub_code}}/{{$subject->date}}/{{$subject->room_id}}">
                      <button type="button" class="btn btn-info">
                        <i class="fa fa-info" aria-hidden="true">
                        </i> เพิ่มเติม
                      </button>
                    </a>
                    <a href="/export_pdf/{{$subject->sub_code}}/{{$subject->date}}/{{$subject->room_id}}" target="_blank">
                      <button type="button" class="btn btn- ">
                        <i class="fa fa-download" aria-hidden="true">
                        </i> Export as PDF
                      </button>
                    </a>
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
  </body>
  <style type="text/css">
    body {
      font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      color: #333;
      background-color: #fff;
    }
    table.dataTable thead .sorting,
    table.dataTable thead .sorting_asc,
    table.dataTable thead .sorting_desc {
      background : none !important;
    }
    .card-property{
      padding-top:15px;
      margin:20px;
      float:center;
      height:120px; 
      font-size:30px;
    }
    .myTable td, .myTable th {
      border:3px solid #007fff;
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

  <script>
  // การกำหนดค่าเรื่มต้นสำหรับ Datatable
    $(document).ready(function() {
      $.fn.dataTable.ext.classes.sPageButton = 'button button-primary';
      $('#dtBasicExample').DataTable({
        "paging": false 
      });
      $('#table1').DataTable( {
        "iDisplayLength": 10,
        language: {
          searchPlaceholder: "ค้นหาด้วยรหัสวิชา หรือชื่อวิชา",
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
      $('.dataTables_info').css({'margin-bottom':'20px'});
      $(".dataTables_paginate").css({'position': 'absolute','right': '15px','bottom': '-7px'});
      $('.dataTables_filter').css({'position': 'absolute','right': '15px','top': '10px'});
      $('#table1_filter input').css({'width':'50vh'});
    });
  </script>
