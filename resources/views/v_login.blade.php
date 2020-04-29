<!-- 
  Author: รัชชานนท์ พึ่งตา
  ID : 59160683
  Desciption: หน้า View สำหรับการ Login
  Input: Username, Password
  Output: -
 -->

<!-- การเช็ค Session เมื่่อทำการ Login -->
<?php 
session_start();
if(isset($_SESSION["sess_login"]["full_name"]) && isset($_SESSION["sess_login"]["email_addr"]) && isset($_SESSION["sess_login"]["employeeid"]) && strlen(!isset($_SESSION["sess_login"]["name"])<=8)) 
{
  header("Refresh:0; url=/subject_list");
  exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" href="/icon/sms.png" />   
    <title>ล็อกอิน
    </title>
    <meta http-equiv="content-type" content="text/html; charset=us-ascii">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  </head>
  <body dir="auto">
    <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
        <div class="user_card">
          <div class="d-flex justify-content-center">
            <div class="brand_logo_container">
              <img src="/icon/logo.png" class="brand_logo" alt="Logo" width="90" height="90">
            </div>
          </div>
          <div class=" d-flex justify-content-around form_container">
            <form action="/check-login" method="post" id="form-id">
              @csrf
              <div stlye="width:100%;" align="center">
              <h1 class="h3 mb-3  font-weight-normal text-white">ระบบจัดการที่นั่งสอบ
              </h1>
              </div>
              <div class="input-group mb-3">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fas fa-user">
                    </i>
                  </span>
                </div>
                <!-- <input type="text"  class="form-control input_user" value=""  id="Username" name="Username"  placeholder="username" required autocomplete="off" onkeyup="validate_input();" autofocus> -->
                <input type="text"  class="form-control input_user" value=""  id="Username" name="Username"  placeholder="username" required autocomplete="off" autofocus>
              </div>
              <div class="input-group mb-2">
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fas fa-key">
                    </i>
                  </span>
                </div>
                <input type="password" id="Password" name="Password" class="form-control input_pass" value="" placeholder="password" required autocomplete="off" autofocus>
              </div>
              <div class="d-flex justify-content-center mt-3 login_container">
                <button   type="submit" name="button" class="btn login_btn" id="submit" >เข้าสู่ระบบ
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- กล่องแจ้งเตือนข้อผิดพลาด -->
        @if($errors->any())
        <div class="alert alert-danger alertCard " role="alert">
          <strong>คำเตือน!! 
          </strong>
          </strong>{!! implode('', $errors->all('
        <span>:message
        </span>')) !!}
        </
        <strong>
      </div>
      @endif
    </div>
    </div>
  </body>
</html>

<style>
  body,
  html {
    margin: 0;
    padding: 0;
    height: 100%;
    background-repeat: no-repeat;
    background-size: 100% 100%;
    z-index: 9999;
    background-image: url("/icon/NormalView2.jpg")!important;
  }
  .alert{
    padding:10px 15px !important;
  }
  .alertCard{
    position:absolute;
    bottom:20%;
  }
  .user_card {
    height: 370px;
    width: 350px;
    margin-top: auto;
    margin-bottom: auto;
    background: #0b69c3;
    position: relative;
    display: flex;
    justify-content: center;
    flex-direction: column;
    padding: 10px;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    border-radius: 5px;
  }
  .brand_logo_container {
    position: absolute;
    height: 170px;
    width: 170px;
    top: -75px;
    border-radius: 50%;
    background: #55c9f4;
    padding: 10px;
    text-align: center;
  }
  .brand_logo {
    height: 102px;
    width: 100px;
    margin-top: 23px;
  }
  .form_container {
    margin-top: 70px;
  }
  .login_btn {
    width: 100%;
    background: #49bc34 !important;
    color: white !important;
  }
  .login_btn:focus {
    box-shadow: none !important;
    outline: 0px !important;
  }
  .login_container {
    padding: 0 2rem;
  }
  .input-group-text {
    background: #288df9 !important;
    color: white !important;
    border: 0 !important;
    border-radius: 0.25rem 0 0 0.25rem !important;
  }
  .input_user,
  .input_pass:focus {
    box-shadow: none !important;
    outline: 0px !important;
  }
  .custom-checkbox .custom-control-input:checked~.custom-control-label::before {
    background-color: #c0392b !important;
  }
</style>

<script>
  // ฟังก์ชัน ป้องกันการกรอกตัวอักษรภาษาไทย
  function validate_input() {
    var element = document.getElementById('Username');
    element.value = element.value.replace(/[^a-zA-Z0-9]+/, '');
  };
</script>
