SELECT 
    cita_id,
    tipo,
    nombre,
    SUM(costo) AS costo_unitario,
    SUM(COALESCE(cantidad, 1)) AS cantidad,
    SUM(costo * COALESCE(cantidad, 1)) AS total
FROM (
    SELECT 
        c.id AS cita_id,
        'Servicio' AS tipo,
        s.nombre AS nombre,
        s.precio AS costo,
        NULL AS cantidad
    FROM 
        Citas c
    INNER JOIN 
        Citas_Servicios cs ON c.id = cs.cita_id
    INNER JOIN 
        Servicios s ON cs.servicio_id = s.id

    UNION ALL

    SELECT 
        c.id AS cita_id,
        'Medicamento' AS tipo,
        m.nombre AS nombre,
        m.precio AS costo,
        mr.cantidad AS cantidad
    FROM 
        Citas c
    INNER JOIN 
        Recetas r ON c.id = r.cita_id
    INNER JOIN 
        MedicamentosReceetas mr ON r.id = mr.receta_id
    INNER JOIN 
        Medicamentos m ON mr.medicamento_id = m.id
) AS detalle
GROUP BY 
    cita_id, tipo, nombre
ORDER BY 
    cita_id, tipo, nombre;
