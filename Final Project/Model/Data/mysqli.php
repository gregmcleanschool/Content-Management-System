<?php
require_once('connection.php');

class Sqli
{
    private $result;

#UPDATES ARETICLE
    public function updateArticle($articleId,$contentAreaId,$allPages,$name,$title,$desc,$pageID,$modifiedBy,$content){

        $con = new Connect();
        $db = $con->connect();

        $query ="UPDATE Articles
                    SET ArticleName = '$name'
                    ,ArticleTitle = '$title'
                    ,ArticleDescription = '$desc'
                    ,Content = '$content'
                    ,PagesID = '$pageID'
                    ,ContentAreaID = '$contentAreaId'
                    ,allPages = '$allPages'
                    ,LastModifyDate = NOW()
                    ,LastModifyBy = '$modifiedBy'
                    WHERE ArticleID = '$articleId'; ";

        $this->result = mysqli_query($db,$query);


        $con->disconnect();

        return $this->result;

    }





    //INSERT A NEW ARTICLES
    public function insertArticle($name,$title,$desc,$content,$CreatedBy,$pageId,$CAID,$allPages,$LastModifyBy)
    {

        $con = new Connect();
        $db = $con->connect();


        $query="     INSERT INTO Articles(ArticleName,ArticleTitle,ArticleDescription,Content,CreateDate,CreatedBy,PagesID,ContentAreaID,allPages,LastModifyDate,LastModifyBy)
VALUES ('$name','$title','$desc','$content',NOW(),'$CreatedBy','$pageId','$CAID','$allPages',NOW(),'$LastModifyBy')";


        $this->result = mysqli_query($db,$query);


        $con->disconnect();

        return $this->result;


    }




    //Update just the active bool on CSS content
    public function updateCSSActive($active,$id){

        $con = new Connect();
        $db = $con->connect();



        $query ="UPDATE CSSTemplate
                SET active = '$active'
                Where CSSID ='$id';";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;


    }


//update CSS content
    public function updateCssContent($name,$desc,$snippet,$updatedBy,$id){

        $con = new Connect();
        $db = $con->connect();



        $query ="UPDATE CSSTemplate
                SET CssName = '$name'
                ,CssSnippet = '$snippet'
                ,CSSDescription = '$desc'
                ,LastModifyBy = '$updatedBy'
                Where CSSID ='$id';";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;

    }


    public function deletePage($id)
    {
        $con = new Connect();
        $db = $con->connect();



        $query ="DELETE FROM Pages
                  WHERE PagesID = '$id';";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;
    }


    public function insertPage($name,$alias,$desc,$createdBy){


        $con = new Connect();
        $db = $con->connect();

        $query="INSERT INTO Pages(PageName,pageAlias,Description,creationDate,CreatedBy,LastModifyDate,LastModifyBy)
                VALUES ('$name'
                ,'$alias'
                ,'$desc'
                ,NOW()
                ,'$createdBy'
                ,NOW()
                ,'$createdBy');";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;

    }


    public function updatePage($id,$name,$alias,$desc,$lastModifyBy){

        $con = new Connect();
        $db = $con->connect();

        $query="UPDATE Pages
                SET PageName = '$name'
                ,PageAlias = '$alias'
                ,Description = '$desc'
                ,LastModifyBy = '$lastModifyBy'
                ,LastModifyDate = NOW()
                WHERE PagesID = '$id';";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;

    }



    //ADDS NEW CONTENT AREA
    public function addContentArea($name,$desc,$order,$createdBy,$alias)
    {

        $con = new Connect();
        $db = $con->connect();



        $query ="INSERT INTO ContentArea(Name,Alias,OrderOnPage,Description,CreateDate,UserID)
                    VALUES ('$name'
                    ,'$alias'
                    ,'$order'
                    ,'$desc'
                    ,NOW()
                    ,'$createdBy');";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;

    }





//UPDATES INFORMATION FROM CONTENT AREA
    public function updateContentArea($name,$desc,$order,$updatedBy,$id){

        $con = new Connect();
        $db = $con->connect();



        $query ="UPDATE ContentArea
                    SET Name = '$name'
                    ,Alias = 'head'
                    ,OrderOnPage = '$order'
                    ,Description = '$desc'
                    ,LastModifyDate = NOW()
                    ,LastModifyBy = '$updatedBy'
                    WHERE ContentAreaID = '$id';";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;

    }


//DELETE A CONTENT AREA
    public function deleteContentArea($id){

        $con = new Connect();
        $db = $con->connect();



        $query ="DELETE FROM ContentArea
                  WHERE ContentAreaID = '$id';";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;


    }



    //DELETE AN ARTICLE
    public function deleteArticle($id){

        $con = new Connect();
        $db = $con->connect();



        $query ="DELETE FROM Articles
                  WHERE ArticleID = '$id';";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;


    }


//insert CSS content settings
    public function insertCssContent($name,$desc,$snippet,$createdBy){

        $con = new Connect();
        $db = $con->connect();



        $query ="INSERT INTO CSSTemplate(CSSName,CSSDescription,active,CssSnippet,CreateDate,CreatedBy,LastModifyDate,LastModifyBy)
                VALUES ('$name','$desc',false,'$snippet',NOW(),'$createdBy',NOW(),null);";

        $this->result = mysqli_query($db,$query);

        $ret="";


        $con->disconnect();

        return  $ret;

    }


 public function deleteCSS($CSSId)
 {

     $con = new Connect();
     $db = $con->connect();



     $query ="delete from CSSTemplate Where CSSID = '$CSSId';";

     $this->result = mysqli_query($db,$query);



     $con->disconnect();

     return  $this->result;


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

    public function selectUser(){

        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT * FROM User";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($$this->result->error .
                'Could not retrieve records from the CMS Database: ');
        }

    }

    public function fetchUserName($row)
    {
        return $row['UserName'];
    }
    public function fetchUserID($row)
    {
        return $row['UserID'];
    }
    public function fetchPasswordSalt($row)
    {
        return $row['passwordSalt'];
    }

    public function selectContentArea($pageID){
        $con = new Connect();
        $db = $con->connect();

//        $query ="SELECT *
//                FROM ContentArea
//                LEFT JOIN Articles
//                ON ContentArea.ContentAreaID=Articles.ContentAreaID
//                WHERE Articles.PagesID ='$pageID'";


        $query = "SELECT *  FROM ContentArea ORDER BY OrderOnPage";


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

        $con->disconnect();

    }


    public function selectAllArticles(){

        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT * FROM Articles";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($$this->result->error .
                'Could not retrieve records from the CMS Database: ');
        }

        $con->disconnect();

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

//content id
//name
//content

    public function lastModifyBy($row)
    {
        return $row['LastModifyBy'];
    }

    public function fetchArticleLastModifyDate($row)
    {
        return $row['LastModifyDate'];
    }

    public function fetchArticleAllPages($row)
    {

        return $row['allPages'];

    }

    public function fetchArticlePageID($row)
    {
        return $row['PagesID'];
    }

    public function fetchArticleCreatedBy($row)
    {
        return $row['CreatedBy'];
    }

    public function fetchArticleCreateDate($row)
    {
        return $row['CreateDate'];

    }

    public function fetchArticleID($row)
    {
        return $row['ArticleID'];
    }


    public function fetchArticleTitle($row)
    {
        return $row['ArticleTitle'];

    }

    public function fetchArticleDescription($row)
    {
        return $row['ArticleDescription'];
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

    public function fetchContentAreaName($row)
    {
        return $row['Name'];
    }

    public function fetchContentAreaDesc($row)
    {
        return $row['Description'];
    }

    public function fetchContentAreaOrder($row)
    {
        return $row['OrderOnPage'];
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

    public function fetchPageDescription($row)
    {
     return $row['Description'];

    }

    public function fetchPageID($row)
    {
        return $row['PagesID'];
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



    function insertUser($userName, $userPassword, $passwordSalt, $firstName, $lastName, $createdBy)
    {


        $con = new Connect();
        $db = $con->connect();

        $query="INSERT INTO User (UserName, UserPassword, passwordSalt, firstName, lastName, creationDate, createdBy) VALUES ('$userName', '$userPassword', '$passwordSalt', '$firstName', '$lastName', NOW(), '$createdBy')";

        $runQuery = mysqli_query($db, $query);

        $con->disconnect();

//        return $runQuery;
    }

    //DELETES ALL PRIVILEGES ASSOCIATED WITH A USER
    function deletePrivileges($id){
        $con = new Connect();
        $db = $con->connect();

        $query="DELETE FROM UserPrivilage
                  WHERE UserID = '$id';";

        $runQuery = mysqli_query($db, $query);

        $con->disconnect();

    }


    function updateUser($userName, $userPassword, $passwordSalt, $firstName, $lastName, $createdBy,$id)
    {


        $con = new Connect();
        $db = $con->connect();

        $query="UPDATE User
        SET UserName = '$userName',
        UserPassword = '$userPassword',
        passwordSalt = '$passwordSalt',
        firstName='$firstName',
        lastName='$lastName',
        creationDate = NOW(),
        createdBy='$createdBy'
        WHERE UserID = '$id'";

        $runQuery = mysqli_query($db, $query);

        $con->disconnect();

//        return $runQuery;
    }

    function insertUserPrivilege($userID,$privilege)
    {

        $con = new Connect();
        $db = $con->connect();

        $query ="INSERT INTO UserPrivilage
                    VALUES('$userID','$privilege');";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($this->result->error .
                'Could not retrieve records from the CMS Database: ');
        }

        return $this->result;

    }

    function selectUserPrivileges($userID){

        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT * FROM UserPrivilage WHERE UserID = '$userID';";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($this->result->error .
                'Could not retrieve records from the CMS Database: ');
        }

        return $this->result;

    }

    function fetchUserPrivileges($row){

     //   $row = mysqli_fetch_assoc($row);
        return $row['PrivilageID'];

    }




    function selectSingleUser($userName)
    {
        $con = new Connect();
        $db = $con->connect();

        $query ="SELECT * FROM User WHERE UserName ='$userName'";

        $this->result = mysqli_query($db,$query);

        if(!$this->result)
        {
            die($this->result->error .
                'Could not retrieve records from the CMS Database: ');
        }



        return $this->result;
    }

    function fetchUserSalt($row)
    {
        $row = mysqli_fetch_assoc($row);
        return $row['passwordSalt'];
    }

    function fetchUserPassword($row)
    {
        $row = mysqli_fetch_assoc($row);
        return $row['UserPassword'];
    }

    function fetchUserFirstName($row)
    {

        return $row['firstName'];
    }

    function fetchUserLastName($row)
    {
        return $row['lastName'];
    }








}//end class


?>