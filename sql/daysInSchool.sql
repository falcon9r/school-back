#1

SELECT a.quarter_id , a.grade_id , b.name as status , a.date FROM school.days_in_schools as a 
INNER JOIN 
	days_in_school_statuses as b ON b.id = a.days_in_school_status_id
    where a.grade_id = 1 and a.date <= now();