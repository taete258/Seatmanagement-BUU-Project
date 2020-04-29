<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\M_manages as AppM_manages;
use App\M_rooms as AppM_rooms;
use App\Http\Controllers\Controller;
class ExamsController extends Controller{
    public function __construct()
    {
         
    }
  
    // Function : insert_exam
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ส่ง req ข้อมูลการจัดเลขที่นั่งสอบไป insert ข้อมูลเลขที่นั่งสอบ ข้อมูลรายวิชา และข้อมูลห้องที่ถูกจัดสอบ
    // Input : req ข้อมูลการจัดเลขที่นั่งสอบ
    // Output : -
    public function insert_exam(Request $req)
    {
         $data = AppM_manages::add_seat_information($req);
         AppM_manages::add_subject($req);
         AppM_manages::add_roomuse($req);
         return redirect('subject_list');
    }

    // Function : add_exam
    // Auhor : นติรุต ดวงภาค
    // ID : 59161030
    // Description : ดึงค่าข้อมูลห้องสอบ และเวลาในห้องที่ได้รับการจัดสอบนำไปแสดงในหน้าสร้างการสอบ
    // Input : -
    // Output : Room data และ Date data
    public function add_exam()
    {
        $data     = AppM_rooms::get_room();
        $dataDate = AppM_rooms::get_roomuse_date();
        return view('v_addExam_data', $data, $dataDate);
    }

    // Function : update_manage
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ส่ง req ข้อมูลห้องที่ได้รับการจัดสอบเพื่อนำไปแก้ไขการจัดที่นั่งสอบ
    // Input : req ข้อมูลห้องที่ได้รับการจัดสอบ
    // Output : -
    public function update_exam(Request $req)
    {
        AppM_manages::update_roomuse($req);
        return redirect('room-use');
    }


}