<!-- 
  Author: รัชชานนท์ พึ่งตา,ธีรัช นาคสุทธิ์
  ID : 59160683,59160185
  Desciption: หน้า View สำหรับการค้นหาตารางสอบ
  Input: รหัสนิสิต
  Output: ข้อมูลตารางสอบ
 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<meta charset="utf-8">
<head>
    <link rel="shortcut icon" href="/icon/sms.png" />   
    <title>หน้าแรก</title>
</head>

<div>
   @include('navbar')
</div>


<div class="container " id="container">
	<div class="row justify-content-center content-center" >
                        <div class="col-12 col-md-10 col-lg-8">
                        @if($errors->any())
                            <div class="alert alert-dismissable alert-warning" role="alert" id ="hide">
                                <i class="ti ti-alert"></i>  <strong>แจ้งเตือน !</strong> {!! implode('', $errors->all('<span>:message</span>')) !!}
	                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="clickHide()">×</button>
                            </div>
			            @endif
                            <form class="card card-sm" action="/student-data" method="post">
                            @csrf
                                <div class="card-body row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <i class="fa fa-search h4 text-body"></i>
                                    </div>
                                    <div class="col">
                                        <input class="form-control form-control-lg form-control-borderless" id="std_id" name="std_id" 
                                        type="search" placeholder="ค้นหาด้วยรหัสนิสิต" required>
                                    </div>
                                    <div class="col-auto">
                                        <button class="btn btn-lg btn-primary" type="submit">ค้นหา</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
        <div class="content2"><!-- คำแนะนำการใช้งาน -->
            <li> ใช้รหัสนิสิตในการค้นหา</li>
            <li> ตัวอย่างรหัสนิสิต 59123456</li>
            <li> เมื่อกรอกรหัสนิสิตแล้วให้กดปุ่มค้นหา</li>
        </div>
 </div>

<script>
    //ปิดแท็ปแจ้งเตือน
    function clickHide() {
    var x = document.getElementById("hide");
    x.style.display = "none"; 
    }
</script>

<style>


body {
  height: 100%;
}


    .content2{
        margin-top:20px;
        background-color:#ffffff;
        width:70%;
        height:60%;
        border-radius: 15px;
        border: 2px solid #85B4F7;
        padding: 20px; 
  

    }
    .bg-page{
        background-color:#526E97 ;
        width:100%;
        height:100%;
        opacity:1;
        background-size: 100%;
    }


    .page-setting{
      height:80vh;
      width:100%;
    }


    .form-control-borderless {
        border: none;
    
    }

    .form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }
    .content-center{ 
        position: absolute; 
                transform: translate(40%, 50%);  
    } 



 @media only screen and (max-width: 1024px) {
    .header-text {
        font-size:20px;
        position: absolute;
        left: 80px;
    }
    .content-center{ 
            height:300px;
            width:80%;
                position: absolute; 
                transform: translate(0%, 80%);  
    } 
    .form-control-lg{
       font-size:20px;
    }

    .page-setting{
      height:80vh;
      width:100%;
    }
}

@media only screen and (min-width: 300px) and (max-width: 450px) {
    .fa-search{
        margin-left:10px;
        margin-bottom:5px;
        font-size:20px;
    }
    .content2{
        margin-top:20%;
        background-color:#ffffff;
        width:90%;
        height:80%;
        border-radius: 15px;
        border: 2px solid #73AD21;
        padding: 20px; 
        min-width:80%;
        min-height:50%;
        font-size:14px;
    }

    .header-text {
        color:#fffffF !important;
        font-size:16px;
        position: absolute;
        left: 65px;
      
    }
    .content-center{ 
            height:200px;
            width:90%;
                position: absolute; 
                transform: translate(5%, 80%);  
    } 
    .form-control-lg {
       font-size:16px;
    }
    .card-body {
        padding: 0px;
    }
    .page-setting{
      height:80vh;
      width:100%;
    }

}


</style>