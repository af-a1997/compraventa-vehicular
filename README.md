> :warning: This project is only in Spanish for now, but I may add English language later as well. There are some code comments in English though.

# Sistema de compraventa de automóviles

Trabajo de conclusión de curso para concretar la carrera **[Informática para Internet]** ofrecida por el [Instituto Federal Sul-rio-grandense](http://www.ifsul.edu.br).

Se trata de un sitio web relativamente simple, proyectado para proveer servicios de compra y venta de vehículos de toda clase, con panel de administrador para gestionar artículos, categorías y tal.

La documentación se definirá aquí debido a que las wikis no están disponibles para repositorios privados de usuarios gratuitos.

## Modelo DDBB

![EER_sistema_automoviles.mwb.png](admin/ddbb/model/EER_sistema_automoviles.mwb.png?raw=true)

El modelo se encuentra en `/admin/ddbb/models/` tanto en imagen como archivo de modelo de [MySQL Workbench](https://www.mysql.com/products/workbench/).

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
   - [X] Detener contrato
   - [X] Editar
   - [X] Eliminar
 - [ ] Gestión de remises
   - [X] Listar
   - [ ] Agregar
   - [ ] Editar
   - [ ] Eliminar
 - [ ] Gestión de divisas
   - [X] Listar
   - [ ] Agregar
   - [ ] Editar
   - [ ] Eliminar
 - [ ] Gestión de marcas
   - [X] Listar
   - [X] Agregar
   - [ ] Editar
   - [ ] Eliminar
 - [ ] Gestión de categorías de vehículos
   - [X] Listar
   - [ ] Agregar
   - [ ] Editar
   - [ ] Eliminar
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
 - [ ] Gestión de contrato con cliente

## Configuración

1) Instala [XAMPP](https://www.apachefriends.org/download.html).
2) Corre el servidor Apache y el servicio MySQL.
3) Copia los archivos del proyecto al `htdocs` donde se encuentra, normalmente en `C:\xampp\htdocs`
4) Mediante PMA desde el navegador (accede a `http://localhost/phpmyadmin`) haz las importaciones de los archivos SQL en `/admin/ddbb/queries/`, en este órden:
    1) **`ddbb_fweng_creation_script.sql`**: crea la base de datos y su estructura.
    2) **`ddbb_sample_data_population.sql`**: agrega datos de muestra, ayuda a realizar pruebas.
    3) **`ddbb_users_creation.sql`**: crea los usuarios en el SGBD para cada rol en el sistema.
5) Accede a `http://localhost/` para visitar la sección del cliente, o `http://localhost/admin/` para visitar la sección del administrador.
6) Necesitarás credenciales de acceso para visitar la mayoría de los apartados en el sitio:
    * Administrador:
        * **Usuario:** `admin`
        * **Clave:** `12345678`
    * Cliente:
        * **Usuario:** `fulano`
        * **Clave:** `12345678`