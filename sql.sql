-- DROP TABLE board_row;
-- DROP TABLE board;
-- DROP TABLE payee;
-- DROP TABLE payer;




--Create all tables
CREATE TABLE payer (
    user_name   VARCHAR(32) UNIQUE NOT NULL,
    name        VARCHAR(255) NOT NULL,
    PRIMARY KEY (user_name)
);

CREATE TABLE payee (
    id      INT NOT NULL auto_increment,
    name    VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE board (
    id          INT NOT NULL auto_increment,
    name        VARCHAR(255) NOT NULL,
    payer_id    VARCHAR(32) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (payer_id) REFERENCES payer (user_name)
);

CREATE TABLE board_row (
    id          INT NOT NULL auto_increment,
    board_id    INT NOT NULL,
    payee_id    INT NOT NULL,
    january     BOOLEAN,
    february    BOOLEAN,
    march       BOOLEAN,
    april       BOOLEAN,
    may         BOOLEAN,
    june        BOOLEAN,
    july        BOOLEAN,
    august      BOOLEAN,
    september   BOOLEAN,
    october     BOOLEAN,
    november    BOOLEAN,
    december    BOOLEAN,
    PRIMARY KEY (id),
    FOREIGN KEY (board_id) REFERENCES board (id),
    FOREIGN KEY (payee_id) REFERENCES payee (id)
);


-- Make some users
INSERT INTO `payer`(`user_name`, `name`) VALUES ('ccatura', 'Charles Catura');
INSERT INTO `payer`(`user_name`, `name`) VALUES ('bbatura', 'Barles Batura');
INSERT INTO `payer`(`user_name`, `name`) VALUES ('ggatura', 'Gharles Gatura');
INSERT INTO `payer`(`user_name`, `name`) VALUES ('rratura', 'Rharles Ratura');


-- Make some payees
INSERT INTO `payee`(`name`) VALUES ('Capital One');
INSERT INTO `payee`(`name`) VALUES ('Capital Two');
INSERT INTO `payee`(`name`) VALUES ('Crapital Crap');
INSERT INTO `payee`(`name`) VALUES ('A1 Carwash');


-- Make some boards
INSERT INTO `board`(`name`, `payer_id`) VALUES ('2023', 'ccatura');
INSERT INTO `board`(`name`, `payer_id`) VALUES ('2020', 'bbatura');
INSERT INTO `board`(`name`, `payer_id`) VALUES ('2022', 'rratura');
INSERT INTO `board`(`name`, `payer_id`) VALUES ('2023', 'ggatura');


-- Make some rows
INSERT INTO `board_row`(`board_id`, `payee_id`, `january`, `february`, `july`, `october`) VALUES ('1', '1', true, true, true, true);
INSERT INTO `board_row`(`board_id`, `payee_id`, `january`, `march`, `september`, `october`) VALUES ('1', '2', true, true, true, true);
INSERT INTO `board_row`(`board_id`, `payee_id`, `february`, `april`, `may`, `june`) VALUES ('2', '4', true, true, true, true);
INSERT INTO `board_row`(`board_id`, `payee_id`, `february`, `april`, `may`, `june`) VALUES ('2', '2', true, true, true, true);
INSERT INTO `board_row`(`board_id`, `payee_id`, `march`, `july`, `october`, `november`) VALUES ('3', '3', true, true, true, true);
INSERT INTO `board_row`(`board_id`, `payee_id`, `march`, `july`, `october`, `november`) VALUES ('4', '3', true, true, true, true);



-- Select all of board 1's records
SELECT board.name, payee.name, board_row.january, board_row.february, board_row.march, board_row.april, board_row.may, board_row.june, board_row.july, board_row.august, board_row.september, board_row.october, board_row.november, board_row.december FROM board_row
JOIN payee ON board_row.payee_id = payee.id
JOIN board ON board.id = 1
WHERE board.id = board_row.board_id;
