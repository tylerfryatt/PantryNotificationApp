use [234a_PHPeeps]

/*
********************************************************************************
04252019	Stan:	Created file, added tables sql
04262019			Added ROLE and USER_ROLE tables
********************************************************************************
*/

GO

CREATE TABLE "USER"
( user_id	INT				NOT NULL	IDENTITY	PRIMARY KEY
, username	NVARCHAR(40)	NOT NULL
, name		NVARCHAR(40)	NOT NULL
, title		NVARCHAR(40)	NOT NULL
, email		NVARCHAR(320)	NOT NULL
, hash NVARCHAR(255)		NOT NULL
); 

GO

CREATE TABLE "ROLE"
( role_id		INT				NOT NULL	IDENTITY	PRIMARY KEY
, role_title	NVARCHAR(40)	NOT NULL
);

CREATE TABLE "USER_ROLE"
( user_id	INT	NOT NULL
, role_id	INT	NOT NULL
);

ALTER TABLE USER_ROLE
ADD CONSTRAINT PK_USER_ROLE PRIMARY KEY (user_id, role_id),
	CONSTRAINT FK_USER_ROLE_USER FOREIGN KEY (user_id) REFERENCES "USER"(user_id),
	CONSTRAINT FK_USER_ROLE_ROLE FOREIGN KEY (role_id) REFERENCES ROLE(role_id);

GO

CREATE TABLE "LOG"
( record_id		INT			NOT NULL	IDENTITY	PRIMARY KEY
, user_id		INT			NOT NULL
, message		TEXT		NOT NULL
, date			DATETIME	NOT NULL
, sent_count	INT			NOT NULL
);

ALTER TABLE "LOG"
ADD CONSTRAINT FK_LOG_USER FOREIGN KEY (user_id) REFERENCES "USER"(user_id);

GO

CREATE TABLE "TEMPLATE"
( template_id	INT				NOT NULL	IDENTITY	PRIMARY KEY
, template_name	NVARCHAR(40)	NOT NULL
, template_body	TEXT			NOT NULL
);

