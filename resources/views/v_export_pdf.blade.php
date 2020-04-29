<!-- 
  Author: นติรุต ดวงภาค
  ID : 59161030
  Desciption: ส่งออกข้อมูลการสอบในรูปแบบใบเซนชื่อ
  Input: 
  Output: ใบเซนชื่อในรูปแบบ PDF
 -->
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        table {
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
}
        @font-face {
            font-family: 'THSarabun';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabun.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabun';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabun Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabun';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabun Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabun';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabun Bold Italic.ttf') }}") format('truetype');
        }
 
        body {
            font-family: "THSarabun";
        }
    </style>
    </head>
    <body>
    <?php foreach ($sed as $seat_data) ?>
    <?php foreach ($sud as $subject_data) ?>
    <footer>
      <div ><?php echo $subject_data->sub_code; ?>&nbsp;&nbsp;&nbsp;  <?php echo $subject_data->sub_name; ?></div> 
   </footer>
      
  
    <div id="demo" style="margin-bottom:35px">
  
    <div align="center" style="font-size:30px; font-weight:bold;" >ใบเซ็นชื่อเข้าสอบ<?php echo $subject_data->type_exam; ?> <?php 
      if($subject_data->term==3){
        echo "ภาคฤดูร้อน";
      }
       else{ 
        echo "ภาคเรียนที่ ";echo $subject_data->term;
       }
     
     ?>
      ปีการศึกษา <?php echo $subject_data->school_year+543; ?></div>
       <div align="center" style="font-size:20px; font-weight:bold;" >วันที่ <?php echo substr($subject_data->date,8,2); ?>
        <?php 
           if(substr($subject_data->date,5,2)=='01'){
            echo "มกราคม";
           }
           else if(substr($subject_data->date,5,2)=='02'){
            echo "กุมภาพันธ์ ";
           }
           else if(substr($subject_data->date,5,2)=='03'){
            echo "มีนาคม";
           }
           else if(substr($subject_data->date,5,2)=='04'){
            echo "เมษายน";
           }
           else if(substr($subject_data->date,5,2)=='05'){
            echo "พฤษภาคม";
           }
           else if(substr($subject_data->date,5,2)=='06'){
            echo "มิถุนายน";
           }
           else if(substr($subject_data->date,5,2)=='07'){
            echo "กรกฎาคม";
           }
           else if(substr($subject_data->date,5,2)=='08'){
            echo "สิงหาคม";
           }
           else if(substr($subject_data->date,5,2)=='09'){
            echo "กันยายน";
           }
           else if(substr($subject_data->date,5,2)=='10'){
            echo "ตุลาคม";
           }
           else if(substr($subject_data->date,5,2)=='11'){
            echo "พฤศจิกายน";
           }
           else if (substr($subject_data->date,5,2)=='12'){
            echo "ธันวาคม";
           }
        ?>
        พ.ศ.  <?php echo substr($subject_data->date,0,4)+543 ;?></div>
       <div align="center" style="font-size:20px; font-weight:bold;">ห้องสอบ <?php echo $subject_data->room_name; ?>   คณะวิทยาการสารสนเทศ</div>
        <div  align="center"  style="font-size:20px;" >
        <b>รายวิชา</b> &nbsp;<?php echo $subject_data->sub_code; ?>&nbsp;<?php echo $subject_data->sub_name; ?> 
        </div>
        <div  align="center"  style="font-size:20px;">
          <b>อาจารย์ผู้สอน</b> <?php echo $subject_data->teacher; ?>
        </div>
       <br>

        <table  align="center" style="width:100%"  >
        <thead style="font-size:20px;" >
            <tr >
                <th scope="col"  align="center">ลำดับ</th>
                <th scope="col"  align="center">รหัสนิสิต</th>
                <th scope="col"  align="center">ชื่อ-นามสกุล</th>
                <th scope="col"  align="center">กลุ่ม</th>
                <th scope="col"  align="center">เลขที่่นั่งสอบ</th>
                <th scope="col"  align="center">ลายมือชื่อ</th>
            </tr>
        </thead>
        <tbody style="font-size:20px;">
     
            @foreach ($sed as $seat_data)
            <tr  >
                <td align="center" style="width:7%">{{$loop->iteration}}</td>
                <td  align="center" style="width:15%">{{$seat_data->exs_code}} </td>
                <td style="width:30%">&nbsp;&nbsp;&nbsp;{{$seat_data->exs_name}} </td>
                <td align="center" style="width:7%">{{$seat_data->exs_group}} </td>
                <td  align="center" style="width:12%">{{$seat_data->exs_seat}} </td>
                <td style="width:28%"></td>
            </tr>
            @endforeach
        </tbody>
1    </table>
    </div>
  </body>
</html>
<style>
    footer {
        position: fixed; 
                bottom: -0.5cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;

                /** Extra personal styles **/
                font-size:20px;
                color:black;
                text-align: center;
                line-height: 1.5cm;
            }
</style>
