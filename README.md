> :warning: This project is only in Spanish for now, but I may add English language later as well. There are some code comments in English though.

# Sistema de compraventa de automóviles

Trabajo de conclusión de curso para concretar la carrera **[Informática para Internet]** ofrecida por el [Instituto Federal Sul-rio-grandense](http://www.ifsul.edu.br).

Se trata de un sitio web relativamente simple, proyectado para proveer servicios de compra y venta de vehículos de toda clase, con panel de administrador para gestionar artículos, categorías y tal.

La documentación se definirá aquí debido a que las wikis no están disponibles para repositorios privados de usuarios gratuitos.

## Modelo BBDD

![EER_sistema_automoviles.mwb.png](admin/ddbb/model/EER_sistema_automoviles.mwb.png?raw=true)

El modelo se encuentra en `/admin/ddbb/models/` tanto en imagen como archivo de modelo de [MySQL Workbench](https://www.mysql.com/products/workbench/), el mismo describe de manera gráfica como se estructura la base de datos y las conexiones entre cada tabla.

### Explicación de tablas

* **`vehiculos`:** Contiene el listado de vehículos existentes con sus propiedades comunes como marca y modelo, NO son instancias únicas con matrícula y color.
* **`tipo_veh`:** Contiene una lista de tipos/categorías de vehículo, tales como automóviles y camiones.
* **`marcas`:** Contiene fabricantes de vehículos con sus descripciones y nombres de archivos a imagenes de sus logotipos en el servidor.
* **`registros`:** Contiene instancias únicas de vehículos, con propiedades únicas como matrícula y color.
* **`adquisiciones`:** Contiene un historial de compras de vehículos realizadas por la empresa.
* **`divisas`:** Contiene las diferentes monedas utilizadas en el mundo.
* **`remises`:** Contiene una lista de remiseros, son propietarios de vehículos alquilables, se les contrata para manejar por tí.
* **`reg_contrato_remise`:** Contiene una lista de remises previamente contratados o con contrato activo.
* **`imagenes_cat_remise`:** Contiene imagenes de los vehículos que poseen los remiseros.
* **`a_vender`:** Contiene una lista de vehículos disponibles para vender.
* **`ventas`:** Contiene una lista de compras ya realizadas.
* **`seleccion_alquiler`:** Contiene una lista de vehículos disponibles para alquilar.
* **`historial_alquiler`:** Contiene una lista de vehículos previamente alquilados o con contrato activo.
* **`usuarios`:** Contiene una lista de miembros del sitio, tanto administradores como clientes y remises.
* **`puesto`:** Contiene definiciones de roles de usuario en el sitio.

## Implementaciones

> :warning: No finalizado

### Administrador

 - [X] Sesión de administrador
 - [X] Gestión de vehículos
   - [X] Listar
   - [X] Agregar
   - [X] Detalles
   - [X] Editar
   - [X] Eliminar
 - [X] Gestión de registros: instancias de vehículos únicas que tienen propiedades variables como color y matrícula.
   - [X] Listar
   - [X] Agregar
   - [X] Detalles
   - [X] Editar
   - [X] Eliminar
 - [X] Gestión de clientes
   - [X] Listar
   - [X] Agregar
   - [X] Detalles
   - [X] Editar
   - [X] Eliminar
 - [X] Gestión de artículos
   - [X] Listar
   - [X] Detalles
   - [X] Editar
   - [X] Eliminar
 - [X] Gestión de alquilables: vehículos disponibles para alquiler.
   - [X] Listar
   - [X] Detalles
   - [X] Editar
   - [X] Eliminar
 - [X] Gestión de alquileres: vehículos previamente alquilados o actualmento alquilados y posiblemente en uso.
   - [X] Listar
   - [X] Detalles
   - [X] :arrow_right: Editar: cabe mencionar que aquí se alterna el estado de contrato, y en base a eso se establece si la instancia de alquiler puede borrarse o no.
   - [X] Eliminar
   - [X] Verificar estado de contrato
 - [ ] Gestión de remises
   - [X] Listar
   - [ ] Agregar
   - [ ] Editar
   - [ ] Eliminar
 - [X] Gestión de divisas
   - [X] Listar
   - [X] Detalles
   - [X] Agregar
   - [X] Editar
   - [X] Eliminar
 - [X] Gestión de marcas
   - [X] Listar
   - [X] Detalles
   - [X] Agregar
   - [X] Editar
   - [X] Eliminar
 - [X] Gestión de categorías de vehículos
   - [X] Listar
   - [X] Detalles
   - [X] Agregar
   - [X] Editar
   - [X] Eliminar
 - [ ] Auto-configuración de BBDD inicial

### Cliente

 - [ ] Sesiones
 - [ ] Gestión de perfil
 - [ ] Ver perfiles de otros usuarios
 - [X] Base de datos de vehículos
   - [X] Búsqueda
   - [X] Detalles
   - [ ] Disponibilidad de venta/alquiler o contrato con remise.
 - [ ] Artículos en venta
   - [X] Listar
   - [X] Detalles
   - [ ] Comprar
 - [ ] Vehículos para alquilar
   - [X] Listar
   - [X] Detalles
   - [ ] Alquilar

### Remises

 - [ ] Sesiones
 - [ ] Gestión de perfil
 - [ ] Publicación de servicios
   - [ ] Editar
   - [ ] Suspender
   - [ ] Eliminar
 - [ ] Gestión de contrato con cliente

## Configuración

1) Instala y ejecuta [XAMPP](https://www.apachefriends.org/download.html).
2) Corre el servidor Apache y el servicio MySQL.
3) Copia los archivos del proyecto al `htdocs` donde se encuentra, normalmente en `C:\xampp\htdocs`
4) Mediante PMA desde el navegador (accede a `http://localhost/phpmyadmin`) haz las importaciones de los archivos SQL en `/admin/ddbb/queries/`, en este órden:
    1) **`ddbb_fweng_creation_script.sql`:** crea la base de datos y su estructura.
    2) **`ddbb_sample_data_population.sql`:** agrega datos de muestra, ayuda a realizar pruebas.
    3) **`ddbb_users_creation.sql`:** crea los usuarios en el SGBD para cada rol en el sistema.
5) Desde cualquier navegador, accede a `http://localhost/` para visitar la sección del cliente, o `http://localhost/admin/` para visitar la sección del administrador.
6) Necesitarás credenciales de acceso para visitar la mayoría de los apartados en el sitio, según si visitas el lado del cliente o del administrado:
    * Cliente:
        * **Usuario:** `fulano`
        * **Clave:** `12345678`
    * Administrador:
        * **Usuario:** `admin`
        * **Clave:** `12345678`

> :warning: **Nota:** sesiones de cliente no funcionan.