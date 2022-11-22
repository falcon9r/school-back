#1
SELECT  l.name , ss.name , dns.date FROM school.schoolworks as sw
INNER JOIN days_in_schools as dns ON dns.id = sw.days_in_school_id
INNER JOIN lessons as l  ON l.id = sw.lesson_id
INNER join schoolwork_statuses as ss on sw.schoolwork_status_id = ss.id
where dns.grade_id = 1 and dns.date <= now();

