<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
class M_manages extends Model{
    // Function : add_seat_information
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : เพิ่มข้อมูลการจัดเลขที่นั่งสอบข้อมูลประกอบไปด้วยเลขที่นั่งสอบ รหัสวิชา ชื่อนิสิต รหัสนิสิต กลุ่มเรียน ห้องสอบ วันที่สอบ เวลาเริ่มต้นการสอบ และเวลาสิ้นสุดการสอบ
    // Input : ข้อมูลการจัดเลขที่นั่งสอบ
    // Output : -
    public static function add_seat_information($req){
        $seat = $req->input('seatdata');
        $sub = $req->input('subdata');
        $name = $req->input('namedata');
        $code = $req->input('codedata');
        $group = $req->input('groupdata');
        $room = $req->input('roomdata');
        $date = $req->input('date_data');
        $start = $req->input('timeSmili_dat');
        $end = $req->input('timeEmili_dat');
  
        foreach ($seat as $index => $value){
             $data = array(
                'exs_seat' =>optional($seat)[$index],
                'exs_sub' =>optional($sub)[$index],
                'exs_name' =>optional($name)[$index],
                'exs_code' =>optional($code)[$index],
                'exs_group' =>optional($group)[$index],
                'room_id' =>optional($room )[$index],
                'exs_time_start' =>optional($start)[$index],
                'exs_time_end' =>optional($end)[$index],
                'date' =>optional($date)[0]
             );
             DB::table('seat_exmp')->insert($data);
        }  
    }
    // Function : add_subject
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : เพิ่มข้อมูลรายวิชาประกอบไปด้วยรหัสวิชา ชื่อวิชา อาจารย์ผู้สอน ชนิดการสอบ ปีการศึกษา ภาคการศึกษา วันที่สอบ เวลาเริ่มต้นการสอบ และเวลาสิ้นสุดการสอบ
    // Input : ข้อมูลรายวิชา
    // Output : -
    public static function add_subject($req){
        $sub_id = $req->input('sub_id_data');
        $sub_name = $req->input('sub_name_data');
        $teacher_name = $req->input('teacher_name_data');
        $type = $req->input('type_exam_data');
        $term = $req->input('term_data');
        $year = $req->input('year_data');
        $date = $req->input('date_data');
        $timeS = $req->input('timeS_data');
        $timeE = $req->input('timeE_data');
        $timeSm = $req->input('timeSmili_data');
        $timeEm = $req->input('timeEmili_data');
        $floor = $req->input('floor_data');

        $year_ad = ((int)$year[0])-543;
        foreach($sub_id as $index => $value){
          $data[$index] = array(
             'sub_code' =>optional($sub_id)[$index],
             'sub_name' =>optional($sub_name)[$index],
             'school_year' =>$year_ad,
             'exam_time_start' =>optional($timeS)[$index],
             'exam_time_end' =>optional($timeE)[$index],
             'time_start_mili' =>optional($timeSm)[$index],
             'time_end_mili' =>optional($timeEm)[$index],
             'date' =>optional($date)[$index],
             'type_exam' =>optional($type)[$index],
             'teacher' =>optional($teacher_name)[$index],
             'room_id' =>optional($floor)[$index],
             'term' =>optional($term)[$index],
          );
           DB::table('subjects')->insert($data[$index]);
        }
    }
    // Function : add_roomuse
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : เพิ่มข้อมูลห้องที่ได้รับการจัดเลขที่นั่งแล้ว มีข้อมูลประกอบไปด้วย วันที่สอบ เวลาเริ่มต้นการสอบ เวลาสิ้นสุดการสอบ ชั้น ชื่อห้อง จำนวนแถว และจำนวนหลักของห้องสอบ
    // Input : ข้อมูลห้องที่ได้รับการจัดการโดยเจ้าหน้าที่จัดการที่นั่งสอบ
    // Output : -
    public static function add_roomuse($req){
        $date = $req->input('date_data');
        $timeS = $req->input('timeS_data');
        $timeE = $req->input('timeE_data');
        $timeSm = $req->input('timeSmili_data');
        $timeEm = $req->input('timeEmili_data');
        $floor = $req->input('floor_data');

        $room_row = $req->input('room_row_data');
        $room_col = $req->input('room_col_data');
        $room_name = $req->input('room_name_data');

            $data = array(
                'room_id' =>$floor[0],
                'room_name' =>$room_name[0],
                'room_row' =>$room_row[0],
                'room_col' =>$room_col[0],
                'time_start_mili' =>$timeSm[0],
                'time_end_mili' =>$timeEm[0],
               'room_time_start' =>$timeS[0],
               'room_time_end' =>$timeE[0],
               'date' =>$date[0]
               
            );
           
             DB::table('rooms_use')->insert($data);
          
    }
    // Function : get_roomuse
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ดึงข้อมูลห้องที่ได้รับการจัดเลขที่นั่งสอบ นำมาแสดงในรูปแบบของตารางข้อมุลเพื่อให้เจ้าหน้าที่สามารถจัดการห้องที่ได้รับการจัดแล้ว โดยการดำเนินการจะประกอบไปด้วยการแก้ไขเลขที่นั่งสอบ และการลบห้องที่ได้รับการจัดสอบ
    // Input : -
    // Output : ข้อมูลห้องที่ได้รับการจัดสอบ
    public static function get_roomuse(){
        $date = \Carbon\Carbon::today()->addMonths(1)->format('Y-m-d');
        $now = \Carbon\Carbon::today()->format('Y-m-d');
        $roomuse_data = DB::table('rooms_use')
        ->select
        (
          'rooms_use.room_id',
          'rooms_use.room_time_start',
          'rooms_use.room_time_end',
          'rooms_use.time_start_mili',
          'rooms_use.time_end_mili',
          'rooms_use.date',
          'rooms_use.room_name'
        )
        ->whereBetween('rooms_use.date',array($now ,$date))
        ->get();

        $data = [
            'rud' => $roomuse_data
        ];
        
        return $data;
    }
    // Function : delete_roomuse
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ลบห้องที่ได้รับการจัดโดยแยกช่วงเวลาตามห้องที่เจ้าหน้าที่ได้ทำการเลือก
    // Input : ไอดีห้องที่ได้รับการจัด เวลาเริ่มสอบ เวลาสิ้นสุดการสอบ
    // Output : -
    public static function  delete_roomuse($id,$start,$end){
          DB::table('subjects')
          ->where('subjects.time_start_mili',$start)
          ->where('subjects.time_end_mili', $end)
          ->where('subjects.room_id', $id)
          ->delete();

          DB::table('rooms_use')
          ->where('rooms_use.time_start_mili', $start)
          ->where('rooms_use.time_end_mili', $end)
          ->where('rooms_use.room_id', $id)
          ->delete();

          DB::table('seat_exmp')
          ->where('seat_exmp.exs_time_start', $start)
          ->where('seat_exmp.exs_time_end', $end)
          ->where('seat_exmp.room_id', $id)
          ->delete();
    }
    // Function : update_roomuse
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : แก้ไขข้อมูลการจัดเลขที่นั่งสอบของห้องที่ได้รับการจัดสอบ โดยแยกช่วงเวลาตามห้อง จัดการโดยเจ้าหน้าที่่
    // Input : ข้อมูลการจัดเลขที่นั่งสอบตามห้อง
    // Output : -
    public static function update_roomuse($req){
        //delete
        $id = $req->input('room_id');
        $start_id = $req->input('start_time');
        $end_id= $req->input('end_time');
      
        DB::table('subjects')
        ->where('subjects.time_start_mili',$start_id)
        ->where('subjects.time_end_mili', $end_id)
        ->where('subjects.room_id', $id)
        ->delete();

        DB::table('rooms_use')
        ->where('rooms_use.time_start_mili', $start_id)
        ->where('rooms_use.time_end_mili', $end_id)
        ->where('rooms_use.room_id', $id)
        ->delete();

        DB::table('seat_exmp')
        ->where('seat_exmp.exs_time_start', $start_id)
        ->where('seat_exmp.exs_time_end', $end_id)
        ->where('seat_exmp.room_id', $id)
        ->delete();
// insert
        $seat = $req->input('seatdata');
        $sub = $req->input('subdata');
        $name = $req->input('namedata');
        $code = $req->input('codedata');
        $group = $req->input('groupdata');
        $room = $req->input('roomdata');
        $start = $req->input('timeSmili_dat');
        $end = $req->input('timeEmili_dat');
        $date = $req->input('date_data');
  
        foreach ($seat as $index => $value){
             $data = array(
                'exs_seat' =>optional($seat)[$index],
                'exs_sub' =>optional($sub)[$index],
                'exs_name' =>optional($name)[$index],
                'exs_code' =>optional($code)[$index],
                'exs_group' =>optional($group)[$index],
                'room_id' =>optional($room )[$index],
                 'exs_time_start' =>optional($start)[$index],
                 'exs_time_end' =>optional($end)[$index],
                 'date' =>optional($date)[$index]
             );
             DB::table('seat_exmp')->insert($data);
        }

        //insert subject
        $sub_id = $req->input('sub_id_data');
        $sub_name = $req->input('sub_name_data');
        $teacher_name = $req->input('teacher_name_data');
        $type = $req->input('type_exam_data');
        $term = $req->input('term_data');
        $year = $req->input('year_data');
        $date = $req->input('date_data');
        $timeS = $req->input('timeS_data');
        $timeE = $req->input('timeE_data');
        $timeSm = $req->input('timeSmili_data');
        $timeEm = $req->input('timeEmili_data');
        $floor = $req->input('floor_data');
      
        $year_ad = ((int)$year[0])-543;
        foreach($sub_id as $index => $value){
          $data[$index] = array(
             'sub_code' =>optional($sub_id)[$index],
             'sub_name' =>optional($sub_name)[$index],
             'school_year' =>$year_ad,
             'exam_time_start' =>optional($timeS)[$index],
             'exam_time_end' =>optional($timeE)[$index],
             'time_start_mili' =>optional($timeSm)[$index],
             'time_end_mili' =>optional($timeEm)[$index],
             'date' =>optional($date)[$index],
             'type_exam' =>optional($type)[$index],
             'teacher' =>optional($teacher_name)[$index],
             'room_id' =>optional($floor)[$index],
             'term' =>optional($term)[$index],
          );
           DB::table('subjects')->insert($data[$index]);
        }

        $room_row = $req->input('room_row_data');
        $room_col = $req->input('room_col_data');
        $room_name = $req->input('room_name_data');

            $data = array(
                'room_id' =>$floor[0],
                'room_name' =>$room_name[0],
                'room_row' =>$room_row[0],
                'room_col' =>$room_col[0],
                'time_start_mili' =>$timeSm[0],
                'time_end_mili' =>$timeEm[0],
                'room_time_start' =>$timeS[0],
                'room_time_end' =>$timeE[0],
                'date' =>$date[0]
               
            );
           
             DB::table('rooms_use')->insert($data);
    }

    

}