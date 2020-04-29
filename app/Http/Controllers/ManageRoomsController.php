<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Crypt;
use App\User;
use App\Http\Controllers\Controller;
use App\M_rooms as AppM_rooms;
use App\M_manages as AppM_manages;
class ManageRoomsController extends Controller
{
    public function __construct()
    {
         
    }

    // Function : insert_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ส่ง req ข้อมูลห้อง ไป insert ข้อมูลห้อง และ redirect ไปที่หน้ารายงานแสดงห้องสอบ
    // Input : req ข้อมูลห้อง
    // Output : -
    public function insert_room(Request $req)
    {
        $data = AppM_rooms::insert_room($req);
        return redirect('add-room');
    }
    // Function : add_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : โหลดหน้าจอรายงานแสดงห้องสอบในรูปแบบของตารางข้อมูล
    // Input : -
    // Output : ข้อมูลห้องสอบ
    public function add_room(){
        $data = AppM_rooms::get_room();
        return view('v_addRoom',  $data);
       }
    // Function : insert_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : โหลดหน้าแก้ไขข้อมูลห้องในรูปแบบตารางข้อมูล
    // Input : ไอดีห้อง
    // Output : ข้อมูลห้องสอบ
    public function edit_room($id){
        $data = AppM_rooms::edit_room($id);
        return view('v_editRoom', $data);
    }
    // Function : update_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ส่ง req ข้อมูลห้องสอบ เพื่อนำไปแก้ไข ข้อมูลห้อง และ redirect ไปที่หน้า แสดงห้องสอบ
    // Input : ข้อมูลห้อง
    // Output : -
    public function update_room(Request $req){
        $data = AppM_rooms::update_room($req);
        return redirect('add-room');
    }
     // Function : delete_room
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ส่งไอดีเพือ่ลบข้อมูลห้องสอบ
    // Input : ไอดีห้อง
    // Output : -
    public function delete_room($id){
        AppM_rooms::delete_room($id);
        return redirect('add-room');
    }
    // Function : show_roomuse
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : โหลดหน้าแสดงรายงานห้องที่ได้รับการจัดสอบในรูปแบบของตารางข้อมูล
    // Input : -
    // Output : -
    public function show_roomsuse(){
        $data = AppM_manages::get_roomuse();
        return view('v_rooms_use', $data);
    }
    // Function : delete_roomuse
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ส่ง ไอดีห้องสอบ เวลาเริ่มสอบ เวลาสิ้นสุดการสอบ เพื่อนำไปลบข้อมูลห้องที่ถูกจัดสอบ
    // Input : ไอดีห้อง เวลาเริ่มสอบ เวลาสิ้นสุดการสอบ
    // Output : -
    public function delete_roomuse($id,$start,$end){
         AppM_manages::delete_roomuse($id,$start,$end);
         return redirect('room-use');
    }
    // Function : edit_roomuse
    // Auhor : นติรุต ดวงภาค
    // ID : 591ุ61030
    // Description : ส่ง ไอดีห้องสอบ เวลาเริ่มสอบ เวลาสิ้นสุดการสอบ เพื่อแก้ไขข้อมูลการจัดสอบ และแสดงหน้าห้องที่ได้รับการจัดสอบ
    // Input : ไอดีห้อง เวลาเริ่มสอบ เวลาสิ้นสุดการสอบ
    // Output : -
    public function edit_roomuse($id,$start,$end){
        $data2 = AppM_rooms::edit_roomuse($id,$start,$end);
        $dataDate = AppM_rooms::get_roomuse_date();
        return view('v_editRoomUse', $data2,$dataDate);
   }

 
 
}