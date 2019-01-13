mysql -uroot -piu -e "CREATE DATABASE todolist;";
mysql -uroot -piu -e "GRANT ALL PRIVILEGES ON todolist.* TO todolist@localhost IDENTIFIED BY 'todolist';";
mysql -uroot -piu < /var/www/html/todolist/Models/todolist.sql;
chmod -R 777 /var/www/html/todolist/Files