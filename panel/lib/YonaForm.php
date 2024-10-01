<?php
//////////////////////////////////////////
class YonaValidation {
	
	public $valid = true; 
	public $label = array();
	public $value = array();
	public $msg = array();
	public $js = array();
	public $is_submit = false;
	public $patterns = array(
		'uri'           => '[A-Za-z0-9-\/_?&=]+',
		'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
		'alpha'         => '[\p{L}]+',
		'words'         => '[\p{L}\s]+',
		'alphanum'      => '[\p{L}0-9]+',
		'int'           => '[0-9]+',
		'float'         => '[0-9\.,]+',
		'tel'           => '[0-9+\s()-]+',
		'text'          => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
		'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
		'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
		'address'       => '[\p{L}0-9\s.,()°-]+',
		'date_dmy'      => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
		'date_ymd'      => '[0-9]{4}\-[0-9]{1,2}\-[0-9]{1,2}',
		'email'         => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]'
	);
	
	public function __construct() {
		$this->is_submit=$_POST['submit']!=''?true:false;
		foreach($_POST as $name => $val) {
			$_SESSION['yonaform_data'][$name]=$val;
		}
	}	
	
	public function set_validation($t_var_name) {
		
		$name=$t_var_name['var'];
		$label=$t_var_name['label'];
		
		$this->label=$label;
		$this->name = $name;
		$this->value = $_POST[$name];
	
		
		return $this;
	}
	public function required() {
		$msg = $this->label." harus diisi";
		$this->js[$this->name]['required'] =  array('rules'=>true,'messages'=>$msg);
		
		if($this->value=='' && $this->is_submit) {
			$this->set_warning($this->name,$msg);
			$this->set_invalid($this->name,true);
			$this->valid = false;
		}
		return $this;
	}
	
	public function custom_msg($show=false,$msg='') {
		/*Ini dipasang ketika proses waktu simpan php*/
		if($msg=='') {
			$msg=$this->label.' tidak valid';
		}
		
		if($show){
			$this->valid = false;
			$this->set_warning($this->name,$msg);
			$this->set_invalid($this->name,true);
			
		}	
	}
	public function cek_token($length=0) {
		$msg='Panjang '.$this->label.' minimal '.$length.' karakter';
		$this->js[$this->name]['cek_token'] =  array('rules'=>$length,'messages'=>$msg,$params);
		if(strlen($this->value) < $length  && $this->is_submit){
			$this->valid = false;
			$this->set_warning($this->name,$msg);
			$this->set_invalid($this->name,true);
			
		}		
		return $this;
	}
	public function minlength($length=0) {
		$msg='Panjang '.$this->label.' minimal '.$length.' karakter';
		$this->js[$this->name]['minlength'] =  array('rules'=>$length,'messages'=>$msg);
		if(strlen($this->value) < $length  && $this->is_submit){
			$this->valid = false;
			$this->set_warning($this->name,$msg);
			$this->set_invalid($this->name,true);
			
		}		
		return $this;
	}
	public function min($length=0) {

		$msg=' Nilai '.$this->label.' minimal '.$length.' ';
		$this->js[$this->name]['min'] =  array('rules'=>$length,'messages'=>$msg);
			
		if($this->value < $length  && $this->is_submit){
			$this->valid = false;
			$this->set_warning($this->name,$msg);
			$this->set_invalid($this->name,true);
		}
			
		return $this;
	}
	
	public function maxlength($length=0) {
		$msg='Panjang '.$this->label.' maksimal '.$length.' karakter';
		$this->js[$this->name]['maxlength'] =  array('rules'=>$length,'messages'=>$msg);
		if(strlen($this->value) < $length  && $this->is_submit){
			$this->valid = false;
			$this->set_warning($this->name,$msg);
			$this->set_invalid($this->name,true);
			
		}

		return $this;
	}
	public function max($length=0) {

		$msg=' Nilai '.$this->label.' maksimal '.$length.' ';
		$this->js[$this->name]['max'] =  array('rules'=>$length,'messages'=>$msg);
			
		if($this->value < $length  && $this->is_submit){
			$this->valid = false;
			$this->set_warning($this->name,$msg);
			$this->set_invalid($this->name,true);
		}
		return $this;
	}
	
	public function email() {
		$msg='Format '.$this->label.' salah ';
		$this->js[$this->name]['email'] =  array('rules'=>'true','messages'=>$msg);
		if($this->value!=''  && $this->is_submit) {
			if(!$this->is_email($this->value)) {
				$this->valid = false;
				$this->set_warning($this->name,$msg);
				$this->set_invalid($this->name,true);
			}
		}
		return $this;
	}
	public function is_email($value){
		if(!filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
				return false;
		}
		return true;
	}
	
	public function valid() {
		return $this->valid;
	}
	
	
	public function release_warning($name) {
		unset($_SESSION['yonaform_data'][$name]);
		unset($_SESSION['yonaform_msg'][$name]);
		unset($_SESSION['yonaform_invalid'][$name]);
	}
	public function release_data() {
		
		unset($_SESSION['yonaform_data']);
		unset($_SESSION['yonaform_msg']);
		unset($_SESSION['yonaform_invalid']);
	}
	public function get_warning($name) {
		return $_SESSION['yonaform_msg'][$name];
	}
	public function set_warning($name,$msg) {
		$_SESSION['yonaform_msg'][$name]=$msg;
	}
	public function set_invalid($name,$invalid) {
		$_SESSION['yonaform_invalid'][$name]=$invalid;
	}
	public function get_invalid($name) {
		return $_SESSION['yonaform_invalid'][$name];
	}
	public function get_js_validation() {
		return $this->js;
	}
	public function generate_js_validation() {
		global $script_js;
		$js = $this->get_js_validation();
		$t_rules = '';
		$t_messages = '';
		$t_combine = '';
		if(count($js)>0) {
			
			$rules=array();	
			$message=array();	
			
			//$this->js[$this->name]['required'] =  array('rules'=>true,'messages'=>$msg);

			foreach($js as $name => $data) {
				
				$str_child_rules=array();	
				$str_child_message=array();	
				
				foreach($data as $validation => $var) {
					$str_child_rules[]="$validation:".$var['rules'];
					$str_child_message[]="$validation:'".$var['messages']."'";
				}

				$rules[]=" $name : { ".join(',',$str_child_rules)." } ";
				$message[]=" $name : { ".join(',',$str_child_message)." } ";

			}
			
			$t_rules = 'rules: {'.join(',',$rules).'}';
			$t_message = 'messages: {'.join(',',$message).'}';
			$t_combine =  "$t_rules,$t_message";
		}
ob_start();
echo <<<END
<script>
$(document).ready(function(){
$('.yona-validation').validate({
   $t_combine,
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});  
</script>  
END;
$script_js.=ob_get_clean();

	}
}
class YonaForm extends YonaValidation {
	
	public function __construct($name="") {
		$this->form_name=$name;
	}
	/*	
	public function __destruct() {
		$this->release_data();
	}
	*/ 	
	
	public function get_value($name) {
		return $_POST[$name]!=''?$_POST[$name]:$_SESSION['yonaform_data'][$name];
	}
	public function element_File($label,$name,$params=array()) {
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(uniqid()):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}

		$join_param=join(" ",$d);
		return '<label for="'.$params['id'].'">'.$label.'</label><input type="file" name="'.$name.'" '.$join_param.' />';
	}	
	public function element_Textbox($label="",$name="",$params=array()) {
		
		$d=array();
		$params['id']=!isset($params['id'])?$name:$params['id'];
		$params['class']='form-control'.(isset($params['class'])?" ".$params['class']:'');
		$warning_message=$this->get_warning($name);
		$is_invalid=$this->get_invalid($name);
		$invalid_message='';
		if($warning_message!='') {
			if($is_invalid) {
				$params['class'].=' is-invalid';
			}
			$invalid_message='
			 <div class="invalid-feedback">
				'.$warning_message.'
			 </div>';
		}
		
		
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$value=$this->get_value($name);
		if($value!='') {
			$d[]='value="'.$value.'"';
		}
		 
		$join_param=join(" ",$d);
	
		return '<label for="'.$params['id'].'">'.$label.'</label><input type="text" name="'.$name.'" '.$join_param.' />'.$invalid_message;
	}
	public function element_Select($label="",$name="",$options=array(),$params=array()){
		$d=array();
		$default_value='';
		$params['class']='form-control'.(isset($params['class'])?" ".$params['class']:'');
		$params['id']=!isset($params['id'])?$name:$params['id'];
		
		$warning_message=$this->get_warning($name);
		$is_invalid=$this->get_invalid($name);
		$invalid_message='';
		
		if( $warning_message!='' ) {
			if($is_invalid) {
				$params['class'].=' is-invalid';
			}
			$invalid_message='
			 <div class="invalid-feedback">
				'.$warning_message.'
			 </div>';
		}
		
		foreach($params as $attr_field => $attr_value) {
			
			if($attr_field=="value"){
				$default_value=$attr_value;
				continue;
			}
			$d[]=$attr_field.'="'.$attr_value.'"';
			
		}
		
		$join_param=join(" ",$d);
		
		$r_option=array();
		
		$t_default_value=$this->get_value($name);
		
		if($t_default_value!='') {
			$default_value=$t_default_value;
		}
		$r_option[]='<option value="">--Pilih '.$label.'--</option>';
		foreach($options as $value =>$text) {
			
			$selected=$default_value==$value?'selected="selected"':'';
			$r_option[]='<option value="'.$value.'" '.$selected.'>'.$text.'</option>';
		}
		
		return '<label for="'.$params['id'].'">'.$label.'</label><select name="'.$name.'" '.$join_param.' />'.join(' ',$r_option).'</select>'.$invalid_message;
		
	}
	public function element_Select2Multi($label="",$name="",$options=array(),$params=array(),$multiple_select_selected=array()){
		$d=array();
		$default_value='';
		$params['class']='form-control'.(isset($params['class'])?" ".$params['class']:'');
		$params['id']=!isset($params['id'])?$name:$params['id'];
		
		$warning_message=$this->get_warning($name);
		$is_invalid=$this->get_invalid($name);
		$invalid_message='';
		
		if( $warning_message!='' ) {
			if($is_invalid) {
				$params['class'].=' is-invalid';
			}
			$invalid_message='
			 <div class="invalid-feedback">
				'.$warning_message.'
			 </div>';
		}
		
		foreach($params as $attr_field => $attr_value) {
			
			if($attr_field=="value"){
				$default_value=$attr_value;
				continue;
			}
			$d[]=$attr_field.'="'.$attr_value.'"';
			
		}
		
		$join_param=join(" ",$d);
		
		$r_option=array();
		
		$t_default_value=$this->get_value($name);
		if(is_array($t_default_value)) {
			$default_value=$t_default_value;
		}
		
		foreach($options as $value =>$text) {
			
			$selected=in_array($value,$default_value)?'selected="selected"':'';
			$r_option[]='<option value="'.$value.'" '.$selected.'>'.$text.'</option>';
		}
		
		return '<label for="'.$params['id'].'">'.$label.'</label><select name="'.$name.'" '.$join_param.' />'.join(' ',$r_option).'</select>'.$invalid_message;
		
	}
	public function element_Checkbox($label,$name,$params) {
		
		$d=array();
		$params['id']=!isset($params['id'])?$name:$params['id'];
		$params['class']=''.(isset($params['class'])?" ".$params['class']:'');
		$warning_message=$this->get_warning($name);
		$is_invalid=$this->get_invalid($name);
		$invalid_message='';
		if($warning_message!='') {
			if($is_invalid) {
				$params['class'].=' is-invalid';
			}
			$invalid_message='
			 <div class="invalid-feedback">
				'.$warning_message.'
			 </div>';
		}
		
		
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$value=$this->get_value($name);
		if($value!='') {
			$d[]='value="'.$value.'"';
		}
		$checked=in_array($value,$params['value'])?'checked="checked"':'';
		
		$join_param=join(" ",$d);
		
		return '<label for="'.$params['id'].'">'.$label.'</label> <br/><input type="checkbox" name="'.$name.'" '.$checked.' '.$join_param.' /> Ya'.$invalid_message;
	}
	public function element_Switch($label="",$name="",$params=array()) {
		
		$d=array();
		$params['id']=!isset($params['id'])?$name:$params['id'];
		$params['class']='custom-control-input '.(isset($params['class'])?" ".$params['class']:'');
		$warning_message=$this->get_warning($name);
		$is_invalid=$this->get_invalid($name);
		$invalid_message='';
		if($warning_message!='') {
			if($is_invalid) {
				$params['class'].=' is-invalid';
			}
			$invalid_message='
			 <div class="invalid-feedback">
				'.$warning_message.'
			 </div>';
		}
		
		
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$value=$this->get_value($name);
		if($value!='') {
			$d[]='value="'.$value.'"';
		}
		
		$checked=$value==$params['value']?'checked="checked"':'';
		
		$join_param=join(" ",$d);
		
		//return '<label for="'.$params['id'].'">'.$label.'</label> <br/><input type="checkbox" name="'.$name.'" '.$checked.' '.$join_param.' /> Ya'.$invalid_message;
		return '
		<div class="custom-control custom-switch">
		  <input type="checkbox" name="'.$params['id'].'" id="'.$params['id'].'" '.$checked.' '.$join_param.'">
		  <label class="custom-control-label" for="'.$params['id'].'">'.$label.'</label>
		</div>
		'.$invalid_message.'	';
		
	}
	public function element_bootstrapSwitch($label="",$name="",$params=array()) {
		
		$d=array();
		$params['id']=!isset($params['id'])?$name:$params['id'];
		
		$params['class']='form-control '.(isset($params['class'])?" ".$params['class']:'');
		$warning_message=$this->get_warning($name);
		$is_invalid=$this->get_invalid($name);
		$invalid_message='';
		if($warning_message!='') {
			if($is_invalid) {
				$params['class'].=' is-invalid';
			}
			$invalid_message='
			 <div class="invalid-feedback">
				'.$warning_message.'
			 </div>';
		}
		
		
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$value=$this->get_value($name);
		if($value!='') {
			$d[]='value="'.$value.'"';
		}
		
		$checked=$value==$params['value']?'checked="checked"':'';
		
		$join_param=join(" ",$d);
		//data-off-color="danger" data-on-color="success" data-on-text="Buka" data-off-text="Tutup"
		return '
		  <label for="'.$params['id'].'">'.$label.'</label><br/>
		  <input type="checkbox" name="'.$params['id'].'" id="'.$params['id'].'" '.$checked.' '.$join_param.'" data-bootstrap-switch >
		'.$invalid_message.'	';
		
	}
	public function element_Numberbox($label,$name,$params) {
		
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(uniqid()):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$join_param=join(" ",$d);
		return '<label for="'.$params['id'].'">'.$label.'</label><input type="number" name="'.$name.'" '.$join_param.' />'.$invalid_message;
	}
	public function element_Password($label="",$name="",$params=array()) {
		
		$d=array();
		$params['id']=!isset($params['id'])?$name:$params['id'];
		$params['class']='form-control'.(isset($params['class'])?" ".$params['class']:'');
		$warning_message=$this->get_warning($name);
		$is_invalid=$this->get_invalid($name);
		$invalid_message='';
		if($warning_message!='') {
			if($is_invalid) {
				$params['class'].=' is-invalid';
			}
			$invalid_message='
			 <div class="invalid-feedback">
				'.$warning_message.'
			 </div>';
		}
		
		
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$value=$this->get_value($name);
		if($value!='') {
			$d[]='value="'.$value.'"';
		}
		 
		$join_param=join(" ",$d);
	
		return '<label for="'.$params['id'].'">'.$label.'</label><input type="password" name="'.$name.'" '.$join_param.' />'.$invalid_message;
	}
	public function element_Textarea($label="",$name="",$params=array()) {
		$d=array();
		$value='';
		$params['id']=!isset($params['id'])?'id'.(uniqid()):$params['id'];
		$params['class']='form-control '.(isset($params['class'])?" ".$params['class']:'');
		$warning_message=$this->get_warning($name);
		$is_invalid=$this->get_invalid($name);
		
		$invalid_message='';
		if($warning_message!='') {
			if($is_invalid) {
				$params['class'].=' is-invalid';
			}
			
			$invalid_message='
			 <div class="invalid-feedback">
				'.$warning_message.'
			 </div>';
		}
		
		
		foreach($params as $attr_field => $attr_value){
			
			if($attr_field=="value"){
				$value=$attr_value;
				continue;
			}
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$value=$this->get_value($name);
		$join_param=join(" ",$d);
		
		return '
		<label for="'.$params['id'].'">'.$label.'</label>
		<textarea name="'.$name.'" '.$join_param.'/>'.$value.'</textarea>
		'.$invalid_message;
	}
	
	/*
	public function element_Checkbox($label,$name,$options,$params){
		

		$checkbox=array();
		ob_start();
		foreach($options as $value => $text){
			$id='id'.uniqid();
			$checked=in_array($value,$params['value'])?'checked="checked"':'';
			echo '
			<div class="form-check '.$option_class.'" >
				<input class="form-check-input" name='.$name.' id="'.$id.'" '.$checked.' type="checkbox" value="'.$value .'" 
				<label class="form-check-label" for="'.$id.'">
				'.$text.'
				</label>
			</div>
			';
		}
		
		return ob_get_clean();
 
	}
	* */
	public function element_Button($name,$params,$option_class) {
		$d=array();
		$default_value='';
		$default_text='';
		$params['id']=!isset($params['id'])?'id'.(uniqid()):$params['id'];
		foreach($params as $attr_field => $attr_value){
			
			if($attr_field=="value"){
				$default_value=$attr_value;
				continue;
			}
			if($attr_field=="text"){
				$default_text=$attr_value;
				continue;
			}
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$join_param=join(" ",$d);
		return '<label>&nbsp;</label><br/><button name="'.$name.'" value="'.$default_value.'" '.$join_param.' >'.$default_text.'</button>';
	}
	
	public function element_Hidden($name,$value,$params=array()) {
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(uniqid()):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'" ';
		}
		
		$join_param=join(" ",$d);
		return '<input type="hidden" name="'.$name.'" value="'.$value.'" '.$join_param.' />';
	}
	
}


?>
