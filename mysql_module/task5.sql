SELECT title, COUNT(title) AS words
FROM words AS w
INNER JOIN dicts AS d ON (w.dict_id = d.id)
GROUP BY title;