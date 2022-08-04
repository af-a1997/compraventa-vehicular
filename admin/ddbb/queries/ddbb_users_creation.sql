/*
	The following query file creates users for testing purposes, as they're used server-side with PHP to interact with the database.
	
	It's still recommended to create one DDBB user for each user role in the main website for security reasons, to prevent that for instance, a client can explot admin benefits.
	
	It makes sense that admins can do whatever they want on the database, so they're granted all permissions on it.
*/

-- First, check if the users in the second section here exist, and if they do, remove them to re-create them.
DROP USER IF EXISTS "cmman_admin"@"localhost";
DROP USER IF EXISTS "cmman_cli"@"localhost";

-- Creates the administrator and client users with strong and secure passwords.
CREATE USER IF NOT EXISTS "cmman_admin"@"localhost" IDENTIFIED BY "#V!c2bMr69xo!8%A";
CREATE USER IF NOT EXISTS "cmman_cli"@"localhost" IDENTIFIED BY "t@*%k77Sx#!T9t93";

-- Grants varying permissions to both users, according to their roles.
GRANT ALL PRIVILEGES ON gestion_veh.* TO "cmman_admin"@"localhost";
GRANT SELECT, UPDATE, INSERT, DELETE ON gestion_veh.a_vender TO "cmman_cli"@"localhost";
GRANT SELECT, UPDATE, INSERT, DELETE ON gestion_veh.registros TO "cmman_cli"@"localhost";
GRANT SELECT ON gestion_veh.divisas TO "cmman_cli"@"localhost";
GRANT SELECT ON gestion_veh.historial_alquiler TO "cmman_cli"@"localhost";
GRANT SELECT ON gestion_veh.marcas TO "cmman_cli"@"localhost";
GRANT SELECT ON gestion_veh.reg_contrato_remises TO "cmman_cli"@"localhost";
GRANT SELECT ON gestion_veh.remises TO "cmman_cli"@"localhost";
GRANT SELECT ON gestion_veh.seleccion_alquiler TO "cmman_cli"@"localhost";
GRANT SELECT ON gestion_veh.tipo_veh TO "cmman_cli"@"localhost";
GRANT SELECT ON gestion_veh.usuarios TO "cmman_cli"@"localhost";
GRANT SELECT ON gestion_veh.vehiculos TO "cmman_cli"@"localhost";