mysql -uroot -piu -e "CREATE DATABASE todolist;";
mysql -uroot -piu -e "GRANT ALL PRIVILEGES ON todolist.* TO todolist@localhost IDENTIFIED BY 'todolist';";
mysql -uroot -piu < ./Models/todolist.sql;
chmod -R 777 ./Files