#1

SELECT a.quarter_id , a.grade_id , b.name as status , a.date FROM school.days_in_schools as a 
INNER JOIN 
	days_in_school_statuses as b ON b.id = a.days_in_school_status_id
    where a.grade_id = 1 and a.date <= now();

#2
select students.id , students.login , students.grade_id , days_in_schools.date ,schoolworks.place , schoolwork_students.id as `key` , lessons.name, schoolwork_students.note from schoolwork_students
INNER JOIN schoolworks on schoolworks.id =  schoolwork_students.schoolworks_id
INNER JOIN days_in_schools ON days_in_schools.id = schoolworks.days_in_school_id
INNER JOIN lessons ON lessons.id = schoolworks.lesson_id
INNER JOIN students on students.id = schoolwork_students.student_id
where students.grade_id = 1
order by students.id , schoolworks.place desc;

#3
select * from schoolwork_students
INNER JOIN schoolworks on schoolworks.id =  schoolwork_students.schoolworks_id
INNER JOIN days_in_schools ON days_in_schools.id = schoolworks.days_in_school_id
INNER JOIN lessons ON lessons.id = schoolworks.lesson_id
INNER JOIN students on students.id = schoolwork_students.student_id
WHERE days_in_schools.grade_id = 1
order by schoolworks.place;

#4
select * from schoolworks 
INNER JOIN days_in_schools ON days_in_schools.id = schoolworks.days_in_school_id
INNER JOIN lessons ON lessons.id = schoolworks.lesson_id
WHERE days_in_schools.grade_id = 1
order by schoolworks.place; 