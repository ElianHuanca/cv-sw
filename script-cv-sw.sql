CREATE EXTENSION IF NOT EXISTS pgcrypto;
CREATE EXTENSION IF NOT EXISTS plpgsql;
-- Database: cv-sw

-- DROP DATABASE IF EXISTS "cv-sw";

CREATE DATABASE "cv-sw"
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'Spanish_Bolivia.1252'
    LC_CTYPE = 'Spanish_Bolivia.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;
	

CREATE TABLE empresas(
	id serial PRIMARY KEY,
	razon varchar(200),
	tipo varchar(50)
);

CREATE TABLE sucursales(
	id serial PRIMARY KEY,
	direccion varchar(255),
	ciudad varchar(50),
	latitud float,
	longitud float,
	idempresa INT REFERENCES empresas(id)
);

ALTER TABLE users
ADD COLUMN idempresa integer REFERENCES empresas(id);
ALTER TABLE users
ADD COLUMN rol varchar(50);
ALTER TABLE users
ADD COLUMN url TEXT;
ALTER TABLE users
ADD COLUMN pathcv TEXT;
ALTER TABLE users
ADD COLUMN textcv TEXT;
ALTER TABLE users
ADD COLUMN celular VARCHAR(8);

create table areas(
	id serial PRIMARY KEY,
	nombre varchar(100)
);

insert into areas (nombre) values ('Ingenieria'), 
('Tecnologia De La Informacion'),
('Finanzas y Contabilidad'),
('Ventas y Marketing'),
('Manufactura y Produccion'),
('Logistica y Transporte');

CREATE TABLE trabajos(
	id serial PRIMARY KEY,	
	cargo VARCHAR(100),
	--descripcion TEXT,
	responsabilidades TEXT[],
	requisitos TEXT[],
	salario FLOAT,
	vacancia INT,
	fecha DATE DEFAULT CURRENT_DATE,
	fechafin DATE,
	estado BOOLEAN DEFAULT true,
	--categoria VARCHAR(50),
	iduser INT REFERENCES users(id),
	idsucursal INT REFERENCES sucursales(id),
	idarea INT references areas(id)
);

CREATE TABLE postulaciones(
	id serial PRIMARY KEY,
	idtrabajo INT REFERENCES trabajos(id),
	iduser INT REFERENCES users(id),
	motivo TEXT,
	estado BOOLEAN
);

CREATE TABLE entrevistas(
	id serial PRIMARY KEY,
	iduser INT REFERENCES users(id),
	idpostulacion INT REFERENCES postulaciones(id),
	fecha DATE,
	hora TIME,
	resultado text,
	estado boolean
);



INSERT INTO empresas (razon, tipo) VALUES ('Embol', 'Grande');

INSERT INTO sucursales (direccion, ciudad,idempresa,latitud,longitud) VALUES
('Planta Parque Industrial Mz PI-6','Santa Cruz', 1,-17.7693129,-63.1491619),
('Oficina Central Av. Cristo Redentor #1500','Santa Cruz', 1,-17.7654058,-63.1870018),
('Oficina Comercial Parque Industrial Mz. PI-27','Santa Cruz', 1,-17.7640142,-63.1491083),
('Oficina Las Torres Avenida Arce # 2519 Edificio Torres del Poeta Torre B Piso 15','La Paz', 1,-16.5095557,-68.1621332),
('Planta Rio Seco Carretera Panamericana ex tranca Rio Seco','La Paz',1,-16.4883534,-68.2910229),
('Oficina Circunvalación Av. Circunvalación # 1993 (entre A.Quijarro y J.Rosales)','Cochabamba',1,-17.369383,-66.145404),
('Planta Piñami Av. Blanco Galindo Km10 (Z.Piñami)','Cochabamba',1,-17.3865646,-66.2550557);



INSERT INTO users (name,email,password,rol,idempresa)
VALUES
  ('Molly Sharp','mauris.quis.turpis@icloud.org',crypt('12345678', gen_salt('bf')),'Personal',1),
  ('Akeem Vazquez','in.consequat@icloud.net',crypt('12345678', gen_salt('bf')),'Personal',1),
  ('Colin Herman','a.facilisis@google.couk',crypt('12345678', gen_salt('bf')),'Personal',1),
  ('Stacy Alford','dolor@outlook.edu',crypt('12345678', gen_salt('bf')),'Personal',1),
  ('Ferris Brock','nibh.quisque.nonummy@outlook.ca',crypt('12345678', gen_salt('bf')),'Personal',1);
 
INSERT INTO users (name,email,password,rol,idempresa,celular)
VALUES
	('Admin','embol@gmail.com',crypt('12345678', gen_salt('bf')),'Administrador',1,'76627246');

--select * from trabajos
-- Actualizar el nombre de la área de trabajo con ID 1 a 'Nueva Área'
/*UPDATE users
SET celular = '76627246'
WHERE id = 8;*/

insert into users (name,email,password,rol,url,textcv,pathcv)
values
	('Isela Huanca','isela@gmail.com',crypt('12345678', gen_salt('bf')),'Postulante','https://sw-proyects.s3.amazonaws.com/cv/FaZbKfHZQn96NuS3IeWKQX0ryeAc3hXkG6rkFcCZ.pdf','MARTHA ISELA HUANCA CHOQUE
Ingeniera Civil
SOBRE MI
EXPERIENCIA LABORAL
Egresada De Ingenieria
COMERCIO ( VENTA DE TEXTILES)
Civil, buscando mi
May 2017 - Ene 2023
primera experiencia
Vendedora, Atención al cliente.
laboral, que me permita
ESTUDIOS
aplicar los
UNIVERSIDAD AUTONOMA GABRIEL
conocimientos
RENE MORENO
adquiridos en los años de
estudio
Titulada 2022
Carrera de Ingenieria Civil
COLEGIO ISABEL SAAVEDRA
Bachiller 2012
CONTACTO
Operadora De Computadoras
78068084
CAPSOFT
ise250395@gmail.com
Jun - Ago (2023)
Barrio Lindo C/
Certificación en AutoCad
Cabo Quiroga
Basico - Intermedio
CENTRO BOLIVIANO AMERICANO
2013 - 2014
Ingles Basico - Intermedio
MARTHA
ISELA
HUANCA
CHOQUE
Ingeniera
Civil
SOBRE
MI
EXPERIENCIA
LABORAL
Egresada
De
Ingenieria
COMERCIO
(
VENTA
DE
TEXTILES)
Civil,
buscando
mi
May
2017
-
Ene
2023
primera
experiencia
Vendedora,
Atención
al
cliente.
laboral,
que
me
permita
ESTUDIOS
aplicar
los
UNIVERSIDAD
AUTONOMA
GABRIEL
conocimientos
RENE
MORENO
adquiridos
en
los
años
de
estudio
Titulada
2022
Carrera
de
Ingenieria
Civil
COLEGIO
ISABEL
SAAVEDRA
Bachiller
2012
CONTACTO
Operadora
De
Computadoras
78068084
CAPSOFT
ise250395@gmail.com
Jun
-
Ago
(2023)
Barrio
Lindo
C/
Certificación
en
AutoCad
Cabo
Quiroga
Basico
-
Intermedio
CENTRO
BOLIVIANO
AMERICANO
2013
-
2014
Ingles
Basico
-
Intermedio
','cv/FaZbKfHZQn96NuS3IeWKQX0ryeAc3hXkG6rkFcCZ.pdf'),
('Elian Huanca','huancacori@gmail.com',crypt('12345678', gen_salt('bf')),'Postulante','https://sw-proyects.s3.amazonaws.com/cv/RROhhCG3OOUVryf4vfqw901Ifqo4kyHSujr90xVi.pdf','ELIAN RENE HUANCA CHOQUE
Estudiante
EXPERIENCIA LABORAL
SOBRE MÍ
COMERCIO ( VENTA DE TEXTILES)
Estudiante de Ingeniería
Nov 2022- Ago 2023
de Sistemas.
Vendedor, Atención al cliente.
Buscando mi primera
ESTUDIOS
experiencia laboral, que
me permita aplicar los
UNIVERSIDAD AUTONOMA GABRIEL
conocimientos
RENE MORENO
adquiridos en los años de
2018 - actualidad.
estudio
Carrera de Ingeniería De Sistemas (9no semestre)
COLEGIO BOLIVIANO AMERICANO
Bachiller 2017
CONTACTO
CURSOS AUTOFINANCIADO DE
IDIOMAS
+591 76627246
2021 - actualidad.
huancacori@gmail.com
Ingles B1
Barrio Lindo, C/
Cabo Quiroga
HABILIDADES
github.com/ElianHuanca
Lenguajes De Programación : Java, PHP, Javascript.
Gestores De Base De Datos : MySQL, Postgres,
SQL Server, MongoDB.
Frameworks: Laravel, React Js, Node Js, Flutter.
Control De Versiones: Git y GitHub
Lenguaje De Marcado y Estilos : Html y Css
ELIAN
RENE
HUANCA
CHOQUE
Estudiante
EXPERIENCIA
LABORAL
SOBRE
MÍ
COMERCIO
(
VENTA
DE
TEXTILES)
Estudiante
de
Ingeniería
Nov
2022-
Ago
2023
de
Sistemas.
Vendedor,
Atención
al
cliente.
Buscando
mi
primera
ESTUDIOS
experiencia
laboral,
que
me
permita
aplicar
los
UNIVERSIDAD
AUTONOMA
GABRIEL
conocimientos
RENE
MORENO
adquiridos
en
los
años
de
2018
-
actualidad.
estudio
Carrera
de
Ingeniería
De
Sistemas
(9no
semestre)
COLEGIO
BOLIVIANO
AMERICANO
Bachiller
2017
CONTACTO
CURSOS
AUTOFINANCIADO
DE
IDIOMAS
+591 76627246
2021
-
actualidad.
huancacori@gmail.com
Ingles
B1
Barrio
Lindo,
C/
Cabo
Quiroga
HABILIDADES
github.com/ElianHuanca
Lenguajes
De
Programación
:
Java,
PHP,
Javascript.
Gestores
De
Base
De
Datos
:
MySQL,
Postgres,
SQL
Server,
MongoDB.
Frameworks:
Laravel,
React
Js,
Node
Js,
Flutter.
Control
De
Versiones:
Git
y
GitHub
Lenguaje
De
Marcado
y
Estilos
:
Html
y
Css
','cv/RROhhCG3OOUVryf4vfqw901Ifqo4kyHSujr90xVi.pdf');


CREATE OR REPLACE FUNCTION agregarCelular()
RETURNS VOID AS $$
DECLARE
    iduser INT;
    cant INT;
    numero VARCHAR(8);
BEGIN 
    SELECT COUNT(*) INTO cant FROM users;
    
    FOR iduser IN 1..cant LOOP
        numero := (floor(random() * (79999999 - 70000000) + 70000000));
        UPDATE users SET celular = numero WHERE id = iduser;
    END LOOP;
END;
$$ LANGUAGE plpgsql;
SELECT agregarCelular();

CREATE OR REPLACE FUNCTION randomCargo(categoria varchar(100))
RETURNS VARCHAR(100) AS $$
DECLARE 
    num INT;
    ingenieria VARCHAR[] := ARRAY['Ingenieria electrica','Ingenieria mecanica','Ingenieria civil'];
    tecnologia VARCHAR[] := ARRAY['Desarrollador de software','Administrador de sistemas','Analista de datos'];
    finanzas VARCHAR[] := ARRAY['Contador','Analista financiero','Auditor'];
    ventas VARCHAR[] := ARRAY['Representante de ventas','Gerente de marketing','Especialista en relaciones publicas'];
    manufactura VARCHAR[] := ARRAY['Operador de maquinaria','Supervisor de fabricacion','Inspector de calidad'];
    logistica VARCHAR[] := ARRAY['Gerente de logistica','Despachador','Especialista en cadena de suministro'];
BEGIN 
    num := (SELECT floor(random() * 3) + 1 );
    IF categoria = 'Ingenieria' THEN
        RETURN ingenieria[num];
    ELSIF categoria = 'Tecnologia De La Informacion' THEN
        RETURN tecnologia[num];
    ELSIF categoria = 'Finanzas y Contabilidad' THEN
        RETURN finanzas[num];
    ELSIF categoria = 'Ventas y Marketing' THEN
        RETURN ventas[num];
    ELSIF categoria = 'Manufactura y Produccion' THEN
        RETURN manufactura[num];
    ELSE
        RETURN logistica[num];
    END IF;
END;
$$ LANGUAGE plpgsql;
--SELECT randomCargo('Ventas y Marketing');
CREATE OR REPLACE FUNCTION responsabilidades(categoria varchar(100),cargo varchar(100))
RETURNS TEXT[] AS $$
DECLARE 
begin 
	if(categoria='Ingenieria')then 
		if(cargo='Ingenieria electrica') then 
			return ARRAY['Diseñar y desarrollar sistemas eléctricos para diversos proyectos, asegurando la eficiencia y la seguridad.','Supervisar la instalación, mantenimiento y reparación de equipos eléctricos, garantizando el cumplimiento de normativas.','Colaborar en la resolución de problemas técnicos y proporcionar asesoramiento en temas relacionados con ingeniería eléctrica.'];
		elsif(cargo='Ingenieria mecanica') then 
			return ARRAY['Diseñar y optimizar componentes mecánicos para productos y sistemas.','Coordinar y supervisar proyectos de fabricación, desde la concepción hasta la implementación.','Evaluar y mejorar el rendimiento de máquinas y sistemas mecánicos existentes.'];
		else
			return ARRAY['Planificar, diseñar y supervisar la construcción de proyectos de infraestructura civil, como carreteras, puentes o edificios.','Coordinar equipos de trabajo y colaborar con arquitectos, contratistas y otros profesionales.','Garantizar el cumplimiento de regulaciones y normativas locales en todas las fases del proyecto.'];
		end if;
	elsif(categoria='Tecnologia De La Informacion')then
		if(cargo='Desarrollador de software') then
			return ARRAY['Diseñar, desarrollar y mantener software de alta calidad.','Colaborar con equipos interdisciplinarios para comprender los requisitos del cliente y traducirlos en soluciones de software.','Identificar y corregir errores (bugs) en el código y realizar pruebas para garantizar la calidad del software.'];
		elsif(cargo='Administrador de sistemas') then 
			return ARRAY['Configurar, mantener y administrar sistemas y servidores.','Implementar y mantener medidas de seguridad para proteger la integridad y confidencialidad de los datos.','Colaborar en la planificación y ejecución de actualizaciones de software y hardware.'];
		else 
			return ARRAY['Recopilar, procesar y analizar datos para proporcionar información valiosa a la empresa.','Desarrollar y mantener modelos analíticos y algoritmos para extraer conocimientos.','Presentar hallazgos de manera clara y comprensible mediante informes y visualizaciones.'];
		end if;
	elsif(categoria='Finanzas y Contabilidad')then
		if(cargo='Contador') then
			return ARRAY['Llevar a cabo la contabilidad financiera, incluyendo la preparación de estados financieros.','Gestionar y mantener registros financieros precisos y actualizados.','Preparar declaraciones de impuestos y asegurar el cumplimiento de regulaciones fiscales.'];
		elsif(cargo='Analista financiero') then 
			return ARRAY['Analizar y evaluar el rendimiento financiero de la empresa.','Realizar proyecciones financieras y análisis de tendencias.','Colaborar en la elaboración de informes financieros y presentar recomendaciones para la toma de decisiones.'];
		else 
			return ARRAY['Realizar auditorías internas o externas para evaluar la efectividad de los controles financieros.','Revisar y analizar los procedimientos contables y financieros.','Identificar y comunicar hallazgos, proponiendo mejoras para mitigar riesgos.'];
		end if;
	elsif(categoria='Ventas y Marketing')then
		if(cargo='Representante de ventas') then
			return ARRAY['Prospectar y cerrar acuerdos de venta con clientes potenciales.','Mantener relaciones sólidas con los clientes existentes y proporcionar un servicio postventa eficaz.','Colaborar con el equipo de marketing para desarrollar estrategias de venta efectivas.'];
		elsif(cargo='Gerente de marketing') then 
			return ARRAY['Desarrollar y ejecutar estrategias de marketing para aumentar la visibilidad y las ventas.','Supervisar la creación de contenido publicitario y gestionar campañas publicitarias.','Analizar datos de mercado y tendencias para ajustar las estrategias de marketing.'];
		else 
			return ARRAY['Desarrollar y mantener relaciones positivas con medios de comunicación y partes interesadas.','Coordinar eventos y actividades promocionales para fortalecer la imagen de la empresa.','Manejar la comunicación en situaciones de crisis y gestionar la reputación de la empresa.'];
		end if;
	elsif(categoria='Manufactura y Produccion')then
		if(cargo='Operador de maquinaria') then
			return ARRAY['Operar y mantener maquinaria industrial de manera segura y eficiente.','Realizar inspecciones rutinarias y llevar a cabo tareas de mantenimiento básico.','Cumplir con estándares de producción y asegurar la calidad del producto.'];
		elsif(cargo='Supervisor de fabricacion') then 
			return ARRAY['Supervisar y coordinar las actividades de producción para cumplir con los objetivos.','Gestionar y liderar equipos de trabajo, asignando tareas y asegurando la eficiencia.','Implementar procesos de mejora continua y mantener estándares de calidad.'];
		else 
			return ARRAY['Evaluar la calidad de los productos mediante inspecciones visuales y pruebas.','Documentar y comunicar hallazgos de calidad a los departamentos pertinentes.','Colaborar en el desarrollo y mantenimiento de estándares de calidad.'];
		end if;
	else --if(categoria='Logistica y Transporte')then
		if(cargo='Gerente de logistica') then
			return ARRAY['Planificar y coordinar operaciones logísticas para garantizar la eficiencia en la cadena de suministro.','Supervisar el inventario y la gestión de almacenes, optimizando el flujo de productos.','Colaborar con proveedores y transportistas para garantizar la entrega oportuna de productos.'];
		elsif(cargo='Despachador') then 
			return ARRAY['Coordinar la programación y asignación de envíos y entregas.','Seguimiento de rutas y gestión de tiempos de entrega.','Comunicarse con conductores y clientes para resolver problemas logísticos.'];
		else 
			return ARRAY['Analizar y optimizar la cadena de suministro para mejorar la eficiencia y reducir costos.','Colaborar con proveedores y clientes para gestionar relaciones y garantizar la disponibilidad de productos.','Implementar y mantener sistemas de seguimiento y gestión de inventario.'];
		end if;
	end if;
end;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION requisitos(categoria varchar(100),cargo varchar(100))
RETURNS TEXT[] AS $$
DECLARE 
begin 
	if(categoria='Ingenieria')then 
		if(cargo='Ingenieria electrica') then 
			return ARRAY['Licenciatura en Ingeniería Eléctrica o campo relacionado.','Experiencia práctica en el diseño y la implementación de sistemas eléctricos.','Conocimiento profundo de normativas y estándares de seguridad eléctrica.'];
		elsif(cargo='Ingenieria mecanica') then 
			return ARRAY['Licenciatura en Ingeniería Mecánica o disciplina relacionada.','Experiencia en diseño asistido por computadora (CAD) y análisis de elementos finitos.','Conocimiento sólido de los principios de la termodinámica y la mecánica de fluidos.'];
		else 
			return ARRAY['Licenciatura en Ingeniería Civil o campo afín.','Experiencia en diseño y gestión de proyectos de construcción.','Conocimiento profundo de códigos de construcción y normativas locales.'];
		end if;
	elsif(categoria='Tecnologia De La Informacion')then
		if(cargo='Desarrollador de software') then
			return ARRAY['Licenciatura en Ciencias de la Computación, Ingeniería de Software o campo relacionado.','Experiencia en el desarrollo de aplicaciones utilizando lenguajes de programación modernos.','Conocimiento sólido de metodologías de desarrollo ágil y buenas prácticas de programación.'];
		elsif(cargo='Administrador de sistemas') then 
			return ARRAY['Licenciatura en Ingeniería Informática, Sistemas de Información o campo relacionado.','Experiencia en administración de sistemas operativos y redes.','Conocimientos sólidos en seguridad informática y resolución de problemas de infraestructura.'];
		else 
			return ARRAY['Licenciatura en Estadísticas, Ciencia de Datos, Matemáticas aplicadas o campo relacionado.','Experiencia en el uso de herramientas y lenguajes de análisis de datos (por ejemplo, Python, R, SQL).','Habilidades avanzadas en análisis estadístico y modelado predictivo.'];
		end if;
	elsif(categoria='Finanzas y Contabilidad')then
		if(cargo='Contador') then
			return ARRAY['Licenciatura en Contabilidad, Finanzas o campo relacionado.','Experiencia en contabilidad financiera y conocimiento de los principios contables.','Familiaridad con software contable y habilidades avanzadas en hojas de cálculo.'];
		elsif(cargo='Analista financiero') then 
			return ARRAY['Licenciatura en Finanzas, Economía, Administración de Empresas o campo relacionado.','Experiencia en análisis financiero y modelado financiero.','Conocimiento avanzado de herramientas financieras y habilidades en el manejo de datos.'];
		else 
			return ARRAY['Licenciatura en Contabilidad, Auditoría, Finanzas o campo relacionado.','Experiencia en auditoría interna o externa.','Conocimiento de normativas y estándares de auditoría, así como habilidades analíticas detalladas.'];
		end if;
	elsif(categoria='Ventas y Marketing')then
		if(cargo='Representante de ventas') then
			return ARRAY['Experiencia en ventas, preferiblemente en el sector específico de la empresa.','Habilidades excepcionales de comunicación y negociación.','Conocimiento de los productos o servicios que se están vendiendo.'];
		elsif(cargo='Gerente de marketing') then 
			return ARRAY['Licenciatura en Marketing, Comunicaciones, o campo relacionado.','Experiencia en roles de marketing, con preferencia en puestos de liderazgo.','Habilidades analíticas y conocimiento de herramientas de análisis de datos.'];
		else 
			return ARRAY['Licenciatura en Relaciones Públicas, Comunicaciones o campo relacionado.','Experiencia en relaciones públicas o comunicaciones corporativas.','Habilidades excelentes de comunicación verbal y escrita, así como una red de contactos en los medios.'];
		end if;
	elsif(categoria='Manufactura y Produccion')then
		if(cargo='Operador de maquinaria') then
			return ARRAY['Educación técnica o formación relevante en el manejo de maquinaria.','Experiencia previa como operador de maquinaria en entornos industriales.','Conocimiento de las normas de seguridad y capacidad para realizar tareas físicas.'];
		elsif(cargo='Supervisor de fabricacion') then 
			return ARRAY['Experiencia en roles de supervisión en entornos de fabricación.','Conocimiento sólido de procesos de producción y gestión de recursos.','Habilidades de liderazgo y capacidad para tomar decisiones efectivas.'];
		else 
			return ARRAY['Conocimiento técnico en procesos de fabricación y estándares de calidad.','Experiencia en roles de inspección de calidad.','Habilidades detalladas de observación y capacidad para seguir protocolos de control de calidad.'];
		end if;
	else--if(categoria='Logistica y Transporte')then
		if(cargo='Gerente de logistica') then
			return ARRAY['Experiencia previa en roles de gestión logística.','Conocimiento profundo de sistemas de gestión de almacenes y logística.','Habilidades de liderazgo y capacidad para tomar decisiones estratégicas.'];
		elsif(cargo='Despachador') then 
			return ARRAY['Experiencia en despacho y coordinación de logística.','Conocimiento de geografía local y habilidades de planificación.','Habilidades de comunicación efectiva y capacidad para trabajar bajo presión.'];
		else 
			return ARRAY['Licenciatura en Logística, Administración de Empresas o campo relacionado.','Experiencia en gestión de cadena de suministro y optimización de procesos.','Conocimiento de software y herramientas de gestión de cadena de suministro.'];
		end if;
	end if;
end;
$$ LANGUAGE plpgsql;


CREATE OR REPLACE FUNCTION insertarTrabajosDisponibles()
RETURNS VOID AS $$
DECLARE 
    idusers INT;idareas INT;responsabilidades text[];requisitos text[];idsucursales INT;categoria VARCHAR(50);cargo VARCHAR(50);salario FLOAT;vacancias INT; veces INT;fecha DATE;fechafin DATE;
begin
	veces:=(SELECT floor(random() * (50 - 40 )+40));
	while (veces>0) LOOP
		categoria:= (SELECT nombre FROM areas ORDER BY random() LIMIT 1);
		idareas:= (select id from areas where nombre=categoria);
		cargo:=(SELECT  randomCargo(categoria));
		idusers:=(SELECT id FROM users where rol='Personal' ORDER BY random() LIMIT 1);
		idsucursales:=(SELECT id FROM sucursales ORDER BY random() LIMIT 1);
		responsabilidades:=(SELECT responsabilidades(categoria,cargo));
		requisitos:=(SELECT requisitos(categoria,cargo));
		salario:=(SELECT floor(random() * (7000 - 2000 )+2000));
		vacancias:=(SELECT floor(random() * 3) + 1 );
		fecha:=(SELECT fecha_aleatoria FROM generate_series('2023-11-20'::date, '2023-12-07'::date, '1 day') AS fecha_aleatoria ORDER BY random() LIMIT 1);
		fechafin:=(SELECT fecha_aleatoria FROM generate_series('2023-12-10'::date, '2023-12-31'::date, '1 day') AS fecha_aleatoria ORDER BY random() LIMIT 1);								
		insert into trabajos(cargo, responsabilidades, requisitos, salario, vacancia, fecha,fechaFin, idarea,iduser, idsucursal) 
		values(cargo,responsabilidades,requisitos,salario,vacancias,fecha,fechafin,idareas,idusers,idsucursales);									
		veces:=veces-1;
	end loop;		
end;
$$ LANGUAGE plpgsql;
SELECT insertarTrabajosDisponibles();

CREATE OR REPLACE FUNCTION insertarTrabajosFinalizados()
RETURNS VOID AS $$
DECLARE 
    idusers INT;idareas INT;responsabilidades text[];requisitos text[];idsucursales INT;categoria VARCHAR(50);cargo VARCHAR(50);salario FLOAT; veces INT;fecha DATE;fechafin DATE;
begin
	veces:=(SELECT floor(random() * (50 - 40 )+40));
	while (veces>0) LOOP
		categoria:= (SELECT nombre FROM areas ORDER BY random() LIMIT 1);--(SELECT randomCategoria());
		idareas:= (select id from areas where nombre=categoria);
		idusers:=(SELECT id FROM users where rol='Personal' ORDER BY random() LIMIT 1);
		cargo:=(SELECT  randomCargo(categoria));
		idsucursales:=(SELECT id FROM sucursales ORDER BY random() LIMIT 1);
		responsabilidades:=(SELECT responsabilidades(categoria,cargo));
		requisitos:=(SELECT requisitos(categoria,cargo));
		salario:=(SELECT floor(random() * (7000 - 2000 )+2000));
		fecha:=(SELECT fecha_aleatoria FROM generate_series('2023-10-01'::date, '2023-11-15'::date, '1 day') AS fecha_aleatoria ORDER BY random() LIMIT 1);
		fechafin:=(SELECT fecha_aleatoria FROM generate_series('2023-11-17'::date, '2023-12-05'::date, '1 day') AS fecha_aleatoria ORDER BY random() LIMIT 1);								
		insert into trabajos(cargo, responsabilidades, requisitos, salario, vacancia, fecha,fechaFin, idarea,iduser, idsucursal,estado) 
		values(cargo,responsabilidades,requisitos,salario,0,fecha,fechafin,idareas,idusers,idsucursales,false);									
		veces:=veces-1;
	end loop;
end;
$$ LANGUAGE plpgsql;
SELECT insertarTrabajosFinalizados();

SELECT s.ciudad, t.estado,COUNT(t.id) AS cantidad_trabajos
FROM sucursales s
JOIN trabajos t ON s.id = t.idsucursal
WHERE t.idempresa = 1  -- Reemplaza 1 con el ID de la empresa específica
GROUP BY s.ciudad,t.estado
order by s.ciudad;

SELECT
    areas.nombre AS area,
    COUNT(trabajos.id) AS cantidad_de_trabajos
FROM
    trabajos
JOIN
    areas ON trabajos.idarea = areas.id
WHERE
    trabajos.estado = true
GROUP BY
    areas.id, areas.nombre;

delete from postulaciones 

SELECT * FROM empresas
SELECT * FROM sucursales
SELECT * FROM users
SELECT * FROM trabajos
SELECT * FROM postulaciones
SELECT * FROM entrevistas
