CREATE TABLE User (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(255) NOT NULL,
                          email VARCHAR(255) NOT NULL,
                          password VARCHAR(255) NOT NULL,
                          avatar VARCHAR(255) DEFAULT NULL,
                          isAdmin BOOLEAN NOT NULL
);

CREATE TABLE Blindtest (
                           blindtest_id INT AUTO_INCREMENT PRIMARY KEY,
                           blindtest_name VARCHAR(255) NOT NULL,
                           blindtest_description VARCHAR(255),
                           blindtest_author INT NOT NULL,
                           CONSTRAINT fk_blindtest_author FOREIGN KEY (blindtest_author) REFERENCES user (id)
);

CREATE TABLE Blindtestsongs (
                            blindtestsongs_id INT AUTO_INCREMENT PRIMARY KEY,
                            blindtestsongs_url VARCHAR(255) NOT NULL,
                            blindtestsongs_answer VARCHAR(255) NOT NULL,
                            blindtest_id INT NOT NULL,
                            CONSTRAINT fk_blindtestsongs_blindtest FOREIGN KEY (blindtest_id) REFERENCES blindtest (blindtest_id)
);

CREATE TABLE Scoreboard (
                            scoreboard_id INT AUTO_INCREMENT PRIMARY KEY,
                            blindtest_id INT NOT NULL,
                            user_id INT NOT NULL,
                            scoreboard_score INT NOT NULL,
                            CONSTRAINT fk_scoreboard_blindtest FOREIGN KEY (blindtest_id) REFERENCES blindtest (blindtest_id),
                            CONSTRAINT fk_scoreboard_user FOREIGN KEY (user_id) REFERENCES user (id)
);