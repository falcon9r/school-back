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