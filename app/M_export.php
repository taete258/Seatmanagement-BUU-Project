<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class M_export extends Model
{
    // Function : getstudent
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ดึงข้อมูลนักศึกษารายวิชาและเลขที่นั่งสอบเพื่อนำไปใช้ในการส่งออกใบเซ็นชื่อเข้าสอบ
    // Input : รหัสวิชา วันที่สอบ และไอดีห้องสอบ
    // Output : ข้อมูลนักศึกษารายวิชาและเลขที่นั่งสอบ
    public static function getstudent($id,$date,$room_id)
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
            ['seat_exmp.room_id', $room_id]
        ])
        ->get();

        $subject_data =  DB::table('subjects')
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
                ['subjects.room_id', $room_id]
            ])
            ->get();

        $data = [
            'sed' => $seat_data,
            'sud' => $subject_data,
        ];
        return $data;
    }
}