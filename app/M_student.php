<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class M_student extends Model
{   
    // Function : get_student_data
    // Auhor : ธีรัช นาคสุทธิ์
    // ID : 59160185
    // Description : Query ข้อมูลนิสิต/ข้อมูลรายวิชา/ข้อมูลห้องสอบ
    // Input : รหัสนิสิต
    // Output : ข้อมูลนิสิต/ข้อมูลรายวิชา/ข้อมูลห้องสอบ
    public static function get_student_data($req)
    { 
        $date = \Carbon\Carbon::today()->addMonths(1)->format('Y-m-d');
        $now = \Carbon\Carbon::today()->format('Y-m-d');

        
        $time = substr($date,0,5);
        $time = $time.substr($date,6,10);
        $std_id = $req->input('std_id');
       
        $item = DB::select( DB::raw("SELECT DISTINCT exs_id,exs_seat,exs_name,exs_code,exs_sub,seat_exmp.date,sub_code,sub_name,exam_time_start,exam_time_end,room_name   FROM seat_exmp \n"

        . "LEFT JOIN rooms ON room_id = rooms.id\n"
    
        . "LEFT JOIN subjects ON subjects.sub_code = seat_exmp.exs_sub\n"
    
        . "WHERE seat_exmp.exs_time_start = subjects.time_start_mili \n"
    
        . "AND seat_exmp.exs_time_end = subjects.time_end_mili\n"
    
        . "AND seat_exmp.exs_code = '$std_id'\n"
    
        . "AND seat_exmp.date BETWEEN '$now' AND '$date'"
        // . "GROUP BY seat_exmp.exs_code "

        . "ORDER BY seat_exmp.date ASC"));


        if(count($item) == 0){
            $data ='';
        }else{
            $data = [
                'pss' => $item
            ];
        }

        return $data;
        
    }

    
}