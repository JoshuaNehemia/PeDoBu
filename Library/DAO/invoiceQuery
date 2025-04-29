SELECT 
    ord.id AS 'invoice_id',
    usr.fullName AS 'passenger',
    dri.username AS 'drivers_name',
    loc.name AS 'from',
    locd.name AS 'destination',
    distTab.distance AS 'distance',
    up.price AS 'charge'
FROM orders ord
INNER JOIN drivers dri ON ord.drivers_id = dri.id
INNER JOIN users usr ON ord.users_username = usr.username
INNER JOIN locations loc ON ord.distance_from = loc.id
INNER JOIN locations locd ON ord.distance_destination = locd.id
INNER JOIN userspayment up ON ord.id = up.orders_id
INNER JOIN (
    SELECT dist.from, dist.destination, dist.distance
    FROM distance dist
) AS distTab ON distTab.from = ord.distance_from AND distTab.destination = ord.distance_destination
WHERE ord.id = ?;
