create table members ( /* members 이름을 가진 테이블을 만들겠다 */
    num int not null auto_increment,
	/* num 필드 생성, 숫잦형, 빈값X, 자동으로 필드 생성 1 2 3... */
    id char(15) not null,	/* id 필드 생성, 문자형, 빈값X */
    pass char(15) not null,
    name char(10) not null,
    email char(80),
    level int,	/* level 필드 생성, 숫자형 */
    regist_day char(20),
    primary key(num)	/* num 필드를 기본키로 정함 */
);
