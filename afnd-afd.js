cout("----- CONVERTIDOR AFND A AFD -----");
cout("----- COMBINACIONES -----");
json_d = {
    "estados": ["q0","q1","q2","q3"],
    "entradas": ["0","1"],
    "derivaciones": [
        ["q1;q2","null"],
        ["null","q3"],
        ["null","null"],
        ["null","null"]
    ]
};

arr_combinaciones = combinaciones(json_d.estados);
/*
cout(str_arr(arr_combinaciones));
cout(arr_combinaciones.length);
cout("----- SELECCION DE ESTADOS -----");

arr_derivaciones(arr_combinaciones, json_d.estados, json_d.derivaciones);*/