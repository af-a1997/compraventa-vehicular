SELECT historial_alquiler.*, registros.matricula AS reg_lp, vehiculos.modelo AS veh_mod, vehiculos.anho_fab AS veh_yfb, marcas.nombre AS bnd_name, seleccion_alquiler.valor_diario_alq AS ren_cost, divisas.abr AS coin, usuarios.nro_id_u AS uid, usuarios.nombre_usuario AS uun

FROM historial_alquiler

INNER JOIN seleccion_alquiler ON historial_alquiler.id_veh_alquilado = seleccion_alquiler.id_art_alq
INNER JOIN registros ON seleccion_alquiler.id_reg_veh = registros.id_reg
INNER JOIN vehiculos ON registros.vehiculo_asociado = vehiculos.idno
INNER JOIN marcas ON vehiculos.marca = marcas.idno
INNER JOIN divisas ON seleccion_alquiler.id_divisa = divisas.id_moneda
INNER JOIN usuarios ON historial_alquiler.no_cli = usuarios.nro_id_u;