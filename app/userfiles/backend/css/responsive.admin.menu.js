$(document).ready(function() {
	var _openedMenu=""
	//responsive menu icon click//
	$("#responsive-menu").click(function(){
		$("#responsive-admin-menu #menu").slideToggle()
	})
	//responsive menu icon click//
	
	//responsive remove style
	$(window).resize(function(){
		$("#responsive-admin-menu #menu").removeAttr("style")
	})
	//responsive remove style
	
	
	//sub menu open / close	
	$("#menu a.submenu").click(function(){
		if(_openedMenu!=""){	$("#" + _openedMenu).prev("a").removeClass("downarrow");$("#" + _openedMenu).slideUp("fast");}
		if(_openedMenu==$(this).attr("name")){
			$("#" + $(this).attr("name")).slideUp("fast")
	        $(this).removeClass("downarrow")
	        _openedMenu=""
		}else{		
			$("#" + $(this).attr("name")).slideDown("fast")
			_openedMenu=$(this).attr("name")
	        $(this).addClass("downarrow")
		}
		return false;
	})
	//sub menu open / close
	
});
