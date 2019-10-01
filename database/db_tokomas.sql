/*
SQLyog Ultimate v13.1.1 (64 bit)
MySQL - 10.1.39-MariaDB : Database - db_tokomas
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_tokomas` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_tokomas`;

/*Table structure for table `tm_barang` */

DROP TABLE IF EXISTS `tm_barang`;

CREATE TABLE `tm_barang` (
  `b_id` varchar(10) NOT NULL,
  `b_nama` varchar(255) DEFAULT NULL,
  `b_stok` int(11) DEFAULT NULL,
  `b_harga` int(25) DEFAULT NULL,
  `b_gambar` varchar(255) DEFAULT NULL,
  `b_keterangan` tinytext,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tm_barang` */

insert  into `tm_barang`(`b_id`,`b_nama`,`b_stok`,`b_harga`,`b_gambar`,`b_keterangan`) values 
('B0001','Kecap Bango',3,1000,'','keterangan barang'),
('B0002','Kapal Api',10,1000,'',''),
('B0003','INDOMILK',0,4000,'',''),
('B0004','Enzim',4,2000,'',''),
('B0005','Pepsoden',19,4000,'','');

/*Table structure for table `tm_pengguna` */

DROP TABLE IF EXISTS `tm_pengguna`;

CREATE TABLE `tm_pengguna` (
  `p_id` int(11) NOT NULL,
  `p_username` varchar(50) DEFAULT NULL,
  `p_nama` varchar(100) DEFAULT NULL,
  `p_password` varchar(32) DEFAULT NULL,
  `r_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `fk_r_id_pengguna_role` (`r_id`),
  CONSTRAINT `fk_r_id_pengguna_role` FOREIGN KEY (`r_id`) REFERENCES `tm_role` (`r_id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tm_pengguna` */

insert  into `tm_pengguna`(`p_id`,`p_username`,`p_nama`,`p_password`,`r_id`) values 
(0,NULL,NULL,NULL,NULL),
(1,'test','test','admin',1);

/*Table structure for table `tm_penjualan` */

DROP TABLE IF EXISTS `tm_penjualan`;

CREATE TABLE `tm_penjualan` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_id` int(11) DEFAULT NULL,
  `b_id` varchar(10) DEFAULT NULL,
  `p_jumlah` int(11) DEFAULT NULL,
  `p_harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `tm_penjualan` */

insert  into `tm_penjualan`(`p_id`,`t_id`,`b_id`,`p_jumlah`,`p_harga`) values 
(12,12,'0',2,2000),
(13,13,'B0004',1,2000),
(14,14,'B0001',1,1000),
(15,14,'B0005',1,4000);

/*Table structure for table `tm_role` */

DROP TABLE IF EXISTS `tm_role`;

CREATE TABLE `tm_role` (
  `r_id` int(11) NOT NULL,
  `r_nama` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tm_role` */

insert  into `tm_role`(`r_id`,`r_nama`) values 
(1,'admin');

/*Table structure for table `tm_transaksi` */

DROP TABLE IF EXISTS `tm_transaksi`;

CREATE TABLE `tm_transaksi` (
  `t_id` int(11) NOT NULL AUTO_INCREMENT,
  `t_tanggal` datetime DEFAULT NULL,
  `t_jumlah` int(20) DEFAULT NULL,
  `t_bayar` int(20) DEFAULT NULL,
  `t_kembali` int(20) DEFAULT NULL,
  PRIMARY KEY (`t_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `tm_transaksi` */

insert  into `tm_transaksi`(`t_id`,`t_tanggal`,`t_jumlah`,`t_bayar`,`t_kembali`) values 
(12,'2019-09-27 00:55:57',2000,10000,8000),
(13,'2019-09-27 00:57:47',2000,3000,1000),
(14,'2019-09-27 10:07:37',5000,7000,2000);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
