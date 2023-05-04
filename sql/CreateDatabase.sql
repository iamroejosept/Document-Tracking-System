## Create Database
DROP DATABASE if exists DOCUTRACE;
CREATE DATABASE DOCUTRACE;
USE DOCUTRACE;

## Create Document Category table
CREATE TABLE DocumentCategory (
  id_num int(50) unsigned ZEROFILL auto_increment,
  DocumentCategoryName varchar(255) DEFAULT NULL,
  Description varchar(255) DEFAULT NULL,
  Frequency enum("Monthly", "Quarterly", "Daily") DEFAULT NULL,
  DueDate varchar(255) DEFAULT NULL,
  ArchiveStatus varchar(255) DEFAULT 'Not Archived',
  
  PRIMARY KEY  (id_num)
);

## Create Files table
CREATE TABLE Files (
  id_num int(50) unsigned ZEROFILL auto_increment,
  office_id_num int(50) DEFAULT NULL,
  Barcode varchar(255) DEFAULT NULL,
  Category varchar(255) DEFAULT NULL,
  Description varchar(255) DEFAULT NULL,
  FileLocation varchar(255) DEFAULT NULL,
  File varchar(255) DEFAULT NULL,
  UploadedBy varchar(255) DEFAULT NULL,
  Date varchar(255) DEFAULT NULL,
  Remark enum("Submitted", "Not Submitted") DEFAULT NULL,
  ArchiveStatus varchar(255) DEFAULT 'Not Archived',

  PRIMARY KEY  (id_num)
);

## Create Users table
CREATE TABLE Users (
  users_id_num int(50) unsigned ZEROFILL auto_increment,
  ProfilePic varchar(255) DEFAULT 'default-profile.png',
  Fullname varchar(255) DEFAULT NULL,
  Username varchar(255) DEFAULT NULL,
  Password varchar(255) DEFAULT NULL,
  AccessLevel varchar(255) DEFAULT NULL,
  Status varchar(255) DEFAULT NULL,
  ArchiveStatus varchar(255) DEFAULT 'Not Archived',

  PRIMARY KEY  (users_id_num)
);

## Create Office Settings table
CREATE TABLE OfficeSettings (
  office_id_num int(50) unsigned ZEROFILL auto_increment,
  Region varchar(255) DEFAULT NULL,
  Province varchar(255) DEFAULT NULL,
  cityMunicipality varchar(255) DEFAULT NULL,
  ArchiveStatus varchar(255) DEFAULT 'Not Archived',

  PRIMARY KEY  (office_id_num)
);

## Create Document Logs table
CREATE TABLE Logs (
  logs_id_num int(50) unsigned ZEROFILL auto_increment,
  User varchar(255) DEFAULT NULL,
  LogType varchar(255) DEFAULT NULL,
  Description text DEFAULT NULL,
  Date DATETIME DEFAULT NULL,

  PRIMARY KEY  (logs_id_num)
);

## Create Logo table
CREATE TABLE Logo (
  logo_id_num int(50) unsigned ZEROFILL auto_increment,
  Logo_Picture varchar(255) DEFAULT NULL,
  Logo_Name varchar(255) DEFAULT NULL,

  PRIMARY KEY  (logo_id_num)
);

INSERT INTO Logo (Logo_Picture, Logo_Name) VALUES (
                        'default-logo.png', 'DOCUTRACE');

## Create DEFAULT account for admin
INSERT INTO Users (Fullname, Username, Password, Status, AccessLevel) VALUES (
                        'John Doe', 'admin', 'xzSH+mfPQkSs', 'Activated', 'Admin');

## Create DEFAULT account for staff
INSERT INTO Users (Fullname, Username, Password, Status, AccessLevel) VALUES (
                        'Jane Doe', 'staff', 'xzSH+mfPQkSs', 'Activated', 'Staff');

## Insert Default Document Categories
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Voters Registration Records', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Inventory of Supplies, ORs, and Cash Books', 'Quarterly', '', '2023-03-31');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Voters Education / trainings', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'SOCE', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Reports of Election Contributions and Expenditures', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Non-Records (Half-Torn Ballots)', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Minutes of Voting', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Logbook of Certifications / others', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'List of Voters with Voting Records', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'List of Registered Voters', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Internal Communications', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Incoming Communications', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'EDCVL', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'DTRs / OTS', 'Monthly', '', '2023-03-31');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Data Privacy Reports', 'Monthly', '', '2023-03-31');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'OT Accomplishment', 'Monthly', '', '2023-03-31');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Private Practice of COMELEC Lawyers (OEO Baguio City and OEO La Trinidad)', 'Monthly', '', '2023-03-31');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'RCD and RAAF', 'Monthly', '', '2023-03-31');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Correspondence (Routine)', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'COA Reports / Inventory', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Certificates of Canvass and Proclamation', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Certificates of Candidacy', '', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Voters Certification Report', 'Quarterly', '', '2023-03-31');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Voters Education Monitoring Report required by EID', 'Quarterly', '', '2023-03-28');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description, DueDate) VALUES (
                        'Ballot Box Contents', '', '', '');   

INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Atok');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Baguio');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Bakun');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Bokod');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Buguias');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Itogon');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Kabayan');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Kapangan');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Kibungan');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'La Trinidad');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Mankayan');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Sablan');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Tuba');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cordillera Administrative Region (CAR)', 'Benguet', 'Tublay');
                                                                                    