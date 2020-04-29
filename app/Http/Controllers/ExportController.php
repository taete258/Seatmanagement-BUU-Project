<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\User;
use App\Http\Controllers\Controller;
use App\M_export as AppM_export;
use App\M_rooms as AppM_rooms;
use PDF;
class ExportController extends Controller{
    public function __construct()
    {
         
    }
    // Function : export_pdf
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : โหลดไฟล์ pdf ข้อมูลของใบเซ็นชื่อ
    // Input : รายวิชา วันที่สอบ และไอดีห้อง
    // Output : -
   public function export_pdf($id,$date,$room_id)
   {
        $data = AppM_export::getstudent($id,$date,$room_id);
        $pdf = PDF::loadView('v_export_pdf',$data);
        return @$pdf->stream();
   }


    // Function : show_seatlayout
    // Auhor : รัชชานนท์ พึ่งตา
    // ID : 591ุ60683
    // Description : ส่งออกแผนผังที่นั่ง
    // Input : รหัสวิชา เวลาเริ่มต้นและเวลาสิ้นสุด
    // Output : -
   public function show_seatlayout($id,$start,$end)
   {
     $data2 = AppM_rooms::edit_roomuse($id,$start,$end);
     $dataDate = AppM_rooms::get_roomuse_date();

     return view('v_seat_export', $data2,$dataDate);
   }
}