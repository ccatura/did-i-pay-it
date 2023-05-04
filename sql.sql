DROP TABLE board;
DROP TABLE board_row;
DROP TABLE payee;
DROP TABLE payer;




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

CREATE TABLE board_row (
    id          INT NOT NULL auto_increment,
    payer_id    VARCHAR(255) NOT NULL,
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
    FOREIGN KEY (payee_id) REFERENCES payee (id)
);

CREATE TABLE board (
    id              INT NOT NULL auto_increment,
    name            VARCHAR(255) NOT NULL,
    payer_id        VARCHAR(32) NOT NULL,
    board_row_id    INT UNIQUE NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (payer_id) REFERENCES payer (user_name),
    FOREIGN KEY (board_row_id) REFERENCES board_row (id)
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


-- Make some rows
INSERT INTO `board_row`(`payer_id`, `payee_id`, `january`, `february`, `july`, `october`) VALUES ('ccatura', '1', true, true, true, true);
INSERT INTO `board_row`(`payer_id`, `payee_id`, `january`, `march`, `september`, `october`) VALUES ('ccatura', '2', true, true, true, true);
INSERT INTO `board_row`(`payer_id`, `payee_id`, `february`, `april`, `may`, `june`) VALUES ('bbatura', '4', true, true, true, true);
INSERT INTO `board_row`(`payer_id`, `payee_id`, `february`, `april`, `may`, `june`) VALUES ('ggatura', '2', true, true, true, true);
INSERT INTO `board_row`(`payer_id`, `payee_id`, `march`, `july`, `october`, `november`) VALUES ('rratura', '3', true, true, true, true);
INSERT INTO `board_row`(`payer_id`, `payee_id`, `march`, `july`, `october`, `november`) VALUES ('ccatura', '3', true, true, true, false);
INSERT INTO `board_row`(`payer_id`, `payee_id`, `january`, `february`, `march`, `april`, `may`, `june`, `july`, `august`, `september`, `october`, `november`, `december`) VALUES ('rratura', '2', true, true, true, true, false, false, true, false, true, true, false, true);
INSERT INTO `board_row`(`payer_id`, `payee_id`, `january`, `february`, `march`, `april`, `may`, `june`, `july`, `august`, `september`, `october`, `november`, `december`) VALUES ('ggatura', '4', true, false, true, true, true, true, true, false, true, false, false, true);



-- Make some boards
INSERT INTO `board`(`name`, `payer_id`, `board_row_id`) VALUES ('2023', 'ccatura', '1');
INSERT INTO `board`(`name`, `payer_id`, `board_row_id`) VALUES ('2020', 'bbatura', '2');
INSERT INTO `board`(`name`, `payer_id`, `board_row_id`) VALUES ('2022', 'rratura', '3');
INSERT INTO `board`(`name`, `payer_id`, `board_row_id`) VALUES ('2023', 'ggatura', '4');
INSERT INTO `board`(`name`, `payer_id`, `board_row_id`) VALUES ('2023', 'ggatura', '5');






-- Joins board row and payer to show only results with ccatura
SELECT *
FROM board_row
INNER JOIN payer
ON board_row.payer_id = payer.user_name
WHERE board_row.payer_id = 'ccatura'

-- Joins all tables on board #1 - it may be messed up a little, but for the most part, it works
SELECT *
FROM board_row
INNER JOIN payer
ON board_row.payer_id = payer.user_name
INNER JOIN board
ON board.payer_id = payer.user_name
INNER JOIN payee
ON payee.id = board_row.payee_id
WHERE board.id = 1


-- with all the months
SELECT 	board.name,
		payer.user_name,
		payee.name,
		board_row.january,
        board_row.february,
        board_row.march,
        board_row.april,
        board_row.may,
        board_row.june,
        board_row.july,
        board_row.august,
        board_row.september,
        board_row.october,
        board_row.november,
        board_row.december
FROM board_row
INNER JOIN payer
ON board_row.payer_id = payer.user_name
INNER JOIN board
ON board.payer_id = payer.user_name
INNER JOIN payee
ON payee.id = board_row.payee_id
WHERE board.id = 1

