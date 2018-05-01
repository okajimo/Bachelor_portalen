<?php
if(date('d.m') >= "1.07")
{
    $host = '127.0.0.1';
    $user = 'root';
    $pw = '';
    $dbname = 'bpo';
    $con1 = mysqli_connect($host, $user, $pw, $dbname);


    $sql1 = "DELETE FROM documents";
    $sql2 = "DELETE FROM presentation";
    $sql3 = "DELETE FROM student_groups";
    $sql4 = "DELETE FROM groups";
    $sql5 = "DELETE FROM student";
    $sql6 = "DELETE FROM news";
    $sql7 = "DELETE FROM prosjektforslag";
    $sql8 = "UPDATE users SET level = 0, password = '' WHERE level = '1'";

    mysqli_query($con1, $sql1);
    mysqli_query($con1, $sql2);
    mysqli_query($con1, $sql3);
    mysqli_query($con1, $sql4);
    mysqli_query($con1, $sql5);
    mysqli_query($con1, $sql6);
    mysqli_query($con1, $sql7);
    mysqli_query($con1, $sql8);

    $file = "/xampp/htdocs/BachelorPortal/BPO/public/storage/filer";
    if(is_dir($file))
    {
        $file = scandir('/xampp/htdocs/BachelorPortal/BPO/public/storage/filer/');
        foreach($file as $filer)
        {
            if($filer !== '.' && $filer !== '..' && $filer && $filer !== 'tidligere_prosjekter_sluttrapport' && $filer !== 'logger')
            {
                $scanF = scandir('/xampp/htdocs/BachelorPortal/BPO/public/storage/filer/'.$filer);
                foreach($scanF as $s)
                {
                    if($s !== '.' && $s !== '..')
                    {
                        unlink('/xampp/htdocs/BachelorPortal/BPO/public/storage/filer/'.$filer.'/'.$s);
                    }
                }
                rmdir('/xampp/htdocs/BachelorPortal/BPO/public/storage/filer/'.$filer);
            }
        }
    }
}
?>
