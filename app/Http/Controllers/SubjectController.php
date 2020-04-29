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
class SubjectController extends Controller
{
    public function __construct()
    {
         
    }
    // Function : get_subjectlist
    // Auhor : รัชชานนท์ พึงตา
    // ID : 59160683
    // Description : เรียก view SubjectList
    // Input : -
    // Output : Subject data
    public function get_subjectlist()
    {
        $data = AppM_subject::get_subjectList();
        return view('v_subjectList', $data);
    }


    // Function : get_detail
    // Auhor : จักรกฤษณ์ ตุลย์ไตรรัตน์
    // ID : 59160639
    // Description : เรียก view detail
    // Input : -
    // Output : Detail data
    public function get_detail($id,$date,$room_id)
    {
        $data = AppM_subject::get_detail($id, $date,$room_id);
        return view('v_detail', $data);
    }
 
 
 
}