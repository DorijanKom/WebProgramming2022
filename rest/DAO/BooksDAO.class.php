<?php
    
    require_once __DIR__.'DAO/BaseDAO.class.php';

    class BooksDAO extends BaseDAO{    
     
        public function __construct()
        {
            parent::__construct("Books");
        }

        public function get_books_with_writer_names(){
            /**SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
            FROM Orders
            INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID; */

            $stm="SELECT b.Book_Name, w.Writer_Name, w.Writer_Last_Name, b.Date_of_Publishing, b.Book_price ";
            $stm.="FROM Books b ";
            $stm.="JOIN Writers w ON b.Writer_ID=w.id";
            $result=$this->conn->prepare($stm);
            $result->execute();
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }


        public function get_books_by_writer_name($writer_name,$writer_last_name){
            $stm=$this->get_books_with_writer_names();
            $stm.=" WHERE w.Writer_Name=':writer_name' AND w.Writer_Last_Name=':writer_last_name'";
            $result=$this->conn->prepare($stm);
            $result->execute(['writer_name'=>$writer_name,'writer_last_name'=>$writer_last_name]);
            return @reset($result->fetchAll(PDO::FETCH_ASSOC));
        }
}
?>