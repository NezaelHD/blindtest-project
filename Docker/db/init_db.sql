CREATE TABLE User (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(255) NOT NULL,
                          email VARCHAR(255) NOT NULL,
                          password VARCHAR(255) NOT NULL,
                          avatar VARCHAR(255) DEFAULT NULL,
                          isAdmin BOOLEAN NOT NULL
);

CREATE TABLE Blindtest (
                           id INT AUTO_INCREMENT PRIMARY KEY,
                           name VARCHAR(255) NOT NULL,
                           description VARCHAR(255),
                           author INT NOT NULL,
                           CONSTRAINT fk_blindtest_author FOREIGN KEY (author) REFERENCES user (id)
);

CREATE TABLE Blindtestsongs (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            url VARCHAR(255) NOT NULL,
                            answer VARCHAR(255) NOT NULL,
                            blindtest_id INT NOT NULL,
                            CONSTRAINT fk_blindtestsongs_blindtest_id FOREIGN KEY (blindtest_id) REFERENCES blindtest (id)
);

CREATE TABLE Scoreboard (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            blindtest_id INT NOT NULL,
                            user_id INT NOT NULL,
                            score INT NOT NULL,
                            CONSTRAINT fk_scoreboard_blindtest_id FOREIGN KEY (blindtest_id) REFERENCES blindtest (id),
                            CONSTRAINT fk_scoreboard_user_id FOREIGN KEY (user_id) REFERENCES user (id)
);

CREATE TABLE pwdReset (
                            id int PRIMARY KEY AUTO_INCREMENT NOT NULL,
                            user_email TEXT NOT NULL,
                            selector TEXT NOT NULL,
                            token LONGTEXT NOT NULL,
                            expires TEXT NOT NULL
);