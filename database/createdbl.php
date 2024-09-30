<?php 
include("connectiondb.php");

$cmdtbl ="CREATE TABLE patient(
          id int auto_increment PRIMARY KEY,
          name varchar(200) not null,
          icno varchar(12) not null unique,
          gender char(1) not null,
          age int(2) not null,
          email varchar(200) default'tiada lagi',
          address varchar(300) not null,
          state varchar(100) not null,
          regdate date default current_timestamp,
          profile BLOB not null)
          ";
          
//execute sql statement 
$resultdb=$conn->query($cmdtbl);
if($resultdb){
    echo"Successfullu create the table! ";
}else{
    echo "ERROR: Cannot create the table!";
}
?>