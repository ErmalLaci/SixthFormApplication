<?php
require "../db/connect.php";

$sql = "
CREATE TABLE Login
(
login_id INT NOT NULL AUTO_INCREMENT,
username VARCHAR(25) NOT NULL,
password VARCHAR(25) NOT NULL,
type ENUM('admin','applicant','teacher'),
PRIMARY KEY (login_id)
);

CREATE TABLE `Teacher`
(
teacher_id INT NOT NULL AUTO_INCREMENT,
fname VARCHAR(25),
sname VARCHAR(25),
department SET('Maths','English'),
login_id INT,
PRIMARY KEY (teacher_id),
FOREIGN KEY (login_id) REFERENCES Login(login_id)
);



CREATE TABLE Applicant
(
login_id int,
applicant_id INT NOT NULL AUTO_INCREMENT,
fname VARCHAR(25) NOT NULL,
sname VARCHAR(25) NOT NULL,
PRIMARY KEY (applicant_id),
FOREIGN KEY (login_id) REFERENCES Login(login_id)
ON UPDATE CASCADE
ON DELETE CASCADE
);

CREATE TABLE Subject
(
subject_id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(25) NOT NULL,
exam_board ENUM('AQA', 'OCR', 'EDEXCEL'),
PRIMARY KEY (subject_id),
);

CREATE TABLE Grades
(
grade_id INT NOT NULL AUTO_INCREMENT,
subject_id INT,
predicted_grade ENUM('A*','A','B','C','D','E','F','G','U'),
grade ENUM('A*','A','B','C','D','E','F','G','U'),
PRIMARY KEY (grade_id),
FOREIGN KEY (subject_id) REFERENCES Subject(subject_id)
ON UPDATE CASCADE
ON DELETE CASCADE
);

CREATE TABLE `Selected Courses`
(
selectedcourse_id INT NOT NULL AUTO_INCREMENT,
applicant_id INT,
block_a INT,
block_b INT,
block_c INT,
block_d INT,
block_e INT,
PRIMARY KEY (selectedcourse_id),
FOREIGN KEY (applicant_id) REFERENCES Applicant(applicant_id)
ON UPDATE CASCADE
ON DELETE CASCADE
);

CREATE TABLE `Sixth Form Subject`
(
sixthformsubject_id INT NOT NULL AUTO_INCREMENT,
name VARCHAR(25),
level ENUM('AS', 'Level 2'),
block SET('A', 'B', 'C', 'D', 'E'),
PRIMARY KEY (sixthformsubject_id)
);

CREATE TABLE Recipient
(
login_id INT,
news_id INT,
PRIMARY KEY (login_id,news_id)
ON UPDATE CASCADE
ON DELETE CASCADE
);
CREATE TABLE News
(
news_id INT NOT NULL AUTO_INCREMENT,
information TEXT,
PRIMARY KEY (news_id),
);
";
$result = mysqli_query($link, $sql);
if ($result){
    echo "Hopefully it works!!";
}else {
    echo "Error creating table: " . mysqli_error($link);
}
?>
