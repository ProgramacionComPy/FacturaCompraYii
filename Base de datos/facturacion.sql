/*
Navicat MySQL Data Transfer

Source Server         : MySqlLocal
Source Server Version : 50527
Source Host           : localhost:3306
Source Database       : facturacion

Target Server Type    : MYSQL
Target Server Version : 50527
File Encoding         : 65001

Date: 2014-02-19 12:08:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cab_compra`
-- ----------------------------
DROP TABLE IF EXISTS `cab_compra`;
CREATE TABLE `cab_compra` (
  `id_compra` bigint(30) unsigned NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(10) unsigned NOT NULL,
  `nro_documento` varchar(30) DEFAULT NULL,
  `fecha_compra` date NOT NULL,
  `fecha_registro` date DEFAULT NULL,
  `user` varchar(50) NOT NULL,
  `id_tipo_documento` int(10) NOT NULL,
  `igv` float(30,0) DEFAULT NULL,
  `total` float(30,0) DEFAULT NULL,
  `obs` text,
  `id_tipo_pago` int(10) unsigned NOT NULL,
  `descuento_total` float(9,2) DEFAULT NULL,
  PRIMARY KEY (`id_compra`),
  KEY `id_tipo_documento` (`id_tipo_documento`),
  KEY `cab_compra_prov_fk` (`id_proveedor`),
  KEY `id_tipo_pago` (`id_tipo_pago`),
  CONSTRAINT `cab_compra_ibfk_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipos_documentos` (`id_tipo_documento`),
  CONSTRAINT `cab_compra_ibfk_2` FOREIGN KEY (`id_tipo_pago`) REFERENCES `formas_pago` (`id_forma`),
  CONSTRAINT `cab_compra_prov_fk` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cab_compra
-- ----------------------------
INSERT INTO `cab_compra` VALUES ('16', '1', '101010', '2013-02-08', null, 'admin', '1', '4500', '49500', 'NN', '1', '0.00');
INSERT INTO `cab_compra` VALUES ('17', '2', '050505', '2013-02-08', null, 'admin', '1', '3000', '33000', '', '2', '0.00');
INSERT INTO `cab_compra` VALUES ('18', '2', '020202', '2013-02-08', null, 'admin', '1', '5100', '56100', '', '3', '0.00');
INSERT INTO `cab_compra` VALUES ('19', '2', null, '2013-02-11', '2013-02-11', 'admin', '2', '7364', '81000', '', '1', '0.00');
INSERT INTO `cab_compra` VALUES ('22', '2', null, '2013-02-11', '2013-02-11', 'admin', '2', '3082', '33900', '', '1', '2100.00');
INSERT INTO `cab_compra` VALUES ('23', '2', '1010', '2013-02-13', null, 'admin', '1', '7409', '81500', '', '3', '7500.00');
INSERT INTO `cab_compra` VALUES ('24', '2', '551010', '2013-02-13', null, 'admin', '1', '8182', '90000', '', '3', '0.00');
INSERT INTO `cab_compra` VALUES ('26', '1', '12345', '2013-02-26', null, 'admin', '1', '6545', '72000', '', '1', '0.00');
INSERT INTO `cab_compra` VALUES ('27', '1', null, '2013-02-27', '2013-02-28', 'admin', '2', '6545', '72000', '', '2', '0.00');
INSERT INTO `cab_compra` VALUES ('28', '1', '1010', '2013-03-01', null, 'admin', '1', '4500', '49500', 'I work for National Archives of Estonia leading small group of developers. I developed this Playground only to help my colleagues to learn the framework and to set some standards for our team. So, this Playground was never intended to be for general public use. But sure, if you find some parts of it useful, you are very welcome!', '1', '0.00');
INSERT INTO `cab_compra` VALUES ('29', '2', '10101010101', '2014-02-19', null, 'admin', '1', '7000', '77000', 'Test Observación!', '1', '0.00');

-- ----------------------------
-- Table structure for `det_compra`
-- ----------------------------
DROP TABLE IF EXISTS `det_compra`;
CREATE TABLE `det_compra` (
  `id_compra` bigint(30) unsigned NOT NULL,
  `id_producto` int(10) unsigned NOT NULL,
  `precio_unitario` float(30,0) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `descuento_producto` float(10,2) DEFAULT NULL,
  `subtotal_iva` float(10,2) DEFAULT NULL,
  `subtotal_producto` float(30,0) NOT NULL,
  `id_detalle` bigint(30) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_detalle`),
  KEY `id_compra` (`id_compra`),
  KEY `id_producto` (`id_producto`),
  CONSTRAINT `det_compra_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `cab_compra` (`id_compra`),
  CONSTRAINT `det_compra_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of det_compra
-- ----------------------------
INSERT INTO `det_compra` VALUES ('16', '2', '16500', '3', null, '10.00', '49500', '18');
INSERT INTO `det_compra` VALUES ('17', '1', '11000', '3', null, '10.00', '33000', '19');
INSERT INTO `det_compra` VALUES ('18', '3', '7000', '3', null, '10.00', '21000', '20');
INSERT INTO `det_compra` VALUES ('18', '2', '17550', '2', null, '10.00', '35100', '21');
INSERT INTO `det_compra` VALUES ('19', '3', '27000', '1', '0.00', '10.00', '27000', '22');
INSERT INTO `det_compra` VALUES ('19', '2', '27000', '2', '0.00', '10.00', '54000', '23');
INSERT INTO `det_compra` VALUES ('22', '3', '7000', '3', '10.00', '10.00', '18900', '28');
INSERT INTO `det_compra` VALUES ('22', '2', '15000', '1', null, '10.00', '15000', '29');
INSERT INTO `det_compra` VALUES ('23', '3', '7000', '2', null, '10.00', '14000', '30');
INSERT INTO `det_compra` VALUES ('23', '2', '15000', '5', '10.00', '10.00', '67500', '31');
INSERT INTO `det_compra` VALUES ('24', '2', '15000', '6', null, '10.00', '90000', '32');
INSERT INTO `det_compra` VALUES ('26', '2', '15000', '3', null, '10.00', '45000', '36');
INSERT INTO `det_compra` VALUES ('26', '1', '10000', '2', null, '10.00', '20000', '37');
INSERT INTO `det_compra` VALUES ('26', '3', '7000', '1', null, '10.00', '7000', '38');
INSERT INTO `det_compra` VALUES ('27', '2', '15000', '3', null, '10.00', '45000', '39');
INSERT INTO `det_compra` VALUES ('27', '1', '10000', '2', null, '10.00', '20000', '40');
INSERT INTO `det_compra` VALUES ('27', '3', '7000', '1', null, '10.00', '7000', '41');
INSERT INTO `det_compra` VALUES ('28', '2', '16500', '3', null, '10.00', '49500', '42');
INSERT INTO `det_compra` VALUES ('29', '3', '8000', '4', null, '10.00', '32000', '43');
INSERT INTO `det_compra` VALUES ('29', '1', '15000', '3', null, '10.00', '45000', '44');

-- ----------------------------
-- Table structure for `formas_pago`
-- ----------------------------
DROP TABLE IF EXISTS `formas_pago`;
CREATE TABLE `formas_pago` (
  `id_forma` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `desc_forma` varchar(45) NOT NULL,
  PRIMARY KEY (`id_forma`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of formas_pago
-- ----------------------------
INSERT INTO `formas_pago` VALUES ('1', 'Efectivo');
INSERT INTO `formas_pago` VALUES ('2', 'Cheque');
INSERT INTO `formas_pago` VALUES ('3', 'Crédito');

-- ----------------------------
-- Table structure for `productos`
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id_producto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_categoria` int(10) NOT NULL,
  `id_marca` int(10) NOT NULL,
  `descripcion` varchar(150) NOT NULL,
  `unidad_medida` varchar(80) NOT NULL,
  `id_igv` int(10) NOT NULL,
  `precio_compra` float(30,0) NOT NULL,
  `descuento` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `fk1` (`id_categoria`),
  KEY `fk2` (`id_marca`),
  KEY `fk3` (`id_igv`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', '2', '2', 'Desodorante de piso', '1 litro', '1', '10000', null);
INSERT INTO `productos` VALUES ('2', '1', '1', 'Papel carta para impresora', 'Resma 500 hojas', '1', '15000', null);
INSERT INTO `productos` VALUES ('3', '2', '2', 'Detergente', '1/2 litro', '1', '7000', null);
INSERT INTO `productos` VALUES ('4', '2', '2', 'Detergente', '1/2 litro', '1', '6000', null);

-- ----------------------------
-- Table structure for `proveedores`
-- ----------------------------
DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `id_proveedor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ciudades_id_ciudad` int(10) unsigned NOT NULL,
  `departamentos_id_departamento` int(10) unsigned NOT NULL,
  `paises_id_pais` int(10) unsigned NOT NULL,
  `nombre_proveedor` varchar(45) DEFAULT NULL,
  `direccion_proveedor` varchar(45) DEFAULT NULL,
  `telefono_proveedor` varchar(45) DEFAULT NULL,
  `cell_proveedor` varchar(45) DEFAULT NULL,
  `ruc_proveedor` varchar(45) DEFAULT NULL,
  `email_proveedor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_proveedor`),
  KEY `proveedores_FKIndex1` (`ciudades_id_ciudad`),
  KEY `proveedores_FKIndex2` (`paises_id_pais`),
  KEY `proveedores_FKIndex3` (`departamentos_id_departamento`),
  CONSTRAINT `proveedores_ibfk_1` FOREIGN KEY (`paises_id_pais`) REFERENCES `paises` (`id_pais`),
  CONSTRAINT `proveedores_ibfk_2` FOREIGN KEY (`departamentos_id_departamento`) REFERENCES `departamentos` (`id_departamento`),
  CONSTRAINT `proveedores_ibfk_3` FOREIGN KEY (`ciudades_id_ciudad`) REFERENCES `ciudades` (`id_ciudad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of proveedores
-- ----------------------------
INSERT INTO `proveedores` VALUES ('1', '1', '1', '1', 'El faro S.A.', 'Mcal. Estigarribia c/ 25 de mayo', '071-201110', '', '1000-asd-100', 'elfaroencpy@gmail.com');
INSERT INTO `proveedores` VALUES ('2', '2', '1', '1', 'Aldito S.R.L', 'Jorge Memel 375', '', '0985-784521', '1000-asd-120', 'alditohohenau@hotmail.com');

-- ----------------------------
-- Table structure for `tipos_documentos`
-- ----------------------------
DROP TABLE IF EXISTS `tipos_documentos`;
CREATE TABLE `tipos_documentos` (
  `id_tipo_documento` int(11) NOT NULL AUTO_INCREMENT,
  `desc` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tipo_documento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='<double-click to overwrite multiple objects>';

-- ----------------------------
-- Records of tipos_documentos
-- ----------------------------
INSERT INTO `tipos_documentos` VALUES ('1', 'Factura');
INSERT INTO `tipos_documentos` VALUES ('2', 'Orden');
