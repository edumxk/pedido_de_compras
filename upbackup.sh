#!/bin/bash

# Define as variáveis do contêiner MySQL
CONTAINER_NAME="pedido_de_compras-mysql-1"
DB_USER="root"
DB_PASS="Suporte#Kokar01"
DB_NAME="compras"

# Define o caminho para salvar o backup
BACKUP_DIR=""

FILENAME="backup_20240313184724.sql"

# Nome do arquivo de backup
BACKUP_FILE="$FILENAME"

# Executa o comando mysqldump dentro do contêiner
docker exec $CONTAINER_NAME mysqldump -u $DB_USER -p$DB_PASS $DB_NAME < $BACKUP_FILE

# Verifica se o backup foi criado com sucesso
if [ $? -eq 0 ]; then
    echo "Backup do banco de dados $DB_NAME foi criado com sucesso em $BACKUP_FILE"
else
    echo "Erro ao criar o backup do banco de dados $DB_NAME"