//AFND A AFD
function cout(frase){
	var r = document.getElementById("r");
	r.innerHTML = r.innerHTML + frase + "\n";
}
function str_arr_e(arr){
	frase = "";
	if(arr.length == 0)
		frase += "null";
	for(i in arr){
		frase += arr[i];
		if(i != arr.length-1)
			frase += ";";
	}
	return frase;
}
function str_arr(arr) {
	frase = "";
	if(arr.length == 0)
		frase += "null";
	for(i in arr){
		frase += "[" + arr[i] + "]";
		if(i != arr.length-1)
			frase += "\n";
	}
	return frase;
}
function combinaciones(arr_e){
	arr_r = [];
	arr_r.push("null");
	n = arr_e.length;
	for(i in arr_e){
		//cout("- iteracion i: " + i + " -------------------------");
		m = n-i;
		//cout("- m: " + m);
		if(i == 0){
			for(j in arr_e)
				arr_r.push(arr_e[j]);
		}else{
			cabecera = arr_e.slice(0,i);
			cuerpo = arr_e.slice(i,n);
			for(j = 0 ; j < m ; j++){
				//cout("-- cabecera: " + str_arr_e(cabecera));
				for(k in cuerpo){
					//cout("--- " + cuerpo[k]);
					arr_r.push(str_arr_e(cabecera) + ";" + cuerpo[k]);
				}
				cabecera.shift();
				cabecera.push(cuerpo.shift());
			}
		}
	}
	return arr_r;
}
/*
function arr_derivaciones(arr_c,arr_e,arr_d){
	arr_r = [];
	for(i in arr_c){
		cout("----- iteracion: [" + arr_c[i] + "]");
		arr_t = [];
		arr_t_1 = arr_c[i].split(";");
		for(j in arr_t_1){
			cout(" arr_t_1: " + arr_t_1[j]);
			//cout("indice: " + )
		}
	}
*/}