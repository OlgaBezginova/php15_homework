SELECT CONCAT('This is ', name, ', ', if(gender = "m", "he", "she"), ' has email ', email) AS info
FROM users;