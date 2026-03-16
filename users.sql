  CREATE TABLE `users` (
    `id` int(11) NOT NULL,
    `email` varchar(255) NOT NULL,
    `name` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    `signup_date` datetime NOT NULL DEFAULT current_timestamp()
  ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

  INSERT INTO `users` (`id`, `email`, `name`, `password`) VALUES
  (1, 'testy@testcles.com', 'Galvin', '827ccb0eea8a706c4c34a16891f84e7b');

  --
  ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

  ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
