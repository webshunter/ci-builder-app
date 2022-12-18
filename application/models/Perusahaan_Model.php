<?php


class Perusahaan_Model extends CI_Model
{

    private $table = "perusahaan";

    public function loadas()
    {
        return $this->db->query("select * from perusahaan where id=1")->row();
    }
    
    public static function load()
    {
        return json_decode(ffread('.set'));
    }

    public function save($data)
    {
        return $this->db->update($this->table, $data, array('id' => '1'));
    }

}
