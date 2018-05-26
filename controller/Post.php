<?php

require './config/conn.php';

use Config as db;

class Blog extends db 
{
    public function RowBlog()
    {
        $sql = $this->prepare("SELECT * FROM posts ORDER BY id DESC");
			$sql->execute();
            $rowsql = $sql->fetchAll();
            foreach($rowsql as $rowB){
                echo 
                cl_image_tag('dull-leess.png')."
                <div class='card-body' style='margin-bottom:10px'>
                    <h2 class='card-title'>".$rowB['title']."</h2>
                    <p class='card-text'>".substr($rowB['news'],0, 250)."</p><a href='index.php?detail=".$rowB['id']."' class='btn btn-primary'>Read More &rarr;</a>
                </div>
                <div class='card-footer text-muted'>".
                $rowB['date_post']. ", 2017 by
                    <a href='#'>Diday</a>
                </div>";
            }			
    }

    public function RowCategory(){
        $sql = $this->prepare("SELECT * FROM category_blog ORDER BY id DESC");
        $sql->execute();
        $rowCat = $sql->fetchAll();
        foreach($rowCat as $rowC){
            echo "
            <li>
                <a href='index.php?category=".$rowC['id']."'>".$rowC['category_name']."</a>
            </li>
            ";
        }
    }

    public function FilterCat(){
        $idcat = $_GET['category'];
        $sql = $this->prepare("SELECT * FROM posts WHERE id_category = $idcat ");
        $sql->execute();
        $cat = $sql->fetchAll();
        foreach($cat as $filterCat){
            echo 
            cl_image_tag('dull-leess.png')."
                <div class='card-body' style='margin-bottom:10px'>
                    <h2 class='card-title'>".$filterCat['title']."</h2>
                    <p class='card-text'>".substr($filterCat['news'],0, 250)."</p><a href='index.php?detail=".$filterCat['id']."' class='btn btn-primary'>Read More &rarr;</a>
                </div>
                <div class='card-footer text-muted'>".
                $filterCat['date_post']. ", 2017 by
                    <a href='#'>Diday</a>
                </div>";
        }
        
    }

    public function SearchBlog(){
        $kata = $_POST['kata'];
        $sql  = $this->prepare("SELECT * FROM posts WHERE title LIKE '%$kata%' ");
        $sql->execute();
        $search = $sql->fetchAll();
        if(!empty($search)){
            foreach($search as $RowSearch){
                echo "
                <img class='card-img-top' src='http://placehold.it/750x300' alt='Card image cap'>
                    <div class='card-body' style='margin-bottom:10px'>
                        <h2 class='card-title'>".$RowSearch['title']."</h2>
                        <p class='card-text'>".substr($RowSearch['news'],0, 250)."</p><a href='index.php?detail=".$RowSearch['id']."' class='btn btn-primary'>Read More &rarr;</a>
                    </div>
                    <div class='card-footer text-muted'>".
                    $RowSearch['date_post']. ", 2017 by
                        <a href='#'>Diday</a>
                    </div>";
            }
        }else{
            echo "Hasil Pencarian Dari : ". $kata . " Kosong";
        }
            
        
    }
    public function DetailPost(){
        $detail = $_GET['detail'];
        $sql = $this->prepare("SELECT * FROM posts WHERE id = '$detail' ");
        $sql->execute();
        $detPost = $sql->fetch();
        echo "
        <img class='card-img-top' src='http://placehold.it/750x300' alt='Card image cap'>
        <div class='card-body' style='margin-bottom:10px'>
            <h2 class='card-title'>".$detPost['title']."</h2>
            <p class='card-text'>".$detPost['news']."</p>
        </div>
        <div class='card-footer text-muted'>".
        $detPost['date_post']. ", 2017 by
            <a href='#'>Diday</a>
        </div>
        ";
    }
    
    public function Comment(){
        $id_post = $_GET['detail'];
        $nama = $_POST['nama'];
        $comment = $_POST['comment'];
        $sql = $this->prepare("INSERT INTO comments VALUES ('','$id_post','$nama','$comment')");
        $sql->execute();
        header("location:index.php?detail=$id_post");
    }

    public function ResComent(){
        $id_post = $_GET['detail'];
        $sql = $this->prepare("SELECT * FROM comments WHERE post_id = '$id_post'");
        $sql->execute();
        $resComent = $sql->fetchAll();
        foreach($resComent as $rowCom){
            echo "
            <div class='media mb-4'>
            <img class='d-flex mr-3 rounded-circle' src='http://placehold.it/50x50' alt=''>
            <div class='media-body'>
              <h5 class='mt-0'>".$rowCom['username']."</h5>".$rowCom['reply']."</div>
            </div>
        ";
        }
        
    }
    
}
?>