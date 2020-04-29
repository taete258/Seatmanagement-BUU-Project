<!-- 
  Author: นติรุต ดวงภาค
  ID : 59161030
  Desciption: จัดการห้องสอบที่ถูกใช้แล้ว แก้ไขการจัดเลขที่นั่งสอบ
  Input: ไฟล์รายชื่อนักศึกษา
  Output: ข้อมูลที่นั่งสอบ
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
<script src="https://cdn.jsdelivr.net/npm/vue">
</script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script lang="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.5/xlsx.full.min.js">
</script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment-with-locales.min.js">
</script>  
<html>
  <head>
    <link rel="shortcut icon" href="/icon/sms.png" />   
    <title>แก้ไขห้องที่ถูกจัดสอบ
    </title>
  </head>
  <div>
    @include('navbar')
  </div>
  <body  style="margin-top:70px ;background-color:#d3d3d3ad" >
    <?php foreach ($rmd as $room_data)?>
    <?php foreach ($rud as $roomuse_data)?>
    <?php foreach ($esd as $editsubject_data)?>
    <?php foreach ($erd as $editroomuse_data) ?>
    <div id="demo" style="margin-top:75px;margin-left:1%;margin-right:1%;">
    <div class="card ">
    <h5 class="card-header  text-white" style="background-color:#004a99;">แก้ไขที่นั่งสอบ
    </h5>
    <div class="card-body panel-border">
      <div class="card " style="margin:15px">
        <h5 class="card-header bg-primary text-white">แก้ไขวิชา
        </h5>
        <div class="card-body panel-border">
          <form action="/update-manage" method="post">
            @csrf
            <div  class="row">
              <div  class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 ">
                <label>ปีการศึกษา
                </label>
                <select  class="form-control"  v-model="school_year"   :class="(!school_year)?'require requirefocus':'complete completefocus'"  style="height:49px;">
                  <option value="" selected disabled hidden>เลือกปีการศึกษา
                  </option> 
                  <option v-for="(year, key) in get_year" :value="year">
                    @{{year}}
                  </option>
                </select>
              </div>
              <div  class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 ">
                <label>ภาคการศึกษา
                </label>
                <select class="form-control" v-model="term"  :class="(!term)?'require requirefocus':'complete completefocus'" style="height:49px;" >
                  <option value="" selected disabled hidden>เลือกภาคการศึกษา
                  </option> 
                  <option value="1">ภาคเรียนที่ 1
                  </option>
                  <option value="2">ภาคเรียนที่ 2
                  </option>
                  <option value="3">ภาคฤดูร้อน
              </option>
                </select>
              </div>
              <div  class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 ">
                <label>ชนิดการสอบ
                </label>
                <select class="form-control" v-model="type_exam"   :class="(!type_exam)?'require requirefocus':'complete completefocus'"  style="height:49px;"  >
                  <option value="" selected disabled hidden>เลือกชนิดการสอบ
                  </option> 
                  <option value="กลางภาค">กลางภาค
                  </option>
                  <option value="ปลายภาค">ปลายภาค
                  </option>
                </select>
              </div>
              <div  class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 " id="date-input">
                <label>วันที่สอบ
                </label>
                <input class="form-control" type="date" id="date" :class="(!dateExam)?'require requirefocus':'complete completefocus'" name="date" v-model="dateExam" placeholder="ใส่วันที่สอบ" style="height:49px;"/> 
              </div>
              <div class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 " style="margin-top:10px">
                <label>เวลาเริ่มต้น
                </label>
                <div class="card" :class="(!time_start_hour||!time_start_mini)?'require requirefocus':'complete completefocus'" >
                  <div align="center">
                    <table  >
                      <tr>
                        <td style="width:15px">
                          <select v-model="time_start_hour"  class="form-control time-select" >
                            <option value="" selected disabled hidden>hh
                            </option> 
                            <option v-for="(hour_start, key) in get_hour" :value="hour_start">
                              @{{hour_start}}
                            </option>
                          </select>
                        </td>
                        <td >:
                        </td>
                        <td>
                          <select v-model="time_start_mini"  class="form-control time-select" >
                            <option value="" selected disabled hidden>mm
                            </option> 
                            <option v-for="(minute_start, key1) in get_minute" :value="minute_start">
                              @{{minute_start}}
                            </option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 " style="margin-top:10px">
                <label>เวลาสิ้นสุด
                </label>
                <div class="card"  :class="(!time_end_hour||!time_end_mini)?'require requirefocus':'complete completefocus'" >
                  <div align="center">
                    <table  >
                      <tr>
                        <td style="width:15px">
                          <select v-model="time_end_hour"  class="form-control time-select" >
                            <option value="" selected disabled hidden>hh
                            </option> 
                            <option v-for="(hour_end, key) in get_hour" :value="hour_end">
                              @{{hour_end}}
                            </option>
                          </select>
                        </td>
                        <td >:
                        </td>
                        <td>
                          <select v-model="time_end_mini"  class="form-control time-select" >
                            <option value="" selected disabled hidden>mm
                            </option> 
                            <option v-for="(minute_end, key1) in get_minute" :value="minute_end">
                              @{{minute_end}}
                            </option>
                          </select>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
              <div class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 " style="margin-top:10px">
                <label>ห้องสอบ
                </label>
                <select class="form-control"  v-model="selectFloor" :class="(!selectFloor)?'require requirefocus':'comdis comdisfocus'" style="height:49px;"  >
                  <option value="<?php echo $editroomuse_data->room_id; ?>" selected disabled hidden>
                    <?php echo $editroomuse_data->room_name; ?> &nbsp;&nbsp;&nbsp;&nbsp; 
                    <?php echo $editroomuse_data->room_row * $editroomuse_data->room_col; ?> ที่นั่ง  &nbsp;&nbsp;&nbsp;&nbsp; 
                    <?php echo $editroomuse_data->room_row; ?> แถว  
                     <?php echo $editroomuse_data->room_col; ?> หลัก 
                  </option> 
                </select> 
              </div>
              <div  class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 " style="margin-top:10px">
                <label>อัปโหลดไฟล์
                </label>
                <input type="file"  class="form-control" id="fileUploader" :class="(!fileupload)?'require requirefocus':'complete completefocus'"  v-model="fileupload" name="fileUploader" accept=".xls, .xlsx" @change="addDataExcel($event)" style="height:49px;" />
              </div>
            </div>  
            <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" v-for="(item, index) in datafinal">
              <div class="col-md-12 " hidden>
                <input v-model="datafinal[index].seat"  class="form-control" type="text" name="seatdata[]" id="seatdata" >
                <input v-model="datafinal[index].subject"  class="form-control" type="text" name="subdata[]" id="subdata">
                <input v-model="datafinal[index].name"  class="form-control" type="text" name="namedata[]" id="namedata">
                <input v-model="datafinal[index].id"  class="form-control" type="text" name="codedata[]" id="codedata">
                <!-- <input v-model="datafinal[index].year"  class="form-control" type="text" name="lvdata[]" id="lvdata"> -->
                <input v-model="datafinal[index].group"  class="form-control" type="text" name="groupdata[]" id="groupdata">
                <input v-model="datafinal[index].room"  class="form-control" type="text" name="roomdata[]" id="roomdata">
              </div>
              <div v-for="(item, index) in dataSubjects" hidden >
                <input v-model="dataSubjects[index].timeSmili"  class="form-control" type="text" name="timeSmili_dat[]" id="timeSmili_dat" >
                <input v-model="dataSubjects[index].timeEmili"  class="form-control" type="text" name="timeEmili_dat[]" id="timeEmili_dat">
                <input v-model="dataSubjects[index].date"  class="form-control" type="text" name="date_data[]" id="date_data">
                <div hidden  v-if="itemsContains(dataSubjects[index].subcode)">
                </div>
              </div>
            </div>
            <!-- <div v-for="(sub, val) in allsubcode" > -->
            <div v-for="(item, index) in dataSubjects" >
              <div hidden  v-if="itemsContains(dataSubjects[index].subcode)">
                <input v-model="dataSubjects[index].subcode"  class="form-control" type="text" name="sub_id_data[]" id="sub_id_data" >
                <input v-model="dataSubjects[index].subname"  class="form-control" type="text" name="sub_name_data[]" id="sub_name_data">
                <input v-model="dataSubjects[index].teacher"  class="form-control" type="text" name="teacher_name_data[]" id="teacher_name_data">
                <input v-model="dataSubjects[index].type_exam"  class="form-control" type="text" name="type_exam_data[]" id="type_exam_data" >
                <input v-model="dataSubjects[index].year"  class="form-control" type="text" name="year_data[]" id="year_data" >
                <input v-model="dataSubjects[index].term"  class="form-control" type="text" name="term_data[]" id="term_data">
                <input v-model="dataSubjects[index].date"  class="form-control" type="text" name="date_data[]" id="date_data">
                <input v-model="dataSubjects[index].timeS"  class="form-control" type="text" name="timeS_data[]" id="timeS_data" >
                <input v-model="dataSubjects[index].timeE"  class="form-control" type="text" name="timeE_data[]" id="timeE_data">
                <input v-model="dataSubjects[index].timeSmili"  class="form-control" type="text" name="timeSmili_data[]" id="timeSmili_data" >
                <input v-model="dataSubjects[index].timeEmili"  class="form-control" type="text" name="timeEmili_data[]" id="timeEmili_data">
                <input v-model="dataSubjects[index].floor"  class="form-control" type="text" name="floor_data[]" id="floor_data" >
                <input v-model="dataSubjects[index].room_row"  class="form-control" type="text" name="room_row_data[]" id="room_row_data" >
                <input v-model="dataSubjects[index].room_col"  class="form-control" type="text" name="room_col_data[]" id="room_col_data" >
                <input v-model="dataSubjects[index].room_name"  class="form-control" type="text" name="room_name_data[]" id="room_name_data" >
              </div>
            </div>
            <input type="hidden" value="<?php echo $editroomuse_data->room_id ?>" name="room_id">  
            <input type="hidden" value="<?php echo $editroomuse_data->time_start_mili ?>" name="start_time"> 
            <input type="hidden" value="<?php echo $editroomuse_data->time_end_mili ?>" name="end_time"> 
          </form>
          <div align="right">
              <a class="btn btn-primary text-white text-right" id="submit" @click="addSubject()"  v-show="!checkButtonSave"  >นำเข้าไฟล์
            </a>
          </div>
          <br>
        </div>
      </div>
      
      <!-- ส่วนของการแสดงผลการจัดที่นั่ง -->
  <div class="card " style="margin-top:20px;">
    <h5 class="card-header bg-primary text-white">ตารางที่นั่ง
    </h5>  
    <div class="card-body panel-border">
      <div align="center"  >
        <div id="subjectID"  v-for="(sjd, val) in get_allsubject_data" :key="val" style="display: inline-block;margin:10px; " >
        <a class="btn close" @click="delete_subject(sjd.id)" id="sjd.id">x</a>
          <div v-bind:id="sjd.id" @click.prevent="active = get_allsubject_data[val].id" :class="{active:isActive(get_allsubject_data[val].id) }" class="btn text-white"  :style="{backgroundColor: randomColor(sjd.id)}" @click="selectSubject(sjd.id)">
            <div>@{{sjd.id}}
            </div>
            <div>@{{sjd.name}}
            </div>
            <div  align="center" class="card"  style="color:black; padding-top:3px; padding-left:5px; padding-right:5px;">
            <div >จำนวน @{{sjd.size}} คน
            </div>
          </div>
          </div>
         
        </div>
      </div>
      <div align="center">
        <div v-for="(dr, val) in dataRow" :key="val" >
          <div class="seat-layout"v-for="(dc, valr) in dataCol" :key="valr">
            <div v-if="dr.number == '1'">
              <button @click="checkAll(dc.char)">@{{dc.char}}
              </button>
            </div>
            <td>
              <div class="card border border-primary  " style="margin-top:10px; "  @click=checkOne(dc.char+dr.number) >
                <div class="seatBox" v-bind:id="dc.char+dr.number">
                  <input type="checkbox" style="display: none; " v-bind:class="dc.char" v-bind:id="dc.char+dr.number" >
                  <div class="seatName" >@{{dc.char}}@{{dr.number}}
                  </div>
                </div>
              </div> 
            </td>
          </div> 
          <br> 
        </div>
        <a class="btn btn-success m-3 text-white" id="save"  v-show="!checkTempdata" @click="Beforprocess()">บันทึก
        </a>   
      </div>
    </div>
  </div>
    </div>
    </div>
    </div>
  </body>
</html>
<script>
  var demo = new Vue({
    el:"#demo",
    data:{
      dataRooms: JSON.parse(JSON.stringify(<?php echo json_encode($rmd ?? '') ?>)),//ข้อมูลห้อง
      dataDateroom:JSON.parse(JSON.stringify(<?php echo json_encode($rud) ?>)),//ข้อมูลห้องที่ได้รับการจัดแล้ว
      type_exam:"<?php echo $editsubject_data->type_exam; ?>",//ชนิดการสอบ
      school_year:"<?php echo $editsubject_data->school_year+543; ?>",//ปีการศึกษา
      term:"<?php echo $editsubject_data->term; ?>",//ภาคการศึกษา
      dateExam:"<?php echo $editsubject_data->date; ?>",//วันที่สอบ
      time_start_hour:"<?php echo substr($editsubject_data->exam_time_start,0,2);?>",//ชม.เริ่มสอบ
      time_start_mini:"<?php echo substr($editsubject_data->exam_time_start,3,2); ?>",//นาทีเริ่มสอบ
      time_end_hour:"<?php echo substr($editsubject_data->exam_time_end,0,2);?>",//ชม.สิ้นสุดการสอบ
      time_end_mini:"<?php echo substr($editsubject_data->exam_time_end,3,2); ?>",//นาทีสิ้นสุดการสอบ
      rowAll:"<?php echo $editroomuse_data->room_row; ?>", //เก็บแถวของห้อง
      colAll:"<?php echo $editroomuse_data->room_col; ?>", //เก็บหลักของห้อง
      selectFloor:"<?php echo $editroomuse_data->room_id; ?>",//เก็บชั้น
      fileupload:"",//เก็บไฟล์ Excel ที่อัปโหลด
      tempFile:[],//เก็บข้อมูลรายละเอียดชื่อเลขที่นั่งสอบที่ได้รับการจัด
      dataSeatMap:[],// obj ข้อมูลการสอบที่ map ไว้
      dataSeatObj:[],// obj ของข้อมูลนำเข้าการสอบทั้งหมด
      allSubject_id: [], //เก็บรหัสวิชาที่เพิ่มทั้งหมด
      colorCache: {}, //เก็บค่าสี
      color:["#ED4938", "#ADC607", "#F4C10D", "#DE3974", "#F87117", "7B3DBA", "#03CEC2","#5B8C5A","#0C7B93","#F1935C"], //ค่าสี
      clicked : [],//ตรวจสอบการเลือกที่นั่งแบบทีละที่นั่ง
      clicked2 : [],//ตรวจสอบการเลือกที่นั่งแบบทั้งแถว
      allSeatData:[],//เก็บข้อมูลการสอบทุกครั้งมารวมกัน
      fileSize:[],//เก็บขนาดรายวิชา
      subject:"",//เก็บชื่อรายวิชา
      itemSize:"",//เก็บขนาดวิชาที่ทำการจัดลงที่นั่ง
      subjectId_value:"",//เก็บรหัสวิชาทั้งหมด
      subjectName_value:"",//เก็บชื่อวิชาทั้งหมด
      tempData:[],//เก็บข้อมูลนักศึกษา
      checkSubject:[],//ตรวจสอบรายวิชา
      col_check:[],//ตรวจสอบหลัก
      col_name:[],//ชื่อหลัก
      arr3d:[],//เก็บค่าที่นั่งสอบรวม
      person:[],//เก็บชื่อนักศึกษา
      result:[],//ข้อมูลวิชาทั้งหมด
      teacherName_value:"",//เก็บชื่ออาจารย์
      allSubCode:[],//เก็บข้อมูลวิชาทั้งหมด
      personValue:[],//เก็บชื่อนักศึกษา
      seat_check:[],//เก็บเลขที่นั่งที่ใช้เเล้ว
      array:[],//ข้อมูลที่่ได้รับการจัดทั้งหมด
      unuse_Subject:[],//เก็บวิชาที่ไม่ได้ใช้
      date_time_start_mili:"", //เวลาที่สอบ
      date_time_end_mili:"", //เวลาที่สอบ
      active: '',//ตรวจสอบการเลือก
      name_data:"",//เก็บข้อมูลห้องที่ผู้ใช้เลือก
      start_time_check:"<?php echo $editroomuse_data->time_start_mili ?>",//เวลาเริ่มต้น
      end_time_check:"<?php echo $editroomuse_data->time_end_mili ?>",//เวลาสิ้นสุด
    }
    ,
    methods: {
      //ตรวจสอบเวลาซ้ำก่อนการบันทึกเลขที่นั่ง
      checkTime(){
        var self = this;
        this.date_time_start=this.time_start_hour+":"+this.time_start_mini;
        this.date_time_end=this.time_end_hour+":"+this.time_end_mini;
        var hourS = this.time_start_hour;
        var minS = this.time_start_mini.toString();
        var dateTimeS = new Date(this.dateExam+":"+hourS+":"+minS);
        var dateTimeMiliS =("human to milliseconds ::==",moment(dateTimeS, "YYYY-MM-DD HH:mm").valueOf());
        var hourE = this.time_end_hour;
        var minE = this.time_end_mini.toString();
        var dateTimeE = new Date(this.dateExam+":"+hourE+":"+minE);
        var dateTimeMiliE =("human to milliseconds ::==",moment(dateTimeE, "YYYY-MM-DD HH:mm").valueOf());
        this.date_time_start_mili = dateTimeMiliS*0.001;
        this.date_time_end_mili = dateTimeMiliE*0.001;
        var roomuse = []
        var allTime = []
        var roomuseDate = []
        roomuse = this.dataDateroom.filter(
          o => o.room_id == this.selectFloor
        );
        roomuseDate = roomuse.filter(
          o => o.date == this.dateExam
        );
        if(this.date_time_start_mili!=this.start_time_check&&this.date_time_end_mili!=this.end_time_check){
          for(var i of roomuseDate){
            if((this.date_time_start_mili >= i.time_start_mili && this.date_time_start_mili <= i.time_end_mili)||(this.date_time_end_mili >= i.time_start_mili && this.date_end_start_mili <= i.time_end_mili)){
              alert("ช่วงเวลาดังกล่าวถูกใช้แล้ว! กรุณาเลือกช่วงเวลาอื่น");
              return false;
              throw("stop");
            }
          }
        }
        return true;
      },
      //ตวจสอบเเละแสดงกรอบสีรายวิชาที่ถูกเลือก
      isActive(value) {
        return this.active === value;
      },
      //ข้อมูลวิชาที่ไม่ได้ใช้
      itemsContains(n) {
        return this.unuse_Subject.indexOf(n) > -1
      },
      //ค้นหารายวิชา
      search_index(nameKey, myArray){
        for (var i=0; i < myArray.length; i++) {
          if (myArray[i].id === nameKey) {
            return myArray[i];
          }
        }
      },
      //ลบรายวิชา
      delete_subject(subid){
        let self = this;
        for(let a of this.allSubject_id){
          if(a.id == subid){
            if(a.size != self.fileSize.find(element => element.id == subid).size){
              alert("ไม่สามารถดำเนินการลบข้อมูลได้ เนื่องจากรายวิชาถูกจัดที่นั่งแล้ว");
            }
            else{
              alert("ดำเนินการลบวิชา "+a.id+" "+a.name+" เสร็จสิ้น");
              this.allSubject_id.splice(this.allSubject_id.findIndex(e => e.id == subid),1);
            }
          }
        }
        $('#deleteModal').modal('hide');
      },
      //ค้นหาเลขที่นั่ง
      search_seat(nameKey){
        let c = nameKey.substr(0,1);
        let result = this.seat_check.find(element => element == nameKey);
        let length = this.seat_check.filter(x => x.substr(0,1) === c).length;
        if(this.person[this.subject].length != 0){
          if(result == null && length < this.rowAll){
            this.seat_check.push(nameKey.toString());
            return true;
          }
          else{
            return false;
          }
        }
        else{
          return false;
        }
      },
      //เพิ่มวิชา
      addSubject(){
        let self = this;
        let resultObject = this.search_index(self.subjectId_value, this.allSubject_id);
        if(resultObject){
          alert("ไม่สามารถนำเข้าข้อมูลได้ เนื่องจากมีรายวิชานี้อยู่แล้ว");
          $('#fileUploader').val('');
        }
        else{
          this.allSubject_id.push({
            id:self.subjectId_value,
            name:self.subjectName_value,
            size:self.fileSize.find(element => element.id == self.subjectId_value).size
          }
                                 );
          document.getElementById('submit').style.visibility = 'hidden';
        }
      },
      //ตรวจสอบรายวิชา
      validate_subject(){
        for(let i =0;i<this.array.length;i++){
          for(let j of this.array[i]){
            this.result.push(j);
          }
          this.unuse_Subject = [...new Set(this.result.map(item => item.subject))];
        }
      },
      //จัดลำดับการส่งข้อมูล
      async Beforprocess(){
      if(this.checkTime()){
        if(this.validate_size()){
        await this.processData();
        await this.validate_subject();
        this.passform();
       }
      }
    },
    //ตรวจสอบขนาดว่ามีนักศึกษาที่ยังไม่ได้รับการจัดสอบ
    validate_size(){
      let lastSize = 0;
      for(let a of this.allSubject_id){
        lastSize += a.size;
      }
      if(lastSize == 0){
        return true;
      }
      else{
        alert("มีจำนวนนิสิตที่ยังไม่ถูกจัดที่นั่ง");
        return false;
      }
    },
    //ตรวจสอบข้อมูลขั้นสุดท้ายเพื่อเพิ่มข้อมูลการสอบ
  processData(){
      var self = this;
      this.date_time_start=this.time_start_hour+":"+this.time_start_mini;
      this.date_time_end=this.time_end_hour+":"+this.time_end_mini;
      var hourS = this.time_start_hour;
      var minS = this.time_start_mini.toString();
      var dateTimeS = new Date(this.dateExam+":"+hourS+":"+minS);
      var dateTimeMiliS =("human to milliseconds ::==",moment(dateTimeS, "YYYY-MM-DD HH:mm").valueOf());
      var hourE = this.time_end_hour;
      var minE = this.time_end_mini.toString();
      var dateTimeE = new Date(this.dateExam+":"+hourE+":"+minE);
      var dateTimeMiliE =("human to milliseconds ::==",moment(dateTimeE, "YYYY-MM-DD HH:mm").valueOf());
      this.date_time_start_mili = dateTimeMiliS*0.001;
      this.date_time_end_mili = dateTimeMiliE*0.001;
      let list = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
      for(let loop = 0 ; loop<list.length;loop++){
        if(this.arr3d[list[loop]] != "undefined" && this.arr3d[list[loop]] != null){
          this.array.push(this.arr3d[list[loop]]);
        }
      }
      var roomuse_name;
      this.name_data = this.dataRooms.filter(
        o => o.id == this.selectFloor
      );
      roomuse_name = this.name_data[0].room_name;
      let temp = this.allSubCode;
      this.allSubCode=[];
      for(let data of temp){
        this.allSubCode.push({
          subcode:data.subcode,
          subname:data.subname,
          teacher:data.teacher,
          type_exam:self.type_exam,
          year:self.school_year,
          term:self.term,
          date:self.dateExam,
          timeS:self.date_time_start,
          timeE:self.date_time_end,
          timeSmili:self.date_time_start_mili,
          timeEmili:self.date_time_end_mili,
          floor:self.selectFloor,
          room_row:self.rowAll,  
          room_col:self.colAll,
          room_name:roomuse_name                   
        });
      }
    }
  ,
  //ส่งข้อมูลการสอบผ่านฟอร์ม
    passform(){
      $('form').submit();
    },
  //เลือกวิชา
  selectSubject(id){
      let self = this;
      if(this.subject == id){
        return 0;
      }
      else
        this.subject = id;
      for(let i = 0 ;i<self.fileSize.length;i++){
        if(self.fileSize[i].id ==id){
          this.itemSize = self.fileSize[i].size;
          if(!this.person[this.subject]){
            this.person[this.subject] = JSON.parse(JSON.stringify(self.tempFile[i].data)) 
          }
          else{
          }
        }
      }
    }
  ,
  //ลบข้อมูฃเลขที่นั่งสอบ
  removeData_seat(c,id){
      let  a = this.arr3d[c].filter(x=> x.seat == id && x.subject == this.subject);
      this.arr3d[c].splice(this.arr3d[c].findIndex(e => e.name === a[0].name),1);
      this.seat_check.splice(this.seat_check.findIndex(e => e === id),1);
      this.allSubject_id.find(element => element.id == this.subject).size +=1;
      this.person[this.subject].push({
        รหัสนิสิต:a[0].id,
        ชื่อ:a[0].name,
        ชั้นปี:a[0].year,
        กลุ่ม:a[0].group
      });
      return true;
    },
    //ตรวจสอบการเลือกทีละที่นั่ง
  checkOne_validate(id){
        let result = this.seat_check.find(element => element == id);
        if(result == null){
          if(this.person[this.subject].length == 0){
              alert("ไม่มีข้อมูลเพียงพอ");
              return false;
          }else{
            return true;
          }
        }
        else{
          return true;
        }
  },
     //ตรวจสอบการเลือกหลายที่นั่ง
  checkAll_validate(c){
        let result = this.seat_check.find(element => element.substr(0,1) == c);
        if(result == null){
          if(this.person[this.subject].length == 0){
              alert("ไม่มีข้อมูลเพียงพอ");
              return false;
          }else{
            return true;
          }
        }
        else{
          return true;
        }
  },
    // เลือกที่นั่งแบบทีละที
    checkOne(id){
      if(!this.subject){
        return 0;
      }
      if(this.checkOne_validate(id)== false){
        return 0;
      }
      let c=id.substr(0,1);
      if(this.col_name[c]!=c){
        this.col_name[c]=c;
        this.col_check = 0;
        this.tempData = [];
      }
      else if(this.col_name[c]==c){
        this.tempData = [];
        let item = JSON.parse(JSON.stringify(this.arr3d[c]));
        for(let i of item){
          this.tempData.push(i);
          this.col_check = item.length;
        }
      }
      if(this.checkSubject==""){
        this.allSubject_id.find(element => element.id == this.subject).size -=1;
        this.checkSubject=this.subject;
        $("input[id='"+id+"']").prop("checked", !this.clicked2[id]);
        $('#'+id).css({
          "background-color": this.randomColor(this.subject),"color":"white"}
                     );
        if(!this.search_seat(id)){
          alert("ที่นั่งถูกใช้แล้ว");
          return 0;
        }
        this.personValue = this.person[this.subject].shift();
        this.tempData.push({
          seat:id,subject:this.subject,name:this.personValue.ชื่อ,id:this.personValue.รหัสนิสิต,year:this.personValue.ชั้นปี,group:this.personValue.กลุ่ม,room:this.selectFloor}
                          );
        this.col_check= this.tempData.length;
        this.arr3d[c]= this.tempData;
      }
      else if(this.checkSubject!=this.subject){
        if(!this.search_seat(id)){
          if(this.arr3d[c].find(x=> x.seat == id && x.subject == this.subject)){
            $('#'+id).css({
              "background-color": "transparent","color":"black"}
                         );
            this.removeData_seat(c,id);
            return 0;
          }
          else{
            alert("ที่นั่งถูกใช้แล้ว");
            return 0;
          }
        }
        if((this.allSubject_id.find(element => element.id == this.subject).size != 0)){
          this.allSubject_id.find(element => element.id == this.subject).size -=1;
          this.personValue = this.person[this.subject].shift();
          this.checkSubject=this.subject;
          $("input[id='"+id+"']").prop("checked", !this.clicked2[id]);
          $('#'+id).css({
            "background-color": this.randomColor(this.subject),"color":"white"}
                       );
          this.tempData.push({
            seat:id,subject:this.subject,name:this.personValue.ชื่อ,id:this.personValue.รหัสนิสิต,year:this.personValue.ชั้นปี,group:this.personValue.กลุ่ม,room:this.selectFloor}
                            );
          this.col_check= this.tempData.length;
          this.arr3d[c]= this.tempData;
        }
      }
      else if(this.checkSubject==this.subject){
        if(!this.search_seat(id)){
          if(this.arr3d[c].find(x=> x.seat == id && x.subject == this.subject)){
            $('#'+id).css({
              "background-color": "transparent","color":"black"}
                         );
            this.removeData_seat(c,id);
            return 0;
          }
          else if(this.seat_check.find(e => e === id)){
            alert("ที่นั่งถูกใช้แล้ว");
            return 0;
          }
        }
        if((this.allSubject_id.find(element => element.id == this.subject).size != 0) ){
          this.allSubject_id.find(element => element.id == this.subject).size -=1;
          $("input[id='"+id+"']").prop("checked", !this.clicked2[id]);
          $('#'+id).css({
            "background-color": this.randomColor(this.subject),"color":"white"}
                       );
          this.personValue = this.person[this.subject].shift();
          this.tempData.push({
            seat:id,subject:this.subject,name:this.personValue.ชื่อ,id:this.personValue.รหัสนิสิต,year:this.personValue.ชั้นปี,group:this.personValue.กลุ่ม,room:this.selectFloor}
                            );
          this.arr3d[c]= this.tempData;
          this.col_check=this.tempData.length;
        }
      }
    }
  ,
    // เลือกที่นั่งแบบเลือกทั้งหลัก
    checkAll(c){
      if(!this.subject){
        return 0;
      }
      if(this.checkAll_validate(c)==false){
        return 0;
      }
      
      let i =1;
      let a = 1;
      let self = this;
      if(this.col_name[c]!=c){
        this.col_name[c]=c;
        this.col_check = 0;
        this.tempData = [];
      }
      else if(this.col_name[c]==c){
        this.tempData = [];
       
        let item = JSON.parse(JSON.stringify(this.arr3d[c]));
        for(let i of item){
          this.tempData.push(i);
          this.col_check = item.length;
        }
      }
      if(this.checkSubject==""){
        this.checkSubject=this.subject;
        for(i=1;i<=this.rowAll;i++){
          if((this.allSubject_id.find(element => element.id == this.subject).size != 0)){
            if(this.search_seat(c+i)){
              this.personValue = this.person[this.subject].shift();
              this.allSubject_id.find(element => element.id == this.subject).size -=1;
              $("input[id='"+c+i+"']").prop("checked", !this.clicked2[c+i]);
              $('#'+c+i).css({
                "background-color": this.randomColor(this.subject),"color":"white"}
                            );
              this.tempData.push({
                seat:c+parseInt(this.col_check+1),subject:this.subject,name:this.personValue.ชื่อ,id:this.personValue.รหัสนิสิต,year:this.personValue.ชั้นปี,group:this.personValue.กลุ่ม,room:this.selectFloor}
                                );
              this.col_check= this.tempData.length;
              this.arr3d[c]= this.tempData;
            }
            else{
              alert("แถวเต็มแล้ว");
              return 0;
            }
          }
        }
      }
      else if(this.checkSubject!=this.subject){
        this.checkSubject=this.subject 
        let status = true;
        if(this.arr3d[c] != null){
          for(i=1;i<=this.rowAll;i++){
            if(this.arr3d[c].find(x=> x.seat == c+i && x.subject == this.subject)){
              $('#'+c+i).css({
                "background-color": "transparent","color":"black"}
                            );
              this.removeData_seat(c,c+i);
              status = false;
            }
          }
        }
        if(status == true && this.seat_check.find(e => e != c+i)){
          for(i=1;i<=this.rowAll;i++){
            if(this.search_seat(c+i)){
              this.personValue = this.person[this.subject].shift();
              this.allSubject_id.find(element => element.id == this.subject).size -=1;
              $("input[id='"+c+i+"']").prop("checked", !this.clicked2[c+i]);
              $('#'+c+i).css({
                "background-color": this.randomColor(this.subject),"color":"white"}
                            );
              this.tempData.push({
                seat:c+parseInt(this.col_check+1),subject:this.subject,name:this.personValue.ชื่อ,id:this.personValue.รหัสนิสิต,year:this.personValue.ชั้นปี,group:this.personValue.กลุ่ม,room:this.selectFloor}
                                );
              this.col_check= this.tempData.length;
              this.arr3d[c]= this.tempData;
            }
          }
        }
      }
      else if(this.checkSubject==this.subject){
        let status = true;
        if(this.arr3d[c] != null){
          for(i=1;i<=this.rowAll;i++){
            if(this.arr3d[c].find(x=> x.seat == c+i && x.subject == this.subject)){
              $('#'+c+i).css({
                "background-color": "transparent","color":"black"}
                            );
              this.removeData_seat(c,c+i);
              status = false;
            }
          }
        }
        if(status == true ){
          for(i=1;i<=this.rowAll;i++){
            if(this.search_seat(c+i)){
              this.personValue = this.person[this.subject].shift();
              this.allSubject_id.find(element => element.id == this.subject).size -=1;
              $("input[id='"+c+i+"']").prop("checked", !this.clicked2[c+i]);
              $('#'+c+i).css({
                "background-color": this.randomColor(this.subject),"color":"white"}
                            );
              this.tempData.push({
                seat:c+i,subject:this.subject,name:this.personValue.ชื่อ,id:this.personValue.รหัสนิสิต,year:this.personValue.ชั้นปี,group:this.personValue.กลุ่ม,room:this.selectFloor}
                                );
              this.arr3d[c]= this.tempData;
              this.col_check=this.tempData.length;
            }
          }
        }
      }
    },
  //สุ่มค่าสี
    randomColor(id) {
      return this.colorCache[id] || (this.colorCache[id] = this.color.pop());
    }
  ,//เพิ่มข้อมูลไฟล์ Excel
  addDataExcel(evt){
      document.getElementById('submit').style.visibility = 'visible';
      let self=this;
      if(self.fileSize.length>=10)
      {
        alert("ไม่สามารถดำเนินการนำเข้าข้อมูลได้ เนื่องจากมีปริมาณข้อมูลเกินกำหนด");
        document.getElementById('submit').style.visibility = 'visible';
        return 0;
      }
      var selectedFile = evt.target.files[0];
      var reader = new FileReader();
      reader.onload = function(e) {
        var data = e.target.result;
        var workbook = XLSX.read(data, {
          type: 'binary'
        });
        var sheetNames = workbook.SheetNames;
        var sheet_subjectId = workbook.SheetNames[0];
        var sheet_subjectName = workbook.SheetNames[0];
        var sheet_teacherName = workbook.SheetNames[0];
        var worksheet1 = workbook.Sheets[sheet_subjectId];
        var worksheet2 = workbook.Sheets[sheet_subjectName];
        var worksheet3 = workbook.Sheets[sheet_teacherName];
        var desired_cell1 = worksheet1['A1'];
        var desired_cell2 = worksheet2['B1'];
        var desired_cell3 = worksheet2['C1'];
        self.subjectId_value = (desired_cell1 ? desired_cell1.v : undefined);
        self.subjectName_value = (desired_cell2 ? desired_cell2.v : undefined);
        self.teacherName_value = (desired_cell3 ? desired_cell3.v : undefined);
        let message_a;
        let message_b;
        let message_c;
        if(self.subjectId_value && !self.subjectName_value && !self.teacherName_value){
          alert("ไม่พบข้อมูล รหัสวิชา ชื่อวิชาและชื่ออาจารย์ผู้สอน");
          throw("error xlsx file");
        }
        if(!self.subjectId_value){
          message_a="'รหัสวิชา'";
          alert("ไม่พบข้อมูล "+message_a+" กรุณาตรวจสอบไฟล์ก่อนดำเนินการ");
          throw("error xlsx file");
        }
        if(!self.subjectName_value){
          message_b="'ชื่อวิชา'";
          alert("ไม่พบข้อมูล "+message_b+" กรุณาตรวจสอบไฟล์ก่อนดำเนินการ");
          throw("error xlsx file");
        }
        if(!self.teacherName_value){
          message_c="'ชื่อวิชา'";
          alert("ไม่พบข้อมูล "+message_c +" กรุณาตรวจสอบไฟล์ก่อนดำเนินการ");
          throw("error xlsx file");
        }
        if(self.subjectId_value && self.subjectName_value && self.teacherName_value){
          self.allSubCode.push({
            subcode:self.subjectId_value,
            subname:self.subjectName_value,
            teacher:self.teacherName_value,
          });
          var indexArray = [];
          workbook.SheetNames.forEach(function(sheetName) {
            self.dataSeatObj = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName],{
              range:1
            });
          });
          if(self.dataSeatObj.length!=0){
            self.tempFile.push({
              "subId":self.subjectId_value,
              "subName":self.subjectName_value,
              "data":self.dataSeatObj,
            });
            self.fileSize.push({
              id:self.subjectId_value,
              size:self.dataSeatObj.length,
            });
          }
        }
      };
      reader.onerror = function(event) {
        console.error("File could not be read! Code " + event.target.error.code);
      };
      reader.readAsBinaryString(selectedFile);
    },
  },//methods
      computed: {
        //ค่าชั่วโมง
          get_hour(){
            var hour = [];
            for(let i=1;i<=24;i++){
              if(i<10){
                hour.push("0"+i)
              }
              else{
                hour.push(i)
              }
            }
            return hour
          },
          //ค่านาที
          get_minute(){
            var num = "";
            var mini = [];
            for(let i=0;i<=59;i++){
              if(i%5==0){
                if(i<10){
                  mini.push("0"+i)
                }
                else{
                  mini.push(i)
                }
              }
            }
            return mini
          },
          //รายวิชาทั้งหมด
          allsubcode(){
            return this.allSubCode;
          },
          //สร้างปีการศึกษา
          get_year(){
            var item = [];
            var currenDate = new Date();
            var formattedCurren = moment(currenDate).format("L");
            var yearcurren =formattedCurren.substr(6,4)
            var inYear = parseInt(yearcurren)
            var Startyear = (inYear-1)+543;
            var Endyear = (inYear+1)+543;
            for(let i=Startyear;i<=Endyear;i++){
              item.push(i);
            }
            return item;
          },
           //รายวิชาทั้งหมด
          dataSubjects(){
            return this.allSubCode;
          },
           //ข้อมูลเลขที่นั่งสอบทั้งหมด
          datafinal(){
            return this.result;
          },
          //ตรวจสอบปุ่มการบันทึก
          checkButtonSave(){
            if(!this.type_exam||!this.school_year||!this.term||!this.dateExam||!this.time_start_hour||!this.time_start_hour||!this.time_end_hour||!this.time_end_hour||!this.selectFloor||!this.fileupload){
              return true
            }
          },
          //ตรวจสอบหากยังไม่ได้เพิ่มข้อมูลจะไม่แสดงปุ่ม
          checkTempdata(){
            if(this.tempData==""){
              return true
            }
          },
          //แสดงรหัสวิชาทั้งหมด
          get_allsubject_data(){
            return this.allSubject_id 
          },
          //ส่งข้อมูลแถวผัง
          dataRow(){
            var list = [];
            for (var i = 1; i <= 1000; i++) {
              list.push(i);
            }
            var obj = [];
            for (let i = 0; i < this.rowAll; i++){
              obj.push({
                number: list[i]
              }
                      );
            }
            return obj;
          },
          //ส่งข้อมูลหลักผัง
          dataCol(){
            var list = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
            var obj = []
            for(let i =0;i<this.colAll;i++){
              obj.push({
                char: list[i]
              }
                      );
            }
            return obj;
          },
      }
  ,
  }
  )
</script>

<style>
  .time-select{
    margin:5px;
    width:100px; 
    height:35px;
  }
  .modal-backdrop.in {
	  opacity: 0.3;
    transition: opacity .1s linear;
  }
  .seat-layout{
    display: inline-block; 
    margin-right:25px; 
    margin-bottom:10px;
  }
  .close{
    font-size: 18px;
    background-color: red !important;
    color: white !important;
    width: 20px;
    height: 30px;
    padding: 0px;
    font-weight: 600;
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
  .active, .btn:hover {
    background-color: #666;
    color: white;
  }
  .seatBox{
    width:40px;
    height:40px;
  }
  .seatName{
    margin-top:10px;
    width:35px;
  }
  @media only screen and (max-width: 1280px) {
    .time-select{
      margin:5px;
      width:auto; 
      height:35px;
    }
    .seat-layout{
      display: inline-block; 
      margin-right:10px; 
    }
    .seatBox{
      width:25px;
      height:20px;
    }
    .seatName{
      text-align:left;
      width:25px;
      font-size:12px;
    }
  }
  .active {
    padding: 10px;
    border: 3px solid black;
    border-color: #2ECC71;
    color: #2ECC71;
    box-shadow: 0 0 20px #2ECC71;
  }
</style>