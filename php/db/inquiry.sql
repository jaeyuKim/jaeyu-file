create table inquiry (	/* inquiry 데이터베이스 테이블을 만들겠다 */
   num int not null auto_increment,
	/* num 필드 생성, 숫자형, 빈값 불가능, 레코드가 추가될 때 자동으로 생성*/
   id char(15) not null,
	/* id 필드 생성, 문자형(15개 이내), 빈값 불가능 */
   name char(10) not null,
   phone char(14) not null,
   subject char(40) not null,
   content text not null, 
   regist_day char(20),
   primary key(num)
);

