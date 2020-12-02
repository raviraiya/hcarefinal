-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2016 at 08:10 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hcareweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `hadmin`
--

CREATE TABLE IF NOT EXISTS `hadmin` (
`ID` bigint(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `picture` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `hadminprocedure`
--

CREATE TABLE IF NOT EXISTS `hadminprocedure` (
`ID` bigint(100) NOT NULL,
  `procedure_cat_id` int(100) NOT NULL,
  `procedure_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `happointmentadvice`
--

CREATE TABLE IF NOT EXISTS `happointmentadvice` (
`ID` bigint(100) NOT NULL,
  `appointmentid` int(100) NOT NULL,
  `patientid` int(100) NOT NULL,
  `doctorid` int(100) NOT NULL,
  `refered_doc_id` int(100) NOT NULL,
  `advice` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `happointmentreporting`
--

CREATE TABLE IF NOT EXISTS `happointmentreporting` (
`ID` int(111) NOT NULL,
  `specialist_id` int(111) NOT NULL,
  `procedure_id` int(111) NOT NULL,
  `date` date DEFAULT NULL,
  `booked` varchar(111) DEFAULT NULL,
  `cancel` varchar(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hbooking`
--

CREATE TABLE IF NOT EXISTS `hbooking` (
`ID` bigint(100) NOT NULL,
  `specialist_user_id` int(100) NOT NULL,
  `procedure_id` int(100) NOT NULL,
  `procedure_slot_id` int(100) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `booking_time` varchar(100) DEFAULT NULL,
  `patient_user_id` int(100) DEFAULT NULL,
  `homephy_id` int(100) DEFAULT NULL,
  `status` int(100) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `hcandastates`
--

CREATE TABLE IF NOT EXISTS `hcandastates` (
`ID` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Table structure for table `hcity`
--

CREATE TABLE IF NOT EXISTS `hcity` (
`ID` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `hhomephysician`
--

CREATE TABLE IF NOT EXISTS `hhomephysician` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `desc` text,
  `licence_no` varchar(100) DEFAULT NULL,
  `licence_city` varchar(100) DEFAULT NULL,
  `licence_state` varchar(100) DEFAULT NULL,
  `licence_status` int(100) NOT NULL DEFAULT '0',
  `dob` varchar(100) DEFAULT NULL,
  `gender` varchar(111) DEFAULT NULL,
  `see_children` varchar(111) DEFAULT NULL,
  `language` varchar(111) DEFAULT NULL,
  `address` text,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` varchar(111) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `hhomephysiciandocument`
--

CREATE TABLE IF NOT EXISTS `hhomephysiciandocument` (
`ID` int(100) NOT NULL,
  `home_phy_userid` int(100) NOT NULL,
  `patient_user_id` int(100) NOT NULL,
  `procedure_cat_id` int(100) NOT NULL,
  `document_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `hhospital`
--

CREATE TABLE IF NOT EXISTS `hhospital` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `desc` text,
  `logo_url` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `hhospitaldoctor`
--

CREATE TABLE IF NOT EXISTS `hhospitaldoctor` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `hospitalid` int(100) NOT NULL,
  `doc_name` varchar(100) DEFAULT NULL,
  `doc_desc` text,
  `qualification` varchar(100) DEFAULT NULL,
  `experience` varchar(100) DEFAULT NULL,
  `speciality` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `doc_pic` varchar(100) DEFAULT NULL,
  `other` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `hhospitalfacilities`
--

CREATE TABLE IF NOT EXISTS `hhospitalfacilities` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `hospitalid` int(100) NOT NULL,
  `facility_name` varchar(100) DEFAULT NULL,
  `facility_desc` text,
  `other` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=124 ;

-- --------------------------------------------------------

--
-- Table structure for table `hhospitalholiday`
--

CREATE TABLE IF NOT EXISTS `hhospitalholiday` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `hospitalid` int(100) NOT NULL,
  `holiday_date` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `hhospitalphoto`
--

CREATE TABLE IF NOT EXISTS `hhospitalphoto` (
`ID` bigint(100) NOT NULL,
  `hospitalid` int(100) NOT NULL,
  `picurl` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `hhospitalreview`
--

CREATE TABLE IF NOT EXISTS `hhospitalreview` (
`ID` bigint(100) NOT NULL,
  `hospitalid` int(100) NOT NULL,
  `reviewerid` int(100) NOT NULL,
  `rating` varchar(100) DEFAULT NULL,
  `review_message` text,
  `date_of_review` date DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `hhospitalservices`
--

CREATE TABLE IF NOT EXISTS `hhospitalservices` (
`ID` bigint(100) NOT NULL,
  `hospitalid` int(100) NOT NULL,
  `service_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

-- --------------------------------------------------------

--
-- Table structure for table `hlocation`
--

CREATE TABLE IF NOT EXISTS `hlocation` (
`ID` int(100) NOT NULL,
  `city_id` int(100) NOT NULL,
  `state_id` int(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Table structure for table `hmasterprocedure`
--

CREATE TABLE IF NOT EXISTS `hmasterprocedure` (
`ID` bigint(111) NOT NULL,
  `procedure_cat_id` int(111) NOT NULL,
  `procedure_name` varchar(111) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `hpatient`
--

CREATE TABLE IF NOT EXISTS `hpatient` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `refered_by` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` varchar(111) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `hpatientcheckup`
--

CREATE TABLE IF NOT EXISTS `hpatientcheckup` (
`ID` bigint(111) NOT NULL,
  `booking_id` int(111) NOT NULL,
  `patient_id` int(111) NOT NULL,
  `temp` decimal(65,0) NOT NULL,
  `heartbit` int(111) NOT NULL,
  `BD` text NOT NULL,
  `BG` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hpatienthistory`
--

CREATE TABLE IF NOT EXISTS `hpatienthistory` (
`ID` bigint(100) NOT NULL,
  `patientid` int(100) NOT NULL,
  `user_id` int(111) NOT NULL,
  `date` date DEFAULT NULL,
  `booking_id` int(111) DEFAULT NULL,
  `history_type` varchar(100) DEFAULT NULL,
  `historytitle` varchar(100) DEFAULT NULL,
  `desc` text,
  `files` varchar(111) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `hpatienthistoryfiles`
--

CREATE TABLE IF NOT EXISTS `hpatienthistoryfiles` (
`ID` bigint(100) NOT NULL,
  `patient_history_id` int(111) NOT NULL,
  `patientid` int(100) NOT NULL,
  `history_files` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `hpatientinvite`
--

CREATE TABLE IF NOT EXISTS `hpatientinvite` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `patientfname` varchar(100) DEFAULT NULL,
  `patientlname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `invitationcode` varchar(100) DEFAULT NULL,
  `issuedate` date DEFAULT NULL,
  `expirydate` date DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `hpatientreporting`
--

CREATE TABLE IF NOT EXISTS `hpatientreporting` (
`ID` bigint(111) NOT NULL,
  `specialist_id` int(111) NOT NULL,
  `procedure_id` int(111) NOT NULL,
  `date` date DEFAULT NULL,
  `new` varchar(111) DEFAULT NULL,
  `old` varchar(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hpaymentmethod`
--

CREATE TABLE IF NOT EXISTS `hpaymentmethod` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `payment_type` varchar(100) DEFAULT NULL,
  `paypalid` int(100) NOT NULL,
  `credit_card_no` varchar(100) DEFAULT NULL,
  `expire_month` varchar(100) DEFAULT NULL,
  `expired_year` varchar(100) DEFAULT NULL,
  `cvc` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hprocedure`
--

CREATE TABLE IF NOT EXISTS `hprocedure` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `MPID` int(100) NOT NULL,
  `procedure_cat_id` int(100) NOT NULL,
  `procedure_name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `hourly_appt` int(11) NOT NULL,
  `price` int(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `hprocedurecategory`
--

CREATE TABLE IF NOT EXISTS `hprocedurecategory` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `category_name` varchar(100) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Table structure for table `hproceduredate`
--

CREATE TABLE IF NOT EXISTS `hproceduredate` (
`ID` bigint(100) NOT NULL,
  `procedureid` int(100) NOT NULL,
  `date` date DEFAULT NULL,
  `time_slot` varchar(100) DEFAULT NULL,
  `no_of_appt` int(100) DEFAULT NULL,
  `no_of_booked_appt` int(100) DEFAULT '0',
  `availability` tinyint(1) NOT NULL DEFAULT '1',
  `doctorid` int(100) NOT NULL,
  `status` varchar(111) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

-- --------------------------------------------------------

--
-- Table structure for table `hprocedurestaff`
--

CREATE TABLE IF NOT EXISTS `hprocedurestaff` (
`ID` bigint(100) NOT NULL,
  `procedure_id` int(100) DEFAULT NULL,
  `staff_cat_id` int(100) DEFAULT NULL,
  `staff_name` int(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

--
-- Table structure for table `hproceduretimeslot`
--

CREATE TABLE IF NOT EXISTS `hproceduretimeslot` (
  `ID` bigint(111) NOT NULL,
  `specialist_id` int(111) NOT NULL,
  `procedure_id` int(111) NOT NULL,
  `weekday` varchar(111) DEFAULT NULL,
  `slot` varchar(111) DEFAULT NULL,
  `seats` varchar(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hrecommendedprocedure`
--

CREATE TABLE IF NOT EXISTS `hrecommendedprocedure` (
`ID` bigint(100) NOT NULL,
  `patient_user_id` int(100) NOT NULL,
  `homephy_user_id` int(100) NOT NULL,
  `procedure_cat_id` int(100) NOT NULL,
  `procedure_id` int(100) NOT NULL,
  `specialist_user_id` int(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `hreview`
--

CREATE TABLE IF NOT EXISTS `hreview` (
`ID` bigint(100) NOT NULL,
  `specialist_id` int(100) NOT NULL,
  `hospital_id` int(100) NOT NULL,
  `procedure_id` int(100) NOT NULL,
  `booking_id` int(100) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `slot_date` date NOT NULL,
  `slot_time` varchar(100) NOT NULL,
  `review` varchar(255) DEFAULT NULL,
  `status` int(100) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `hright`
--

CREATE TABLE IF NOT EXISTS `hright` (
`ID` bigint(100) NOT NULL,
  `roleid` int(100) NOT NULL,
  `right_name` varchar(100) DEFAULT NULL,
  `access` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hrole`
--

CREATE TABLE IF NOT EXISTS `hrole` (
`ID` bigint(100) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hspecialist`
--

CREATE TABLE IF NOT EXISTS `hspecialist` (
  `userid` int(100) NOT NULL,
`ID` bigint(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `desc` text,
  `licence_no` varchar(100) DEFAULT NULL,
  `licence_state` varchar(100) DEFAULT NULL,
  `licence_city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) NOT NULL,
  `city` varchar(100) DEFAULT NULL,
  `gender` varchar(111) DEFAULT NULL,
  `see_children` varchar(111) DEFAULT NULL,
  `language` varchar(111) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `status` int(100) NOT NULL DEFAULT '1',
  `licence_status` int(11) DEFAULT '0',
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Table structure for table `hstaff`
--

CREATE TABLE IF NOT EXISTS `hstaff` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `staff_cat_id` int(100) NOT NULL,
  `staff_name` varchar(100) DEFAULT NULL,
  `other_info` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `hstaffcategory`
--

CREATE TABLE IF NOT EXISTS `hstaffcategory` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `staff_cat_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `htodayappointment`
--

CREATE TABLE IF NOT EXISTS `htodayappointment` (
`ID` bigint(111) NOT NULL,
  `specialist_id` int(111) NOT NULL,
  `date` date DEFAULT NULL,
  `completed` varchar(111) DEFAULT NULL,
  `pending` varchar(111) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `huser`
--

CREATE TABLE IF NOT EXISTS `huser` (
`ID` bigint(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `picture` text,
  `address` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `confirm_code` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `husersetting`
--

CREATE TABLE IF NOT EXISTS `husersetting` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `notification` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `husersubscription`
--

CREATE TABLE IF NOT EXISTS `husersubscription` (
`ID` bigint(100) NOT NULL,
  `userid` int(100) NOT NULL,
  `transactionid` int(100) NOT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `amount` int(100) DEFAULT NULL,
  `subscription_date` date DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `transaction_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `hworkinghours`
--

CREATE TABLE IF NOT EXISTS `hworkinghours` (
`ID` bigint(100) NOT NULL,
  `userid` bigint(100) NOT NULL,
  `hospitalid` bigint(100) NOT NULL,
  `weekday` varchar(100) DEFAULT NULL,
  `hour` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hadmin`
--
ALTER TABLE `hadmin`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hadminprocedure`
--
ALTER TABLE `hadminprocedure`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `happointmentadvice`
--
ALTER TABLE `happointmentadvice`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `happointmentreporting`
--
ALTER TABLE `happointmentreporting`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hbooking`
--
ALTER TABLE `hbooking`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hcandastates`
--
ALTER TABLE `hcandastates`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hcity`
--
ALTER TABLE `hcity`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hhomephysician`
--
ALTER TABLE `hhomephysician`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hhomephysiciandocument`
--
ALTER TABLE `hhomephysiciandocument`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hhospital`
--
ALTER TABLE `hhospital`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hhospitaldoctor`
--
ALTER TABLE `hhospitaldoctor`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hhospitalfacilities`
--
ALTER TABLE `hhospitalfacilities`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hhospitalholiday`
--
ALTER TABLE `hhospitalholiday`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hhospitalphoto`
--
ALTER TABLE `hhospitalphoto`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hhospitalreview`
--
ALTER TABLE `hhospitalreview`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hhospitalservices`
--
ALTER TABLE `hhospitalservices`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hlocation`
--
ALTER TABLE `hlocation`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hmasterprocedure`
--
ALTER TABLE `hmasterprocedure`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hpatient`
--
ALTER TABLE `hpatient`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hpatientcheckup`
--
ALTER TABLE `hpatientcheckup`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hpatienthistory`
--
ALTER TABLE `hpatienthistory`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hpatienthistoryfiles`
--
ALTER TABLE `hpatienthistoryfiles`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hpatientinvite`
--
ALTER TABLE `hpatientinvite`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hpatientreporting`
--
ALTER TABLE `hpatientreporting`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hpaymentmethod`
--
ALTER TABLE `hpaymentmethod`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hprocedure`
--
ALTER TABLE `hprocedure`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hprocedurecategory`
--
ALTER TABLE `hprocedurecategory`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hproceduredate`
--
ALTER TABLE `hproceduredate`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hprocedurestaff`
--
ALTER TABLE `hprocedurestaff`
 ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `hrecommendedprocedure`
--
ALTER TABLE `hrecommendedprocedure`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hreview`
--
ALTER TABLE `hreview`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hright`
--
ALTER TABLE `hright`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hrole`
--
ALTER TABLE `hrole`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hspecialist`
--
ALTER TABLE `hspecialist`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hstaff`
--
ALTER TABLE `hstaff`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hstaffcategory`
--
ALTER TABLE `hstaffcategory`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `htodayappointment`
--
ALTER TABLE `htodayappointment`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `huser`
--
ALTER TABLE `huser`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `husersetting`
--
ALTER TABLE `husersetting`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `husersubscription`
--
ALTER TABLE `husersubscription`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `hworkinghours`
--
ALTER TABLE `hworkinghours`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hadmin`
--
ALTER TABLE `hadmin`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hadminprocedure`
--
ALTER TABLE `hadminprocedure`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `happointmentadvice`
--
ALTER TABLE `happointmentadvice`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `happointmentreporting`
--
ALTER TABLE `happointmentreporting`
MODIFY `ID` int(111) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hbooking`
--
ALTER TABLE `hbooking`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `hcandastates`
--
ALTER TABLE `hcandastates`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `hcity`
--
ALTER TABLE `hcity`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `hhomephysician`
--
ALTER TABLE `hhomephysician`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hhomephysiciandocument`
--
ALTER TABLE `hhomephysiciandocument`
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `hhospital`
--
ALTER TABLE `hhospital`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hhospitaldoctor`
--
ALTER TABLE `hhospitaldoctor`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hhospitalfacilities`
--
ALTER TABLE `hhospitalfacilities`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `hhospitalholiday`
--
ALTER TABLE `hhospitalholiday`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hhospitalphoto`
--
ALTER TABLE `hhospitalphoto`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `hhospitalreview`
--
ALTER TABLE `hhospitalreview`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hhospitalservices`
--
ALTER TABLE `hhospitalservices`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `hlocation`
--
ALTER TABLE `hlocation`
MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `hmasterprocedure`
--
ALTER TABLE `hmasterprocedure`
MODIFY `ID` bigint(111) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hpatient`
--
ALTER TABLE `hpatient`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `hpatientcheckup`
--
ALTER TABLE `hpatientcheckup`
MODIFY `ID` bigint(111) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hpatienthistory`
--
ALTER TABLE `hpatienthistory`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hpatienthistoryfiles`
--
ALTER TABLE `hpatienthistoryfiles`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `hpatientinvite`
--
ALTER TABLE `hpatientinvite`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `hpatientreporting`
--
ALTER TABLE `hpatientreporting`
MODIFY `ID` bigint(111) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hpaymentmethod`
--
ALTER TABLE `hpaymentmethod`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hprocedure`
--
ALTER TABLE `hprocedure`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `hprocedurecategory`
--
ALTER TABLE `hprocedurecategory`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `hproceduredate`
--
ALTER TABLE `hproceduredate`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `hprocedurestaff`
--
ALTER TABLE `hprocedurestaff`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `hrecommendedprocedure`
--
ALTER TABLE `hrecommendedprocedure`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `hreview`
--
ALTER TABLE `hreview`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hright`
--
ALTER TABLE `hright`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hrole`
--
ALTER TABLE `hrole`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hspecialist`
--
ALTER TABLE `hspecialist`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `hstaff`
--
ALTER TABLE `hstaff`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hstaffcategory`
--
ALTER TABLE `hstaffcategory`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `htodayappointment`
--
ALTER TABLE `htodayappointment`
MODIFY `ID` bigint(111) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `huser`
--
ALTER TABLE `huser`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `husersetting`
--
ALTER TABLE `husersetting`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `husersubscription`
--
ALTER TABLE `husersubscription`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hworkinghours`
--
ALTER TABLE `hworkinghours`
MODIFY `ID` bigint(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
