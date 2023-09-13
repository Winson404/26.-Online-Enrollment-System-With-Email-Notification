DROP TABLE announcement;

CREATE TABLE `announcement` (
  `actId` int(11) NOT NULL AUTO_INCREMENT,
  `actName` text NOT NULL,
  `actDate` varchar(20) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  PRIMARY KEY (`actId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO announcement VALUES("2","Activity 5","2022-12-23","");
INSERT INTO announcement VALUES("3","Activity 3","2022-12-10","2022-12-11");
INSERT INTO announcement VALUES("4","Activity 2","2022-12-11","2022-12-11");
INSERT INTO announcement VALUES("5","Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.","2022-12-11","2022-12-11");
INSERT INTO announcement VALUES("6","sample","2022-12-27","2022-12-27");
INSERT INTO announcement VALUES("8","gfdgfd","2023-01-06","2022-12-27");



DROP TABLE customization;

CREATE TABLE `customization` (
  `customID` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) NOT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'Inactive',
  `date_added` varchar(100) NOT NULL,
  PRIMARY KEY (`customID`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

INSERT INTO customization VALUES("10","wallpaperflare.com_wallpaper.jpg","Inactive","2022-11-27");
INSERT INTO customization VALUES("11","minimalism-1644666519306-6515.jpg","Active","2022-11-27");
INSERT INTO customization VALUES("18","logo.png","Inactive","2022-11-27");
INSERT INTO customization VALUES("19","2.jpg","Inactive","2022-12-27");



DROP TABLE enrollment;

CREATE TABLE `enrollment` (
  `enroll_Id` int(11) NOT NULL AUTO_INCREMENT,
  `student_Id` int(11) NOT NULL,
  `section_Id` int(11) NOT NULL,
  `teacher_Id` int(11) NOT NULL,
  `date_enrolled` varchar(50) NOT NULL,
  PRIMARY KEY (`enroll_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO enrollment VALUES("3","77","7","73","2023-01-31");
INSERT INTO enrollment VALUES("4","80","1","66","2023-01-31");
INSERT INTO enrollment VALUES("5","79","3","67","2023-01-31");
INSERT INTO enrollment VALUES("6","67","3","67","2023-01-31");
INSERT INTO enrollment VALUES("7","83","9","75","2023-02-02");



DROP TABLE section;

CREATE TABLE `section` (
  `sectionId` int(11) NOT NULL AUTO_INCREMENT,
  `sectionName` varchar(100) NOT NULL,
  `yearLevel` varchar(50) NOT NULL,
  PRIMARY KEY (`sectionId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO section VALUES("1","Test 1234","Grade 8");
INSERT INTO section VALUES("3","Test 123","Grade 7");
INSERT INTO section VALUES("5","Test 123456","Grade 10");
INSERT INTO section VALUES("7","Test 12345","Grade 9");
INSERT INTO section VALUES("8","gfgfdgdfgd","Grade 7");
INSERT INTO section VALUES("9","Sample section","Grade 7");



DROP TABLE subject;

CREATE TABLE `subject` (
  `subjectId` int(11) NOT NULL AUTO_INCREMENT,
  `sectionId` int(11) NOT NULL,
  `subjectName` varchar(100) NOT NULL,
  `subjectTime` varchar(50) NOT NULL,
  PRIMARY KEY (`subjectId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO subject VALUES("1","3","test","");
INSERT INTO subject VALUES("3","1","gfd","11:53");
INSERT INTO subject VALUES("4","3","dfsfdsfsd","11:02");
INSERT INTO subject VALUES("5","1","fdsfdsfdsfsdfds","11:01");
INSERT INTO subject VALUES("6","1","Sample","12:10");
INSERT INTO subject VALUES("7","4","fgfd","12:36");
INSERT INTO subject VALUES("8","9","Subject 1","11:25");
INSERT INTO subject VALUES("9","9","Subject 2","10:27");
INSERT INTO subject VALUES("10","9","Subject 3","10:27");
INSERT INTO subject VALUES("11","9","Subject 4","10:31");



DROP TABLE teacher;

CREATE TABLE `teacher` (
  `teacher_Id` int(11) NOT NULL AUTO_INCREMENT,
  `sectionAdvisory` int(11) NOT NULL,
  `t_firstname` varchar(255) NOT NULL,
  `t_middlename` varchar(255) NOT NULL,
  `t_lastname` varchar(255) NOT NULL,
  `t_suffix` varchar(255) NOT NULL,
  `t_dob` varchar(255) NOT NULL,
  `t_age` varchar(100) NOT NULL,
  `t_email` varchar(100) NOT NULL,
  `t_contact` varchar(100) NOT NULL,
  `t_birthplace` varchar(255) NOT NULL,
  `t_gender` varchar(255) NOT NULL,
  `t_civilstatus` varchar(50) NOT NULL,
  `t_occupation` varchar(50) NOT NULL,
  `t_religion` varchar(100) NOT NULL,
  `t_nationality` varchar(50) NOT NULL,
  `t_house_no` varchar(255) NOT NULL,
  `t_street_name` varchar(255) NOT NULL,
  `t_purok` varchar(255) NOT NULL,
  `t_zone` varchar(255) NOT NULL,
  `t_barangay` varchar(255) NOT NULL,
  `t_municipality` varchar(255) NOT NULL,
  `t_province` varchar(255) NOT NULL,
  `t_region` varchar(255) NOT NULL,
  `t_image` varchar(255) NOT NULL,
  `t_verification_code` int(11) NOT NULL,
  `t_date_registered` date NOT NULL,
  PRIMARY KEY (`teacher_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4;

INSERT INTO teacher VALUES("66","1","Erwinfdsfds","Cabag","Son","","1997-09-22","25 years old","admin@gmail.com","9359428963","Poblacion, Medellin, Cebu","Male","Married","Web developer","Bible Baptist Church","","12343","Sitio Upper Landing","Purok San Isidro","Ambot","Daanlungsod","Medellin","fdsfs","VII","paom.png","374025","2022-11-25");
INSERT INTO teacher VALUES("67","3","dsd","d","d","","2016-03-09","6 years old","sonerwin12@gmail.com","","dsa","Male","Married","fdsf","","","fdsf","dsf","fdsf","fdsf","dsfsd","fdsf","fsdfsd","fds","1.jpg","474835","2022-11-25");
INSERT INTO teacher VALUES("72","5","Samplefhfdsddffgg","gfdgfd","gdfgd","g","2022-12-21","5 days old","Norlyngelig16@gmail.com","9359428963","gfdgfdg","Male","Married","gfdgfdgd","Buddhist","","gfdg","fdg","gdfgdg","gfdg","dfgd","fdgdg","fdg","dfg","12.jpg","0","2022-12-27");
INSERT INTO teacher VALUES("73","7","Norlyn","Son","Gelig","","2022-12-15","1 week old","Norlynfdsfdgelig16@gmail.com","9359428963","ewf","Male","Married","f","Methodist","","gfd","gdfgd","gdfgdg","fdgd","gdf","gdgfdgdfgdfgd","Cebu","hgfhgfhfgghf","4.jpg","0","2022-12-27");
INSERT INTO teacher VALUES("75","9","AdvisorAdvisor","AdvisorAdvisor","AdvisorAdvisor","","2023-01-30","3 days old","AdvisorAdvisor23@gmail.com","9132456789","AdvisorAdvisor","Female","Single","AdvisorAdvisor","Aglipayan","","AdvisorAdvisor","AdvisorAdvisor","AdvisorAdvisor","AdvisorAdvisor","AdvisorAdvisor","AdvisorAdvisor","AdvisorAdvisor","AdvisorAdvisor","360_F_206008696_bk0YsrrViCS1w9In3pEEEV97f2t6W85x.jpg","0","2023-02-02");



DROP TABLE users;

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
  `enrollmentType` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `birthplace` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civilstatus` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `guardianName` varchar(150) NOT NULL,
  `guardianContact` varchar(50) NOT NULL,
  `schoolName` varchar(255) NOT NULL,
  `schoolAddress` varchar(255) NOT NULL,
  `yearLevel` varchar(20) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'User',
  `user_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=Pending, 1=Enrolled',
  `verification_code` int(11) NOT NULL,
  `date_registered` date NOT NULL,
  PRIMARY KEY (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("66","","Erwin","Cabag","Son","","1997-09-22","25 years old","admin@gmail.com","9359428963","Poblacion, Medellin, Cebu","Male","Married","Web developer","Bible Baptist Church","","12343","Sitio Upper Landing","Purok San Isidro","Ambot","Daanlungsod","Medellin","","VII","3.jpg","","0192023a7bbd73250516f069df18b500","information","information","","","","Admin","0","374025","2022-11-25");
INSERT INTO users VALUES("67","Old/Regular","dsd","d","d","","2016-03-09","6 years old","sonerwin12@gmail.com","9132456789","dsa","Male","Married","fdsf","Methodist","fdsf","fdsf","dsf","fdsf","fdsf","dsfsd","fdsf","fsdfsd","fds","6207ad7e34af5.jpg","","0192023a7bbd73250516f069df18b500","information","9132456789","information","gfd","Grade 7","User","1","175257","2022-11-25");
INSERT INTO users VALUES("74","Old/Regular","gfdgfdgdgs","dfgd","gdgdfg","dfgdf","2022-12-15","1 week old","gfdgdg232df@gmail.com","9359428963","gfdg","Male","Single","gfdgdfg","Evangelical Christianity","fgdf","gfdgg","fdgfdgd","gdf","gfdgfd","gdf","gfdgd","gdfgd","gdf","14.jpg","","225f667d9243201a6b2b35e008ebe3d3","fdsf","9123456798","f","fgfdgd","Grade 9","User","0","0","2022-12-27");
INSERT INTO users VALUES("77","","information","information","information","","2023-01-12","2 weeks old","adminformationin@gmail.com","9132456789","information","Male","Married","information","Buddhist","Filipino","information","information","information","information","information","information","information","information","13.jpg","13.jpg","bb3ccd5881d651448ded1dac904054ac","information","9123456798","","","Grade 9","User","1","0","2023-01-27");
INSERT INTO users VALUES("79","Old/Regular","czczc","czczc","czczc","","2023-01-12","2 weeks old","czczc@gmail.com","9132456789","czczc","Male","Single","czczc","Evangelical Christianity","Filipino","","czczcczczc","czczc","czczc","czczc","czczc","czczc","czczc","16.jpg","14.jpg","518fa1ebd4b977f1a334b8c46da96f64","czczc","9123456798","czczc","czczc@gmail.com","Grade 7","User","1","0","2023-01-27");
INSERT INTO users VALUES("80","New","czczcczczc","czczc","czczcczczc","czczcczczc","2023-01-10","2 weeks old","alburoczczc.jolina12@gmail.com","9132456789","czczc","Male","Married","czczc","Evangelical Christianity","Filipino","czczc","czczc","czczc","czczc","czczc","czczc","czczc","czczc","","17.jpg","518fa1ebd4b977f1a334b8c46da96f64","czczc","9123456798","czczc","admczczcczczcin@gmail.com","Grade 8","User","1","0","2023-01-27");
INSERT INTO users VALUES("81","Old/Regular","updated","updated","updated","updated","2023-01-26","1 day old","updatedds23232adaadad@gmail.com","9132456987","updated","Non-Binary","Widow/ER","updated","Aglipayan","Filipinodfds","updated","updated","updated","updated","updated","updated","updated","updated","mary.png","bpc.jpg","200019070bde259585f1e8514be9b4ff","updated","9123456987","updated","updated@gmail.comffdfdfdsfsfds","Grade 7","User","1","0","2023-01-27");
INSERT INTO users VALUES("82","","teacher","teacher","teacher","","2023-01-09","3 weeks old","teacher@gmail.com","9132456789","teacher","Male","Married","teacher","Hindu","","teacher","teacher","teacher","teacher","teacher","teacher","teacher","teacher","2.jpg","","d41d8cd98f00b204e9800998ecf8427e","","","","","","","0","0","2023-01-31");
INSERT INTO users VALUES("83","Old/Regular","first name","Sample name","Sample name","","2023-02-01","1 day old","Samplename121@gmail.com","9123456789","Sample name","Male","Single","Sample name","Buddhist","Filipino","Sample name","Sample name","Sample name","Sample name","Sample name","Sample name","Sample name","Sample name","12.jpg","concep.png","7488e331b8b64e5794da3fa4eb10ad5d","Sample name","9123456789","Sample name","admSamplenamein@gmail.com","Grade 7","User","1","0","2023-02-02");



