  -- phpMyAdmin SQL Dump
  -- version 4.7.4
  -- https://www.phpmyadmin.net/
  --
  -- Host: 127.0.0.1
  -- Generation Time: 20. Apr, 2018 15:13 PM
  -- Server-versjon: 10.1.26-MariaDB
  -- PHP Version: 7.1.9

  SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
  SET AUTOCOMMIT = 0;
  START TRANSACTION;
  SET time_zone = "+00:00";


  /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
  /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
  /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
  /*!40101 SET NAMES utf8mb4 */;

  --
  -- Database: `test`
  --

  -- --------------------------------------------------------

  --
  -- Tabellstruktur for tabell `organizations`
  --

  CREATE TABLE `organizations` (
    `OrgID` int(11) NOT NULL,
    `Name` varchar(45) NOT NULL,
    `DateCreated` date NOT NULL,
    `Phone` varchar(45) NOT NULL,
    `Description` text NOT NULL,
    `Owner` int(11) NOT NULL,
    `Needs` varchar(300) NOT NULL,
    `Email` varchar(45) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  --
  -- Dataark for tabell `organizations`
  --

  INSERT INTO `organizations` (`OrgID`, `Name`, `DateCreated`, `Phone`, `Description`, `Owner`, `Needs`, `Email`) VALUES
  (2, '123', '2018-04-16', '123', '123', 5, '123', '123@123.com');

  -- --------------------------------------------------------

  --
  -- Tabellstruktur for tabell `users`
  --

  CREATE TABLE `users` (
    `UserID` int(11) NOT NULL,
    `FirstName` varchar(45) NOT NULL,
    `LastName` varchar(45) NOT NULL,
    `Password` varchar(45) NOT NULL,
    `Email` varchar(45) NOT NULL,
    `Zip_Code` varchar(45) NOT NULL,
    `Address` varchar(45) NOT NULL,
    `City` varchar(45) NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

  --
  -- Dataark for tabell `users`
  --

  INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `Password`, `Email`, `Zip_Code`, `Address`, `City`) VALUES
  (5, 'Magnus', 'Heffernan', '0937599a64272739db2f0037e1cfda462fc987f4d8df7', 'manitohef@gmail.com', '5235', 'SÃ¸rÃ¥shÃ¸gda422', 'RÃ¥daÃ¸'),
  (14, 'Sander Nikloai', 'wiig', 'sander', 'sander.wiig@gmail.co', '5236', 'hjorteveien 20e', 'rÃ¥dal');

  --
  -- Indexes for dumped tables
  --

  --
  -- Indexes for table `organizations`
  --
  ALTER TABLE `organizations`
    ADD PRIMARY KEY (`OrgID`,`Owner`),
    ADD UNIQUE KEY `OrgID_UNIQUE` (`OrgID`),
    ADD UNIQUE KEY `Email` (`Email`),
    ADD KEY `fk_Organizations_Users_idx` (`Owner`);

  --
  -- Indexes for table `users`
  --
  ALTER TABLE `users`
    ADD PRIMARY KEY (`UserID`),
    ADD UNIQUE KEY `UserID_UNIQUE` (`UserID`),
    ADD UNIQUE KEY `Email` (`Email`);

  --
  -- AUTO_INCREMENT for dumped tables
  --

  --
  -- AUTO_INCREMENT for table `organizations`
  --
  ALTER TABLE `organizations`
    MODIFY `OrgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

  --
  -- AUTO_INCREMENT for table `users`
  --
  ALTER TABLE `users`
    MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

  --
  -- Begrensninger for dumpede tabeller
  --

  --
  -- Begrensninger for tabell `organizations`
  --
  ALTER TABLE `organizations`
    ADD CONSTRAINT `fk_Organizations_Users` FOREIGN KEY (`Owner`) REFERENCES `users` (`UserID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  COMMIT;

  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
