<?php
require_once('connection.php');

class Sqli
{
    private $result;

#Assigns article to a content area, not yet implemented
    public function setArticleContentAreaID($articleId,$contentAreaId,$allPages){

        $con = new Connect();
        $db = $con->connect();

        $query ="Update Articles
                  SET ContentAreaID = '$contentAreaId'
                  ,allPages = '$allPages'
                  WHERE ArticleID = '$articleId'";

        $this->result = mysqli_query($db,$query);


        $con->disconnect();

        return $this->result;

    }





//updates CSS content settings
    public function insertCssContent($name,$desc,$snippet,$createdBy){

        $con = new Connect();
        $db = $con->connect();



        $query ="INSERT INTO CSSTemplate(CSSName,CSSDescription,active,CssSnippet,CreateDate,CreatedBy,LastModifyDate,LastModifyBy)
                VALUES ('$name','$desc',false,'$snippet',NOW(),'$createdBy',NOW(),null);";

        $this->result = mysqli_query($db,$query);

        $ret="";

        while($row = mysqli_fetch_row( $this->result))
        {

            $ret = $row[0];

        }

        $con->disconnect();

        return  $ret;

    }


//get the CSS snippet from the database
    public function selectCSSContent($CSSId){
        $con = new Connect();
        $db = $con->connect();



        $query ="SELECT CssSnippet FROM CSSTemplate Where active = true ";

        $this->result = mysqli_query($db,$query);

        $ret="";

        while($row = mysqli_fetch_row( $this->result))
        {

            $ret = $row[0];

        }

        $con->disconnect();

        return  $ret;

    }


    public function selectallCSSInfo(){
        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT * FROM CSSTemplate";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($$this->result->error .
                'Could not retrieve records from the CMS Database: ');
        }

    }


    public function aliasPageTitleConvert($pageAlias)
    {
        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT PageName FROM Pages WHERE PageAlias = '$pageAlias'";

        $this->result = mysqli_query($db,$query);

        $ret="";

        while($row = mysqli_fetch_row( $this->result))
        {

            $ret = $row[0];

        }

        $con->disconnect();

        return  $ret;

    }


    Public function aliasPageIdConvert($pageAlias){

        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT PagesID
                FROM Pages
                WHERE PageAlias = '$pageAlias'";

        $this->result = mysqli_query($db,$query);

        $ret="";

        while($row = mysqli_fetch_row( $this->result))
        {

            $ret = $row[0];

        }

        $con->disconnect();

        return  $ret;
    }


    public function selectPages(){

        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT * FROM Pages";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($$this->result->error .
                'Could not retrieve records from the CMS Database: ');
        }

    }

    public function selectContentArea($pageID){
        $con = new Connect();
        $db = $con->connect();

//        $query ="SELECT *
//                FROM ContentArea
//                LEFT JOIN Articles
//                ON ContentArea.ContentAreaID=Articles.ContentAreaID
//                WHERE Articles.PagesID ='$pageID'";


        $query = "SELECT *  FROM ContentArea";


        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($$this->result->error .
                'Could not retrieve records from the CMS Database: ');
        }

    }

    public function selectArticles($pageID){
        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT * FROM Articles WHERE PagesID ='$pageID' OR
        allPages = true";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($$this->result->error .
                'Could not retrieve records from the CMS Database: ');
        }

    }


    public function fetchContentArea()
    {
        if(!$this->result)
        {
            die('No records in the result set: ');
        }
        return $this->result->fetch_array();
    }





    public function fetchPages()
    {
        if(!$this->result)
        {
            die('No records in the result set: ');
        }
        return $this->result->fetch_array();

   }

    public function fetchCSSID($row)
    {
        return $row['CSSID'];
    }

    public function fetchCSSName($row)
    {
        return $row['CSSName'];
    }

    public function fetchCSSDescription($row)
    {
        return $row['CSSDescription'];
    }

    public function fetchCSSIsActive($row)
    {
        return $row['active'];
    }

    public function fetchCSSSnippet($row)
    {
        return $row['CssSnippet'];
    }





    public function fetchArticleName($row)
    {
        return $row['ArticleName'];
    }



    public function fetchArticleContent($row)
    {
        return $row['Content'];
    }

    public function fetchArticleAssociatedContentArea($row)
    {
        return $row['ContentAreaID'];
    }

    public function fetchContentAreaID($row)
    {
        return $row['ContentAreaID'];
    }

    public function fetchContentAreaAlias($row)
    {
        return $row['Alias'];
    }

    public function fetchPageAlias($row)
    {
        return $row['pageAlias'];
    }

    public function fetchPageName($row)
    {
        return $row['PageName'];
    }





    public function selectActorsNEW($start,$count)
    {
        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT * FROM actor LIMIT $start,$count";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($$this->result->error .
                'Could not retrieve records from the Sakila Database: ');
        }


    }



    public function fetchActorsNEW()
    {
        if(!$this->result)
        {
            die('No records in the result set: ' .
                $this->dbConnection->error);
        }
        return $this->result->fetch_array();
    }



    public function fetchActorID($row)
    {
        return $row['actor_id'];
    }

    public function fetchActorFirstName($row)
    {
        return $row['first_name'];
    }

    public function fetchActorLastName($row)
    {
        return $row['last_name'];
    }



    function searchActors($input){

        $con = new Connect();
        $db = $con->connect();

        $query = "SELECT actor_id, first_name, last_name FROM actor WHERE first_name LIKE '%$input%' OR last_name LIKE '%$input%' LIMIT 10";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($$this->result->error .
                'Could not retrieve records from the Sakila Database: ');
        }

    }



    function insertActor($fName, $lName)
    {
        $con = new Connect();
        $db = $con->connect();

        $query = "INSERT INTO actor (first_name, last_name) VALUES ('$fName','$lName')";

        $runQuery = mysqli_query($db,$query);



        $con->disconnect();

        return $runQuery;

    }


    function updateActor($id,$fName,$lName)
    {
        $con = new Connect();
        $db = $con->connect();


        $query = "UPDATE actor SET first_name = '$fName', last_name = '$lName' WHERE actor_id = '$id'";

        $runQuery = mysqli_query($db,$query);



        $con->disconnect();

        return $runQuery;


    }

    function deleteActor($id)
    {

        $con = new Connect();
        $db = $con->connect();

        $query = "DELETE FROM actor WHERE actor_id = '$id'";

        $runQuery = mysqli_query($db,$query);

        $error = mysqli_error($db);

        $con->disconnect();

        return $runQuery;
    }


}//end class


?>