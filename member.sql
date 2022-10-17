create table txt(
    num int not null auto_increment comment '기본키(식별자) 필드',
    title varchar(50) not null,
    content text not null,
    regist_day char(21) not null,
    primary key(num)
);
