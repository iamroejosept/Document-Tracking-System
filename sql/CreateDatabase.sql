## Create Database
DROP DATABASE if exists DOCUTRACE;
CREATE DATABASE DOCUTRACE;
USE DOCUTRACE;

## Create Document Category table
CREATE TABLE DocumentCategory (
  id_num int(50) unsigned ZEROFILL auto_increment,
  DocumentCategoryName varchar(255) DEFAULT NULL,
  Description varchar(255) DEFAULT NULL,
  Frequency enum("Monthly", "Quarterly", "Daily"),
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
  Remark enum("Submitted", "Not Submitted"),
  ArchiveStatus varchar(255) DEFAULT 'Not Archived',

  PRIMARY KEY  (id_num)
);

## Create Users table
CREATE TABLE Users (
  users_id_num int(50) unsigned ZEROFILL auto_increment,
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
  Province varchar(255) DEFAULT NULL,
  cityMunicipality varchar(255) DEFAULT NULL,
  ArchiveStatus varchar(255) DEFAULT 'Not Archived',

  PRIMARY KEY  (office_id_num)
);


## Create DEFAULT account for admin
INSERT INTO Users (Fullname, Username, Password, Status, AccessLevel) VALUES (
                        'John Doe', 'admin', 'xzSH+mfPQkSs', 'Activated', 'Admin');

## Create DEFAULT account for staff
INSERT INTO Users (Fullname, Username, Password, Status, AccessLevel) VALUES (
                        'Jane Doe', 'staff', 'xzSH+mfPQkSs', 'Activated', 'Staff');

## Insert Default Document Categories
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Voters Registration Records', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Inventory of Supplies, ORs, and Cash Books', 'Quarterly', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Voters Education / trainings', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'SOCE', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Reports of Election Contributions and Expenditures', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Non-Records (Half-Torn Ballots)', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Minutes of Voting', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Logbook of Certifications / others', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'List of Voters with Voting Records', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'List of Registered Voters', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Internal Communications', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Incoming Communications', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'EDCVL', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'DTRs / OTS', 'Monthly', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Data Privacy Reports', 'Monthly', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'OT Accomplishment', 'Monthly', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Private Practice of COMELEC Lawyers (OEO Baguio City and OEO La Trinidad)', 'Monthly', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'RCD and RAAF', 'Monthly', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Correspondence (Routine)', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'COA Reports / Inventory', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Certificates of Canvass and Proclamation', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Certificates of Candidacy', '', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Voters Certification Report', 'Quarterly', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Voters Education Monitoring Report required by EID', 'Quarterly', '');
INSERT INTO DocumentCategory (DocumentCategoryName,Frequency, Description) VALUES (
                        'Ballot Box Contents', '', '');   

INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Atok');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Baguio');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Bakun');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Bokod');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Buguias');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Itogon');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Kabayan');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Kapangan');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Kibungan');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'La Trinidad');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Mankayan');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Sablan');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Tuba');
INSERT INTO OfficeSettings (Province, cityMunicipality) VALUES ('Benguet', 'Tublay');
                                                                                    