<!-- 
Author: ธีรัช นาคสุทธิ์
ID : 59160185
Desciption: หน้า View สำหรับแสดงข้อมูลตารางสอบ
Input: -
Output: ข้อมูลตารางสอบ
-->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
<script src="https://cdn.jsdelivr.net/npm/vue">
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js">
</script>  
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<head> 
  <link rel="shortcut icon" href="/icon/sms.png" />   
  <title>ข้อมูลนักเรียน
  </title>
</head>
<body style="background-color:#d3d3d3ad">
  <div align="center">
    @include('navbar')
  </div>
  <!-- ส่วนของการแสดงข้อมูลส่วนตัวของนิสิต -->
  <?php foreach ($pss as $ps)?>
  <div id="demo" style="width:95%; margin:auto; background-color:white; padding-bottom: 15px;">
    <div  v-if="check_std!=''">
      <div class="card-header text-white" style="margin-top:75px; background-color:#004a99;" >  
        <span style="margin-right:1%;">รหัสนิสิต
        </span>
        <span>{{$ps->exs_code}}
        </span>
        <br>
        <span style="margin-right:1%;">ชื่อ-นามสกุล
        </span>
        <span>{{$ps->exs_name}}
        </span>
      </div>
    </div>
    @if(!is_null($pss))
    @foreach ($pss as $ps)
    <!-- ส่วนของการแสดงวันที่ของการสอบ -->
    <div class="card-body" style="padding:0px;" align="center">
      <div style="margin-top:30px;margin-left:1%;margin-right:1%;">
        <strong >วันที่ {{formatDateThai(date('d M Y', strtotime($ps->date)))}}
        </strong>
      </div>
      <div class="container-fluid" style="margin-top:10px;">
        <div class="col-md-12">
          <!-- ส่วนของการแสดงข้อมูลรายวิชา เช่น รหัสวิชา และชื่อวิชา -->
          <table class="table table-striped table-bordered" id="table1">
            <thead class="bg-primary text-white">
              <tr >
                <th colspan="2">{{$ps->sub_code}} : {{$ps->sub_name}}
                </th>        
              </tr>
            </thead>
            <!-- ส่วนของการแสดงข้อมูล เวลาสอบ ชื่อห้อง และเลขที่นั่งสอบจากรายวิชาด้านบน-->
            <tbody>
              <tr>
                <th scope="col">เวลาสอบ
                </th>
                <td>{{$ps->exam_time_start}} น. - {{$ps->exam_time_end}} น.
                </td>
              </tr>
              <tr>
                <th scope="col">ห้องสอบ
                </th>
                <td>{{$ps->room_name}}
                </td>
              </tr>
              <tr>
                <th scope="col">เลขที่สอบ
                </th>
                <td>{{$ps->exs_seat}}
                </td>
              </tr>
            </tbody>
            </div> 
          </table>   
      </div>
    </div>
    @endforeach
    @else
    <tr align="center">
      <p>ไม่พบข้อมูล
      </p>
    </tr>
    @endif     
  </div>
</body>
<script>
  var demo = new Vue({
    el:"#demo",
    data:{
      std_data: JSON.parse(JSON.stringify(<?php echo json_encode($pss) ?>)), //ข้อมูลนิสิต
    }
    ,
    methods: {
    }
    ,
    computed: {
      //รีเทอนข้อมูลนักเรียน
      check_std(){
        return this.std_data;
      }
    }
    ,
  }
                    )
</script>
<style type="text/css">
  body {
    font: 90%/1.45em "Helvetica Neue", HelveticaNeue, Verdana, Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
    color: #333;
    background-color: gray;
  }
  table, th,tr,td{
    border: 1px solid black !important;
    border-top: 1px solid black !important;
  }
</style>
