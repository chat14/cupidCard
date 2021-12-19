<?php

--
-- Table structure for table `tbl_chat`
--
 
CREATE TABLE IF NOT EXISTS `tbl_chat` (
  `chat_id` int(11) NOT NULL,
  `chat_msg` varchar(200) NOT NULL,
  `chat_user1` int(11) NOT NULL,
  `chat_user2` int(11) NOT NULL,
  `chat_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
--
-- Indexes for dumped tables
--
 
--
-- Indexes for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `chat_user1` (`chat_user1`),
  ADD KEY `chat_user2` (`chat_user2`);
 
--
-- AUTO_INCREMENT for dumped tables
--
 
--
-- AUTO_INCREMENT for table `tbl_chat`
--
ALTER TABLE `tbl_chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;
?>
