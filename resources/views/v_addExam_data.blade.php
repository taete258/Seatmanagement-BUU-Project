<!-- 
  Author: รัชชานนท์ พึ่งตา,นติรุต ดวงภาค
  ID : 59160683,59161030
  Desciption: หน้า View สำหรับการสร้างการสอบ
  Input: ไฟล์รายชื่อนักศึกษา
  Output: ข้อมูลที่นั่งสอบ
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

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script lang="javascript" src="../js/sheetjs-master/dist/xlsx.full.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/vue">
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head>
  <link rel="shortcut icon" href="/icon/sms.png" />   
  <title>สร้างการสอบ
  </title>
</head>
<body style="background-color:#d3d3d3ad">
<div>
  @include('navbar')
</div>
<div  id="demo" style="margin-top:75px;margin-left:1%;margin-right:1%;">
<div class="card ">
    <h5 class="card-header  text-white" style="background-color:#004a99;">สร้างที่นั่งสอบ
    </h5>
    <div class="card-body panel-border">
  <div class="card ">
    <h5 class="card-header bg-primary text-white">เพิ่มข้อมูลสำหรับจัดที่นั่งสอบ
    </h5>
    <div class="card-body panel-border">
      <?php foreach ($rud as $rd) ?>
      <?php foreach ($rmd as $rm) ?>
      <form action="/add-manage" method="post" >
        @csrf
        <div class="row">
        <div  class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 ">
            <label>ปีการศึกษา
            </label>
            <select v-model="school_year" class="form-control" :class="(!school_year)?'require requirefocus':'complete completefocus'" style="height:49px;">
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
            <select class="form-control" v-model="term"  :class="(!term)?'require requirefocus':'complete completefocus'"  style="height:49px;">
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
            <select class="form-control " v-model="type_exam"   :class="(!type_exam)?'require requirefocus':'complete completefocus'" style="height:49px;">
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
            <input class="form-control" type="date" id="date" :class="(!exam_date)?'require requirefocus':'complete completefocus'" name="date" v-model="exam_date" style="height:49px;"/> 
          </div>
          <div class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 " style="margin-top:10px">
            <label>เวลาเริ่มการสอบต้น
            </label>
            <div class="card" :class="(!time_start_hour||!time_start_mini)?'require requirefocus':'complete completefocus'" >
              <div align="center">
                <table  >
                  <tr>
                    <td style="width:15px">
                      <select v-model="time_start_hour" class="form-control time-select" >
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
                      <select v-model="time_start_mini" class="form-control time-select" >
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
            <label>เวลาสิ้นสุดการสอบ
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
            <select class="form-control" @change="set_room_data($event)" v-model="floor_select_data" :class="(!floor_select_data)?'require requirefocus':'complete completefocus'" style="height:49px;" >
              <option value="" selected disabled hidden>เลือกห้อง
              </option> 
              @foreach ($rmd as $rm)
              <option value="<?php echo $rm->id; ?>">
                <?php echo $rm->room_name; ?>&nbsp;&nbsp;&nbsp;&nbsp; 
                <?php echo $rm->room_row * $rm->room_col; ?> ที่นั่ง  &nbsp;&nbsp;&nbsp;&nbsp; 
                <?php echo $rm->room_row; ?> แถว  
                <?php echo $rm->room_col; ?> หลัก  
              </option>
              @endforeach
            </select>
          </div>
          <div  class=" col-xs-12 col-sm-6  col-md-3  col-lg-3 " style="margin-top:10px">
            <label>อัปโหลดไฟล์รายชื่อผู้มีผู้มีสิทธิ์สอบ
              <a href="../file_template/template-file.xlsx" download="template-file">Template
              </a>
            </label> 
            <input type="file"  class="form-control" id="fileUploader" :class="(!fileupload)?'require requirefocus':'complete completefocus'"  v-model="fileupload" name="fileUploader" accept=".xls, .xlsx" @change="read_excel_file($event)" style="height:49px;" />
          </div>
        </div>
        <br>
        <!-- ส่วนของการกำหนดค่า v-model เพื่อส่งไปยัง controller -->
        <div class=" col-xs-12 col-sm-6 col-md-4  col-lg-3" v-for="(item, index) in get_data_processed">
          <div class="col-md-12 " hidden>
            <input v-model="get_data_processed[index].seat"  class="form-control" type="text" name="seatdata[]" id="seatdata" >
            <input v-model="get_data_processed[index].subject"  class="form-control" type="text" name="subdata[]" id="subdata">
            <input v-model="get_data_processed[index].name"  class="form-control" type="text" name="namedata[]" id="namedata">
            <input v-model="get_data_processed[index].id"  class="form-control" type="text" name="codedata[]" id="codedata"> 
            <input v-model="get_data_processed[index].group"  class="form-control" type="text" name="groupdata[]" id="groupdata">
            <input v-model="get_data_processed[index].room"  class="form-control" type="text" name="roomdata[]" id="roomdata">
          </div>
          <div v-for="(item, index) in get_allsubject_code" hidden >
            <input v-model="get_allsubject_code[index].timeSmili"  class="form-control" type="text" name="timeSmili_dat[]" id="timeSmili_dat" >
            <input v-model="get_allsubject_code[index].timeEmili"  class="form-control" type="text" name="timeEmili_dat[]" id="timeEmili_dat">
            <input v-model="get_allsubject_code[index].date"  class="form-control" type="text" name="date_data[]" id="date_data">
            <div hidden  v-if="subject_unuse(get_allsubject_code[index].subcode)">
            </div>
          </div>
        </div>
        <div v-for="(item, index) in get_allsubject_code" >
          <div hidden  v-if="subject_unuse(get_allsubject_code[index].subcode)">
            <input v-model="get_allsubject_code[index].subcode"  class="form-control" type="text" name="sub_id_data[]" id="sub_id_data" >
            <input v-model="get_allsubject_code[index].subname"  class="form-control" type="text" name="sub_name_data[]" id="sub_name_data">
            <input v-model="get_allsubject_code[index].teacher"  class="form-control" type="text" name="teacher_name_data[]" id="teacher_name_data">
            <input v-model="get_allsubject_code[index].type_exam"  class="form-control" type="text" name="type_exam_data[]" id="type_exam_data" >
            <input v-model="get_allsubject_code[index].year"  class="form-control" type="text" name="year_data[]" id="year_data" >
            <input v-model="get_allsubject_code[index].term"  class="form-control" type="text" name="term_data[]" id="term_data">
            <input v-model="get_allsubject_code[index].date"  class="form-control" type="text" name="date_data[]" id="date_data">
            <input v-model="get_allsubject_code[index].timeS"  class="form-control" type="text" name="timeS_data[]" id="timeS_data" >
            <input v-model="get_allsubject_code[index].timeE"  class="form-control" type="text" name="timeE_data[]" id="timeE_data">
            <input v-model="get_allsubject_code[index].timeSmili"  class="form-control" type="text" name="timeSmili_data[]" id="timeSmili_data" >
            <input v-model="get_allsubject_code[index].timeEmili"  class="form-control" type="text" name="timeEmili_data[]" id="timeEmili_data">
            <input v-model="get_allsubject_code[index].floor"  class="form-control" type="text" name="floor_data[]" id="floor_data" >
            <input v-model="get_allsubject_code[index].room_row"  class="form-control" type="text" name="room_row_data[]" id="room_row_data" >
            <input v-model="get_allsubject_code[index].room_col"  class="form-control" type="text" name="room_col_data[]" id="room_col_data" >
            <input v-model="get_allsubject_code[index].room_name"  class="form-control" type="text" name="room_name_data[]" id="room_name_data" >
          </div>
        </div>
      </form>
      <div align="right">
        <a class="btn btn-primary text-white text-right" id="submit" @click="subject_add()"  v-show="!validate_data_input"  >นำเข้าไฟล์
        </a>
      </div>
      <br>
    </div> 
  </div>

  <!-- ส่วนของการแสดงผลการจัดที่นั่ง -->
  <div class="card " style="margin-top:20px;" id="seat_layout">
    <h5 class="card-header bg-primary text-white">ตารางที่นั่ง
    </h5>  
    <div class="card-body panel-border">
      <div align="center"  >
        <div id="subjectID"  v-for="(sjd, val) in get_allsubject_data" :key="val" style="display: inline-block;margin:10px; " >
        <a class="btn close" @click="delete_subject(sjd.id)" id="sjd.id">x</a>
          <div v-bind:id="sjd.id" @click.prevent="active = get_allsubject_data[val].id" :class="{active:isActive(get_allsubject_data[val].id) }" class="btn text-white"  :style="{backgroundColor: random_subject_color(sjd.id)}" @click="select_subject(sjd.id)">
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
        <div v-for="(dr, val) in get_row_data" :key="val" >
          <div class="seat-layout"v-for="(dc, valr) in get_col_data" :key="valr">
            <div v-if="dr.number == '1'">
              <button @click="click_checkall(dc.char)">@{{dc.char}}
              </button>
            </div>
            <td>
              <div class="card border border-primary  " style="margin-top:10px; "  @click=click_checkone(dc.char+dr.number) >
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
        <a class="btn btn-success m-3 text-white" id="save"  v-show="!validate_btn_data" @click="before_process()">บันทึก
        </a>   
      </div>
    </div>
  </div>
</div>
</div>
</div>
</body>

<script>
  var demo = new Vue({
    el:'#demo',
    data:{
      room_data: JSON.parse(JSON.stringify(<?php echo json_encode($rmd) ?>)),//ข้อมูลห้อง
      date_roomuse_data:JSON.parse(JSON.stringify(<?php echo json_encode($rud) ?>)),//ข้อมูลห้องที่ได้รับการจัดแล้ว
      type_exam:"", //ชนิดการสอบ
      school_year:"", //ปีการศึกษา
      term:"", //เทอม
      exam_date:"", //วันที่สอบ
      date_time_start:"", //เวลาที่สอบ
      date_time_end:"", //เวลาที่สอบ
      date_time_start_mili:"", //เวลาที่สอบ
      date_time_end_mili:"", //เวลาที่สอบ
      floor_select_data:"", //เลือกชั้น
      fileupload:"",//ไฟล์ excel
      temp_file_data:[],// ตัวแปลพักข้อมูลจากไฟล์
      seat_obj_data:[],// obj ของข้อมูลนำเข้าการสอบทั้งหมด
      row_data:"", //เก็บแถวของห้อง
      col_data:"", //เก็บหลักของห้อง
      allsubject_id: [], //เก็บรหัสวิชาที่เพิ่มทั้งหมด
      color_cache: {}, //เก็บค่าสี
      color:["#ED4938", "#ADC607", "#F4C10D", "#DE3974", "#F87117", "7B3DBA", "#03CEC2","#5B8C5A","#0C7B93","#F1935C"], //ค่าสี
      clicked_seat_id : [],//ตรวจสอบการเลือกที่นั่งแบบทั้งแถว
      file_size:[],//เก็บขนาดรายวิชา
      subject:"",//วิชา
      item_size:"",//ขนาดไฟล์
      subjectid_value:"",//เก็บรหัสวิชาทั้งหมด
      subjectname_value:"",//เก็บชื่อวิชาทั้งหมด
      temp_std_data:[],//เก็บข้อมูลนักศึกษา
      check_subject:[],//ตรวจสอบรายวิชา
      col_check:[],//ตรวจสอบหลัก
      col_name:[],//ชื่อหลัก
      seat_data:[],//เก็บค่าที่นั่งสอบรวม
      person:[],//เก็บชื่อนักศึกษา
      result:[],//ข้อมูลวิชาทั้งหมด
      teacher_name_value:"",//เก็บชื่ออาจารย์
      allsubject_code:[],//เก็บข้อมูลวิชาทั้งหมด
      person_value:[],// value รายชื่อ
      time_start_hour:"",//ชม.เริ่มสอบ
      time_start_mini:"",//นาทีเริ่มสอบ
      time_end_hour:"",//ชม.สิ้นสุดการสอบ
      time_end_mini:"",//นาทีสิ้นสุดการสอบ
      seat_check:[],//เก็บเลขที่นั่งที่ใช้เเล้ว
      data_processed:[],//ข้อมูลที่่ได้รับการจัดทั้งหมด
      unuse_subject_data:[],//เก็บวิชาที่ไม่ได้ใช้
      active: '',//ตรวจสอบการเลือกวิชา
      room_name_data:""//เก็บข้อมูลห้องที่ผู้ใช้เลือก
    }
    ,
    methods: {
      //ตรวจสอบเวลาว่าซ้ำกับเวลาที่เคยมีการจัดเหลือไม่
      check_time_use(){
        var self = this;
        this.date_time_start=this.time_start_hour+":"+this.time_start_mini;
        this.date_time_end=this.time_end_hour+":"+this.time_end_mini;
        var hours = this.time_start_hour;
        var mins = this.time_start_mini.toString();
        var datetimes = new Date(this.exam_date+":"+hours+":"+mins);
        var datetime_milis =("human to milliseconds ::==",moment(datetimes, "YYYY-MM-DD HH:mm").valueOf());
        var hour_e = this.time_end_hour;
        var min_e = this.time_end_mini.toString();
        var datetime_e = new Date(this.exam_date+":"+hour_e+":"+min_e);
        var datetime_milie =("human to milliseconds ::==",moment(datetime_e, "YYYY-MM-DD HH:mm").valueOf());
        this.date_time_start_mili = datetime_milis*0.001;
        this.date_time_end_mili = datetime_milie*0.001;
        var roomuse = [];
        var alltime = [];
        var roomuseDate = [];
        roomuse = this.date_roomuse_data.filter(
          o => o.room_id == this.floor_select_data
        );
        roomuseDate = roomuse.filter(
          o => o.date == this.exam_date
        );
        for(var i of roomuseDate){
          if((this.date_time_start_mili >= i.time_start_mili && this.date_time_start_mili <= i.time_end_mili)||(this.date_time_end_mili >= i.time_start_mili && this.date_end_start_mili <= i.time_end_mili)){
            alert("ช่วงเวลาดังกล่าวถูกใช้แล้ว! กรุณาเลือกช่วงเวลาอื่น");
            return false;
            throw("stop");
          }
        }
        return true;
      }
      ,
      //ตวจสอบเเละแสดงกรอบสีรายวิชาที่ถูกเลือก
      isActive(value) {
        return this.active === value;
      }
      ,
      //ข้อมูลวิชาที่ไม่ได้ใช้
      subject_unuse(n) {
        return this.unuse_subject_data.indexOf(n) > -1;
      }
      ,
       //ค้นหารายวิชา
      search_index(nameKey, myArray){
        for (var i=0; i < myArray.length; i++) {
          if (myArray[i].id === nameKey) {
            return myArray[i];
          }
        }
      }
      ,
      //ฟังก์ชันสำหรับเพื่อลบข้อมูลวิชาที่ไม่ต้องการ
      delete_subject(subid){
        let self = this;
        for(let a of this.allsubject_id){
          if(a.id == subid){
            if(a.size != self.file_size.find(element => element.id == subid).size){
              alert("ไม่สามารถดำเนินการลบข้อมูลได้ เนื่องจากรายวิชาถูกจัดที่นั่งแล้ว");
            }
            else{
              alert("ดำเนินการลบวิชา "+a.id+" "+a.name+" เสร็จสิ้น");
              this.allsubject_id.splice(this.allsubject_id.findIndex(e => e.id == subid),1);
            }
          }
        }
        $('#deleteModal').modal('hide');

      },
      // ฟังก์ชันค้นหาที่นั่งในตัวแปร
      search_seat(nameKey){
        let c = nameKey.substr(0,1);
        let result = this.seat_check.find(element => element == nameKey);
        let length = this.seat_check.filter(x => x.substr(0,1) === c).length;
        if(this.person[this.subject].length != 0){
          if(result == null && length < this.row_data){
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
      }
      ,
      // เพิ่มวิชาเข้าสู่ตัวแปร Array
      subject_add(){
        let self = this;
        let resultObject = this.search_index(self.subjectid_value, this.allsubject_id);
        if(resultObject){
          alert("ไม่สามารถนำเข้าข้อมูลได้ เนื่องจากมีรายวิชานี้อยู่แล้ว");
          $('#fileUploader').val('');
        }
        else{
          this.allsubject_id.push({
            id:self.subjectid_value,
            name:self.subjectname_value,
            size:self.file_size.find(element => element.id == self.subjectid_value).size
          }
                                 );
          document.getElementById('submit').style.visibility = 'hidden';
        }
      }
      ,//ตรวจสอบการเพิ่มรหัสวิชาว่ามีอยู่แล้วหรือไม่
      validate_subject(){
        for(let i =0;i<this.data_processed.length;i++){
          for(let j of this.data_processed[i]){
            this.result.push(j);
          }
          this.unuse_subject_data = [...new Set(this.result.map(item => item.subject))];
        }
      },
    // รวมการทำงานก่อนทำการส่งไป controller
    async before_process(){
      if(this.check_time_use()){
        if(this.validate_subject_size()){
        await this.process_data();
        await this.validate_subject();
        this.submit_form();
       }
      }
    }
    ,
    // ตรวจสอบจำนวนคนที่เหลือในแต่ละวิชา
    validate_subject_size(){
      let lastSize = 0;
      for(let a of this.allsubject_id){
        lastSize += a.size;
      }
      if(lastSize == 0){
        return true;
      }
      else{
        alert("มีจำนวนนิสิตที่ยังไม่ถูกจัดที่นั่ง");
        return false;
      }
    }
  ,
  // เตรียม และจัดกลุ่มข้อมูลก่อนส่งไป controller
    process_data(){
      var self = this;
      this.date_time_start=this.time_start_hour+":"+this.time_start_mini;
      this.date_time_end=this.time_end_hour+":"+this.time_end_mini;
      var hours = this.time_start_hour;
      var mins = this.time_start_mini.toString();
      var datetimes = new Date(this.exam_date+":"+hours+":"+mins);
      var datetime_milis =("human to milliseconds ::==",moment(datetimes, "YYYY-MM-DD HH:mm").valueOf());
      var hour_e = this.time_end_hour;
      var min_e = this.time_end_mini.toString();
      var datetime_e = new Date(this.exam_date+":"+hour_e+":"+min_e);
      var datetime_milie =("human to milliseconds ::==",moment(datetime_e, "YYYY-MM-DD HH:mm").valueOf());
      this.date_time_start_mili = datetime_milis*0.001;
      this.date_time_end_mili = datetime_milie*0.001;
      let list = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
      for(let loop = 0 ; loop<list.length;loop++){
        if(this.seat_data[list[loop]] != "undefined" && this.seat_data[list[loop]] != null && this.seat_data[list[loop]]!= []){
          this.data_processed.push(this.seat_data[list[loop]]);
        }
      }
      var roomuse_name;
      this.room_name_data = this.room_data.filter(
        o => o.id == this.floor_select_data
      );
      roomuse_name = this.room_name_data[0].room_name;
      let temp = this.allsubject_code;
      this.allsubject_code=[];
      for(let data of temp){
        this.allsubject_code.push({
          subcode:data.subcode,
          subname:data.subname,
          teacher:data.teacher,
          type_exam:self.type_exam,
          year:self.school_year,
          term:self.term,
          date:self.exam_date,
          timeS:self.date_time_start,
          timeE:self.date_time_end,
          timeSmili:self.date_time_start_mili,
          timeEmili:self.date_time_end_mili,
          floor:self.floor_select_data,
          room_row:self.row_data,  
          room_col:self.col_data,
          room_name:roomuse_name                   
        });
      }
      console.log(JSON.parse(JSON.stringify(this.data_processed)));
    }
  ,//เพิ่มข้อมูลการสอบ
    submit_form(){
      $('form').submit();
    }
  ,
    // กดเพื่อเลือกรายวิชา
    select_subject(id){
      let self = this;
      if(this.subject == id){
        return 0;
      }
      else
        this.subject = id;
      for(let i = 0 ;i<self.file_size.length;i++){
        if(self.file_size[i].id ==id){
          this.item_size = self.file_size[i].size;
          if(!this.person[this.subject]){
            this.person[this.subject] = JSON.parse(JSON.stringify(self.temp_file_data[i].data)) 
          }
          else{
          }
        }
      }
    }
  ,// ลบข้อมูลที่นั่งเมื่อเลือก
    remove_seat_data(c,id){
      console.log(id);
      let  a = this.seat_data[c].find(x=> x.seat == id && x.subject == this.subject);
      this.seat_data[c].splice(this.seat_data[c].findIndex(e => e.name == a.name),1);
      this.seat_check.splice(this.seat_check.findIndex(e => e == id),1);
      this.allsubject_id.find(element => element.id == this.subject).size +=1;
      this.person[this.subject].push({
        รหัสนิสิต:a.id,
        ชื่อ:a.name,
        ชั้นปี:a.year,
        กลุ่ม:a.group
      });
      return true;
    }
  ,
  //ตรวจสอบการเลือกทีละที่นั่ง
  checkone_validate(id){
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
  checkall_validate(c){
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
    click_checkone(id){
      console.log(id);
      if(!this.subject){
        return 0;
      }
      if(this.checkone_validate(id)== false){
        return 0;
      }
      let c=id.substr(0,1);
      if(this.col_name[c]!=c){
        this.col_name[c]=c;
        this.col_check = 0;
        this.temp_std_data = [];
      }
      else if(this.col_name[c]==c){
        this.temp_std_data = [];
        let item = JSON.parse(JSON.stringify(this.seat_data[c]));
        for(let i of item){
          this.temp_std_data.push(i);
          this.col_check = item.length;
        }
      }
      if(this.check_subject==""){
        this.allsubject_id.find(element => element.id == this.subject).size -=1;
        this.check_subject=this.subject;
        $("input[id='"+id+"']").prop("checked", !this.clicked_seat_id[id]);
        $('#'+id).css({
          "background-color": this.random_subject_color(this.subject),"color":"white"}
                     );
        if(!this.search_seat(id)){
          alert("ที่นั่งถูกใช้แล้ว");
          return 0;
        }
        this.person_value = this.person[this.subject].shift();
        this.temp_std_data.push({
          seat:id,subject:this.subject,name:this.person_value.ชื่อ,id:this.person_value.รหัสนิสิต,year:this.person_value.ชั้นปี,group:this.person_value.กลุ่ม,room:this.floor_select_data}
                          );
        this.col_check= this.temp_std_data.length;
        this.seat_data[c]= this.temp_std_data;
      }
      else if(this.check_subject!=this.subject){
        if(!this.search_seat(id)){
          if(this.seat_data[c].find(x=> x.seat == id && x.subject == this.subject)){
            $('#'+id).css({
              "background-color": "transparent","color":"black"}
                         );
            this.remove_seat_data(c,id);
            return 0;
          }
          else{
            alert("ที่นั่งถูกใช้แล้ว");
            return 0;
          }
        }
        if((this.allsubject_id.find(element => element.id == this.subject).size != 0)){
          this.allsubject_id.find(element => element.id == this.subject).size -=1;
          this.person_value = this.person[this.subject].shift();
          this.check_subject=this.subject;
          $("input[id='"+id+"']").prop("checked", !this.clicked_seat_id[id]);
          $('#'+id).css({
            "background-color": this.random_subject_color(this.subject),"color":"white"}
                       );
          this.temp_std_data.push({
            seat:id,subject:this.subject,name:this.person_value.ชื่อ,id:this.person_value.รหัสนิสิต,year:this.person_value.ชั้นปี,group:this.person_value.กลุ่ม,room:this.floor_select_data}
                            );
          this.col_check= this.temp_std_data.length;
          this.seat_data[c]= this.temp_std_data;
        }
      }
      else if(this.check_subject==this.subject){
        if(!this.search_seat(id)){
          if(this.seat_data[c].find(x=> x.seat == id && x.subject == this.subject)){
            $('#'+id).css({"background-color": "transparent","color":"black"});
            this.remove_seat_data(c,id);
            return 0;
          }
          else if(this.seat_check.find(e => e === id)){
            alert("ที่นั่งถูกใช้แล้ว");
            return 0;
          }
        }
        if((this.allsubject_id.find(element => element.id == this.subject).size != 0) ){
          this.allsubject_id.find(element => element.id == this.subject).size -=1;
          $("input[id='"+id+"']").prop("checked", !this.clicked_seat_id[id]);
          $('#'+id).css({
            "background-color": this.random_subject_color(this.subject),"color":"white"}
                       );
          this.person_value = this.person[this.subject].shift();
          this.temp_std_data.push({
            seat:id,subject:this.subject,name:this.person_value.ชื่อ,id:this.person_value.รหัสนิสิต,year:this.person_value.ชั้นปี,group:this.person_value.กลุ่ม,room:this.floor_select_data}
                            );
          this.seat_data[c]= this.temp_std_data;
          this.col_check=this.temp_std_data.length;
        }
      }
    }
  ,
  // เลือกที่นั่งแบบเลือกทั้งหลัก
    click_checkall(c){
      if(!this.subject){
        return 0;
      }
      if(this.checkall_validate(c)==false){
        return 0;
      }
      
      let i =1;
      let a = 1;
      let self = this;
      if(this.col_name[c]!=c){
        this.col_name[c]=c;
        this.col_check = 0;
        this.temp_std_data = [];
      }
      else if(this.col_name[c]==c){
        this.temp_std_data = [];
       
        let item = JSON.parse(JSON.stringify(this.seat_data[c]));
        for(let i of item){
          this.temp_std_data.push(i);
          this.col_check = item.length;
        }
      }
      if(this.check_subject==""){
        this.check_subject=this.subject;
        for(i=1;i<=this.row_data;i++){
          if(i>this.row_data){
              throw("error");
          }
          if((this.allsubject_id.find(element => element.id == this.subject).size != 0)){
            if(this.search_seat(c+i)){
              this.person_value = this.person[this.subject].shift();
              this.allsubject_id.find(element => element.id == this.subject).size -=1;
              $("input[id='"+c+i+"']").prop("checked", !this.clicked_seat_id[c+i]);
              $('#'+c+i).css({
                "background-color": this.random_subject_color(this.subject),"color":"white"}
                            );
              this.temp_std_data.push({
                seat:c+parseInt(this.col_check+1),subject:this.subject,name:this.person_value.ชื่อ,id:this.person_value.รหัสนิสิต,year:this.person_value.ชั้นปี,group:this.person_value.กลุ่ม,room:this.floor_select_data}
                                );
              this.col_check= this.temp_std_data.length;
              this.seat_data[c]= this.temp_std_data;
            }
            else{
              alert("แถวเต็มแล้ว");
              return 0;
            }
          }
        }
      }
      else if(this.check_subject!=this.subject){
        this.check_subject=this.subject 
        let status = true;
        if(this.seat_data[c] != null){
          for(i=1;i<=this.row_data;i++){
            if(this.seat_data[c].find(x=> x.seat == c+i && x.subject == this.subject)){
              $('#'+c+i).css({
                "background-color": "transparent","color":"black"}
                            );
              this.remove_seat_data(c,c+i);
              status = false;
            }
          }
        }
        if(status == true && this.seat_check.find(e => e != c+i)){
          for(i=1;i<=this.row_data;i++){
            if(i>this.row_data){
              throw("error");
            }
            if(this.search_seat(c+i)){
              this.person_value = this.person[this.subject].shift();
              this.allsubject_id.find(element => element.id == this.subject).size -=1;
              $("input[id='"+c+i+"']").prop("checked", !this.clicked_seat_id[c+i]);
              $('#'+c+i).css({
                "background-color": this.random_subject_color(this.subject),"color":"white"}
                            );
              this.temp_std_data.push({
                seat:c+parseInt(this.col_check+1),subject:this.subject,name:this.person_value.ชื่อ,id:this.person_value.รหัสนิสิต,year:this.person_value.ชั้นปี,group:this.person_value.กลุ่ม,room:this.floor_select_data}
                                );
              this.col_check= this.temp_std_data.length;
              this.seat_data[c]= this.temp_std_data;
            }
          }
        }
      }
      else if(this.check_subject==this.subject){
        let status = true;
        if(this.seat_data[c] != null){
          for(i=1;i<=this.row_data;i++){
            if(this.seat_data[c].find(x=> x.seat == c+i && x.subject == this.subject)){
              $('#'+c+i).css({
                "background-color": "transparent","color":"black"}
                            );
              this.remove_seat_data(c,c+i);
              status = false;
            }
          }
        }
        if(status == true ){
          for(i=1;i<=this.row_data;i++){
            if(i>this.row_data){
              throw("error");
            }
            if(this.search_seat(c+i)){
              this.person_value = this.person[this.subject].shift();
              this.allsubject_id.find(element => element.id == this.subject).size -=1;
              $("input[id='"+c+i+"']").prop("checked", !this.clicked_seat_id[c+i]);
              $('#'+c+i).css({
                "background-color": this.random_subject_color(this.subject),"color":"white"}
                            );
              this.temp_std_data.push({
                seat:c+i,subject:this.subject,name:this.person_value.ชื่อ,id:this.person_value.รหัสนิสิต,year:this.person_value.ชั้นปี,group:this.person_value.กลุ่ม,room:this.floor_select_data}
                                );
              this.seat_data[c]= this.temp_std_data;
              this.col_check=this.temp_std_data.length;
            }
          }
        }
      }
    }
  ,//สุ่มค่าสี
    random_subject_color(id) {
      return this.color_cache[id] || (this.color_cache[id] = this.color.pop());
    }
  ,// เซ็ตค่าห้องตามที่กำหนดแถวหลักของห้องที่เลือก
    set_room_data(x){
      for(let i=0;i<this.room_data.length;i++){
        if(this.room_data[i].id==x.target.value){
          this.row_data = this.room_data[i].room_row;
          this.col_data = this.room_data[i].room_col;
        }
      }
    }
  ,//อ่านข้อมูลจากไฟลฺ์ Excel ตามที่กำหนด
    read_excel_file(evt){
      let self=this;
      document.getElementById('submit').style.visibility = 'visible';
      if(self.file_size.length>=10)
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
        self.subjectid_value = (desired_cell1 ? desired_cell1.v : undefined);
        self.subjectname_value = (desired_cell2 ? desired_cell2.v : undefined);
        self.teacher_name_value = (desired_cell3 ? desired_cell3.v : undefined);
        let message_a;
        let message_b;
        let message_c;
        if(self.subjectid_value && !self.subjectname_value && !self.teacher_name_value){
          alert("ไม่พบข้อมูล รหัสวิชา ชื่อวิชาและชื่ออาจารย์ผู้สอน");
          throw("error xlsx file");
        }
        if(!self.subjectid_value){
          message_a="'รหัสวิชา'";
          alert("ไม่พบข้อมูล "+message_a+" กรุณาตรวจสอบไฟล์ก่อนดำเนินการ");
          throw("error xlsx file");
        }
        if(!self.subjectname_value){
          message_b="'ชื่อวิชา'";
          alert("ไม่พบข้อมูล "+message_b+" กรุณาตรวจสอบไฟล์ก่อนดำเนินการ");
          throw("error xlsx file");
        }
        if(!self.teacher_name_value){
          message_c="'ชื่อวิชา'";
          alert("ไม่พบข้อมูล "+message_c +" กรุณาตรวจสอบไฟล์ก่อนดำเนินการ");
          throw("error xlsx file");
        }
        if(self.subjectid_value && self.subjectname_value && self.teacher_name_value){
          self.allsubject_code.push({
            subcode:self.subjectid_value,
            subname:self.subjectname_value,
            teacher:self.teacher_name_value,
          });
          var indexArray = [];
          workbook.SheetNames.forEach(function(sheetName) {
            self.seat_obj_data = XLSX.utils.sheet_to_json(workbook.Sheets[sheetName],{
              range:1
            });
          });
          if(self.seat_obj_data.length!=0){
            self.temp_file_data.push({
              "subId":self.subjectid_value,
              "subName":self.subjectname_value,
              "data":self.seat_obj_data,
            });
            self.file_size.push({
              id:self.subjectid_value,
              size:self.seat_obj_data.length,
            });
          }
        }
      };
      reader.onerror = function(event) {
        console.error("File could not be read! Code " + event.target.error.code);
      };
      reader.readAsBinaryString(selectedFile);
    }
  ,
  }
    ,
      computed:{
        //ค่าชั่วโมง
        get_hour(){
          var hour = [];
          for(let i=6;i<=22;i++){
            if(i<10){
              hour.push("0"+i);
            }
            else{
              hour.push(i);
            }
          }
          return hour;
        }
        ,
        //ค่านาที
        get_minute(){
            var num = "";
            var mini = [];
            for(let i=0;i<=59;i++){
              if(i%5==0){
                if(i<10){
                  mini.push("0"+i);
                }
                else{
                  mini.push(i);
                }
              }
            }
            return mini;
          }
        ,
        //รายวิชาทั้งหมด
        get_allsubject_code(){
            return this.allsubject_code;
        }
        ,
         //สร้างปีการศึกษา
        get_year(){
            var item = [];
            var current_date = new Date();
            var formatted_curren = moment(current_date).format("L");
            //mm/dd/yyyy
            var yearcurren =formatted_curren.substr(6,4);
            var in_year = parseInt(yearcurren);
            var start_year = (in_year-1)+543;
            var end_year = (in_year+1)+543;
            for(let i=start_year;i<=end_year;i++){
              item.push(i);
            }
            return item;
          }
        ,
        //รายวิชาทั้งหมด
          get_allsubject_code(){
            return this.allsubject_code;
          }
        ,
        //ข้อมูลเลขที่นั่งสอบทั้งหมด
          get_data_processed(){
            return this.result;
          }
        ,
        //ข้อมูลห้องสอบที่มี
          get_room_data(){
            return this.room_data;
          }
        ,
        //ตรวจสอบปุ่มการบันทึก
          validate_data_input(){
            if(!this.type_exam||!this.school_year||!this.term||!this.exam_date||!this.time_start_hour||!this.time_start_hour||!this.time_end_hour||!this.time_end_hour||!this.floor_select_data||!this.fileupload){
              return true;
            }
          }
        ,
        //ตรวจสอบหากยังไม่ได้เพิ่มข้อมูลจะไม่แสดงปุ่ม
          validate_btn_data(){
            if(this.temp_std_data==""){
              return true;
            }
          }
        ,
        //แสดงรหัสวิชาทั้งหมด
          get_allsubject_data(){
            return this.allsubject_id 
          }
        ,
        //ส่งข้อมูลแถวผัง
          get_row_data(){
            var list = [];
            for (var i = 1; i <= 1000; i++) {
              list.push(i);
            }
            var obj = [];
            for (let i = 0; i < this.row_data; i++){
              obj.push({
                number: list[i]
              });
            }
            return obj;
          }
        ,//ส่งข้อมูลแถว 123
          get_col_data(){
            var list = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
            var obj = [];
            for(let i =0;i<this.col_data;i++){
              obj.push({
                char: list[i]
              });
            }
            return obj;
          },
      },
  });
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
