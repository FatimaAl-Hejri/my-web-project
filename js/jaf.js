function jaf(){
    let username=document.getElementById('username').Value;
    let password=document.getElementById('password').Value;
  
    if(username.tirm()===""){
        alert("يجب ادخال بيانات اسم المستخدم")
        isValid=false;
    }
else if(password.length<6){
    alert("خطا:يجب ان تكون كلمه المرور 6احرف على الاقل");
    isValid=false;
}
else{
    alert("تم التحقق بنجاح");
}
return isValid
}