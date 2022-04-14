<?php
public function get_books_with_writer_names(){
            /**SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
            FROM Orders
            INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID; */

            $stm="SELECT b.Book_Name, w.Writer_Name, w.Writer_Last_Name, b.Date_of_Publishing, b.Book_price ";
            $stm.="FROM Books b ";
            $stm.="JOIN Writers w ON b.Writer_ID=w.id";
            $result=$this->conn->prepare($stm)->execute();
            echo $result;
        }