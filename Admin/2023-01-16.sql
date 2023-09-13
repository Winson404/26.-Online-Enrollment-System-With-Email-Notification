DROP TABLE announcement;

CREATE TABLE `announcement` (
  `actId` int(11) NOT NULL AUTO_INCREMENT,
  `actName` text NOT NULL,
  `actDate` varchar(20) NOT NULL,
  `date_added` varchar(20) NOT NULL,
  PRIMARY KEY (`actId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO announcement VALUES("2","Activity 5","2022-12-23","");
INSERT INTO announcement VALUES("3","Activity 3","2022-12-10","2022-12-11");
INSERT INTO announcement VALUES("4","Activity 2","2022-12-11","2022-12-11");
INSERT INTO announcement VALUES("5","Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, ipsum delectus voluptatum? Molestias aut inventore eaque, maxime numquam dignissimos asperiores, voluptatibus consectetur distinctio excepturi odit architecto, saepe enim sunt, molestiae.","2022-12-11","2022-12-11");
INSERT INTO announcement VALUES("6","sample","2022-12-27","2022-12-27");
INSERT INTO announcement VALUES("8","gfdgfd","2023-01-06","2022-12-27");
INSERT INTO announcement VALUES("9","Announcement sample","2023-01-09","2023-01-16");
INSERT INTO announcement VALUES("10","SAMple","2023-01-24","2023-01-16");



DROP TABLE customization;

CREATE TABLE `customization` (
  `customID` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) NOT NULL,
  `status` varchar(150) NOT NULL DEFAULT 'Inactive',
  `date_added` varchar(100) NOT NULL,
  PRIMARY KEY (`customID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

INSERT INTO customization VALUES("10","wallpaperflare.com_wallpaper.jpg","Inactive","2022-11-27");
INSERT INTO customization VALUES("11","minimalism-1644666519306-6515.jpg","Inactive","2022-11-27");
INSERT INTO customization VALUES("18","logo.png","Inactive","2022-11-27");
INSERT INTO customization VALUES("19","2.jpg","Inactive","2022-12-27");
INSERT INTO customization VALUES("20","wp4813161-simple-minimalist-wallpapers.jpg","Active","2023-01-16");



DROP TABLE users;

CREATE TABLE `users` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
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
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(50) NOT NULL DEFAULT 'User',
  `verification_code` int(11) NOT NULL,
  `date_registered` date NOT NULL,
  PRIMARY KEY (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;

INSERT INTO users VALUES("66","Erwin","Cabag","Son","","1997-09-22","25 years old","admin@gmail.com","9359428963","Poblacion, Medellin, Cebu","Male","Married","Web developer","Bible Baptist Church","1234","Sitio Upper Landing","Purok San Isidro","Ambot","Daanlungsod","Medellin","","VII","13.jpg","7488e331b8b64e5794da3fa4eb10ad5d","Admin","374025","2022-11-25");
INSERT INTO users VALUES("67","dsd","d","d","","2016-03-09","6 years old","sonerwin12@gmail.com","","dsa","Male","Married","fdsf","","fdsf","dsf","fdsf","fdsf","dsfsd","fdsf","fsdfsd","fds","1.jpg","0192023a7bbd73250516f069df18b500","Staff","494779","2022-11-25");
INSERT INTO users VALUES("72","Samplefh","gfdgfd","gdfgd","g","2022-12-21","5 days old","alburo.jolina12@gmail.com","9359428963","gfdgfdg","Male","Married","gfdgfdgd","Buddhist","gfdg","fdg","gdfgdg","gfdg","dfgd","fdgdg","fdg","dfg","12.jpg","66952c6203ae23242590c0061675234d","User","420213","2022-12-27");
INSERT INTO users VALUES("73","Norlyn","Son","Gelig","","2022-12-15","1 week old","Norlynfdsfdgelig16@gmail.com","9359428963","ewf","Male","Married","f","Methodist","gfd","gdfgd","gdfgdg","fdgd","gdf","gdgfdgdfgdfgd","Cebu","hgfhgfhfgghf","4.jpg","a03fd6e43c16b44429d829dffa31321a","User","0","2022-12-27");
INSERT INTO users VALUES("74","gfdgfdgdg","dfgd","gdgdfg","dfgdf","2022-12-15","1 week old","gfdgdg232df@gmail.com","9359428963","gfdg","Male","Single","gfdgdfg","Evangelical Christianity","gfdgg","fdgfdgd","gdf","gfdgfd","gdf","gfdgd","gdfgd","gdf","14.jpg","225f667d9243201a6b2b35e008ebe3d3","User","0","2022-12-27");
INSERT INTO users VALUES("75","Norlyn","Son","Gelig","","2022-12-15","1 week old","Norlgelig16@gmail.com","9359428963","gfdgfd","Male","Separated","gfdgd","Evangelical Christianity","gfdg","dfgdg","df","gfdg","fdgd","gfdgdfg","Cebu","gfd","17.jpg","74129ee1fc4edfc41937efbbd6231c42","User","0","2022-12-27");
INSERT INTO users VALUES("76","gfdgfdgdg","dgdfg","fdgdfg","df","2022-12-07","2 weeks old","Norlyngfdgfdgd23gelig16@gmail.com","9359428963","gfdg","Male","Single","gfdgfd","Iglesia Ni Cristo","gfdgdf","gfdg","gfdg","dfgdf","gfd","gfdgd","Cebufgdgdf","gdfg","2.jpg","225f667d9243201a6b2b35e008ebe3d3","User","0","2022-12-27");
INSERT INTO users VALUES("77","Sample name","Sample name","Sample name","","2021-03-04","1 year old","adminfdsfsfs@gmail.com","9132456789","Sample name","Male","Married","Sample name","Roman Catholic","Sample name","Sample name","Sample name","Sample name","Sample name","Sample name","Sample name","Sample name","rUPmy8.jpg","1f8d3468cfa5b64492933c90a3a673c4","User","0","2023-01-16");



