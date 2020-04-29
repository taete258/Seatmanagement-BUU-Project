<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\M_persons as AppM_persons;
use App\M_rooms as AppM_rooms;
use App\M_manages as AppM_manages;
use App\M_subject as AppM_subject;
use App\M_student as AppM_student;
use App\Http\Controllers\Controller;
use PDF;

class StudentController extends Controller
{
    public function __construct()
    {
        
    }
    
    
    // Function : show_main
    // Auhor : รัชชานนท์ พึงตา
    // ID : 59160683
    // Description : เรียก view หน้าค้นหาสำหรับผู้ใช้ทั่วไป
    // Input : -
    // Output : -
    public function show_main()
    {
        return view('v_main_page');
    }
    

    // Function : student_data
    // Auhor : ธีรัช นาคสุทธิ์
    // ID : -
    // Description : แสดงข้อมูลการสอบ
    // Input : request std_id
    // Output : std data
    public function student_data(Request $req)
    {
        $data = AppM_student::get_student_data($req);
        if ($data != '') {
            return view('v_student_data', $data);
        } else {
            return back()->withErrors('ไม่พบข้อมูลที่ค้นหา กุณาลองอีกครั้ง');
        }
    }
    
    
    public function infophp()
    {
        return view('v_testphp');
    }
    
    
}