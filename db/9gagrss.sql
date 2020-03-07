-- ssh gagrss@9gagrss.xyz (f)(f)1..4

-- CREATE SCHEMA IF NOT EXISTS 9gagrss DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- USE 9gagrss;

-- DROP TABLE posts;
CREATE TABLE posts(
    id                MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    creation_date     TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    creationTs        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    external_id       CHAR(7) NOT NULL,
    channel           VARCHAR(100) NOT NULL, -- nsfw / girl etc ...
    url               VARCHAR(255) NOT NULL, -- the url on 9gag
    title             VARCHAR(255) NOT NULL,
    type              VARCHAR(100) NOT NULL, -- photo / animated ?
    nsfw              BOOLEAN NOT NULL,
    description_html  VARCHAR(255),
    tags              VARCHAR(255),
    content_url       VARCHAR(255) NOT NULL, -- the url to the best image or video
    PRIMARY KEY(id),
    UNIQUE url(url),
    INDEX creation_date(creation_date),
    INDEX channel(channel),
    INDEX channel_cd(channel, creation_date)
) ENGINE myisam DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

--  ALTER TABLE posts ADD COLUMN creationTs        TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() AFTER creation_date;
