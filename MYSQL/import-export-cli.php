// Export Import All Databases
Export:
mysqldump -u USERNAME -p -v --all-databases > alldb.sql

Import:
mysql -u USERNAME -p -v < alldb.sql

Add --verbose or -v options to see how the dump is progressing.

==============================
// Export Import One Database
Export:
mysqldump -u USERNAME -p -v DBNAME> ExportSqlFile.sql

Import:
mysql -u USERNAME -p -v NEWDBNAME < ExportedSqlFile.sql
