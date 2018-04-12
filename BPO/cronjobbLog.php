<?php
$logg = '/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt';
if (!file_exists($logg)) 
{
    fopen("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt", "w");
}
if (file_exists($logg)) 
{
    $logg = '/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt';
    if (file_exists($logg)) 
    {
        $logg = '/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt';
        if (file_exists($logg)) 
        {
            $logg = '/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt';
            if (file_exists($logg)) 
            {
                $logg = '/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/5.txt';
                if (file_exists($logg)) 
                {
                    $logg = '/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/6.txt';
                    if (file_exists($logg)) 
                    {
                        $logg = '/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/7.txt';
                        if (file_exists($logg)) 
                        {
                            unlink("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/7.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/6.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/7.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/5.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/6.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/5.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt");
                        }
                        else
                        {
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/6.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/7.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/5.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/6.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/5.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt");
                            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt");
                        }
                    }
                    else
                    {
                        rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/5.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/6.txt");
                        rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/5.txt");
                        rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt");
                        rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt");
                        rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt");
                    }
                }
                else
                {
                    rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/5.txt");
                    rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt");
                    rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt");
                    rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt");
                }
            }
            else
            {
                rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/4.txt");
                rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt");
                rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt");
            }
        }
        else
        {
            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/3.txt");
            rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt");
        }
    }
    else
    {
        rename("/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt", "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/2.txt");
    }
}
?>