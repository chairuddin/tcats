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
		if(!$this->is_submit) {
			$this->valid = false;
		}
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
		if($msg=='') {
			$msg=$this->label.' tidak valid';
		}
		
		if($show){
			$this->valid = false;
			$this->set_warning($this->name,$msg);
			$this->set_invalid($this->name,true);
			
		}	
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
	
	public function number() {
		$msg='Format '.$this->label.' harus angka ';
		$this->js[$this->name]['number'] =  array('rules'=>'true','messages'=>$msg);
		if($this->value!=''  && $this->is_submit) {
			if(!is_numeric($this->value)) {
				$this->valid = false;
				$this->set_warning($this->name,$msg);
				$this->set_invalid($this->name,true);
			}
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
	public function element_File($label="",$name="",$params=array()) {
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(uniqid()):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}

		$join_param=join(" ",$d);
		$form = '
		 <label for="'.$params['id'].'">'.$label.'</label>
			<div class="input-group">
			  <div class="custom-file">
				<input type="file" class="custom-file-input" id="'.$params['id'].'" name="'.$name.'" '.$join_param.'>
				<label class="custom-file-label" for="'.$params['id'].'">Pilih berkas</label>
			  </div>
			  
			</div>
		';
		return $form;
	}	
	public function element_Textbox($label="",$name="",$params=array(),$mode=array('label'=>2,'input'=>10)) {
		
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
	
		return '<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<input type="text" name="'.$name.'" '.$join_param.' />'.$invalid_message.'
		</div>
		';
	}
	public function element_DateTime($label="",$name="",$params=array(),$mode=array('label'=>2,'input'=>10)) {
		
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
	
		return '<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<input type="datetime-local" name="'.$name.'" '.$join_param.' />'.$invalid_message.'
		</div>
		';
	}
	public function element_Time($label="",$name="",$params=array(),$mode=array('label'=>2,'input'=>10)) {
		
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
	
		return '<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<input type="time" name="'.$name.'" '.$join_param.' />'.$invalid_message.'
		</div>
		';
	}
	public function element_Date($label="",$name="",$params=array(),$mode=array('label'=>2,'input'=>10)) {
		
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
	
		return '<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<input type="date" name="'.$name.'" '.$join_param.' />'.$invalid_message.'
		</div>
		';
	}
	public function element_Email($label="",$name="",$params=array(),$mode=array('label'=>2,'input'=>10)) {
		
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
	
		return '<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<input type="email" name="'.$name.'" '.$join_param.' />'.$invalid_message.'
		</div>
		';
	}
	public function element_Tel($label="",$name="",$params=array(),$mode=array('label'=>2,'input'=>10)) {
		
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
	
		return '<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<input type="tel" name="'.$name.'" '.$join_param.' />'.$invalid_message.'
		</div>
		';
	}
	public function element_Select($label="",$name="",$options=array(),$params=array(),$mode=array('label'=>2,'input'=>10)){
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
		
		foreach($options as $value =>$text) {
			
			$selected=$default_value==$value?'selected="selected"':'';
			$r_option[]='<option value="'.$value.'" '.$selected.'>'.$text.'</option>';
		}
		return '<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<select name="'.$name.'" '.$join_param.' />'.join(' ',$r_option).'</select>'.$invalid_message.'
		</div>
		';
		
		//return '<label for="'.$params['id'].'">'.$label.'</label><select name="'.$name.'" '.$join_param.' />'.join(' ',$r_option).'</select>'.$invalid_message;
		
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
		return '<label class="col-lg-2 col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-10">
		<select name="'.$name.'" '.$join_param.' />'.join(' ',$r_option).'</select>'.$invalid_message.'
		</div>
		';
		//return '<label for="'.$params['id'].'">'.$label.'</label><select name="'.$name.'" '.$join_param.' />'.join(' ',$r_option).'</select>'.$invalid_message;
		
	}
	public function element_Checkbox($label,$name="",$params=array()) {
		
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
		
		if($params['checked']=='') {
			$checked=in_array($value,$params['value'])?'checked="checked"':'';
		}
		
		$join_param=join(" ",$d);
		
		/*
		return '<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<input type="checkbox" name="'.$name.'" '.$checked.' '.$join_param.' />'.$invalid_message.'
		</div>
		';
		*/
		/*
		return '<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<input type="checkbox" name="'.$name.'" '.$checked.' '.$join_param.' />'.$invalid_message.'
		</div>
		';
		*/
		return '<div class="form-check mb-3">
			<label class="form-check-label">
			<input type="checkbox" name="'.$name.'" '.$checked.'  class="form-check-input" '.$join_param.' >'.$label.'</label>
	</div>';
		
		//return '<label for="'.$params['id'].'">'.$label.'</label> <br/><input type="checkbox" name="'.$name.'" '.$checked.' '.$join_param.' /> Ya'.$invalid_message;
	}
	public function element_Radio($label,$name,$params) {
		
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
		
		return '<label for="'.$params['id'].'">'.$label.'</label> <br/><input type="radio" name="'.$name.'" '.$checked.' '.$join_param.' /> Ya'.$invalid_message;
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
	public function element_Textarea($label="",$name="",$params=array(),$mode=array('label'=>2,'input'=>10)) {
		$d=array();
		$value='';
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
			
			if($attr_field=="value"){
				$value=$attr_value;
				continue;
			}
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$value=$this->get_value($name);
		$join_param=join(" ",$d);
		/*
		return '
		<label for="'.$params['id'].'">'.$label.'</label>
		<textarea name="'.$name.'" '.$join_param.'/>'.$value.'</textarea>
		'.$invalid_message;
		*/

		return '
		<label class="col-lg-'.$mode['label'].' col-form-label"  for="'.$params['id'].'">'.$label.'</label>
		<div class="col-lg-'.$mode['input'].'">
		<textarea name="'.$name.'" '.$join_param.'/>'.$value.'</textarea>'.$invalid_message.'
		</div>
		';
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
	
	public function element_Hidden($name,$value,$params) {
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(uniqid()):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'" ';
		}
		
		$join_param=join(" ",$d);
		return '<input type="hidden" name="'.$name.'" value="'.$value.'" '.$join_param.' />';
	}
	
}
//qload($code='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');



?>
