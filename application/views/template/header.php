<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php
      $title = "";
      $deskripsi = "seputar dunia pemrograman bersama indowebs";
      $keyword = "belajar pemrograman , php, javascript, python, seputar pemrograman, belajar pemrograman php, belajar pemrograman javascript, belajar pemrograman python, mengenal dunia pemrograman";
      if(isset($post)){
        $title = $post->judul;
        $deskripsi = $post->deskripsi;
        if ($post->keyword != null && $post->keyword != "") {
          $keyword = $post->keyword;
        }
      }
     ?>
<title><?= $title.' | '.cek(Perusahaans::get(),'nama_perusahaan'); ?></title>
    <meta name="robots" content="index, follow" />
    <meta name="description" content="<?= $deskripsi ?>" />
    <meta name="og:description" content="<?= $deskripsi ?>">
    <meta name="twitter:title" content="<?= cek(Perusahaans::get(),'nama_perusahaan').$title; ?>">
    <meta name="twitter:image" content="<?= cek(Perusahaans::get(),'logo') ?>">
    <meta name="og:title" content="<?= cek(Perusahaans::get(),'nama_perusahaan').$title; ?>">
    <meta name="og:site_name" content="/<?= cek(Perusahaans::get(),'nama_perusahaan'); ?>/">
    <meta property="og:image" content="<?= cek(Perusahaans::get(),'logo') ?>">
    <meta content="<?= $keyword ?>" name="keywords">
    <meta name="twitter:url" content="https://indowebs.my.id/" />
    <meta name="twitter:title" content="<?= cek(Perusahaans::get(),'nama_perusahaan').$title; ?>" />
    <meta name="twitter:description" content="<?= $deskripsi ?>" />
    <meta name="twitter:image" content="<?= cek(Perusahaans::get(),'logo') ?>" />
    <link rel="canonical" href="https://indowebs.my.id/">
    <!-- Favicons -->
    <link href="<?= cek(Perusahaans::get(),'logo') ?>" rel="icon">
    <link href="<?= cek(Perusahaans::get(),'logo') ?>" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://infomalang.web.app/api/front/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://infomalang.web.app/api/front/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="https://infomalang.web.app/api/front/assets/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="https://infomalang.web.app/api/front/assets/vendor/line-awesome/css/line-awesome.min.css" rel="stylesheet">
    <link href="https://infomalang.web.app/api/front/assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://infomalang.web.app/api/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- Template Main CSS File -->
    <link href="https://infomalang.web.app/api/front/assets/css/style.css" rel="stylesheet">
    <script src="https://infomalang.web.app/api/notika/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="<?= base_url('assets/file.js');?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://infomalang.web.app/api/notika/css/code-editor/codemirror.css" rel="stylesheet">
    <link href="https://infomalang.web.app/api/notika/css/code-editor/ambiance.css" rel="stylesheet">
    <script src="https://infomalang.web.app/api/notika/js/code-editor/codemirror.js"></script>
    <script src="https://infomalang.web.app/api/notika/js/code-editor/code-editor.js"></script>


    <style>

    .head-name{
      margin-left: 16px;
    }

    .flex-column{
      border: 1px solid #dddddd;
    }

    .flex-column a:hover{
      background: #fdf;
      color: #77f;
    }

    .flex-column a{
      border-bottom: 1px solid #dddddd;
    }

    @media screen and (max-width:600px){
      .head-name{
        margin-top: 10px;
        margin-left: 10px;
        font-size: 16px;
      }
    }

    </style>

    <!-- =======================================================
  * Template Name: Butterfly - v2.2.1
  * Template URL: https://bootstrapmade.com/butterfly-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-SJNZK83PCH"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-SJNZK83PCH');
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4779382034088636"
     crossorigin="anonymous"></script>
</head>
<body>
