-- This query file only inserts example records for testing purposes, the table and database creation query file must be run first before they can be populated.

USE gestion_veh;

-- Empties tables and reset their auto increment values to assist with testing.
DELETE FROM adquisiciones;
DELETE FROM remises;
DELETE FROM historial_alquiler;
DELETE FROM seleccion_alquiler;
DELETE FROM a_vender;
DELETE FROM divisas;
DELETE FROM registros;
DELETE FROM usuarios;
DELETE FROM puesto;
DELETE FROM vehiculos;
DELETE FROM tipo_veh;
DELETE FROM marcas;

ALTER TABLE a_vender AUTO_INCREMENT = 1;
ALTER TABLE adquisiciones AUTO_INCREMENT = 1;
ALTER TABLE divisas AUTO_INCREMENT = 1;
ALTER TABLE historial_alquiler AUTO_INCREMENT = 1;
ALTER TABLE marcas AUTO_INCREMENT = 1;
ALTER TABLE puesto AUTO_INCREMENT = 1;
ALTER TABLE registros AUTO_INCREMENT = 1;
ALTER TABLE remises AUTO_INCREMENT = 1;
ALTER TABLE seleccion_alquiler AUTO_INCREMENT = 1;
ALTER TABLE tipo_veh AUTO_INCREMENT = 1;
ALTER TABLE usuarios AUTO_INCREMENT = 1;
ALTER TABLE vehiculos AUTO_INCREMENT = 1;

INSERT INTO tipo_veh(nombre,icono_fa,descripcion) VALUES
	("Automóvil","fa-car","Auto normal."),
    ("Camioneta","fa-van-shuttle","Auto grande."),
    ("Camión","fa-truck","Vehículo enorme de carga profesional/mediana."),
    ("Moto","fa-motorcycle","Una bici a chorro.")
;

-- Notice: descriptions and logos obtained from Wikipedia (EN), just for the sake of illustration and testing.
INSERT INTO marcas(nombre,descripcion,url_img) VALUES
	("Alfa Romeo","Alfa Romeo Automobiles S.p.A. (Italian: [ˈalfa roˈmɛːo]) is an Italian luxury car manufacturer and a subsidiary of Stellantis. The company was founded on 24 June 1910, in Milan, Italy. 'Alfa' is an acronym of its founding name, 'Anonima Lombarda Fabbrica Automobili.' 'Anonima' means 'anonymous', which was a legal form of company at the time, as it was founded by anonymous investors.","Alfa_Romeo_logo.png"),
	("ASIA","Asia Motors Industries, traded as Asia Motors (Korean: 아시아자동차, IPA: [aɕʰia dʑadoŋtɕʰa]), was a South Korean car manufacturer established in 1965 and closed in 1999. From 1976 onwards, it was a subsidiary of Kia Motors.","Asia_Motors_Logo.svg"),
	("Audi","Audi AG (German: [ˈaʊ̯di ʔaːˈɡeː]), commonly referred to as Audi, is a German automotive manufacturer of luxury vehicles headquartered in Ingolstadt, Bavaria, Germany. As a subsidiary of its parent company, the Volkswagen Group, Audi produces vehicles in nine production facilities worldwide.","Audi-Logo_2016.svg"),
	("BMW","Bayerische Motoren Werke AG, commonly referred to as BMW (German pronunciation: [ˌbeːʔɛmˈveː]), is a German multinational manufacturer of luxury vehicles and motorcycles headquartered in Munich, Bavaria, Germany. The corporation was founded in 1916 as a manufacturer of aircraft engines, which it produced from 1917 until 1918 and again from 1933 to 1945.","BMW_logo_(gray).svg"),
	("Changan","Chang'an Automobile Co., Ltd. is a Chinese state-owned automobile manufacturer headquartered in Jiangbei, Chongqing. Founded in 1862, it is currently the fourth largest of the “Big Four” state-owned car manufacturers of China, namely: SAIC Motor, FAW Group, Dongfeng Motor Corporation, and Changan Automobile, with car sales of 5.37 million, 3.50 million, 3.28 million and 2.30 million in 2021 respectively.","Changan_Automobile_Logo.svg"),
	("Chevrolet","Chevrolet (/ˌʃɛvrəˈleɪ/ SHEV-rə-LAY), colloquially referred to as Chevy and formally the Chevrolet Motor Division of General Motors Company, is an American automobile division of the American manufacturer General Motors (GM). Louis Chevrolet (1878–1941) and ousted General Motors founder William C. Durant (1861–1947) started the company on November 3, 1911 as the Chevrolet Motor Car Company.","Chevrolet_(logo).svg"),
	("Chery Automobile","Chery Automobile Co. Ltd., trading as Chery and sometimes known by the pinyin transcription of its Chinese name, Qirui (奇瑞), is a Chinese state-owned automobile manufacturer headquartered in Wuhu, Anhui, China. Founded in 1997, it is currently the ninth largest automobile manufacturer in China, with 0.959 million sales in 2021.","Chery_logo.png"),
	("Citroën","Citroën (French pronunciation: ​[sitʁɔɛn]) is a French automobile brand. The 'Automobiles Citroën' manufacturing company was founded in March 1919 by André Citroën. Citroën is owned by Stellantis since 2021 and previously was part of the PSA Group after Peugeot acquired 89.95% share in 1976.","Citroën_2021.svg"),
	("Daihatsu","Daihatsu Motor Co., Ltd. (ダイハツ工業株式会社, Daihatsu Kōgyō Kabushiki-gaisha), commonly known as Daihatsu, is a Japanese automobile manufacturer and one of the oldest surviving Japanese internal combustion engine manufacturers. The company's headquarters are located in Ikeda, Osaka Prefecture.","Daihatsu_motor_co_logo.png"),
	("DFM","Dongfeng Motor Corporation Ltd. is a Chinese state-owned automobile manufacturer headquartered in Wuhan, Hubei. Founded in 1969, it is currently the third largest of the &quot;Big Four&quot; state-owned car manufacturers of China, namely: SAIC Motor, FAW Group, Dongfeng Motor Corporation, and Changan Automobile, with car sales of 5.37 million, 3.50 million, 3.28 million and 2.30 million in 2021 respectively.","DFM_logo.png"),
	("FAW","FAW Group Co., Ltd. (First Automobile Works) is a Chinese state-owned automobile manufacturer headquartered in Changchun, Jilin. Founded in 1953, it is currently the second largest of the “Big Four” state-owned car manufacturers of China, together with SAIC Motor, Dongfeng Motor Corporation and Changan Automobile.","Faw-group-logo.png"),
	("Fiat","Fiat Automobiles S.p.A. (UK: /ˈfiːət, -æt/, US: /-ɑːt/, Italian: [ˈfiːat]; originally FIAT, Italian: Fabbrica Italiana Automobili di Torino, lit. 'Italian Automobiles Factory, Turin') is an Italian automobile manufacturer, formerly part of Fiat Chrysler Automobiles, and since 2021 a subsidiary of Stellantis through its Italian division Stellantis Italy. Fiat Automobiles was formed in January 2007 when Fiat S.p.A. reorganized its automobile business, and traces its history back to 1899 when the first Fiat automobile, the Fiat 4 HP, was produced.","Fiat_logo_1968.svg"),
	("Ford","Ford Motor Company (commonly known as Ford) is an American multinational automobile manufacturer headquartered in Dearborn, Michigan, United States. It was founded by Henry Ford and incorporated on June 16, 1903. The company sells automobiles and commercial vehicles under the Ford brand, and luxury cars under its Lincoln luxury brand.","Ford_logo_flat.svg"),
	("Geely","Zhejiang Geely Holding Group Co., Ltd (ZGH), commonly known as Geely, is a Chinese multinational automotive company headquartered in Hangzhou, Zhejiang. The company is privately held by Chinese billionaire business magnate Li Shufu. It was established in 1986 and entered the automotive industry in 1997 with its Geely Auto subsidiary. Geely Auto is currently the seventh largest automobile manufacturer in China, with 1.328 million sales in 2021.","Geely_Logo_2022.svg"),
	("Honda","Honda Motor Co., Ltd. (Japanese: 本田技研工業株式会社, Hepburn: Honda Giken Kōgyō KK, IPA: [honda]; /ˈhɒndə/; commonly known as Honda) is a Japanese public multinational conglomerate manufacturer of automobiles, motorcycles, and power equipment, headquartered in Minato, Tokyo, Japan.","Honda-logo.svg"),
	("Hyundai","Hyundai Motor Company, often abbreviated to Hyundai Motors (Korean: 현대자동차; Hanja: 現代自動車; RR: Hyeondae Jadongcha listen) and commonly known as Hyundai (Korean: 현대; Hanja: 現代; RR: Hyeondae, IPA: [ˈhjəːndɛ];[a] lit. 'modernity'), is a South Korean multinational automotive manufacturer headquartered in Seoul, South Korea.","Hyundai_Motor_Company_logo.svg"),
	("Jeep","Jeep is an American automobile marque, now owned by multi-national corporation Stellantis. Jeep has been part of Chrysler since 1987, when Chrysler acquired the Jeep brand, along with remaining assets, from its previous owner American Motors Corporation (AMC).","Jeep_wordmark.svg"),
	("Kia","Kia Corporation, commonly known as Kia (Korean: 기아; Hanja: 起亞; RR: Gia; MR: Kia, IPA: [ki.a]; formerly known as Kyungsung Precision Industry and Kia Motors Corporation), is a South Korean multinational automobile manufacturer headquartered in Seoul, South Korea. It is South Korea's second largest automobile manufacturer, after its parent company, Hyundai Motor Company, with sales of over 2.8 million vehicles in 2019.","KIA_logo2.svg"),
	("Mercedes-Benz","Mercedes-Benz (German pronunciation: [mɛɐ̯ˈtseːdəsˌbɛnts, -dɛs-]), commonly referred to as Mercedes and sometimes as Benz, is a German luxury and commercial vehicle automotive brand established in 1926.","Mercedes-Benz_free_logo.svg"),
	("Mini","Mini (stylised as MINI) is a British automotive marque founded in 1969, owned by German automotive company BMW since 2000, and used by them for a range of small cars assembled in England and Holland. The word Mini has been used in car model names since 1959, and in 1969 it became a marque in its own right when the name &quot;Mini&quot; replaced the separate &quot;Austin Mini&quot; and &quot;Morris Mini&quot; car model names. BMW acquired the marque in 1994 when it bought Rover Group (formerly British Leyland), which owned Mini, among other brands.","MINI logo.svg"),
	("Mitsubishi","The Mitsubishi Group (三菱グループ, Mitsubishi Gurūpu, informally known as the Mitsubishi Keiretsu) is a group of autonomous Japanese multinational companies in a variety of industries.","Mitsubishi_logo.svg"),
	("Nissan","Nissan Motor Co., Ltd. (Japanese: 日産自動車株式会社, Hepburn: Nissan Jidōsha kabushiki gaisha) (trading as Nissan Motor Corporation and often shortened to Nissan)[a] is a Japanese multinational automobile manufacturer headquartered in Nishi-ku, Yokohama, Japan.","Nissan_logo.svg"),
	("Opel","Opel Automobile GmbH (German pronunciation: [ˈoːpl̩]), usually shortened to Opel, is a German automobile manufacturer which has been a subsidiary of Stellantis since 16 January 2021. It was owned by the American automaker General Motors from 1929 until 2017 and the PSA Group, a predecessor of Stellantis, from 2017 until 2021. Opel vehicles are sold in the United Kingdom as Vauxhall. Some Opel vehicles were badge-engineered in Australia under the Holden brand until 2020 and in North America and China under the Buick, Saturn, and Cadillac brands.","Opel_logo_2020.svg"),
	("Peugeot","Peugeot (UK: /ˈpɜːʒoʊ/, US: /p(j)uːˈʒoʊ/, French: [pøʒo]) is a French brand of automobiles owned by Stellantis.","Peugeot-logo.svg"),
	("Renault","Groupe Renault (UK: /ˈrɛnoʊ/ REN-oh, US: /rəˈnɔːlt, rəˈnoʊ/ rə-NAWLT, rə-NOH, French: [ɡʁup ʁəno], also known as the Renault Group in English; legally Renault S.A.) is a French multinational automobile manufacturer established in 1899. The company produces a range of cars and vans, and in the past has manufactured trucks, tractors, tanks, buses/coaches, aircraft and aircraft engines and autorail vehicles.","Renault_2009_logo.svg"),
	("Scania","Scania AB is a major Swedish manufacturer headquartered in Södertälje, focusing on commercial vehicles—specifically heavy lorries, trucks and buses. It also manufactures diesel engines for heavy vehicles as well as marine and general industrial applications.","Scania_Logo.svg"),
	("Suzuki","Suzuki Motor Corporation (Japanese: スズキ株式会社, Hepburn: Suzuki Kabushiki-Gaisha) is a Japanese multinational corporation headquartered in Minami-ku, Hamamatsu, Japan.","Suzuki_Motor_Corporation_logo.svg"),
	("Toyota","Toyota Motor Corporation (Japanese: トヨタ自動車株式会社, Hepburn: Toyota Jidōsha kabushikigaisha, IPA: [toꜜjota], English: /tɔɪˈjoʊtə/, commonly known as simply Toyota) is a Japanese multinational automotive manufacturer headquartered in Toyota City, Aichi, Japan. It was founded by Kiichiro Toyoda and incorporated on August 28, 1937. Toyota is one of the largest automobile manufacturers in the world, producing about 10 million vehicles per year.","Toyota_carlogo.svg"),
	("Volkswagen","Volkswagen (German: [ˈfɔlksˌvaːɡn̩]; shortened to VW [faʊˈveː]) is a German motor vehicle manufacturer headquartered in Wolfsburg, Lower Saxony, Germany. Founded in 1937 by the German Labour Front, known for their iconic Beetle, it is the flagship brand of the Volkswagen Group, the largest car maker by worldwide sales in 2016 and 2017.","Volkswagen_logo_2019.svg"),
	("Volvo","Volvo Cars (Swedish: Volvo personvagnar; stylized as VOLVO) is a Swedish multinational manufacturer of luxury vehicles headquartered in Torslanda, Gothenburg. The company manufactures SUVs, station wagons, and sedans. The company's main marketing arguments are safety and its Swedish heritage and design.","Volvo-Iron-Mark-Black.svg")
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
	("Administrador","Principal","admin","12345678","0.123.456-7","hola@example.com","Placeholder","000000000","00000000",NOW(),1),
	("Un tal","Fulano","fulano","12345678","1.234.567-8","hola2@example.com","Placeholder","000000000","00000000",NOW(),2)
;

INSERT INTO seleccion_alquiler(id_reg_veh, id_divisa, valor_diario_alq, disponibilidad) VALUES
	(1,2,1200,1)
;

INSERT INTO historial_alquiler(momento_alquilado, momento_devolucion, estado_alquiler, id_veh_alquilado, no_cli) VALUES
	("2022-07-01 00:00:00",NOW(),1,1,1)
;

INSERT INTO remises(nombres,apellidos,cedula_identidad,tel_cel,tel_fijo,email,ubicacion_residencia,costo_d,costo_espera_h,divisa_precio,id_reg_veh) VALUES
	("Testing", "Tester", "7.654.321-0", "500", "300", "hello3@example.com","Placeholder",1000,50,2,1)
;