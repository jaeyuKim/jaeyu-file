create table search (
   num int unsigned not null auto_increment comment '제품 고유번호',
   product varchar(20) not null comment '제품 이름',
   explanation text not null comment '제품 설명',
   picture varchar(40) not null comment '제품 이미지 파일명',
   regist_day int(10) unsigned not null comment '제품 등록 시간',
   primary key(num)
);
