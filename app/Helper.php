<?php
    // Function : formatDateThai
    // Auhor : รัชชานนท์ พึงตา
    // ID : 59160683
    // Description : ฟังก์ชันช่วยในการแสดงผลวันที่ภาษาไทย
    // Input : date
function formatDateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

?>