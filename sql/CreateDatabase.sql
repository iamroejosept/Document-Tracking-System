## Create Database
DROP DATABASE if exists DTS;
CREATE DATABASE DTS;
USE DTS;

## Create Document Category table
CREATE TABLE DocumentCategory (
  id_num int(50) unsigned ZEROFILL auto_increment,
  DocumentCategoryName varchar(255) NOT NULL,
  Description varchar(255) NOT NULL,
  
  PRIMARY KEY  (id_num)
);

## Create Files table
CREATE TABLE Files (
  id_num int(50) unsigned ZEROFILL auto_increment,
  office_id_num int(50) NOT NULL,
  Barcode varchar(255) NOT NULL,
  Category varchar(255) NOT NULL,
  Description varchar(255) NOT NULL,
  File varchar(255) NOT NULL,
  UploadedBy varchar(255) NOT NULL,
  Date varchar(255) NOT NULL,

  PRIMARY KEY  (id_num)
);

## Create Users table
CREATE TABLE Users (
  id_num int(50) unsigned ZEROFILL auto_increment,
  Fullname varchar(255) NOT NULL,
  Username varchar(255) NOT NULL,
  Password varchar(255) NOT NULL,
  AccessLevel varchar(255) NOT NULL,
  Status varchar(255) NOT NULL,

  PRIMARY KEY  (id_num)
);

## Create Office Settings table
CREATE TABLE OfficeSettings (
  office_id_num int(50) unsigned ZEROFILL auto_increment,
  Region varchar(255) NOT NULL,
  Province varchar(255) NOT NULL,
  cityMunicipality varchar(255) NOT NULL,

  PRIMARY KEY  (office_id_num)
);


## Create DEFAULT account for admin
INSERT INTO Users (Fullname, Username, Password, Status, AccessLevel) VALUES (
                        'John Doe', 'admin', 'xzSH+mfPQkSs', 'Activated', 'admin');

## Create DEFAULT account for staff
INSERT INTO Users (Fullname, Username, Password, Status, AccessLevel) VALUES (
                        'Jane Doe', 'staff', 'xzSH+mfPQkSs', 'Activated', 'staff');

## Insert Default Document Categories
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Voters Registration Records', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Voters Education / trainings', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'SOCE', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Reports of Election Contributions and Expenditures', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Reports of Election Contributions and Expenditures', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Non-Records (Half-Torn Ballots)', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Minutes of Voting', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Logbook of Certifications / others', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'List of Voters with Voting Records', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'List of Registered Voters', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Internal Communications', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Incoming Communications', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'EDCVL', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'DTRs / OTS', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Data Privacy Reports', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Correspondence (Routine)', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'COA Reports / Inventory', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Certificates of Canvass and Proclamation', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Certificates of Candidacy', '');
INSERT INTO DocumentCategory (DocumentCategoryName, Description) VALUES (
                        'Ballot Box Contents', '');   

INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Mimaropa', 'Palawan', 'Puerto Princesa City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Zamboanga Peninsula', 'Zamboanga del Sur', 'Pagadian City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Caraga', 'Agusan del Norte', 'Butuan City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cagayan Valley', 'Cagayan', 'Tuguegarao City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Eastern Visayas', 'Leyte', 'Tacloban City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Central Visayas', 'Cebu', 'Cebu City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Zamboanga Peninsula', 'Zamboanga Sibugay', 'Ipil');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Soccsksargen', 'South Cotabato', 'Koronadal City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cagayan Valley', 'Isabela', 'Ilagan City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Northern Mindanao', 'Bukidnon', 'Malaybalay City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Davao Region', 'Davao Oriental', 'Mati City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Ilocos Region', 'La Union', 'San Fernando City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Mimaropa', 'Romblon', 'Romblon');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Bicol Region', 'Sorsogon', 'Sorsogon City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Central Luzon', 'Zambales', 'Iba');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Eastern Visayas', 'Samar', 'Catbalogan City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Ilocos Region', 'Ilocos Norte', 'Laoag City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Northern Mindanao', 'Lanao del Norte', 'Iligan City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Zamboanga Peninsula', 'Zamboanga del Norte', 'Dipolog City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Cagayan Valley', 'Nueva Vizcaya', 'Bayombong');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Central Visayas', 'Bohol', 'Tagbilaran City');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Soccsksargen', 'Sarangani', 'Alabel');
INSERT INTO OfficeSettings (Region, Province, cityMunicipality) VALUES ('Caraga', 'Dinagat Islands', 'San Jose');
                                                                                                                                                                                                                                                                                                                                                                     