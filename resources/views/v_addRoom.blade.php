<!-- 
  Author: นติรุต ดวงภาค
  ID : 59161030
  Desciption: จัดการขนาดห้องสอบ เพิ่มลบ แก้ไข ขนาดห้องสอบ
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<script type="text/javascript" src="DataTables/datatables.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/vue">
</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" href="/icon/sms.png" />   
    <title>เพิ่มห้อง
    </title>
  </head>
  <style>
  </style>
  <div>
    @include('navbar')
  </div>
  <body style="margin-top:70px; background-color:#d3d3d3ad;">
    <?php foreach ($rmd as $room_data) ?>
    <div id="demo">
      <div class="card " style="margin:15px">
        <h5 class="card-header text-white" style="background-color:#004a99;">จัดการห้อง
        </h5>
        <div class="card-body panel-border">
          <!-- <h1>จัดการห้อง</h1> -->
          <form action="/insertRoom" method="post">
            @csrf
            <div  class="row">
            <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                <label class="col-md-12 control-label">ชั้น
                </label>
                <div class="col-md-12 ">
                  <input name="floor"  id="floor"  v-model="floor" :class="(!floor)?'require requirefocus':'complete completefocus'" class="form-control" type="text" placeholder="กรุณาใส่ชั้น">
                </div>
              </div>
              <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                <label class="col-md-12 control-label">ชื่อห้อง
                </label>
                <div class="col-md-12 ">
                  <input name="room_name"  id="room_name" v-model="room_name"  :class="(!room_name)?'require requirefocus':'complete completefocus'" class="form-control" type="text" placeholder="กรุณาใส่ชื่อห้อง">
                </div>
              </div>
              <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                <label class="col-md-12 control-label">จำนวนแถว
                </label>
                <div class="col-md-12 ">
                  <input name="row"  id="row" min="0" v-model="row" class="form-control" :class="(!row)?'require requirefocus':'complete completefocus'" type="number" placeholder="กรุณาใส่จำนวนแถว">
                </div>
              </div>
              <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                <label class="col-md-12 control-label">จำนวนหลัก
                </label>
                <div class="col-md-12 ">
                  <input name="col"  id="col" min="0" max="26"  v-model="col" class="form-control" :class="(!col)?'require requirefocus':'complete completefocus'" type="number" placeholder="กรุณาใส่จำนวนหลัก">
                </div>
              </div> 
            
            </div>
            </form>
                <div class="col-md-12 text-right" >
                <br>
            <button style="margin-right:15px;" class="btn btn-success"  v-show="!checkbutton" @click="check_form()">บันทึก
                </button>
              </div>
            </div> 

        <div align="center" style="margin-left:1%; margin-right:1%;">
        <table class="table table-bordered "  id="table1" style="width:100%"> 
          <thead  class="bg-primary text-white">
            <tr>
              <th scope="col" >ชั้น
              </th>
              <th scope="col" >ชื่อห้อง
              </th>
              <th scope="col" >จำนวนแถว
              </th>
              <th scope="col" >จำนวนหลัก
              </th>
              <th scope="col" >ดำเนินการ
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($rmd as $room_data)
            <tr>
              <td scope="row">{{$room_data->room_floor}}
              </td>
              <td>{{$room_data->room_name}} 
              </td>
              <td>{{$room_data->room_row}} 
              </td>
              <td>{{$room_data->room_col}} 
              </td>
              <td>
                <a href="/edit-room/{{$room_data->id}}">
                  <button type="button" class="text-white btn btn-warning">แก้ไข
                  </button>
                </a>
                <a href="/delete-room/{{$room_data->id}}">
                  <button type="button" class="btn btn-danger">ลบ
                  </button>
                </a>
              </td>
            </tr>
            @endforeach 
            <tr v-if="roomdata==''">
              <td colspan="5" align="center">ไม่พบข้อมูล
              </td>
            </tr>
          </tbody>
        </table>
      </div>
             
        </div>          
    
    </div>  
  </body>
</html>


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
          searchPlaceholder: "ค้นหาด้วยชั้น หรือชื่อห้อง",
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
      $('.dataTables_info').css({'margin-bottom':'20px','float': 'left'});
      $(".dataTables_paginate").css({'float':'right'});
      $('.dataTables_filter').css({});
      $('#table1_filter input').css({'width':'50vh'});
    });
  </script>

<script>
  var demo = new Vue({
    el:'#demo',
    data:{
      room_name:"",//ตัวแปรชื่อห้อง
      row:"",//ตัวแปรแถว
      col:"",//ตัวแปรหลัก
      floor:"",//ตัวแปรชั้น
      dataRooms: JSON.parse(JSON.stringify(<?php echo json_encode($rmd) ?>)), //ข้อมูลห้องทั้งหมด
    }
    ,
    methods: {
      submit_form(){
      $('form').submit();
    },
      async check_form(){
        if(this.check_room()){
          this.submit_form();
        }
      },
  
      check_room(){
        for(var i of this.dataRooms){
          if(this.room_name == i.room_name){
            alert("ชื่อห้องถูกใช้แล้ว! กรุณาเปลี่ยนชื่อห้อง");
            return false;
            throw("stop");
          }
        }
        return true;
      }
    },
    computed:{
      //คืนค่าข้อมูลห้องทั้งหมด
      roomdata(){
        return this.dataRooms;
      },
      //ตรวจสอบการแสดงปุ่มบันทึก
      checkbutton(){
        if(!this.room_name||!this.row||!this.col||!this.floor){
          return true;
        }
      }
    }
  }
)
</script>
<style>
  th,td{
    text-align:center;
  }
  .require{
    border-color: red;
    box-shadow: 0 0 3px red;
  }
  .requirefocus:focus{
    border-color: red;
    box-shadow: 0 0 3px red;
  }
  .complete{
    border-color: green;
    color: green;
    box-shadow: 0 0 3px green;
  }
  .completefocus:focus{
    border-color: green;
    color: green;
    box-shadow: 0 0 3px green;
  }
</style>

