SELECT DATEDIFF(MAX(date), MIN(date)) as 'uptime'
FROM member_history
GROUP BY id_film;