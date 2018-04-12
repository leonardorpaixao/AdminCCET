TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `ExpiraReLab` BEFORE INSERT ON `tbreservalab` FOR EACH ROW set new.expiraReLab = date_add(current_date(), interval 180 day)'
sql_modes=524288
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_general_ci'
db_cl_names='latin1_swedish_ci'
