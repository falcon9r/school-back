#1
use school;
SELECT students.id as student_id , students.first_name , teachers.login as teacher , concat(grades.number, grades.sign) as grade  FROM school.students
INNER join grades ON grades.id = students.grade_id
inner join teachers ON teachers.id =  grades.teacher_id
where grades.id = 1 and students.id = 1;

#
use school;
SELECT students.id as student_id , students.first_name , teachers.login as teacher , concat(grades.number, grades.sign) as grade  FROM school.students
INNER join grades ON grades.id = students.grade_id
inner join teachers ON teachers.id =  grades.teacher_id
where grades.id = 1 and students.id = 2;