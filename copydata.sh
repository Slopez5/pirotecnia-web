#!/bin/bash

# 🔹 Configuración de la base de datos remota
REMOTE_HOST="host.docker.internal"
REMOTE_PORT="3307"  # Puerto del túnel SSH
REMOTE_USER="slopez"
REMOTE_PASSWORD="Locs950606"
REMOTE_DB="pirotenica_sr_db"

# 🔹 Configuración de la base de datos local en Docker
LOCAL_CONTAINER="mysql"
LOCAL_DB="pirotenica_sr_db"
LOCAL_USER="sail"
LOCAL_PASSWORD="password"

# 🔹 Ruta para guardar el dump temporalmente
DUMP_FILE="backup.sql"

echo "📤 Realizando dump de la base de datos remota..."
mysqldump -h $REMOTE_HOST -P $REMOTE_PORT -u $REMOTE_USER -p$REMOTE_PASSWORD --databases $REMOTE_DB > $DUMP_FILE

if [ $? -eq 0 ]; then
    echo "✅ Dump creado correctamente."

    echo "📥 Restaurando dump en el contenedor Docker..."
    cat $DUMP_FILE | docker exec -i $LOCAL_CONTAINER mysql -u$LOCAL_USER -p$LOCAL_PASSWORD $LOCAL_DB

    if [ $? -eq 0 ]; then
        echo "✅ Base de datos restaurada correctamente en Docker."
    else
        echo "❌ Error al restaurar la base de datos en Docker."
    fi
else
    echo "❌ Error al hacer el dump de la base de datos remota."
fi

# 🗑️ Eliminar el archivo dump después de la importación
rm $DUMP_FILE