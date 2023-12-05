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
	tipo varchar(50)	--tamaño de la empresa
);

CREATE TABLE sucursales(
	id serial PRIMARY KEY,
	direccion varchar(255),
	idempresa INT REFERENCES empresas(id)
);

ALTER TABLE users
ADD COLUMN idempresa integer REFERENCES empresas(id);
ALTER TABLE users
ADD COLUMN rol varchar(50);
ALTER TABLE users
ADD COLUMN url TEXT;


CREATE TABLE trabajos(
	id serial PRIMARY KEY,	
	cargo text,
	--descripcion TEXT,
	responsabilidades TEXT[],
	requisitos TEXT[],
	salario FLOAT,
	vacancia INT,
	fecha DATE DEFAULT CURRENT_DATE,
	fechafin DATE,
	estado BOOLEAN DEFAULT true,
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

INSERT INTO empresas (razon, tipo) VALUES ('ABC Company', 'Pequena');
INSERT INTO empresas (razon, tipo) VALUES ('XYZ Corporation', 'Mediana');
INSERT INTO empresas (razon, tipo) VALUES ('123 Industries', 'Grande');
INSERT INTO empresas (razon, tipo) VALUES ('Tech Innovators Ltd.', 'Pequena');
INSERT INTO empresas (razon, tipo) VALUES ('Global Solutions Inc.', 'Mediana');
INSERT INTO empresas (razon, tipo) VALUES ('Quality Enterprises', 'Grande');
INSERT INTO empresas (razon, tipo) VALUES ('Swift Services LLC', 'Pequena');
INSERT INTO empresas (razon, tipo) VALUES ('Pro Business Systems', 'Mediana');
INSERT INTO empresas (razon, tipo) VALUES ('Epic Ventures Group', 'Grande');
INSERT INTO empresas (razon, tipo) VALUES ('Infinite Innovations', 'Pequena');

INSERT INTO sucursales (direccion, idempresa) VALUES
('123 Main St, City1', 1),
('456 Oak St, City1', 1),
('789 Pine St, City1', 1),
('101 Elm St, City2', 2),
('202 Maple St, City2', 2),
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

INSERT INTO trabajos (cargo, responsabilidades, requisitos, salario, vacancia, fecha, fechaFin, idempresa, idsucursal) VALUES
('Desarrollador de Software', ARRAY['Desarrollo y mantenimiento de aplicaciones'], ARRAY['Experiencia en desarrollo web', 'Conocimiento de varios lenguajes de programación'], 60000.00, 3, '2023-01-15', '2023-02-15', 1, 1),
('Analista de Datos', ARRAY['Análisis de datos y generación de informes'], ARRAY['Experiencia en análisis de datos', 'Habilidades de SQL'], 70000.00, 4, '2023-02-01', '2023-03-01', 1, 2),
('Especialista en Marketing Digital', ARRAY['Planificación y ejecución de estrategias de marketing digital'], ARRAY['Experiencia en marketing digital', 'Habilidades de SEO y redes sociales'], 80000.00, 5, '2023-01-20', '2023-02-28', 1, 3),
('Ingeniero de Sistemas', ARRAY['Diseño y mantenimiento de sistemas'], ARRAY['Experiencia en ingeniería de sistemas', 'Conocimientos de redes'], 90000.00, 3, '2023-02-10', '2023-03-10', 2, 4),
('Asistente Administrativo', ARRAY['Apoyo administrativo y atención al cliente'], ARRAY['Habilidades administrativas', 'Buen manejo de Microsoft Office'], 50000.00, 4, '2023-01-25', '2023-02-28', 2, 5),
('Diseñador Gráfico', ARRAY['Creación de materiales gráficos y diseño de marca'], ARRAY['Experiencia en diseño gráfico', 'Habilidades en Adobe Creative Suite'], 60000.00, 5, '2023-02-05', '2023-03-15', 2, 6),
('Analista Financiero', ARRAY['Análisis y gestión financiera'], ARRAY['Experiencia en análisis financiero', 'Conocimiento de herramientas financieras'], 75000.00, 3, '2023-01-30', '2023-02-28', 3, 7),
('Gerente de Recursos Humanos', ARRAY['Gestión de recursos humanos y desarrollo del personal'], ARRAY['Experiencia en recursos humanos', 'Habilidades de comunicación'], 85000.00, 4, '2023-02-15', '2023-03-15', 3, 8),
('Desarrollador Frontend', ARRAY['Desarrollo de interfaces de usuario'], ARRAY['Experiencia en desarrollo frontend', 'Conocimientos de HTML, CSS, JavaScript'], 70000.00, 5, '2023-02-01', '2023-03-10', 3, 9),
('Ingeniero Eléctrico', ARRAY['Diseño y mantenimiento de sistemas eléctricos'], ARRAY['Experiencia en ingeniería eléctrica', 'Conocimientos de sistemas eléctricos'], 90000.00, 3, '2023-02-20', '2023-03-20', 4, 10);

INSERT INTO users (name,email,password,idempresa)
VALUES
  ('Molly Sharp','mauris.quis.turpis@icloud.org',crypt('12345678', gen_salt('bf')),1),
  ('Akeem Vazquez','in.consequat@icloud.net',crypt('12345678', gen_salt('bf')),2),
  ('Colin Herman','a.facilisis@google.couk',crypt('12345678', gen_salt('bf')),3),
  ('Stacy Alford','dolor@outlook.edu',crypt('12345678', gen_salt('bf')),4),
  ('Ferris Brock','nibh.quisque.nonummy@outlook.ca',crypt('12345678', gen_salt('bf')),5),
  ('Aline Garner','est.mauris@hotmail.ca',crypt('12345678', gen_salt('bf')),6),
  ('Allistair Morse','velit.sed.malesuada@outlook.com',crypt('12345678', gen_salt('bf')),7),
  ('Whoopi Cummings','hendrerit@outlook.com',crypt('12345678', gen_salt('bf')),8),
  ('Jacqueline Middleton','curabitur.egestas.nunc@yahoo.ca',crypt('12345678', gen_salt('bf')),9),
  ('Lila Owen','sit@yahoo.org',crypt('12345678', gen_salt('bf')),10);

INSERT INTO users (name,email,password,idempresa)
VALUES
  ('Kiona Morris','consectetuer@yahoo.ca',crypt('12345678', gen_salt('bf')),1),
  ('Leo Kelly','aliquam.nec@icloud.com',crypt('12345678', gen_salt('bf')),2),
  ('Shelley Ramsey','nunc@aol.couk',crypt('12345678', gen_salt('bf')),3),
  ('Hayfa Moss','fames.ac@hotmail.edu',crypt('12345678', gen_salt('bf')),4),
  ('Bruno Tate','eu.nibh@outlook.org',crypt('12345678', gen_salt('bf')),5),
  ('Brandon O''connor','quam.pellentesque@outlook.com',crypt('12345678', gen_salt('bf')),6),
  ('Leonard Goodman','semper.tellus@hotmail.com',crypt('12345678', gen_salt('bf')),7),
  ('Jade Pacheco','urna.vivamus@icloud.com',crypt('12345678', gen_salt('bf')),8),
  ('Trevor Weiss','amet@aol.edu',crypt('12345678', gen_salt('bf')),9),
  ('Giacomo Ramsey','quisque.ac.libero@yahoo.couk',crypt('12345678', gen_salt('bf')),10);
 
SELECT * FROM empresas
SELECT * FROM sucursales
SELECT * FROM users
SELECT * FROM trabajos
SELECT * FROM postulaciones
SELECT * FROM entrevistas
