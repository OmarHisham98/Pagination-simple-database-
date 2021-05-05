/*
	Database Creation.
*/
CREATE DATABASE university2;


/*
	TABLES Creation
*/
CREATE TABLE university2.course (
    course_id INT(3) NOT NULL AUTO_INCREMENT, 
    course_name VARCHAR(150) NOT NULL, 
    course_description VARCHAR(150) NOT NULL,
    professor_id INT(3) NOT NULL,
    department_id INT(3) NOT NULL,
    PRIMARY KEY(course_id),
    FOREIGN KEY (professor_id) REFERENCES professor(professor_id),
    FOREIGN KEY (department_id) REFERENCES department(department_id)
);

CREATE TABLE university2.department (
    department_id INT(3) NOT NULL AUTO_INCREMENT, 
    department_name VARCHAR(150) NOT NULL, 
    PRIMARY KEY(department_id)
);

CREATE TABLE university2.professor (
    professor_id INT(3) NOT NULL AUTO_INCREMENT, 
    professor_name VARCHAR(150) NOT NULL, 
    PRIMARY KEY(professor_id)
);




/*
	Random Table Insertion
*/

INSERT INTO department(department_name) VALUES ('Computer');
INSERT INTO department(department_name) VALUES ('mechanical');
INSERT INTO department(department_name) VALUES ('construction');
INSERT INTO department(department_name) VALUES ('Architecture');

INSERT INTO professor(professor_name) VALUES ('Omar hisham');
INSERT INTO professor(professor_name) VALUES ('Ahmed tamer');
INSERT INTO professor(professor_name) VALUES ('omar badr');
INSERT INTO professor(professor_name) VALUES ('mostafa mohamed');
INSERT INTO professor(professor_name) VALUES ('mark maged');


INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('Graph I', 'graphical', 1, 1);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('electronics', 'electronics and semiConductors', 2, 2);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('Maths I', 'mathematics I', 5, 3);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('Mechanics I', 'first mechanics', 4, 4);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('Engineering economics', 'economics of engineering', 5, 1);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('Data Structures I', 'DS 1', 5, 2);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('Data Structures II', 'DS 2', 4, 3);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('Optimization', 'Optimization techniques', 4, 1);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('programming', 'Programming language', 1, 1);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('numerical', 'numerical systems', 1, 2);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('fluid', 'fluid mechanics', 2, 2);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('steel', 'steel in architecture', 3, 4);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('aerodynamics', 'aero', 4, 2);
INSERT INTO course(course_name, course_description, professor_id, department_id) VALUES ('earth', 'earth and soil', 5, 3);