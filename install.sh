#Comando para crear la BD
mysql -uroot -piu -e "CREATE DATABASE todolist;";
#Comando para los privilegios en la BD
mysql -uroot -piu -e "GRANT ALL PRIVILEGES ON todolist.* TO todolist@localhost IDENTIFIED BY 'todolist';";
#Indicamos donde esta el archivo sql en la carpeta del proyecto
mysql -uroot -piu < ./Models/todolist.sql;
#Todos los permisos en el directorio Files
chmod -R 777 ./Files