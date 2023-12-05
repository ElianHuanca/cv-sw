CREATE EXTENSION IF NOT EXISTS pgcrypto;
CREATE EXTENSION IF NOT EXISTS plpgsql;
CREATE TABLE empresas(
	id serial PRIMARY KEY,
	razon varchar(200),
	tipo varchar(50)	--tamaño de la empresa
);

CREATE TABLE sucursales(
	id serial PRIMARY KEY,
	direccion varchar(255),
	ciudad varchar(50),
	latitud varchar(50),
	longitud varchar(50),
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
	categoria VARCHAR(50),
	idempresa INT REFERENCES empresas(id),
	idsucursal INT REFERENCES sucursales(id)
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
	idpostulacion INT REFERENCES postulaciones(id),
	fecha DATE,
	hora TIME,
	resultado ,
	
)

INSERT INTO empresas (razon, tipo) VALUES ('Embol', 'Grande');
INSERT INTO empresas (razon, tipo) VALUES ('Cerveceria Boliviana Nacional CBN', 'Mediana');
INSERT INTO empresas (razon, tipo) VALUES ('123 Industries', 'Grande');
INSERT INTO empresas (razon, tipo) VALUES ('Tech Innovators Ltd.', 'Pequena');
INSERT INTO empresas (razon, tipo) VALUES ('Global Solutions Inc.', 'Mediana');
INSERT INTO empresas (razon, tipo) VALUES ('Quality Enterprises', 'Grande');
INSERT INTO empresas (razon, tipo) VALUES ('Swift Services LLC', 'Pequena');
INSERT INTO empresas (razon, tipo) VALUES ('Pro Business Systems', 'Mediana');
INSERT INTO empresas (razon, tipo) VALUES ('Epic Ventures Group', 'Grande');
INSERT INTO empresas (razon, tipo) VALUES ('Infinite Innovations', 'Pequena');

INSERT INTO sucursales (direccion, ciudad,idempresa,latitud,longitud) VALUES
('Planta 
Parque Industrial Mz PI-6','Santa Cruz', 1,),
('Scz-Oficina Central
Av. Cristo Redentor #1500','Santa Cruz', 1),
('Scz-Oficina Comercial
Parque Industrial Mz. PI-27','Santa Cruz', 1),
('Oficina Las Torres
Avenida Arce # 2519 Edificio Torres del Poeta Torre B Piso 15','La Paz', 1),
('Planta Rio Seco
Carretera Panamericana ex tranca Rio Seco','La Paz',1),
('Oficina Circunvalación
Av. Circunvalación # 1993 (entre A.Quijarro y J.Rosales)','Cochabamba',1)
('Planta Piñami
Av. Blanco Galindo Km10 (Z.Piñami)','Cochabamba',1)
('303 Cedar St, City3', 3),
('404 Birch St, City3', 3),
('505 Spruce St, City4', 4),
('606 Fir St, City4', 4),
('707 Redwood St, City5', 5),
('808 Sequoia St, City5', 5),
('909 Pinecone St, City5', 5),
('111 Oak Leaf St, City6', 6),
('222 Acorn St, City7', 7),
('333 Chestnut St, City7', 7),
('444 Walnut St, City8', 8),
('555 Hazelnut St, City8', 8),
('666 Pecan St, City9', 9),
('777 Almond St, City9', 9),
('888 Cashew St, City9', 9),
('999 Pistachio St, City10', 10);













INSERT INTO users (name,email,password,idempresa)
VALUES
  ('Molly Sharp','mauris.quis.turpis@icloud.org',crypt('12345678', gen_salt('bf')),'Personal',1),
  ('Akeem Vazquez','in.consequat@icloud.net',crypt('12345678', gen_salt('bf')),'Personal',2),
  ('Colin Herman','a.facilisis@google.couk',crypt('12345678', gen_salt('bf')),'Personal',3),
  ('Stacy Alford','dolor@outlook.edu',crypt('12345678', gen_salt('bf')),'Personal',4),
  ('Ferris Brock','nibh.quisque.nonummy@outlook.ca',crypt('12345678', gen_salt('bf')),'Personal',5),
  ('Aline Garner','est.mauris@hotmail.ca',crypt('12345678', gen_salt('bf')),'Personal',6),
  ('Allistair Morse','velit.sed.malesuada@outlook.com',crypt('12345678', gen_salt('bf')),'Personal',7),
  ('Whoopi Cummings','hendrerit@outlook.com',crypt('12345678', gen_salt('bf')),'Personal',8),
  ('Jacqueline Middleton','curabitur.egestas.nunc@yahoo.ca',crypt('12345678', gen_salt('bf')),'Personal',9),
  ('Lila Owen','sit@yahoo.org',crypt('12345678', gen_salt('bf')),'Personal',10);

INSERT INTO users (name,email,password,rol,idempresa)
VALUES
  ('Kiona Morris','consectetuer@yahoo.ca',crypt('12345678', gen_salt('bf')),'Personal',1),
  ('Leo Kelly','aliquam.nec@icloud.com',crypt('12345678', gen_salt('bf')),'Personal',2),
  ('Shelley Ramsey','nunc@aol.couk',crypt('12345678', gen_salt('bf')),'Personal',3),
  ('Hayfa Moss','fames.ac@hotmail.edu',crypt('12345678', gen_salt('bf')),'Personal',4),
  ('Bruno Tate','eu.nibh@outlook.org',crypt('12345678', gen_salt('bf')),'Personal',5),
  ('Brandon O''connor','quam.pellentesque@outlook.com',crypt('12345678', gen_salt('bf')),'Personal',6),
  ('Leonard Goodman','semper.tellus@hotmail.com',crypt('12345678', gen_salt('bf')),'Personal',7),
  ('Jade Pacheco','urna.vivamus@icloud.com',crypt('12345678', gen_salt('bf')),'Personal',8),
  ('Trevor Weiss','amet@aol.edu',crypt('12345678', gen_salt('bf')),'Personal',9),
  ('Giacomo Ramsey','quisque.ac.libero@yahoo.couk',crypt('12345678', gen_salt('bf')),'Personal',10);

insert into users (name,email,password,rol,url,texcv,pathcv)
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
','cv/FaZbKfHZQn96NuS3IeWKQX0ryeAc3hXkG6rkFcCZ.pdf')
 
CREATE OR REPLACE FUNCTION randomCategoria()
RETURNS VARCHAR(100) AS $$
declare num INT;
categorias VARCHAR[] := ARRAY['Ingenieria', 
'Tecnologia De La Informacion',
'Finanzas y Contabilidad',
'Ventas y Marketing',
'Manufactura y Produccion',
'Logistica y Transporte'
];
begin 
	num:=(SELECT floor(random() * 6) + 1 );
	return categorias[num]; 
end;
$$ LANGUAGE plpgsql;
--SELECT randomCategoria();

CREATE OR REPLACE FUNCTION randomCargo(categoria varchar(100))
RETURNS VARCHAR(100) AS $$
DECLARE 
    num INT;
    ingenieria VARCHAR[] := ARRAY['Ingenieria electrica','Ingenieria mecanica','Ingeniería civil'];
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


CREATE OR REPLACE FUNCTION insertarTrabajosHabilidatos()
RETURNS VOID AS $$
DECLARE 
    idempresas INT;responsabilidades text[];requisitos text[];idsucursales INT;categoria VARCHAR(50);cargo VARCHAR(50);salario FLOAT;vacancia INT; veces INT;fecha DATE;fechafin DATE;
begin
	idempresas:=(select count(*) from empresas);
	while (idempresas>0) LOOP
		veces:=(SELECT floor(random() * (200 - 100 )+100));
		while (veces>0) LOOP
			categoria:=(SELECT randomCategoria());
			cargo:=(SELECT  randomCargo(categoria));
			idsucursales:=(SELECT id FROM sucursales where sucursales.idempresa=idempresa ORDER BY random() LIMIT 1);
			responsabilidades:=(SELECT responsabilidades(categoria,cargo));
			requisitos:=(SELECT requisitos(categoria,cargo));
			salario:=(SELECT floor(random() * (7000 - 2000 )+2000));
			vacancia:=(SELECT floor(random() * 3) + 1 );
			fecha:=(SELECT fecha_aleatoria FROM generate_series('2023-11-20'::date, '2023-12-07'::date, '1 day') AS fecha_aleatoria ORDER BY random() LIMIT 1);
			fechafin:=(SELECT fecha_aleatoria FROM generate_series('2023-12-07'::date, '2023-12-31'::date, '1 day') AS fecha_aleatoria ORDER BY random() LIMIT 1);								
			insert into trabajos(cargo, responsabilidades, requisitos, salario, vacancia, fecha,fechaFin, categoria,idempresa, idsucursal) 
			values(cargo,responsabilidades,requisitos,salario,vacancia,fecha,fechafin,categoria,idempresas,idsucursales);									
			veces:=veces-1;
		end loop;
		idempresas:=idempresas-1;
	end loop;
end;
$$ LANGUAGE plpgsql;
SELECT insertarTrabajosHabilidatos();

SELECT * FROM empresas
SELECT * FROM sucursales
SELECT * FROM users
SELECT * FROM trabajos
SELECT * FROM postulaciones
SELECT * FROM entrevistas
