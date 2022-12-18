<?php


class Perusahaans extends CI_Model
{
    public function mydbr($a){
        return $this->db->query($a)->row();
    }

    public static function get()
    {
        return json_decode(ffread('.set'));
    }

    public static function cek($dat = "")
    {
        return cek(Perusahaans::get(), $dat);
    }


}
