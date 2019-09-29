/*
  张婷婷家王凉面数据库表设计
 */


/* 用户信息表 */
CREATE TABLE user (
  id int key auto_incremenet not null,
  username varchar(20) not null,
  password varchar(32) not null
);


/* 信息详情表 */
CREATE TABLE visitlist (
  id int key auto_increment not null,
  name varchar(20) unique,
  contact varchar(20) default null,
  area varchar(30) default null,
  status varchar(30) default null,
  deliveryDate date default null,
  waybill varchar(40) default null,
  currentTime timestamp null default current_timestamp
);

INSERT INTO visitlist (name, contact, area, status, deliveryDate) VALUES ('张某某', 13349101011, '广元市', '已发货', '2019-9-20')

/* 配送状态表 */
CREATE TABLE status (
  id int key auto_increment not null,
  status varchar(20) unique not null
);
/* 配送状态表添加测试信息 */
INSERT INTO status (status) VALUES ('正在出库');
INSERT INTO status (status) VALUES ('已发货');
INSERT INTO status (status) VALUES ('客户已签收');