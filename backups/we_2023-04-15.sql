-- MariaDB dump 10.19  Distrib 10.4.25-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: docutrace
-- ------------------------------------------------------
-- Server version	10.4.25-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `documentcategory`
--

DROP TABLE IF EXISTS `documentcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentcategory` (
  `id_num` int(50) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `DocumentCategoryName` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Frequency` enum('Monthly','Quarterly','Daily') DEFAULT NULL,
  `ArchiveStatus` varchar(255) DEFAULT 'Not Archived',
  PRIMARY KEY (`id_num`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentcategory`
--

LOCK TABLES `documentcategory` WRITE;
/*!40000 ALTER TABLE `documentcategory` DISABLE KEYS */;
INSERT INTO `documentcategory` VALUES (00000000000000000000000000000000000000000000000001,'Voters Registration Records','','','Not Archived'),(00000000000000000000000000000000000000000000000002,'Inventory of Supplies, ORs, and Cash Books','','Quarterly','Not Archived'),(00000000000000000000000000000000000000000000000003,'Voters Education / trainings','','','Not Archived'),(00000000000000000000000000000000000000000000000004,'SOCE','','','Not Archived'),(00000000000000000000000000000000000000000000000005,'Reports of Election Contributions and Expenditures','','','Not Archived'),(00000000000000000000000000000000000000000000000006,'Non-Records (Half-Torn Ballots)','','','Not Archived'),(00000000000000000000000000000000000000000000000007,'Minutes of Voting','','','Not Archived'),(00000000000000000000000000000000000000000000000008,'Logbook of Certifications / others','','','Not Archived'),(00000000000000000000000000000000000000000000000009,'List of Voters with Voting Records','','','Not Archived'),(00000000000000000000000000000000000000000000000010,'List of Registered Voters','','','Not Archived'),(00000000000000000000000000000000000000000000000011,'Internal Communications','','','Not Archived'),(00000000000000000000000000000000000000000000000012,'Incoming Communications','','','Not Archived'),(00000000000000000000000000000000000000000000000013,'EDCVL','','','Not Archived'),(00000000000000000000000000000000000000000000000014,'DTRs / OTS','','Monthly','Not Archived'),(00000000000000000000000000000000000000000000000015,'Data Privacy Reports','','Monthly','Not Archived'),(00000000000000000000000000000000000000000000000016,'OT Accomplishment','','Monthly','Not Archived'),(00000000000000000000000000000000000000000000000017,'Private Practice of COMELEC Lawyers (OEO Baguio City and OEO La Trinidad)','','Monthly','Not Archived'),(00000000000000000000000000000000000000000000000018,'RCD and RAAF','','Monthly','Not Archived'),(00000000000000000000000000000000000000000000000019,'Correspondence (Routine)','','','Not Archived'),(00000000000000000000000000000000000000000000000020,'COA Reports / Inventory','','','Not Archived'),(00000000000000000000000000000000000000000000000021,'Certificates of Canvass and Proclamation','','','Not Archived'),(00000000000000000000000000000000000000000000000022,'Certificates of Candidacy','','','Not Archived'),(00000000000000000000000000000000000000000000000023,'Voters Certification Report','','Quarterly','Not Archived'),(00000000000000000000000000000000000000000000000024,'Voters Education Monitoring Report required by EID','','Quarterly','Not Archived'),(00000000000000000000000000000000000000000000000025,'Ballot Box Contents','','Quarterly','Not Archived'),(00000000000000000000000000000000000000000000000026,'asd','asdsd','Quarterly','Archived'),(00000000000000000000000000000000000000000000000027,'sad','asdkkkk','Monthly','Archived'),(00000000000000000000000000000000000000000000000028,'asdasd','asdasd111','Monthly','Archived'),(00000000000000000000000000000000000000000000000029,'sd','wew','Monthly','Archived'),(00000000000000000000000000000000000000000000000030,'sad','sdsd','Monthly','Archived'),(00000000000000000000000000000000000000000000000031,'1','2','Monthly','Archived'),(00000000000000000000000000000000000000000000000032,'sadasd','asds','Monthly','Archived'),(00000000000000000000000000000000000000000000000033,'asdas','adas','Monthly','Archived');
/*!40000 ALTER TABLE `documentcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id_num` int(50) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `office_id_num` int(50) DEFAULT NULL,
  `Barcode` varchar(255) DEFAULT NULL,
  `Category` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `FileLocation` varchar(255) DEFAULT NULL,
  `File` varchar(255) DEFAULT NULL,
  `UploadedBy` varchar(255) DEFAULT NULL,
  `Date` varchar(255) DEFAULT NULL,
  `Remark` enum('Submitted','Not Submitted') DEFAULT NULL,
  `ArchiveStatus` varchar(255) DEFAULT 'Not Archived',
  PRIMARY KEY (`id_num`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (00000000000000000000000000000000000000000000000001,2,'','OT Accomplishment','','','rose20001.pdf','00000000000000000000000000000000000000000000000001','2023-04-27','Submitted','Not Archived'),(00000000000000000000000000000000000000000000000002,11,'','EDCVL','','','rose20001.pdf','00000000000000000000000000000000000000000000000001','2023-04-06','Not Submitted','Archived'),(00000000000000000000000000000000000000000000000003,7,'','Incoming Communications','','','Mejia, Roe Josept L. - CV.pdf','00000000000000000000000000000000000000000000000001','2023-04-14','Submitted','Archived'),(00000000000000000000000000000000000000000000000004,11,'123','Incoming Communications','','','Abstract.docx','00000000000000000000000000000000000000000000000001','2023-04-28','Submitted','Not Archived'),(00000000000000000000000000000000000000000000000005,8,'','Incoming Communications','','','shutdown-icon-32.ico','00000000000000000000000000000000000000000000000001','2023-04-08','Not Submitted','Not Archived'),(00000000000000000000000000000000000000000000000006,11,'','EDCVL','','','Abstract.docx','00000000000000000000000000000000000000000000000001','2023-04-09','Not Submitted','Archived'),(00000000000000000000000000000000000000000000000007,11,'','OT Accomplishment','','','pdftoimage.zip','00000000000000000000000000000000000000000000000001','2023-04-09','Submitted','Not Archived');
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `logs_id_num` int(50) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `User` varchar(255) DEFAULT NULL,
  `LogType` varchar(255) DEFAULT NULL,
  `Description` text DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`logs_id_num`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (00000000000000000000000000000000000000000000000001,'00000000000000000000000000000000000000000000000001','Commit','Updated a File: <br>Barcode from 131 to 131 <br> Category from OT Accomplishment to OT Accomplishment <br> office_id_num from 11 to 11 <br> Date Uploaded from 2023-04-14 to 2023-04-14 <br> Description from  to asd <br> File Location from  to sds <br> Remark from Submitted to Submitted <br> ','2023-04-14 13:54:00'),(00000000000000000000000000000000000000000000000002,'00000000000000000000000000000000000000000000000001','Commit','Updated a File: <br>Barcode from 131 to 131 <br> Category from OT Accomplishment to OT Accomplishment <br> Province from Benguet to Benguet <br> City / Municipality from Mankayan to Baguio <br> Date Uploaded from 2023-04-14 to 2023-04-14 <br> Description from asd to asd <br> File Location from sds to sds <br> Remark from Submitted to Submitted <br> ','2023-04-14 14:02:00'),(00000000000000000000000000000000000000000000000003,'00000000000000000000000000000000000000000000000001','Commit','Commited a File: <br>File from CreateDatabase.sql to rose20001.pdf <br> Barcode from 131 to 131 <br> Category from OT Accomplishment to OT Accomplishment <br> Province from  to Benguet <br> City / Municipality from  to Baguio <br> Date Uploaded from 2023-04-14 to 2023-04-14 <br> Description from asd to asd <br> File Location from sds to sds <br> Remark from Submitted to Submitted <br> ','2023-04-14 14:09:00'),(00000000000000000000000000000000000000000000000004,'00000000000000000000000000000000000000000000000001','Commit','Commited a File: <br>File from rose20001.pdf to MARIL U.png <br> Barcode from 131 to 131 <br> Category from OT Accomplishment to OT Accomplishment <br> Province from  to Benguet <br> City / Municipality from  to Baguio <br> Date Uploaded from 2023-04-14 to 2023-04-14 <br> Description from asd to asd <br> File Location from sds to sds <br> Remark from Submitted to Submitted <br> ','2023-04-14 14:12:00'),(00000000000000000000000000000000000000000000000005,'00000000000000000000000000000000000000000000000001','Commit','Commited a File: <br>File from MARIL U.png to Basketball and Volleyball Awarding Night 2022.png <br> Barcode from 131 to 131 <br> Category from OT Accomplishment to OT Accomplishment <br> Province from  to Benguet <br> City / Municipality from  to Atok <br> Date Uploaded from 2023-04-14 to 2023-04-14 <br> Description from asd to asd <br> File Location from sds to sds <br> Remark from Submitted to Submitted <br> ','2023-04-14 14:14:00'),(00000000000000000000000000000000000000000000000006,'00000000000000000000000000000000000000000000000001','Commit','Commited a File: <br>Barcode from 131 to 131 <br> Category from OT Accomplishment to OT Accomplishment <br> Province from Benguet to Benguet <br> City / Municipality from Atok to Atok <br> Date Uploaded from 2023-04-14 to 2023-04-14 <br> Description from asd to asd <br> File Location from sds to sds <br> Remark from Submitted to Not Submitted <br> ','2023-04-14 14:18:00'),(00000000000000000000000000000000000000000000000007,'00000000000000000000000000000000000000000000000001','Commit','Commited a File: <br>File from Basketball and Volleyball Awarding Night 2022.png to IT week certificate.png <br> Barcode from 131 to 131 <br> Category from OT Accomplishment to OT Accomplishment <br> Province from Benguet to Benguet <br> City / Municipality from Atok to Atok <br> Date Uploaded from 2023-04-14 to 2023-04-14 <br> Description from asd to asd <br> File Location from sds to sds <br> Remark from Not Submitted to Not Submitted <br> ','2023-04-14 14:18:00'),(00000000000000000000000000000000000000000000000008,'00000000000000000000000000000000000000000000000001','Commit','Commited a Document Category: <br>Document Category from Data Privacy Reports to Data Privacy Reports <br> Description from  to asd <br> Frequency from Monthly to Monthly <br> ','2023-04-14 19:47:00'),(00000000000000000000000000000000000000000000000009,'00000000000000000000000000000000000000000000000001','Commit','Commited a File: <br>File from IT week certificate.png to IT week certificate.png <br> Barcode from 131 to 131 <br> Category from OT Accomplishment to OT Accomplishment <br> Province from Benguet to Benguet <br> City / Municipality from Atok to Atok <br> Date Uploaded from 2023-04-14 to 2023-04-14 <br> Description from asd to asd <br> File Location from sds to sds <br> Remark from Not Submitted to Submitted <br> ','2023-04-14 19:49:00'),(00000000000000000000000000000000000000000000000010,'00000000000000000000000000000000000000000000000001','Commit','Commited a Document Category: <br>Document Category from Data Privacy Reports to Data Privacy Reports <br> Description from asd to  <br> Frequency from Monthly to Monthly <br> ','2023-04-14 19:55:00'),(00000000000000000000000000000000000000000000000011,'00000000000000000000000000000000000000000000000001','Commit','Commited an Office Category: <br>Province from Benguet to Benguet <br> City / Municipality from Baguio to Baguiok <br> ','2023-04-14 19:55:00'),(00000000000000000000000000000000000000000000000012,'00000000000000000000000000000000000000000000000001','Commit','Commited an Office Category: <br>Province from Benguet to Benguet <br> City / Municipality from Baguiok to Baguio <br> ','2023-04-14 19:55:00'),(00000000000000000000000000000000000000000000000013,'00000000000000000000000000000000000000000000000001','Commit','Commited a User: <br>Full Name from Jane Doe to Jane Doe <br> Username from staff to staff1 <br> Access Level from Staff to Staff <br> Status from Activated to Activated <br> ','2023-04-14 20:38:00'),(00000000000000000000000000000000000000000000000014,'00000000000000000000000000000000000000000000000001','Commit','Commited a User: <br>Full Name from Jane Doe to Jane Doe <br> Username from staff1 to staff <br> Access Level from Staff to Staff <br> Status from Activated to Activated <br> ','2023-04-14 20:38:00'),(00000000000000000000000000000000000000000000000015,'00000000000000000000000000000000000000000000000001','Add','Added a Document Category: <br>Document Category: sad<br> Description: asd<br> Frequency: Monthly<br> ','2023-04-15 10:14:00'),(00000000000000000000000000000000000000000000000016,'00000000000000000000000000000000000000000000000001','Add','Added an Office Category: <br>Province: Benguet<br> City / Municipality: sss<br> ','2023-04-15 10:18:00'),(00000000000000000000000000000000000000000000000017,'00000000000000000000000000000000000000000000000001','Add','Added a User: <br>Full Name: asd<br> Username: asd<br> Access Level: Admin<br> Status: Activated<br> ','2023-04-15 10:20:00'),(00000000000000000000000000000000000000000000000018,'00000000000000000000000000000000000000000000000001','Add','Added a File: <br>','2023-04-15 10:26:00'),(00000000000000000000000000000000000000000000000019,'00000000000000000000000000000000000000000000000001','Add','Added a File: <br>File: METHODOLOGY.docx<br> Barcode: 1234<br> Category: Voters Education / trainings<br> Province: Benguet<br> City / Municipality: Tublay<br> Date Uploaded: 2023-04-15<br> Description: asd<br> File Location: asd<br> Remark: Submitted<br> ','2023-04-15 10:28:00'),(00000000000000000000000000000000000000000000000023,'00000000000000000000000000000000000000000000000001','Archive','Archived a document category with a category name of Ballot Box Contents','2023-04-15 11:10:00'),(00000000000000000000000000000000000000000000000024,'00000000000000000000000000000000000000000000000001','Archive','Archived a document category with a category name of 1','2023-04-15 11:10:00'),(00000000000000000000000000000000000000000000000025,'00000000000000000000000000000000000000000000000001','Commit','Commited a File: <br>File from Abstract.docx to Abstract.docx <br> Barcode from  to 123 <br> Category from Incoming Communications to Incoming Communications <br> Province from Benguet to Benguet <br> City / Municipality from Mankayan to Mankayan <br> Date Uploaded from 2023-04-28 to 2023-04-28 <br> Description from  to  <br> File Location from  to  <br> Remark from Submitted to Submitted <br> ','2023-04-15 11:12:00'),(00000000000000000000000000000000000000000000000026,'00000000000000000000000000000000000000000000000001','Archive','Archived a file with a barcode of 123','2023-04-15 11:12:00'),(00000000000000000000000000000000000000000000000027,'00000000000000000000000000000000000000000000000001','Archive','Archived an office category with a province of Benguet and city / municipality of Baguio','2023-04-15 11:16:00'),(00000000000000000000000000000000000000000000000028,'00000000000000000000000000000000000000000000000001','Archive','Archived a user with a username of staff','2023-04-15 11:16:00'),(00000000000000000000000000000000000000000000000029,'00000000000000000000000000000000000000000000000001','Restore','Restored a document category with a category name of 1','2023-04-15 11:18:00'),(00000000000000000000000000000000000000000000000030,'00000000000000000000000000000000000000000000000001','Archive','Archived a document category with a category name of 1','2023-04-15 11:18:00'),(00000000000000000000000000000000000000000000000031,'00000000000000000000000000000000000000000000000001','Restore','Restored an office category with a province of Benguet and city / municipality of asdll','2023-04-15 11:19:00'),(00000000000000000000000000000000000000000000000032,'00000000000000000000000000000000000000000000000001','Archive','Archived an office category with a province of Benguet and city / municipality of asdll','2023-04-15 11:20:00'),(00000000000000000000000000000000000000000000000033,'00000000000000000000000000000000000000000000000001','Archive','Archived a file with a barcode of 123','2023-04-15 11:20:00'),(00000000000000000000000000000000000000000000000034,'00000000000000000000000000000000000000000000000001','Restore','Restored a file with a barcode of 123','2023-04-15 11:20:00'),(00000000000000000000000000000000000000000000000035,'00000000000000000000000000000000000000000000000001','Restore','Restored a user with a username of aaa','2023-04-15 11:20:00'),(00000000000000000000000000000000000000000000000036,'00000000000000000000000000000000000000000000000001','Archive','Archived a user with a username of aaa','2023-04-15 11:21:00'),(00000000000000000000000000000000000000000000000037,'00000000000000000000000000000000000000000000000001','Commit','Commited a User: <br>Full Name from Jane Doe to Jane Doe <br> Username from staff to staff <br> Access Level from Staff to Staff <br> Status from Activated to Disabled <br> ','2023-04-15 11:35:00'),(00000000000000000000000000000000000000000000000038,'00000000000000000000000000000000000000000000000001','Commit','Commited a User: <br>Full Name from Jane Doe to Jane Doe <br> Username from staff to staff <br> Access Level from Staff to Staff <br> Status from Disabled to Activated <br> ','2023-04-15 11:35:00');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `officesettings`
--

DROP TABLE IF EXISTS `officesettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `officesettings` (
  `office_id_num` int(50) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Province` varchar(255) DEFAULT NULL,
  `cityMunicipality` varchar(255) DEFAULT NULL,
  `ArchiveStatus` varchar(255) DEFAULT 'Not Archived',
  PRIMARY KEY (`office_id_num`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `officesettings`
--

LOCK TABLES `officesettings` WRITE;
/*!40000 ALTER TABLE `officesettings` DISABLE KEYS */;
INSERT INTO `officesettings` VALUES (00000000000000000000000000000000000000000000000001,'Benguet','Atok','Not Archived'),(00000000000000000000000000000000000000000000000002,'Benguet','Baguio','Not Archived'),(00000000000000000000000000000000000000000000000003,'Benguet','Bakun','Not Archived'),(00000000000000000000000000000000000000000000000004,'Benguet','Bokod','Not Archived'),(00000000000000000000000000000000000000000000000005,'Benguet','Buguias','Not Archived'),(00000000000000000000000000000000000000000000000006,'Benguet','Itogon','Not Archived'),(00000000000000000000000000000000000000000000000007,'Benguet','Kabayan','Not Archived'),(00000000000000000000000000000000000000000000000008,'Benguet','Kapangan','Not Archived'),(00000000000000000000000000000000000000000000000009,'Benguet','Kibungan','Not Archived'),(00000000000000000000000000000000000000000000000010,'Benguet','La Trinidad','Not Archived'),(00000000000000000000000000000000000000000000000011,'Benguet','Mankayan','Not Archived'),(00000000000000000000000000000000000000000000000012,'Benguet','Sablan','Not Archived'),(00000000000000000000000000000000000000000000000013,'Benguet','Tuba','Not Archived'),(00000000000000000000000000000000000000000000000014,'Benguet','Tublay','Not Archived'),(00000000000000000000000000000000000000000000000015,'Benguet','asdll','Archived'),(00000000000000000000000000000000000000000000000016,'Benguet','jjj000','Archived'),(00000000000000000000000000000000000000000000000017,'Benguet','sadas21312','Archived'),(00000000000000000000000000000000000000000000000018,'Benguet','sadasd','Archived'),(00000000000000000000000000000000000000000000000019,'Benguet','','Archived');
/*!40000 ALTER TABLE `officesettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `users_id_num` int(50) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `Fullname` varchar(255) DEFAULT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `AccessLevel` varchar(255) DEFAULT NULL,
  `Status` varchar(255) DEFAULT NULL,
  `ArchiveStatus` varchar(255) DEFAULT 'Not Archived',
  PRIMARY KEY (`users_id_num`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (00000000000000000000000000000000000000000000000001,'John Doe','admin','xzSH+mfPQkSs','Admin','Activated','Not Archived'),(00000000000000000000000000000000000000000000000002,'Jane Doe','staff','xzSH+mfPQkSs','Staff','Activated','Not Archived'),(00000000000000000000000000000000000000000000000003,'sad','adsa','xzSH+mfPQkSs','Admin','Activated','Archived'),(00000000000000000000000000000000000000000000000004,'adasd','asd','xzSH+mfPQkSs','Admin','Activated','Archived'),(00000000000000000000000000000000000000000000000005,'aaa','aaa','xzSH+mfPQkSs','Admin','Disabled','Archived'),(00000000000000000000000000000000000000000000000006,'sdasd','asda','xzSH+mfPQkSs','Admin','Disabled','Archived'),(00000000000000000000000000000000000000000000000007,'sds','asd','xzSH+mfPQkSs','Admin','Activated','Archived');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-15 11:37:35
