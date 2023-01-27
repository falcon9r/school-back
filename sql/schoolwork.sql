#1
SELECT  l.name , ss.name , dns.date FROM school.schoolworks as sw
INNER JOIN days_in_schools as dns ON dns.id = sw.days_in_school_id
INNER JOIN lessons as l  ON l.id = sw.lesson_id
INNER join schoolwork_statuses as ss on sw.schoolwork_status_id = ss.id
where dns.grade_id = 1 and dns.date <= now();



#2
SELECT students.first_name , schoolwork_students.schoolwork_student_status_id , lessons.name , schoolwork_student_statuses.name  FROM school.schoolwork_students
INNER JOIN schoolworks ON schoolworks.id = schoolwork_students.schoolworks_id
INNER JOIN students ON students.id = schoolwork_students.student_id
INNER JOIN lessons ON lessons.id = schoolworks.lesson_id
INNER JOIN schoolwork_student_statuses on schoolwork_students.schoolwork_student_status_id = schoolwork_student_statuses.id
where schoolworks.id IN (SELECT  sw.id FROM school.schoolworks as sw
INNER JOIN days_in_schools as dns ON dns.id = sw.days_in_school_id
INNER JOIN lessons as l  ON l.id = sw.lesson_id
INNER join schoolwork_statuses as ss on sw.schoolwork_status_id = ss.id
where dns.grade_id = 1 and dns.date <= now()) and students.id = 1;


#3
SELECT * FROM school.schoolwork_students
INNER JOIN schoolworks ON schoolwork_students.schoolworks_id = schoolworks.id
WHERE  schoolworks.days_in_school_id = (
	select id from days_in_schools where grade_id = 1 and date = '2022-12-03' limit 1
);


#4
select ss.id , students.login , lessons.name , students.grade_id , ss.note , s.place from schoolwork_students as ss
INNER JOIN schoolworks as s ON ss.schoolworks_id = s.id
INNER JOIN lessons ON s.lesson_id = lessons.id
INNER JOIN students ON ss.student_id = students.id
where students.grade_id = 1
order by  students.id , s.place;