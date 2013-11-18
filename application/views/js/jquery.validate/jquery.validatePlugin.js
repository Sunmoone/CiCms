//手机号码验证
jQuery.validator.addMethod("ismobile", function(value, element) {
     var length = value.length;   
     var mobile = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;   
     return (length == 11 && mobile.exec(value))? true:false;
 }, "请正确填写您的手机号码");

//邮编验证
 jQuery.validator.addMethod("isZipCode", function(value, element) {       
     var tel = /^[0-9]{6}$/;       
     return (tel.exec(value))?true:false;       
 }, "请正确填写您的邮编");