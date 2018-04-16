(PHP 4, PHP 5)
mysql_fetch_array — 从结果集中取得一行作为关联数组，或数字数组，或二者兼有

说明
array mysql_fetch_array ( resource $result [, int $ result_type ] )
返回根据从结果集取得的行生成的数组，如果没有更多行则返回 FALSE。
mysql_fetch_array() 是 mysql_fetch_row() 的扩展版本。除了将数据以数字索引方式储存在数组中之外，还可以将数据作为关联索引储存，用字段名作为键名。
如果结果中的两个或以上的列具有相同字段名，最后一列将优先。要访问同名的其它列，必须用该列的数字索引或给该列起个别名。对有别名的列，不能再用原来的列名访问其内容（本例中的 'field'）。

Example #1 相同字段名的查询
select table1.field as foo, table2.field as bar from table1, table2

有一点很重要必须指出，用 mysql_fetch_array() 并不明显 比用 mysql_fetch_row() 慢，而且还提供了明显更多的值。
mysql_fetch_array() 中可选的第二个参数 result_type 是一个常量，可以接受以下值：MYSQL_ASSOC，MYSQL_NUM 和 MYSQL_BOTH。本特性是 PHP 3.0.7 起新加的。本参数的默认值是 MYSQL_BOTH。
如果用了 MYSQL_BOTH，将得到一个同时包含关联和数字索引的数组。用 MYSQL_ASSOC 只得到关联索引（如同 mysql_fetch_assoc() 那样），用 MYSQL_NUM 只得到数字索引（如同 mysql_fetch_row() 那样）。
Note: 此函数返回的字段名大小写敏感。

Example #2 mysql_fetch_array 使用 MYSQL_NUM
<?php
    mysql_connect("localhost", "mysql_user", "mysql_password") or
        die("Could not connect: " . mysql_error());
    mysql_select_db("mydb");

    $result = mysql_query("SELECT id, name FROM mytable");

    while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
        printf ("ID: %s  Name: %s", $row[0], $row[1]);
    }

    mysql_free_result($result);
?>



Example #3 mysql_fetch_array 使用 MYSQL_ASSOC

<?php
    mysql_connect("localhost", "mysql_user", "mysql_password") or
        die("Could not connect: " . mysql_error());
    mysql_select_db("mydb");

    $result = mysql_query("SELECT id, name FROM mytable");

    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        printf ("ID: %s  Name: %s", $row["id"], $row["name"]);
    }

    mysql_free_result($result);
?>
Example #4 mysql_fetch_array 使用 MYSQL_BOTH

<?php
    mysql_connect("localhost", "mysql_user", "mysql_password") or
        die("Could not connect: " . mysql_error());
    mysql_select_db("mydb");

    $result = mysql_query("SELECT id, name FROM mytable");

    while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
        printf ("ID: %s  Name: %s", $row[0], $row["name"]);
    }

    mysql_free_result($result);
?>

参数
result
resource 型的结果集。此结果集来自对 mysql_query() 的调用。
result_type
The type of array that is to be fetched. It's a constant and can take the following values: MYSQL_ASSOC, MYSQL_NUM, and MYSQL_BOTH.

返回值
Returns an array of strings that corresponds to the fetched row, or FALSE if there are no more rows. The type of returned array depends on how result_type is defined. By using MYSQL_BOTH (default), you'll get an array with both associative and number indices. Using MYSQL_ASSOC, you only get associative indices (as mysql_fetch_assoc() works), using MYSQL_NUM, you only get number indices (as mysql_fetch_row() works).
If two or more columns of the result have the same field names, the last column will take precedence. To access the other column(s) of the same name, you must use the numeric index of the column or make an alias for the column. For aliased columns, you cannot access the contents with the original column name.

注释
Note: Performance
An important thing to note is that using mysql_fetch_array() is not significantly slower than using mysql_fetch_row(), while it provides a significant added value.
Note: 此函数返回的字段名大小写敏感。
Note: 此函数将 NULL 字段设置为 PHP NULL 值。