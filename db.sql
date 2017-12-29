-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.26-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for project
CREATE DATABASE IF NOT EXISTS `project` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `project`;

-- Dumping structure for table project.exam_report
CREATE TABLE IF NOT EXISTS `exam_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT '0',
  `college` varchar(50) DEFAULT '0',
  `school` varchar(50) DEFAULT '0',
  `department` varchar(50) DEFAULT '0',
  `course` varchar(50) DEFAULT '0',
  `examtype` varchar(50) DEFAULT '0',
  `semester` varchar(50) DEFAULT '0',
  `year` varchar(50) DEFAULT '0',
  `examdate` varchar(50) NOT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table project.exam_report: ~5 rows (approximately)
/*!40000 ALTER TABLE `exam_report` DISABLE KEYS */;
INSERT INTO `exam_report` (`id`, `username`, `college`, `school`, `department`, `course`, `examtype`, `semester`, `year`, `examdate`, `date_created`) VALUES
	(1, 'nirav', 'Stevens', 'Sidenberg', 'Information Science', 'PAr', 'Midterm Examination', 'Fall', '2017', '12/05/2017', '2017-12-08 15:02:26'),
	(2, 'nirav', 'Stevens', 'Seidenberg School of Computer Sciences', 'Information Science', 'PAr', 'Midterm Examination', 'Fall', '2017', '12/21/2017', '2017-12-08 15:15:06'),
	(3, 'nirav', 'Stevens', 'Sidenberg', 'Information Science', 'PAr', 'Final Examination', 'Spring', '2017', '12/21/2017', '2017-12-20 18:03:57'),
	(4, 'nirav', 'Stevens', 'Sidenberg', 'Information Science', 'PAr', 'Midterm Examination', 'Spring', '2017', '12/21/2017', '2017-12-20 18:26:22'),
	(5, 'nirav', 'Stevens', 'Sidenberg', 'Information Science', 'Internet_Computing', 'Final Examination', 'Fall', '2017', '12/22/2017', '2017-12-22 14:08:29');
/*!40000 ALTER TABLE `exam_report` ENABLE KEYS */;

-- Dumping structure for table project.question
CREATE TABLE IF NOT EXISTS `question` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `question_for` varchar(500) DEFAULT NULL,
  `question_text` varchar(100) DEFAULT NULL,
  `question_type` varchar(10) DEFAULT NULL,
  `answer` varchar(500) DEFAULT NULL,
  `points` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qid`),
  KEY `question_for` (`question_for`),
  KEY `question_type` (`question_type`),
  CONSTRAINT `FK_question_relationtable` FOREIGN KEY (`question_for`) REFERENCES `relationtable` (`combined`),
  CONSTRAINT `question_ibfk_2` FOREIGN KEY (`question_type`) REFERENCES `question_type` (`q_type`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- Dumping data for table project.question: ~4 rows (approximately)
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`qid`, `question_for`, `question_text`, `question_type`, `answer`, `points`) VALUES
	(81, 'nirav-Stevens-Information Science-Internet_Computing', 'hu', 'TF', 'True', 2),
	(82, 'nirav-Stevens-Information Science-Internet_Computing', 'https is markup language??', 'TF', 'True', 20),
	(83, 'nirav-Stevens-Information Science-Internet_Computing', 'explain servlet', 'ESS', 'abcd abcd', 20),
	(84, 'nirav-Stevens-Information Science-Internet_Computing', 'Write about New York', 'SR', 'New York is a state in northeastern USA.\r\nIts is called financial district.', 5);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;

-- Dumping structure for table project.question_choices
CREATE TABLE IF NOT EXISTS `question_choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `choice` varchar(20) NOT NULL,
  `question_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk__choice_question` (`question_id`),
  CONSTRAINT `fk__choice_question` FOREIGN KEY (`question_id`) REFERENCES `question` (`qid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table project.question_choices: ~4 rows (approximately)
/*!40000 ALTER TABLE `question_choices` DISABLE KEYS */;
INSERT INTO `question_choices` (`id`, `choice`, `question_id`) VALUES
	(5, 'True', 81),
	(6, 'False', 81),
	(7, 'True', 82),
	(8, 'False', 82);
/*!40000 ALTER TABLE `question_choices` ENABLE KEYS */;

-- Dumping structure for table project.question_type
CREATE TABLE IF NOT EXISTS `question_type` (
  `q_type` varchar(10) NOT NULL,
  `full_form` varchar(30) DEFAULT NULL,
  `description` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`q_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table project.question_type: ~10 rows (approximately)
/*!40000 ALTER TABLE `question_type` DISABLE KEYS */;
INSERT INTO `question_type` (`q_type`, `full_form`, `description`) VALUES
	('ESS', 'Essay', NULL),
	('FIB_PLUS', ' Fill In The Blank', NULL),
	('FIL', 'File Response', NULL),
	('MA', 'Multiple Answer ', NULL),
	('MAT', 'Match Questions', NULL),
	('MC', 'Multiple Choice', NULL),
	('NUM', 'Numeric Response', NULL),
	('ORD', 'Order Questions', NULL),
	('SR', 'Short Response', NULL),
	('TF', 'True/False', NULL);
/*!40000 ALTER TABLE `question_type` ENABLE KEYS */;

-- Dumping structure for table project.relationtable
CREATE TABLE IF NOT EXISTS `relationtable` (
  `username` varchar(50) NOT NULL,
  `college` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `combined` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`username`,`college`,`department`,`course`,`section`),
  UNIQUE KEY `combined` (`combined`),
  CONSTRAINT `FK_USERNAME` FOREIGN KEY (`username`) REFERENCES `user_accounts` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table project.relationtable: ~3 rows (approximately)
/*!40000 ALTER TABLE `relationtable` DISABLE KEYS */;
INSERT INTO `relationtable` (`username`, `college`, `department`, `course`, `section`, `combined`) VALUES
	('nirav', 'Stevens', 'Information Science', 'Internet_Computing', '110', 'nirav-Stevens-Information Science-Internet_Computing'),
	('nirav', 'Stevens', 'Information Science', 'PAr', '177', 'nirav-Stevens-Information Science-PAr'),
	('test', 'Pace University', 'Information Science', 'Testmy', '111', 'test-Pace University-Information Science-Testmy');
/*!40000 ALTER TABLE `relationtable` ENABLE KEYS */;

-- Dumping structure for table project.user_accounts
CREATE TABLE IF NOT EXISTS `user_accounts` (
  `username` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `user_type` varchar(10) NOT NULL DEFAULT 'professor',
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table project.user_accounts: ~2 rows (approximately)
/*!40000 ALTER TABLE `user_accounts` DISABLE KEYS */;
INSERT INTO `user_accounts` (`username`, `email`, `user_type`, `password`) VALUES
	('admin', 'admin@portal.edu', 'admin', '111'),
	('nirav', 'ns082@pace.edu', 'professor', '123'),
	('test', 'test@pace.edu', 'professor', '111'),
	('vikalp', 'vikalpshastri211@gma', 'professor', 'vikk1234.');
/*!40000 ALTER TABLE `user_accounts` ENABLE KEYS */;

-- Dumping structure for trigger project.insert_trigger
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `insert_trigger` BEFORE INSERT ON `relationtable` FOR EACH ROW SET new.combined = CONCAT(new.username,'-',new.college, '-', new.department, '-', new.course)//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Dumping structure for trigger project.update_trigger
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `update_trigger` BEFORE UPDATE ON `relationtable` FOR EACH ROW SET new.combined = CONCAT(new.username,'-',new.college, '-', new.department, '-', new.course)//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
