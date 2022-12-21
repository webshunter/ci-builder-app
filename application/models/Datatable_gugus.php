<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Datatable_gugus extends CI_Model{
  private $query;
	private $limit;
	private $startfrom;
	private $key;
	private $table_row;
	private $table_draw;
	private $table_id_edit;
	private $table_name;
	private $button_view;
	private $action;
	private $actcond;
	private $custom_button;
	private $custom_button2;
	private $custome;
	private $count;
	public function datatable($data = "")
	{
		$query = " SELECT ";
		$count = " SELECT ";
		if(isset($data['select'])){
			if (!isset($data['leftJoin'])) {
				foreach ($data['select'] as $key => $value) {
					if ($key == 0) {
						$query .= $value;
					}else{
						$query .= ','.$value;
					}
				}
			}else{
				$number = 0;
				foreach ($data['select'] as $key => $value) {
					if ($number == 0) {
						foreach ($value as $num => $nilai) {
							if ($num == 0) {
								if (strpos($nilai, '#') !== false) {
									$query .= str_replace("#","",$nilai);
								}else{
									$query .= $key.'.'.$nilai;
								}
							}else{
								if (strpos($nilai, '#') !== false) {
									$query .= ','.str_replace("#","",$nilai);
								}else{
								$query .= ','.$key.'.'.$nilai;
								}
							}
						}
					}else{
						foreach ($value as $num => $nilai) {
							if (strpos($nilai, '#') !== false) {
								$query .= ','.str_replace("#","",$nilai);
							}else{
								$query .= ','.$key.'.'.$nilai;
							}
						}
					}
					$number++;
				}
			}
		}else{
			$query .= " * ";
		}
    $count .= " count(*) as tot  FROM ";
		$query .= " FROM ";
		$query .= " ".$data['table']." ";
		$count .= " ".$data['table']." ";
		$this->table_name = $data['table'];
		if (isset($data['leftJoin'])) {
			foreach ($data['leftJoin'] as $key => $value) {
				$query .= " LEFT JOIN ".$key." ON ".$value[0]." ".$value[1]." ".$value[2]."";
				$count .= " LEFT JOIN ".$key." ON ".$value[0]." ".$value[1]." ".$value[2]."";
			}
		}
		if (isset($data['where'])) {
			$query .= " WHERE ";
			$count .= " WHERE ";
			foreach ($data['where'] as $keys => $value) {
				if ($keys == 0) {
					$query .= $value[0].' '.$value[1].' "'.$value[2].'"';
					$count .= $value[0].' '.$value[1].' "'.$value[2].'"';
				}else{
					$query .= ' AND '.$value[0].' '.$value[1].' "'.$value[2].'"';
					$count .= ' AND '.$value[0].' '.$value[1].' "'.$value[2].'"';
				}
			}
		}
		if (isset($data['search'])) {
			$nilai_pencarian = $data['search']['value'];
			if(isset($data['where'])){
				$query .= " AND (";
				$count .= " AND (";
			}else{
				$query .= " WHERE (";
				$count .= " WHERE (";
			}
			foreach ($data['search']['row'] as $keys => $value) {
				if ($keys == 0) {
					$query .= $value.' LIKE "%'.$nilai_pencarian.'%"';
					$count .= $value.' LIKE "%'.$nilai_pencarian.'%"';
				}else{
					$query .= " OR ".$value.' LIKE "%'.$nilai_pencarian.'%"';
					$count .= " OR ".$value.' LIKE "%'.$nilai_pencarian.'%"';
				}
			}
			$query .= ") ";
			$count .= ") ";
		}
		if (isset($data['order'])) {
			if ($data['order']['order-data'] != "") {
				$order_condition = $data["order"]['order-data'][0]["dir"];
				$order_column = $data['order']['order-data'][0]['column'];
				$order_by = "";
				foreach ($data['order']['order-option'] as $keys => $value) {
					if ($keys == $order_column) {
						$order_by = $value;
					}
				}
				$query .= " ORDER BY ".$order_by." ".$order_condition." ";
				$count .= " ORDER BY ".$order_by." ".$order_condition." ";
			}else{
				$query .= " ORDER BY ".$data['order']['order-default'][0]." ".$data['order']['order-default'][1]." ";
				$count .= " ORDER BY ".$data['order']['order-default'][0]." ".$data['order']['order-default'][1]." ";
			}
		}
		if (isset($data['table-show'])) {
			$this->key = $data['table-show']['key'];
			$this->table_row = $data['table-show']['data'];
		}
		if (isset($data['table-draw'])) {
			$this->table_draw = $data['table-draw'];
		}
		if (isset($data['limit'])) {
			$this->limit = " LIMIT ".$data['limit']['start'].",".$data['limit']['end'];
			$this->startfrom =  $data['limit']['start'];
		}
		if (isset($data['action'])) {
			$this->action = $data['action'];
		}
		if (isset($data['actionCondition'])) {
			$this->actcond = $data['actionCondition'];
		}
		if(isset($data["custom-button"])){
			$this->custom_button = $data["custom-button"];
		}
		if(isset($data["custom-button2"])){
			$this->custom_button2 = $data["custom-button2"];
		}
		if(isset($data["custome"])){
			$this->custome = $data["custome"];
		}
		$this->query = $query;
		$this->count = $count;
	}
	private function query_data()
	{
		return $this->db->query($this->query);
	}
	private function query_limit(){
		return $this->db->query($this->query.$this->limit);
	}
  private function query_count(){
		return $this->db->query($this->count)->row()->tot;
	}
	private function buat_table(){
        $arr = [];
        $theTable = $this->query_limit()->result();
        $show_table = $this->table_row;
        $key_id = $this->key;

		foreach($theTable as $key => $value){
            $child = [];
            $child[] = $this->startfrom + $key + 1;
            $mynom = $this->startfrom + $key + 1;
            foreach($show_table as $evelop => $variable){
            	$perkalian = " * ";
            	$artikel = "artikel:";
            	$rupiah = "rupiah:";
            	$number = "number:";
            	if (preg_match("/{$perkalian}/i", $variable)) {
            		$kali_data = explode($perkalian, $variable);
            		$data1 = $kali_data[0];
            		$data1 = str_replace("Rp ", "", $value->$data1);
            		$data1 = str_replace(".", "", $data1);
            		$data2 = $kali_data[1];
            		$data2 = str_replace("Rp ", "", $value->$data2);
            		$data2 = str_replace(".", "", $data2);
            		$child[] = 'Rp '.number_format(($data1*$data2),2,',','.');
            	}elseif(preg_match("/{$rupiah}/i", $variable)) {
                $rpd = explode(":", $variable);
                $spdv = $rpd[1];
                $child[] = rp(cekval($value->$spdv, 0, true));
            	}elseif(preg_match("/{$number}/i", $variable)) {
                $rpd = explode(":", $variable);
                $spdv = $rpd[1];
                $child[] = rupiah(cekval($value->$spdv, 0, true));
            	}elseif(preg_match("/{$artikel}/i", $variable)) {
            		$datavar = explode(":", $variable);
            		$data1 = $datavar[1];
                	$child[] = '
						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#'.$data1.$mynom.'">
		                  show
		                </button>
		                <div class="modal fade" id="'.$data1.$mynom.'">
					        <div class="modal-dialog modal-lg">
					          <div class="modal-content">
					            <div class="modal-header">
					              <h4 class="modal-title">'.$data1.'</h4>
					              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                <span aria-hidden="true">&times;</span>
					              </button>
					            </div>
					            <div class="modal-body">
					              '.htmlspecialchars_decode($value->$data1).'
					            </div>
					            <div class="modal-footer justify-content-between">
					              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					            </div>
					          </div>
					          <!-- /.modal-content -->
					        </div>
					        <!-- /.modal-dialog -->
					      </div>
					      <!-- /.modal -->
                	';
            	}else {
					if(isset($this->custome[$variable])){
						if (isset($this->custome[$variable]['content'])) {
							$content = $this->custome[$variable]['content'];
              $formatData = [];
              if (isset($this->custome[$variable]['format'])) {
                $formatData = $this->custome[$variable]['format'];
              }
							$key = $this->custome[$variable]['key'];
							foreach($key as $nm => $key){
                $pop = $key;
                $vv  = $value->$key;
                if (isset($formatData[$nm])) {
                  if ($formatData[$nm] == "rupiah") {
                    $vv = rp(cekval($value->$pop, 0));
                  }elseif ($formatData[$nm] == "number") {
                    $vv = rupiah(cekval($value->$pop, 0));
                  }
                }

								$content = str_replace('{{base_url}}', base_url(''), $content);
								$content = str_replace('{{site_url}}', site_url(''), $content);
								$content = str_replace('{{xxx}}', $mynom, $content);
								$content = str_replace('{{'.$pop.'}}', $vv, $content);
							}
							$child[] = $content;
						}elseif(isset($this->custome[$variable]['replacerow'])){
							$table = $this->custome[$variable]['replacerow']["table"];
							$condition = $this->custome[$variable]['replacerow']["condition"];
							$conditionvalue = $this->custome[$variable]['replacerow']["value"];
							$getd = $this->custome[$variable]['replacerow']["get"];
							$qr = " SELECT * FROM $table WHERE ";
							foreach($condition as $eve => $ccg){
								if ($eve == 0) {
									$cf = $conditionvalue[$eve];
									$qr .= " ".$ccg." = '".$value->$cf."' ";
								}else{
									$cf = $conditionvalue[$eve];
									$qr .= " AND ".$ccg." = '".$value->$cf."' ";
								}
							}
              $cl = $this->db->query($qr)->row();
              if ($cl != NULL) {
                $child[] = $cl->$getd;
              }else{
                $child[] = '';
              }
						}
					}else{
						// set format tanggal if condition is true
						if (strpos($variable, 'tanggal') !== false || strpos($variable, 'tgl') !== false || strpos($variable, 'jatuh_tempo') !== false ) {
								$child[] = date("d-m-Y" ,strtotime($value->$variable));
							}else{
								$child[] = $value->$variable;
							}
					}
            	}
			}
			$custom = "";
			if($this->custom_button != "" ){
				foreach($this->custom_button as $mykey => $nilai_custom){
					if($mykey == "link"){
						$theKey = $nilai_custom['key'];
						$custom .= '<a href="'.url($nilai_custom['link'].$value->$theKey).'" class="'.$nilai_custom['class'].'"> <i class="fas fa-'.$nilai_custom['icon'].'"></i> '.$nilai_custom['text'].'</a>';
					}
				}
			}
			$custom2 = "";
			if($this->custom_button2 != "" ){
				foreach($this->custom_button2 as $mykey2 => $nilai_custom2){
					if($mykey2 == "link"){
						$theKey = $nilai_custom2['key'];
						$custom2 .= '<a href="'.url($nilai_custom2['link'].$value->$theKey).'" class="'.$nilai_custom2['class'].'"> <i class="fas fa-'.$nilai_custom2['icon'].'"></i> '.$nilai_custom2['text'].'</a>';
					}
				}
			}
            if ($this->action == "standart") {

              if (isset($this->actcond)) {
                $conddata = $this->actcond['data'];
                if ($value->$conddata != $this->actcond['val']) {

					$key = [];
					$formatData = [];

					if (isset($this->actcond['key'])) {
					$key = $this->actcond['key'];
					}

					if (isset($this->actcond['format'])) {
					$formatData = $this->actcond['format'];
					}

                	$content = $this->actcond['content'];

					foreach($key as $nm => $key){
						$rupiah = "rupiah:";
						$number = "number:";
						$pop = $key;
						$vv = $value->$pop;

						if (isset($formatData[$nm])) {
							if ($formatData[$nm] == "rupiah") {
							$vv = rp(cekval($value->$pop));
							}elseif ($formatData[$nm] == "number") {
							$vv = rupiah(cekval($value->$pop, 0));
							}
						}

						$content = str_replace('{{base_url}}', base_url(''), $content);
						$content = str_replace('{{site_url}}', site_url(''), $content);
						$content = str_replace('{{'.$pop.'}}', $vv, $content);
					}

                  $child[] = $content;

                }else{
                $child[] = "
                  <center>
                    <div class=\"dropdown\">
                      <button class=\"btn btn-primary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton".$value->$key_id."\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                        Setting
                      </button>
                      <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton".$value->$key_id."\">
                        <a data-id='".$value->$key_id."' class=\"dropdown-item edit\" href=\"#\"><i class='fas fa-edit'></i> Ubah</a>
                        <a data-id='".$value->$key_id."' class=\"dropdown-item delete\" href=\"#\"><i class='fas fa-trash'></i> hapus</a>
                      </div>
                    </div>
                  </center>
                ";
                }

              }else{
                $child[] = "
                <center>
                  <div class=\"dropdown\">
                    <button class=\"btn btn-primary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton".$value->$key_id."\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                      Setting
                    </button>
                    <div class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton".$value->$key_id."\">
                      <a data-id='".$value->$key_id."' class=\"dropdown-item edit\" href=\"#\"><i class='fas fa-edit'></i> Ubah</a>
                      <a data-id='".$value->$key_id."' class=\"dropdown-item delete\" href=\"#\"><i class='fas fa-trash'></i> hapus</a>
                    </div>
                  </div>
                </center>
                ";
              }


            }elseif ($this->action == "delete-only") {
            	$child[] = "
	            <center>
	            	<button data-id='".$value->$key_id."' class='btn btn-danger delete'>hapus</button>
	            </center>
	            ";
            }elseif ($this->action == "custome") {
            	$child[] = "
	            <center>
	            	<a class='btn btn-primary' href='".site_url($this->custome.$value->$key_id)."'>tampilkan</a>
	            </center>
	            ";
            }
            array_push($arr, $child);
        }
        return $arr;
    }
	// public function query_dump(){
	// 	dump($this->query_limit());
	// 	echo($this->query_count());
	// }
	public function table_show(){

    $tot = $this->query_count();

		$r = array(
            "draw"            => $this->table_draw,
            "recordsTotal"    => intval( $tot ),
            "recordsFiltered" => intval( $tot ),
            "data"            => $this->buat_table(),
        );
        echo json_encode($r);
	}
	public static function post($data){
      $nilai = "";
      if (isset($_POST[$data])) {
        $nilai = $_POST[$data];
      }
      return $nilai;
   }
   public function search(){
   		$pencarian = "";
   		if (isset($_POST['search']['value'])) {
   			$pencarian = $_POST['search']['value'];
   		}
   		return $pencarian;
   }

}
