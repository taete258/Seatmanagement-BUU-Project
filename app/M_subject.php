<?php
namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
class M_subject extends Model
{
    // Function : get_subjectList
    // Auhor : รัชชานนท์ พึงตา
    // ID : 59160683
    // Description : Query ข้อมูลรายวิชา
    // Input : -
    // Output : Subject Data
    public static function get_subjectList()
    { 
        $now = \Carbon\Carbon::today()->format('Y-m-d');
        $subject = DB::table('subjects')
        ->select
            (
            'subjects.id',
            'subjects.room_id',
            'subjects.sub_code',
            'subjects.sub_name',
            'subjects.exam_time_start',
            'subjects.exam_time_end',
            'subjects.date',
            'subjects.time_start_mili',
            'subjects.time_end_mili'
            )
            ->where('subjects.date','>=',$now)
        ->get();
        $data = [
            'sjt' => $subject
        ];
        return $data;
    }

    ///////////////// Detail Page/////////////////
      // Function : get_detail
    // Auhor : จักรกฤษณ์ ตุลย์ไตรรัตน์
    // ID : 59160639
    // Description : Query ข้อมูลผู้เข้าสอบ กับ ข้อมูลรายละเอียดวิชา
    // Input : -
    // Output : รายละเอียดของผู้เข้าสอบ
    public static function get_detail($id,$date,$room_id)
    { 
        
        $seat_data = DB::table('seat_exmp')
        ->select
            (
            'seat_exmp.exs_seat',
            'seat_exmp.exs_name',
            'seat_exmp.exs_code',
            'seat_exmp.exs_group',
            'seat_exmp.date',
            'seat_exmp.exs_sub'
            )
        ->where([
            ['seat_exmp.exs_sub', $id],
            ['seat_exmp.date', $date],
            ['seat_exmp.room_id',$room_id]
        ])
        ->get();

        $sub_data =  DB::table('subjects')
        ->select
            (
            'subjects.room_id',
            'subjects.school_year',
            'subjects.teacher',
            'subjects.sub_code',
            'subjects.sub_name',
            'subjects.term',
            'subjects.date',
            'subjects.type_exam',
            'rooms_use.room_name'
            )
            ->leftJoin('rooms_use', 'subjects.room_id', '=', 'rooms_use.room_id')
            ->where([
                ['subjects.sub_code', $id],
                ['subjects.date', $date],
                ['subjects.room_id',$room_id]
            ])
            ->get(); 
        $data = [
            'sed' => $seat_data, 
            'sud' => $sub_data,
        ];
        return $data;
    }
  
}