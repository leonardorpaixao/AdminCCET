TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `dataCriacao` BEFORE INSERT ON `tbticket` FOR EACH ROW set new.data = current_date()'
sql_modes=524288
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_general_ci'
db_cl_names='latin1_swedish_ci'
