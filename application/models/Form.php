<?php


class Form extends CI_Model
{
    public function mydbr($a){
        return $this->db->query($a)->result();
    }
    public function mydbrow($a){
        return $this->db->query($a)->row();
    }
    public function updateqr($table, $condition, $data)
    {
      $cc = array_keys($condition);
      foreach($cc as $cc){
          $this->db->where($cc, $condition[$cc]);
      }
      return $this->db->update($table, $data);
    }

    public function qrsave($table, $data)
    {
      return $this->db->insert($table, $data);
    }

    public static function save($a, $b = []){
      return (new self)->qrsave($a, $b);
    }

    public static function update($a, $b = [], $c=[]){
      return (new self)->updateqr($a, $b, $c);
    }

    public static function select_db_material($data = "")
      {

          $dataNama = $data['data'];

          $key = null;

          if (isset($data['key'])) {
            $key = $data['key'];
          }

          $custome = null;

          if (isset($data['custome'])) {
            $custome = $data['custome'];
          }


          $name = $data['name'];

          // update untuk left join

          $getData = (new self)->mydbr("SELECT DISTINCT(".$name.") as ".$name.", ".$dataNama." FROM ".$data['db']);

          $createOption = '<option selected value="">--pilih data--</option>';

          foreach ($getData as $key => $value) {
              if (isset($data['selected'])) {
                  if ($data['selected'] == $value->$dataNama) {
                      if ($key != null) {
                        $exm = $custome;
                        foreach ($variable as $key => $vn) {
                          $exm = str_replace('{{'.$vn.'}}', $value->$vn, $exm);
                        }
                        $createOption .= '<option selected value="'.$value->$dataNama.'">'.$exm.'</option>';
                      }else{
                        $createOption .= '<option selected value="'.$value->$dataNama.'">'.$value->$name.'</option>';
                      }
                  }else{
                    if ($key != null) {
                      $exm = $custome;
                      foreach ($variable as $key => $vn) {
                        $exm = str_replace('{{'.$vn.'}}', $value->$vn, $exm);
                      }
                      $createOption .= '<option value="'.$value->$dataNama.'">'.$exm.'</option>';
                    }else{
                      $createOption .= '<option value="'.$value->$dataNama.'">'.$value->$name.'</option>';
                    }
                  }
              }else{
                if ($key != null) {
                  $exm = $custome;
                  foreach ($variable as $key => $vn) {
                    $exm = str_replace('{{'.$vn.'}}', $value->$vn, $exm);
                  }
                  $createOption .= '<option value="'.$value->$dataNama.'">'.$exm.'</option>';
                }else{
                  $createOption .= '<option value="'.$value->$dataNama.'">'.$value->$name.'</option>';
                }
              }
          }

          $html = "
          <div class='input-field col s12'>
              <select id='".$data['fc']."' name='".$data['fc']."'>
              $createOption
              </select>
              <label for='".$data['fc']."'>".$data['title']."</label>
          </div>
          <script>
              $(document).ready(function(){
                  $('select').formSelect();
              });
          </script>
          <div style='clear: both;'></div>
          ";
          return $html;
      }

    public static function select_db($data = "")
    {

      $keyp = null;

      if (isset($data['key'])) {
        $keyp = $data['key'];
      }

      $class = "";

      if (isset($data['class'])) {
        $class = $data['class'];
      }

      $custome = null;

      if (isset($data['custome'])) {
        $custome = $data['custome'];
      }

        if (!isset($data['custome-style'])) {
            $data['custome-style'] = '';
        }

          $dataNama = $data['data'];
          $name = null;

          if (isset($data['name'])) {
            $name = $data['name'];
          }


          $ccs = "";

        if (!isset($data['condition'])) {
                $data['condition'] = [
                    [$data['db'].".delete_set","=",'0']
                ];
            }

          if (isset($data['condition'])) {

            $ccs = " WHERE ";

            $condition = $data['condition'];

            foreach ($condition as $key => $value) {
              if ($key == 0) {
                $a = $value[0];
                $b = $value[1];
                $c = $value[2];
                if ($c == "NULL") {
                  $ccs .= " $a $b $c ";
                }else{
                  $ccs .= " $a $b \"$c\" ";
                }
            }else{
                $a = $value[0];
                $b = $value[1];
                $c = $value[2];

                $kk = " AND ";

                if ($b == "or") {
                  $kk = "OR";
                  $b = "=";
                }

                if ($c == "NULL") {
                  $ccs .= " $kk $a $b $c ";
                }else{
                  $ccs .= " $kk $a $b \"$c\" ";
                }
              }
            }
          }

          $getData = null;

          $leftjoin = "";

          if (isset($data['leftJoin'])) {

              foreach ($data['leftJoin'] as $key => $value) {
                $tabl = $key;
                $a = $value[0];
                $b = $value[1];
                $c = $value[2];
                $leftjoin .= " LEFT JOIN $tabl ON $a $b $c ";
              }

          }

          if (isset($data['leftJoin'])) {
            $select = " * ";
            if (isset($data['select'])) {
              $select = $data['select'];
            }

            $getData = (new self)->mydbr("SELECT $select FROM ".$data['db']." $leftjoin ".$ccs);
          }else{
            if ($keyp != null) {
              $getData = (new self)->mydbr("SELECT * FROM ".$data['db']." $leftjoin ".$ccs);
            }else{
              $getData = (new self)->mydbr("SELECT DISTINCT(".$name.") as ".$name.", ".$dataNama." FROM ".$data['db']." $leftjoin ".$ccs);
            }
          }


          $createOption = '<option selected value="">--pilih data--</option>';

          foreach ($getData as $key => $value) {
              if (isset($data['selected'])) {
                  if ($data['selected'] == $value->$dataNama) {
                    if ($keyp != null) {
                      $exm = $custome;
                      foreach ($keyp as $key => $vn) {
                        $exm = str_replace('{{'.$vn.'}}', $value->$vn, $exm);
                      }
                      $createOption .= '<option selected value="'.$value->$dataNama.'">'.$exm.'</option>';
                    }else{
                      $createOption .= '<option selected value="'.$value->$dataNama.'">'.$value->$name.'</option>';
                    }
                  }else{
                    if ($keyp != null) {
                      $exm = $custome;
                      foreach ($keyp as $key => $vn) {
                        $exm = str_replace('{{'.$vn.'}}', $value->$vn, $exm);
                      }
                      $createOption .= '<option value="'.$value->$dataNama.'">'.$exm.'</option>';
                    }else{
                      $createOption .= '<option value="'.$value->$dataNama.'">'.$value->$name.'</option>';
                    }
                  }
              }else{
                if ($keyp != null) {
                  $exm = $custome;
                  foreach ($keyp as $key => $vn) {
                    $exm = str_replace('{{'.$vn.'}}', $value->$vn, $exm);
                  }
                  $createOption .= '<option value="'.$value->$dataNama.'">'.$exm.'</option>';
                }else{
                  $createOption .= '<option value="'.$value->$dataNama.'">'.$value->$name.'</option>';
                }
              }
          }
          $label = "";
          if (isset($data['title'])) {
            if (self::cekdata($data, 'horizontal') == true) {
                $label = "
                  <label class=\"col-sm-2 col-form-label\" for='".$data['fc']."'>".$data['title']."</label>
                ";
            }else{
                $label = "
                    <label for='".$data['fc']."'>".$data['title']."</label>
                ";
            }
          }
          $readonly = "";
          $rq = "";
          $inputForm = "";
          if(self::cekdata($data, 'readonly') == true){
            $val = "";
            if (isset($data['selected'])) {
              $val = $data['selected'];
            }

            $idform = "readonly";
            $inputForm = " <input id='".str_replace(']', 'b', str_replace('[', 'a', $data['fc']))."-readonly' type='hidden' name='".$data['fc']."' value='$val' > ";
            $readonly = " readonly = 'true' ";
          }
            if (self::cekdata($data, 'horizontal') == true) {
                $html = "
                <div class='form-group row' ".$data['custome-style'].">
                $label
                  <div class=\"col-sm-10\">
                    $inputForm
                    <select $rq $readonly id='".str_replace(']', 'b', str_replace('[', 'a', $data['fc']))."' name='".$data['fc']."' class='form-control select2bs4 $class'>
                      $createOption
                    </select>
                  </div>
                </div>
                ";

                if(self::cekdata($data, 'readonly') != true){
                $html .= "
                  <script>
                      $('#".str_replace(']', 'b', str_replace('[', 'a', $data['fc']))."').select2({
      theme: 'bootstrap4'
    })
                  </script>
                  ";
                }else{
                  $html .= "
                  <script>
                    $('#".str_replace(']', 'b', str_replace('[', 'a', $data['fc']))."').select2({
                      disabled: true
                    });
                  </script>
                  ";
                }
            }else{
                $html = "
                <div class='form-group' ".$data['custome-style'].">
                    $label
                    $inputForm
                    <select $rq $readonly id='".str_replace(']', 'b', str_replace('[', 'a', $data['fc']))."' name='".$data['fc']."' class='form-control select2bs4 $class'>
                        $createOption
                    </select>
                </div>
                ";

                if(self::cekdata($data, 'readonly') != true){
                $html .= "
                  <script>
                      $('#".str_replace(']', 'b', str_replace('[', 'a', $data['fc']))."').select2({
                        theme: 'bootstrap4'
                      })
                  </script>
                  ";
                }else{
                  $html .= "
                  <script>
                    $('#".str_replace(']', 'b', str_replace('[', 'a', $data['fc']))."').select2({
                      disabled: true
                    });
                  </script>
                  ";
                }
            }
          return $html;
    }

    public static function multicheck($data = [])
    {

        if (!isset($data['custome-style'])) {
            $data['custome-style'] = '';
        }

          $dataNama = $data['data'];
          $name = $data['name'];

            if(isset($data['selected'])){
                if ($data['selected'] == "") {
                    $data['selected'] = '[]';
                }
            }


          $ccs = "";

            if (!isset($data['condition'])) {
                $data['condition'] = [
                    "delete_set" => '0'
                ];
            }

          if (isset($data['condition'])) {

            $ccs = " WHERE ";

            $condition = $data['condition'];

            $keyss = array_keys($condition);

            foreach ($keyss as $key => $value) {
              if ($key == 0) {
                $val = $condition[$value];
                $ccs .= " $value = '$val' ";
              }else{
                $val = $condition[$value];
                $ccs .= ", $value = '$val' ";
              }
            }
          }

          $getData = (new self)->mydbr("SELECT DISTINCT(".$name.") as ".$name.", ".$dataNama." FROM ".$data['db'].$ccs);

          $createOption = '';

            foreach ($getData as $key => $value) {

                if(isset($data['selected'])){
                    if (in_array($value->$dataNama, json_decode($data['selected'],true))) {
                        $createOption .= '
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" checked name="'.$data['fc'].'['.$key.']" id="'.$data['fc'].$key.'"  value="'.$value->$dataNama.'">
                            <label for="'.$data['fc'].$key.'">
                                '.$value->$name.'
                            </label>
                        </div>
                        ';
                    }else{
                        $createOption .= '
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" name="'.$data['fc'].'['.$key.']" id="'.$data['fc'].$key.'"  value="'.$value->$dataNama.'">
                            <label for="'.$data['fc'].$key.'">
                                '.$value->$name.'
                            </label>
                        </div>
                        ';
                    }
                }else{
                    $createOption .= '
                    <div class="icheck-primary d-inline">
                        <input type="checkbox" name="'.$data['fc'].'['.$key.']" id="'.$data['fc'].$key.'"  value="'.$value->$dataNama.'">
                        <label for="'.$data['fc'].$key.'">
                            '.$value->$name.'
                        </label>
                    </div>

                    ';
                }

            }

            $html = "
            <div class=\"form-group clearfix\">
                $createOption
            </div>
            ";

          return $html;
    }

    public static function radiobutton($data = [])
    {

        if (!isset($data['custome-style'])) {
            $data['custome-style'] = '';
        }

          $dataNama = $data['data'];
          $name = $data['name'];

            if(isset($data['selected'])){
                if ($data['selected'] == "") {
                    $data['selected'] = '[]';
                }
            }


          $ccs = "";

            if (!isset($data['condition'])) {
                $data['condition'] = [
                    "delete_set" => '0'
                ];
            }

          if (isset($data['condition'])) {

            $ccs = " WHERE ";

            $condition = $data['condition'];

            $keyss = array_keys($condition);

            foreach ($keyss as $key => $value) {
              if ($key == 0) {
                $val = $condition[$value];
                $ccs .= " $value = '$val' ";
              }else{
                $val = $condition[$value];
                $ccs .= ", $value = '$val' ";
              }
            }
          }

          $getData = (new self)->mydbr("SELECT DISTINCT(".$name.") as ".$name.", ".$dataNama." FROM ".$data['db'].$ccs);

          $createOption = '';

            foreach ($getData as $key => $value) {


                $keys = 1;

                if(isset($data['selected'])){
                    if (in_array($value->$dataNama, json_decode($data['selected'],true))) {
                        $createOption .= '
                        <div class="icheck-primary d-inline">
                            <input type="radio" checked name="'.$data['fc'].'['.$keys.']" id="'.$data['fc'].$key.'"  value="'.$value->$dataNama.'">
                            <label for="'.$data['fc'].$key.'">
                                '.$value->$name.'
                            </label>
                        </div>
                        ';
                    }else{
                        $createOption .= '
                        <div class="icheck-primary d-inline">
                            <input type="radio" name="'.$data['fc'].'['.$keys.']" id="'.$data['fc'].$key.'"  value="'.$value->$dataNama.'">
                            <label for="'.$data['fc'].$key.'">
                                '.$value->$name.'
                            </label>
                        </div>
                        ';
                    }
                }else{
                    $createOption .= '
                    <div class="icheck-primary d-inline">
                        <input type="radio" name="'.$data['fc'].'['.$keys.']" id="'.$data['fc'].$key.'"  value="'.$value->$dataNama.'">
                        <label for="'.$data['fc'].$key.'">
                            '.$value->$name.'
                        </label>
                    </div>

                    ';
                }

            }

            $html = "
            <div class=\"form-group clearfix\">
                $createOption
            </div>
            ";

          return $html;
    }

    public static function multiple($data = "")
      {

          $dataNama = $data['data'];
          $name = $data['name'];
          $getData = (new self)->mydbr("SELECT DISTINCT(".$name.") as ".$name.", ".$dataNama." FROM ".$data['db']);
          $createOption = '<option value="">--pilih data--</option>';
          foreach ($getData as $key => $value) {
              if (isset($data['selected'])) {
                  if ($data['selected'] == $value->$dataNama) {
                      $createOption .= '<option selected value="'.$value->$dataNama.'">'.$value->$name.'</option>';
                  }else{
                      $createOption .= '<option value="'.$value->$dataNama.'">'.$value->$name.'</option>';
                  }
              }else{
                  $createOption .= '<option value="'.$value->$dataNama.'">'.$value->$name.'</option>';
              }
          }

        if (self::cekdata($data, 'horizontal') == true) {
            $html = "
            <div class='form-group'>
                <label class=\"col-sm-2 col-form-label\" for='".$data['fc']."'>".$data['title']."</label>
                <div class=\"col-sm-8\">
                    <select id='".$data['fc']."' name='".$data['fc']."[]' class='select2' multiple='multiple' data-placeholder='Select a State' style='width: 100%;'>
                        $createOption
                    </select>
                </div>
            </div>
            <script>
                $(function () {
                    $('#".$data['fc']."').select2()
                })
            </script>
            ";
        }else{
            $html = "
            <div class='form-group'>
                <label for='".$data['fc']."'>".$data['title']."</label>
                <select id='".$data['fc']."' name='".$data['fc']."[]' class='select2' multiple='multiple' data-placeholder='Select a State' style='width: 100%;'>
                    $createOption
                </select>
            </div>
            <script>
                $(function () {
                    $('#".$data['fc']."').select2()
                })
            </script>
            ";

        }

          return $html;
      }

      public static function getfile($data, $path, $id = "", $table = "")
      {
          if (!file_exists($path)) {
              mkdir($path, 0777, true);
          }
          $gambar = "";
          if ($id != "" && $table != "") {
              $gambar = (new self)->mydbrow("SELECT * FROM $table WHERE id = '$id'");
          }
          $nameparamp = $data;
          $ext = null;
          if (is_array($data)) {
            $nameparamp = null;
            $data = $data;
            $ext = $data["ext"];
          }else{
            $data = $_FILES[$data];
            $ext = pathinfo($data['name'], PATHINFO_EXTENSION);
          }

          if ($data['name'] != "") {
              if ($gambar != "") {
                  if (isset($gambar)) {
                      unlink($path.'/'.$gambar->$nameparamp);
                  }
              }
              // cek if file exist
              $uniq = uniqid();
              if(file_exists($path.'/'.$uniq.'.'.$ext)){
                  unlink($path.'/'.$uniq.'.'.$ext);
                  move_uploaded_file($data['tmp_name'], $path.'/'.$uniq.'.'.$ext);
              }else{
                  move_uploaded_file($data['tmp_name'], $path.'/'.$uniq.'.'.$ext);
              }
              return $uniq.'.'.$ext;
          }else{
              if ($nameparamp != null) {
                return $gambar->$nameparamp;
              }else{
                return "";
              }
          }
      }

      public static function read_db($a = ""){
          return (new self)->mydbr($a);
      }

      public static function cekdata($data, $nilai)
      {
          if (isset($data[$nilai])) {
              return $data[$nilai];
          }else{
              return "";
          }
      }





      public static function input($data)
      {

        if (!isset($data['custome-style'])) {
            $data['custome-style'] = '';
        }

          $html = '<div class="row">';
          $html .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
          if ($data['type'] == "checkbox") {
              $html .= '<div class="form-group float-lb">';
            $html .= '<div class="custom-control custom-checkbox">';
          }else{

            if (self::cekdata($data, 'horizontal') == true) {
                $html .= "<div class=\"form-group row\" ".$data['custome-style']." >";
            }else{
                $html .= "<div class=\"form-group\" ".$data['custome-style']." >";
            }

          }
          if (isset($data["show-image"])) {
              if ($data["show-image"] === true) {
                  $html .= '	<div  style="text-align: center;">';
                  if (isset($data["path-image"])) {
                      $html .= '	 <img src="'.base_url().$data["path-image"].'" width="250px" height="auto" id="gambar-'.self::cekdata($data, 'fc').'" alt="">';
                  }else{
                      $html .= '	 <img src="" width="250px" height="auto" id="gambar-'.self::cekdata($data, 'fc').'" alt="">';
                  }
                  $html .= '	</div>';
              }
          }


          if(self::cekdata($data, 'title') != ""){
            if(self::cekdata($data, 'type') != "checkbox"){
                if (self::cekdata($data, 'type') != "hidden") {
                    if (self::cekdata($data, 'horizontal') == true) {
                        $html .= '	<label class="col-sm-2 col-form-label" for="'.self::cekdata($data, 'fc').'" >'.self::cekdata($data,'title').'</label>';
                    }else{
                        $html .= '	<label for="'.self::cekdata($data, 'fc').'" >'.self::cekdata($data,'title').'</label>';
                    }
                }
            }
          }

            if (self::cekdata($data, 'horizontal') == true) {
                $html .= '	<div class="col-sm-10"> ';
            }

            if (self::cekdata($data, 'type') == "number") {
              if (!isset($data['value'])) {
                $html .= '<input id="'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'" class="'.self::cekdata($data, 'class').'" type="hidden" name="'.self::cekdata($data, 'fc').'" />';
              }else{
                $html .= '<input id="'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'" class="'.self::cekdata($data, 'class').'" type="hidden" name="'.self::cekdata($data, 'fc').'" value="'.self::cekdata($data, 'value').'" />';
              }

            }


          $html .= '	<input ';
          if (self::cekdata($data, 'type') == "number") {
            $html .= ' type="text" ';
          }else{
            $html .= ' type="'.self::cekdata($data, 'type').'" ';
          }

          if (self::cekdata($data, 'type') == "number") {
            $html .= ' id="'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'_nbr4" ';
          }else{
            $html .= ' id="'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'" ';
          }

          if (self::cekdata($data, 'type') == "number") {
            $html .= ' name="_nbr4'.self::cekdata($data, 'fc').'"';
          }else{
            $html .= ' name="'.self::cekdata($data, 'fc').'" ';
          }

          if($data['type'] == 'checkbox'){
              $html .= ' class="custom-control-input '.self::cekdata($data, 'class').'" ';
          }else{
            if (self::cekdata($data, 'type') != "number") {
              $html .= ' class="form-control '.self::cekdata($data, 'class').'" ';
            }else{
              $html .= ' class="form-control" ';
            }
          }

          if (isset($data['placeholder'])) {
              $html .= ' placeholder="'.str_replace("_", " ", $data['placeholder']).'" ';
          }

          if (isset($data['tag'])) {
              $html .= ' data-role="tagsinput" ';
          }

          if (isset($data['video']) && $data['video'] === true) {
              $html .= ' data-video="'.self::cekdata($data, 'fc').'" ';
          }

          if (isset($data['value'])) {
              $html .= ' value="'.$data['value'].'" ';
          }
          if (isset($data['autocomplete'])) {
              if ($data['autocomplete'] == 'off') {
                  $html .= ' autocomplete="off" ';
              }
          }
          if (isset($data['required'])) {
              if (isset($data['required'])) {
                  $html .= ' required ';
              }
          }

          if (isset($data['multiple'])) {
              if ($data['multiple'] === true) {
                  $html .= " multiple ";
              }
          }

          if (isset($data['readonly'])) {
              if ($data['readonly'] === true) {
                  $html .= " readonly='true' ";
              }
          }

          if (isset($data['disabled'])) {
              if ($data['disabled'] === true) {
                  $html .= " disabled='true' ";
              }
          }

          if(isset($data['accept'])){
              if ($data['accept'] === "images") {
                  $html .= "accept='image/*'";
              }
          }

          if(isset($data['tags'])){
              if ($data['tags'] === true) {
                  $html .= " data-role='tagsinput' ";
              }
          }

          if(isset($data['attr'])){
              $cm = $data['attr'];
              $html .= " $cm ";
          }

          if(isset($data['type'])) {
              if ($data['type'] == 'number') {
                  $html .= " onkeypress='numonly".str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc')))."(this)' ";
              }
          }

          if(isset($data['type'])) {
              if ($data['type'] == 'number') {
                  $html .= " onkeyup='numonly".str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc')))."(this)' ";
              }
          }

          $html .= '>';
          $html .= '<small style="color: red;" id="info'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'"></small>';

            if (self::cekdata($data, 'horizontal') == true) {
                $html .= '	</div> ';
            }


          if(self::cekdata($data, 'title') != ""){
            if(self::cekdata($data, 'type') == "checkbox"){
                if (self::cekdata($data, 'type') != "hidden") {
                    $html .= '	<label style="cursor: pointer;" class="custom-control-label" for="'.self::cekdata($data, 'fc').'" >'.self::cekdata($data,'title').'</label>';
                }
            }
          }



          if(isset($data['info'])){
              $html .= '<p style="color: #aaa; font-size: 12px;">';
              $html .= '<i>';
              $html .= $data['info'];
              $html .= '</i>';
              $html .= '</p>';
          }




          if(isset($data['type'])){
              if ($data['type'] == 'number') {

                  $html .= '
                  <script>
                  ';
                  if (self::cekdata($data, "max") != "") {
                    $html .= '
                      var max'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).' = '.self::cekdata($data, "max").';
                    ';
                  }else{
                    $html .= '
                    var max'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).' = undefined;
                    ';
                  }

                  $html .= '

                    var '.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'_nbr4 = document.getElementById("'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'");
                    var '.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).' = document.getElementById("'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'_nbr4");

                    function formatRupiah'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'(angka, prefix) {

                      console.log(angka);

                      var number_string = angka.replace(/[^,\d]/g, "").toString(),

                      split = number_string.split(","),

                      sisa = split[0].length % 3,

                      rupiah = split[0].substr(0, sisa),

                      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                      // tambahkan titik jika yang di input sudah menjadi angka ribuan

                      if (ribuan) {

                        separator = sisa ? "." : "";

                        rupiah += separator + ribuan.join(".");

                      }

                      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;

                      return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";

                    }

                    function numonly'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'(evt) {

                      var idInfo = "info'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'";
                      document.getElementById(idInfo).innerText = "";

                      var c = evt.value;
                      var pis = c.length - 1;
                      if(c[pis] == "."){
                        c = c.substr(0, pis)+",";
                        console.log(c)
                      }

                      c = c.replace(/\./g, "");

                      var dp = c.replace(/\,/g, ".");

                      if(Number(dp) == 0){
                        c = "";
                      }

                      evt.value = formatRupiah'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'(c, "");

                      '.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'_nbr4.value = dp;

                      var xs = '.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'_nbr4;

                      if(max'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).' != undefined){
                        c = c.replace(/\./g, "");
                        c = c.replace(/\,/g, ".");
                        if (Number(c) > Number(max'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).')) {
                          var sl = Number(max'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).') + "";
                          console.log('.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'_nbr4.value);
                          sl = sl.replace(/\./g, ",");
                          evt.value = formatRupiah'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'(sl, "")

                          var idInfo = "info'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'";
                          setTimeout(()=>{
                            document.getElementById("'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'").value = sl.replace(/\,/g, ".");
                          }, 10)
                          document.getElementById(idInfo).innerText = "max "+ formatRupiah'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'(sl);
                        }
                      }

                    }

                    '.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'.value = formatRupiah'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'('.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'.value.replace(/\./g, ",") , "");

                  </script>

                  ';
              }
          }

          if (isset($data["show-image"])) {
              if ($data["show-image"] === true) {
                  $html .= '
                  <script>
                      function bacagambarnya(input){
                          if (input.files && input.files[0]) {
                              var reader = new FileReader();

                              reader.onload = function (e){
                                  $("#gambar-'.self::cekdata($data, 'fc').'").attr("src", e.target.result);
                              }
                              reader.readAsDataURL(input.files[0]);
                          }
                      }

                      $("#'.self::cekdata($data, 'fc').'").change(function(){
                          bacagambarnya(this);
                      })
                  </script>

              ';
              }
          }
          if ($data['type'] == 'checkbox') {
              $html .= '</div>';
          }
          $html .= '</div>';
          $html .= '</div>';
          $html .= '</div>';
          return $html;
      }

      public static function editor($data)
      {

        if (!isset($data['custome-style'])) {
            $data['custome-style'] = '';
        }

          $html = "<div class=\"form-group\" ".$data['custome-style'].">";
          if (self::cekdata($data, 'horizontal') == true) {
              $html = "<div class=\"form-group row\" ".$data['custome-style'].">";
          }
          if (isset($data["show-image"])) {
              if ($data["show-image"] === true) {
                  $html .= '	<div  style="text-align: center;">';
                  if (isset($data["path-image"])) {
                      $html .= '	 <img src="'.base_url().$data["path-image"].'" width="250px" height="auto" id="gambar-'.self::cekdata($data, 'fc').'" alt="">';
                  }else{
                      $html .= '	 <img src="" width="250px" height="auto" id="gambar-'.self::cekdata($data, 'fc').'" alt="">';
                  }
                  $html .= '	</div>';
              }
          }
          if (self::cekdata($data, 'type') != "hidden") {
              if (self::cekdata($data, 'horizontal') == true) {
                  $html .= '	<label class="col-sm-2 col-form-label" for="'.self::cekdata($data, 'fc').'">'.self::cekdata($data,'title').'</label>';
                }else{
                  $html .= '	<label for="'.self::cekdata($data, 'fc').'">'.self::cekdata($data,'title').'</label>';
              }
          }


            if (self::cekdata($data, 'horizontal') == true) {
                $html .= '	<div class="col-sm-10"> ';
            }

          $html .= '	<textarea ';
          $html .= ' type="'.self::cekdata($data, 'type').'" ';
          $html .= ' id="'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'" ';
          $html .= ' name="'.self::cekdata($data, 'fc').'" ';
          $html .= ' class="form-control html-editor '.self::cekdata($data, 'class').'" ';
          if (isset($data['placeholder'])) {
              $html .= ' placeholder="'.str_replace("_", " ", $data['placeholder']).'" ';
          }
          if (isset($data['autocomplete'])) {
              if ($data['autocomplete'] == 'off') {
                  $html .= ' autocomplete="off" ';
              }
          }
          if (isset($data['required'])) {
              if (isset($data['required'])) {
                  $html .= ' required ';
              }
          }

          if (isset($data['multiple'])) {
              if ($data['multiple'] === true) {
                  $html .= " multiple ";
              }
          }

          if(isset($data['accept'])){
              if ($data['accept'] === "images") {
                  $html .= "accept='image/*'";
                  // */
              }
          }
          $html .= '>';
          if (isset($data['value'])) {
              $html .= htmlspecialchars_decode($data['value']);
          }
          $html .= '</textarea>';
          if (self::cekdata($data, 'horizontal') == true) {
                $html .= '	</div> ';
            }

          $redli = "";
          if(isset($data["readonly"])){
            $redli = "readOnly: true,";
          }

          $html .= '<script>';
          if (isset($data["codeeditor"])) {
            $html .= '
            (function ($) {
              "use strict";
              
              var value = "// The bindings defined specifically in the Sublime Text mode\nvar bindings = {\n";
              var map = CodeMirror.keyMap.sublime;
              for (var key in map) {
                var val = map[key];
                if (key != "fallthrough" && val != "..." && (!/find/.test(val) || /findUnder/.test(val)))
                  value += "  \"" + key + "\": \"" + val + "\",\n";
              }
              value += "}\n\n// The implementation of joinLines\n";
              value += CodeMirror.commands.joinLines.toString().replace(/^function\s*\(/, "function joinLines(").replace(/\n  /g, "\n") + "\n";
              
              var '.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'editor = CodeMirror.fromTextArea(document.getElementById("'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'"), {
                 lineNumbers: true,
                 matchBrackets: true,
                 keyMap: "sublime",
                 styleActiveLine: true,'.$redli.'
                 theme:"material",
                 theme:"material",
                 onChange: function (cm) {
                 console.log(cm.getValue())
                   document.getElementById("'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'").value = cm.getValue();
                 }
               });
               
               '.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'editor.on("change", function () {
                       var html = '.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'editor.getValue();
                        document.getElementById("'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'").value = html;
                    });
               
               
              })(jQuery);
              
            ';
          }else{
            if (!isset($data['text-area'])) {
              $html .= '$("#'.str_replace(']', 'b', str_replace('[', 'a', self::cekdata($data, 'fc'))).'").summernote()';
            }
          }
          $html .= '</script>';
          $html .= '</div>';

          return $html;
      }


      public static function switch($name = "",$data1 = "", $data2= "", $selected = 'checked')
      {


          $dataValue = ['checked', ''];
          $arr = [$data1, $data2];

          $html = '';

          foreach ($arr as $key => $value) {
              if ($dataValue[$key] == $selected) {
                  $html .= '
                      <div class="icheck-primary d-inline">
                          <input type="radio" id="'.str_replace(' ', '_', $value).'" name="'.$name.'" value="'.$dataValue[$key].'"  checked />
                          <label for="'.str_replace(' ', '_', $value).'">
                              '.$value.'
                          </label>
                      </div>
                  ';
              }else{
                  $html .= '
                      <div class="icheck-primary d-inline">
                          <input type="radio" id="'.str_replace(' ', '_', $value).'" name="'.$name.'" value="'.$dataValue[$key].'"/>
                          <label for="'.str_replace(' ', '_', $value).'">
                              '.$value.'
                          </label>
                      </div>
                  ';
              }
          }

          return $html;
      }


      public static function select($data)
      {
          $html = '<div class="form-group">';
          $html .= '	<label for="'.self::cekdata($data, 'fc').'">'.self::cekdata($data,'title').'</label>';
          $html .= '	<select ';
          $html .= 'id="'.self::cekdata($data, 'fc').'"';
          $html .= 'name="'.self::cekdata($data, 'fc').'"';
          $html .= 'class="form-control '.self::cekdata($data, 'class').'"';
          $html .= '>';
          $html .= '</select>';
          $html .= '</div>';
          return $html;
      }


      public static function testing()
        {
            echo "testing";
        }

}
