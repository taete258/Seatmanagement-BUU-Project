<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
class LoginController extends Controller
{
    public function __construct()
    {
    }

    // Function : show_login
    // Auhor : รัชชานนท์ พึงตา
    // ID : 59160683
    // Description : เรียก view login
    // Input : -
    // Output : -
    public function show_login()
    {
        return view('v_login');
    }

    // Function : logout
    // Auhor : รัชชานนท์ พึงตา
    // ID : 59160683
    // Description : ทำลาย Session เพื่อ Logout
    // Input : =
    // Output : -
    public function logout()
    {
        session_start();
        session_destroy();
        return redirect('login');
    }
    // Function : login
    // Auhor : รัชชานนท์ พึงตา
    // ID : 59160683
    // Description : รับ Requst และ ตรวจสอบรูปแบบ Username และ Password
    // Input : Username , Password
    // Output : -
    public function login(Request $req)
    {
        session_start();
        $user   = $req->input('Username');
        $pass   = $req->input('Password');
        // if (is_numeric($user) && strlen($user)<=8) {
        //     return back()->withErrors('รูปแบบ Username หรือ Password ไม่ถูกต้อง');
        // } else {
        //     $result = $this->check_with_ad($user,$pass);
        //     if($result!=0){
        //         if($_SESSION["sess_login"]["name"]){ 
        //                 session_write_close();
        //                 return redirect('subject_list');  
        //         }
        //     }else{
        //         return back()->withErrors('Username หรือ Password ไม่ถูกต้อง');
        //     }  
        // }  
        $result = $this->check_with_ad($user, $pass);
        if ($result != 0) {
            if ($_SESSION["sess_login"]["name"]) {
                session_write_close();
                return redirect('subject_list');
            }
        } else {
            return back()->withErrors('Username หรือ Password ไม่ถูกต้อง');
        }
    }
    // Function : check_with_ad
    // Auhor : รัชชานนท์ พึงตา
    // ID : 59160683
    // Description : เชื่่อมต่อกับ ldap ของมหาวิทยาลัย
    // Input : Username , Password
    // Output : Session entries
    public function check_with_ad($user, $key)
    {
        $retval     = -1;
        $vlan_no    = 1;
        $network_id = 0;
        $ad         = @ldap_connect("ldap://" . AD_SERVER);
        if ($ad && $user != "" && $key != "") {
            ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
            ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
            $retval = 0;
            if (@ldap_bind($ad, "$user@buu.ac.th", "$key")) {
                $filter                               = preg_replace("/XUID/", "$user", AD_FILTER);
                $result                               = ldap_search($ad, AD_BASEDN, $filter);
                $entries                              = ldap_get_entries($ad, $result);
                $_SESSION["sess_login"]["full_name"]  = $entries[0]["displayname"][0];
                $_SESSION["sess_login"]["email_addr"] = $entries[0]["mail"][0];
                $_SESSION["sess_login"]["employeeid"] = $entries[0]["employeeid"][0];
                $_SESSION["sess_login"]["name"]       = $entries[0]["name"][0];
                $retval                               = 1;
            }
            // echo '<pre>';
            // print_r($entries);
            // echo '</pre>';
            // die;
            ldap_unbind($ad);
        }
        return $retval;
    }
}

?>