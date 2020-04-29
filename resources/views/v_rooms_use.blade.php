<!-- 
  Author: นติรุต ดวงภาค
  ID : 59161030
  Desciption: รายงานแสดงห้องสอบที่ถูกใช้แล้ว ในรูปแบบตารางข้อมูล
  Input:
  Output: 
 -->
<?php 
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
  session_start();
  if(!isset($_SESSION["sess_login"]["full_name"]) && !isset($_SESSION["sess_login"]["email_addr"]) && !isset($_SESSION["sess_login"]["employeeid"])) 
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>  
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<!-- DataTable load script -->
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<!DOCTYPE html>
<html>
<?php foreach ($rud as $roomuse_data) ?>
<head>
    <link rel="shortcut icon" href="/icon/sms.png" />   
    <title>ห้องที่ได้รับการจัด</title>
</head>

<style>

    
</style>

<div>
   @include('navbar')
</div>
<body style="margin-top:70px;background-color:#d3d3d3ad; ">

    <div id="demo" style="margin-top:75px;margin-left:0%;margin-right:0%;">
    <div class="card " style="margin:15px">
    <h5 class="card-header  text-white" style="background-color:#004a99;">ห้องที่ได้รับการจัด</h5>
    <div class="card-body panel-style h-100" style="padding:0px;"> 
    
    <div class="container-fluid" style="margin-top:30px;">
    <div align="center"  class="col-md-12">
    <table  class="table table-bordered data-table" id="table1" style="width:100%">
        <thead  class="bg-primary text-white">
            <tr align="center">
                <th scope="col" >ลำดับ</th>
                <th scope="col" >ชื่อห้อง</th>
                <th scope="col" >วันที่</th>
                <th scope="col" >เวลาเริ่มต้น</th>
                <th scope="col" >เวลาสิ้นสุด</th>
                <th scope="col" >ดำเนินการ</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($rud as $roomuse_data)
            <tr>
                <td align="center" >{{$loop->iteration}}</td>
                <td align="center" scope="row">{{$roomuse_data->room_name}}</td>
                <td align="center" scope="row">{{formatDateThai(date('d M Y', strtotime($roomuse_data->date)))}}</td>
                <td align="center" >{{$roomuse_data->room_time_start}} น.</td>
                <td align="center" >{{$roomuse_data->room_time_end}} น.</td>
                <td align="center">
                    <a  href="/edit-roomuse/{{$roomuse_data->room_id}}/{{$roomuse_data->time_start_mili}}/{{$roomuse_data->time_end_mili}}"><button type="button" class="text-white btn btn-warning">แก้ไข</button></a>
                    <a href="/delete-roomuse/{{$roomuse_data->room_id}}/{{$roomuse_data->time_start_mili}}/{{$roomuse_data->time_end_mili}}"><button type="button" class="btn btn-danger">ลบ</button></a>
                    <a href="/export-seatlayout/{{$roomuse_data->room_id}}/{{$roomuse_data->time_start_mili}}/{{$roomuse_data->time_end_mili}}"><button type="button" class="btn btn-info">ส่งออกฝังห้อง</button></a>
               </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div>
    </div>
    </div>
</body>
</html>
<script>
//แสดงผลตารางข้อมูลในรูปแบบ Data table
 $(document).ready(function() {
  $.fn.dataTable.ext.classes.sPageButton = 'button button-primary';
  $('#dtBasicExample').DataTable({
    "paging": false 
  });
  
    $('#table1').DataTable( {
    
      "iDisplayLength": 10,
      language: {
          searchPlaceholder: "ค้นหาด้วยหมายเลขห้อง",
          search: "",
          "emptyTable": "ไม่พบข้อมูล",
          "zeroRecords": "ไม่พบข้อมูลที่ตรงกับการค้นหา"
        },
        "bSort" : true, 
        "order": [[0, 'asc']],
         "dom": 'Bflrtip',
    } );
    $('.dataTables_paginate').addClass('pagination');
    $('.dataTables_filter').addClass('pull-right');
    $('.dataTables_length').addClass('pull-left');
    $('.dataTables_info').addClass('pull-left');
    $('.dataTables_info').css({'margin-bottom':'20px'});

    $(".dataTables_paginate").css({'position': 'absolute','right': '15px','bottom': '-45px'});
    $('.dataTables_filter').css({'position': 'absolute','right': '15px','top': '10px'});
    $('#table1_filter input').css({'width':'50vh'});
} );
</script>
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
  .myTable td, .myTable th {
    border:3px solid #007fff; 
  }
  .panel-style{
    padding:0px;
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
