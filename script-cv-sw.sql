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
	descripcion TEXT,
	responsabilidades TEXT[],
	requisitos TEXT[],
	salario FLOAT,
	vacancia INT,
	fecha DATE DEFAULT CURRENT_DATE,
	fechaFIN DATE,
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

INSERT INTO trabajos (descripcion, responsabilidades, requisitos, salario, vacancia, fecha, fechaFIN, idempresa, idsucursal) VALUES
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

SELECT * FROM empresas
SELECT * FROM sucursales
SELECT * FROM users
SELECT * FROM trabajos
SELECT * FROM postulaciones
SELECT * FROM entrevistas