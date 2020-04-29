<!-- 
  Author: นติรุต ดวงภาค
  ID : 59161030
  Desciption: จัดการขนาดห้องสอบ เพิ่ม ลบ แก้ไขขนาดห้องสอบ
  Input:
  Output: 
 -->
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js">
</script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js">
</script>  
<script src="https://cdn.jsdelivr.net/npm/vue">
</script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<html>
  <head>
    <link rel="shortcut icon" href="/icon/sms.png" />   
    <title>แก้ไขห้อง
    </title>
  </head>
  <div>
    @include('navbar')
  </div>
  <body  style="margin-top:70px; background-color:#d3d3d3ad;">
    <?php foreach ($erd as $editroom_data) ?>
    <div id="demo">
      <div class="card " style="margin:15px">
        <h5 class="card-header text-white" style="background-color:#004a99">แก้ไขห้อง
        </h5>
        <div class="card-body panel-border">
          <form action="/update-room" method="post">
            @csrf
            <div  class="row">
            <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                <label class="col-md-12 control-label">ชั้น
                </label>
                <div class="col-md-12 ">
                  <input name="floor"  id="floor"  v-model="floor" :class="(!floor)?'require requirefocus':'complete completefocus'" class="form-control" type="text" placeholder="กรุณาใส่ชั้น" >
                </div>
              </div> 
              <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                <label class="col-md-12 control-label">ชื่อห้อง
                </label>
                <div class="col-md-12 ">
                  <input  name="room_name" id="room_name" v-model="room_name"  :class="(!room_name)?'require requirefocus':'complete completefocus'" class="form-control" type="text" placeholder="กรุณาใส่ชื่อห้อง"  >
                </div>
              </div>
              <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                <label class="col-md-12 control-label">จำนวนแถว
                </label>
                <div class="col-md-12 ">
                  <input name="row"  id="row"  v-model="row" class="form-control" :class="(!row)?'require requirefocus':'complete completefocus'" type="number" placeholder="กรุณาใส่จำนวนแถว" >
                </div>
              </div>
              <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" >
                <label class="col-md-12 control-label">จำนวนหลัก
                </label>
                <div class="col-md-12 ">
                  <input name="col"  id="col" v-model="col" class="form-control" :class="(!col)?'require requirefocus':'complete completefocus'" type="number" placeholder="กรุณาใส่จำนวนหลัก" >
                </div>
              </div>
              <input type="hidden" value="<?php echo $editroom_data->id ?>" name="room_id">
              <div class="col-md-12 text-center">
                <br>
                <button type="submit" class="btn btn-success" id="submit">บันทึก
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
  var demo = new Vue({
    el:"#demo",
    data:{
      room_name:"<?php echo $editroom_data->room_name; ?>", //ข้อมูลชื่อห้อง
      row:"<?php echo $editroom_data->room_row; ?>",//ข้อมูลแถว
      col:"<?php echo $editroom_data->room_col; ?>",//ข้อมูลหลัก
      floor:"<?php echo $editroom_data->room_floor; ?>",//ข้อมูลชั้น
    }
    ,
  }
)
</script>
<style>
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
