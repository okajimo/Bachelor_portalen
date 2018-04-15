<?php
$path = "/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/";
$logg = '/xampp/htdocs/Bachelor portal met/BPO/public/storage/filer/logger/1.txt';

if (!file_exists($logg)) 
{
    fopen($path."1.txt", "w");
}
if (file_exists($logg)) 
{
    $logg = $path.'2.txt';
    if (file_exists($logg)) 
    {
        $logg = $path.'3.txt';
        if (file_exists($logg)) 
        {
            $logg = $path.'4.txt';
            if (file_exists($logg)) 
            {
                $logg = $path.'5.txt';
                if (file_exists($logg)) 
                {
                    $logg = $path.'6.txt';
                    if (file_exists($logg)) 
                    {
                        $logg = $path.'7.txt';
                        if (file_exists($logg)) 
                        {
                            unlink($path."7.txt");
                            rename($path."6.txt", $path."7.txt");
                            rename($path."5.txt", $path."6.txt");
                            rename($path."4.txt", $path."5.txt");
                            rename($path."3.txt", $path."4.txt");
                            rename($path."2.txt", $path."3.txt");
                            rename($path."1.txt", $path."2.txt");
                        }
                        else
                        {
                            rename($path."6.txt", $path."7.txt");
                            rename($path."5.txt", $path."6.txt");
                            rename($path."4.txt", $path."5.txt");
                            rename($path."3.txt", $path."4.txt");
                            rename($path."2.txt", $path."3.txt");
                            rename($path."1.txt", $path."2.txt");
                        }
                    }
                    else
                    {
                        rename($path."5.txt", $path."6.txt");
                        rename($path."4.txt", $path."5.txt");
                        rename($path."3.txt", $path."4.txt");
                        rename($path."2.txt", $path."3.txt");
                        rename($path."1.txt", $path."2.txt");
                    }
                }
                else
                {
                    rename($path."4.txt", $path."5.txt");
                    rename($path."3.txt", $path."4.txt");
                    rename($path."2.txt", $path."3.txt");
                    rename($path."1.txt", $path."2.txt");
                }
            }
            else
            {
                rename($path."3.txt", $path."4.txt");
                rename($path."2.txt", $path."3.txt");
                rename($path."1.txt", $path."2.txt");
            }
        }
        else
        {
            rename($path."2.txt", $path."3.txt");
            rename($path."1.txt", $path."2.txt");
        }
    }
    else
    {
        rename($path."1.txt", $path."2.txt");
    }
}
?>