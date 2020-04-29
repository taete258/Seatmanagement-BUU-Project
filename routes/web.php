<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','StudentController@show_main'); //แสดง View main
Route::get('/main','StudentController@show_main'); // แสดง View หน้าหลัก 
Route::get('/login','LoginController@show_login'); // แสดง View เข้าสู่ระบบ
Route::get('/add-data','ExamsController@add_exam'); // เรียก  View หน้าสร้างที่นั่งสอบ
Route::get('/subject_list','SubjectController@get_subjectlist'); // เรียก  View หน้ารายการรายวิชา
Route::get('/export_pdf/{id}/{date}/{room_id}','ExportController@export_pdf'); // เรียก  Controller สร้าง PDF
Route::get('/show_detail/{id}/{date}/{room_id}','SubjectController@get_detail'); // เรียก View หน้ารายละเอียด
Route::get('/add-room','ManageRoomsController@add_room'); // เรียก View หน้าจัดการห้อง
Route::post('insertRoom', 'ManageRoomsController@insert_room'); // เรียก Controller  เพิ่มห้อง
Route::get('/edit-room/{id}','ManageRoomsController@edit_room'); // เรียก View  แก้ไขห้อง
Route::post('/update-room','ManageRoomsController@update_room'); // เรียก Contoller แก้ไขห้อง
Route::get('/delete-room/{id}','ManageRoomsController@delete_room'); // เรียก Controller ลบห้อง
Route::post('/check-login', 'LoginController@login'); // เรียก Controller เข้าสู่ระบบ
Route::get('/logout','LoginController@logout'); // เรียก Controller ออจากระบบ
Route::get('/room-use', 'ManageRoomsController@show_roomsuse'); // เรียก View room_use
Route::get('/delete-roomuse/{id}/{start}/{end}','ManageRoomsController@delete_roomuse'); // เรียก View room_use
Route::post('add-manage', 'ExamsController@insert_exam');  // เรียก Controller manage เพิ่มข้อมูลการจัดที่นั่ง
Route::post('update-manage', 'ExamsController@update_exam'); // เรียก Controller แก้ไขการจัดที่นั่ง
Route::post('/student-data', 'StudentController@student_data');  // เรียก View แสดงข้อมูลที่นั่งสอบ
Route::get('/phpinfo', 'StudentController@infophp'); // phpinfo
Route::get('/edit-roomuse/{id}/{start}/{end}','ManageRoomsController@edit_roomuse'); // เรียก Controller แก้ไขห้องที่จัดสอบ
Route::get('/export-seatlayout/{id}/{start}/{end}','ExportController@show_seatlayout'); 



