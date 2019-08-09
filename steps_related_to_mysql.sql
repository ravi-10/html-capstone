-- creating users table with specified fields
CREATE TABLE users(
	user_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	first_name VARCHAR(50) NOT NULL,
	last_name VARCHAR(50) NOT NULL,
	street VARCHAR(255) NOT NULL,
	city VARCHAR(50) NOT NULL,
	postal_code CHAR(6) NOT NULL,
	province VARCHAR(50) NOT NULL,
	country VARCHAR(50) NOT NULL,
	phone VARCHAR(20) NOT NULL,
	email VARCHAR(100) NOT NULL,
	password VARCHAR(255) NOT NULL,
	role ENUM('admin', 'blogger', 'customer') NOT NULL DEFAULT 'customer',
	created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	updated_at DATETIME
);

DESC users;
+-------------+------------------------------------+------+-----+-------------------+----------------+
| Field       | Type                               | Null | Key | Default           | Extra          |
+-------------+------------------------------------+------+-----+-------------------+----------------+
| user_id     | int(11)                            | NO   | PRI | NULL              | auto_increment |
| first_name  | varchar(50)                        | NO   |     | NULL              |                |
| last_name   | varchar(50)                        | NO   |     | NULL              |                |
| street      | varchar(255)                       | NO   |     | NULL              |                |
| city        | varchar(50)                        | NO   |     | NULL              |                |
| postal_code | char(6)                            | NO   |     | NULL              |                |
| province    | varchar(50)                        | NO   |     | NULL              |                |
| country     | varchar(50)                        | NO   |     | NULL              |                |
| phone       | varchar(20)                        | NO   |     | NULL              |                |
| email       | varchar(100)                       | NO   |     | NULL              |                |
| password    | varchar(255)                       | NO   |     | NULL              |                |
| role        | enum('admin','blogger','customer') | NO   |     | customer          |                |
| created_at  | datetime                           | NO   |     | CURRENT_TIMESTAMP |                |
| updated_at  | datetime                           | YES  |     | NULL              |                |
+-------------+------------------------------------+------+-----+-------------------+----------------+