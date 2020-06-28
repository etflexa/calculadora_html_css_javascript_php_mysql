function insert(num){
	document.form.conta.value= document.form.conta.value+num
}

function equal(){
	var exp = document.form.conta.value;
	if(exp){
		document.form.conta.value=eval(exp);
	}
}

function clean(){
	document.form.conta.value ="";
}

function back(){
	var exp = document.form.conta.value;
	document.form.conta.value=exp.substring(0,exp.length-1);
}