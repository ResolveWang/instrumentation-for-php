Contains PHP classes for easing the implementation of instrumentation in your application.

Instrumentation - A singleton which provides an interface for storing counters.  These counters are automatically exported to the apache environment using apache\_setenv()

MySQLi\_perf     - Instrumented extension of the MySQLi object and replacement static functions for the functional one

MySQL\_perf      - Instrumented abstract class with static functions to replace the mysql functional interface

More to come

-- BASIC USAGE --
To automatically record CPU usage, memory usage and other metrics be sure to start the instrumentation request very early in the life of your application.

Ideally, this should be the first thing your application does:
require\_once('Instrumentation.php');
Instrumentation::get\_instance()->start\_request();