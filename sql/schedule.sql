#1
use school;
SELECT days.name as week_day , concat(grades.number, grades.sign) as grade , lessons.name as subject FROM school.schedules
INNER JOIN grades ON schedules.grade_id = grades.id
INNER JOIN days ON schedules.day_id = days.id
INNer Join lessons ON lessons.id = schedules.lesson_id
where days.id = 1;

#2
use school;
SELECT days.name as week_day , concat(grades.number, grades.sign) as grade , lessons.name as subject FROM school.schedules
INNER JOIN grades ON schedules.grade_id = grades.id
INNER JOIN days ON schedules.day_id = days.id
INNer Join lessons ON lessons.id = schedules.lesson_id
where days.id = 5 and  grades.id = 2;

#3

use school;
SELECT schedules.id, 
	schedules.place ,  
    days.id as day_id ,  
    days.name as week_day , 
    concat(grades.number, grades.sign) as grade , 
    lessons.name as subject FROM school.schedules
		INNER JOIN grades ON schedules.grade_id = grades.id
		INNER JOIN days ON schedules.day_id = days.id
		INNER JOIN lessons ON lessons.id = schedules.lesson_id
	WHERE grades.id = 2;
#4

use school;
SELECT schedules.id, 
	schedules.place ,  
    days.id as day_id ,  
    days.name as week_day , 
    concat(grades.number, grades.sign) as grade , 
    lessons.name as subject FROM school.schedules
		INNER JOIN grades ON schedules.grade_id = grades.id
		INNER JOIN days ON schedules.day_id = days.id
		INNER JOIN lessons ON lessons.id = schedules.lesson_id
	WHERE grades.id = 2
    ORDER BY day_id , 
    schedules.place;


#5
use school;
SELECT schedules.id  , lessons.name , schedules.place FROM schedules
INNER JOIN lessons ON schedules.lesson_id = lessons.id 
	WHERE 
		schedules.grade_id = 1 and 
		schedules.day_id = 1
order by schedules.place DESC;



