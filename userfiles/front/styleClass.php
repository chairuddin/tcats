<?php
/*******************************************************************************
*
* © 2010 Copyright A-Vision / WebSoftware
*
* File description :       Color scheme creator
* 
* Created by       :       Arnold Velzel
* Created on       :       02/08/2010
*
* Last changed by  :       Arnold Velzel
* Last changed on  :       <LastChanged>
* 
*******************************************************************************/

class appColorScheme {

 function rgb2hsv( $rgb)
 {
  // RGB2HSV
  $r = $rgb[0];$g = $rgb[1];$b = $rgb[2];
  $max = max($rgb);
  $dif = $max-min($rgb);
  $sat = $max?(100*$dif/$max):0;
  if ( $sat==0) {
   $hue = 0;
  } else {
   if ( $r==$max) {
    $hue = 60.0*($g-$b)/$dif;
   } else {
    if ( $g==$max) {
     $hue = 120+60.0*($b-$r)/$dif;
    } else {
     if ( $b==$max) {
      $hue = 240+60.0*($r-$g)/$dif;
     } else {
      $hue = 0;
     }
    }
   }
  }
  if ( $hue<0) $hue += 360;
  $val = round($max*100/255,2);
  $hue = round( $hue,2);
  $sat = round( $sat,2);
 
  return( array($hue, $sat, $val));
 }
 function hsv2rgb( $hsv)
 {
  // HSV2RGB
  $hue = $hsv[0];$sat = $hsv[1];$val = $hsv[2];
 	if ($sat==0) {
   $r = $g = $b = $val*255/100;
 	} else {
 		$hue/=60;
 		$sat/=100;
 		$val/=100;
 		$i=floor($hue);
 		$f=$hue-$i;
 		$p=$val*(1-$sat);
 		$q=$val*(1-$sat*$f);
 		$t=$val*(1-$sat*(1-$f));
 		switch($i) {
  		case 0: $r=$val; $g=$t;   $b=$p; break;
  		case 1: $r=$q;   $g=$val; $b=$p; break;
  		case 2: $r=$p;   $g=$val; $b=$t; break;
  		case 3: $r=$p;   $g=$q;   $b=$val; break;
  		case 4: $r=$t;   $g=$p;   $b=$val; break;
  		default:$r=$val; $g=$p;   $b=$q;
 		}
 		$r=round($r*255);
 		$g=round($g*255);
 		$b=round($b*255);
 	}
 	return( array($r,$g,$b));
 }
 function hueShift( $hue, $shift)
 {
  $hue += $shift;
  while ($hue>=360.0) $hue-=360.0;
 	while ($hue<0.0) $hue+=360.0;
 	return $hue;
 }
 function dark( $c=0, $r=1)
 {
  return( $c*$r);
 }
 function light( $c=0, $r=1)
 {
  return( $c+(255-$c)*$r);
 }
 function colorScheme( $hexColor="#4488CC", $prefix="", $shift=0)
 {
  $hexColor = trim( $hexColor, " #");
  $multiplier = strlen($hexColor)==3?16:1;
  $r = $multiplier*hexdec( substr( $hexColor, 0, (strlen($hexColor)/3)));
  $g = $multiplier*hexdec( substr( $hexColor, (strlen($hexColor)/3), (strlen($hexColor)/3)));
  $b = $multiplier*hexdec( substr( $hexColor, 2*(strlen($hexColor)/3), (strlen($hexColor)/3)));

  if ( $shift) {
   $anahsv1 = $this->rgb2hsv( array( $r, $g, $b));
   $anahsv1[0] = $this->hueShift( $anahsv1[0], $shift);
   $rgb = $this->hsv2rgb( $anahsv1);
   $r = $rgb[0];
   $g = $rgb[1];
   $b = $rgb[2];
  } 

  $this->color["{$prefix}HSV"] = $this->rgb2hsv( array( $r, $g, $b));

  $this->color["{$prefix}baseVeryDark"] = sprintf("#%02X%02X%02X", $this->dark($r,0.3), $this->dark($g,0.3), $this->dark($b,0.3));
  $this->color["{$prefix}baseDark"] = sprintf("#%02X%02X%02X", $this->dark($r,0.6), $this->dark($g,0.6), $this->dark($b,0.6));
  $this->color["{$prefix}baseNormal"] = sprintf("#%02X%02X%02X", $r, $g, $b);
  $this->color["{$prefix}baseLight"] = sprintf("#%02X%02X%02X", $this->light($r,0.6), $this->light($g,0.6), $this->light($b,0.6));
  $this->color["{$prefix}baseVeryLight"] = sprintf("#%02X%02X%02X", $this->light($r,0.8), $this->light($g,0.8), $this->light($b,0.8));
  $this->color["{$prefix}baseVeryVeryLight"] = sprintf("#%02X%02X%02X", $this->light($r,0.9), $this->light($g,0.9), $this->light($b,0.9));
/*
  $this->color["{$prefix}baseVeryDark-sample"] = "<img src='16blank.gif' alt='' style='background:{$this->color["{$prefix}baseVeryDark"]};width:32px;height:16px;margin-right:2px;' />";
  $this->color["{$prefix}baseDark-sample"] = "<img src='16blank.gif' alt='' style='background:{$this->color["{$prefix}baseDark"]};width:32px;height:16px;margin-right:2px;' />";
  $this->color["{$prefix}baseNormal-sample"] = "<img src='16blank.gif' alt='' style='background:{$this->color["{$prefix}baseNormal"]};width:32px;height:16px;margin-right:2px;' />";
  $this->color["{$prefix}baseLight-sample"] = "<img src='16blank.gif' alt='' style='background:{$this->color["{$prefix}baseLight"]};width:32px;height:16px;margin-right:2px;' />";
  $this->color["{$prefix}baseVeryLight-sample"] = "<img src='16blank.gif' alt='' style='background:{$this->color["{$prefix}baseVeryLight"]};width:32px;height:16px;margin-right:2px;' />";
  $this->color["{$prefix}baseVeryVeryLight-sample"] = "<img src='16blank.gif' alt='' style='background:{$this->color["{$prefix}baseVeryVeryLight"]};width:32px;height:16px;margin-right:2px;' />";
*/
  if (( trim($prefix)=="") && ( $shift==0)) {
   $this->colorScheme( $hexColor, "30_", 30);
   $this->colorScheme( $hexColor, "-30_", -30);
   $this->colorScheme( $hexColor, "180_", 180);
   $this->colorScheme( $hexColor, "-90_", -90);
   $this->colorScheme( $hexColor, "90_", 90);
  }
 }

 function setColorScheme( $prefix="", $shift=0)
 {
  $this->colorScheme( $this->color["{$prefix}baseNormal"], "", $shift);
 }

 function appColorScheme( $baseColor="#6699cc", $prefix="", $shift=0)
 {
  $this->colorScheme( $baseColor, $prefix, $shift);
 }
 function calcBrightness($color) {
    $rgb = $this->hex2RGB($color);
    return sqrt(
       $rgb["red"] * $rgb["red"] * .299 +
       $rgb["green"] * $rgb["green"] * .587 +
       $rgb["blue"] * $rgb["blue"] * .114);          
  }
  function setForeColor($color,$color1="",$color2="",$debug=false)
  {
	  
	 $color1=$color1==""?"#FFFFFF":$color1;
	 $color2=$color2==""?"#000000":$color2;
	 $brightness=$this->calcBrightness($color);
	 if($debug){
		 die($brightness);
		 //$brightness < 130
	 }
	 $fore_color = ($brightness < 172) ? "$color1" : "$color2";
	 	
	 return $fore_color;
  }
  function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
      $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
      $rgbArray = array();
      if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
          $colorVal = hexdec($hexStr);
          $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
          $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
          $rgbArray['blue'] = 0xFF & $colorVal;
      } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
          $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
          $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
          $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
      } else {
          return false; //Invalid hex color code
      }
      return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
  }  
}

?>
