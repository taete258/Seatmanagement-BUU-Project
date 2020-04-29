<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class M_rooms extends Model
{
    // Function : insert_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : รับ req ของข้อมูลห้อง ประกอบไปด้วย ชื่อห้อง จำนวนแถว จำนวนหลักและชั้น เพื่อนำไป insert ข้อมูลห้องสอบ
    // Input : req ข้อมูลห้องสอบ
    // Output : -
        public static function insert_room($req){
            $r_name = $req->input('room_name');
            $r_row = $req->input('row');
            $r_col = $req->input('col');
            $r_floor = $req->input('floor');
            $r_status = true;
            
            $dataroom = array(
                'room_name' => $r_name,
                'room_floor' => $r_floor,
                'room_row'=> $r_row,
                'room_col'=> $r_col
            );

        $roomId = DB::table('rooms')->insertGetId($dataroom);
            $dataseat = array(
                'room_id' => $roomId,
                'seat_row' => $r_row,
                'seat_col' => $r_col,
                'status' => $r_status
            );
    
           
            DB::table('seats')->insert($dataseat);
        }
    // Function : get_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ดึงข้อมูลห้องสอบ ประกอบไปด้วย ไอดีห้องสอบ ชื่อห้องสอบ จำนวนแถว และจำนวนหลักของห้องสอบ เพื่อนำไปแสดงในรูปแบบของตารางข้อมูล
    // Input : -
    // Output : ข้อมูลห้องสอบ
        public static function get_room(){
            $room_data = DB::table('rooms')
            ->select
            (
              'rooms.id',
              'rooms.room_name',
              'rooms.room_floor',
              'rooms.room_row',
              'rooms.room_col'
            )
            ->get();

            $data = [
                'rmd' => $room_data
            ];
            
            return $data;
        }
    // Function : edit_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ดึงข้อมูลห้องที่เจ้าหน้าที่ทำการเลือกเพื่อทำการแก้ไขข้อมูลห้อง ซึ่งประกอบไปด้วย ไอดีห้อง ชื่อห้อง ชั่้น จำนวนแถว จำนวนหลักของห้องสอบ
    // Input : ไอดีห้อง
    // Output : ข้อมูลห้องที่ผู้ใช้เลือกเพื่อทำการแก้ไข
        public static function edit_room($id){
            $editroom_data = DB::table('rooms')
            ->select
            (
              'rooms.id',
              'rooms.room_name',
              'rooms.room_floor',
              'rooms.room_col',
              'rooms.room_row'
            )
            ->where('rooms.id', '=', $id)
            ->get();

            $data = [
                'erd' => $editroom_data
            ];
            
            return $data;
        }
    // Function : update_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : รับ req ข้อมูลห้องสอบ เพื่อแก้ไขข้อมูลห้องสอบ ประกอบไปด้วย ไอดีห้องสอบ ชื่อห้องสอบ จำนวนแถว จำนวนหลัก และชั้นของห้องสอบ
    // Input : req ข้อมูลห้องสอบ
    // Output : -
        public static function update_room($req){
            $id = $req->input('room_id');  
            $r_name = $req->input('room_name');
            $r_row = $req->input('row');
            $r_col = $req->input('col');
            $r_floor = $req->input('floor');

            $dataroom = array(
                'room_name' => $r_name,
                'room_floor' => $r_floor,
                'room_row' => $r_row,
                'room_col' => $r_col
            );
            DB::table('rooms')->where('rooms.id', $id)->update($dataroom);

            $dataseat = array(
                'seat_row' => $r_row,
                'seat_col' => $r_col,
            );
            DB::table('seats')->where('seats.room_id', $id)->update($dataseat);
        }
    // Function : delete_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ลบข้อมูลห้องสอบ
    // Input : ไอดีห้องสอบ
    // Output : -
        public static function delete_room($id)
        {
            DB::table('rooms')->where('rooms.id', $id)->delete();
        }
    
    // Function : edit_roomuse
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ดึงข้อมูลห้องที่ได้รับการจัดสอบ ที่เจ้าหน้าที่เลือกเพื่อทำการแก้ไขเลขที่นั่งสอบประกอบไปด้วยข้อมูลพื้นฐานของห้องสอบ ของนักศึกษา และของรายวิชา
    // Input : ไอดีห้อง เวลาเริ่มสอบ เวลาสิ้นสุดการสอบ
    // Output : ข้อมูลห้องที่ถูกใช้ ที่ผู้ใช้เลือก
        public static function edit_roomuse($id,$start,$end){
            $editroomuse_data = DB::table('rooms_use')
            ->select
            (
                'rooms_use.room_id',
                'rooms_use.time_start_mili',
                'rooms_use.time_end_mili',
                'rooms_use.room_name',
                'rooms_use.room_row',
                'rooms_use.room_col'
            )

            ->where('rooms_use.time_start_mili', $start)
            ->where('rooms_use.time_end_mili', $end)
            ->where('rooms_use.room_id', $id)
            ->get();

            $editsubject_data = DB::table('subjects')
            ->select
            (
                'subjects.id',
                'subjects.sub_code',
                'subjects.sub_name',
                'subjects.school_year',
                'subjects.term',
                'subjects.exam_time_start',
                'subjects.exam_time_end',
                'subjects.date',
                'subjects.type_exam',
                'subjects.teacher',
                'subjects.room_id'
            )
            ->where('subjects.time_start_mili', $start)
            ->where('subjects.time_end_mili', $end)
            ->where('subjects.room_id', $id)
            ->get();

            $seat_data= DB::table('seat_exmp') 
            ->select
            (
                'seat_exmp.exs_seat',
                'seat_exmp.exs_name', 
                'seat_exmp.exs_code', 
                'seat_exmp.exs_group', 
                'seat_exmp.exs_sub', 
                'seat_exmp.room_id',
                'seat_exmp.exs_time_start', 
                'seat_exmp.exs_time_end',
                'seat_exmp.date'
            )
            ->where('seat_exmp.exs_time_start', $start)
            ->where('seat_exmp.exs_time_end', $end)
            ->where('seat_exmp.room_id', $id)
            ->get();

            $data = [
                'erd' => $editroomuse_data,
                'esd' => $editsubject_data,
                'sed' => $seat_data
            ];
            // dd($data);
            // die;
            return $data;
        }
    // Function : get_roomuse_date
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ดึงข้อมูลห้องที่ถูกจัดทั้งหมด เพื่อนำไปแสดงในรูปแบบของตารางข้อมูล
    // Input : -
    // Output : ข้อมูลห้องที่ถูกจัดทั้งหมด
        public static function get_roomuse_date(){
            $roomuse_data = DB::table('rooms_use')
            ->select
            (
              'rooms_use.id',
              'rooms_use.room_id',
              'rooms_use.room_time_start',
              'rooms_use.room_time_end',
              'rooms_use.time_start_mili',
              'rooms_use.time_end_mili',
              'rooms_use.date'
            )
            ->get();

            $room_data = DB::table('rooms')
            ->select
            (
              'rooms.id',
              'rooms.room_name',
              'rooms.room_floor',
              'rooms.room_row',
              'rooms.room_col'
            )
            ->get();

         
            $data = [
                'rud' => $roomuse_data,
                'rmd' => $room_data
            ];
            
            return $data;
        }
    
  
}