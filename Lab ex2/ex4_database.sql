CREATE TABLE roles(
 role_id INT AUTO_INCREMENT PRIMARY KEY,
 role_name VARCHAR(50),
 role_inherit INT NULL
);
CREATE TABLE permissions(
 permission_id INT AUTO_INCREMENT PRIMARY KEY,
 permission_name VARCHAR(50)
);
CREATE TABLE users(
 user_id INT AUTO_INCREMENT PRIMARY KEY,
 username VARCHAR(50),
 role_id INT
);
CREATE TABLE role_permissions(
 role_id INT,
 permission_id INT,
 PRIMARY KEY(role_id,permission_id)
);