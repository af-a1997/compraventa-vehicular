> :warning: This project is only in Spanish for now, but I may add English language later as well. There are some code comments in English though, because this should help you learn how to do certain stuff.

# Sistema de compraventa de automóviles

Trabajo de conclusión de curso para concretar la carrera **[Informática para Internet]** ofrecida por el [Instituto Federal Sul-rio-grandense](http://www.ifsul.edu.br).

Se trata de un sitio web relativamente simple, proyectado para proveer servicios de compra y venta de vehículos de toda clase, con panel de administrador para gestionar artículos, categorías y tal.

La documentación se definirá aquí debido a que las wikis no están disponibles para repositorios privados de usuarios gratuitos.

> :warning: Desplazarse hacia el final para instrucciones de uso y claves de acceso.

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
* **`imagenes_cat_venta`:** Contiene imagenes de los vehículos que están a la venta.
* **`seleccion_alquiler`:** Contiene una lista de vehículos disponibles para alquilar.
* **`historial_alquiler`:** Contiene una lista de vehículos previamente alquilados o con contrato activo.
* **`imagenes_cat_alq`:** Contiene imagenes de los vehículos que están para alquilar.
* **`usuarios`:** Contiene una lista de miembros del sitio, tanto administradores como clientes y remises.
* **`puesto`:** Contiene definiciones de roles de usuario en el sitio.

## Implementaciones de alta prioridad

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
 - [X] Gestión de remises
   - [X] Listar
   - [X] Agregar
   - [X] Editar
   - [X] Eliminar
 - [X] Gestión de contratos con remises
   - [X] Listar
   - [X] Detalles
   - [X] Detener activos
   - [X] Eliminar finalizados
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

### Cliente

> :arrow_right: **Nota:** transacciones serán simulaciones básicas.

 - [X] Sesiones
 - [X] Perfiles
   - [X] Ver perfiles de otros usuarios
   - [X] Editar perfil personal
 - [X] Base de datos de vehículos
   - [X] Búsqueda
   - [X] Detalles
   - [ ] Disponibilidad de venta/alquiler o contrato con remise.
 - [X] Artículos en venta
   - [X] Listar
   - [X] Detalles
   - [ ] Comprar
 - [ ] Vehículos para alquilar
   - [X] Listar
   - [X] Detalles
   - [ ] Alquilar

### Remises

 - [ ] Sesiones
 - [ ] Perfiles
   - [ ] Ver perfiles de otros usuarios
   - [ ] Editar perfil personal
 - [ ] Publicación/gestión de servicios
   - [ ] Publicar
   - [ ] Editar
   - [ ] Suspender
   - [ ] Eliminar
 - [ ] Gestión de contrato con cliente

## Otras implementaciones y ajustes de menor prioridad

> :orange_circle: Estas características no son tan urgentes de implementar, ya que se busca primero implementar las características clave del sitio, pero se plantea hacer varios añadidos y ajustes luego de implementar los elementos esenciales descritos en la sección anterior. No están en órden específico.

 - [ ] Auto-configuración de BBDD inicial.
 - [ ] Refinar sistema de alquileres, de tal modo que el estado de disponibilidad provenga de la tabla `registros`.
 - [ ] Manejar intento de eliminación de entradas que están siendo referenciadas en otras tablas.
   - [ ] Gatillos en base a determinados eventos, como puede ser el eliminar un artículo alquilable, lo que resulta en la eliminación de instancias de alquiler relacionadas.
 - [ ] Funcionalidades varias que puedan requerir de AJAX **(¡pero debo aprender primero!)**.
   - [ ] Búsqueda/órden de elementos en menús desplegables de formularios, como cuando se va a elegir una instancia de vehículo registrado.
   - [ ] Aparición de entradas nuevas en el panel de administrador sin tener que recargar el sitio.
 - [ ] Formato de precios usando símbolos y posición, como se ilustra en el gestor de divisas al agregar/editar una divisa.
 - [ ] Verificar partes con código repetido/reutilizable, y realizar ajustes en base a ello.
 - [ ] Suspensión/baneo de usuarios: es un impedimiento de acceso temporal o permanente, normalmente dado por conductas inapropiadas y/o en contra de los términos de uso del sistema.
 - [ ] Estandarizar nombrado de llaves de objetos utilizadas en consultas con cláusulas `JOIN`, esto significa que hay diferentes nombres para la misma información en diferentes clases; por ejemplo "bno" y "bna" para obtener la marca del vehículo en dos clases distintas. Esto va a reducir posibles confusiones y permitir reutilizar algo de código.
 - [ ] Añadir *tooltips* o "bocadillos", son cajas de texto que aparecen al mantener el ratón sobre un elemento para describir su funcionalidad (normalmente un botón/ícono).
 - [ ] Agregar distinción de nombre de usuario y/o clave incorrectos para ayudar al usuario/admin a identificar qué dato ingresó mal (al iniciar sesión).
 - [ ] Manejo de *cookies* para mantener sesión activa en el dispositivo **(¡pero debo aprender primero!)**.

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