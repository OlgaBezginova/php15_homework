SELECT CONCAT('We have ', COUNT(*), ' ', if(gender = "m", "boys", "girls"), '!') AS 'Gender information:'
FROM users
GROUP BY gender;