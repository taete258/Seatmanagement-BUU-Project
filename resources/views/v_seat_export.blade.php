<!-- 
Author: รัชชานนท์ พึ่งตา,นติรุต ดวงภาค
ID : 59160683
Desciption: หน้า View สำหรับการดาวน๋โหลดแผนผังที่นั่ง
Input: -
Output: แผนผังที่นั่งสอบ
-->
<!-- การเช็ค Session เมื่่อทำการ Login และป้องกันการ เก็บ Cache -->
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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://cdn.jsdelivr.net/npm/vue">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
</script>
<script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<head>
  <link rel="shortcut icon" href="/icon/sms.png" />   
  <title>แผนผัง
  </title>
</head>
<body>
  <div>
    @include('navbar')
  </div>
  <?php foreach ($erd as $editroomuse_data) ?>   
  <?php foreach ($esd as $editsubject_data) ?>  
  <?php foreach ($sed as $seat_data) ?>  
  <br>
  <br>
  <br>
  <body >
    <div  id="demo"  style="margin-top:20px;margin-left:1%;margin-right:1%;">
      <div class="card ">
        <h3 class="card-header text-white" style="background-color:#004a99;">
          <span style="font-size:24px;">แผนผังห้องสอบ
          </span> 
          <button style="float: right;" id="btn-download" class="btn btn-">
            <i class="fa fa-download" aria-hidden="true">
            </i> Export as PDF
          </button>
        </h3>
        <div class="card-body panel-border trans" align="center" id="item">
          <div >
           @foreach ($erd as $rm)
                <h1><?php echo "วันที่สอบ: ".formatDateThai(date('d M Y', strtotime($editsubject_data->date))); ?> <?php echo "เวลา: ".$editsubject_data->exam_time_start."น. - ".$editsubject_data->exam_time_end."น.   "; ?> <?php echo "ห้องสอบ: ".$rm->room_name; ?></h1>
           @endforeach
          </div>
          
          <div  v-for="(sub, index) in get_subject_size" :key="index" style="margin:15px;display:inline-block" >
            <button id="btn" style=" height:100px " :style="{backgroundColor: random_subject_color(sub.sub_code)}">
              <div style="font-size:24px; color:black; padding:5px;">
                @{{sub.sub_code}}
                <br>
                @{{sub.sub_name}}
              </div>
            </button>
          </div>
          <br>
          <div style="display: inline-block; margin-top:20;margin-bottom:10px; border:2px solid black;"  v-for="(col, valr) in get_col_size" :key="valr">
            <div style="width:60px; height:35px; font-size:24px; font-weight: bold; margin:3px;" align="center">
              @{{col.char}}
            </div>
          </div>
          <div style=""   v-for="(row, val) in get_row_size" :key="val"> 
            <div style="display: inline-block;border:2px solid black; margin:3px;"  v-for="(col, valr) in get_col_size" :key="valr">
              <div v-bind:id="col.char+row.number">   
                <div style="width:60px; height:40px; padding:5px;" align="center" >
                  @{{col.char}}@{{row.number}}
                </div>
              </div>
              </tr> 
          </div>
        </div>
      </div>
    </div>
  </body>
  </div>
<div id="previewImage" hide>

<style>
body{
  background-color:#d3d3d3ad;
  zoom:90%;
  text-align:left;
}
@media print{
  @page {size: landscape;
    margin:0;
  }

  body {
    height:100%; 
    margin: 0.0cm !important; 
    padding: 0 !important;
    overflow: hidden;
    zoom:55%;
    -webkit-print-color-adjust: exact;
  }
    /* table {page-break-inside: avoid;} */
}
</style>
  <script>
    $(document).ready(function(){
      // ฟังก์ชัน Generate image จาก HTML
      $('#btn-download').click(function(){
        window.print();

      });
    });
  </script>
  <script>
    var demo = new Vue({
      el:"#demo",
      data:{
        color:['#97FFF1','#F7FC8B','#F09DF8','#94FF88'], //ค่าสี
        color_cache: {}, //เก็บค่าสี
        row:"<?php echo $editroomuse_data->room_row; ?>",//ข้อมูลแถว
        col:"<?php echo $editroomuse_data->room_col; ?>",//ข้อมูลหลัก
        room_data:JSON.parse(JSON.stringify(<?php echo json_encode($erd) ?>)),//ข้อมูลห้อง
        subject:JSON.parse(JSON.stringify(<?php echo json_encode($esd) ?>)),//ข้อมูลวิชา
        seat:JSON.parse(JSON.stringify(<?php echo json_encode($sed) ?>))//ข้อมูลที่นั่ง
      }
      ,//ฟังก์ชัน Set สีลงที่นั่ง
      mounted:function(){
        for(let i of this.seat){
          $('#'+i.exs_seat).css({
            "background-color": this.random_subject_color(i.exs_sub),"color":"black"
            });
        }
      }
      ,
      methods:{
        //สุ่มค่าสี
        random_subject_color(id) {
          return this.color_cache[id] || (this.color_cache[id] = this.color.pop());
        }
      }
      ,
      computed:{
        //ส่งข้อมูลแถวผัง
        get_row_size(){
          var list = [];
          for (var i = 1; i <= 1000; i++) {
            list.push(i);
          }
          var obj = [];
          for (let i = 0; i < this.row; i++){
            obj.push({
              number: list[i]
            });
          }
          return obj;
        }
        ,
        //ส่งข้อมูลแถว ABC
        get_col_size(){
          var list = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
          var obj = [];
          for(let i =0;i<this.col;i++){
            obj.push({
              char: list[i]
            });
          }
          return obj;
        }
        ,
        //ส่งข้อมูลขนาดไฟล์
        get_subject_size(){
          return this.subject;
        }
        ,
      }
    }
    )
  </script>
