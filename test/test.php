<?php
/* basic functionality testing.  could be much improved
   with something like PHPunit
*/
require_once('../src/Instrumentation.php');

$instance = false;
$instance = Instrumentation::get_instance();
assert($instance !== false);

$instance->set('test_counter', 'abc');
assert($instance->get('test_counter') == 'abc');

$instance->increment('empty_counter');
assert($instance->get('empty_counter') == 1);

$instance->set('test_counter', '');
$instance->append('test_counter', 'abc');
assert($instance->get('test_counter') == 'abc');

$instance->timer();
sleep(1);
assert($instance->timer() >= 1);

$conn = false;
$conn = MySQLi_perf::mysqli_connect();
assert($conn !== false);
assert($instance->get('mysql_connect_time') > 0);
$r = MySQLi_perf::mysqli_query($conn,'select 1');

assert($r);

assert($instance->get('mysql_query_exec_time') > 0);

$instance->set('mysql_connect_time',0);
$instance->set('mysql_query_exec_time',0);

$conn = false;
$conn = new MySQLi_perf();
assert($conn !== false);
assert($instance->get('mysql_connect_time') > 0);
$rows = $conn->query('select 1');
assert($instance->get('mysql_query_exec_time') > 0);

$instance->set('mysql_connect_time',0);
$instance->set('mysql_query_exec_time',0);
$conn = false;

$conn = MySQL_perf::mysql_connect();
assert($conn !== false);
assert($instance->get('mysql_connect_time') > 0);
$stmt = MySQL_perf::mysql_query('select 1', $conn);
assert($instance->get('mysql_query_exec_time') > 0);
