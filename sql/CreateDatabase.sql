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
  FileType varchar(255) NOT NULL,
  FileName varchar(255) NOT NULL,
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
  Category varchar(255) NOT NULL,
  Username varchar(255) NOT NULL,
  Password varchar(255) NOT NULL,
  Status varchar(255) NOT NULL,

  PRIMARY KEY  (id_num)
);

## Create Office Settings table
CREATE TABLE OfficeSettings (
  id_num int(50) unsigned ZEROFILL auto_increment,
  Region varchar(255) NOT NULL,
  Province varchar(255) NOT NULL,
  cityMunicipality varchar(255) NOT NULL,

  PRIMARY KEY  (id_num)
);


## Create DEFAULT account for admin
INSERT INTO Users (Fullname, Category, Username, Password, Status) VALUES (
                        'John Doe', 'Admin', 'admin', '123456789', 'Active');

## Create DEFAULT account for staff
INSERT INTO Users (Fullname, Category, Username, Password, Status) VALUES (
                        'Jane Doe', 'Staff', 'staff', '123456789', 'Active');

