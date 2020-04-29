<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

<script type="text/javascript">
    window.onload = function() {
        if(window.location.pathname =="/student-data" || window.location.pathname =="/main" ||window.location.pathname =="/"){
            document.getElementById('login').style.visibility = 'hidden';
        }
    }
</script>
<nav class="navbar navbar-light bg-c" style="z-index:1">
  <div class="click-main" href="/subject_list">
  <a class="navbar-brand"  style="color:#ffffff;" href="/subject_list">
    <img src="/icon/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
     &nbsp;&nbsp;ระบบจัดการที่นั่งสอบ
  </div>
  </a>

  <?php 
        //session_start();
        if(!isset($_SESSION["sess_login"]["full_name"]))
        {
        echo '<form class="form-inline btn-display" action="/login">
                <button id="login" class=" btn btn-success my-2 my-sm-0" type="submit">Login</button>
             </form>';
            
        }
        else{
                 echo '<h6 class="text-white userlog_name">'.$_SESSION["sess_login"]["full_name"].'<h6> 
                 <a class="form-inline"  href="/logout">
                 <i class="fa fa-sign-out" aria-hidden="true" id="elementID" ></i>
                </a>';
        }
?>
  
 
</nav>

<style>
#elementID {
    color: #fff;
    font-size: 2em;
    position:absolute;
    right:20px;
    top:12px;
}
.userlog_name {
    position:absolute;
    right:80px;
}
    .click-main{
        cursor: pointer;
    }
    .bg-c {
        width:100%;
        background-color:#315B96 ;
        overflow: hidden;
        position: fixed;
        top: 0;
    }
    .btn-display{
        display:show;
        margin:0px;
        position:absolute;
        right:10px;
    }
    .logo{
        width:60px;
        height:auto;
    }

    
 @media only screen and (max-width: 1024px) {

.btn-display{
    display:show;
    position:inline;
    right:10px;
}
.logo{
    width:50px;
    height:auto;
    padding:0px;
}


}

@media only screen and (min-width: 300px) and (max-width: 450px) {

.btn-display{
    display:show;
    position:inline;
    right:10px;
}

.logo{
    width:35px;
    height:auto;
    padding:0px;
}



}
</style>