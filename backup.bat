@echo off
set TIMESTAMP=%DATE:~6,4%-%DATE:~3,2%-%DATE:~0,2%_%TIME:~0,2%%TIME:~3,2%
set TIMESTAMP=%TIMESTAMP: =0%
set BACKUP_DIR=C:\xampp\htdocs\smartSchool\backups
set MYSQL_BIN=C:\xampp\mysql\bin\mysqldump.exe
set DB_NAME=smartschool
set DB_USER=root
set DB_PASS=

if not exist %BACKUP_DIR% (
    mkdir %BACKUP_DIR%
)

"%MYSQL_BIN%" -u %DB_USER% -p%DB_PASS% %DB_NAME% > "%BACKUP_DIR%\%DB_NAME%_backup_%TIMESTAMP%.sql"

echo Backup concluído com sucesso em:
echo %BACKUP_DIR%\%DB_NAME%_backup_%TIMESTAMP%.sql
pause
