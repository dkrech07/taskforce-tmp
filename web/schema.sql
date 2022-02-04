CREATE DATABASE taskforce
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE taskforce;

CREATE TABLE categories (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name VARCHAR(128) NOT NULL,
    icon VARCHAR(128) NOT NULL
);

CREATE TABLE cities (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    city VARCHAR(128) NOT NULL,
    latitude VARCHAR(128) NOT NULL,
    longitude VARCHAR(128) NOT NULL
);

CREATE TABLE profiles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    address VARCHAR(128) NOT NULL,
    bd VARCHAR(128) NOT NULL,
    about TEXT,
    phone VARCHAR(128) NOT NULL,
    skype VARCHAR(128) NOT NULL,
    messanger VARCHAR(128),
    role INT,  
    city_id INT UNSIGNED,
    average_rating FLOAT UNSIGNED,
    avatar_link VARCHAR(128),
    FOREIGN KEY (city_id) REFERENCES cities(id)
);

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    email VARCHAR(128) NOT NULL,
    name VARCHAR(128) NOT NULL,
    password CHAR(64) NOT NULL,
    dt_add VARCHAR(128) NOT NULL,
    profile_id INT UNSIGNED,
    FOREIGN KEY (profile_id) REFERENCES profiles(id),
    UNIQUE INDEX email(email)
);

CREATE TABLE users_specializations (
    user_id INT UNSIGNED NOT NULL,
    specialization_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (user_id) REFERENCES profiles(id),
    FOREIGN KEY (specialization_id) REFERENCES categories(id)
);


CREATE TABLE tasks (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    category_id INT UNSIGNED NOT NULL,
    description TEXT,
    deadline TIMESTAMP,
    fin_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    name VARCHAR(128) NOT NULL,
    address VARCHAR(128) NOT NULL,
    budget INT UNSIGNED NOT NULL,
    latitude VARCHAR(128) NOT NULL,
    longitude VARCHAR(128) NOT NULL,
    status VARCHAR(128),
    customer_id INT UNSIGNED,
    executor_id INT UNSIGNED,
    city_id INT UNSIGNED,
    file_link VARCHAR(128),
    FOREIGN KEY (customer_id) REFERENCES users(id),
    FOREIGN KEY (executor_id) REFERENCES users(id),
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (city_id) REFERENCES cities(id)
);

CREATE TABLE opinions (
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    rate INT UNSIGNED NOT NULL,
    description TEXT,
    customer_id INT UNSIGNED NOT NULL,
    executor_id INT UNSIGNED NOT NULL,
    task_id INT UNSIGNED NOT NULL,
    rating INT UNSIGNED NOT NULL,
    FOREIGN KEY (customer_id) REFERENCES profiles(id),
    FOREIGN KEY (executor_id) REFERENCES profiles(id),
    FOREIGN KEY (task_id) REFERENCES tasks(id)
);

CREATE TABLE replies (
    dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    rate INT UNSIGNED NOT NULL,
    description TEXT,
    executor_id INT UNSIGNED NOT NULL,
    task_id INT UNSIGNED NOT NULL,
    FOREIGN KEY (executor_id) REFERENCES profiles(id),
    FOREIGN KEY (task_id) REFERENCES tasks(id)
);