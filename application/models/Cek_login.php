<?php


class Cek_login extends CI_Model
{
    public static function ceklogin(Type $var = null)
    {
        if(generate_session('login') == ''){
            return redirect('app/login');
        }
    }
}
