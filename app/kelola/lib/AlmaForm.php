<?php

/*
 creator 	: Mohammad Romli
 email 		: roemly@gmail.com
 */

class AlmaForm {

	public $form_content=[];
	public $form_name='';
	public $form_param='';
	

	public function __construct($name) {
		$this->form_name=$name;
	}	
	
	public function configure($configure){
		$d=array();
		foreach($configure as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		$this->form_param=join(" ",$d);
	}
	public function display_row($row,$option_class) {
		return '<div class="form-group'.($option_class!=""?" $option_class":"").'">'.$row.'</div>';
	}
	public function render() {
		echo '<form name="'.$this->form_name.'" '.$this->form_param.'  enctype="multipart/form-data">';
		echo join("", $this->form_content);
		echo '</form>';
	}
	public function element_File($label,$name,$params,$option_class) {
		
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(count($this->form_content)+1):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$join_param=join(" ",$d);
		$this->form_content[]=$this->display_row('<label for="'.$params['id'].'">'.$label.'</label><input type="file" name="'.$name.'" '.$join_param.' />',$option_class);
	}	
	public function element_Textbox($label,$name,$params,$option_class) {
		
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(count($this->form_content)+1):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$join_param=join(" ",$d);
		$this->form_content[]=$this->display_row('<label for="'.$params['id'].'">'.$label.'</label><input type="text" name="'.$name.'" '.$join_param.' />',$option_class);
	}
	public function element_Numberbox($label,$name,$params,$option_class) {
		
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(count($this->form_content)+1):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$join_param=join(" ",$d);
		$this->form_content[]=$this->display_row('<label for="'.$params['id'].'">'.$label.'</label><input type="number" name="'.$name.'" '.$join_param.' />',$option_class);
	}
	public function element_Password($label,$name,$params,$option_class) {
		
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(count($this->form_content)+1):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'"';
		}
		
		$join_param=join(" ",$d);
		$this->form_content[]=$this->display_row('<label for="'.$params['id'].'">'.$label.'</label><input type="password" name="'.$name.'" '.$join_param.' />',$option_class);
	}
	public function element_Textarea($label,$name,$params,$option_class) {
		$d=array();
		$value='';
		$params['id']=!isset($params['id'])?'id'.(count($this->form_content)+1):$params['id'];
		foreach($params as $attr_field => $attr_value){
			
			if($attr_field=="value"){
				$value=$attr_value;
				continue;
			}
			$d[]=$attr_field.'="'.$attr_value.'"';
			}
		
		$join_param=join(" ",$d);
		$this->form_content[]=$this->display_row('<label for="'.$params['id'].'">'.$label.'</label><textarea name="'.$name.'" '.$join_param.' />'.$value.'</textarea>',$option_class);
	}
	public function element_Select($label,$name,$options,$params,$option_class){
		$d=array();
		$default_value='';
		$params['id']=!isset($params['id'])?'id'.(count($this->form_content)+1):$params['id'];
		foreach($params as $attr_field => $attr_value){
			
			if($attr_field=="value"){
				$default_value=$attr_value;
				continue;
			}
			$d[]=$attr_field.'="'.$attr_value.'"';
			
		}
		
		$join_param=join(" ",$d);
		
		$r_option=array();
		
		foreach($options as $value =>$text) {
			
			$selected=$default_value==$value?'selected="selected"':'';
			$r_option[]='<option value="'.$value.'" '.$selected.'>'.$text.'</option>';
		}
		
		$this->form_content[]=$this->display_row('<label for="'.$params['id'].'">'.$label.'</label><select name="'.$name.'" '.$join_param.' />'.join(' ',$r_option).'</select>',$option_class);
		
	}
	
	public function element_Checkbox($label,$name,$options,$params,$option_class){
		
		/*$this->form_content[]=<<<END
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
  <label class="form-check-label" for="defaultCheck1">
    Default checkbox
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
  <label class="form-check-label" for="defaultCheck2">
    Disabled checkbox
  </label>
END;
*/ 
//'<label for="'.$params['id'].'">'.$label.'</label><select name="'.$name.'" '.$join_param.' />'.join(' ',$r_option).'</select>
		
		$checkbox=array();
		foreach($options as $value => $text){
			$id='id'.count($this->form_content)+1;
			$checked=in_array($value,$params['value'])?'checked="checked"':'';
			$this->form_content[]='
			<div class="form-check '.$option_class.'" >
				<input class="form-check-input" name='.$name.' id="'.$id.'" '.$checked.' type="checkbox" value="'.$value .'" 
				<label class="form-check-label" for="'.$id.'">
				'.$text.'
				</label>
			</div>
			';
		}
		
		
	}
	public function element_Button($name,$params,$option_class) {
		$d=array();
		$default_value='';
		$default_text='';
		$params['id']=!isset($params['id'])?'id'.(count($this->form_content)+1):$params['id'];
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
		$this->form_content[]= $this->display_row('<label>&nbsp;</label><br/><button name="'.$name.'" value="'.$default_value.'" '.$join_param.' >'.$default_text.'</button>',$option_class);
	}
	
	public function element_Hidden($name,$value,$params) {
		$d=array();
		$params['id']=!isset($params['id'])?'id'.(count($this->form_content)+1):$params['id'];
		foreach($params as $attr_field => $attr_value){
			$d[]=$attr_field.'="'.$attr_value.'" ';
		}
		
		$join_param=join(" ",$d);
		$this->form_content[]='<input type="hidden" name="'.$name.'" value="'.$value.'" '.$join_param.' />';
	}
	public function element_HTML($html) {
		$this->form_content[]=$html;
	}
	
}
?>
