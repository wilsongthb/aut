<?php
function cout($frase){
    echo $frase . "\n";
}
function str_array($arr){
    $res = "";
    if(count($arr) == 0){
        $res .= "null";
    }
    for($i = 0 ; $i < count($arr) ; $i++){
        $res .= "[" . $arr[$i] . "]";
        /*
        if($i != count($arr)-1)
            $res .= ";";
        */
    }
    return $res;
}
function str_array_e($arr){
    $res = "";
    //cout("str_array_e " . count($arr));
    if(count($arr) == 0){
        $res .= "null";
    }
    for($i = 0 ; $i < count($arr) ; $i++){
        $res .= $arr[$i];
        if($i != count($arr)-1)
            $res .= ";";
    }
    return $res;
}
function concatenar_sin_repetidos($arr,$v){
    if($v != "null"){
        if(!in_array($v,$arr)){
            array_push($arr,$v);
        }
    }
    return $arr;
}
function combinaciones($estados/*,$derivaciones*/){
    $respuesta = [];
    //$respuesta[] = "null";
	$n = count($estados);
    for($i = 0 ; $i < $n ; $i++){
		//cout("- iteracion i: " . $i . " -------------------------");
		$m = $n-$i;
		if($i == 0){
			foreach ($estados as $estado) {
                //$respuesta[] = [$estado => $derivaciones[$estado]];
                $respuesta[] = $estado;
            }
		}else{
			$cabecera = array_slice($estados,0,$i);
			$cuerpo = array_slice($estados,$i,$n);
			for($j = 0 ; $j < $m ; $j++){
				//cout("-- cabecera: " + str_arr_e(cabecera));
				//for(k in cuerpo){
                foreach($cuerpo as $k){
					//cout("--- " + cuerpo[k]);
                    
                    $arr_e_c = $cabecera;
                    $arr_e_c[] = $k;


                    //cout("arr_e_c: " . str_array_e($arr_e_c));
                    /*
                    $derivaciones_combinado = [];
                    foreach ($derivaciones[0] as $entrada) {
                        cout("entrada: " . $entrada)
                        foreach ($arr_e_c as $estado) {
                            cout("combinando derivaciones");

                        }
                    }*/
                        

                    //$estado_combinado = str_array_e($cabecera) . ";" . $k;
                    //$respuesta[] = [$estado_combinado => $derivaciones_combinado];
                    $respuesta[] = str_array_e($arr_e_c);

                    //concatenar sin repeticiones

                    /*concatenacion simple/
                    foreach ($cabecera as $e) {
                        cout("estamos en " . $e);
                    }*/
				}
                array_shift($cabecera);
                //array_s
				//cabecera.push(cuerpo.shift());
                array_push($cabecera,array_shift($cuerpo));
			}
		}
	}
    return $respuesta;
}
function derivaciones($combinaciones,$derivaciones,$entradas){
    $arr_r = [];
    foreach($combinaciones as $combinacion){
        //cout("combinacion:" . $combinacion);
        $estados = explode(";",$combinacion);
        
        $arr_t_d_1 = [];
        foreach($entradas as $entrada){
            $arr_t_d_2 = [];
            //cout("  entrada: " . $entrada);
            foreach($estados as $estado){
                //cout("      estado: " . $estado);
                $arr_t_d_2 = concatenar_sin_repetidos($arr_t_d_2,$derivaciones[$estado][$entrada]);
            }
            //cout("          resultado de concatenacion: " . str_array_e($arr_t_d_2));
            $arr_t_d_1[] = str_array_e($arr_t_d_2);
        }
        //cout("  resultado de concatenacion: " . str_array($arr_t_d_1));
        //$arr_r[$combinacion] = $arr_t_d_1;
        //$arr_r[] = [$combinacion => $arr_t_d_1];
        $arr_r[] = $arr_t_d_1;
    }
    return $arr_r;    
}
function seleccion_de_derivaciones($combinaciones,$derivaciones_combinas){
    $arr_r = [];
    /*
    foreach ($derivaciones_combinas as $derivacion_combinada) {
        cout("derivacion combinada: " . str_array($derivacion_combinada));
        foreach ($derivacion_combinada as $derivacion) {
            cout("  combinacion de entrada: " . $derivacion);
            if(in_array($derivacion,$combinaciones)){
                array_push($arr_r,$derivacion_combinada);
            }
        }
    }*/
    $arr_r[] = [$combinaciones[0] => $derivaciones_combinas[0]];
    for($i=0;$i<count($combinaciones);$i++){
        //cout("derivacion combinada: " . str_array($derivaciones_combinas[$i]));
        foreach ($derivaciones_combinas[$i] as $derivacion) {
            //cout("  combinacion de entrada: " . $derivacion);
            $j = array_search($derivacion,$combinaciones);
            //cout("      combinacion encontrada: " . $j);
            if($j){
                $arr_t_1 = [$combinaciones[$j] => $derivaciones_combinas[$j]];
                if(!in_array($arr_t_1,$arr_r)){
                    $arr_r[] = $arr_t_1;
                }
            }
            /*
            if(in_array($derivacion,$combinaciones)){
                if(!in_array($derivaciones_combinas[$i],$arr_r))
                    array_push($arr_r,$derivaciones_combinas[$i]);
            }*/
        }
    }
    return $arr_r;
}
$afnd = array(
    "estados" => array(
        "q0",
        "q1",
        "q2",
        "q3"
    ),
    "entradas" => ["0","1"],
    "derivaciones" => array(
        "q0" => ["q1;q2","null"],
        "q1" => ["null","q3"],
        "q2" =>["null","null"],
        "q3" => ["null","null"]
    )
);
function afnd_afd($afnd){
    //cout("BUSCANDO COMBINACIONES DE RECORRIDO");
    $combinaciones = combinaciones($afnd["estados"]);
    //print_r($combinaciones);
    //cout("BUSCANDO NUEVOS ESTADOS DERIVADOS");
    $derivaciones = derivaciones($combinaciones,$afnd["derivaciones"],[0,1]);
    //print_r($derivaciones);
    //cout("SELECCIONANDO DERIVACIONES PARA CREAR EL AFD RESULTANTE");
    $afd = seleccion_de_derivaciones($combinaciones,$derivaciones);
    //print_r($afd);
    return $afd;
}
print_r(afnd_afd($afnd));
?>