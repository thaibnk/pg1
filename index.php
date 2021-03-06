<?php
# This function reads your DATABASE_URL config var and returns a connection
# string suitable for pg_connect. Put this in your app.
//postgres://pbkmkwsgwruuvi:aba676c32840c46c3d3ac98b6c42a838d86f0136fc575d0335b6c3226004f107@ec2-23-21-216-174.compute-1.amazonaws.com:5432/dasg8rt0a5q2tp
//postgres://cmdylcpykuttup:d7eb0656a0673c8aaa7c09324d1521b4112cc9228c4b8ab7df0e5a1bea20cd39@ec2-23-21-238-28.compute-1.amazonaws.com:5432/dek2em9lvto48b
//postgres://rflgrwauvxsftx:e6ff6b357907782cd9aac95bd77cb0a0b2413595db490b0e172f9709f8cbf2cf@ec2-174-129-192-200.compute-1.amazonaws.com:5432/d6mkhk4e2c0c15
function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["ppostgres://pbkmkwsgwruuvi:aba676c32840c46c3d3ac98b6c42a838d86f0136fc575d0335b6c3226004f107@ec2-23-21-216-174.compute-1.amazonaws.com:5432/dasg8rt0a5q2tp"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1); # <- you may want to add sslmode=require there too
}

# Here we establish the connection. Yes, that's all.
//$pg_conn = pg_connect(pg_connection_string_from_database_url());
$pg_conn = pg_connect("user=pbkmkwsgwruuvi password=aba676c32840c46c3d3ac98b6c42a838d86f0136fc575d0335b6c3226004f107 host=ec2-23-21-216-174.compute-1.amazonaws.com port=5432 dbname=dasg8rt0a5q2tp sslmode=require");

# Now let's use the connection for something silly just to prove it works:
//$result = pg_query($pg_conn, "SELECT relname FROM pg_stat_user_tables WHERE schemaname='public'");
$result = pg_query($pg_conn, "SELECT * FROM tbl");

print "<pre>\n";
if (!pg_num_rows($result)) {
  print("xYour connection is working, but your database is empty.\nFret not. This is expected for new apps.\n");
} else {
  print "Tables in your database:dasg8rt0a5q2tp\n";
  $countrow=0;
  $totalrow=pg_num_rows($result);  
  echo " Total select record".$totalrow."<br>";
  while ($row = pg_fetch_row($result)) { $countrow++; print("$countrow. $row[0]\n"); }
  
}
print "\n";
?>
