-- This query file only inserts example records for testing purposes, the table and database creation query file must be run first before they can be populated.

USE gestion_veh;

INSERT INTO tipo_veh(nombre,descripcion) VALUES
	("Automóvil","Auto normal."),
    ("Camioneta","Auto grande."),
    ("Camión","Vehículo enorme de carga profesional/mediana."),
    ("Moto","Una bici a chorro.")
;

INSERT INTO marcas(nombre,descripcion) VALUES
	("Alfa Romeo","N/A"),
	("ASIA","N/A"),
	("Audi","N/A"),
	("BMW","N/A"),
	("Chevrolet","N/A"),
	("Chery","N/A"),
	("Citroën","N/A"),
	("Fiat","N/A"),
	("Ford","N/A"),
	("Honda","N/A"),
	("Hyundai","N/A"),
	("Jeep","N/A"),
	("Kia","N/A"),
	("Mercedes-Benz","N/A"),
	("Mini","N/A"),
	("Nissan","N/A"),
	("Renault","N/A"),
	("Scania","N/A"),
	("Suzuki","N/A"),
	("Toyota","N/A"),
	("Volkswagen","N/A"),
	("Volvo","N/A")
;

INSERT INTO divisas(nombre,abr,simbolizacion,pos_sim) VALUES
	("Dólar Estadounidense","USD","$",0),
	("Peso Uruguayo","UYU","$U",1),
	("Real Brasileño","BRL","R$",1),
	("Euro","EUR","€",0)
;

 -- Sample from: https://auto.mercadolibre.com.uy/MLU-613038325-bmw-x3-2013-30-x3-xdrive-35i-executive-306cv-_JM (BMW X3)
INSERT INTO vehiculos(modelo,unidades,anho_fab,puertas,transmision,combustible_tipo,combustible_capac,motor,marca,categorizacion) VALUES
	("X3",1,2013,5,"Automática","Nafta",67.0,"3.0",4,1)
;
	
INSERT INTO registros(color,ultima_act_info,matricula,estado_act,kilometraje_act,vehiculo_asociado) VALUES
	("#7D8F9B","2022-07-03 01:05:00","SBS1474","Impecable, muy cuidada.",262000.0,1)
;

 -- 28300 USD
INSERT INTO adquisiciones(tiempo,precio,estado_adq,kilometraje_adq,divisa_precio,id_del_adquirido) VALUES
	("2022-06-29 14:34:20",28300.0,"Impecable, muy cuidada.",262000.0,1,1)
;

INSERT INTO puesto(nombre,descripcion) VALUES
	("Administrador","Gestiona el sitio."),
	("Cliente","Potenciales compradores/vendedores.")
;

INSERT INTO usuarios(nombre,apellidos,nombre_usuario,clave,cedula_identidad,email,residencia_actual,tel_cel,tel_fijo,momento_registro,cargo_en_sitio) VALUES
	("Administrador","Principal","admin","12345678",01234567,"hola@example.com","Placeholder","000000000","00000000",NOW(),1),
	("Un tal","Fulano","fulano","12345678",12345678,"hola2@example.com","Placeholder","000000000","00000000",NOW(),2)
;

INSERT INTO seleccion_alquiler(id_reg_veh, id_divisa, valor_diario_alq, disponibilidad) VALUES (1,2,1200,1);
INSERT INTO historial_alquiler(momento_alquilado, momento_devolucion, estado_alquiler, id_veh_alquilado, no_cli) VALUES
	("2022-07-01 00:00:00",NOW(),2,1,1)
;